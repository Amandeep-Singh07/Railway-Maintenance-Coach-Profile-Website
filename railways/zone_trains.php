<?php
// Include database connection
require_once 'config.php';

// Get zone from URL parameter
$zone = isset($_GET['zone']) ? $_GET['zone'] : 'Central Railway';

// Sample train data - in a real application, you would fetch this from the database
$train_data = [
    'Central Railway' => [
        ['number' => '12051', 'name' => 'Dadar - Madgaon Jan Shatabdi Express'],
        ['number' => '12123', 'name' => 'Deccan Queen Express'],
        ['number' => '12139', 'name' => 'Mumbai CST - Pune Intercity Express'],
        ['number' => '11019', 'name' => 'Mumbai CST - Bhubaneswar Konark Express'],
        ['number' => '11007', 'name' => 'Mumbai CST - Pune Deccan Express'],
        ['number' => '11009', 'name' => 'Mumbai CST - Sinhagad Express'],
        ['number' => '12261', 'name' => 'Mumbai CST - Howrah Mail'],
    ],
    'Eastern Railway' => [
        ['number' => '12301', 'name' => 'Howrah - New Delhi Rajdhani Express'],
        ['number' => '12311', 'name' => 'Howrah - Kalka Mail'],
        ['number' => '12321', 'name' => 'Howrah - Mumbai CST Mail'],
        ['number' => '12329', 'name' => 'West Bengal Sampark Kranti Express'],
        ['number' => '12339', 'name' => 'Coalfield Express'],
        ['number' => '12343', 'name' => 'Darjeeling Mail'],
        ['number' => '12345', 'name' => 'Saraighat Express'],
    ],
    'Northern Railway' => [
        ['number' => '12001', 'name' => 'New Delhi - Bhopal Shatabdi Express'],
        ['number' => '12011', 'name' => 'Kalka Shatabdi Express'],
        ['number' => '12013', 'name' => 'New Delhi - Amritsar Shatabdi Express'],
        ['number' => '12015', 'name' => 'New Delhi - Dehradun Shatabdi Express'],
        ['number' => '12033', 'name' => 'Kanpur Shatabdi Express'],
        ['number' => '12049', 'name' => 'Gatimaan Express'],
        ['number' => '12305', 'name' => 'Howrah - New Delhi Rajdhani Express'],
    ],
    'Southern Railway' => [
        ['number' => '12007', 'name' => 'Chennai - Mysore Shatabdi Express'],
        ['number' => '12027', 'name' => 'Chennai - Bangalore Shatabdi Express'],
        ['number' => '12243', 'name' => 'Chennai - Coimbatore Shatabdi Express'],
        ['number' => '12625', 'name' => 'Kerala Express'],
        ['number' => '12671', 'name' => 'Nilgiri Express'],
        ['number' => '12695', 'name' => 'Chennai - Thiruvananthapuram Express'],
        ['number' => '16339', 'name' => 'Mumbai CST - Nagercoil Express'],
    ],
    'Western Railway' => [
        ['number' => '12009', 'name' => 'Mumbai - Ahmedabad Shatabdi Express'],
        ['number' => '12903', 'name' => 'Golden Temple Mail'],
        ['number' => '12925', 'name' => 'Paschim Express'],
        ['number' => '12951', 'name' => 'Mumbai Central - New Delhi Rajdhani Express'],
        ['number' => '12953', 'name' => 'August Kranti Rajdhani Express'],
        ['number' => '12955', 'name' => 'Mumbai Central - Jaipur Superfast Express'],
        ['number' => '12961', 'name' => 'Avantika Express'],
    ],
    'South Central Railway' => [
        ['number' => '12711', 'name' => 'Pinakini Express'],
        ['number' => '12713', 'name' => 'Satavahana Express'],
        ['number' => '12715', 'name' => 'Sachkhand Express'],
        ['number' => '12719', 'name' => 'Hyderabad - Ajmer Express'],
        ['number' => '12723', 'name' => 'Telangana Express'],
        ['number' => '12723', 'name' => 'Andhra Pradesh Express'],
        ['number' => '12759', 'name' => 'Charminar Express'],
    ],
    'North Central Railway' => [
        ['number' => '12401', 'name' => 'Magadh Express'],
        ['number' => '12403', 'name' => 'Jaipur - Lucknow Express'],
        ['number' => '12417', 'name' => 'Prayagraj Express'],
        ['number' => '12419', 'name' => 'Gomti Express'],
        ['number' => '12427', 'name' => 'Rewa Express'],
        ['number' => '12447', 'name' => 'Uttar Pradesh Sampark Kranti Express'],
        ['number' => '12451', 'name' => 'Shram Shakti Express'],
    ],
    'South Eastern Railway' => [
        ['number' => '12801', 'name' => 'Purushottam Express'],
        ['number' => '12809', 'name' => 'Mumbai - Howrah Mail'],
        ['number' => '12827', 'name' => 'Howrah - Purulia Express'],
        ['number' => '12829', 'name' => 'Bhubaneswar - Chennai Express'],
        ['number' => '12831', 'name' => 'Dhanbad - Bhubaneswar Express'],
        ['number' => '12839', 'name' => 'Howrah - Chennai Mail'],
        ['number' => '12841', 'name' => 'Coromandel Express'],
    ],
    'North Eastern Railway' => [
        ['number' => '12501', 'name' => 'Poorvottar Sampark Kranti Express'],
        ['number' => '12503', 'name' => 'Bengaluru - Guwahati Express'],
        ['number' => '12505', 'name' => 'Northeast Express'],
        ['number' => '12509', 'name' => 'Guwahati - Bengaluru Express'],
        ['number' => '12523', 'name' => 'New Jalpaiguri - New Delhi Express'],
        ['number' => '12525', 'name' => 'Dibrugarh - Kolkata Express'],
        ['number' => '12551', 'name' => 'Yuva Express'],
    ],
    'East Central Railway' => [
        ['number' => '12303', 'name' => 'Poorva Express'],
        ['number' => '12307', 'name' => 'Howrah - Jodhpur Express'],
        ['number' => '12317', 'name' => 'Akal Takht Express'],
        ['number' => '12323', 'name' => 'Howrah - New Delhi Express'],
        ['number' => '12371', 'name' => 'Howrah - Jaisalmer Express'],
        ['number' => '12381', 'name' => 'Poorvanchal Express'],
        ['number' => '12393', 'name' => 'Sampoorna Kranti Express'],
    ],
    'East Coast Railway' => [
        ['number' => '12605', 'name' => 'Chennai - Hyderabad Express'],
        ['number' => '12639', 'name' => 'Brindavan Express'],
        ['number' => '12663', 'name' => 'Howrah - Tiruchirappalli Express'],
        ['number' => '12703', 'name' => 'Falaknuma Express'],
        ['number' => '12717', 'name' => 'Ratnachal Express'],
        ['number' => '12802', 'name' => 'Purushottam Express'],
        ['number' => '12835', 'name' => 'Bhubaneswar - Krishnarajapuram Express'],
    ],
    'North Western Railway' => [
        ['number' => '12915', 'name' => 'Ashram Express'],
        ['number' => '12957', 'name' => 'Swarna Jayanti Rajdhani Express'],
        ['number' => '12969', 'name' => 'Jaipur - Chennai Express'],
        ['number' => '12979', 'name' => 'Jaipur - Mumbai Central Express'],
        ['number' => '12985', 'name' => 'Jaipur - Delhi Sarai Rohilla Double Decker Express'],
        ['number' => '12987', 'name' => 'Sealdah - Ajmer Express'],
        ['number' => '12989', 'name' => 'Dadar - Ajmer Express'],
    ],
    'South Western Railway' => [
        ['number' => '12627', 'name' => 'Karnataka Express'],
        ['number' => '12629', 'name' => 'Sampark Kranti Express'],
        ['number' => '12631', 'name' => 'Nagercoil Express'],
        ['number' => '12649', 'name' => 'Karnataka Sampark Kranti Express'],
        ['number' => '16527', 'name' => 'Kanniyakumari Express'],
        ['number' => '16589', 'name' => 'Rani Chennamma Express'],
        ['number' => '16591', 'name' => 'Hampi Express'],
    ],
    'West Central Railway' => [
        ['number' => '12001', 'name' => 'Bhopal Shatabdi Express'],
        ['number' => '12137', 'name' => 'Punjab Mail'],
        ['number' => '12153', 'name' => 'Samarasta Express'],
        ['number' => '12155', 'name' => 'Bhopal Express'],
        ['number' => '12175', 'name' => 'Chambal Express'],
        ['number' => '12193', 'name' => 'Jabalpur - Yesvantpur Express'],
        ['number' => '12195', 'name' => 'Allahabad - Jabalpur Express'],
    ],
    'South East Central Railway' => [
        ['number' => '12808', 'name' => 'Samta Express'],
        ['number' => '12811', 'name' => 'Hatia - Lokmanya Tilak Terminus Express'],
        ['number' => '12833', 'name' => 'Ahmedabad - Howrah Express'],
        ['number' => '12849', 'name' => 'Bilaspur - Pune Express'],
        ['number' => '12853', 'name' => 'Durg - Bhubaneswar Express'],
        ['number' => '12857', 'name' => 'Chhattisgarh Express'],
        ['number' => '12863', 'name' => 'Howrah - Yesvantpur Express'],
    ],
];

