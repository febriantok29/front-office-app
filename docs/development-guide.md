# Panduan Pengembangan Front Office App

Panduan ini berisi petunjuk dan standar untuk mengembangkan Front Office App. Dokumen ini ditujukan untuk pengembang yang ingin berkontribusi atau memodifikasi proyek ini.

## Lingkungan Pengembangan

### Rekomendasi Setup
- PHP 7.4+ dengan ekstensi PDO untuk MySQL
- Apache/Nginx dengan modul PHP
- MySQL 5.7+ atau MariaDB 10.4+
- Code editor/IDE: Visual Studio Code, PHPStorm, atau Sublime Text
- Browser dengan DevTools: Chrome atau Firefox
- Git untuk version control

### Tools Pengembangan Opsional
- XAMPP/WAMP/MAMP untuk pengembangan lokal
- HeidiSQL/phpMyAdmin untuk manajemen database visual
- Postman untuk pengujian API
- Composer untuk dependensi PHP (jika akan ditambahkan)

## Standar Pengkodean

### PHP
- Ikuti PSR-1 dan PSR-2 untuk standar kode
- Gunakan PHP 7.4+ features (type hints, arrow functions, dll.)
- Semua file PHP harus dimulai dengan `<?php`
- Hindari penggunaan tag penutup `?>` di akhir file
- Gunakan namespace untuk organisasi kode
- Dokumentasikan fungsi dan kelas dengan docblocks

```php
/**
 * Fungsi untuk mendapatkan data karyawan berdasarkan ID
 *
 * @param int $id ID karyawan
 * @return array|null Data karyawan atau null jika tidak ditemukan
 */
function getEmployeeById(int $id): ?array {
    // Implementasi
}
```

### JavaScript
- Gunakan ES6+ syntax
- Gunakan strict mode (`'use strict';`)
- Gunakan camelCase untuk variabel dan fungsi
- Dokumentasikan fungsi dengan JSDoc

```javascript
/**
 * Fungsi untuk validasi form pengunjung
 * @param {Event} event - Form submit event
 * @returns {boolean} - True jika valid, false jika tidak
 */
function validateVisitorForm(event) {
    'use strict';
    // Implementasi
}
```

### CSS
- Ikuti metodologi BEM (Block, Element, Modifier) untuk penamaan kelas
- Gunakan variabel CSS untuk warna dan ukuran yang konsisten
- Struktur sesuai dengan file modular yang telah ada

```css
/* Contoh BEM */
.visitor-card {} /* Block */
.visitor-card__title {} /* Element */
.visitor-card--highlighted {} /* Modifier */
```

## Alur Kerja Pengembangan

### 1. Menambahkan Fitur Baru

1. **Analisis kebutuhan**:
   - Tentukan tujuan fitur dan use case
   - Buat daftar perubahan yang diperlukan

2. **Implementasi database** (jika diperlukan):
   - Perbarui skema database di `db/setup.sql`
   - Buat script migrasi jika diperlukan

3. **Implementasi model**:
   - Tambahkan kelas model baru di `app/models/` atau perbarui yang ada
   - Buat metode CRUD dan validasi yang diperlukan

4. **Implementasi controller**:
   - Tambahkan controller di `app/controllers/` 
   - Gunakan model untuk operasi data

5. **Implementasi view**:
   - Buat file PHP baru di direktori `php/`
   - Pisahkan logika dari presentasi

6. **Frontend**:
   - Tambahkan JavaScript di `js/`
   - Tambahkan CSS di `css/modules/`
   - Pastikan responsif dan dapat diakses

### 2. Memperbaiki Bug

1. **Identifikasi**:
   - Reproduksi bug secara konsisten
   - Isolasi lingkungan terjadinya

2. **Debugging**:
   - Gunakan `error_log()` atau `console.log()` untuk informasi debugging
   - Cek log server dan browser

3. **Perbaikan**:
   - Perbaiki bug dengan perubahan minimal
   - Buat unit test jika mungkin (opsional)

4. **Pengujian**:
   - Verifikasi bahwa bug telah diselesaikan
   - Pastikan tidak ada regresi

## Fitur Utama dan Cara Mengembangkannya

### 1. Sistem Manajemen Pengunjung

Komponen terkait:
- `app/models/Visitor.php`
- `php/visitor-registration.php`
- `php/visitor-records.php`
- `php/visitor_list.php`
- `js/visitors.js`

Untuk menambahkan field baru untuk pengunjung:
1. Perbarui tabel database di `db/setup.sql`
2. Tambahkan properti dan metode di `app/models/Visitor.php`
3. Perbarui form di `php/visitor-registration.php`
4. Perbarui tampilan di `php/visitor-records.php` dan `php/visitor_list.php`
5. Tambahkan validasi di `js/visitors.js` dan `js/validation.js`

### 2. Sistem Manajemen Karyawan

Komponen terkait:
- `app/models/Employee.php`
- `php/employee-add.php`
- `php/employee-edit.php`
- `php/employee-management.php`
- `js/employees.js`

Untuk menambahkan field baru untuk karyawan:
1. Perbarui tabel database di `db/setup.sql`
2. Tambahkan properti dan metode di `app/models/Employee.php`
3. Perbarui form di `php/employee-add.php` dan `php/employee-edit.php`
4. Perbarui tampilan di `php/employee-management.php`
5. Tambahkan validasi di `js/employees.js` dan `js/validation.js`

## Praktik Keamanan

### Validasi Input
- Selalu validasi input di sisi server
- Gunakan prepared statements untuk query database
- Sanitasi output dengan `htmlspecialchars()`

### Database
- Jangan simpan password dalam plaintext, gunakan `password_hash()`
- Batasi hak akses database

### Session
- Gunakan `session_regenerate_id()` saat login
- Lakukan validasi session secara konsisten

## Deployment

### Persiapan
1. Buat branch production terpisah
2. Matikan pesan error pada production
3. Optimasi aset (minify CSS/JS)
4. Atur file konfigurasi untuk environment yang berbeda

### Checklist Deployment
- [ ] Semua perubahan telah diuji
- [ ] Konfigurasi database production sudah diatur
- [ ] Matikan debug mode dan error reporting
- [ ] Backup database dan kode lama
- [ ] Implementasikan perubahan
- [ ] Uji setelah deployment

## Bantuan dan Dukungan

Jika Anda memiliki pertanyaan tentang pengembangan proyek ini, silakan merujuk ke dokumentasi lain atau hubungi tim pengembangan utama.