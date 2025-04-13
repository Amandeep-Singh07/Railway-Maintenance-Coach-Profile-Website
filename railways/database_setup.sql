-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS railway_maintenance;
USE railway_maintenance;

-- Create coaches table
CREATE TABLE IF NOT EXISTS coaches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    type VARCHAR(50) NOT NULL,
    manufacturing_year INT NOT NULL,
    capacity INT NOT NULL,
    status ENUM('Active', 'Maintenance', 'Retired') NOT NULL DEFAULT 'Active',
    last_maintenance DATE,
    next_maintenance DATE,
    maintenance_type VARCHAR(50),
    assigned_technician VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create technicians table
CREATE TABLE IF NOT EXISTS technicians (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    specialization VARCHAR(100),
    contact_number VARCHAR(20),
    email VARCHAR(100),
    status ENUM('Available', 'Assigned', 'On Leave') NOT NULL DEFAULT 'Available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create maintenance_schedule table
CREATE TABLE IF NOT EXISTS maintenance_schedule (
    id INT AUTO_INCREMENT PRIMARY KEY,
    coach_id INT NOT NULL,
    maintenance_type VARCHAR(50) NOT NULL,
    maintenance_date DATE NOT NULL,
    technician_id INT NOT NULL,
    priority ENUM('Low', 'Medium', 'High', 'Critical') NOT NULL,
    notes TEXT,
    status ENUM('Scheduled', 'In Progress', 'Completed', 'Cancelled') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (coach_id) REFERENCES coaches(id) ON DELETE CASCADE,
    FOREIGN KEY (technician_id) REFERENCES technicians(id) ON DELETE CASCADE
);

-- Create maintenance_history table
CREATE TABLE IF NOT EXISTS maintenance_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    coach_id INT NOT NULL,
    maintenance_date DATE NOT NULL,
    maintenance_type VARCHAR(50) NOT NULL,
    technician VARCHAR(100) NOT NULL,
    status ENUM('Completed', 'Incomplete') NOT NULL,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (coach_id) REFERENCES coaches(id) ON DELETE CASCADE
);

-- Create issue_reports table
CREATE TABLE IF NOT EXISTS issue_reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    coach_id INT NOT NULL,
    issue_type VARCHAR(50) NOT NULL,
    issue_description TEXT NOT NULL,
    priority ENUM('Low', 'Medium', 'High', 'Critical') NOT NULL,
    status ENUM('Open', 'Assigned', 'In Progress', 'Resolved', 'Closed') NOT NULL DEFAULT 'Open',
    assigned_to INT,
    resolution_notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (coach_id) REFERENCES coaches(id) ON DELETE CASCADE,
    FOREIGN KEY (assigned_to) REFERENCES technicians(id) ON DELETE SET NULL
);

-- Create contact_messages table
CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample data for coaches using dynamic dates
-- Current date will be calculated when script is run
INSERT INTO coaches (name, type, manufacturing_year, capacity, status, last_maintenance, next_maintenance, maintenance_type, assigned_technician) VALUES
('Sleeper Class Coach', 'Sleeper', 2015, 72, 'Active', DATE_SUB(CURRENT_DATE(), INTERVAL 32 DAY), DATE_ADD(CURRENT_DATE(), INTERVAL 58 DAY), 'Routine', 'Rajesh Kumar'),
('AC First Class', 'AC First', 2018, 24, 'Active', DATE_SUB(CURRENT_DATE(), INTERVAL 15 DAY), DATE_ADD(CURRENT_DATE(), INTERVAL 75 DAY), 'Preventive', 'Priya Sharma'),
('General Class', 'General', 2016, 120, 'Active', DATE_SUB(CURRENT_DATE(), INTERVAL 25 DAY), DATE_ADD(CURRENT_DATE(), INTERVAL 65 DAY), 'Routine', 'Vikram Singh');

-- Insert sample data for technicians
INSERT INTO technicians (name, specialization, contact_number, email, status) VALUES
('Rajesh Kumar', 'Mechanical', '555-123-4567', 'rajesh.kumar@railway.com', 'Assigned'),
('Priya Sharma', 'Electrical', '555-234-5678', 'priya.sharma@railway.com', 'Assigned'),
('Vikram Singh', 'Structural', '555-345-6789', 'vikram.singh@railway.com', 'Assigned'),
('Ananya Patel', 'Mechanical', '555-456-7890', 'ananya.patel@railway.com', 'Available'),
('Suresh Reddy', 'Electrical', '555-567-8901', 'suresh.reddy@railway.com', 'Available'),
('Meera Gupta', 'Interior', '555-678-9012', 'meera.gupta@railway.com', 'Available');

-- Insert sample data for maintenance_history using dynamic dates
INSERT INTO maintenance_history (coach_id, maintenance_date, maintenance_type, technician, status, notes) VALUES
(1, DATE_SUB(CURRENT_DATE(), INTERVAL 32 DAY), 'Routine', 'Rajesh Kumar', 'Completed', 'Regular maintenance completed successfully. All systems functioning properly.'),
(2, DATE_SUB(CURRENT_DATE(), INTERVAL 15 DAY), 'Preventive', 'Priya Sharma', 'Completed', 'Preventive maintenance completed. Replaced air filters and checked electrical systems.'),
(3, DATE_SUB(CURRENT_DATE(), INTERVAL 25 DAY), 'Routine', 'Vikram Singh', 'Completed', 'Routine inspection completed. Minor repairs performed on seating.'),
(1, DATE_SUB(CURRENT_DATE(), INTERVAL 122 DAY), 'Corrective', 'Rajesh Kumar', 'Completed', 'Fixed braking system issues. Replaced worn components.'),
(2, DATE_SUB(CURRENT_DATE(), INTERVAL 105 DAY), 'Routine', 'Priya Sharma', 'Completed', 'Regular maintenance completed. All systems checked and functioning properly.'); 