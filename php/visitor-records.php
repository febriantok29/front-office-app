<?php
/**
 * Front Office System - Visitor Records
 * 
 * Displays all registered visitors in a table
 */

// Start the session
session_start();

// Include the Visitor model
require_once __DIR__ . '/../app/models/Visitor.php';

// Get all visitors
$visitor = new Visitor();
$visitors = $visitor->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Records - Front Office System</title>
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
            
            <li class="menu-category expanded">Visitor Management <i class="fas fa-chevron-down"></i></li>
            <ul class="submenu expanded">
                <li><a href="visitor-registration.php">Visitor Registration</a></li>
                <li><a href="visitor-records.php" class="active">Visitor Records</a></li>
            </ul>
            
            <li class="menu-category">Administration <i class="fas fa-chevron-down"></i></li>
            <ul class="submenu">
                <li><a href="employee-management.php">Employee Management</a></li>
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
                <h2>Visitor Records</h2>
                
                <?php if (empty($visitors)): ?>
                    <p class="info-message">No visitor records found.</p>
                <?php else: ?>
                    <div class="search-filter">
                        <input type="text" id="visitorSearch" placeholder="Search visitors..." class="search-input">
                        <!-- Future expansion: Add date range filters and more advanced search options -->
                        <!-- 
                        <div class="filter-options">
                            <label for="dateFrom">From:</label>
                            <input type="date" id="dateFrom">
                            <label for="dateTo">To:</label>
                            <input type="date" id="dateTo">
                            <button class="button button-small">Filter</button>
                        </div>
                        -->
                    </div>
                    
                    <div class="table-responsive">
                        <table id="visitorTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Full Name</th>
                                    <th>ID Card Number</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Employee to Visit</th>
                                    <th>Purpose</th>
                                    <th>Visit Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($visitors as $visitor): ?>
                                <tr>
                                    <td><?php echo $visitor['id']; ?></td>
                                    <td><?php echo htmlspecialchars($visitor['full_name']); ?></td>
                                    <td><?php echo htmlspecialchars($visitor['id_card_number']); ?></td>
                                    <td><?php echo htmlspecialchars($visitor['phone_number']); ?></td>
                                    <td><?php echo htmlspecialchars($visitor['email'] ?? 'N/A'); ?></td>
                                    <td><?php echo htmlspecialchars($visitor['employee_name']); ?></td>
                                    <td><?php echo htmlspecialchars($visitor['visit_purpose']); ?></td>
                                    <td><?php echo date('M d, Y H:i', strtotime($visitor['visit_timestamp'])); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Future expansion: Add pagination controls here -->
                    <!--
                    <div class="pagination">
                        <button class="pagination-btn">Previous</button>
                        <span class="pagination-info">Page 1 of 5</span>
                        <button class="pagination-btn">Next</button>
                    </div>
                    -->
                <?php endif; ?>
                
                <div class="actions">
                    <a href="visitor-registration.php" class="button">Register New Visitor</a>
                    <!-- Future expansion: Add export/print buttons here -->
                    <!--
                    <button class="button button-secondary">Export to CSV</button>
                    <button class="button button-secondary">Print Records</button>
                    -->
                </div>
            </main>
            
            <footer>
                <p>&copy; <?php echo date('Y'); ?> Front Office System | Educational Project</p>
            </footer>
        </div>
    </div>
    
    <script src="../js/visitors.js"></script>
    <script src="../js/script.js"></script>
</body>
</html>