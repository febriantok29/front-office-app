<?php
/**
 * Front Office System - Process Employee Form
 * 
 * Handles employee form submissions (add, edit)
 */

// Start the session
session_start();

// Include the Employee model
require_once __DIR__ . '/../app/models/Employee.php';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialize error array
    $errors = [];
    
    // Get the action (add or edit)
    $action = $_POST['action'] ?? '';
    
    // Validate required fields
    if (empty($_POST['name'])) {
        $errors[] = 'Employee name is required';
    }
    
    if (empty($_POST['department'])) {
        $errors[] = 'Department is required';
    }
    
    // If editing, validate ID
    if ($action === 'edit' && empty($_POST['id'])) {
        $errors[] = 'Employee ID is required for editing';
    }
    
    // If no errors, process the form
    if (empty($errors)) {
        // Prepare employee data
        $employeeData = [
            'name' => htmlspecialchars($_POST['name']),
            'department' => htmlspecialchars($_POST['department']),
            'is_active' => isset($_POST['is_active']) ? (int)$_POST['is_active'] : 1
        ];
        
        $employee = new Employee();
        
        // Process based on action
        if ($action === 'add') {
            // Add new employee
            $result = $employee->create($employeeData);
            $successMessage = 'Employee added successfully';
        } elseif ($action === 'edit') {
            // Update existing employee
            $id = (int)$_POST['id'];
            $result = $employee->update($id, $employeeData);
            $successMessage = 'Employee updated successfully';
        } else {
            // Invalid action
            $errors[] = 'Invalid action specified';
            $result = false;
        }
        
        if ($result) {
            // Success - set success message in session
            $_SESSION['success_message'] = $successMessage;
            
            // Redirect to employee management
            header('Location: employee-management.php');
            exit;
        } else {
            // Database error
            $errors[] = 'An error occurred while saving employee information. Please try again.';
        }
    }
    
    // If there are errors, store them in session to display after redirect
    if (!empty($errors)) {
        $_SESSION['form_errors'] = $errors;
        $_SESSION['form_data'] = $_POST; // Store form data for repopulating the form
        
        // Redirect back to the appropriate form
        if ($action === 'edit') {
            header('Location: employee-edit.php?id=' . $_POST['id']);
        } else {
            header('Location: employee-add.php');
        }
        exit;
    }
} else {
    // If not POST request, redirect to the employee management
    header('Location: employee-management.php');
    exit;
}