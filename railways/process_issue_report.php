<?php
// Include database configuration
require_once "config.php";

// Check if the request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $coach_id = isset($_POST["coach_id"]) ? intval($_POST["coach_id"]) : 0;
    $issue_type = trim($_POST["issue_type"]);
    $issue_description = trim($_POST["issue_description"]);
    $priority = trim($_POST["priority"]);
    
    // Validate data
    $errors = [];
    
    if ($coach_id <= 0) {
        $errors[] = "Invalid coach ID";
    }
    
    if (empty($issue_type)) {
        $errors[] = "Issue type is required";
    }
    
    if (empty($issue_description)) {
        $errors[] = "Issue description is required";
    }
    
    if (empty($priority)) {
        $errors[] = "Priority is required";
    }
    
    // If there are no errors, proceed with database insertion
    if (empty($errors)) {
        // Prepare an insert statement
        $sql = "INSERT INTO issue_reports (coach_id, issue_type, issue_description, priority, status, created_at) 
                VALUES (?, ?, ?, ?, 'Open', NOW())";
        
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "isss", $coach_id, $issue_type, $issue_description, $priority);
            
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Send success response
                echo json_encode(["status" => "success", "message" => "Issue report submitted successfully!"]);
            } else {
                // Send error response
                echo json_encode(["status" => "error", "message" => "Something went wrong. Please try again later."]);
            }
            
            // Close statement
            mysqli_stmt_close($stmt);
        } else {
            // Send error response
            echo json_encode(["status" => "error", "message" => "Database error. Please try again later."]);
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