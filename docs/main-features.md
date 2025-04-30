# Fitur Utama Front Office App

Dokumen ini menjelaskan fitur-fitur utama yang tersedia dalam Front Office App v1.0 (April 2025) dan cara penggunaannya secara efektif.

## 1. Manajemen Pengunjung

### Registrasi Pengunjung
Fitur ini memungkinkan resepsionis untuk mendaftarkan pengunjung baru yang datang ke kantor.

**Cara menggunakan:**
1. Buka halaman Registrasi Pengunjung melalui menu sidebar atau klik "Daftarkan Pengunjung Baru" pada dashboard
2. Isi formulir dengan informasi pengunjung:
   - Nama lengkap (wajib)
   - Nomor identitas (KTP/SIM/Passport) (wajib)
   - Nomor telepon (wajib)
   - Email (opsional)
   - Pilih karyawan yang akan dikunjungi (wajib)
   - Tujuan kunjungan (wajib)
3. Klik tombol "Daftarkan Kunjungan" untuk menyimpan data
4. Sistem akan menampilkan konfirmasi pendaftaran berhasil

**File terkait:**
- `php/visitor-registration.php` - Halaman registrasi pengunjung
- `php/process_visitor.php` - Pemrosesan data pengunjung
- `app/models/Visitor.php` - Model data pengunjung
- `js/validation.js` - Validasi form di sisi client

### Daftar Pengunjung
Fitur ini menampilkan daftar semua pengunjung yang telah terdaftar dengan kemampuan pencarian dan filter yang canggih.

**Cara menggunakan:**
1. Buka halaman Catatan Pengunjung melalui menu sidebar
2. Gunakan kolom pencarian di bagian atas untuk mencari pengunjung berdasarkan nama, nomor identitas, atau telepon
3. Gunakan filter tanggal (Dari/Sampai) untuk melihat pengunjung pada rentang waktu tertentu
4. Filter berdasarkan tujuan kunjungan menggunakan dropdown yang disediakan
5. Klik tombol "Filter" untuk menerapkan semua filter
6. Klik tombol "Reset" untuk menghapus semua filter

**File terkait:**
- `php/visitor-records.php` - Halaman daftar pengunjung
- `js/visitors.js` - Fungsionalitas pencarian dan filter
- `app/models/Visitor.php` - Model data pengunjung dengan metode filtering

### Riwayat Kunjungan
Fitur ini mencatat dan menampilkan riwayat kunjungan dari setiap pengunjung dengan detail lengkap.

**Cara menggunakan:**
1. Buka halaman Catatan Pengunjung melalui menu sidebar
2. Lihat daftar kunjungan dengan detail waktu kunjungan
3. Filter berdasarkan tanggal untuk melihat kunjungan pada periode tertentu
4. Gunakan pencarian untuk menemukan kunjungan spesifik
5. Untuk fitur ekspor data (akan datang pada versi mendatang)

**File terkait:**
- `php/visitor-records.php` - Halaman riwayat kunjungan
- `js/visitors.js` - Fungsionalitas filter dan pencarian
- `app/models/Visitor.php` - Model dengan metode getAll() yang mendukung filter

## 2. Manajemen Karyawan

### Tambah Karyawan
Fitur ini memungkinkan administrator untuk menambahkan data karyawan baru ke sistem.

**Cara menggunakan:**
1. Buka halaman Manajemen Karyawan melalui menu sidebar
2. Klik tombol "Tambah Karyawan Baru"
3. Isi formulir dengan informasi karyawan:
   - Nama lengkap (wajib)
   - Departemen (wajib)
   - Status (aktif/tidak aktif)
4. Klik tombol "Tambahkan Karyawan" untuk menyimpan data
5. Sistem akan menampilkan konfirmasi dan mengarahkan kembali ke daftar karyawan

**File terkait:**
- `php/employee-add.php` - Halaman tambah karyawan
- `php/process-employee.php` - Pemrosesan data karyawan
- `app/models/Employee.php` - Model data karyawan
- `app/controllers/EmployeeController.php` - Controller untuk manajemen karyawan (dalam pengembangan)

### Manajemen Karyawan
Fitur ini menampilkan daftar semua karyawan dengan kemampuan untuk mengedit, mengaktifkan/menonaktifkan, dan mencari karyawan.

**Cara menggunakan:**
1. Buka halaman Manajemen Karyawan melalui menu sidebar
2. Lihat daftar karyawan dengan informasi ID, nama, departemen, dan status
3. Gunakan kolom pencarian untuk mencari karyawan berdasarkan nama
4. Klik tombol edit (ikon pensil) untuk mengubah informasi karyawan
5. Klik tombol status (ikon toggle) untuk mengubah status aktif/nonaktif karyawan
6. Konfirmasi setiap perubahan status yang diminta oleh sistem

**File terkait:**
- `php/employee-management.php` - Halaman manajemen karyawan
- `php/employee-toggle-status.php` - Pengubahan status karyawan
- `js/employees.js` - Fungsionalitas pencarian dan interaksi UI
- `app/views/employees/index.php` - Template view MVC (dalam transisi)

