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
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('img/wallpaper1.JPG');
            background-size: cover;
            background-position: center;
            padding-top: 80px;
        }
        .coach-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .coach-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -1;
        }
        .sleeper-card::before {
            background-image: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), url('img/bg2.jpg');
            background-size: cover;
            background-position: center;
        }
        .ac-card::before {
            background-image: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), url('img/bg3.jpg');
            background-size: cover;
            background-position: center;
        }
        .general-card::before {
            background-image: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), url('img/bg4.jpg');
            background-size: cover;
            background-position: center;
        }
        .coach-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        .coach-icon {
            transition: all 0.3s ease;
            background-color: rgba(219, 234, 254, 0.8);
        }
        .coach-card:hover .coach-icon {
            transform: scale(1.1);
            background-color: rgba(37, 99, 235, 0.1);
        }
        .section-title {
            position: relative;
        }
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: #2563eb;
            border-radius: 3px;
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
                    <div class="flex items-center mb-4">
                        <div class="bg-blue-600 p-3 rounded-full mr-4">
                            <i class="fas fa-train text-2xl"></i>
                        </div>
                        <h1 class="text-3xl md:text-4xl font-bold"><?php echo htmlspecialchars($train_name); ?></h1>
                    </div>
                    <p class="text-xl mb-2 flex items-center">
                        <i class="fas fa-hashtag mr-2 text-blue-300"></i>
                        Train Number: <?php echo htmlspecialchars($train_number); ?>
                    </p>
                    <p class="text-lg text-blue-300 flex items-center mb-4">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <?php echo htmlspecialchars($zone); ?>
                    </p>
                    <div class="mt-6 flex items-center">
                        <span class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg mr-4">
                            <i class="fas fa-info-circle mr-2"></i> Select Coach Type for Maintenance
                        </span>
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <div class="bg-blue-800 bg-opacity-50 p-6 rounded-lg shadow-lg">
                        <div class="text-center">
                            <i class="fas fa-train text-6xl mb-4"></i>
                            <p class="text-xl font-semibold">Maintenance Schedule</p>
                            <p class="text-blue-300 mt-2">Regular maintenance ensures safety and comfort</p>
                            <div class="mt-4 bg-blue-900 bg-opacity-50 p-3 rounded-lg">
                                <p class="text-sm">
                                    <i class="fas fa-check-circle mr-1"></i> Select coach type below to schedule maintenance
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-8 flex justify-center">
                <a href="javascript:history.back()" class="bg-transparent border border-white text-white px-6 py-3 rounded-lg hover:bg-white hover:text-blue-600 transition duration-300 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Trains
                </a>
            </div>
        </div>
    </header>

    <!-- Coach Selection -->
    <section class="py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-16 section-title">Select Coach Type for Maintenance</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Sleeper Class -->
                <div class="coach-card sleeper-card bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="coach-icon p-4 rounded-full mr-4">
                                <i class="fas fa-bed text-3xl text-blue-600"></i>
                            </div>
                            <h3 class="text-xl font-semibold">Sleeper Class Coach</h3>
                        </div>
                        <p class="text-gray-600 mb-4">Regular maintenance schedule for sleeper class coaches. Includes berth inspection, linen service check, and comfort standards verification.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-600 font-semibold flex items-center">
                                <i class="fas fa-check-circle mr-1"></i>
                                Status: Active
                            </span>
                        </div>
                        <div class="mt-4">
                            <a href="schedule_maintenance.php?coach_type=Sleeper&train=<?php echo urlencode($train_number); ?>&name=<?php echo urlencode($train_name); ?>" class="block w-full bg-blue-600 text-white text-center px-4 py-2 rounded hover:bg-blue-700 transition duration-300">
                                Schedule Maintenance
                            </a>
                        </div>
                    </div>
                </div>

                <!-- AC First Class -->
                <div class="coach-card ac-card bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="coach-icon p-4 rounded-full mr-4">
                                <i class="fas fa-snowflake text-3xl text-blue-600"></i>
                            </div>
                            <h3 class="text-xl font-semibold">AC First Class</h3>
                        </div>
                        <p class="text-gray-600 mb-4">Premium maintenance for AC first class coaches. Includes climate control systems, cabin comfort, and enhanced passenger amenities check.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-600 font-semibold flex items-center">
                                <i class="fas fa-check-circle mr-1"></i>
                                Status: Active
                            </span>
                        </div>
                        <div class="mt-4">
                            <a href="schedule_maintenance.php?coach_type=AC First&train=<?php echo urlencode($train_number); ?>&name=<?php echo urlencode($train_name); ?>" class="block w-full bg-blue-600 text-white text-center px-4 py-2 rounded hover:bg-blue-700 transition duration-300">
                                Schedule Maintenance
                            </a>
                        </div>
                    </div>
                </div>

                <!-- General Class -->
                <div class="coach-card general-card bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="coach-icon p-4 rounded-full mr-4">
                                <i class="fas fa-users text-3xl text-blue-600"></i>
                            </div>
                            <h3 class="text-xl font-semibold">General Class</h3>
                        </div>
                        <p class="text-gray-600 mb-4">Standard maintenance for general class coaches. Includes seat inspection, safety checks, and basic passenger comfort verification.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-600 font-semibold flex items-center">
                                <i class="fas fa-check-circle mr-1"></i>
                                Status: Active
                            </span>
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