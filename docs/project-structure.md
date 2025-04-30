# Project Structure

This document explains the organization of the Front Office application, following modern PHP practices and a modular structure for better maintainability and development.

## Directory Structure

```
front-office-app/
├── app/                    # Core application folder
│   ├── config/             # Configuration files
│   │   ├── config.php      # General app configuration
│   │   └── database.php    # Database configuration
│   ├── controllers/        # Controller classes
│   │   ├── EmployeeController.php  # Employee management
│   │   └── HomeController.php      # Dashboard/home functionality
│   ├── core/               # Core framework classes
│   │   ├── bootstrap.php   # Application bootstrap
│   │   ├── Controller.php  # Base controller
│   │   ├── Database.php    # Database connection
│   │   ├── Model.php       # Base model
│   │   ├── Router.php      # URL routing
│   │   └── View.php        # View rendering
│   ├── models/             # Model classes
│   │   ├── Employee.php    # Employee data model
│   │   └── Visitor.php     # Visitor data model
│   └── views/              # View templates
│       ├── dashboard/      # Dashboard views
│       ├── employees/      # Employee management views
│       ├── errors/         # Error pages
│       ├── layouts/        # Layout templates
│       ├── partials/       # Reusable view components
│       └── visitors/       # Visitor management views
├── css/                    # CSS files
│   ├── styles.css          # Main CSS file (imports modules)
│   └── modules/            # Modular CSS files
│       ├── base.css        # Base styles and variables
│       ├── components.css  # UI components
│       ├── dashboard.css   # Dashboard-specific styles
│       ├── forms.css       # Form elements
│       ├── layout.css      # Layout structure
│       └── utilities.css   # Utility classes
├── db/                     # Database scripts
│   └── setup.sql           # Database setup script
├── docs/                   # Documentation
├── js/                     # JavaScript files
│   ├── employees.js        # Employee-related functionality
│   ├── script.js           # Main JavaScript file
│   ├── validation.js       # Form validation
│   └── visitors.js         # Visitor-related functionality
├── php/                    # PHP templates (older approach)
│   ├── employee-*.php      # Employee management files
│   ├── visitor-*.php       # Visitor management files
│   └── process-*.php       # Form processors
└── index.php               # Main entry point
```

## Architectural Pattern

The application follows an MVC (Model-View-Controller) architectural pattern, with elements of the Repository pattern for data access:

### Models (app/models/)

Models handle data access and business logic. They are responsible for:
- Database queries using prepared statements for security
- Data validation and sanitization
- Business rules and domain logic
- Relationships between different data entities

**Example of Model Usage:**
```php
// Get an instance of the Employee model
$employeeModel = new Employee();

// Get all active employees
$activeEmployees = $employeeModel->getAllActive();

// Create a new employee
$newEmployee = $employeeModel->create([
    'name' => 'John Doe',
    'department' => 'IT',
    'is_active' => 1
]);
```

### Views (app/views/)

Views are responsible for generating the UI. The structure includes:
- Layout templates: Define the overall page structure with headers and footers
- Partials: Reusable UI components like navigation menus and alerts
- View templates: Specific page content with placeholders for dynamic data
- Data passing via PHP variables

**Example of View Rendering:**
```php
// In a controller method
$data = [
    'title' => 'Employee Management',
    'employees' => $this->employeeModel->getAll()
];

$this->render('employees/index', $data);
```

### Controllers (app/controllers/)

Controllers handle the application flow and coordinate between models and views:
- Process HTTP requests and user input
- Interact with models to fetch or manipulate data
- Select the appropriate view to render
- Implement application-specific logic

**Example of Controller Method:**
```php
public function index() {
    // Get data from model
    $employees = $this->employeeModel->getAll();
    
    // Prepare data for view
    $data = [
        'title' => 'Employee Management',
        'employees' => $employees
    ];
    
    // Render view
    $this->render('employees/index', $data);
}
```

## Core Components

### Router (app/core/Router.php)

The router is responsible for URL handling:
- Maps URLs to controller actions using simple route definitions
- Extracts parameters from URLs using pattern matching
- Dispatches requests to the appropriate controller method
- Handles 404 errors for undefined routes

```php
// Example of route definition
$router->add('/employees', ['controller' => 'Employee', 'action' => 'index']);
$router->add('/employees/add', ['controller' => 'Employee', 'action' => 'add']);
$router->add('/employees/edit/{id:\d+}', ['controller' => 'Employee', 'action' => 'edit']);
```

### Database (app/core/Database.php)

The database component provides a clean interface for database operations:
- PDO-based database connection using Singleton pattern for resource efficiency
- Query execution with prepared statements for security
- Result fetching methods with support for different return types
- Transaction support for atomic operations

```php
// Example of database usage
$db = Database::getInstance();
$results = $db->query("SELECT * FROM employees WHERE department = ?", ['IT']);
$employee = $db->fetchOne("SELECT * FROM employees WHERE id = ?", [123]);
```

### Controller Base Class (app/core/Controller.php)

The base Controller class provides common functionality for all controllers:
- View rendering with data passing
- Model loading and instantiation
- Redirection methods for navigation
- Session handling and flash messages

### Model Base Class (app/core/Model.php)

The base Model class provides common database operations:
- Basic CRUD operations (Create, Read, Update, Delete)
- Common query methods for fetching records
- Data validation and filtering
- Relationship handling between models

### View Engine (app/core/View.php)

The View class handles template rendering:
- Layout selection for consistent page structure
- Data passing to templates with variable extraction
- Partial inclusion for reusable components
- Error handling for missing templates

## Front Controller

The application uses a front controller pattern (`index.php`) which:
- Bootstraps the application environment
- Initializes the router with application routes
- Dispatches requests to the appropriate controller
- Handles global error catching and logging

## CSS Organization

CSS is organized in a modular way for better maintainability:
- Main stylesheet (`styles.css`) that imports all modules
- Separate module files for different concerns:
  - `base.css`: Variables, typography, and reset styles
  - `layout.css`: Grid system and page structure
  - `forms.css`: Form controls and inputs
  - `components.css`: Reusable UI components
  - `dashboard.css`: Dashboard-specific styles
  - `utilities.css`: Helper classes and responsive styles

## JavaScript Organization

JavaScript is organized with a focus on:
- Modularity: Separate files for different functionality
- Progressive enhancement: Core functionality works without JS
- Performance: Minimal dependencies and efficient DOM operations
- Maintainability: Clear function names and comments

Main JavaScript files:
- `script.js`: Global functionality and UI interactions
- `validation.js`: Form validation for all forms
- `employees.js`: Employee management specific functions
- `visitors.js`: Visitor management specific functions

## Configuration

Configuration is separated from code to make the application more flexible:
- `app/config/database.php`: Database connection settings
- `app/config/config.php`: Application settings
- Environment-specific settings can be added using conditional loading

## Current Status and Transition

The application is currently in a transition phase:
- Legacy pages in the `/php/` directory are being migrated to the MVC structure
- New features are developed using the MVC pattern in the `/app/` directory
- Both approaches work side by side during the transition
- Long-term goal is to fully migrate to the MVC architecture

## Benefits of This Structure

1. **Separation of Concerns**: Clear division between data access, business logic, and presentation
2. **Maintainability**: Easier to maintain and extend the codebase with modular components
3. **Reusability**: Components and code can be reused across the application
4. **Testability**: Clean architecture makes unit testing more straightforward
5. **Scalability**: Code organization that scales well as the application grows
6. **Security**: Separation of data access from presentation helps prevent security issues