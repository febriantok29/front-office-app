# Pengenalan Front Office App

## Tentang Aplikasi

Front Office App adalah aplikasi berbasis web yang dirancang untuk membantu manajemen front office di berbagai jenis organisasi seperti perusahaan, institusi pendidikan, atau instansi pemerintah. Aplikasi ini menyediakan solusi terpadu untuk pengelolaan pengunjung dan karyawan dengan antarmuka modern dan responsif.

## Tujuan

Aplikasi ini dibuat dengan tujuan:
- Mengotomatisasi proses registrasi pengunjung untuk meningkatkan efisiensi
- Menyediakan sistem manajemen karyawan yang terintegrasi dan mudah digunakan
- Memudahkan pelacakan kunjungan dengan fitur pencarian dan filter yang canggih
- Meningkatkan keamanan dengan pencatatan digital yang akurat dan terstruktur
- Menyediakan laporan dan analitik untuk pengambilan keputusan yang lebih baik
- Menyederhanakan alur kerja front office dengan antarmuka yang intuitif

## Fitur Utama

### Manajemen Pengunjung
- Registrasi pengunjung baru dengan validasi data otomatis
- Pencatatan tujuan kunjungan dan karyawan yang dikunjungi
- Pengelolaan riwayat kunjungan dengan filter tanggal dan pencarian
- Pencarian data pengunjung berdasarkan berbagai kriteria
- Ekspor data pengunjung ke format spreadsheet (fitur akan datang)

### Manajemen Karyawan
- Pendaftaran karyawan baru dengan informasi departemen dan kontak
- Edit informasi karyawan dengan antarmuka yang mudah digunakan
- Pengaktifan/penonaktifan status karyawan tanpa menghapus data
- Pencarian data karyawan berdasarkan nama, departemen, dll.
- Pengelolaan daftar karyawan yang dapat dikunjungi

### Dashboard & Analitik
- Tampilan statistik kunjungan harian, mingguan, dan bulanan
- Grafik distribusi pengunjung berdasarkan departemen yang dikunjungi
- Indikator performa dengan metrik pengunjung aktif
- Widget aksi cepat untuk tugas-tugas yang sering dilakukan

## Teknologi yang Digunakan

Front Office App dibangun menggunakan teknologi berikut:
- **Backend**: PHP 7.4+ dengan arsitektur MVC yang modular
- **Database**: MySQL 5.7+ dengan query teroptimasi dan prepared statements
- **Frontend**: HTML5, CSS3, JavaScript modern (ES6+)
- **Library JavaScript**: Vanilla JavaScript untuk DOM manipulation dan AJAX
- **Framework CSS**: Custom CSS modules dengan sistem grid yang responsif
- **Icons & Fonts**: Font Awesome 6 dan Inter font family
- **Security**: CSRF protection, password hashing, dan parameterized queries

## Target Pengguna

Aplikasi ini dirancang untuk digunakan oleh:
- **Resepsionis dan petugas front office**: Untuk mendaftarkan pengunjung dan mengelola kunjungan
- **Administrator sistem**: Untuk mengelola karyawan dan pengaturan sistem
- **Manajer dan supervisor**: Untuk melihat laporan dan analitik kunjungan
- **Petugas keamanan**: Untuk memverifikasi pengunjung dan maksud kunjungan

## Peta Jalan (Roadmap)

Versi mendatang akan menyertakan fitur-fitur berikut:
- Modul manajemen barang masuk/keluar
- Fitur buku tamu digital
- Sistem notifikasi email/SMS
- Integrasi dengan sistem ID card/badge elektronik
- Aplikasi mobile untuk registrasi mandiri oleh pengunjung

Untuk informasi lebih lanjut tentang cara menginstal dan menggunakan aplikasi ini, silakan lanjutkan ke bagian [Instalasi](./installation.md) dan [Fitur Utama](./main-features.md).