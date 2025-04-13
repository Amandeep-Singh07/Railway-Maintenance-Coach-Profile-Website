<?php
// Start session
session_start();

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted form data
    $fullname = $_POST['fullname'] ?? '';
    $email = $_POST['email'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $terms = isset($_POST['terms']);
    
    // Simple validation
    if (empty($fullname) || empty($email) || empty($username) || empty($password) || empty($confirm_password)) {
        $_SESSION['register_error'] = "All fields are required";
        header("Location: register.php");
        exit;
    }
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['register_error'] = "Invalid email format";
        header("Location: register.php");
        exit;
    }
    
    // Check if passwords match
    if ($password !== $confirm_password) {
        $_SESSION['register_error'] = "Passwords do not match";
        header("Location: register.php");
        exit;
    }
    
    // Check terms agreement
    if (!$terms) {
        $_SESSION['register_error'] = "You must agree to terms and conditions";
        header("Location: register.php");
        exit;
    }
    
    // Connect to database
    require_once "config.php";
    
    // Check if username already exists
    $check_sql = "SELECT id FROM users WHERE username = ?";
    if($stmt = mysqli_prepare($conn, $check_sql)) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        
        if(mysqli_stmt_num_rows($stmt) > 0){
            $_SESSION['register_error'] = "This username is already taken";
            header("Location: register.php");
            exit;
        }
        mysqli_stmt_close($stmt);
    }
    
    // Check if email already exists
    $check_sql = "SELECT id FROM users WHERE email = ?";
    if($stmt = mysqli_prepare($conn, $check_sql)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        
        if(mysqli_stmt_num_rows($stmt) > 0){
            $_SESSION['register_error'] = "This email is already registered";
            header("Location: register.php");
            exit;
        }
        mysqli_stmt_close($stmt);
    }
    
    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Insert user into database
    $insert_sql = "INSERT INTO users (fullname, email, username, password, created_at) VALUES (?, ?, ?, ?, NOW())";
    
    if($stmt = mysqli_prepare($conn, $insert_sql)) {
        mysqli_stmt_bind_param($stmt, "ssss", $fullname, $email, $username, $hashed_password);
        
        if(mysqli_stmt_execute($stmt)){
            $_SESSION['register_success'] = "Registration successful! You can now log in.";
            header("Location: login.php");
            exit;
        } else {
            $_SESSION['register_error'] = "Something went wrong. Please try again later.";
            header("Location: register.php");
            exit;
        }
        
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
} else {
    // If someone tries to access this page directly
    header("Location: register.php");
    exit;
}
?> 