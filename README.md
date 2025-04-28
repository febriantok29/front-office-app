# Front Office Application

A comprehensive front office management system for managing visitors, employees, and office activities.

## Features

- **Visitor Management**: Register visitors and track their information
- **Employee Directory**: Manage employee information and availability
- **Dashboard**: View key metrics and quick actions
- **Responsive Design**: Works on desktop and mobile devices

## Getting Started

### Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server

### Installation

1. Clone the repository:
   ```
   git clone https://github.com/febriantok29/front-office-app.git
   ```

2. Set up the database:
   - Create a new MySQL database named `front_office_db`
   - Import the database schema from `/db/setup.sql`

3. Configure the application:
   - Update database settings in `/app/config/database.php`
   - Update application settings in `/app/config/config.php`

4. Set up your web server:
   - Point your web server to the `/public` directory as the document root
   - Ensure the server has proper write permissions for logs and uploads

5. Access the application:
   - Visit `http://localhost/front-office-app` in your web browser
   - Default login: admin / password123 (change immediately)

## Project Structure

This project follows an MVC (Model-View-Controller) structure with a modular design. For detailed information about the project structure, see [Project Structure Documentation](docs/project-structure.md).

## Development

### Coding Standards

- Follow PSR-4 for autoloading
- Follow PSR-12 for code style
- Document all classes and methods with PHPDoc comments

### Adding New Features

1. Create a new model in `/app/models/`
2. Create a new controller in `/app/controllers/`
3. Create view templates in `/app/views/feature-name/`
4. Add routes in `/public/index.php`

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Acknowledgments

- Font Awesome for icons
- Inter font family