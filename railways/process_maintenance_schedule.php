<?php
// Include database configuration
require_once "config.php";

// Check if the request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $coach_id = isset($_POST["coach_id"]) ? intval($_POST["coach_id"]) : 0;
    $maintenance_type = trim($_POST["maintenance_type"]);
    $maintenance_date = trim($_POST["maintenance_date"]);
    $technician_id = isset($_POST["technician_id"]) ? intval($_POST["technician_id"]) : 0;
    $priority = trim($_POST["priority"]);
    $notes = trim($_POST["notes"]);
    
    // Validate data
    $errors = [];
    
    if ($coach_id <= 0) {
        $errors[] = "Invalid coach ID";
    }
    
    if (empty($maintenance_type)) {
        $errors[] = "Maintenance type is required";
    }
    
    if (empty($maintenance_date)) {
        $errors[] = "Maintenance date is required";
    }
    
    if ($technician_id <= 0) {
        $errors[] = "Technician is required";
    }
    
    if (empty($priority)) {
        $errors[] = "Priority is required";
    }
    
    // If there are no errors, proceed with database insertion
    if (empty($errors)) {
        // Start transaction
        mysqli_begin_transaction($conn);
        
        try {
            // Insert into maintenance_schedule table
            $sql = "INSERT INTO maintenance_schedule (coach_id, maintenance_type, maintenance_date, technician_id, priority, notes, status, created_at) 
                    VALUES (?, ?, ?, ?, ?, ?, 'Scheduled', NOW())";
            
            if ($stmt = mysqli_prepare($conn, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ississ", $coach_id, $maintenance_type, $maintenance_date, $technician_id, $priority, $notes);
                
                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    // Update coach's next maintenance date
                    $update_sql = "UPDATE coaches SET next_maintenance = ?, maintenance_type = ?, assigned_technician = (SELECT name FROM technicians WHERE id = ?) WHERE id = ?";
                    
                    if ($update_stmt = mysqli_prepare($conn, $update_sql)) {
                        mysqli_stmt_bind_param($update_stmt, "ssii", $maintenance_date, $maintenance_type, $technician_id, $coach_id);
                        
                        if (mysqli_stmt_execute($update_stmt)) {
                            // Update technician status
                            $tech_sql = "UPDATE technicians SET status = 'Assigned' WHERE id = ?";
                            
                            if ($tech_stmt = mysqli_prepare($conn, $tech_sql)) {
                                mysqli_stmt_bind_param($tech_stmt, "i", $technician_id);
                                
                                if (mysqli_stmt_execute($tech_stmt)) {
                                    // Commit transaction
                                    mysqli_commit($conn);
                                    
                                    // Send success response
                                    echo json_encode(["status" => "success", "message" => "Maintenance scheduled successfully!"]);
                                } else {
                                    throw new Exception("Failed to update technician status");
                                }
                                
                                mysqli_stmt_close($tech_stmt);
                            } else {
                                throw new Exception("Failed to prepare technician update statement");
                            }
                        } else {
                            throw new Exception("Failed to update coach maintenance information");
                        }
                        
                        mysqli_stmt_close($update_stmt);
                    } else {
                        throw new Exception("Failed to prepare coach update statement");
                    }
                } else {
                    throw new Exception("Failed to schedule maintenance");
                }
                
                mysqli_stmt_close($stmt);
            } else {
                throw new Exception("Failed to prepare maintenance schedule statement");
            }
        } catch (Exception $e) {
            // Rollback transaction on error
            mysqli_rollback($conn);
            
            // Send error response
            echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
        }
    } else {
        // Send validation error response
        echo json_encode(["status" => "error", "message" => implode(", ", $errors)]);
    }
    
    // Close connection
    mysqli_close($conn);
} else {
    // If not POST request, return error
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}
?> 