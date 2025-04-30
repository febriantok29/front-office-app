# Dokumentasi Database Front Office App

Dokumen ini menjelaskan struktur database yang digunakan dalam Front Office App, termasuk skema tabel, relasi, dan fungsi terkait database.

## Skema Database

Database Front Office App terdiri dari beberapa tabel utama yang saling berhubungan. Skema ini dirancang untuk mendukung semua fitur aplikasi dengan efisien.

### Tabel `visitors`

Tabel ini menyimpan informasi tentang pengunjung yang terdaftar di sistem.

| Kolom           | Tipe Data      | Keterangan                            |
|-----------------|----------------|---------------------------------------|
| id              | INT (PK)       | ID unik pengunjung (auto increment)   |
| full_name       | VARCHAR(100)   | Nama lengkap pengunjung               |
| id_card_number  | VARCHAR(50)    | Nomor identitas (KTP/SIM/Passport)    |
| phone_number    | VARCHAR(20)    | Nomor telepon pengunjung              |
| email           | VARCHAR(100)   | Alamat email pengunjung (opsional)    |
| employee_id     | INT (FK)       | ID karyawan yang dikunjungi           |
| visit_purpose   | TEXT           | Tujuan kunjungan                      |
| visit_timestamp | TIMESTAMP      | Waktu kunjungan (default: CURRENT_TIMESTAMP) |
| checkout_timestamp | TIMESTAMP   | Waktu keluar (NULL jika belum keluar) |
| created_at      | TIMESTAMP      | Waktu pembuatan record                |

### Tabel `employees`

Tabel ini menyimpan data karyawan yang dapat dikunjungi.

| Kolom           | Tipe Data      | Keterangan                            |
|-----------------|----------------|---------------------------------------|
| id              | INT (PK)       | ID unik karyawan (auto increment)     |
| name            | VARCHAR(100)   | Nama lengkap karyawan                 |
| department      | VARCHAR(100)   | Departemen karyawan                   |
| is_active       | TINYINT(1)     | Status aktif (1) atau nonaktif (0)    |
| created_at      | TIMESTAMP      | Waktu pembuatan record                |

### Tabel `items` (Fitur Mendatang)

Tabel ini akan digunakan untuk melacak barang yang dibawa masuk/keluar oleh pengunjung.

| Kolom           | Tipe Data      | Keterangan                            |
|-----------------|----------------|---------------------------------------|
| id              | INT (PK)       | ID unik item (auto increment)         |
| visitor_id      | INT (FK)       | Referensi ke tabel visitors           |
| item_name       | VARCHAR(100)   | Nama barang                           |
| item_description| TEXT           | Deskripsi barang                      |
| entry_timestamp | TIMESTAMP      | Waktu barang masuk                    |
| exit_timestamp  | TIMESTAMP      | Waktu barang keluar (NULL jika belum) |
| approved_by     | INT (FK)       | ID karyawan yang menyetujui           |

### Tabel `guest_book` (Fitur Mendatang)

Tabel ini akan digunakan untuk mencatat komentar dan rating dari pengunjung.

| Kolom           | Tipe Data      | Keterangan                            |
|-----------------|----------------|---------------------------------------|
| id              | INT (PK)       | ID unik entri (auto increment)        |
| visitor_id      | INT (FK)       | Referensi ke tabel visitors           |
| comment         | TEXT           | Komentar pengunjung                   |
| rating          | TINYINT        | Rating (1-5)                          |
| created_at      | TIMESTAMP      | Waktu pembuatan record                |

## Relasi Antar Tabel

Berikut adalah diagram relasi antar tabel utama:

```
employees (1) ------ (*) visitors
    |
    |
    v
  items
    ^
    |
    |
visitors (1) ------ (*) guest_book
```

- Satu karyawan (`employees`) dapat dikunjungi oleh banyak pengunjung (`visitors`)
- Satu pengunjung (`visitors`) dapat membawa banyak barang (`items`)
- Satu pengunjung (`visitors`) dapat membuat banyak entri buku tamu (`guest_book`)

## File Setup Database

File `db/setup.sql` berisi seluruh definisi tabel dan data awal yang diperlukan untuk menjalankan aplikasi. Script ini mencakup:

1. Pembuatan database (jika belum ada)
2. Pembuatan tabel dengan semua kolom, indeks, dan kunci
3. Pembuatan relasi foreign key antar tabel
4. Penambahan data awal (sample employees)

Contoh cara menggunakan file setup:

```bash
mysql -u username -p < db/setup.sql
```

Atau jika database sudah ada:

```bash
mysql -u username -p front_office_db < db/setup.sql
```

## Koneksi Database

Koneksi ke database dikelola melalui kelas `Database` yang terletak di `app/core/Database.php`. Kelas ini menggunakan pola Singleton untuk memastikan efisiensi koneksi dan menyediakan:

