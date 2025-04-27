<?php
/**
 * Employee Model
 * 
 * Handles database operations for employees
 */
class Employee {
    protected $table = 'employees';
    protected $db;
    
    /**
     * Constructor - initializes the database connection
     */
    public function __construct() {
        require_once __DIR__ . '/../../includes/Database.php';
        $this->db = new Database();
    }
    
    /**
     * Get all employees (both active and inactive)
     * 
     * @return array
     */
    public function getAll() {
        return $this->db->fetchAll("SELECT * FROM {$this->table} ORDER BY name ASC");
    }
    
    /**
     * Get all active employees
     * 
     * @return array
     */
    public function getAllActive() {
        return $this->db->fetchAll("SELECT * FROM {$this->table}
                                  WHERE is_active = 1 
                                  ORDER BY name ASC");
    }
    
    /**
     * Get employee by ID
     * 
     * @param int $id
     * @return array|null
     */
    public function getById($id) {
        return $this->db->fetchOne("SELECT * FROM {$this->table} WHERE id = ?", [$id]);
    }
    
    /**
     * Get employee by ID with department info
     * 
     * @param int $id
     * @return array|null
     */
    public function getByIdWithDepartment($id) {
        return $this->db->fetchOne("SELECT * FROM {$this->table} 
                                   WHERE id = ?", [$id]);
    }
    
    /**
     * Get employees by department
     * 
     * @param string $department
     * @return array
     */
    public function getByDepartment($department) {
        return $this->db->fetchAll("SELECT * FROM {$this->table}
                                   WHERE department = ? 
                                   AND is_active = 1
                                   ORDER BY name ASC", [$department]);
    }
    
    /**
     * Create a new employee
     * 
     * @param array $data Employee data
     * @return int|bool The ID of the inserted employee or false on failure
     */
    public function create($data) {
        $sql = "INSERT INTO {$this->table} (name, department, is_active) VALUES (?, ?, ?)";
        $params = [
            $data['name'],
            $data['department'],
            $data['is_active']
        ];
        
        $this->db->query($sql, $params);
        return $this->db->lastInsertId();
    }
    
    /**
     * Update an existing employee
     * 
     * @param int $id Employee ID
     * @param array $data Employee data
     * @return bool Success or failure
     */
    public function update($id, $data) {
        $sql = "UPDATE {$this->table} SET name = ?, department = ?, is_active = ? WHERE id = ?";
        $params = [
            $data['name'],
            $data['department'],
            $data['is_active'],
            $id
        ];
        
        $this->db->query($sql, $params);
        return true;
    }
    
    /**
     * Update employee status (active/inactive)
     * 
     * @param int $id Employee ID
     * @param int $status New status (0=inactive, 1=active)
     * @return bool Success or failure
     */
    public function updateStatus($id, $status) {
        $sql = "UPDATE {$this->table} SET is_active = ? WHERE id = ?";
        $params = [$status, $id];
        
        $this->db->query($sql, $params);
        return true;
    }
}