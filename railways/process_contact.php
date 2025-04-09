<?php
// Include database configuration
require_once "config.php";

// Check if the request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);
    
    // Prepare an insert statement
    $sql = "INSERT INTO contact_messages (name, email, message, created_at) VALUES (?, ?, ?, NOW())";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $message);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Send success response
            echo json_encode(["status" => "success", "message" => "Message sent successfully!"]);
        } else{
            // Send error response
            echo json_encode(["status" => "error", "message" => "Something went wrong. Please try again later."]);
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
}
?> 