// Get trains for the selected zone
$trains = isset($train_data[$zone]) ? $train_data[$zone] : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($zone); ?> Trains</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .train-list-bg {
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('img/bg4.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .train-card {
            transition: all 0.3s ease;
        }
        .train-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-blue-800 text-white shadow-lg">
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
    <header class="train-list-bg text-white py-16">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4"><?php echo htmlspecialchars($zone); ?></h1>
            <p class="text-xl mb-4">List of trains operating under <?php echo htmlspecialchars($zone); ?></p>
            <div class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold">
                Total Trains: <?php echo count($trains); ?>
            </div>
        </div>
    </header>

    <!-- Train List -->
    <section class="py-16">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($trains as $train): ?>
                <div class="train-card bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-train text-3xl text-blue-600 mr-4"></i>
                            <div>
                                <h3 class="text-xl font-semibold"><?php echo htmlspecialchars($train['name']); ?></h3>
                                <p class="text-gray-600">Train No: <?php echo htmlspecialchars($train['number']); ?></p>
                            </div>
                        </div>
                        <div class="border-t pt-4 mt-2">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">
                                    <i class="fas fa-cog mr-1"></i> Maintenance Status
                                </span>
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">Up to date</span>
                            </div>
                            <div class="mt-4">
                                <a href="coach_maintenance.php?train=<?php echo urlencode($train['number']); ?>&name=<?php echo urlencode($train['name']); ?>&zone=<?php echo urlencode($zone); ?>" class="block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full transition duration-300 text-center">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
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