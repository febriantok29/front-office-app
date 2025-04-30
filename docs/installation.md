# Panduan Instalasi Front Office App

Dokumen ini berisi langkah-langkah komprehensif untuk menginstal dan mengkonfigurasi Front Office App di lingkungan pengembangan lokal Anda.

## Prasyarat

Sebelum memulai, pastikan sistem Anda telah memenuhi prasyarat berikut:

- PHP 7.4 atau lebih tinggi dengan ekstensi berikut:
  - PDO dan PDO_MySQL
  - mbstring
  - json
  - session
- MySQL 5.7 atau lebih tinggi
- Web server (Apache/Nginx)
- Git (opsional, untuk clone repository)
- Browser web modern (Chrome, Firefox, Safari, Edge)
- Composer (opsional, untuk pengembangan)

## Langkah-langkah Instalasi

### 1. Menyiapkan Repository

```bash
# Clone repository (jika menggunakan Git)
git clone https://github.com/febriantok29/front-office-app.git

# Atau ekstrak file zip jika Anda mengunduh sebagai arsip
unzip front-office-app.zip

# Masuk ke direktori aplikasi
cd front-office-app
```

### 2. Konfigurasi Database

#### 2.1 Membuat Database

Buat database baru bernama `front_office_db` dengan menggunakan tool seperti phpMyAdmin atau command line:

```bash
mysql -u root -p
CREATE DATABASE front_office_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

#### 2.2 Import Struktur Database

Import struktur database dan data awal dengan menjalankan script setup.sql:

```bash
mysql -u root -p front_office_db < db/setup.sql
```

#### 2.3 Konfigurasi Koneksi Database

Untuk mengkonfigurasi koneksi database:

1. Buka file `app/config/database.php`
2. Sesuaikan pengaturan berikut:
   ```php
   return [
       'host' => 'localhost',      // Hostname server database
       'port' => '3306',           // Port database
       'username' => 'root',       // Username database
       'password' => '',           // Password database
       'dbname' => 'front_office_db', // Nama database
       'charset' => 'utf8mb4',     // Charset database
       'options' => [
           PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
           PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
           PDO::ATTR_EMULATE_PREPARES => false
       ]
   ];
   ```

### 3. Konfigurasi Web Server

#### Untuk Apache:

1. Pastikan mod_rewrite diaktifkan
2. Buat atau edit file `.htaccess` di root direktori:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /front-office-app/
    
    # Jika file atau direktori tidak ada, lanjutkan ke aturan berikutnya
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    
    # Arahkan semua permintaan ke index.php dengan parameter URL
    RewriteRule ^(.*)$ index.php?url=$1 [QSA,L]
</IfModule>

# Pengaturan PHP (opsional)
<IfModule mod_php7.c>
    php_value upload_max_filesize 10M
    php_value post_max_size 10M
    php_value max_execution_time 300
    php_value max_input_time 300
</IfModule>
```

#### Untuk Nginx:

Tambahkan konfigurasi berikut di file konfigurasi server Anda:

```nginx
server {
    listen 80;
    server_name front-office-app.local;
    root /path/to/front-office-app;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?url=$uri&$args;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

### 4. Izin File dan Direktori

Pastikan direktori dan file tertentu memiliki izin yang tepat:

```bash
# Jika menggunakan lingkungan Linux/Mac
chmod -R 755 app/
chmod -R 755 php/
chmod -R 644 css/ js/
```

Jika menggunakan Windows, pastikan aplikasi web server (misalnya Apache/XAMPP) memiliki akses baca dan tulis ke direktori-direktori tersebut.

### 5. Konfigurasi Aplikasi

Buka file `app/config/config.php` dan sesuaikan konfigurasi sesuai kebutuhan Anda:

```php
return [
    'app_name' => 'Sistem Front Office',
    'app_version' => '1.0',
    'app_url' => 'http://localhost/front-office-app', // Ubah sesuai URL aplikasi Anda
    'timezone' => 'Asia/Jakarta', // Sesuaikan dengan zona waktu Anda
    'locale' => 'id',
    'debug' => true, // Atur ke false untuk lingkungan produksi
    
    // Konfigurasi fitur
    'features' => [
        'visitor_registration' => true,
        'visitor_records' => true,
        'employee_management' => true,
        'item_tracking' => false, // Akan datang
        'guest_book' => false,    // Akan datang
    ]
];
```

### 6. Menjalankan Aplikasi

1. Arahkan browser Anda ke aplikasi:
   - Jika menggunakan server lokal: `http://localhost/front-office-app/`
   - Jika menggunakan virtual host: `http://front-office-app.local/`

2. Login dengan kredensial default:
   - Username: admin
   - Password: admin123

   **Penting**: Segera ubah password default setelah login pertama!

## Verifikasi Instalasi

Untuk memastikan instalasi berjalan dengan baik, periksa hal-hal berikut:

1. Halaman beranda (dashboard) muncul tanpa error
2. Menu navigasi berfungsi dan mengarah ke halaman yang benar
3. Formulir registrasi pengunjung dapat diakses dan berfungsi
4. Data karyawan muncul pada halaman manajemen karyawan
5. Statistik dasar ditampilkan pada dashboard

## Troubleshooting Umum

### Masalah Koneksi Database

Jika aplikasi tidak dapat terhubung ke database:
- Periksa apakah server MySQL berjalan
- Verifikasi kredensial database di `app/config/database.php`
- Pastikan database `front_office_db` telah dibuat
- Periksa pesan error di log PHP dan web server

### Masalah Izin File

Jika ada kesalahan terkait izin file:
- Pastikan pengguna web server (www-data, apache, dll.) memiliki izin yang tepat untuk direktori aplikasi
- Periksa log error web server untuk detail lebih lanjut
- Pada Windows, pastikan folder tidak dalam mode "read-only"

### Error 500 Internal Server

- Periksa error log PHP dan web server
- Verifikasi bahwa semua ekstensi PHP yang diperlukan diaktifkan
- Pastikan .htaccess diproses dengan benar (jika menggunakan Apache)
- Cek apakah mod_rewrite diaktifkan (untuk Apache)

### Halaman Tidak Ditemukan (404)

- Pastikan pengaturan `app_url` dalam config.php sudah benar
- Periksa konfigurasi rewrite pada web server
- Verifikasi struktur direktori aplikasi

## Pengembangan Lanjutan

Untuk petunjuk lebih lanjut tentang pengembangan aplikasi, silakan merujuk ke [Panduan Pengembangan](./development-guide.md).