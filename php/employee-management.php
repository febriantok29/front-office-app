<?php
/**
 * Front Office System - Employee Management
 * 
 * Lists all employees and provides management options
 */

// Start the session
session_start();

// Include the Employee model
require_once __DIR__ . '/../app/models/Employee.php';

// Get all employees
$employee = new Employee();
$employees = $employee->getAll(); // We'll add this method to the Employee model

// Get any success or error messages
$successMessage = $_SESSION['success_message'] ?? '';
$errorMessage = $_SESSION['error_message'] ?? '';

// Clear session messages
unset($_SESSION['success_message']);
unset($_SESSION['error_message']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management - Front Office System</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            <li><a href="../index.php">Home</a></li>
            
            <li class="menu-category">Visitor Management <i class="fas fa-chevron-down"></i></li>
            <ul class="submenu">
                <li><a href="visitor-registration.php">Visitor Registration</a></li>
                <li><a href="visitor-records.php">Visitor Records</a></li>
            </ul>
            
            <li class="menu-category expanded">Administration <i class="fas fa-chevron-down"></i></li>
            <ul class="submenu expanded">
                <li><a href="employee-management.php" class="active">Employee Management</a></li>
            </ul>
            
            <li class="menu-category">Future Modules <i class="fas fa-chevron-down"></i></li>
            <ul class="submenu">
                <li><a href="#" class="disabled">Item Entry/Exit</a></li>
                <li><a href="#" class="disabled">Guest Book</a></li>
            </ul>
        </ul>
    </div>
    
    <div class="main-container">
        <div class="container">
            <main>
                <h2>Employee Management</h2>
                
                <!-- Display success message if any -->
                <?php if (!empty($successMessage)): ?>
                    <div class="success-message">
                        <?php echo htmlspecialchars($successMessage); ?>
                    </div>
                <?php endif; ?>
                
                <!-- Display error message if any -->
                <?php if (!empty($errorMessage)): ?>
                    <div class="error-message">
                        <?php echo htmlspecialchars($errorMessage); ?>
                    </div>
                <?php endif; ?>
                
                <div class="actions top-actions">
                    <a href="employee-add.php" class="button">Add New Employee</a>
                </div>
                
                <div class="search-filter">
                    <input type="text" id="employeeSearch" placeholder="Search employees..." class="search-input">
                </div>
                
                <?php if (empty($employees)): ?>
                    <p class="info-message">No employees found in the system.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table id="employeeTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Status</th>
                                    <th>Created Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($employees as $emp): ?>
                                <tr>
                                    <td><?php echo $emp['id']; ?></td>
                                    <td><?php echo htmlspecialchars($emp['name']); ?></td>
                                    <td><?php echo htmlspecialchars($emp['department']); ?></td>
                                    <td><?php echo $emp['is_active'] ? '<span class="status-active">Active</span>' : '<span class="status-inactive">Inactive</span>'; ?></td>
                                    <td><?php echo date('M d, Y', strtotime($emp['created_at'])); ?></td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="employee-edit.php?id=<?php echo $emp['id']; ?>" class="button button-small">Edit</a>
                                            <a href="employee-toggle-status.php?id=<?php echo $emp['id']; ?>&status=<?php echo $emp['is_active'] ? '0' : '1'; ?>" 
                                               class="button button-small button-secondary" 
                                               onclick="return confirm('<?php echo $emp['is_active'] ? 'Deactivate' : 'Activate'; ?> this employee?')">
                                                <?php echo $emp['is_active'] ? 'Deactivate' : 'Activate'; ?>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </main>
            
            <footer>
                <p>&copy; <?php echo date('Y'); ?> Front Office System | Educational Project</p>
            </footer>
        </div>
    </div>
    
    <script src="../js/employees.js"></script>
    <script src="../js/script.js"></script>
</body>
</html>