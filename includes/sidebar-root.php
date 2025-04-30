<?php
/**
 * Sidebar Navigation Component for Root Directory
 * 
 * Modular sidebar component for the index.php in the root directory
 * This version has adjusted paths for the root-level file
 */

// Helper function to determine if a menu item should be active
function isMenuActive($pageNames) {
    $currentPage = basename($_SERVER['PHP_SELF']);
    
    if (!is_array($pageNames)) {
        $pageNames = [$pageNames];
    }
    
    foreach ($pageNames as $pageName) {
        if ($currentPage === $pageName) {
            return true;
        }
    }
    
    return false;
}
?>

<!-- Sidebar Toggle Button -->
<button class="sidebar-toggle">
    <i class="fas fa-bars"></i>
</button>

<div class="sidebar">
    <div class="sidebar-header">
        <h1>Sistem Front Office</h1>
    </div>
    <ul class="sidebar-menu">
        <li><a href="index.php" class="<?= isMenuActive('index.php') ? 'active' : '' ?>"><i class="fas fa-home"></i> Beranda</a></li>
        
        <li class="menu-category expanded">Manajemen Pengunjung <i class="fas fa-chevron-down"></i></li>
        <ul class="submenu expanded">
            <li><a href="php/visitor-registration.php"><i class="fas fa-user-plus"></i> Pendaftaran Pengunjung</a></li>
            <li><a href="php/visitor-records.php"><i class="fas fa-clipboard-list"></i> Catatan Pengunjung</a></li>
        </ul>
        
        <li class="menu-category expanded">Administrasi <i class="fas fa-chevron-down"></i></li>
        <ul class="submenu expanded">
            <li><a href="php/employee-management.php"><i class="fas fa-users"></i> Manajemen Karyawan</a></li>
        </ul>
        
        <li class="menu-category expanded">Modul Mendatang <i class="fas fa-chevron-down"></i></li>
        <ul class="submenu expanded">
            <li><a href="#" class="disabled"><i class="fas fa-box"></i> Masuk/Keluar Barang</a></li>
            <li><a href="#" class="disabled"><i class="fas fa-book"></i> Buku Tamu</a></li>
        </ul>
    </ul>
</div>