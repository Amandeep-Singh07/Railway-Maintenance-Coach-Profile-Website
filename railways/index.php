<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Railway Maintenance Coach Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('img/wallpaper1.JPG');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding-top: 80px; /* Added padding to account for navbar */
        }
        .coach-card {
            background-image: url('img/bg1.jpg');
            background-size: cover;
            background-position: center;
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
        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-blue-800 text-white shadow-lg fixed w-full z-50 top-0">
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
                </div>
                <button class="md:hidden">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section text-white py-32">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">Railway Maintenance Coach Profile</h1>
            <p class="text-xl mb-8">Efficient tracking and management of railway coach maintenance</p>
            <div class="dropdown inline-block">
                <button class="bg-blue-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-blue-700 transition duration-300 transform hover:scale-105 flex items-center">
                    Choose Your Zone
                    <i class="fas fa-chevron-down ml-2"></i>
                </button>
                <div class="dropdown-content">
                    <a href="zone_trains.php?zone=Central Railway" class="flex items-center">
                        <i class="fas fa-train mr-2"></i>
                        Central Railway
                    </a>
                    <a href="zone_trains.php?zone=Eastern Railway" class="flex items-center">
                        <i class="fas fa-train mr-2"></i>
                        Eastern Railway
                    </a>
                    <a href="zone_trains.php?zone=Northern Railway" class="flex items-center">
                        <i class="fas fa-train mr-2"></i>
                        Northern Railway
                    </a>
                    <a href="zone_trains.php?zone=Southern Railway" class="flex items-center">
                        <i class="fas fa-train mr-2"></i>
                        Southern Railway
                    </a>
                    <a href="zone_trains.php?zone=Western Railway" class="flex items-center">
                        <i class="fas fa-train mr-2"></i>
                        Western Railway
                    </a>
                    <a href="zone_trains.php?zone=South Central Railway" class="flex items-center">
                        <i class="fas fa-train mr-2"></i>
                        South Central Railway
                    </a>
                    <a href="zone_trains.php?zone=North Central Railway" class="flex items-center">
                        <i class="fas fa-train mr-2"></i>
                        North Central Railway
                    </a>
                    <a href="zone_trains.php?zone=South Eastern Railway" class="flex items-center">
                        <i class="fas fa-train mr-2"></i>
                        South Eastern Railway
                    </a>
                    <a href="zone_trains.php?zone=North Eastern Railway" class="flex items-center">
                        <i class="fas fa-train mr-2"></i>
                        North Eastern Railway
                    </a>
                    <a href="zone_trains.php?zone=East Central Railway" class="flex items-center">
                        <i class="fas fa-train mr-2"></i>
                        East Central Railway
                    </a>
                    <a href="zone_trains.php?zone=East Coast Railway" class="flex items-center">
                        <i class="fas fa-train mr-2"></i>
                        East Coast Railway
                    </a>
                    <a href="zone_trains.php?zone=North Western Railway" class="flex items-center">
                        <i class="fas fa-train mr-2"></i>
                        North Western Railway
                    </a>
                    <a href="zone_trains.php?zone=South Western Railway" class="flex items-center">
                        <i class="fas fa-train mr-2"></i>
                        South Western Railway
                    </a>
                    <a href="zone_trains.php?zone=West Central Railway" class="flex items-center">
                        <i class="fas fa-train mr-2"></i>
                        West Central Railway
                    </a>
                    <a href="zone_trains.php?zone=South East Central Railway" class="flex items-center">
                        <i class="fas fa-train mr-2"></i>
                        South East Central Railway
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Coaches Section -->
    <section id="coaches" class="py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Our Coaches</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Coach Card 1 -->
                <div class="coach-card rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition duration-300">
                    <div class="p-6 bg-black bg-opacity-50 text-white">
                        <h3 class="text-xl font-semibold mb-2">Sleeper Class Coach</h3>
                        <p class="text-gray-200 mb-4">Regular maintenance schedule for sleeper class coaches</p>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-300 font-semibold">Status: Active</span>
                            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 coach-detail-btn" data-coach-id="1">View Details</button>
                        </div>
                    </div>
                </div>

                <!-- Coach Card 2 -->
                <div class="coach-card rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition duration-300">
                    <div class="p-6 bg-black bg-opacity-50 text-white">
                        <h3 class="text-xl font-semibold mb-2">AC First Class</h3>
                        <p class="text-gray-200 mb-4">Premium maintenance for AC first class coaches</p>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-300 font-semibold">Status: Active</span>
                            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 coach-detail-btn" data-coach-id="2">View Details</button>
                        </div>
                    </div>
                </div>

                <!-- Coach Card 3 -->
                <div class="coach-card rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition duration-300">
                    <div class="p-6 bg-black bg-opacity-50 text-white">
                        <h3 class="text-xl font-semibold mb-2">General Class</h3>
                        <p class="text-gray-200 mb-4">Standard maintenance for general class coaches</p>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-300 font-semibold">Status: Active</span>
                            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 coach-detail-btn" data-coach-id="3">View Details</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Maintenance Section -->
    <section id="maintenance" class="maintenance-section text-white py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Maintenance Schedule</h2>
            <div class="bg-white bg-opacity-90 rounded-lg shadow-md p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-gray-800">
                        <thead>
                            <tr class="bg-blue-600 text-white">
                                <th class="px-6 py-3 text-left">Coach Type</th>
                                <th class="px-6 py-3 text-left">Last Maintenance</th>
                                <th class="px-6 py-3 text-left">Next Maintenance</th>
                                <th class="px-6 py-3 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4">Sleeper Class</td>
                                <td class="px-6 py-4">2024-02-15</td>
                                <td class="px-6 py-4">2024-05-15</td>
                                <td class="px-6 py-4"><span class="bg-green-100 text-green-800 px-2 py-1 rounded">Up to date</span></td>
                            </tr>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4">AC First Class</td>
                                <td class="px-6 py-4">2024-03-01</td>
                                <td class="px-6 py-4">2024-06-01</td>
                                <td class="px-6 py-4"><span class="bg-green-100 text-green-800 px-2 py-1 rounded">Up to date</span></td>
                            </tr>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4">General Class</td>
                                <td class="px-6 py-4">2024-02-28</td>
                                <td class="px-6 py-4">2024-05-28</td>
                                <td class="px-6 py-4"><span class="bg-green-100 text-green-800 px-2 py-1 rounded">Up to date</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section text-white py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Contact Us</h2>
            <div class="max-w-lg mx-auto">
                <form class="bg-white bg-opacity-90 rounded-lg shadow-md p-6">
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
                    <div class="flex items-center justify-center">
                        <button class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline transform hover:scale-105 transition duration-300" type="submit">
                            Send Message
                        </button>
                    </div>
                </form>
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

    <script src="js/main.js"></script>
</body>
</html> 