<?php
/**
 * Front Office System - Home Page
 * 
 * Main landing page for the Front Office System
 */

// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Front Office System</title>
    <link rel="stylesheet" href="css/styles.css">
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
            <li><a href="index.php" class="active"><i class="fas fa-home"></i> Home</a></li>
            
            <li class="menu-category">Visitor Management <i class="fas fa-chevron-down"></i></li>
            <ul class="submenu expanded">
                <li><a href="php/visitor-registration.php"><i class="fas fa-user-plus"></i> Visitor Registration</a></li>
                <li><a href="php/visitor-records.php"><i class="fas fa-clipboard-list"></i> Visitor Records</a></li>
            </ul>
            
            <li class="menu-category">Administration <i class="fas fa-chevron-down"></i></li>
            <ul class="submenu expanded">
                <li><a href="php/employee-management.php"><i class="fas fa-users"></i> Employee Management</a></li>
            </ul>
            
            <li class="menu-category">Future Modules <i class="fas fa-chevron-down"></i></li>
            <ul class="submenu expanded">
                <li><a href="#" class="disabled"><i class="fas fa-box"></i> Item Entry/Exit</a></li>
                <li><a href="#" class="disabled"><i class="fas fa-book"></i> Guest Book</a></li>
            </ul>
        </ul>
    </div>
    
    <div class="main-container">
        <div class="container">
            <main>
                <div class="welcome-banner">
                    <h2>Welcome to the Front Office System</h2>
                    <p>A comprehensive solution for managing visitor registrations and front desk operations at your facility. Streamline the check-in process, maintain visitor records, and enhance workplace security.</p>
                    <a href="php/visitor-registration.php" class="button"><i class="fas fa-arrow-right"></i> Register a New Visitor</a>
                </div>
                
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-value">
                            <?php
                            // Placeholder for actual visitor count
                            echo "25";
                            ?>
                        </div>
                        <div class="stat-label">Visitors Today</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="stat-value">
                            <?php
                            // Placeholder for actual meeting count
                            echo "12";
                            ?>
                        </div>
                        <div class="stat-label">Active Meetings</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="stat-value">
                            <?php
                            // Placeholder for employee count
                            echo "42";
                            ?>
                        </div>
                        <div class="stat-label">Employees</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-value" id="current-time">--:--</div>
                        <div class="stat-label">Current Time</div>
                    </div>
                </div>
                
                <h2>Quick Actions</h2>
                <div class="quick-actions">
                    <a href="php/visitor-registration.php" class="quick-action-item">
                        <div class="quick-action-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="quick-action-label">Register Visitor</div>
                    </a>
                    
                    <a href="php/visitor-records.php" class="quick-action-item">
                        <div class="quick-action-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <div class="quick-action-label">Find Visitor</div>
                    </a>
                    
                    <a href="php/employee-management.php" class="quick-action-item">
                        <div class="quick-action-icon">
                            <i class="fas fa-user-edit"></i>
                        </div>
                        <div class="quick-action-label">Manage Employees</div>
                    </a>
                    
                    <a href="php/visitor-records.php?filter=today" class="quick-action-item">
                        <div class="quick-action-icon">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <div class="quick-action-label">Today's Log</div>
                    </a>
                </div>
                
                <h2>System Features</h2>
                <div class="intro-text">
                    <p>This Front Office System provides a comprehensive solution for managing visitor registrations and related front desk operations. It's designed to be simple, efficient, and user-friendly.</p>
                </div>
                
                <div class="module-cards">
                    <div class="card">
                        <i class="fas fa-user-plus"></i>
                        <h3>Visitor Registration</h3>
                        <p>Register new visitors entering the building with complete information tracking and badge printing.</p>
                        <a href="php/visitor-registration.php" class="button">Go to Registration</a>
                    </div>
                    
                    <div class="card">
                        <i class="fas fa-clipboard-list"></i>
                        <h3>Visitor Records</h3>
                        <p>View and manage all visitor records with powerful filtering and search capabilities.</p>
                        <a href="php/visitor-records.php" class="button">View Records</a>
                    </div>
                    
                    <div class="card">
                        <i class="fas fa-users"></i>
                        <h3>Employee Management</h3>
                        <p>Add, edit, and manage employees that visitors can meet with including departments and availability.</p>
                        <a href="php/employee-management.php" class="button">Manage Employees</a>
                    </div>
                    
                    <div class="card card-disabled">
                        <i class="fas fa-box"></i>
                        <h3>Item Entry/Exit</h3>
                        <p>Track items brought into and out of the building by visitors with security check capabilities.</p>
                        <a href="#" class="button button-secondary">Coming Soon</a>
                    </div>
                    
                    <div class="card card-disabled">
                        <i class="fas fa-book"></i>
                        <h3>Guest Book</h3>
                        <p>Digital guest book for visitors to leave comments and feedback for continuous service improvement.</p>
                        <a href="#" class="button button-secondary">Coming Soon</a>
                    </div>
                </div>
            </main>
            
            <footer>
                <p>&copy; <?php echo date('Y'); ?> Front Office System | Version 1.0</p>
            </footer>
        </div>
    </div>
    
    <script src="js/script.js"></script>
    <script>
    // Update current time every second
    function updateCurrentTime() {
        const timeElement = document.getElementById('current-time');
        const now = new Date();
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        timeElement.textContent = `${hours}:${minutes}`;
    }
    
    // Initial call and set interval
    updateCurrentTime();
    setInterval(updateCurrentTime, 60000);
    
    // Automatically expand all submenus for better visibility on home page
    document.addEventListener('DOMContentLoaded', function() {
        const submenus = document.querySelectorAll('.submenu');
        const menuCategories = document.querySelectorAll('.menu-category');
        
        menuCategories.forEach((category, index) => {
            category.classList.add('expanded');
        });
    });
    </script>
</body>
</html>