<?php
// Include database configuration
require_once "config.php";

// Get coach ID from URL
$coach_id = isset($_GET['coach_id']) ? intval($_GET['coach_id']) : 0;

// Fetch coach details from database
$coach_data = null;
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

// If coach not found, redirect to index
if (!$coach_data) {
    header("Location: index.php");
    exit;
}

// Fetch available technicians
$technicians = [];
$sql = "SELECT id, name FROM technicians WHERE status = 'Available'";
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
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-blue-800 text-white shadow-lg">
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <a href="index.php" class="flex items-center">
                        <i class="fas fa-train text-2xl mr-2"></i>
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

    <!-- Schedule Maintenance Section -->
    <section class="py-12">
        <div class="container mx-auto px-6">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-3xl font-bold">Schedule Maintenance</h1>
                        <a href="coach_details.php?id=<?php echo $coach_id; ?>" class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300">
                            <i class="fas fa-arrow-left mr-2"></i> Back to Coach Details
                        </a>
                    </div>
                    
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold mb-2">Coach Information</h2>
                        <p class="text-gray-600">
                            <span class="font-semibold">Coach:</span> <?php echo htmlspecialchars($coach_data['name']); ?> 
                            (ID: <?php echo htmlspecialchars($coach_data['id']); ?>)
                        </p>
                    </div>
                    
                    <form id="schedule-maintenance-form" class="space-y-6">
                        <input type="hidden" name="coach_id" value="<?php echo $coach_id; ?>">
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="maintenance-type">Maintenance Type</label>
                                <select id="maintenance-type" name="maintenance_type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                    <option value="">Select Maintenance Type</option>
                                    <option value="Routine">Routine</option>
                                    <option value="Preventive">Preventive</option>
                                    <option value="Corrective">Corrective</option>
                                    <option value="Emergency">Emergency</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="maintenance-date">Maintenance Date</label>
                                <input type="date" id="maintenance-date" name="maintenance_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="technician">Assigned Technician</label>
                                <select id="technician" name="technician_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                    <option value="">Select Technician</option>
                                    <?php foreach ($technicians as $technician): ?>
                                        <option value="<?php echo $technician['id']; ?>"><?php echo htmlspecialchars($technician['name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="priority">Priority</label>
                                <select id="priority" name="priority" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                    <option value="Critical">Critical</option>
                                </select>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="notes">Notes</label>
                            <textarea id="notes" name="notes" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="4" placeholder="Add any additional notes or instructions"></textarea>
                        </div>
                        
                        <div class="flex items-center justify-end space-x-4">
                            <a href="coach_details.php?id=<?php echo $coach_id; ?>" class="bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded hover:bg-gray-400 focus:outline-none focus:shadow-outline">
                                Cancel
                            </a>
                            <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
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
                            // Redirect to coach details page
                            window.location.href = `coach_details.php?id=${formData.get('coach_id')}`;
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