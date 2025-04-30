# Panduan Pengembangan Front Office App

Dokumen ini berisi panduan dan praktik terbaik untuk pengembangan Front Office App. Didesain untuk membantu developer baru maupun yang sudah berpengalaman dalam memahami dan berkontribusi pada aplikasi ini.

## Arsitektur Aplikasi

Front Office App menggunakan arsitektur MVC (Model-View-Controller) yang dimodifikasi untuk menyederhanakan pengembangan:

```
Request → index.php → Router → Controller → Model → Database
                                 ↓
Response ← View ← Controller ← Data
```

### Komponen Utama

1. **Models**: Menangani akses data dan logika bisnis
2. **Views**: Bertanggung jawab untuk presentasi data kepada user
3. **Controllers**: Mengkoordinasikan aksi user, model, dan view
4. **Core**: Kelas-kelas inti yang mendukung fungsi framework

## Struktur Kode

Aplikasi ini mengikuti struktur yang mendekati pola MVC standar:

- `app/models/`: Berisi kelas model untuk interaksi dengan database
- `app/views/`: Berisi file tampilan (HTML+PHP)
- `app/controllers/`: Berisi kelas controller untuk logika aplikasi
- `app/core/`: Berisi kelas inti sistem seperti Database, Router, dll
- `php/`: Berisi file legacy yang sedang dalam proses migrasi ke struktur MVC

## Environment Development

### Setup Development Environment

1. Gunakan PHP >= 7.4 untuk development
2. Aktifkan error reporting untuk debugging: `error_reporting(E_ALL); ini_set('display_errors', 1);`
3. Gunakan tools development:
   - VS Code dengan ekstensi PHP 
   - PHP Debug
   - PHP Intelephense/PHP IntelliSense

### Coding Standards

Aplikasi ini mengikuti PSR-12 untuk standar penulisan kode:

1. Gunakan 4 spasi untuk indentasi (bukan tab)
2. Gunakan namespace untuk organisasi kode
3. Buka kurung kurawal pada baris baru untuk kelas dan fungsi
4. Buka kurung kurawal pada baris yang sama untuk konstruksi kontrol (if, for, dll)
5. Gunakan camelCase untuk nama metode dan variabel
6. Gunakan PascalCase untuk nama kelas

```php
<?php
namespace App\Controllers;

class EmployeeController
{
    public function getEmployeeList()
    {
        if ($condition) {
            // Kode
        }
    }
}
```

## Koneksi Database

Aplikasi menggunakan kelas Database yang terletak di `app/core/Database.php`. Kelas ini mengimplementasikan pola Singleton untuk memastikan hanya ada satu koneksi database yang aktif.

### Cara Menggunakan Database

```php
// Import kelas Database
require_once __DIR__ . '/../core/Database.php';

// Mendapatkan instance database
$db = Database::getInstance();

// Contoh query sederhana
$users = $db->fetchAll("SELECT * FROM users WHERE is_active = ?", [1]);

// Contoh insert data
$userId = $db->insert('users', [
    'username' => 'john_doe',
    'email' => 'john@example.com',
    'is_active' => 1
]);

// Contoh update data
$db->update('users', 
    ['status' => 'active'], 
    'id = ?', 
    [5]
);
```

### Konfigurasi Database

Konfigurasi database berada di file `app/config/database.php`. Untuk mengubah parameter database, Anda perlu mengedit file ini dengan kredensial yang sesuai.

## Membuat Fitur Baru

Berikut langkah-langkah untuk menambahkan fitur baru ke aplikasi:

1. **Analisis Kebutuhan**: Tentukan secara jelas apa yang harus dilakukan fitur tersebut
2. **Perancangan Database**: Buat atau perbarui skema database jika diperlukan
3. **Buat Model**: Buat model untuk mengakses dan memanipulasi data
4. **Buat Controller**: Buat controller untuk menangani logic dan alur aplikasi
5. **Buat View**: Buat template view untuk tampilan antarmuka pengguna
6. **Testing**: Uji fitur untuk memastikan berfungsi dengan benar

### Contoh Membuat Fitur Sederhana

Misalkan kita ingin menambahkan fitur untuk mengelola departemen:

1. **Buat Model** (`app/models/Department.php`):

```php
<?php
/**
 * Department Model
 */
class Department
{
    private $db;
    
    public function __construct()
    {
        require_once __DIR__ . '/../core/Database.php';
        $this->db = Database::getInstance();
    }
    
    public function getAll()
    {
        return $this->db->fetchAll("SELECT * FROM departments ORDER BY name");
    }
    
    public function getById($id)
    {
        return $this->db->fetchOne("SELECT * FROM departments WHERE id = ?", [$id]);
    }
    
    public function create($data)
    {
        return $this->db->insert('departments', [
            'name' => $data['name'],
            'description' => $data['description'] ?? null
        ]);
    }
    
    public function update($id, $data)
    {
        return $this->db->update('departments', 
            [
                'name' => $data['name'],
                'description' => $data['description'] ?? null
            ],
            'id = ?',
            [$id]
        );
    }
    
    public function delete($id)
    {
        return $this->db->delete('departments', 'id = ?', [$id]);
    }
}
```

2. **Buat Controller** (`app/controllers/DepartmentController.php`):

