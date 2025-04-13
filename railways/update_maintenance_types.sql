-- Update coaches table maintenance types
UPDATE coaches SET 
    maintenance_type = CASE 
        WHEN maintenance_type = 'Routine' THEN 'General Inspection'
        WHEN maintenance_type = 'Preventive' THEN 'Electrical System Check'
        WHEN maintenance_type = 'Corrective' THEN 'Brake System Repair'
        ELSE maintenance_type
    END;

-- Update maintenance_history table maintenance types
UPDATE maintenance_history SET 
    maintenance_type = CASE 
        WHEN maintenance_type = 'Routine' THEN 'General Inspection'
        WHEN maintenance_type = 'Preventive' THEN 'Electrical System Check'
        WHEN maintenance_type = 'Corrective' THEN 'Brake System Repair'
        ELSE maintenance_type
    END;

-- Update maintenance_schedule table maintenance types
UPDATE maintenance_schedule SET 
    maintenance_type = CASE 
        WHEN maintenance_type = 'Routine' THEN 'General Inspection'
        WHEN maintenance_type = 'Preventive' THEN 'Electrical System Check'
        WHEN maintenance_type = 'Corrective' THEN 'Brake System Repair'
        ELSE maintenance_type
    END; 