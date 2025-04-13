<?php
// Start session
session_start();

// Check if user is already logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: index.php");
    exit;
}

// Set timezone to India
date_default_timezone_set('Asia/Kolkata');

// Check for login error
$login_error = $_SESSION['login_error'] ?? '';

// Clear the error message after displaying it
if (isset($_SESSION['login_error'])) {
    unset($_SESSION['login_error']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Railway Maintenance</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .login-section {
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('img/wallpaper1.JPG');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn-primary {
            background-color: #1e40af;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-primary:hover {
            background-color: #1e3a8a;
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }
        .input-field {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        .input-field:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
        }
        .form-card {
            animation: fadeIn 0.8s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .error-alert {
            background-color: #fee2e2;
            border-left: 4px solid #ef4444;
            color: #b91c1c;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <div class="login-section">
        <div class="container mx-auto px-6">
            <div class="max-w-md mx-auto form-card bg-white bg-opacity-95 rounded-lg shadow-2xl p-8">
                <div class="text-center mb-8">
                    <img src="img/logo.png" alt="Railway Logo" class="h-16 w-auto mx-auto mb-4">
                    <h2 class="text-3xl font-bold text-gray-800">Login</h2>
                    <p class="text-gray-600 mt-2">Sign in to access Railway Maintenance</p>
                </div>
                
                <?php if (!empty($login_error)): ?>
                <div class="error-alert">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span><?php echo htmlspecialchars($login_error); ?></span>
                    </div>
                </div>
                <?php endif; ?>
                
                <form action="process_login.php" method="post">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                            <i class="fas fa-user mr-2"></i>Username
                        </label>
                        <input class="input-field" id="username" name="username" type="text" placeholder="Enter your username" required>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                            <i class="fas fa-lock mr-2"></i>Password
                        </label>
                        <input class="input-field" id="password" name="password" type="password" placeholder="Enter your password" required>
                    </div>
                    
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <input id="remember" type="checkbox" class="h-4 w-4 text-blue-600">
                            <label for="remember" class="ml-2 text-sm text-gray-700">Remember me</label>
                        </div>
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-800">Forgot password?</a>
                    </div>
                    
                    <div class="mb-6">
                        <button class="btn-primary w-full" type="submit">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Sign In
                        </button>
                    </div>
                    
                    <div class="text-center text-sm">
                        <p class="text-gray-600">Don't have an account? <a href="register.php" class="text-blue-600 font-medium hover:text-blue-800">Sign up</a></p>
                    </div>
                </form>
                
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <p class="text-center text-sm text-gray-600 mb-3">Or sign in with</p>
                    <div class="flex justify-center space-x-4">
                        <a href="#" class="flex items-center justify-center h-10 w-10 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="flex items-center justify-center h-10 w-10 rounded-full bg-blue-400 text-white hover:bg-blue-500 transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="flex items-center justify-center h-10 w-10 rounded-full bg-red-600 text-white hover:bg-red-700 transition duration-300">
                            <i class="fab fa-google"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-8">
                <a href="index.php" class="text-white hover:text-blue-200 transition duration-300">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Home
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fade out error message after 5 seconds
            const errorAlert = document.querySelector('.error-alert');
            if (errorAlert) {
                setTimeout(() => {
                    errorAlert.style.opacity = '0';
                    errorAlert.style.transition = 'opacity 0.5s ease';
                    setTimeout(() => {
                        errorAlert.style.display = 'none';
                    }, 500);
                }, 5000);
            }
        });
    </script>
</body>
</html> 