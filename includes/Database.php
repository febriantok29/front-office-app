<?php
/**
 * Database Connection Class
 * 
 * This class handles the database connection and query execution
 */
class Database {
    private $host;
    private $port;
    private $username;
    private $password;
    private $database;
    private $conn;
    
    /**
     * Constructor - establishes database connection
     */
    public function __construct() {
        // Load database configuration from config file
        $config = require_once __DIR__ . '/../app/config/database.php';
        
        $this->host = $config['host'];
        $this->port = $config['port']; // Mengambil port dari konfigurasi
        $this->username = $config['username'];
        $this->password = $config['password'];
        $this->database = $config['dbname'];
        
        try {
            $this->conn = new PDO(
                "mysql:host=$this->host;port=$this->port;dbname=$this->database",
                $this->username,
                $this->password
            );
            
            // Set PDO attributes from config
            foreach ($config['options'] as $option => $value) {
                $this->conn->setAttribute($option, $value);
            }
            
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
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