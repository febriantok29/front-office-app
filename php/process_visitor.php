<?php
/**
 * Visitor Registration Handler
 * 
 * This script processes the visitor registration form submission
 */

// Start the session
session_start();

// Include the Visitor model
require_once __DIR__ . '/../app/models/Visitor.php';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialize error array
    $errors = [];
    
    // Validate required fields
    if (empty($_POST['full_name'])) {
        $errors[] = 'Full Name is required';
    }
    
    if (empty($_POST['id_card_number'])) {
        $errors[] = 'ID Card Number is required';
    }
    
    if (empty($_POST['phone_number'])) {
        $errors[] = 'Phone Number is required';
    }
    
    if (empty($_POST['employee_id'])) {
        $errors[] = 'Employee selection is required';
    }
    
    if (empty($_POST['visit_purpose'])) {
        $errors[] = 'Visit Purpose is required';
    }
    
    // Validate email if provided
    if (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format';
    }
    
    // If no errors, save visitor data to database
    if (empty($errors)) {
        $visitorData = [
            'full_name' => htmlspecialchars($_POST['full_name']),
            'id_card_number' => htmlspecialchars($_POST['id_card_number']),
            'phone_number' => htmlspecialchars($_POST['phone_number']),
            'email' => !empty($_POST['email']) ? htmlspecialchars($_POST['email']) : null,
            'employee_id' => (int)$_POST['employee_id'],
            'visit_purpose' => htmlspecialchars($_POST['visit_purpose'])
        ];
        
        try {
            // Save visitor data
            $visitor = new Visitor();
            $visitorId = $visitor->create($visitorData);
            
            if ($visitorId) {
                // Success - set success message in session
                $_SESSION['success_message'] = 'Thank you! Your visit has been registered successfully.';
                
                // Redirect to prevent form resubmission
                header('Location: visitor-registration.php');
                exit;
            } else {
                // Database error
                $errors[] = 'An error occurred while saving your information. Please try again.';
            }
        } catch (Exception $e) {
            // Log the error (in a production system)
            // error_log($e->getMessage());
            
            // Set error for display
            $_SESSION['error_message'] = 'A system error occurred while processing your request. Please try again later.';
            $_SESSION['error_code'] = 500;
            
            // Redirect to error page
            header('Location: error.php');
            exit;
        }
    }
    
    // If there are errors, store them in session to display after redirect
    if (!empty($errors)) {
        $_SESSION['form_errors'] = $errors;
        $_SESSION['form_data'] = $_POST; // Store form data for repopulating the form
        
        // Redirect back to the form
        header('Location: visitor-registration.php');
        exit;
    }
} else {
    // If not POST request, redirect to the form
    header('Location: visitor-registration.php');
    exit;
}