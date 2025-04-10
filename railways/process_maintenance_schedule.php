<?php
// Include database configuration
require_once "config.php";

// Check if the request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $maintenance_type = isset($_POST['maintenance_type']) ? trim($_POST['maintenance_type']) : '';
    $maintenance_date = isset($_POST['maintenance_date']) ? trim($_POST['maintenance_date']) : '';
    $technician_id = isset($_POST['technician_id']) ? intval($_POST['technician_id']) : 0;
    $priority = isset($_POST['priority']) ? trim($_POST['priority']) : '';
    $notes = isset($_POST['notes']) ? trim($_POST['notes']) : '';

    // Check for either coach_id or train info
    $coach_id = isset($_POST['coach_id']) ? intval($_POST['coach_id']) : 0;
    $coach_type = isset($_POST['coach_type']) ? trim($_POST['coach_type']) : '';
    $train_number = isset($_POST['train_number']) ? trim($_POST['train_number']) : '';
    $train_name = isset($_POST['train_name']) ? trim($_POST['train_name']) : '';

    // Validate required fields
    if (empty($maintenance_type) || empty($maintenance_date) || $technician_id <= 0 || empty($priority)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Please fill all required fields.'
        ]);
        exit;
    }

    // Validate that we have either coach_id or train info
    if ($coach_id <= 0 && (empty($coach_type) || empty($train_number) || empty($train_name))) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Coach information is required.'
        ]);
        exit;
    }
    
    // If there are no errors, proceed with database insertion
    if (empty($errors)) {
        // Start transaction
        mysqli_begin_transaction($conn);
        
        try {
            // If we have train info but no coach_id, we need to find or create a coach
            if ($coach_id <= 0 && !empty($coach_type) && !empty($train_number) && !empty($train_name)) {
                // Create a new coach
                $coach_name = "$coach_type Coach of $train_name";
                $manufacturing_year = date('Y') - rand(0, 5); // Random recent year
                $capacity = ($coach_type == 'Sleeper') ? 72 : (($coach_type == 'AC First') ? 24 : 120);
                
                $insert_sql = "INSERT INTO coaches (name, type, manufacturing_year, capacity, status, created_at, updated_at) 
                               VALUES (?, ?, ?, ?, 'Active', NOW(), NOW())";
                $stmt = mysqli_prepare($conn, $insert_sql);
                
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "ssis", $coach_name, $coach_type, $manufacturing_year, $capacity);
                    mysqli_stmt_execute($stmt);
                    $coach_id = mysqli_insert_id($conn);
                } else {
                    throw new Exception("Failed to prepare coach creation statement: " . mysqli_error($conn));
                }
            }

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