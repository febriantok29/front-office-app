<?php
/**
 * Dashboard index view
 */
?>

<div class="welcome-banner">
    <h2>Selamat Datang di Sistem Front Office</h2>
    <p>Solusi komprehensif untuk mengelola pendaftaran pengunjung dan operasi front desk di fasilitas Anda. Perlancar proses check-in, kelola catatan pengunjung, dan tingkatkan keamanan tempat kerja.</p>
    <a href="/visitors/register" class="button"><i class="fas fa-arrow-right"></i> Daftarkan Pengunjung Baru</a>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-value">
            <?= $visitors_today ?>
        </div>
        <div class="stat-label">Pengunjung Hari Ini</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-calendar-check"></i>
        </div>
        <div class="stat-value">
            <?= $active_meetings ?>
        </div>
        <div class="stat-label">Pertemuan Aktif</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-user-tie"></i>
        </div>
        <div class="stat-value">
            <?= $employee_count ?>
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
    <a href="/visitors/register" class="quick-action-item">
        <div class="quick-action-icon">
            <i class="fas fa-user-plus"></i>
        </div>
        <div class="quick-action-label">Daftar Pengunjung</div>
    </a>
    
    <a href="/visitors/records" class="quick-action-item">
        <div class="quick-action-icon">
            <i class="fas fa-search"></i>
        </div>
        <div class="quick-action-label">Cari Pengunjung</div>
    </a>
    
    <a href="/employees" class="quick-action-item">
        <div class="quick-action-icon">
            <i class="fas fa-user-edit"></i>
        </div>
        <div class="quick-action-label">Kelola Karyawan</div>
    </a>
    
    <a href="/visitors/records?filter=today" class="quick-action-item">
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
        <a href="/visitors/register" class="button">Ke Pendaftaran</a>
    </div>
    
    <div class="card">
        <i class="fas fa-clipboard-list"></i>
        <h3>Catatan Pengunjung</h3>
        <p>Lihat dan kelola semua catatan pengunjung dengan kemampuan filter dan pencarian yang canggih.</p>
        <a href="/visitors/records" class="button">Lihat Catatan</a>
    </div>
    
    <div class="card">
        <i class="fas fa-users"></i>
        <h3>Manajemen Karyawan</h3>
        <p>Tambah, edit, dan kelola karyawan yang dapat ditemui pengunjung termasuk departemen dan ketersediaannya.</p>
        <a href="/employees" class="button">Kelola Karyawan</a>
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
</script>