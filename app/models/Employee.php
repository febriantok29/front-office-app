<?php
/**
 * Employee Model
 * 
 * Handles database operations for employees
 */

// Load the Model class if it doesn't exist yet
if (!class_exists('Model')) {
    require_once __DIR__ . '/../../includes/Model.php';
}

class Employee extends Model {
    protected $table = 'employees';
    
    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Get employee by ID
     * 
     * @param int $id
     * @return array|null
     */
    public function getById($id) {
        return $this->db->fetchOne("SELECT * FROM {$this->table} 
                                   WHERE id = ?", [$id]);
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