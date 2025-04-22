-- Update existing technicians to ensure they have Indian names
-- (Already seems to be the case, but confirming)
UPDATE technicians SET 
    name = 'Rajesh Kumar' WHERE id = 1;
UPDATE technicians SET 
    name = 'Priya Sharma' WHERE id = 2;
UPDATE technicians SET 
    name = 'Vikram Singh' WHERE id = 3;
UPDATE technicians SET 
    name = 'Ananya Patel' WHERE id = 4;
UPDATE technicians SET 
    name = 'Suresh Reddy' WHERE id = 5;
UPDATE technicians SET 
    name = 'Meera Gupta' WHERE id = 6;

-- Add more technicians with Indian names
INSERT INTO technicians (name, specialization, contact_number, email, status) VALUES
('Aditya Verma', 'Mechanical', '555-789-0123', 'aditya.verma@railway.com', 'Available'),
('Neha Kapoor', 'Electrical', '555-890-1234', 'neha.kapoor@railway.com', 'Available'),
('Rohit Iyer', 'HVAC Systems', '555-901-2345', 'rohit.iyer@railway.com', 'Available'),
('Deepika Malhotra', 'Brake Systems', '555-012-3456', 'deepika.malhotra@railway.com', 'Available'),
('Arjun Nair', 'Suspension', '555-123-4567', 'arjun.nair@railway.com', 'Available'),
('Kavita Desai', 'Door Mechanisms', '555-234-5678', 'kavita.desai@railway.com', 'Available'),
('Siddharth Joshi', 'Wheel & Axle', '555-345-6789', 'siddharth.joshi@railway.com', 'Available'),
('Lakshmi Rao', 'Plumbing', '555-456-7890', 'lakshmi.rao@railway.com', 'Available');

-- Update coaches to ensure their assigned technicians have Indian names
UPDATE coaches SET 
    assigned_technician = 'Rajesh Kumar' 
    WHERE id = 1;
UPDATE coaches SET 
    assigned_technician = 'Priya Sharma' 
    WHERE id = 2;
UPDATE coaches SET 
    assigned_technician = 'Vikram Singh' 
    WHERE id = 3;

-- Update maintenance_history to ensure all technicians have Indian names
UPDATE maintenance_history SET 
    technician = 'Rajesh Kumar' 
    WHERE technician = 'Rajesh Kumar' OR 
          technician LIKE '%John%' OR 
          technician LIKE '%Michael%' OR 
          technician LIKE '%David%';

UPDATE maintenance_history SET 
    technician = 'Priya Sharma' 
    WHERE technician = 'Priya Sharma' OR 
          technician LIKE '%Jennifer%' OR 
          technician LIKE '%Sarah%' OR 
          technician LIKE '%Jessica%';

UPDATE maintenance_history SET 
    technician = 'Vikram Singh' 
    WHERE technician = 'Vikram Singh' OR 
          technician LIKE '%Robert%' OR 
          technician LIKE '%William%' OR 
          technician LIKE '%James%'; 