1. Koneksi database singleton yang aman dan efisien
2. Metode untuk query dengan prepared statements
3. Metode bantuan untuk operasi database umum
4. Penanganan error database yang baik

### Metode Utama dalam Kelas Database

| Metode           | Deskripsi                                   | Contoh Penggunaan                                           |
|------------------|---------------------------------------------|-------------------------------------------------------------|
| getInstance()    | Mendapatkan instance database (singleton)   | `$db = Database::getInstance();`                            |
| query()          | Mengeksekusi query dengan parameter         | `$db->query("SELECT * FROM employees WHERE id = ?", [1]);`  |
| fetchAll()       | Mengambil semua baris hasil query           | `$results = $db->fetchAll("SELECT * FROM employees");`      |
| fetchOne()       | Mengambil satu baris hasil query            | `$user = $db->fetchOne("SELECT * FROM employees WHERE id = ?", [5]);` |
| insert()         | Menyisipkan data dan mengembalikan last ID  | `$id = $db->insert("employees", ['name' => 'John', 'department' => 'IT']);` |
| update()         | Memperbarui data                            | `$db->update("employees", ['is_active' => 0], "id = ?", [10]);` |
| delete()         | Menghapus data                              | `$db->delete("employees", "id = ?", [10]);`                 |

### Contoh Penggunaan Database

```php
// Mendapatkan instance database
$db = Database::getInstance();

// Query SELECT sederhana untuk mendapatkan semua karyawan aktif
$activeEmployees = $db->fetchAll("SELECT * FROM employees WHERE is_active = ?", [1]);

// Mendapatkan satu karyawan berdasarkan ID
$employee = $db->fetchOne("SELECT * FROM employees WHERE id = ?", [$employeeId]);

// Menambahkan karyawan baru
$employeeId = $db->insert("employees", [
    'name' => 'Jane Doe',
    'department' => 'Marketing',
    'is_active' => 1
]);

// Menonaktifkan karyawan
$db->update("employees", 
    ['is_active' => 0], 
    "id = ?", 
    [$employeeId]
);

// Menambahkan pengunjung baru
$visitorId = $db->insert("visitors", [
    'full_name' => 'John Smith',
    'id_card_number' => 'A12345678',
    'phone_number' => '+6281234567890',
    'email' => 'john@example.com',
    'employee_id' => $employeeId,
    'visit_purpose' => 'Meeting about marketing campaign'
]);
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

# Backup tabel tertentu
mysqldump -u username -p front_office_db employees visitors > specific_tables_backup.sql
```

### Restore Database

Untuk mengembalikan database dari file backup, gunakan perintah:

```bash
mysql -u username -p front_office_db < backup_filename.sql
```

## Pemeliharaan Database

Beberapa tips untuk pemeliharaan database:

1. **Optimasi Query**: Gunakan EXPLAIN untuk menganalisis dan mengoptimalkan query yang lambat
2. **Indeks**: Buat indeks untuk kolom yang sering digunakan dalam pencarian dan pengurutan
3. **Backup Berkala**: Lakukan backup secara reguler berdasarkan frekuensi perubahan data
4. **Monitoring Kinerja**: Pantau kinerja database dan identifikasi bottleneck
5. **Pemeliharaan Tabel**: Jalankan `OPTIMIZE TABLE` secara berkala untuk tabel yang sering diupdate
6. **Pembersihan Data**: Pertimbangkan strategi archiving untuk data lama yang jarang diakses

## Migrasi Database

Untuk perubahan skema database, gunakan pendekatan migrasi yang terstruktur:

1. Buat file migrasi dengan format `migration_YYYYMMDD_description.sql`
2. Catat setiap perubahan skema dengan statement SQL yang jelas
3. Sertakan komentar untuk menjelaskan alasan perubahan
4. Sertakan statement rollback jika diperlukan

Contoh file migrasi:

```sql
-- migration_20250425_add_company_to_visitors.sql

-- Description: Menambahkan kolom company ke tabel visitors untuk mencatat perusahaan pengunjung

-- Up
ALTER TABLE visitors ADD COLUMN company VARCHAR(100) AFTER email;
ALTER TABLE visitors ADD INDEX idx_company (company);

-- Down (rollback)
-- ALTER TABLE visitors DROP INDEX idx_company;
-- ALTER TABLE visitors DROP COLUMN company;
```

## Best Practices

1. **Selalu gunakan prepared statements** untuk mencegah SQL injection
2. **Validasi input user** sebelum menyimpan ke database
3. **Tangani error database** dengan tepat dan log untuk troubleshooting
4. **Gunakan transaksi** untuk operasi yang memerlukan atomicity
5. **Beri nama yang jelas** untuk tabel dan kolom mengikuti konvensi yang konsisten
6. **Dokumentasikan** perubahan skema database