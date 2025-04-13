<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit;
}

// Set timezone to India
date_default_timezone_set('Asia/Kolkata');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Railway Zone Selection</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .hero-section {
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('img/wallpaper1.JPG');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding-top: 80px; /* Added padding to account for navbar */
            min-height: 30vh;
            display: flex;
            align-items: center;
        }
        .zone-card {
            transition: all 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
        .zone-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        .animate-fade-in {
            animation: fadeIn 0.8s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .section-title {
            font-size: 2rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 2.5rem;
            position: relative;
            padding-bottom: 1rem;
        }
        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #1e40af, #3b82f6);
            border-radius: 2px;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-gradient-to-r from-blue-800 to-blue-900 text-white shadow-lg fixed w-full z-50 top-0 transition-all duration-300">
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <a href="index.php">
                        <img src="img/logo.png" alt="Railway Logo" class="h-12 w-auto mr-2">
                    </a>
                    <span class="text-xl font-bold">Railway Maintenance</span>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <a href="index.php" class="hover:text-blue-200">Home</a>
                    <a href="index.php#coaches" class="hover:text-blue-200">Coaches</a>
                    <a href="index.php#maintenance" class="hover:text-blue-200">Maintenance</a>
                    <a href="index.php#contact" class="hover:text-blue-200">Contact</a>
                    <div class="flex items-center ml-4 pl-4 border-l border-blue-400">
                        <span class="text-white mr-3">
                            <i class="fas fa-user-circle mr-1"></i>
                            Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>
                        </span>
                        <a href="logout.php" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded text-sm flex items-center transition duration-300">
                            <i class="fas fa-sign-out-alt mr-1"></i> Logout
                        </a>
                    </div>
                </div>
                <button class="md:hidden">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section text-white">
        <div class="container mx-auto px-6 text-center animate-fade-in">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Select Your Railway Zone</h1>
            <p class="text-xl mb-4">Choose from the available railway zones across India</p>
        </div>
    </header>

    <!-- Zones Section -->
    <section class="py-16">
        <div class="container mx-auto px-6">
            <h2 class="section-title">Railway Zones</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <!-- Zone 1 -->
                <a href="zone_trains.php?zone=Central Railway" class="zone-card p-6 animate-fade-in" style="animation-delay: 0.1s">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fas fa-train text-blue-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">Central Railway</h3>
                            <p class="text-gray-600">Mumbai, Maharashtra</p>
                        </div>
                    </div>
                </a>

                <!-- Zone 2 -->
                <a href="zone_trains.php?zone=Eastern Railway" class="zone-card p-6 animate-fade-in" style="animation-delay: 0.15s">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fas fa-train text-blue-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">Eastern Railway</h3>
                            <p class="text-gray-600">Kolkata, West Bengal</p>
                        </div>
                    </div>
                </a>

                <!-- Zone 3 -->
                <a href="zone_trains.php?zone=Northern Railway" class="zone-card p-6 animate-fade-in" style="animation-delay: 0.2s">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fas fa-train text-blue-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">Northern Railway</h3>
                            <p class="text-gray-600">Delhi</p>
                        </div>
                    </div>
                </a>

                <!-- Zone 4 -->
                <a href="zone_trains.php?zone=Southern Railway" class="zone-card p-6 animate-fade-in" style="animation-delay: 0.25s">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fas fa-train text-blue-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">Southern Railway</h3>
                            <p class="text-gray-600">Chennai, Tamil Nadu</p>
                        </div>
                    </div>
                </a>

                <!-- Zone 5 -->
                <a href="zone_trains.php?zone=Western Railway" class="zone-card p-6 animate-fade-in" style="animation-delay: 0.3s">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fas fa-train text-blue-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">Western Railway</h3>
                            <p class="text-gray-600">Mumbai, Maharashtra</p>
                        </div>
                    </div>
                </a>

                <!-- Zone 6 -->
                <a href="zone_trains.php?zone=South Central Railway" class="zone-card p-6 animate-fade-in" style="animation-delay: 0.35s">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fas fa-train text-blue-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">South Central Railway</h3>
                            <p class="text-gray-600">Secunderabad, Telangana</p>
                        </div>
                    </div>
                </a>

                <!-- Zone 7 -->
                <a href="zone_trains.php?zone=North Central Railway" class="zone-card p-6 animate-fade-in" style="animation-delay: 0.4s">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fas fa-train text-blue-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">North Central Railway</h3>
                            <p class="text-gray-600">Allahabad, Uttar Pradesh</p>
                        </div>
                    </div>
                </a>

                <!-- Zone 8 -->
                <a href="zone_trains.php?zone=South Eastern Railway" class="zone-card p-6 animate-fade-in" style="animation-delay: 0.45s">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fas fa-train text-blue-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">South Eastern Railway</h3>
                            <p class="text-gray-600">Kolkata, West Bengal</p>
                        </div>
                    </div>
                </a>

                <!-- Zone 9 -->
                <a href="zone_trains.php?zone=North Eastern Railway" class="zone-card p-6 animate-fade-in" style="animation-delay: 0.5s">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fas fa-train text-blue-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">North Eastern Railway</h3>
                            <p class="text-gray-600">Gorakhpur, Uttar Pradesh</p>
                        </div>
                    </div>
                </a>

                <!-- Zone 10 -->
                <a href="zone_trains.php?zone=East Central Railway" class="zone-card p-6 animate-fade-in" style="animation-delay: 0.55s">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fas fa-train text-blue-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">East Central Railway</h3>
                            <p class="text-gray-600">Hajipur, Bihar</p>
                        </div>
                    </div>
                </a>

                <!-- Zone 11 -->
                <a href="zone_trains.php?zone=East Coast Railway" class="zone-card p-6 animate-fade-in" style="animation-delay: 0.6s">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fas fa-train text-blue-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">East Coast Railway</h3>
                            <p class="text-gray-600">Bhubaneswar, Odisha</p>
                        </div>
                    </div>
                </a>

                <!-- Zone 12 -->
                <a href="zone_trains.php?zone=North Western Railway" class="zone-card p-6 animate-fade-in" style="animation-delay: 0.65s">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fas fa-train text-blue-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">North Western Railway</h3>
                            <p class="text-gray-600">Jaipur, Rajasthan</p>
                        </div>
                    </div>
                </a>

                <!-- Zone 13 -->
                <a href="zone_trains.php?zone=South Western Railway" class="zone-card p-6 animate-fade-in" style="animation-delay: 0.7s">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fas fa-train text-blue-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">South Western Railway</h3>
                            <p class="text-gray-600">Hubli, Karnataka</p>
                        </div>
                    </div>
                </a>

                <!-- Zone 14 -->
                <a href="zone_trains.php?zone=West Central Railway" class="zone-card p-6 animate-fade-in" style="animation-delay: 0.75s">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fas fa-train text-blue-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">West Central Railway</h3>
                            <p class="text-gray-600">Jabalpur, Madhya Pradesh</p>
                        </div>
                    </div>
                </a>

                <!-- Zone 15 -->
                <a href="zone_trains.php?zone=South East Central Railway" class="zone-card p-6 animate-fade-in" style="animation-delay: 0.8s">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fas fa-train text-blue-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">South East Central Railway</h3>
                            <p class="text-gray-600">Bilaspur, Chhattisgarh</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-blue-900 to-blue-800 text-white py-6">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <div class="flex items-center">
                    <img src="img/logo.png" alt="Railway Logo" class="h-10 w-auto mr-3">
                    <p class="text-blue-200 text-sm">Efficient tracking and management</p>
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="hover:text-blue-200 transition duration-300"><i class="fab fa-facebook text-xl"></i></a>
                    <a href="#" class="hover:text-blue-200 transition duration-300"><i class="fab fa-twitter text-xl"></i></a>
                    <a href="#" class="hover:text-blue-200 transition duration-300"><i class="fab fa-linkedin text-xl"></i></a>
                </div>
            </div>
            <div class="mt-4 text-center text-blue-200 text-sm border-t border-blue-700 pt-4">
                <p>&copy; <?php echo date('Y'); ?> Railway Maintenance. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Simple scroll reveal animation
        document.addEventListener('DOMContentLoaded', function() {
            const animateElements = document.querySelectorAll('.animate-fade-in');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = 1;
                        entry.target.style.transform = 'translateY(0)';
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });
            
            animateElements.forEach(element => {
                element.style.opacity = 0;
                element.style.transform = 'translateY(20px)';
                element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(element);
            });
        });
    </script>
</body>
</html> 