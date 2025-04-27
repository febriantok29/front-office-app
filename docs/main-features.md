# Fitur Utama Front Office App

Dokumen ini menjelaskan fitur-fitur utama yang tersedia dalam Front Office App dan bagaimana cara menggunakannya.

## 1. Manajemen Pengunjung

### Registrasi Pengunjung
Fitur ini memungkinkan resepsionis untuk mendaftarkan pengunjung baru yang datang.

**Cara menggunakan:**
1. Buka halaman Registrasi Pengunjung melalui menu
2. Isi formulir dengan informasi pengunjung:
   - Nama lengkap
   - Nomor identitas
   - Nomor telepon
   - Perusahaan/institusi
   - Tujuan kunjungan
   - Orang yang ingin ditemui
3. Klik tombol "Daftar" untuk menyimpan data

**File terkait:**
- `php/visitor-registration.php` - Halaman registrasi
- `php/process_visitor.php` - Pemrosesan data
- `app/models/Visitor.php` - Model data pengunjung

### Daftar Pengunjung
Fitur ini menampilkan daftar semua pengunjung yang telah terdaftar dengan kemampuan pencarian dan filter.

**Cara menggunakan:**
1. Buka halaman Daftar Pengunjung melalui menu
2. Gunakan kolom pencarian untuk mencari pengunjung berdasarkan nama, perusahaan, dll.
3. Gunakan filter tanggal untuk melihat pengunjung pada rentang waktu tertentu
4. Klik pada ID atau nama pengunjung untuk melihat detail

**File terkait:**
- `php/visitor_list.php` - Halaman daftar pengunjung
- `js/visitors.js` - Fungsionalitas pencarian dan filter
- `app/models/Visitor.php` - Model data pengunjung

### Riwayat Kunjungan
Fitur ini mencatat dan menampilkan riwayat kunjungan dari setiap pengunjung.

**Cara menggunakan:**
1. Buka halaman Riwayat Kunjungan melalui menu
2. Lihat daftar kunjungan dengan detail waktu masuk dan keluar
3. Filter berdasarkan tanggal atau nama pengunjung
4. Ekspor data ke format Excel jika diperlukan

**File terkait:**
- `php/visitor-records.php` - Halaman riwayat kunjungan
- `js/visitors.js` - Fungsionalitas filter dan ekspor

## 2. Manajemen Karyawan

### Tambah Karyawan
Fitur ini memungkinkan administrator untuk menambahkan data karyawan baru ke sistem.

**Cara menggunakan:**
1. Buka halaman Tambah Karyawan melalui menu
2. Isi formulir dengan informasi karyawan:
   - Nama lengkap
   - Nomor karyawan
   - Departemen
   - Jabatan
   - Email
   - Nomor telepon
   - Status (aktif/tidak aktif)
3. Klik tombol "Simpan" untuk menambahkan karyawan

**File terkait:**
- `php/employee-add.php` - Halaman tambah karyawan
- `php/process-employee.php` - Pemrosesan data
- `app/models/Employee.php` - Model data karyawan

### Manajemen Karyawan
Fitur ini menampilkan daftar semua karyawan dengan kemampuan untuk mengedit, mengaktifkan/menonaktifkan, dan mencari karyawan.

**Cara menggunakan:**
1. Buka halaman Manajemen Karyawan melalui menu
2. Lihat daftar karyawan dengan informasi dasar
3. Gunakan kolom pencarian untuk mencari karyawan
4. Klik tombol "Edit" untuk mengubah informasi karyawan
5. Klik tombol "Aktif/Nonaktif" untuk mengubah status karyawan

**File terkait:**
- `php/employee-management.php` - Halaman manajemen karyawan
- `php/employee-edit.php` - Halaman edit karyawan
- `php/employee-toggle-status.php` - Pengubahan status karyawan
- `js/employees.js` - Fungsionalitas pencarian dan interaksi

### Edit Karyawan
Fitur ini memungkinkan untuk mengedit informasi karyawan yang sudah ada.

**Cara menggunakan:**
1. Buka halaman Manajemen Karyawan
2. Klik tombol "Edit" pada karyawan yang ingin diubah
3. Ubah informasi yang diperlukan
4. Klik tombol "Simpan" untuk menyimpan perubahan

**File terkait:**
- `php/employee-edit.php` - Halaman edit karyawan
- `php/process-employee.php` - Pemrosesan perubahan data
- `app/models/Employee.php` - Model data karyawan

## 3. Dashboard dan Laporan

### Dashboard
Dashboard menampilkan ringkasan informasi penting seperti jumlah pengunjung hari ini, karyawan aktif, dan statistik kunjungan.

**Cara menggunakan:**
1. Buka halaman Dashboard (biasanya halaman utama setelah login)
2. Lihat widget yang menampilkan berbagai statistik dan informasi
3. Gunakan filter untuk menyesuaikan data yang ditampilkan
4. Lihat grafik untuk visualisasi tren

**File terkait:**
- `index.php` - Halaman dashboard utama
- `js/script.js` - Fungsionalitas dashboard

### Laporan
Fitur ini memungkinkan untuk menghasilkan berbagai laporan tentang kunjungan dan aktivitas di front office.

**Cara menggunakan:**
1. Buka halaman Laporan melalui menu
2. Pilih jenis laporan yang ingin dibuat
3. Atur parameter laporan (rentang tanggal, departemen, dll.)
4. Klik tombol "Buat Laporan" untuk menghasilkan laporan
5. Ekspor ke PDF atau Excel jika diperlukan

## 4. Pengaturan Sistem

### Pengaturan Umum
Fitur ini memungkinkan untuk mengubah pengaturan umum aplikasi.

**Cara menggunakan:**
1. Buka halaman Pengaturan melalui menu
2. Ubah pengaturan seperti nama perusahaan, logo, format tanggal, dll.
3. Klik tombol "Simpan" untuk menyimpan perubahan

### Manajemen Pengguna
Fitur ini memungkinkan untuk mengelola pengguna yang dapat mengakses aplikasi.

**Cara menggunakan:**
1. Buka halaman Manajemen Pengguna melalui menu
2. Lihat daftar pengguna yang ada
3. Tambah pengguna baru dengan mengklik tombol "Tambah Pengguna"
4. Edit atau hapus pengguna yang ada

## Tips Penggunaan

1. **Pencarian Cepat**: Gunakan shortcut `Ctrl+F` (atau `Cmd+F` di Mac) pada halaman daftar untuk menemukan item dengan cepat.

2. **Ekspor Data**: Hampir semua daftar di aplikasi memiliki opsi untuk mengekspor data ke Excel atau PDF. Cari tombol "Ekspor" di bagian atas atau bawah tabel.

3. **Filter Tanggal**: Gunakan filter tanggal untuk mempersempit hasil pencarian, terutama pada riwayat kunjungan.

4. **Pencadangan Data**: Lakukan pencadangan database secara rutin untuk menghindari kehilangan data.

Untuk informasi lebih detail tentang implementasi teknis fitur-fitur ini, silakan merujuk ke [Panduan Pengembangan](./development-guide.md).