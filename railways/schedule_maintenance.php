<?php
// Include database configuration
require_once "config.php";

// Check for coach_type and train parameters
$coach_type = isset($_GET['coach_type']) ? $_GET['coach_type'] : '';
$train_number = isset($_GET['train']) ? $_GET['train'] : '';
$train_name = isset($_GET['name']) ? $_GET['name'] : '';

// Backwards compatibility: still check for coach_id from old links
$coach_id = isset($_GET['coach_id']) ? intval($_GET['coach_id']) : 0;

// Coach data will either come from the database or be constructed from parameters
$coach_data = null;

// If we have a coach_id, fetch from database (old path)
if ($coach_id > 0) {
    $sql = "SELECT * FROM coaches WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $coach_id);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) > 0) {
                $coach_data = mysqli_fetch_assoc($result);
            }
        }
        mysqli_stmt_close($stmt);
    }
} 
// If we have coach_type and train parameters, construct the coach data (new path)
elseif (!empty($coach_type) && !empty($train_number) && !empty($train_name)) {
    // Construct a coach data object with the parameters
    $coach_data = [
        'id' => 0, // Will be generated when actually saved
        'name' => "$coach_type Coach of $train_name",
        'type' => $coach_type,
        'train_number' => $train_number,
        'train_name' => $train_name
    ];
} else {
    // If neither path has data, redirect to index
    header("Location: index.php");
    exit;
}

