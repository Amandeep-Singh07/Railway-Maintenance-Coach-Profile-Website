<?php
// Start session
session_start();

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted username and password
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Simple validation
    if (empty($username) || empty($password)) {
        $_SESSION['login_error'] = "Username and password are required";
        header("Location: login.php");
        exit;
    }
    
    // Connect to database
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $username);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Store result
            mysqli_stmt_store_result($stmt);
            
            // Check if username exists, if yes then verify password
            if(mysqli_stmt_num_rows($stmt) == 1){
                // Bind result variables
                mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                
                if(mysqli_stmt_fetch($stmt)){
                    if(password_verify($password, $hashed_password)){
                        // Password is correct, so start a new session
                        session_start();
                        
                        // Store data in session variables
                        $_SESSION['user_id'] = $id;
                        $_SESSION['username'] = $username;
                        $_SESSION['logged_in'] = true;
                        
                        // Redirect user to welcome page
                        header("Location: index.php");
                        exit;
                    } else {
                        // Password is not valid
                        $_SESSION['login_error'] = "Invalid username or password";
                        header("Location: login.php");
                        exit;
                    }
                }
            } else {
                // Username doesn't exist
                $_SESSION['login_error'] = "Invalid username or password";
                header("Location: login.php");
                exit;
            }
        } else {
            $_SESSION['login_error'] = "Oops! Something went wrong. Please try again later.";
            header("Location: login.php");
            exit;
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
} else {
    // If someone tries to access this page directly
    header("Location: login.php");
    exit;
}
?> 