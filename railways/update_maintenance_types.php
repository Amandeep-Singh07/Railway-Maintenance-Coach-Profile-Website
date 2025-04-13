<?php
// Include database configuration
require_once "config.php";

// Update coaches table maintenance types
$sql = "UPDATE coaches SET 
    maintenance_type = CASE 
        WHEN maintenance_type = 'Routine' THEN 'General Inspection'
        WHEN maintenance_type = 'Preventive' THEN 'Electrical System Check'
        WHEN maintenance_type = 'Corrective' THEN 'Brake System Repair'
        ELSE maintenance_type
    END";

if (mysqli_query($conn, $sql)) {
    echo "Coaches table updated successfully.<br>";
} else {
    echo "Error updating coaches table: " . mysqli_error($conn) . "<br>";
}

// Update maintenance_history table maintenance types
$sql = "UPDATE maintenance_history SET 
    maintenance_type = CASE 
        WHEN maintenance_type = 'Routine' THEN 'General Inspection'
        WHEN maintenance_type = 'Preventive' THEN 'Electrical System Check'
        WHEN maintenance_type = 'Corrective' THEN 'Brake System Repair'
        ELSE maintenance_type
    END";

if (mysqli_query($conn, $sql)) {
    echo "Maintenance history table updated successfully.<br>";
} else {
    echo "Error updating maintenance history table: " . mysqli_error($conn) . "<br>";
}

// Update maintenance_schedule table maintenance types
$sql = "UPDATE maintenance_schedule SET 
    maintenance_type = CASE 
        WHEN maintenance_type = 'Routine' THEN 'General Inspection'
        WHEN maintenance_type = 'Preventive' THEN 'Electrical System Check'
        WHEN maintenance_type = 'Corrective' THEN 'Brake System Repair'
        ELSE maintenance_type
    END";

if (mysqli_query($conn, $sql)) {
    echo "Maintenance schedule table updated successfully.<br>";
} else {
    echo "Error updating maintenance schedule table: " . mysqli_error($conn) . "<br>";
}

echo "<p>All maintenance types have been updated to more specific issues.</p>";
echo "<p><a href='index.php'>Return to Dashboard</a></p>";
?> 