<?php
/**
 * Front Office System - Edit Employee
 * 
 * Form to edit an existing employee
 */

// Start the session
session_start();

// Include the Employee model
require_once __DIR__ . '/../app/models/Employee.php';

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error_message'] = 'No employee ID provided';
    header('Location: employee-management.php');
    exit;
}

$id = (int)$_GET['id'];

// Get employee data
$employee = new Employee();
$employeeData = $employee->getById($id); // We'll add this method to the Employee model

// If employee not found, redirect back
if (!$employeeData) {
    $_SESSION['error_message'] = 'Employee not found';
    header('Location: employee-management.php');
    exit;
}

// Get any form errors from session (if coming from a failed submission)
$formErrors = $_SESSION['form_errors'] ?? [];
$formData = $_SESSION['form_data'] ?? $employeeData; // Use form data if available, otherwise use employee data

// Clear session variables
unset($_SESSION['form_errors']);
unset($_SESSION['form_data']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee - Front Office System</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Front Office System</h1>
            <button class="menu-toggle">Menu <i class="fas fa-bars"></i></button>
            <nav>
                <ul class="main-menu">
                    <li><a href="../index.php">Home</a></li>
                    
                    <li class="menu-category">Visitor Management <i class="fas fa-chevron-down"></i></li>
                    <ul class="submenu">
                        <li><a href="visitor-registration.php">Visitor Registration</a></li>
                        <li><a href="visitor-records.php">Visitor Records</a></li>
                    </ul>
                    
                    <li class="menu-category">Administration <i class="fas fa-chevron-down"></i></li>
                    <ul class="submenu expanded">
                        <li><a href="employee-management.php" class="active">Employee Management</a></li>
                    </ul>
                    
                    <li class="menu-category">Future Modules <i class="fas fa-chevron-down"></i></li>
                    <ul class="submenu">
                        <li><a href="#" class="disabled">Item Entry/Exit</a></li>
                        <li><a href="#" class="disabled">Guest Book</a></li>
                    </ul>
                </ul>
            </nav>
        </header>
        
        <main>
            <h2>Edit Employee</h2>
            
            <!-- Display form errors if any -->
            <?php if (!empty($formErrors)): ?>
                <div class="error-message">
                    <ul>
                        <?php foreach ($formErrors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <form id="employeeForm" action="process-employee.php" method="post">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                
                <div class="form-group">
                    <label for="name">Full Name: <span class="required">*</span></label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($formData['name'] ?? ''); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="department">Department: <span class="required">*</span></label>
                    <input type="text" id="department" name="department" value="<?php echo htmlspecialchars($formData['department'] ?? ''); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="is_active">Status:</label>
                    <select id="is_active" name="is_active">
                        <option value="1" <?php echo (isset($formData['is_active']) && $formData['is_active'] == 1) ? 'selected' : ''; ?>>Active</option>
                        <option value="0" <?php echo (isset($formData['is_active']) && $formData['is_active'] == 0) ? 'selected' : ''; ?>>Inactive</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="button">Update Employee</button>
                    <a href="employee-management.php" class="button button-secondary">Cancel</a>
                </div>
            </form>
        </main>
        
        <footer>
            <p>&copy; <?php echo date('Y'); ?> Front Office System | Educational Project</p>
        </footer>
    </div>
    
    <script src="../js/validation.js"></script>
    <script src="../js/script.js"></script>
</body>
</html>