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
    
    // In a real application, you would:
    // 1. Check if username/email already exists in database
    // 2. Hash the password using password_hash()
    // 3. Store user data in a database
    // 4. Send verification email
    
    // For this demo, we'll just create a success message
    $_SESSION['register_success'] = "Registration successful! You can now log in.";
    
    // Redirect to login page
    header("Location: login.php");
    exit;
} else {
    // If someone tries to access this page directly
    header("Location: register.php");
    exit;
}
?> 