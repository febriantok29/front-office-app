<?php
/**
 * Sidebar Menu Partial
 */
$config = require CONFIG_PATH . '/config.php';
$currentUrl = $_SERVER['REQUEST_URI'];
?>
<ul class="sidebar-menu">
    <li><a href="/" class="<?= $currentUrl == '/' ? 'active' : '' ?>"><i class="fas fa-home"></i> Beranda</a></li>
    
    <li class="menu-category">Manajemen Pengunjung <i class="fas fa-chevron-down"></i></li>
    <ul class="submenu expanded">
        <li><a href="/visitors/register" class="<?= strpos($currentUrl, '/visitors/register') !== false ? 'active' : '' ?>"><i class="fas fa-user-plus"></i> Pendaftaran Pengunjung</a></li>
        <li><a href="/visitors/records" class="<?= strpos($currentUrl, '/visitors/records') !== false ? 'active' : '' ?>"><i class="fas fa-clipboard-list"></i> Catatan Pengunjung</a></li>
    </ul>
    
    <li class="menu-category">Administrasi <i class="fas fa-chevron-down"></i></li>
    <ul class="submenu expanded">
        <li><a href="/employees" class="<?= strpos($currentUrl, '/employees') !== false ? 'active' : '' ?>"><i class="fas fa-users"></i> Manajemen Karyawan</a></li>
    </ul>
    
    <li class="menu-category">Modul Mendatang <i class="fas fa-chevron-down"></i></li>
    <ul class="submenu expanded">
        <li><a href="#" class="disabled"><i class="fas fa-box"></i> Masuk/Keluar Barang</a></li>
        <li><a href="#" class="disabled"><i class="fas fa-book"></i> Buku Tamu</a></li>
    </ul>
</ul>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuCategories = document.querySelectorAll('.menu-category');
    
    menuCategories.forEach(category => {
        category.addEventListener('click', function() {
            this.classList.toggle('expanded');
            const submenu = this.nextElementSibling;
            submenu.classList.toggle('expanded');
        });
    });
});
</script>