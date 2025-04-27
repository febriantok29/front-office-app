<?php
/**
 * Database Class
 * 
 * Handles database connections and queries using PDO
 */
class Database {
    private static $instance = null;
    private $conn;
    
    /**
     * Private constructor to prevent direct object creation
     */
    private function __construct() {
        $config = require CONFIG_PATH . '/database.php';
        
        try {
            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
            
            $this->conn = new PDO(
                $dsn,
                $config['username'],
                $config['password'],
                $config['options']
            );
            
        } catch(PDOException $e) {
            die("Database Connection Error: " . $e->getMessage());
        }
    }
    
    /**
     * Singleton pattern implementation
     * 
     * @return Database
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Execute a SQL query with parameters
     * 
     * @param string $sql The SQL query to execute
     * @param array $params Parameters to bind to the query
     * @return PDOStatement
     */
    public function query($sql, $params = []) {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch(PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }
    
    /**
     * Fetch a single row from query result
     * 
     * @param string $sql The SQL query
     * @param array $params Parameters to bind
     * @return array|null
     */
    public function fetchOne($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->fetch();
    }
    
    /**
     * Fetch all rows from query result
     * 
     * @param string $sql The SQL query
     * @param array $params Parameters to bind
     * @return array
     */
    public function fetchAll($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll();
    }
    
    /**
     * Get the ID of the last inserted row
     * 
     * @return string The last inserted ID
     */
    public function lastInsertId() {
        return $this->conn->lastInsertId();
    }
}