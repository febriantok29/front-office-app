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
        require_once __DIR__ . '/../../app/core/Database.php';
        $this->db = Database::getInstance();
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
     * Get all visitors from the database with optional filtering
     * 
     * @param string $dateFrom Optional start date filter
     * @param string $dateTo Optional end date filter
     * @param string $searchTerm Optional search term for name, ID card, phone
     * @param string $purpose Optional visit purpose filter
     * @return array List of visitors
     */
    public function getAll($dateFrom = '', $dateTo = '', $searchTerm = '', $purpose = '') {
        $sql = "SELECT v.*, e.name as employee_name 
                FROM {$this->table} v
                JOIN employees e ON v.employee_id = e.id
                WHERE 1=1";
        
        $params = [];
        
        // Add date range filter if provided
        if (!empty($dateFrom)) {
            $sql .= " AND DATE(v.visit_timestamp) >= ?";
            $params[] = $dateFrom;
        }
        
        if (!empty($dateTo)) {
            $sql .= " AND DATE(v.visit_timestamp) <= ?";
            $params[] = $dateTo;
        }
        
        // Add search term filter if provided
        if (!empty($searchTerm)) {
            $sql .= " AND (v.full_name LIKE ? OR v.id_card_number LIKE ? OR v.phone_number LIKE ? OR e.name LIKE ?)";
            $searchPattern = "%{$searchTerm}%";
            $params[] = $searchPattern;
            $params[] = $searchPattern;
            $params[] = $searchPattern;
            $params[] = $searchPattern;
        }
        
        // Add purpose filter if provided
        if (!empty($purpose)) {
            $sql .= " AND v.visit_purpose = ?";
            $params[] = $purpose;
        }
        
        $sql .= " ORDER BY v.visit_timestamp DESC";
        
        return $this->db->fetchAll($sql, $params);
    }
    
    /**
     * Get distinct visit purposes for filter dropdown
     * 
     * @return array List of unique visit purposes
     */
    public function getDistinctPurposes() {
        $result = $this->db->fetchAll("SELECT DISTINCT visit_purpose FROM {$this->table} ORDER BY visit_purpose");
        return array_column($result, 'visit_purpose');
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