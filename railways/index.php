<?php
// Start session
session_start();

// Check if user is logged in
$logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;

// If user is not logged in, redirect to login page
if (!$logged_in) {
    header("Location: login.php");
    exit;
}

// Set timezone to India
date_default_timezone_set('Asia/Kolkata');
$current_date = date('Y-m-d');
// Calculate dates for display
$last_month_date = date('Y-m-d', strtotime('-1 month'));
$three_months_future = date('Y-m-d', strtotime('+3 months'));
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Railway Maintenance Coach Profile</title>
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
            min-height: 90vh;
            display: flex;
            align-items: center;
        }
        .coach-card {
            background-size: cover;
            background-position: center;
            position: relative;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            transition: all 0.4s ease;
        }
        .coach-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
        }
        .coach-card-sleeper {
            background-image: url('img/bg1.jpg');
        }
        .coach-card-ac {
            background-image: url('img/bg4.jpg');
        }
        .coach-card-general {
            background-image: url('img/bg7.jpg');
        }
        .coach-card > div {
            position: relative;
            z-index: 10;
            height: 100%;
        }
        .coach-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .maintenance-section {
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('img/bg2.jpg');
            background-size: cover;
            background-position: center;
        }
        .contact-section {
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('img/bg3.jpg');
            background-size: cover;
            background-position: center;
        }
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: rgba(255, 255, 255, 0.95);
            min-width: 250px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            z-index: 100;
            border-radius: 0.5rem;
            margin-top: 0.5rem;
            left: 50%;
            transform: translateX(-50%);
            max-height: 400px;
            overflow-y: auto;
        }
        .dropdown-content a {
            color: #1e40af;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: all 0.3s ease;
            text-align: left;
        }
        .dropdown-content a:hover {
            background-color: #f3f4f6;
            color: #1e3a8a;
        }
        .show {
            display: block;
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
        .animate-fade-in {
            animation: fadeIn 0.8s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .table-container {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }
        table th {
            font-weight: 600;
            padding: 1rem;
        }
        table td {
            padding: 1rem;
            transition: all 0.2s ease;
        }
        tr:hover td {
            background-color: #f1f5f9;
        }
        .status-tag {
            display: inline-block;
            padding: 0.35rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
        }
        .status-success {
            background-color: #dcfce7;
            color: #166534;
        }
        /* Theme switch styles */
        .theme-switch {
            position: fixed;
            top: 80px;
            right: 20px;
            z-index: 100;
        }
        .theme-btn {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
            color: white;
            padding: 0.5rem;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        .theme-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }
        /* Dark theme styles */
        html[data-theme="dark"] body {
            background-color: #111827;
            color: #e5e7eb;
        }
        html[data-theme="dark"] .bg-white {
            background-color: #1f2937 !important;
        }
        html[data-theme="dark"] .bg-gray-50 {
            background-color: #111827 !important;
        }
        html[data-theme="dark"] .bg-gray-100 {
            background-color: #1f2937 !important;
        }
        html[data-theme="dark"] .text-gray-600 {
            color: #9ca3af !important;
        }
        html[data-theme="dark"] .text-gray-700 {
            color: #d1d5db !important;
        }
        html[data-theme="dark"] .text-gray-800, 
        html[data-theme="dark"] .text-gray-900 {
            color: #f3f4f6 !important;
        }
        html[data-theme="dark"] .border-gray-200 {
            border-color: #374151 !important;
        }
        html[data-theme="dark"] .dropdown-content {
            background-color: #1f2937;
        }
        html[data-theme="dark"] .dropdown-content a {
            color: #e5e7eb;
        }
        html[data-theme="dark"] .dropdown-content a:hover {
            background-color: #374151;
            color: #f3f4f6;
        }
        html[data-theme="dark"] tr:hover td {
            background-color: #374151;
        }
        html[data-theme="dark"] .text-blue-600 {
            color: #60a5fa !important;
        }
        html[data-theme="dark"] .text-indigo-600 {
            color: #818cf8 !important;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Theme Switch Button -->
    <div class="theme-switch">
        <button id="themeToggle" class="theme-btn" aria-label="Toggle Theme">
            <i class="fas fa-moon"></i>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="bg-gradient-to-r from-blue-800 to-blue-900 text-white shadow-lg fixed w-full z-50 top-0 transition-all duration-300">
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <img src="img/logo.png" alt="Railway Logo" class="h-12 w-auto mr-2">
                    <span class="text-xl font-bold">Railway Maintenance</span>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <a href="#" class="hover:text-blue-200">Home</a>
                    <a href="#coaches" class="hover:text-blue-200">Coaches</a>
                    <a href="#maintenance" class="hover:text-blue-200">Maintenance</a>
                    <a href="#contact" class="hover:text-blue-200">Contact</a>
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
            <h1 class="text-5xl md:text-7xl font-bold mb-6">Railway Maintenance Coach Profile</h1>
            <p class="text-xl md:text-2xl mb-12 max-w-3xl mx-auto">Efficient tracking and management of railway coach maintenance across all Indian railway zones</p>
            <div class="dropdown inline-block">
                <a href="zone_selection.php" class="btn-primary flex items-center">
                    Choose Your Zone
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </header>

    <!-- Coaches Section -->
    <section id="coaches" class="py-24 bg-gradient-to-b from-gray-50 to-gray-100">
        <div class="container mx-auto px-6">
            <h2 class="section-title">Our Coaches</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Coach Card 1 -->
                <div class="coach-card coach-card-sleeper rounded-lg shadow-md overflow-hidden transform transition duration-300 animate-fade-in" style="animation-delay: 0.1s">
                    <div class="p-6 text-white">
                        <h3 class="text-xl font-semibold mb-2">Sleeper Class Coach</h3>
                        <p class="text-gray-200 mb-4">Regular maintenance schedule for sleeper class coaches</p>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-300 font-semibold flex items-center"><i class="fas fa-check-circle mr-2"></i>Status: Active</span>
                            <button class="btn-primary flex items-center coach-detail-btn" data-coach-id="1">
                                <span>View Details</span>
                                <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Coach Card 2 -->
                <div class="coach-card coach-card-ac rounded-lg shadow-md overflow-hidden transform transition duration-300 animate-fade-in" style="animation-delay: 0.2s">
                    <div class="p-6 text-white">
                        <h3 class="text-xl font-semibold mb-2">AC First Class</h3>
                        <p class="text-gray-200 mb-4">Premium maintenance for AC first class coaches</p>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-300 font-semibold flex items-center"><i class="fas fa-check-circle mr-2"></i>Status: Active</span>
                            <button class="btn-primary flex items-center coach-detail-btn" data-coach-id="2">
                                <span>View Details</span>
                                <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Coach Card 3 -->
                <div class="coach-card coach-card-general rounded-lg shadow-md overflow-hidden transform transition duration-300 animate-fade-in" style="animation-delay: 0.3s">
                    <div class="p-6 text-white">
                        <h3 class="text-xl font-semibold mb-2">General Class</h3>
                        <p class="text-gray-200 mb-4">Standard maintenance for general class coaches</p>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-300 font-semibold flex items-center"><i class="fas fa-check-circle mr-2"></i>Status: Active</span>
                            <button class="btn-primary flex items-center coach-detail-btn" data-coach-id="3">
                                <span>View Details</span>
                                <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Maintenance Section -->
    <section id="maintenance" class="maintenance-section text-white py-24">
        <div class="container mx-auto px-6">
            <h2 class="section-title text-white">Maintenance Schedule</h2>
            <div class="bg-white bg-opacity-95 rounded-lg shadow-xl p-8 animate-fade-in">
                <div class="overflow-x-auto table-container">
                    <table class="min-w-full text-gray-800">
                        <thead>
                            <tr class="bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                                <th class="px-6 py-3 text-left">Coach Type</th>
                                <th class="px-6 py-3 text-left">Last Maintenance</th>
                                <th class="px-6 py-3 text-left">Next Maintenance</th>
                                <th class="px-6 py-3 text-left">Assigned Technician</th>
                                <th class="px-6 py-3 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4">Sleeper Class</td>
                                <td class="px-6 py-4"><?php echo date('Y-m-d', strtotime('-32 days')); ?></td>
                                <td class="px-6 py-4"><?php echo date('Y-m-d', strtotime('+58 days')); ?></td>
                                <td class="px-6 py-4">Rajesh Kumar</td>
                                <td class="px-6 py-4"><span class="status-tag status-success">Up to date</span></td>
                            </tr>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4">AC First Class</td>
                                <td class="px-6 py-4"><?php echo date('Y-m-d', strtotime('-15 days')); ?></td>
                                <td class="px-6 py-4"><?php echo date('Y-m-d', strtotime('+75 days')); ?></td>
                                <td class="px-6 py-4">Priya Sharma</td>
                                <td class="px-6 py-4"><span class="status-tag status-success">Up to date</span></td>
                            </tr>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4">General Class</td>
                                <td class="px-6 py-4"><?php echo date('Y-m-d', strtotime('-25 days')); ?></td>
                                <td class="px-6 py-4"><?php echo date('Y-m-d', strtotime('+65 days')); ?></td>
                                <td class="px-6 py-4">Vikram Singh</td>
                                <td class="px-6 py-4"><span class="status-tag status-success">Up to date</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section text-white py-24">
        <div class="container mx-auto px-6">
            <h2 class="section-title text-white">Contact Us</h2>
            <div class="max-w-xl mx-auto animate-fade-in">
                <form class="bg-white bg-opacity-95 rounded-lg shadow-xl p-8">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Name</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Your Name">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="Your Email">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="message">Message</label>
                        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="message" placeholder="Your Message"></textarea>
                    </div>
                    <div class="flex items-center justify-center mt-6">
                        <button class="btn-primary w-full max-w-xs flex items-center justify-center" type="submit">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Send Message
                        </button>
                    </div>
                </form>
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

    <script src="js/main.js"></script>
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
            
            // Theme switcher functionality
            const themeToggle = document.getElementById('themeToggle');
            const htmlElement = document.documentElement;
            const themeIcon = themeToggle.querySelector('i');
            
            // Check for saved theme preference or use default light theme
            const savedTheme = localStorage.getItem('theme') || 'light';
            htmlElement.setAttribute('data-theme', savedTheme);
            
            // Update icon based on current theme
            updateThemeIcon(savedTheme);
            
            // Toggle theme when button is clicked
            themeToggle.addEventListener('click', () => {
                const currentTheme = htmlElement.getAttribute('data-theme');
                const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                
                htmlElement.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                
                updateThemeIcon(newTheme);
            });
            
            // Function to update the icon based on theme
            function updateThemeIcon(theme) {
                if (theme === 'dark') {
                    themeIcon.classList.remove('fa-moon');
                    themeIcon.classList.add('fa-sun');
                } else {
                    themeIcon.classList.remove('fa-sun');
                    themeIcon.classList.add('fa-moon');
                }
            }
        });

        // Toggle dropdown
        function toggleDropdown() {
            document.getElementById("zoneDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.btn-primary') && !event.target.matches('.fa-chevron-down')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</body>
</html> 