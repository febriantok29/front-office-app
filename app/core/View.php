<?php
/**
 * View Class
 * 
 * Handles rendering of views and templates
 */
class View {
    protected $layout = 'default';
    
    /**
     * Render a view
     * 
     * @param string $view Path to the view file
     * @param array $data Data to pass to the view
     * @param string|null $layout Layout to use (or null for no layout)
     * @return void
     */
    public function render($view, $data = [], $layout = null) {
        // Extract data to make it available in the view
        extract($data);
        
        // Get the content view
        ob_start();
        include VIEWS_PATH . '/' . $view . '.php';
        $content = ob_get_clean();
        
        // If layout is null, use the default layout
        if ($layout === null) {
            $layout = $this->layout;
        }
        
        // If layout is false, render without layout
        if ($layout === false) {
            echo $content;
            return;
        }
        
        // Otherwise, render with layout
        include VIEWS_PATH . '/layouts/' . $layout . '.php';
    }
    
    /**
     * Include a partial view
     * 
     * @param string $partial Path to the partial view
     * @param array $data Data to pass to the partial
     * @return void
     */
    public function partial($partial, $data = []) {
        extract($data);
        include VIEWS_PATH . '/partials/' . $partial . '.php';
    }
    
    /**
     * Set the default layout
     * 
     * @param string $layout Layout name
     * @return void
     */
    public function setLayout($layout) {
        $this->layout = $layout;
    }
}