# Railway Maintenance Coach Profile System

A comprehensive web application for managing railway coach maintenance, tracking maintenance schedules, and reporting issues.

## Features

- **Coach Management**: View and manage details of different types of railway coaches
- **Maintenance Scheduling**: Schedule maintenance for coaches with assigned technicians
- **Issue Reporting**: Report and track issues with coaches
- **Maintenance History**: View maintenance history for each coach
- **Contact Form**: Submit inquiries and messages

## System Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache, Nginx, etc.)
- Modern web browser

## Installation

1. **Database Setup**:

   - Create a MySQL database named `railway_maintenance`
   - Import the `database_setup.sql` file to create the necessary tables and sample data

   ```sql
   mysql -u root -p < database_setup.sql
   ```

2. **Configuration**:

   - Open `config.php` and update the database connection details if needed:

   ```php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_NAME', 'railway_maintenance');
   ```

3. **Web Server Setup**:
   - Place the files in your web server's document root or a subdirectory
   - Ensure the web server has read/write permissions for the directory

## Usage

### Viewing Coaches

1. Open the application in your web browser
2. Navigate to the "Coaches" section to view all available coaches
3. Click "View Details" on any coach to see detailed information

### Scheduling Maintenance

1. From the coach details page, click "Schedule Maintenance"
2. Fill in the maintenance details:
   - Maintenance Type
   - Maintenance Date
   - Assigned Technician
   - Priority
   - Notes
3. Click "Schedule Maintenance" to save

### Reporting Issues

1. From the coach details page, scroll to the "Issue Reports" section
2. Fill in the issue details:
   - Issue Type
   - Description
   - Priority
3. Click "Submit Report" to save

### Contact Form

1. Navigate to the "Contact" section
2. Fill in your name, email, and message
3. Click "Send Message" to submit

## Database Structure

The application uses the following tables:

- **coaches**: Stores information about railway coaches
- **technicians**: Stores information about maintenance technicians
- **maintenance_schedule**: Stores scheduled maintenance tasks
- **maintenance_history**: Stores completed maintenance records
- **issue_reports**: Stores reported issues with coaches
- **contact_messages**: Stores messages submitted through the contact form

## Customization

### Adding New Coach Types

To add a new coach type, insert a new record into the `coaches` table:

```sql
INSERT INTO coaches (name, type, manufacturing_year, capacity, status)
VALUES ('New Coach Type', 'Type Name', 2024, 100, 'Active');
```

### Adding New Technicians

To add a new technician, insert a new record into the `technicians` table:

```sql
INSERT INTO technicians (name, specialization, contact_number, email, status)
VALUES ('Technician Name', 'Specialization', '555-123-4567', 'email@example.com', 'Available');
```

## Troubleshooting

### Common Issues

1. **Database Connection Error**:

   - Check your database credentials in `config.php`
   - Ensure the MySQL service is running

2. **Form Submission Issues**:

   - Check browser console for JavaScript errors
   - Verify that all required fields are filled

3. **Page Not Found**:
   - Check your web server configuration
   - Verify file permissions

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Acknowledgments

- Font Awesome for icons
- Tailwind CSS for styling
