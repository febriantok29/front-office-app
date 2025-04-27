<?php
/**
 * Front Office System - Manajemen Karyawan
 * 
 * Menampilkan semua karyawan dan menyediakan opsi pengelolaan
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
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Karyawan - Sistem Front Office</title>
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
                <h2>Manajemen Karyawan</h2>
                
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
                    <a href="employee-add.php" class="button">Tambah Karyawan Baru</a>
                </div>
                
                <div class="search-filter">
                    <input type="text" id="employeeSearch" placeholder="Cari karyawan..." class="search-input">
                </div>
                
                <?php if (empty($employees)): ?>
                    <p class="info-message">Tidak ada karyawan ditemukan dalam sistem.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table id="employeeTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Departemen</th>
                                    <th>Status</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($employees as $emp): ?>
                                <tr>
                                    <td><?php echo $emp['id']; ?></td>
                                    <td><?php echo htmlspecialchars($emp['name']); ?></td>
                                    <td><?php echo htmlspecialchars($emp['department']); ?></td>
                                    <td><?php echo $emp['is_active'] ? '<span class="status-active">Aktif</span>' : '<span class="status-inactive">Tidak Aktif</span>'; ?></td>
                                    <td><?php echo date('d M Y', strtotime($emp['created_at'])); ?></td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="employee-edit.php?id=<?php echo $emp['id']; ?>" class="button button-small">Edit</a>
                                            <a href="employee-toggle-status.php?id=<?php echo $emp['id']; ?>&status=<?php echo $emp['is_active'] ? '0' : '1'; ?>" 
                                               class="button button-small button-secondary" 
                                               onclick="return confirm('<?php echo $emp['is_active'] ? 'Nonaktifkan' : 'Aktifkan'; ?> karyawan ini?')">
                                                <?php echo $emp['is_active'] ? 'Nonaktifkan' : 'Aktifkan'; ?>
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
                <p>&copy; <?php echo date('Y'); ?> Sistem Front Office | Versi 1.0</p>
            </footer>
        </div>
    </div>
    
    <script src="../js/employees.js"></script>
    <script src="../js/script.js"></script>
</body>
</html>