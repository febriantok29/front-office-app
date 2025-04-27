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
│   ├── core/               # Core framework classes
│   │   ├── bootstrap.php   # Application bootstrap
│   │   ├── Controller.php  # Base controller
│   │   ├── Database.php    # Database connection
│   │   ├── Model.php       # Base model
│   │   ├── Router.php      # URL routing
│   │   └── View.php        # View rendering
│   ├── models/             # Model classes
│   └── views/              # View templates
│       ├── dashboard/      # Dashboard views
│       ├── employees/      # Employee management views
│       ├── errors/         # Error pages
│       ├── layouts/        # Layout templates
│       ├── partials/       # Reusable view components
│       └── visitors/       # Visitor management views
├── docs/                   # Documentation
├── public/                 # Public web root
│   ├── assets/             # Public assets
│   │   ├── css/            # CSS files
│   │   │   └── modules/    # Modular CSS files
│   │   ├── img/            # Images
│   │   └── js/             # JavaScript files
│   └── index.php           # Front controller entry point
└── db/                     # Database scripts
    └── setup.sql           # Database setup script
```

## Architectural Pattern

The application follows an MVC (Model-View-Controller) architectural pattern:

### Models (app/models/)

Models handle data access and business logic. They are responsible for:
- Database queries
- Data validation
- Business rules

### Views (app/views/)

Views are responsible for generating the UI. The structure includes:
- Layout templates: Define the page structure
- Partials: Reusable UI components
- View templates: Specific page content

### Controllers (app/controllers/)

Controllers handle the application flow and coordinate between models and views:
- Process input from the user
- Interact with models to fetch or manipulate data
- Select the appropriate view to render

## Core Components

### Router (app/core/Router.php)

The router is responsible for URL handling:
- Maps URLs to controller actions
- Extracts parameters from URLs
- Dispatches requests to the appropriate controller

### Database (app/core/Database.php)

The database component provides a clean interface for database operations:
- PDO-based database connection using Singleton pattern
- Query execution with prepared statements
- Result fetching methods

### Controller Base Class (app/core/Controller.php)

The base Controller class provides common functionality for all controllers:
- View rendering
- Model loading
- Redirection
- Response handling

### Model Base Class (app/core/Model.php)

The base Model class provides common database operations:
- Basic CRUD operations (Create, Read, Update, Delete)
- Common query methods

### View Engine (app/core/View.php)

The View class handles template rendering:
- Layout selection
- Data passing to templates
- Partial inclusion

## Front Controller

The application uses a front controller pattern (`public/index.php`) which:
- Bootstraps the application
- Initializes the router
- Defines routes
- Dispatches requests to the appropriate controller

## CSS Organization

CSS is organized in a modular way:
- Main stylesheet that imports all modules
- Separate module files for different concerns:
  - Base styles
  - Layout
  - Forms
  - UI Components
  - Dashboard-specific styles
  - Utility classes

## JavaScript Organization

JavaScript is organized to:
- Provide common functionality in a central script
- Use specific scripts for particular features when needed
- Follow a module-based approach

## Configuration

Configuration is separated from code:
- Database settings in `app/config/database.php`
- Application settings in `app/config/config.php`
- Environment-specific settings can be added

## Benefits of This Structure

1. **Separation of Concerns**: Clear division between data access, business logic, and presentation
2. **Maintainability**: Easier to maintain and extend the codebase
3. **Reusability**: Components and code can be reused across the application
4. **Testability**: Easier to test individual components
5. **Scalability**: Code organization that scales well as the application grows