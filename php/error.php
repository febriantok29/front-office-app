<?php
/**
 * Front Office System - Error Page
 * 
 * Displays error messages to users
 */

// Start the session
session_start();

// Get error message from session
$errorMessage = $_SESSION['error_message'] ?? 'An unknown error occurred.';
$errorCode = $_SESSION['error_code'] ?? 500;

// Clear session error data
unset($_SESSION['error_message']);
unset($_SESSION['error_code']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error - Front Office System</title>
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
                    <ul class="submenu">
                        <li><a href="employee-management.php">Employee Management</a></li>
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
            <div class="error-container">
                <h2>Error</h2>
                
                <div class="error-message large">
                    <p><?php echo htmlspecialchars($errorMessage); ?></p>
                    <?php if (isset($errorCode)): ?>
                        <p class="error-code">Error Code: <?php echo $errorCode; ?></p>
                    <?php endif; ?>
                </div>
                
                <div class="actions">
                    <a href="../index.php" class="button">Return to Home</a>
                    <button class="button button-secondary" onclick="window.history.back();">Go Back</button>
                </div>
            </div>
        </main>
        
        <footer>
            <p>&copy; <?php echo date('Y'); ?> Front Office System | Educational Project</p>
        </footer>
    </div>
    
    <script src="../js/script.js"></script>
</body>
</html>