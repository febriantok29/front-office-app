<?php
/**
 * Sidebar Navigation Component
 * 
 * Modular sidebar component to be included in all pages
 * This simplifies maintenance and ensures consistency across the application
 */

// Get the current page filename
$currentPage = basename($_SERVER['PHP_SELF']);

// Helper function to determine if a menu item should be active
function isMenuActive($pageNames) {
    global $currentPage;
    
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

// Helper function to determine if a menu category should be expanded
function shouldExpandCategory($pageNames) {
    $isActive = isMenuActive($pageNames);
    
    // Home page has all expanded by default
    if (basename($_SERVER['PHP_SELF']) === 'index.php') {
        return true;
    }
    
    return $isActive;
}

// Define page groups for menu categories
$visitorPages = ['visitor-registration.php', 'visitor-records.php', 'visitor_list.php'];
$adminPages = ['employee-management.php', 'employee-add.php', 'employee-edit.php', 'employee-toggle-status.php'];
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
        <li><a href="../index.php" class="<?= basename($_SERVER['PHP_SELF']) === 'index.php' ? 'active' : '' ?>"><i class="fas fa-home"></i> Beranda</a></li>
        
        <li class="menu-category <?= shouldExpandCategory($visitorPages) ? 'expanded' : '' ?>">Manajemen Pengunjung <i class="fas fa-chevron-down"></i></li>
        <ul class="submenu <?= shouldExpandCategory($visitorPages) ? 'expanded' : '' ?>">
            <li><a href="visitor-registration.php" class="<?= isMenuActive('visitor-registration.php') ? 'active' : '' ?>"><i class="fas fa-user-plus"></i> Pendaftaran Pengunjung</a></li>
            <li><a href="visitor-records.php" class="<?= isMenuActive('visitor-records.php') ? 'active' : '' ?>"><i class="fas fa-clipboard-list"></i> Catatan Pengunjung</a></li>
        </ul>
        
        <li class="menu-category <?= shouldExpandCategory($adminPages) ? 'expanded' : '' ?>">Administrasi <i class="fas fa-chevron-down"></i></li>
        <ul class="submenu <?= shouldExpandCategory($adminPages) ? 'expanded' : '' ?>">
            <li><a href="employee-management.php" class="<?= isMenuActive($adminPages) ? 'active' : '' ?>"><i class="fas fa-users"></i> Manajemen Karyawan</a></li>
        </ul>
        
        <li class="menu-category">Modul Mendatang <i class="fas fa-chevron-down"></i></li>
        <ul class="submenu">
            <li><a href="#" class="disabled"><i class="fas fa-box"></i> Masuk/Keluar Barang</a></li>
            <li><a href="#" class="disabled"><i class="fas fa-book"></i> Buku Tamu</a></li>
        </ul>
    </ul>
</div>