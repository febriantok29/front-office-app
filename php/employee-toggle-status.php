<?php
/**
 * Front Office System - Toggle Employee Status
 * 
 * Toggles an employee's active status
 */

// Start the session
session_start();

// Include the Employee model
require_once __DIR__ . '/../app/models/Employee.php';

// Check if ID and status are provided
if (!isset($_GET['id']) || !isset($_GET['status'])) {
    $_SESSION['error_message'] = 'Invalid request';
    header('Location: employee-management.php');
    exit;
}

$id = (int)$_GET['id'];
$status = (int)$_GET['status'];

// Validate status (must be 0 or 1)
if ($status !== 0 && $status !== 1) {
    $_SESSION['error_message'] = 'Invalid status value';
    header('Location: employee-management.php');
    exit;
}

// Update employee status
$employee = new Employee();
$result = $employee->updateStatus($id, $status); // We'll add this method to the Employee model

if ($result) {
    $_SESSION['success_message'] = 'Employee status has been updated';
} else {
    $_SESSION['error_message'] = 'Failed to update employee status';
}

// Redirect back to employee management
header('Location: employee-management.php');
exit;