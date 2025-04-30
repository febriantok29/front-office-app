<?php
/**
 * Database Class
 * 
 * Handles database connections and queries using PDO
 * This is the unified version that combines functionality from both previous Database classes
 */
class Database {
    private static $instance = null;
    private $conn;
    private $host;
    private $port;
    private $username;
    private $password;
    private $database;
    private $charset;
    
    /**
     * Private constructor to prevent direct object creation
     */
    private function __construct() {
        // Use direct file path instead of relying on CONFIG_PATH constant
        $config = require dirname(__DIR__) . '/config/database.php';
        
        $this->host = $config['host'];
        $this->port = $config['port'];
        $this->username = $config['username'];
        $this->password = $config['password'];
        $this->database = $config['dbname'];
        $this->charset = $config['charset'] ?? 'utf8mb4';
        
        try {
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->database};charset={$this->charset}";
            
            $this->conn = new PDO(
                $dsn,
                $this->username,
                $this->password,
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