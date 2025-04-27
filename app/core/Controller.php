<?php
/**
 * Base Controller Class
 * 
 * All controllers will extend this class
 */
class Controller {
    protected $view;
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->view = new View();
    }
    
    /**
     * Load a model
     * 
     * @param string $model Name of the model to load
     * @return object Model instance
     */
    protected function model($model) {
        if (file_exists(MODELS_PATH . '/' . $model . '.php')) {
            require_once MODELS_PATH . '/' . $model . '.php';
            return new $model();
        } else {
            die("Model {$model} not found");
        }
    }
    
    /**
     * Render a view
     * 
     * @param string $view Path to the view file
     * @param array $data Data to pass to the view
     * @return void
     */
    protected function render($view, $data = []) {
        $this->view->render($view, $data);
    }
    
    /**
     * Redirect to another URL
     * 
     * @param string $url URL to redirect to
     * @return void
     */
    protected function redirect($url) {
        header('Location: ' . $url);
        exit;
    }
    
    /**
     * Return JSON response
     * 
     * @param mixed $data Data to return as JSON
     * @param int $statusCode HTTP status code
     * @return void
     */
    protected function json($data, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}