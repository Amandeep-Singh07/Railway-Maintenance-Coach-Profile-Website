<?php
// Include database connection
require_once 'config.php';

// Get train and zone parameters
$train_number = isset($_GET['train']) ? $_GET['train'] : '';
$train_name = isset($_GET['name']) ? $_GET['name'] : '';
$zone = isset($_GET['zone']) ? $_GET['zone'] : '';

// If any required parameter is missing, redirect to home
if (empty($train_number) || empty($train_name) || empty($zone)) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coach Maintenance - <?php echo htmlspecialchars($train_name); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .page-header {
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('img/bg3.jpg');
            background-size: cover;
            background-position: center;
            padding-top: 80px;
        }
        .coach-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .coach-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-blue-800 text-white shadow-lg fixed w-full z-50 top-0">
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <a href="index.php" class="flex items-center">
                        <img src="img/logo.png" alt="Railway Logo" class="h-12 w-auto mr-2">
                        <span class="text-xl font-bold">Railway Maintenance</span>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <a href="index.php" class="hover:text-blue-200">Home</a>
                    <a href="index.php#coaches" class="hover:text-blue-200">Coaches</a>
                    <a href="index.php#maintenance" class="hover:text-blue-200">Maintenance</a>
                    <a href="index.php#contact" class="hover:text-blue-200">Contact</a>
                </div>
                <button class="md:hidden">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="page-header text-white py-16">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0">
                    <h1 class="text-3xl md:text-4xl font-bold mb-2"><?php echo htmlspecialchars($train_name); ?></h1>
                    <p class="text-xl mb-2">Train Number: <?php echo htmlspecialchars($train_number); ?></p>
                    <p class="text-lg text-blue-300"><?php echo htmlspecialchars($zone); ?></p>
                    <div class="mt-6 flex items-center">
                        <span class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg mr-4">
                            <i class="fas fa-info-circle mr-2"></i> Select Coach Type for Maintenance
                        </span>
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <div class="bg-blue-800 bg-opacity-50 p-6 rounded-lg">
                        <div class="text-center">
                            <i class="fas fa-train text-6xl mb-4"></i>
                            <p class="text-xl">Maintenance Schedule</p>
                            <p class="text-blue-300 mt-2">Regular maintenance ensures safety and comfort</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Coach Selection -->
    <section class="py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Select Coach Type for Maintenance</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Sleeper Class -->
                <div class="coach-card bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-bed text-3xl text-blue-600 mr-4"></i>
                            <h3 class="text-xl font-semibold">Sleeper Class Coach</h3>
                        </div>
                        <p class="text-gray-600 mb-4">Regular maintenance schedule for sleeper class coaches</p>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-600 font-semibold">Status: Active</span>
                        </div>
                        <div class="mt-4">
                            <a href="schedule_maintenance.php?coach_type=Sleeper&train=<?php echo urlencode($train_number); ?>&name=<?php echo urlencode($train_name); ?>" class="block w-full bg-blue-600 text-white text-center px-4 py-2 rounded hover:bg-blue-700 transition duration-300">
                                Schedule Maintenance
                            </a>
                        </div>
                    </div>
                </div>

                <!-- AC First Class -->
                <div class="coach-card bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-snowflake text-3xl text-blue-600 mr-4"></i>
                            <h3 class="text-xl font-semibold">AC First Class</h3>
                        </div>
                        <p class="text-gray-600 mb-4">Premium maintenance for AC first class coaches</p>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-600 font-semibold">Status: Active</span>
                        </div>
                        <div class="mt-4">
                            <a href="schedule_maintenance.php?coach_type=AC First&train=<?php echo urlencode($train_number); ?>&name=<?php echo urlencode($train_name); ?>" class="block w-full bg-blue-600 text-white text-center px-4 py-2 rounded hover:bg-blue-700 transition duration-300">
                                Schedule Maintenance
                            </a>
                        </div>
                    </div>
                </div>

                <!-- General Class -->
                <div class="coach-card bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-users text-3xl text-blue-600 mr-4"></i>
                            <h3 class="text-xl font-semibold">General Class</h3>
                        </div>
                        <p class="text-gray-600 mb-4">Standard maintenance for general class coaches</p>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-600 font-semibold">Status: Active</span>
                        </div>
                        <div class="mt-4">
                            <a href="schedule_maintenance.php?coach_type=General&train=<?php echo urlencode($train_number); ?>&name=<?php echo urlencode($train_name); ?>" class="block w-full bg-blue-600 text-white text-center px-4 py-2 rounded hover:bg-blue-700 transition duration-300">
                                Schedule Maintenance
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-800 text-white py-8">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <img src="img/logo.png" alt="Railway Logo" class="h-12 w-auto mb-2">
                    <p class="text-blue-200">Efficient tracking and management</p>
                </div>
                <div class="flex space-x-4">
                    <a href="#" class="hover:text-blue-200 transform hover:scale-110 transition duration-300"><i class="fab fa-facebook text-2xl"></i></a>
                    <a href="#" class="hover:text-blue-200 transform hover:scale-110 transition duration-300"><i class="fab fa-twitter text-2xl"></i></a>
                    <a href="#" class="hover:text-blue-200 transform hover:scale-110 transition duration-300"><i class="fab fa-linkedin text-2xl"></i></a>
                </div>
            </div>
            <div class="mt-8 text-center text-blue-200">
                <p>&copy; 2024 Railway Maintenance. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html> 