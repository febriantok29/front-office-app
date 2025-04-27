<?php
/**
 * Visitor List Page
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
</head>
<body>
    <div class="container">
        <header>
            <h1>Front Office System</h1>
            <nav>
                <ul>
                    <li><a href="../index.php">Visitor Registration</a></li>
                    <li><a href="visitor_list.php" class="active">Visitor Records</a></li>
                </ul>
            </nav>
        </header>
        
        <main>
            <h2>Visitor Records</h2>
            
            <?php if (empty($visitors)): ?>
                <p class="info-message">No visitor records found.</p>
            <?php else: ?>
                <div class="table-responsive">
                    <table>
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
            <?php endif; ?>
            
            <div class="actions">
                <a href="../index.php" class="button">Back to Registration</a>
            </div>
        </main>
        
        <footer>
            <p>&copy; <?php echo date('Y'); ?> Front Office System | Educational Project</p>
        </footer>
    </div>
</body>
</html>