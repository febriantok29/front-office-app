# Dokumentasi Database Front Office App

Dokumen ini menjelaskan struktur database yang digunakan dalam Front Office App, termasuk skema tabel, relasi, dan fungsi-fungsi terkait database.

## Skema Database

Database Front Office App terdiri dari beberapa tabel utama yang saling berhubungan. Skema ini dirancang untuk mendukung semua fitur aplikasi dengan efisien.

### Tabel `visitors`

Tabel ini menyimpan informasi tentang semua pengunjung yang terdaftar di sistem.

| Kolom           | Tipe Data      | Keterangan                            |
|-----------------|----------------|---------------------------------------|
| id              | INT (PK)       | ID unik pengunjung (auto increment)   |
| name            | VARCHAR(100)   | Nama lengkap pengunjung               |
| identity_number | VARCHAR(20)    | Nomor identitas (KTP/SIM/Passport)    |
| phone           | VARCHAR(15)    | Nomor telepon pengunjung              |
| company         | VARCHAR(100)   | Perusahaan/institusi pengunjung       |
| email           | VARCHAR(100)   | Alamat email pengunjung               |
| created_at      | TIMESTAMP      | Waktu pembuatan record                |
| updated_at      | TIMESTAMP      | Waktu terakhir pembaruan record       |

### Tabel `visits`

Tabel ini mencatat setiap kunjungan yang dilakukan oleh pengunjung.

| Kolom           | Tipe Data      | Keterangan                            |
|-----------------|----------------|---------------------------------------|
| id              | INT (PK)       | ID unik kunjungan (auto increment)    |
| visitor_id      | INT (FK)       | Referensi ke tabel visitors           |
| employee_id     | INT (FK)       | Referensi ke tabel employees (tujuan) |
| purpose         | VARCHAR(200)   | Tujuan kunjungan                      |
| check_in        | DATETIME       | Waktu masuk                           |
| check_out       | DATETIME       | Waktu keluar (NULL jika belum keluar) |
| badge_number    | VARCHAR(20)    | Nomor badge/kartu pengunjung          |
| notes           | TEXT           | Catatan tambahan                      |
| created_by      | INT            | ID user yang mencatat kunjungan       |

### Tabel `employees`

Tabel ini menyimpan data karyawan yang dapat dikunjungi.

| Kolom           | Tipe Data      | Keterangan                            |
|-----------------|----------------|---------------------------------------|
| id              | INT (PK)       | ID unik karyawan (auto increment)     |
| employee_number | VARCHAR(20)    | Nomor karyawan                        |
| name            | VARCHAR(100)   | Nama lengkap karyawan                 |
| department      | VARCHAR(50)    | Departemen                            |
| position        | VARCHAR(50)    | Jabatan                               |
| email           | VARCHAR(100)   | Email karyawan                        |
| phone           | VARCHAR(15)    | Nomor telepon karyawan                |
| is_active       | TINYINT(1)     | Status aktif (1) atau nonaktif (0)    |
| created_at      | TIMESTAMP      | Waktu pembuatan record                |
| updated_at      | TIMESTAMP      | Waktu terakhir pembaruan record       |

### Tabel `users`

Tabel ini menyimpan data pengguna yang memiliki akses ke aplikasi.

| Kolom           | Tipe Data      | Keterangan                            |
|-----------------|----------------|---------------------------------------|
| id              | INT (PK)       | ID unik pengguna (auto increment)     |
| username        | VARCHAR(50)    | Username untuk login                  |
| password        | VARCHAR(255)   | Password terenkripsi                  |
| name            | VARCHAR(100)   | Nama lengkap pengguna                 |
| email           | VARCHAR(100)   | Email pengguna                        |
| role            | VARCHAR(20)    | Peran pengguna (admin, staff, etc.)   |
| last_login      | DATETIME       | Waktu login terakhir                  |
| is_active       | TINYINT(1)     | Status aktif (1) atau nonaktif (0)    |
| created_at      | TIMESTAMP      | Waktu pembuatan record                |
| updated_at      | TIMESTAMP      | Waktu terakhir pembaruan record       |

