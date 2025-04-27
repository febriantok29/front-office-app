<?php
/**
 * Front Office System - Edit Karyawan
 * 
 * Formulir untuk mengedit karyawan yang ada
 */

// Start the session
session_start();

// Include the Employee model
require_once __DIR__ . '/../app/models/Employee.php';

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error_message'] = 'ID karyawan tidak diberikan';
    header('Location: employee-management.php');
    exit;
}

$id = (int)$_GET['id'];

// Get employee data
$employee = new Employee();
$employeeData = $employee->getById($id); // We'll add this method to the Employee model

// If employee not found, redirect back
if (!$employeeData) {
    $_SESSION['error_message'] = 'Karyawan tidak ditemukan';
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
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Karyawan - Sistem Front Office</title>
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
            <h1>Sistem Front Office</h1>
        </div>
        <ul class="sidebar-menu">
            <li><a href="../index.php"><i class="fas fa-home"></i> Beranda</a></li>
            
            <li class="menu-category">Manajemen Pengunjung <i class="fas fa-chevron-down"></i></li>
            <ul class="submenu">
                <li><a href="visitor-registration.php"><i class="fas fa-user-plus"></i> Pendaftaran Pengunjung</a></li>
                <li><a href="visitor-records.php"><i class="fas fa-clipboard-list"></i> Catatan Pengunjung</a></li>
            </ul>
            
            <li class="menu-category expanded">Administrasi <i class="fas fa-chevron-down"></i></li>
            <ul class="submenu expanded">
                <li><a href="employee-management.php" class="active"><i class="fas fa-users"></i> Manajemen Karyawan</a></li>
            </ul>
            
            <li class="menu-category">Modul Mendatang <i class="fas fa-chevron-down"></i></li>
            <ul class="submenu">
                <li><a href="#" class="disabled"><i class="fas fa-box"></i> Masuk/Keluar Barang</a></li>
                <li><a href="#" class="disabled"><i class="fas fa-book"></i> Buku Tamu</a></li>
            </ul>
        </ul>
    </div>
    
    <div class="main-container">
        <div class="container">
            <main>
                <h2>Edit Karyawan</h2>
                
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
                        <button type="submit" class="button">Perbarui Karyawan</button>
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