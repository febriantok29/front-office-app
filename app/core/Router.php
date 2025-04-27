<?php
/**
 * Router Class
 * 
 * Handles URL routing and dispatching to appropriate controllers
 */
class Router {
    private $routes = [];
    private $params = [];
    
    /**
     * Add a route to the routing table
     * 
     * @param string $route The route URL pattern
     * @param array $params Parameters (controller, action, etc.)
     * @return void
     */
    public function add($route, $params = []) {
        // Convert route to a regular expression for matching
        $route = preg_replace('/\//', '\\/', $route);
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z0-9-]+)', $route);
        $route = '/^' . $route . '$/i';
        
        $this->routes[$route] = $params;
    }
    
    /**
     * Match the route to the routes in the routing table
     * 
     * @param string $url The URL to match
     * @return boolean Whether a route was matched or not
     */
    public function match($url) {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                // Get named capture group values
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }
    
    /**
     * Dispatch the route to the appropriate controller and action
     * 
     * @param string $url The URL to dispatch
     * @return void
     */
    public function dispatch($url) {
        $url = $this->removeQueryStringVariables($url);
        
        if ($this->match($url)) {
            $controller = $this->getController();
            $action = $this->getAction();
            
            $controller->$action();
        } else {
            // No route found - show 404 error
            header('HTTP/1.1 404 Not Found');
            include VIEWS_PATH . '/errors/404.php';
        }
    }
    
    /**
     * Remove query string variables from the URL
     * 
     * @param string $url The URL to process
     * @return string The URL with the query string variables removed
     */
    protected function removeQueryStringVariables($url) {
        if ($url != '') {
            $parts = explode('&', $url, 2);
            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }
        return $url;
    }
    
    /**
     * Get the controller instance based on the route parameters
     * 
     * @return object The controller object
     */
    protected function getController() {
        $controller = $this->params['controller'] ?? 'Home';
        $controller = $this->convertToStudlyCaps($controller);
        $controller .= 'Controller';
        
        if (class_exists($controller)) {
            return new $controller();
        } else {
            throw new Exception("Controller class $controller not found");
        }
    }
    
    /**
     * Get the action method name based on the route parameters
     * 
     * @return string The action method name
     */
    protected function getAction() {
        $action = $this->params['action'] ?? 'index';
        $action = $this->convertToCamelCase($action);
        
        if (method_exists($this->getController(), $action)) {
            return $action;
        } else {
            throw new Exception("Action method $action not found in controller " . get_class($this->getController()));
        }
    }
    
    /**
     * Convert string to StudlyCaps format (e.g., "home-page" to "HomePage")
     * 
     * @param string $string The string to convert
     * @return string
     */
    protected function convertToStudlyCaps($string) {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }
    
    /**
     * Convert string to camelCase format (e.g., "add-new" to "addNew")
     * 
     * @param string $string The string to convert
     * @return string
     */
    protected function convertToCamelCase($string) {
        return lcfirst($this->convertToStudlyCaps($string));
    }
    
    /**
     * Get all route parameters
     * 
     * @return array
     */
    public function getParams() {
        return $this->params;
    }
    
    /**
     * Get a specific route parameter value
     * 
     * @param string $key The parameter key
     * @return string|null The parameter value
     */
    public function getParam($key) {
        return $this->params[$key] ?? null;
    }
}