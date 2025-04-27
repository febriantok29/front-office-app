<?php
/**
 * Database Connection Class
 * 
 * This class handles the database connection and query execution
 */
class Database {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'front_office_db';
    private $conn;
    
    /**
     * Constructor - establishes database connection
     */
    public function __construct() {
        try {
            $this->conn = new PDO(
                "mysql:host=$this->host;dbname=$this->database",
                $this->username,
                $this->password
            );
            
            // Set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
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