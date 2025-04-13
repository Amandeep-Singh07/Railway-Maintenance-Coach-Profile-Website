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

// Check for registration error
$register_error = $_SESSION['register_error'] ?? '';
$register_success = $_SESSION['register_success'] ?? '';

// Clear the messages after displaying them
if (isset($_SESSION['register_error'])) {
    unset($_SESSION['register_error']);
}
if (isset($_SESSION['register_success'])) {
    unset($_SESSION['register_success']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Railway Maintenance</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .register-section {
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
        .success-alert {
            background-color: #dcfce7;
            border-left: 4px solid #22c55e;
            color: #166534;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <div class="register-section">
        <div class="container mx-auto px-6">
            <div class="max-w-md mx-auto form-card bg-white bg-opacity-95 rounded-lg shadow-2xl p-8">
                <div class="text-center mb-8">
                    <img src="img/logo.png" alt="Railway Logo" class="h-16 w-auto mx-auto mb-4">
                    <h2 class="text-3xl font-bold text-gray-800">Create Account</h2>
                    <p class="text-gray-600 mt-2">Sign up to access Railway Maintenance</p>
                </div>
                
                <?php if (!empty($register_error)): ?>
                <div class="error-alert">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span><?php echo htmlspecialchars($register_error); ?></span>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($register_success)): ?>
                <div class="success-alert">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span><?php echo htmlspecialchars($register_success); ?></span>
                    </div>
                </div>
                <?php endif; ?>
                
                <form action="process_register.php" method="post">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="fullname">
                            <i class="fas fa-user mr-2"></i>Full Name
                        </label>
                        <input class="input-field" id="fullname" name="fullname" type="text" placeholder="Enter your full name" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                            <i class="fas fa-envelope mr-2"></i>Email
                        </label>
                        <input class="input-field" id="email" name="email" type="email" placeholder="Enter your email" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                            <i class="fas fa-user-tag mr-2"></i>Username
                        </label>
                        <input class="input-field" id="username" name="username" type="text" placeholder="Choose a username" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                            <i class="fas fa-lock mr-2"></i>Password
                        </label>
                        <input class="input-field" id="password" name="password" type="password" placeholder="Create a password" required>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="confirm_password">
                            <i class="fas fa-lock mr-2"></i>Confirm Password
                        </label>
                        <input class="input-field" id="confirm_password" name="confirm_password" type="password" placeholder="Confirm your password" required>
                    </div>
                    
                    <div class="mb-6">
                        <div class="flex items-center">
                            <input id="terms" name="terms" type="checkbox" class="h-4 w-4 text-blue-600" required>
                            <label for="terms" class="ml-2 text-sm text-gray-700">I agree to the <a href="#" class="text-blue-600 hover:text-blue-800">Terms and Conditions</a></label>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <button class="btn-primary w-full" type="submit">
                            <i class="fas fa-user-plus mr-2"></i>
                            Create Account
                        </button>
                    </div>
                    
                    <div class="text-center text-sm">
                        <p class="text-gray-600">Already have an account? <a href="login.php" class="text-blue-600 font-medium hover:text-blue-800">Sign in</a></p>
                    </div>
                </form>
            </div>
            
            <div class="text-center mt-8">
                <a href="login.php" class="text-white hover:text-blue-200 transition duration-300">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Login
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fade out alert messages after 5 seconds
            const alertMessages = document.querySelectorAll('.error-alert, .success-alert');
            if (alertMessages.length > 0) {
                setTimeout(() => {
                    alertMessages.forEach(alert => {
                        alert.style.opacity = '0';
                        alert.style.transition = 'opacity 0.5s ease';
                        setTimeout(() => {
                            alert.style.display = 'none';
                        }, 500);
                    });
                }, 5000);
            }
            
            // Password confirmation validation
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirm_password');
            const form = document.querySelector('form');
            
            form.addEventListener('submit', function(event) {
                if (password.value !== confirmPassword.value) {
                    event.preventDefault();
                    alert('Passwords do not match');
                }
            });
        });
    </script>
</body>
</html> 