```php
<?php
/**
 * Department Controller
 */
class DepartmentController extends Controller
{
    private $departmentModel;
    
    public function __construct()
    {
        parent::__construct();
        $this->departmentModel = $this->model('Department');
    }
    
    public function index()
    {
        $departments = $this->departmentModel->getAll();
        
        $data = [
            'title' => 'Manajemen Departemen',
            'departments' => $departments
        ];
        
        $this->render('departments/index', $data);
    }
    
    public function add()
    {
        // Logic untuk menambah departemen
    }
    
    public function edit($id)
    {
        // Logic untuk mengedit departemen
    }
    
    public function delete($id)
    {
        // Logic untuk menghapus departemen
    }
}
```

3. **Buat View** (`app/views/departments/index.php`):

```php
<div class="page-header">
    <h1>Manajemen Departemen</h1>
    <p>Kelola daftar departemen dalam organisasi.</p>
    <a href="/departments/add" class="button"><i class="fas fa-plus"></i> Tambah Departemen</a>
</div>

<div class="card">
    <div class="card-header">
        <h2>Daftar Departemen</h2>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($departments)): ?>
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data departemen</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($departments as $dept): ?>
                            <tr>
                                <td><?= $dept['id']; ?></td>
                                <td><?= htmlspecialchars($dept['name']); ?></td>
                                <td><?= htmlspecialchars($dept['description'] ?? '-'); ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="/departments/edit/<?= $dept['id']; ?>" class="btn-action btn-edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="/departments/delete/<?= $dept['id']; ?>" class="btn-action btn-delete" 
                                           data-confirm="Apakah Anda yakin ingin menghapus departemen ini?">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
```

## Debugging

### Log System

Untuk memudahkan debugging, gunakan fungsi logging:

```php
// app/core/Logger.php
function logError($message, $context = []) {
    $timestamp = date('Y-m-d H:i:s');
    $contextStr = !empty($context) ? json_encode($context) : '';
    $logMessage = "[$timestamp] ERROR: $message $contextStr" . PHP_EOL;
    file_put_contents(__DIR__ . '/../../logs/app.log', $logMessage, FILE_APPEND);
}
```

### PHP Error Handling

Aplikasi menggunakan custom error handler untuk menangkap dan mencatat error:

```php
// Contoh custom error handler
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    logError("$errstr in $errfile on line $errline", [
        'errno' => $errno,
        'trace' => debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS)
    ]);
    
    if (ENVIRONMENT === 'development') {
        echo "<div class='error-message'>Error: $errstr in $errfile on line $errline</div>";
    } else {
        echo "<div class='error-message'>An error occurred. Please try again later.</div>";
    }
});
```

## AJAX dan API

Untuk fitur yang memerlukan AJAX, gunakan pendekatan berikut:

### Server-Side (PHP)

```php
// app/controllers/ApiController.php
public function getEmployees() {
    header('Content-Type: application/json');
    
    $employees = $this->employeeModel->getAll();
    
    echo json_encode([
        'status' => 'success',
        'data' => $employees
    ]);
}
```

### Client-Side (JavaScript)

```javascript
// js/employees.js
function loadEmployees() {
    fetch('/api/getEmployees')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Update UI with data
                displayEmployees(data.data);
            } else {
                showError('Failed to load employees');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showError('An error occurred');
        });
}
```

## Security Best Practices

1. **Validasi Input**: Selalu validasi input dari pengguna di sisi server
2. **Sanitasi Output**: Selalu gunakan `htmlspecialchars()` untuk mencegah XSS
3. **Prepared Statements**: Gunakan PDO prepared statements untuk mencegah SQL injection
4. **CSRF Protection**: Implementasikan token CSRF untuk form
5. **Secure Passwords**: Gunakan password hashing yang kuat (password_hash)
6. **Session Security**: Atur session secure cookie dan regenerate ID

## Optimasi Performa

1. **Query Optimization**: Gunakan indeks dan optimasi query
2. **Asset Minification**: Minify CSS dan JavaScript untuk produksi
3. **Database Connection Pooling**: Gunakan connection pooling jika tersedia
4. **Caching**: Implementasikan caching untuk data yang jarang berubah

## Testing

Sebaiknya lakukan pengujian pada setiap fitur baru:

1. **Unit Testing**: Uji fungsi dan metode individu
2. **Integration Testing**: Uji interaksi antar komponen
3. **UI Testing**: Uji antarmuka pengguna dan alur kerja

## Deployment

Untuk menerapkan aplikasi ke lingkungan produksi:

1. Atur `debug = false` di `app/config/config.php`
2. Minify semua asset (CSS/JS)
3. Verifikasi semua dependency
4. Backup database sebelum deployment
5. Update aplikasi menggunakan git pull atau upload

## Git Workflow

Gunakan workflow Git yang konsisten:

1. Buat branch untuk fitur: `git checkout -b feature/nama-fitur`
2. Commit perubahan dengan pesan yang deskriptif
3. Push ke remote repository: `git push origin feature/nama-fitur`
4. Buat pull request untuk review
5. Setelah disetujui, merge ke main/master

## Dokumentasi Kode

Dokumentasikan kode dengan komentar yang jelas:

```php
/**
 * Get active employees from database
 *
 * @param string $department Optional department filter
 * @return array List of active employees
 */
public function getActiveEmployees($department = null) {
    // Implementation
}
```

## Referensi Eksternal

- [PHP Documentation](https://www.php.net/docs.php)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [JavaScript MDN Docs](https://developer.mozilla.org/en-US/docs/Web/JavaScript)