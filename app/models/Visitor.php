<?php
/**
 * Visitor Model
 * 
 * Handles database operations for visitors
 */
class Visitor {
    private $db;
    private $table = 'visitors';
    
    /**
     * Constructor - initializes the database connection
     */
    public function __construct() {
        require_once __DIR__ . '/../../includes/Database.php';
        $this->db = new Database();
    }
    
    /**
     * Add a new visitor to the database
     * 
     * @param array $data Visitor information
     * @return int|bool The ID of the inserted visitor or false on failure
     */
    public function create($data) {
        $sql = "INSERT INTO {$this->table} (full_name, id_card_number, phone_number, 
                email, employee_id, visit_purpose) 
                VALUES (?, ?, ?, ?, ?, ?)";
                
        $params = [
            $data['full_name'],
            $data['id_card_number'],
            $data['phone_number'],
            $data['email'],
            $data['employee_id'],
            $data['visit_purpose']
        ];
        
        $this->db->query($sql, $params);
        return $this->db->lastInsertId();
    }
    
    /**
     * Get all visitors from the database
     * 
     * @return array List of visitors
     */
    public function getAll() {
        return $this->db->fetchAll("SELECT v.*, e.name as employee_name 
                                   FROM {$this->table} v
                                   JOIN employees e ON v.employee_id = e.id
                                   ORDER BY v.visit_timestamp DESC");
    }
    
    /**
     * Get a visitor by ID
     * 
     * @param int $id Visitor ID
     * @return array|null Visitor information
     */
    public function getById($id) {
        return $this->db->fetchOne("SELECT v.*, e.name as employee_name 
                                   FROM {$this->table} v
                                   JOIN employees e ON v.employee_id = e.id
                                   WHERE v.id = ?", [$id]);
    }
    
    /**
     * Get visitors for a specific employee
     * 
     * @param int $employeeId Employee ID
     * @return array List of visitors for the specified employee
     */
    public function getByEmployeeId($employeeId) {
        return $this->db->fetchAll("SELECT * FROM {$this->table} 
                                   WHERE employee_id = ?
                                   ORDER BY visit_timestamp DESC", [$employeeId]);
    }
}