// Fetch available technicians
$technicians = [];
$sql = "SELECT id, name, specialization FROM technicians";
if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $technicians[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Maintenance - <?php echo htmlspecialchars($coach_data['name']); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .form-header {
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('img/bg1.jpg');
            background-size: cover;
            background-position: center;
            padding-top: 80px;
        }
        .form-container {
            background-image: linear-gradient(rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.95)), url('img/bg7.jpg');
            background-size: cover;
            background-position: center;
        }
        .input-group:hover label {
            color: #2563eb;
        }
        .input-group:hover input, 
        .input-group:hover select, 
        .input-group:hover textarea {
            border-color: #2563eb;
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
    <header class="form-header text-white py-16">
        <div class="container mx-auto px-6">
            <h1 class="text-3xl md:text-4xl font-bold mb-4">Schedule Maintenance</h1>
            <div class="flex flex-col md:flex-row md:items-center">
                <div class="md:w-2/3">
                    <p class="text-xl mb-2">
                        <?php echo isset($coach_data['train_name']) ? htmlspecialchars($coach_data['train_name']) : ''; ?>
                        <?php if(isset($coach_data['train_number'])): ?>
                            <span class="text-blue-300">(<?php echo htmlspecialchars($coach_data['train_number']); ?>)</span>
                        <?php endif; ?>
                    </p>
                    <p class="text-lg"><?php echo htmlspecialchars($coach_data['name']); ?></p>
                </div>
                <div class="md:w-1/3 mt-4 md:mt-0 md:text-right">
                    <?php if($coach_id > 0): ?>
                    <a href="coach_details.php?id=<?php echo $coach_id; ?>" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        <i class="fas fa-arrow-left mr-2"></i> Back to Coach Details
                    </a>
                    <?php else: ?>
                    <a href="javascript:history.back()" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        <i class="fas fa-arrow-left mr-2"></i> Back
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <!-- Schedule Maintenance Form -->
    <section class="py-12">
        <div class="container mx-auto px-6">
            <div class="bg-white rounded-lg shadow-md overflow-hidden form-container">
                <div class="p-6">                    
                    <form id="schedule-maintenance-form" class="space-y-6">
                        <?php if($coach_id > 0): ?>
                        <input type="hidden" name="coach_id" value="<?php echo $coach_id; ?>">
                        <?php else: ?>
                        <input type="hidden" name="coach_type" value="<?php echo htmlspecialchars($coach_type); ?>">
                        <input type="hidden" name="train_number" value="<?php echo htmlspecialchars($train_number); ?>">
                        <input type="hidden" name="train_name" value="<?php echo htmlspecialchars($train_name); ?>">
                        <?php endif; ?>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="input-group">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="maintenance-type">Maintenance Type</label>
                                <select id="maintenance-type" name="maintenance_type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition-colors duration-200" required>
                                    <option value="">Select Maintenance Type</option>
                                    <option value="General Inspection">General Inspection</option>
                                    <option value="Electrical System Check">Electrical System Check</option>
                                    <option value="Brake System Repair">Brake System Repair</option>
                                    <option value="HVAC System Maintenance">HVAC System Maintenance</option>
                                    <option value="Suspension Adjustment">Suspension Adjustment</option>
                                    <option value="Wheel & Axle Inspection">Wheel & Axle Inspection</option>
                                    <option value="Door Mechanism Repair">Door Mechanism Repair</option>
                                    <option value="Coupling Mechanism">Coupling Mechanism Check</option>
                                    <option value="Plumbing System Repair">Plumbing System Repair</option>
                                    <option value="Interior Refurbishment">Interior Refurbishment</option>
                                </select>
                            </div>
                            
                            <div class="input-group">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="maintenance-date">Maintenance Date</label>
                                <input type="date" id="maintenance-date" name="maintenance_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition-colors duration-200" required>
                            </div>
                            
                            <div class="input-group">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="technician">Assigned Technician</label>
                                <select id="technician" name="technician_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition-colors duration-200" required>
                                    <option value="">Select Technician</option>
                                    <?php foreach ($technicians as $technician): ?>
                                        <option value="<?php echo $technician['id']; ?>">
                                            <?php echo htmlspecialchars($technician['name']); ?> 
                                            <?php if(!empty($technician['specialization'])): ?>
                                                (<?php echo htmlspecialchars($technician['specialization']); ?>)
                                            <?php endif; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="input-group">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="priority">Priority</label>
                                <select id="priority" name="priority" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition-colors duration-200" required>
                                    <option value="Low">Low</option>
                                    <option value="Medium" selected>Medium</option>
                                    <option value="High">High</option>
                                    <option value="Critical">Critical</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="input-group">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="notes">Notes</label>
                            <textarea id="notes" name="notes" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition-colors duration-200" rows="4" placeholder="Add any additional notes or instructions"></textarea>
                        </div>
                        
                        <div class="flex items-center justify-end space-x-4">
                            <a href="javascript:history.back()" class="bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded hover:bg-gray-400 focus:outline-none focus:shadow-outline transition-colors duration-200">
                                Cancel
                            </a>
                            <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline transform hover:scale-105 transition-all duration-200">
                                Schedule Maintenance
                            </button>
                        </div>
                    </form>
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Set minimum date to today
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('maintenance-date').min = today;
            
            // Handle form submission
            const scheduleForm = document.getElementById("schedule-maintenance-form");
            if (scheduleForm) {
                scheduleForm.addEventListener("submit", function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(scheduleForm);
                    
                    // Show loading state
                    const submitButton = scheduleForm.querySelector('button[type="submit"]');
                    const originalButtonText = submitButton.innerHTML;
                    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Scheduling...';
                    submitButton.disabled = true;
                    
                    // Send data to PHP backend
                    fetch('process_maintenance_schedule.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Reset button state
                        submitButton.innerHTML = originalButtonText;
                        submitButton.disabled = false;
                        
                        if (data.status === "success") {
                            // Show success message
                            alert(data.message);
                            // Redirect based on whether it came from coach_id or train params
                            if (formData.has('coach_id')) {
                                window.location.href = `coach_details.php?id=${formData.get('coach_id')}`;
                            } else {
                                window.location.href = 'index.php#maintenance';
                            }
                        } else {
                            // Show error message
                            alert(data.message || "Something went wrong. Please try again later.");
                        }
                    })
                    .catch(error => {
                        // Reset button state
                        submitButton.innerHTML = originalButtonText;
                        submitButton.disabled = false;
                        
                        // Show error message
                        console.error("Error:", error);
                        alert("An error occurred. Please try again later.");
                    });
                });
            }
        });
    </script>
</body>
</html> 