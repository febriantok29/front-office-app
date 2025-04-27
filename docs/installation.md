# Panduan Instalasi Front Office App

Dokumen ini berisi langkah-langkah untuk menginstal dan mengkonfigurasi Front Office App di lingkungan pengembangan lokal Anda.

## Prasyarat

Sebelum memulai, pastikan sistem Anda telah memenuhi prasyarat berikut:

- PHP 7.4 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Web server (Apache/Nginx)
- Git (opsional, untuk clone repository)
- Browser web modern (Chrome, Firefox, Safari, Edge)

## Langkah-langkah Instalasi

### 1. Menyiapkan Repository

```bash
# Clone repository (jika menggunakan Git)
git clone https://github.com/febriantok29/front-office-app.git

# Atau ekstrak file zip jika Anda mengunduh sebagai arsip
unzip front-office-app.zip
```

### 2. Konfigurasi Database

1. Buat database baru di MySQL:

```sql
CREATE DATABASE front_office_db;
```

2. Import skema database dari file `db/setup.sql`:

```bash
mysql -u username -p front_office_db < db/setup.sql
```

3. Konfigurasi koneksi database:
   - Buka file `includes/Database.php`
   - Sesuaikan parameter koneksi database (host, username, password, dbname)

### 3. Konfigurasi Web Server

#### Untuk Apache:

1. Pastikan mod_rewrite diaktifkan
2. Buat atau edit file `.htaccess` di root direktori:

```apache
RewriteEngine On
RewriteBase /
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php?url=$1 [QSA,L]
```

#### Untuk Nginx:

Tambahkan konfigurasi berikut di file konfigurasi server Anda:

```nginx
location / {
    try_files $uri $uri/ /index.php?url=$uri&$args;
}
```

### 4. Izin File

Pastikan direktori dan file tertentu memiliki izin yang tepat:

```bash
# Jika menggunakan lingkungan Linux/Mac
chmod -R 755 app/
chmod -R 755 includes/
chmod -R 755 php/
```

### 5. Menjalankan Aplikasi

1. Arahkan browser Anda ke aplikasi:
   - Jika menggunakan server lokal: `http://localhost/front-office-app/`
   - Jika menggunakan virtual host: `http://front-office-app.local/`

2. Login dengan kredensial default:
   - Username: admin
   - Password: admin123

   **Penting**: Segera ubah password default setelah login pertama!

## Troubleshooting Umum

### Masalah Koneksi Database

Jika aplikasi tidak dapat terhubung ke database:
- Periksa apakah server MySQL berjalan
- Verifikasi kredensial database di `includes/Database.php`
- Pastikan database `front_office_db` telah dibuat

### Masalah Izin File

Jika ada kesalahan terkait izin file:
- Pastikan pengguna web server (www-data, apache, dll.) memiliki izin yang tepat untuk direktori aplikasi
- Periksa log error web server untuk detail lebih lanjut

### Error 500 Internal Server

- Periksa error log PHP dan web server
- Verifikasi bahwa semua ekstensi PHP yang diperlukan diaktifkan

## Pengembangan Lanjutan

Untuk petunjuk lebih lanjut tentang pengembangan aplikasi, silakan merujuk ke [Panduan Pengembangan](./development-guide.md).