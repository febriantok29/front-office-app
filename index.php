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
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Front Office</title>
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
            <h1>Sistem Front Office</h1>
        </div>
        <ul class="sidebar-menu">
            <li><a href="index.php" class="active"><i class="fas fa-home"></i> Beranda</a></li>
            
            <li class="menu-category">Manajemen Pengunjung <i class="fas fa-chevron-down"></i></li>
            <ul class="submenu expanded">
                <li><a href="php/visitor-registration.php"><i class="fas fa-user-plus"></i> Pendaftaran Pengunjung</a></li>
                <li><a href="php/visitor-records.php"><i class="fas fa-clipboard-list"></i> Catatan Pengunjung</a></li>
            </ul>
            
            <li class="menu-category">Administrasi <i class="fas fa-chevron-down"></i></li>
            <ul class="submenu expanded">
                <li><a href="php/employee-management.php"><i class="fas fa-users"></i> Manajemen Karyawan</a></li>
            </ul>
            
            <li class="menu-category">Modul Mendatang <i class="fas fa-chevron-down"></i></li>
            <ul class="submenu expanded">
                <li><a href="#" class="disabled"><i class="fas fa-box"></i> Masuk/Keluar Barang</a></li>
                <li><a href="#" class="disabled"><i class="fas fa-book"></i> Buku Tamu</a></li>
            </ul>
        </ul>
    </div>
    
    <div class="main-container">
        <div class="container">
            <main>
                <div class="welcome-banner">
                    <h2>Selamat Datang di Sistem Front Office</h2>
                    <p>Solusi komprehensif untuk mengelola pendaftaran pengunjung dan operasi front desk di fasilitas Anda. Perlancar proses check-in, kelola catatan pengunjung, dan tingkatkan keamanan tempat kerja.</p>
                    <a href="php/visitor-registration.php" class="button"><i class="fas fa-arrow-right"></i> Daftarkan Pengunjung Baru</a>
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
                        <div class="stat-label">Pengunjung Hari Ini</div>
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
                        <div class="stat-label">Pertemuan Aktif</div>
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
                        <div class="stat-label">Karyawan</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-value" id="current-time">--:--</div>
                        <div class="stat-label">Waktu Saat Ini</div>
                    </div>
                </div>
                
                <h2>Aksi Cepat</h2>
                <div class="quick-actions">
                    <a href="php/visitor-registration.php" class="quick-action-item">
                        <div class="quick-action-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="quick-action-label">Daftar Pengunjung</div>
                    </a>
                    
                    <a href="php/visitor-records.php" class="quick-action-item">
                        <div class="quick-action-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <div class="quick-action-label">Cari Pengunjung</div>
                    </a>
                    
                    <a href="php/employee-management.php" class="quick-action-item">
                        <div class="quick-action-icon">
                            <i class="fas fa-user-edit"></i>
                        </div>
                        <div class="quick-action-label">Kelola Karyawan</div>
                    </a>
                    
                    <a href="php/visitor-records.php?filter=today" class="quick-action-item">
                        <div class="quick-action-icon">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <div class="quick-action-label">Log Hari Ini</div>
                    </a>
                </div>
                
                <h2>Fitur Sistem</h2>
                <div class="intro-text">
                    <p>Sistem Front Office ini menyediakan solusi komprehensif untuk mengelola pendaftaran pengunjung dan operasi front desk terkait. Dirancang untuk sederhana, efisien, dan ramah pengguna.</p>
                </div>
                
                <div class="module-cards">
                    <div class="card">
                        <i class="fas fa-user-plus"></i>
                        <h3>Pendaftaran Pengunjung</h3>
                        <p>Daftarkan pengunjung baru yang memasuki gedung dengan pelacakan informasi lengkap dan pencetakan kartu tanda pengenal.</p>
                        <a href="php/visitor-registration.php" class="button">Ke Pendaftaran</a>
                    </div>
                    
                    <div class="card">
                        <i class="fas fa-clipboard-list"></i>
                        <h3>Catatan Pengunjung</h3>
                        <p>Lihat dan kelola semua catatan pengunjung dengan kemampuan filter dan pencarian yang canggih.</p>
                        <a href="php/visitor-records.php" class="button">Lihat Catatan</a>
                    </div>
                    
                    <div class="card">
                        <i class="fas fa-users"></i>
                        <h3>Manajemen Karyawan</h3>
                        <p>Tambah, edit, dan kelola karyawan yang dapat ditemui pengunjung termasuk departemen dan ketersediaannya.</p>
                        <a href="php/employee-management.php" class="button">Kelola Karyawan</a>
                    </div>
                    
                    <div class="card card-disabled">
                        <i class="fas fa-box"></i>
                        <h3>Masuk/Keluar Barang</h3>
                        <p>Lacak barang yang dibawa masuk dan keluar gedung oleh pengunjung dengan kemampuan pemeriksaan keamanan.</p>
                        <a href="#" class="button button-secondary">Segera Hadir</a>
                    </div>
                    
                    <div class="card card-disabled">
                        <i class="fas fa-book"></i>
                        <h3>Buku Tamu</h3>
                        <p>Buku tamu digital untuk pengunjung meninggalkan komentar dan umpan balik untuk peningkatan layanan berkelanjutan.</p>
                        <a href="#" class="button button-secondary">Segera Hadir</a>
                    </div>
                </div>
            </main>
            
            <footer>
                <p>&copy; <?php echo date('Y'); ?> Sistem Front Office | Versi 1.0</p>
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