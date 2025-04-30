<?php
/**
 * Front Office System - Tambah Karyawan
 * 
 * Formulir untuk menambahkan karyawan baru
 */

// Start the session
session_start();

// Get any form errors or form data from session (if coming from a failed submission)
$formErrors = $_SESSION['form_errors'] ?? [];
$formData = $_SESSION['form_data'] ?? [];

// Clear session variables
unset($_SESSION['form_errors']);
unset($_SESSION['form_data']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Karyawan - Sistem Front Office</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Include the sidebar -->
    <?php include 'includes/sidebar.php'; ?>
    
    <div class="main-container">
        <div class="container">
            <main>
                <h2>Tambah Karyawan Baru</h2>
                
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
                    <input type="hidden" name="action" value="add">
                    
                    <div class="form-group">
                        <label for="name">Nama Lengkap: <span class="required">*</span></label>
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($formData['name'] ?? ''); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="department">Departemen: <span class="required">*</span></label>
                        <input type="text" id="department" name="department" value="<?php echo htmlspecialchars($formData['department'] ?? ''); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="is_active">Status:</label>
                        <select id="is_active" name="is_active">
                            <option value="1" <?php echo (isset($formData['is_active']) && $formData['is_active'] == 1) ? 'selected' : ''; ?>>Aktif</option>
                            <option value="0" <?php echo (isset($formData['is_active']) && $formData['is_active'] == 0) ? 'selected' : ''; ?>>Tidak Aktif</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="button">Tambah Karyawan</button>
                        <a href="employee-management.php" class="button button-secondary">Batal</a>
                    </div>
                </form>
            </main>
            
            <footer>
                <p>&copy; <?php echo date('Y'); ?> Sistem Front Office | Versi 1.0</p>
            </footer>
        </div>
    </div>
    
    <script src="../js/validation.js"></script>
    <script src="../js/employees.js"></script>
    <script src="../js/script.js"></script>
</body>
</html>