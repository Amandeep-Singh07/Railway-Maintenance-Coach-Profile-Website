<?php
// Include database configuration
require_once "config.php";

// Get coach ID from URL
$coach_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

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

// Fetch maintenance history
$maintenance_history = [];
$sql = "SELECT * FROM maintenance_history WHERE coach_id = ? ORDER BY maintenance_date DESC LIMIT 5";
if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $coach_id);
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            $maintenance_history[] = $row;
        }
    }
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($coach_data['name']); ?> - Railway Maintenance</title>
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

    <!-- Coach Details Section -->
    <section class="py-12">
        <div class="container mx-auto px-6">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-3xl font-bold"><?php echo htmlspecialchars($coach_data['name']); ?></h1>
                        <a href="index.php#coaches" class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300">
                            <i class="fas fa-arrow-left mr-2"></i> Back to Coaches
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div>
                            <h2 class="text-xl font-semibold mb-4">Coach Information</h2>
                            <div class="space-y-3">
                                <div class="flex">
                                    <span class="font-semibold w-1/3">Coach ID:</span>
                                    <span class="w-2/3"><?php echo htmlspecialchars($coach_data['id']); ?></span>
                                </div>
                                <div class="flex">
                                    <span class="font-semibold w-1/3">Type:</span>
                                    <span class="w-2/3"><?php echo htmlspecialchars($coach_data['type']); ?></span>
                                </div>
                                <div class="flex">
                                    <span class="font-semibold w-1/3">Manufacturing Year:</span>
                                    <span class="w-2/3"><?php echo htmlspecialchars($coach_data['manufacturing_year']); ?></span>
                                </div>
                                <div class="flex">
                                    <span class="font-semibold w-1/3">Capacity:</span>
                                    <span class="w-2/3"><?php echo htmlspecialchars($coach_data['capacity']); ?> passengers</span>
                                </div>
                                <div class="flex">
                                    <span class="font-semibold w-1/3">Status:</span>
                                    <span class="w-2/3">
                                        <span class="px-2 py-1 rounded text-sm <?php echo $coach_data['status'] === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                            <?php echo htmlspecialchars($coach_data['status']); ?>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h2 class="text-xl font-semibold mb-4">Maintenance Schedule</h2>
                            <div class="space-y-3">
                                <div class="flex">
                                    <span class="font-semibold w-1/3">Last Maintenance:</span>
                                    <span class="w-2/3"><?php echo htmlspecialchars($coach_data['last_maintenance']); ?></span>
                                </div>
                                <div class="flex">
                                    <span class="font-semibold w-1/3">Next Maintenance:</span>
                                    <span class="w-2/3"><?php echo htmlspecialchars($coach_data['next_maintenance']); ?></span>
                                </div>
                                <div class="flex">
                                    <span class="font-semibold w-1/3">Maintenance Type:</span>
                                    <span class="w-2/3"><?php echo htmlspecialchars($coach_data['maintenance_type']); ?></span>
                                </div>
                                <div class="flex">
                                    <span class="font-semibold w-1/3">Assigned Technician:</span>
                                    <span class="w-2/3"><?php echo htmlspecialchars($coach_data['assigned_technician']); ?></span>
                                </div>
                            </div>
                            
                            <div class="mt-6">
                                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 schedule-maintenance-btn" data-coach-id="<?php echo $coach_id; ?>">
                                    <i class="fas fa-calendar-plus mr-2"></i> Schedule Maintenance
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold mb-4">Maintenance History</h2>
                        <?php if (count($maintenance_history) > 0): ?>
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white">
                                    <thead>
                                        <tr class="bg-gray-100">
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Technician</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notes</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        <?php foreach ($maintenance_history as $history): ?>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($history['maintenance_date']); ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($history['maintenance_type']); ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($history['technician']); ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 py-1 rounded text-sm <?php echo $history['status'] === 'Completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?>">
                                                        <?php echo htmlspecialchars($history['status']); ?>
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4"><?php echo htmlspecialchars($history['notes']); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <p class="text-gray-500">No maintenance history available.</p>
                        <?php endif; ?>
                    </div>
                    
                    <div>
                        <h2 class="text-xl font-semibold mb-4">Issue Reports</h2>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <form id="issue-report-form" class="space-y-4">
                                <input type="hidden" name="coach_id" value="<?php echo $coach_id; ?>">
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="issue-type">Issue Type</label>
                                    <select id="issue-type" name="issue_type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        <option value="">Select Issue Type</option>
                                        <option value="Mechanical">Mechanical</option>
                                        <option value="Electrical">Electrical</option>
                                        <option value="Structural">Structural</option>
                                        <option value="Interior">Interior</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="issue-description">Description</label>
                                    <textarea id="issue-description" name="issue_description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="3" placeholder="Describe the issue in detail"></textarea>
                                </div>
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="priority">Priority</label>
                                    <select id="priority" name="priority" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                        <option value="Critical">Critical</option>
                                    </select>
                                </div>
                                <div class="flex items-center justify-end">
                                    <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                                        Submit Report
                                    </button>
                                </div>
                            </form>
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
            // Handle issue report form submission
            const issueReportForm = document.getElementById("issue-report-form");
            if (issueReportForm) {
                issueReportForm.addEventListener("submit", function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(issueReportForm);
                    
                    // Show loading state
                    const submitButton = issueReportForm.querySelector('button[type="submit"]');
                    const originalButtonText = submitButton.innerHTML;
                    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Submitting...';
                    submitButton.disabled = true;
                    
                    // Send data to PHP backend
                    fetch('process_issue_report.php', {
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
                            issueReportForm.reset();
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
            
            // Handle schedule maintenance button
            const scheduleMaintenanceBtn = document.querySelector('.schedule-maintenance-btn');
            if (scheduleMaintenanceBtn) {
                scheduleMaintenanceBtn.addEventListener('click', function() {
                    const coachId = this.getAttribute('data-coach-id');
                    window.location.href = `schedule_maintenance.php?coach_id=${coachId}`;
                });
            }
        });
    </script>
</body>
</html> 