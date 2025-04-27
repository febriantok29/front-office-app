<?php
/**
 * Front Office System - Catatan Pengunjung
 * 
 * Menampilkan semua pengunjung terdaftar dalam tabel
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
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catatan Pengunjung - Sistem Front Office</title>
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
            
            <li class="menu-category expanded">Manajemen Pengunjung <i class="fas fa-chevron-down"></i></li>
            <ul class="submenu expanded">
                <li><a href="visitor-registration.php"><i class="fas fa-user-plus"></i> Pendaftaran Pengunjung</a></li>
                <li><a href="visitor-records.php" class="active"><i class="fas fa-clipboard-list"></i> Catatan Pengunjung</a></li>
            </ul>
            
            <li class="menu-category">Administrasi <i class="fas fa-chevron-down"></i></li>
            <ul class="submenu">
                <li><a href="employee-management.php"><i class="fas fa-users"></i> Manajemen Karyawan</a></li>
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
                <h2>Catatan Pengunjung</h2>
                
                <?php if (empty($visitors)): ?>
                    <p class="info-message">Tidak ada catatan pengunjung ditemukan.</p>
                <?php else: ?>
                    <div class="search-filter">
                        <input type="text" id="visitorSearch" placeholder="Cari pengunjung..." class="search-input">
                        <!-- Future expansion: Add date range filters and more advanced search options -->
                        <!-- 
                        <div class="filter-options">
                            <label for="dateFrom">Dari:</label>
                            <input type="date" id="dateFrom">
                            <label for="dateTo">Sampai:</label>
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
                                    <th>Nama Lengkap</th>
                                    <th>Nomor Kartu Identitas</th>
                                    <th>Nomor Telepon</th>
                                    <th>Email</th>
                                    <th>Karyawan yang Dikunjungi</th>
                                    <th>Tujuan</th>
                                    <th>Waktu Kunjungan</th>
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
                                    <td><?php echo date('d M Y H:i', strtotime($visitor['visit_timestamp'])); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Future expansion: Add pagination controls here -->
                    <!--
                    <div class="pagination">
                        <button class="pagination-btn">Sebelumnya</button>
                        <span class="pagination-info">Halaman 1 dari 5</span>
                        <button class="pagination-btn">Berikutnya</button>
                    </div>
                    -->
                <?php endif; ?>
                
                <div class="actions">
                    <a href="visitor-registration.php" class="button">Daftarkan Pengunjung Baru</a>
                    <!-- Future expansion: Add export/print buttons here -->
                    <!--
                    <button class="button button-secondary">Ekspor ke CSV</button>
                    <button class="button button-secondary">Cetak Catatan</button>
                    -->
                </div>
            </main>
            
            <footer>
                <p>&copy; <?php echo date('Y'); ?> Sistem Front Office | Versi 1.0</p>
            </footer>
        </div>
    </div>
    
    <script src="../js/visitors.js"></script>
    <script src="../js/script.js"></script>
</body>
</html>