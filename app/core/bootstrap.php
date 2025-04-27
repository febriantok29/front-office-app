<?php
/**
 * Application Bootstrap File
 * 
 * This file initializes the application, loads configuration,
 * and sets up autoloading for classes.
 */

// Define base path constants
define('BASE_PATH', dirname(dirname(__DIR__)));
define('APP_PATH', BASE_PATH . '/app');
define('CONFIG_PATH', APP_PATH . '/config');
define('CORE_PATH', APP_PATH . '/core');
define('CONTROLLERS_PATH', APP_PATH . '/controllers');
define('MODELS_PATH', APP_PATH . '/models');
define('VIEWS_PATH', APP_PATH . '/views');
define('PUBLIC_PATH', BASE_PATH . '/public');

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start sessions
session_start();

// Load configuration
require_once CONFIG_PATH . '/config.php';
require_once CONFIG_PATH . '/database.php';

// Set up autoloader
spl_autoload_register(function($className) {
    // Convert class name to file path
    $className = str_replace('\\', '/', $className);
    
    // Check in models directory
    if (file_exists(MODELS_PATH . '/' . $className . '.php')) {
        require_once MODELS_PATH . '/' . $className . '.php';
        return;
    }
    
    // Check in controllers directory
    if (file_exists(CONTROLLERS_PATH . '/' . $className . '.php')) {
        require_once CONTROLLERS_PATH . '/' . $className . '.php';
        return;
    }
    
    // Check in core directory
    if (file_exists(CORE_PATH . '/' . $className . '.php')) {
        require_once CORE_PATH . '/' . $className . '.php';
        return;
    }
});

// Initialize core components
require_once CORE_PATH . '/Database.php';
require_once CORE_PATH . '/Controller.php';
require_once CORE_PATH . '/Model.php';
require_once CORE_PATH . '/View.php';
require_once CORE_PATH . '/Router.php';