# Struktur Proyek Front Office App

Dokumen ini menjelaskan struktur folder dan file dalam proyek Front Office App untuk memudahkan pengembangan dan pemeliharaan.

## Struktur Folder

```
index.php                 # Entry point utama aplikasi
app/                      # Inti aplikasi
  ├── controllers/        # Controller untuk logika bisnis
  └── models/             # Model data aplikasi
      ├── Employee.php    # Model untuk data karyawan
      └── Visitor.php     # Model untuk data pengunjung
css/                      # Aset CSS
  ├── styles.css          # File CSS utama
  └── modules/            # Modul CSS dengan pendekatan modular
      ├── 01-base.css     # CSS dasar (reset, variabel, dll)
      ├── 02-layout.css   # Layout umum
      ├── 03-forms.css    # Styling form
      ├── 04-components.css # Komponen UI
      ├── 05-dashboard.css # Styling khusus dashboard
      └── 06-utilities.css # Kelas utilitas
db/                       # Database
  └── setup.sql           # Skema database dan data awal
docs/                     # Dokumentasi
  ├── introduction.md     # Pengenalan proyek
  └── README.md           # Dokumentasi umum
includes/                 # File pendukung yang di-include
  └── Database.php        # Kelas koneksi dan operasi database
js/                       # JavaScript
  ├── employees.js        # Logika frontend untuk manajemen karyawan
  ├── script.js           # Script umum
  ├── validation.js       # Validasi form
  └── visitors.js         # Logika frontend untuk manajemen pengunjung
php/                      # File PHP untuk halaman berbeda
  ├── employee-add.php    # Halaman tambah karyawan
  ├── employee-edit.php   # Halaman edit karyawan
  ├── employee-management.php # Manajemen karyawan
  ├── employee-toggle-status.php # Toggle status aktif karyawan
  ├── error.php           # Halaman error
  ├── process_visitor.php # Pemrosesan data pengunjung
  ├── process-employee.php # Pemrosesan data karyawan
  ├── visitor_list.php    # Daftar pengunjung
  ├── visitor-records.php # Catatan pengunjung
  └── visitor-registration.php # Pendaftaran pengunjung
```

## Penjelasan Komponen Utama

### 1. Direktori `app/`

Direktori ini berisi kode inti aplikasi yang mengikuti pola Model-View-Controller (MVC).

#### Models

Model bertanggung jawab untuk logika data:
- `Employee.php`: Model untuk data karyawan (CRUD operations)
- `Visitor.php`: Model untuk data pengunjung (CRUD operations)

#### Controllers

Controller menghubungkan model dengan view dan menangani logika bisnis.

### 2. File `includes/Database.php`

Berisi kelas untuk koneksi database dan fungsi-fungsi umum terkait database. File ini menyediakan abstraksi untuk operasi database.

### 3. Direktori `php/` 

Berisi file PHP yang umumnya berperan sebagai view atau halaman aplikasi yang diakses langsung oleh pengguna.

### 4. File CSS dan JavaScript

- CSS dibagi menjadi beberapa modul untuk memisahkan perhatian
- JavaScript juga dipisahkan berdasarkan fungsinya

### 5. File `db/setup.sql`

Berisi definisi skema database SQL dan mungkin juga data awal untuk aplikasi.

## Best Practices untuk Pengembangan

Saat mengembangkan proyek ini, silakan ikuti praktik terbaik berikut:

1. **Konsistensi Penamaan**
   - Gunakan konvensi camelCase untuk nama fungsi dan variabel di PHP dan JavaScript
   - Gunakan kebab-case untuk nama file dan direktori
   - Gunakan nama yang deskriptif

2. **Organisasi Kode**
   - Pisahkan logika bisnis dari presentasi (MVC)
   - Gunakan file terpisah untuk kode yang berbeda fungsionalitasnya
   - Pertahankan struktur folder yang ada

3. **CSS**
   - Gunakan pendekatan modular dengan memisahkan CSS sesuai fungsinya
   - Ikuti urutan numerik pada file CSS untuk pemuatan yang benar

4. **JavaScript**
   - Pemisahan kode berdasarkan fitur/halaman
   - Validasi input di sisi klien untuk UX yang lebih baik

Untuk informasi lebih lanjut tentang cara mengembangkan aplikasi, silakan lihat [Panduan Pengembangan](./development-guide.md).