### Edit Karyawan
Fitur ini memungkinkan untuk mengedit informasi karyawan yang sudah ada dalam sistem.

**Cara menggunakan:**
1. Buka halaman Manajemen Karyawan melalui menu
2. Klik tombol "Edit" (ikon pensil) pada karyawan yang ingin diubah
3. Formulir akan menampilkan data karyawan yang ada
4. Ubah informasi yang diperlukan (nama, departemen, atau status)
5. Klik tombol "Perbarui Karyawan" untuk menyimpan perubahan
6. Sistem akan menampilkan konfirmasi dan mengarahkan kembali ke daftar karyawan

**File terkait:**
- `php/employee-edit.php` - Halaman edit karyawan
- `php/process-employee.php` - Pemrosesan perubahan data
- `app/models/Employee.php` - Model data karyawan dengan metode update

## 3. Dashboard dan Laporan

### Dashboard
Dashboard menampilkan ringkasan informasi penting seperti jumlah pengunjung hari ini, karyawan aktif, dan statistik kunjungan.

**Cara menggunakan:**
1. Buka halaman utama aplikasi (index.php)
2. Dashboard menampilkan widget statistik:
   - Jumlah pengunjung hari ini
   - Jumlah pertemuan aktif
   - Jumlah total karyawan
   - Waktu saat ini
3. Tersedia juga widget "Aksi Cepat" untuk akses langsung ke fungsi-fungsi umum:
   - Pendaftaran pengunjung
   - Pencarian pengunjung
   - Manajemen karyawan
   - Log hari ini
4. Bagian bawah dashboard menampilkan panel modul dengan keterangan fitur utama aplikasi

**File terkait:**
- `index.php` - Halaman dashboard utama
- `js/script.js` - Fungsionalitas dashboard seperti update waktu
- `css/modules/dashboard.css` - Styling untuk komponen dashboard

### Laporan (Fitur Akan Datang)
Fitur ini akan memungkinkan untuk menghasilkan berbagai laporan tentang kunjungan dan aktivitas di front office.

**Fitur yang direncanakan:**
1. Laporan kunjungan harian, mingguan, dan bulanan
2. Laporan kunjungan per departemen
3. Grafik tren kunjungan
4. Ekspor laporan ke PDF atau Excel
5. Jadwal laporan otomatis

**Status:** Dalam pengembangan untuk versi mendatang

## 4. Fitur Yang Akan Datang

### Manajemen Barang Masuk/Keluar
Sistem akan mencatat barang yang dibawa masuk dan keluar oleh pengunjung.

**Fitur yang direncanakan:**
- Formulir pendaftaran barang
- Pencatatan approval oleh karyawan
- Status masuk/keluar
- Pencarian dan filter barang
- Pembuatan laporan barang

**Status:** Dalam pengembangan (diaktifkan melalui konfigurasi)

### Buku Tamu Digital
Fitur untuk mengumpulkan feedback dan komentar dari pengunjung.

**Fitur yang direncanakan:**
- Form feedback pengunjung
- Rating dan komentar
- Dashboard analitik feedback
- Laporan kepuasan pengunjung

**Status:** Dalam pengembangan (diaktifkan melalui konfigurasi)

## Tips Penggunaan

1. **Navigasi Cepat**: Gunakan sidebar untuk navigasi antar modul. Klik pada ikon menu (≡) untuk menyembunyikan atau menampilkan sidebar pada layar kecil.

2. **Pencarian Cepat**: Pada tabel data (pengunjung atau karyawan), gunakan kolom pencarian untuk filter instan tanpa perlu me-reload halaman.

3. **Filter Tanggal**: Pada halaman Catatan Pengunjung, kombinasikan filter tanggal dan pencarian untuk mendapatkan hasil yang lebih spesifik.

4. **Toggle Status Karyawan**: Daripada menghapus karyawan, gunakan fitur toggle status untuk menonaktifkan karyawan yang sudah tidak bekerja. Ini akan menjaga integritas data historis.

5. **Validasi Form**: Formulir registrasi memiliki validasi otomatis. Pastikan semua field wajib diisi dengan benar untuk menghindari error.

6. **Responsif Design**: Aplikasi dirancang untuk bekerja pada desktop maupun perangkat mobile. UI akan menyesuaikan secara otomatis dengan ukuran layar Anda.

7. **Aksi Cepat**: Gunakan bagian "Aksi Cepat" di dashboard untuk akses cepat ke fungsi yang sering digunakan.

## Pengembangan Fitur 

Untuk pengembangan fitur baru atau penyesuaian fitur yang ada, silakan merujuk ke [Panduan Pengembangan](./development-guide.md) untuk informasi teknis lebih detail.

Untuk informasi mengenai struktur database yang mendukung fitur-fitur ini, silakan merujuk ke [Dokumentasi Database](./database.md).