### Tabel `settings`

Tabel ini menyimpan pengaturan aplikasi.

| Kolom           | Tipe Data      | Keterangan                            |
|-----------------|----------------|---------------------------------------|
| id              | INT (PK)       | ID unik pengaturan (auto increment)   |
| setting_key     | VARCHAR(50)    | Kunci pengaturan                      |
| setting_value   | TEXT           | Nilai pengaturan                      |
| description     | VARCHAR(255)   | Deskripsi pengaturan                  |
| updated_at      | TIMESTAMP      | Waktu terakhir pembaruan              |

## Relasi Antar Tabel

```
visitors (1) ------ (*) visits (*) ------ (1) employees
```

- Satu pengunjung (`visitors`) dapat memiliki banyak kunjungan (`visits`)
- Satu karyawan (`employees`) dapat dikunjungi oleh banyak pengunjung melalui tabel `visits`

## File Setup Database

File `db/setup.sql` berisi seluruh definisi tabel dan data awal yang diperlukan untuk menjalankan aplikasi. Script ini mencakup:

1. Pembuatan database (jika belum ada)
2. Pembuatan tabel dengan semua kolom, indeks, dan kunci
3. Pembuatan relasi foreign key
4. Penambahan data awal yang diperlukan (user admin, pengaturan default, dll.)

## Koneksi Database

Koneksi ke database dikelola melalui kelas `Database` yang terletak di `includes/Database.php`. Kelas ini menyediakan:

1. Koneksi database singleton 
2. Metode untuk query
3. Prepared statements untuk mencegah SQL injection
4. Penanganan error database

Contoh penggunaan kelas Database:

```php
// Mendapatkan instance database
$db = Database::getInstance();

// Query sederhana
$employees = $db->query("SELECT * FROM employees WHERE is_active = 1");

// Query dengan parameter (prepared statement)
$visitor = $db->query("SELECT * FROM visitors WHERE id = ?", [$visitorId]);
```

## Backup dan Restore Database

### Backup Database

Sangat disarankan untuk melakukan backup database secara berkala. Gunakan perintah berikut:

```bash
# Backup seluruh database
mysqldump -u username -p front_office_db > backup_filename.sql

# Backup hanya struktur
mysqldump -u username -p --no-data front_office_db > structure_backup.sql

# Backup hanya data
mysqldump -u username -p --no-create-info front_office_db > data_backup.sql
```

### Restore Database

Untuk mengembalikan database dari file backup, gunakan perintah:

```bash
mysql -u username -p front_office_db < backup_filename.sql
```

## Pemeliharaan Database

Beberapa tips untuk pemeliharaan database:

1. **Optimasi Tabel**: Jalankan `OPTIMIZE TABLE` secara berkala untuk tabel yang sering diperbarui
2. **Indeks**: Pastikan indeks dibuat untuk kolom yang sering digunakan dalam pencarian
3. **Monitoring**: Pantau ukuran database dan pertumbuhan tabel
4. **Pembersihan Data**: Implementasikan kebijakan penyimpanan data untuk mencegah database terlalu besar

## Migrasi Database

Untuk perubahan skema database, sebaiknya buat script migrasi yang dapat dijalankan untuk memperbarui database yang sudah ada tanpa kehilangan data.

Contoh struktur file migrasi:

```sql
-- migration_001_add_field_to_visitors.sql
ALTER TABLE visitors ADD COLUMN address TEXT AFTER company;
```

## Sumber Daya Tambahan

Untuk informasi lebih lanjut tentang pengembangan database:

1. [Panduan Pengembangan](./panduan-pengembangan.md) - Praktik terbaik pengembangan
2. [MySQL Documentation](https://dev.mysql.com/doc/) - Dokumentasi resmi MySQL