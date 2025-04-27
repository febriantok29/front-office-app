<?php
/**
 * Employee Controller
 * 
 * Handles all employee-related operations
 */
class EmployeeController extends Controller {
    private $employeeModel;
    
    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->employeeModel = $this->model('Employee');
    }
    
    /**
     * Display all employees
     */
    public function index() {
        $employees = $this->employeeModel->getAll();
        
        $data = [
            'title' => 'Manajemen Karyawan',
            'employees' => $employees
        ];
        
        $this->render('employees/index', $data);
    }
    
    /**
     * Display employee add form
     */
    public function add() {
        $data = [
            'title' => 'Tambah Karyawan Baru',
            'departments' => ['IT', 'HR', 'Finance', 'Marketing', 'Operations', 'Sales']
        ];
        
        // If form submitted, process the data
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $employee = [
                'name' => trim($_POST['name']),
                'department' => trim($_POST['department']),
                'is_active' => isset($_POST['is_active']) ? 1 : 0,
            ];
            
            // Validate input
            $errors = [];
            
            if (empty($employee['name'])) {
                $errors['name'] = 'Nama karyawan harus diisi';
            }
            
            if (empty($employee['department'])) {
                $errors['department'] = 'Departemen harus dipilih';
            }
            
            if (empty($errors)) {
                // Save to database
                $id = $this->employeeModel->create($employee);
                
                if ($id) {
                    $_SESSION['success_message'] = 'Karyawan berhasil ditambahkan';
                    $this->redirect('/employees');
                } else {
                    $data['error'] = 'Gagal menambahkan karyawan';
                }
            } else {
                $data['errors'] = $errors;
                $data['employee'] = $employee;
            }
        }
        
        $this->render('employees/add', $data);
    }
    
    /**
     * Display employee edit form
     * 
     * @param int $id Employee ID
     */
    public function edit($id) {
        $employee = $this->employeeModel->find($id);
        
        if (!$employee) {
            $this->redirect('/employees');
        }
        
        $data = [
            'title' => 'Edit Karyawan',
            'employee' => $employee,
            'departments' => ['IT', 'HR', 'Finance', 'Marketing', 'Operations', 'Sales']
        ];
        
        // If form submitted, process the data
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $updatedEmployee = [
                'name' => trim($_POST['name']),
                'department' => trim($_POST['department']),
                'is_active' => isset($_POST['is_active']) ? 1 : 0,
            ];
            
            // Validate input
            $errors = [];
            
            if (empty($updatedEmployee['name'])) {
                $errors['name'] = 'Nama karyawan harus diisi';
            }
            
            if (empty($updatedEmployee['department'])) {
                $errors['department'] = 'Departemen harus dipilih';
            }
            
            if (empty($errors)) {
                // Save to database
                $success = $this->employeeModel->update($id, $updatedEmployee);
                
                if ($success) {
                    $_SESSION['success_message'] = 'Data karyawan berhasil diperbarui';
                    $this->redirect('/employees');
                } else {
                    $data['error'] = 'Gagal memperbarui data karyawan';
                }
            } else {
                $data['errors'] = $errors;
                $data['employee'] = array_merge($employee, $updatedEmployee);
            }
        }
        
        $this->render('employees/edit', $data);
    }
    
    /**
     * Delete an employee
     * 
     * @param int $id Employee ID
     */
    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $employee = $this->employeeModel->find($id);
            
            if (!$employee) {
                $this->redirect('/employees');
            }
            
            $success = $this->employeeModel->delete($id);
            
            if ($success) {
                $_SESSION['success_message'] = 'Karyawan berhasil dihapus';
            } else {
                $_SESSION['error_message'] = 'Gagal menghapus karyawan';
            }
        }
        
        $this->redirect('/employees');
    }
    
    /**
     * Toggle employee active status
     * 
     * @param int $id Employee ID
     */
    public function toggleStatus($id) {
        $employee = $this->employeeModel->find($id);
        
        if (!$employee) {
            $this->redirect('/employees');
        }
        
        $newStatus = $employee['is_active'] == 1 ? 0 : 1;
        $success = $this->employeeModel->updateStatus($id, $newStatus);
        
        if ($success) {
            $statusText = $newStatus == 1 ? 'aktif' : 'non-aktif';
            $_SESSION['success_message'] = "Status karyawan berhasil diubah menjadi {$statusText}";
        } else {
            $_SESSION['error_message'] = 'Gagal mengubah status karyawan';
        }
        
        $this->redirect('/employees');
    }
}