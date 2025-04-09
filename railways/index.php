<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Railway Maintenance Coach Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-blue-800 text-white shadow-lg">
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-train text-2xl mr-2"></i>
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
    <header class="bg-blue-600 text-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">Railway Maintenance Coach Profile</h1>
            <p class="text-xl mb-8">Efficient tracking and management of railway coach maintenance</p>
            <button class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-blue-50 transition duration-300">
                Get Started
            </button>
        </div>
    </header>

    <!-- Coaches Section -->
    <section id="coaches" class="py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Our Coaches</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Coach Card 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Sleeper Class Coach</h3>
                        <p class="text-gray-600 mb-4">Regular maintenance schedule for sleeper class coaches</p>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-600 font-semibold">Status: Active</span>
                            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 coach-detail-btn" data-coach-id="1">View Details</button>
                        </div>
                    </div>
                </div>

                <!-- Coach Card 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">AC First Class</h3>
                        <p class="text-gray-600 mb-4">Premium maintenance for AC first class coaches</p>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-600 font-semibold">Status: Active</span>
                            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 coach-detail-btn" data-coach-id="2">View Details</button>
                        </div>
                    </div>
                </div>

                <!-- Coach Card 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">General Class</h3>
                        <p class="text-gray-600 mb-4">Standard maintenance for general class coaches</p>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-600 font-semibold">Status: Active</span>
                            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 coach-detail-btn" data-coach-id="3">View Details</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Maintenance Section -->
    <section id="maintenance" class="bg-gray-50 py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Maintenance Schedule</h2>
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-blue-600 text-white">
                                <th class="px-6 py-3 text-left">Coach Type</th>
                                <th class="px-6 py-3 text-left">Last Maintenance</th>
                                <th class="px-6 py-3 text-left">Next Maintenance</th>
                                <th class="px-6 py-3 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="px-6 py-4">Sleeper Class</td>
                                <td class="px-6 py-4">2024-02-15</td>
                                <td class="px-6 py-4">2024-05-15</td>
                                <td class="px-6 py-4"><span class="bg-green-100 text-green-800 px-2 py-1 rounded">Up to date</span></td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-6 py-4">AC First Class</td>
                                <td class="px-6 py-4">2024-03-01</td>
                                <td class="px-6 py-4">2024-06-01</td>
                                <td class="px-6 py-4"><span class="bg-green-100 text-green-800 px-2 py-1 rounded">Up to date</span></td>
                            </tr>
                            <tr class="border-b">
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
    <section id="contact" class="py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Contact Us</h2>
            <div class="max-w-lg mx-auto">
                <form class="bg-white rounded-lg shadow-md p-6">
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
                        <button class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline" type="submit">
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
                    <h3 class="text-xl font-bold">Railway Maintenance</h3>
                    <p class="text-blue-200">Efficient tracking and management</p>
                </div>
                <div class="flex space-x-4">
                    <a href="#" class="hover:text-blue-200"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="hover:text-blue-200"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="hover:text-blue-200"><i class="fab fa-linkedin"></i></a>
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