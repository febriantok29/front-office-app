<?php
/**
 * Front Office System - Visitor Registration
 * 
 * Page with visitor registration form
 */

// Start the session
session_start();

// Include the Employee model to get employee list
require_once __DIR__ . '/../app/models/Employee.php';
require_once __DIR__ . '/../includes/Database.php';

// Get all active employees for the dropdown
$employee = new Employee();
$employees = $employee->getAllActive();

// Get any form errors or success messages from session
$formErrors = $_SESSION['form_errors'] ?? [];
$formData = $_SESSION['form_data'] ?? [];
$successMessage = $_SESSION['success_message'] ?? '';

// Clear session variables
unset($_SESSION['form_errors']);
unset($_SESSION['form_data']);
unset($_SESSION['success_message']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Registration - Front Office System</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Sidebar Navigation -->
    <button class="sidebar-toggle">
        <i class="fas fa-bars"></i>
    </button>
    
    <div class="sidebar">
        <div class="sidebar-header">
            <h1>Front Office System</h1>
        </div>
        <ul class="sidebar-menu">
            <li><a href="../index.php"><i class="fas fa-home"></i> Home</a></li>
            
            <li class="menu-category expanded">Visitor Management <i class="fas fa-chevron-down"></i></li>
            <ul class="submenu expanded">
                <li><a href="visitor-registration.php" class="active"><i class="fas fa-user-plus"></i> Visitor Registration</a></li>
                <li><a href="visitor-records.php"><i class="fas fa-clipboard-list"></i> Visitor Records</a></li>
            </ul>
            
            <li class="menu-category">Administration <i class="fas fa-chevron-down"></i></li>
            <ul class="submenu">
                <li><a href="employee-management.php"><i class="fas fa-users"></i> Employee Management</a></li>
            </ul>
            
            <li class="menu-category">Future Modules <i class="fas fa-chevron-down"></i></li>
            <ul class="submenu">
                <li><a href="#" class="disabled"><i class="fas fa-box"></i> Item Entry/Exit</a></li>
                <li><a href="#" class="disabled"><i class="fas fa-book"></i> Guest Book</a></li>
            </ul>
        </ul>
    </div>
    
    <div class="main-container">
        <div class="container">
            <main>
                <div class="page-header flex items-center justify-between mb-4">
                    <h2>Visitor Registration</h2>
                    <a href="visitor-records.php" class="button button-secondary">
                        <i class="fas fa-list mr-1"></i> View All Visitors
                    </a>
                </div>
                
                <!-- Display success message if any -->
                <?php if (!empty($successMessage)): ?>
                    <div class="success-message">
                        <div class="message-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div>
                            <strong>Success!</strong> <?php echo htmlspecialchars($successMessage); ?>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Display form errors if any -->
                <?php if (!empty($formErrors)): ?>
                    <div class="error-message">
                        <div class="message-icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <div>
                            <strong>Please fix the following errors:</strong>
                            <ul class="mt-1">
                                <?php foreach ($formErrors as $error): ?>
                                    <li><?php echo htmlspecialchars($error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
                
                <div class="card shadow">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h3 class="card-title">Register a New Visitor</h3>
                    </div>
                    
                    <div class="card-body">
                        <p class="card-description">Please fill in the details of the visitor. Fields marked with <span class="required">*</span> are required.</p>
                        
                        <!-- Visitor Registration Form -->
                        <form id="visitorForm" action="process_visitor.php" method="post">
                            <div class="flex gap-3 flex-col md:flex-row">
                                <div class="form-group w-full">
                                    <label for="full_name">Full Name <span class="required">*</span></label>
                                    <input type="text" id="full_name" name="full_name" 
                                        value="<?php echo htmlspecialchars($formData['full_name'] ?? ''); ?>" 
                                        required placeholder="Enter visitor's full name">
                                </div>
                                
                                <div class="form-group w-full">
                                    <label for="id_card_number">ID Card Number <span class="required">*</span></label>
                                    <input type="text" id="id_card_number" name="id_card_number" 
                                        value="<?php echo htmlspecialchars($formData['id_card_number'] ?? ''); ?>" 
                                        required placeholder="Enter identification number">
                                </div>
                            </div>
                            
                            <div class="flex gap-3 flex-col md:flex-row">
                                <div class="form-group w-full">
                                    <label for="phone_number">Phone Number <span class="required">*</span></label>
                                    <input type="tel" id="phone_number" name="phone_number" 
                                        value="<?php echo htmlspecialchars($formData['phone_number'] ?? ''); ?>" 
                                        required placeholder="Enter contact number">
                                </div>
                                
                                <div class="form-group w-full">
                                    <label for="email">Email Address</label>
                                    <input type="email" id="email" name="email" 
                                        value="<?php echo htmlspecialchars($formData['email'] ?? ''); ?>" 
                                        placeholder="visitor@example.com (Optional)">
                                    <small>Optional - For sending confirmation or notifications</small>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="employee_id">Employee to Visit <span class="required">*</span></label>
                                <select id="employee_id" name="employee_id" required>
                                    <option value="">-- Select Employee --</option>
                                    <?php foreach ($employees as $employee): ?>
                                        <option value="<?php echo $employee['id']; ?>" 
                                            <?php echo (isset($formData['employee_id']) && $formData['employee_id'] == $employee['id']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($employee['name']); ?> (<?php echo htmlspecialchars($employee['department']); ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="visit_purpose">Purpose of Visit <span class="required">*</span></label>
                                <textarea id="visit_purpose" name="visit_purpose" rows="3" 
                                    required placeholder="Please describe the reason for your visit"><?php echo htmlspecialchars($formData['visit_purpose'] ?? ''); ?></textarea>
                            </div>
                            
                            <div class="form-group mb-1 mt-4">
                                <button type="submit" class="button">
                                    <i class="fas fa-save mr-1"></i> Register Visit
                                </button>
                                <button type="reset" class="button button-secondary">
                                    <i class="fas fa-undo mr-1"></i> Clear Form
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
            
            <footer>
                <p>&copy; <?php echo date('Y'); ?> Front Office System | Version 1.0</p>
            </footer>
        </div>
    </div>
    
    <script src="../js/validation.js"></script>
    <script src="../js/visitors.js"></script>
    <script src="../js/script.js"></script>
</body>
</html>