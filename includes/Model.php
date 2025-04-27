<?php
/**
 * Model Base Class (Compatibility File)
 * 
 * This is a temporary compatibility class to support the transition
 * from the old structure to the new MVC structure.
 */
if (!class_exists('Model')) {
    class Model {
        protected $db;
        protected $table;
        
        /**
         * Constructor
         */
        public function __construct() {
            require_once __DIR__ . '/Database.php';
            $this->db = new Database();
        }
        
        /**
         * Get all records from the table
         * 
         * @return array
         */
        public function getAll() {
            return $this->db->fetchAll("SELECT * FROM {$this->table}");
        }
        
        /**
         * Find a record by ID
         * 
         * @param int $id 
         * @return array|null
         */
        public function find($id) {
            return $this->db->fetchOne("SELECT * FROM {$this->table} WHERE id = ?", [$id]);
        }
        
        /**
         * Create a new record
         * 
         * @param array $data 
         * @return int ID of the newly created record
         */
        public function create($data) {
            $columns = implode(', ', array_keys($data));
            $placeholders = implode(', ', array_fill(0, count($data), '?'));
            
            $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
            $this->db->query($sql, array_values($data));
            
            return $this->db->lastInsertId();
        }
        
        /**
         * Update a record by ID
         * 
         * @param int $id
         * @param array $data
         * @return bool
         */
        public function update($id, $data) {
            $fields = '';
            foreach ($data as $key => $value) {
                $fields .= "{$key} = ?, ";
            }
            $fields = rtrim($fields, ', ');
            
            $sql = "UPDATE {$this->table} SET {$fields} WHERE id = ?";
            $params = array_values($data);
            $params[] = $id;
            
            $this->db->query($sql, $params);
            return true;
        }
        
        /**
         * Delete a record by ID
         * 
         * @param int $id
         * @return bool
         */
        public function delete($id) {
            $sql = "DELETE FROM {$this->table} WHERE id = ?";
            $this->db->query($sql, [$id]);
            return true;
        }
    }
}