<?php
// Start session
session_start();

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted username and password
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // In a real application, you would validate credentials against a database
    // For demo purposes, we'll use hardcoded credentials
    $valid_username = "rajesh";
    $valid_password = "railway123"; // In production, use password_hash() and password_verify()
    
    // Simple validation
    if (empty($username) || empty($password)) {
        $_SESSION['login_error'] = "Username and password are required";
        header("Location: login.php");
        exit;
    }
    
    // Check credentials
    if ($username === $valid_username && $password === $valid_password) {
        // Set session variables
        $_SESSION['user_id'] = 1;
        $_SESSION['username'] = $username;
        $_SESSION['logged_in'] = true;
        
        // Redirect to the home page
        header("Location: index.php");
        exit;
    } else {
        // Invalid credentials
        $_SESSION['login_error'] = "Invalid username or password";
        header("Location: login.php");
        exit;
    }
} else {
    // If someone tries to access this page directly
    header("Location: login.php");
    exit;
}
?> 