<?php
// Include database configuration
require_once "config.php";

// Start HTML output
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fix Technician Availability</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Fixing Technician Availability</h1>
        <div class="space-y-4">';

// Show current technicians before update
echo '<h2 class="text-lg font-semibold mb-2">Current Technician Status (Before Update)</h2>';
$sql = "SELECT id, name, specialization, status FROM technicians ORDER BY id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo '<div class="overflow-x-auto mb-6">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4 border-b text-left">ID</th>
                        <th class="py-2 px-4 border-b text-left">Name</th>
                        <th class="py-2 px-4 border-b text-left">Specialization</th>
                        <th class="py-2 px-4 border-b text-left">Status</th>
                    </tr>
                </thead>
                <tbody>';
    
    while ($row = mysqli_fetch_assoc($result)) {
        $statusClass = $row['status'] === 'Available' ? 'text-green-600' : 'text-red-600';
        echo '<tr class="hover:bg-gray-50">
                <td class="py-2 px-4 border-b">' . $row['id'] . '</td>
                <td class="py-2 px-4 border-b font-medium">' . $row['name'] . '</td>
                <td class="py-2 px-4 border-b">' . $row['specialization'] . '</td>
                <td class="py-2 px-4 border-b ' . $statusClass . '">' . $row['status'] . '</td>
              </tr>';
    }
    
    echo '</tbody></table></div>';
} else {
    echo '<p>No technicians found in the database.</p>';
}

// Update technician statuses
echo '<h2 class="text-lg font-semibold mt-6 mb-2">Updating Technician Status</h2>';

// Reset all technicians to Available status
$sql = "UPDATE technicians SET status = 'Available'";
if (mysqli_query($conn, $sql)) {
    echo '<div class="p-3 bg-green-100 text-green-700 rounded">
            <p><i class="fas fa-check-circle mr-2"></i><span class="font-bold">Success:</span> Reset all technicians to "Available" status</p>
          </div>';
} else {
    echo '<div class="p-3 bg-red-100 text-red-700 rounded">
            <p><i class="fas fa-times-circle mr-2"></i><span class="font-bold">Error:</span> Failed to update technician status - ' . mysqli_error($conn) . '</p>
          </div>';
}

// Set a reasonable number of technicians to 'Assigned' status for realism
// We'll assign the first three technicians (likely Rajesh, Priya, and Vikram)
$assigned_techs = [1, 2, 3]; // IDs of technicians to mark as assigned
foreach ($assigned_techs as $tech_id) {
    $sql = "UPDATE technicians SET status = 'Assigned' WHERE id = " . $tech_id;
    if (mysqli_query($conn, $sql)) {
        $name_sql = "SELECT name FROM technicians WHERE id = " . $tech_id;
        $name_result = mysqli_query($conn, $name_sql);
        $name_row = mysqli_fetch_assoc($name_result);
        $tech_name = $name_row ? $name_row['name'] : "Technician #" . $tech_id;
        
        echo '<div class="p-3 bg-blue-100 text-blue-700 rounded">
                <p><i class="fas fa-info-circle mr-2"></i>Set ' . $tech_name . ' status to "Assigned" (for coaches display)</p>
              </div>';
    }
}

// Show updated technicians
echo '<h2 class="text-lg font-semibold mt-6 mb-2">Current Technician Status (After Update)</h2>';
$sql = "SELECT id, name, specialization, status FROM technicians ORDER BY id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo '<div class="overflow-x-auto mb-6">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4 border-b text-left">ID</th>
                        <th class="py-2 px-4 border-b text-left">Name</th>
                        <th class="py-2 px-4 border-b text-left">Specialization</th>
                        <th class="py-2 px-4 border-b text-left">Status</th>
                    </tr>
                </thead>
                <tbody>';
    
    while ($row = mysqli_fetch_assoc($result)) {
        $statusClass = $row['status'] === 'Available' ? 'text-green-600' : 'text-red-600';
        echo '<tr class="hover:bg-gray-50">
                <td class="py-2 px-4 border-b">' . $row['id'] . '</td>
                <td class="py-2 px-4 border-b font-medium">' . $row['name'] . '</td>
                <td class="py-2 px-4 border-b">' . $row['specialization'] . '</td>
                <td class="py-2 px-4 border-b ' . $statusClass . '">' . $row['status'] . '</td>
              </tr>';
    }
    
    echo '</tbody></table></div>';
    
    // Count available technicians
    $available_sql = "SELECT COUNT(*) as count FROM technicians WHERE status = 'Available'";
    $available_result = mysqli_query($conn, $available_sql);
    $available_count = mysqli_fetch_assoc($available_result)['count'];
    
    echo '<div class="p-3 bg-green-100 text-green-700 rounded">
            <p><i class="fas fa-check-circle mr-2"></i><span class="font-bold">Result:</span> ' . $available_count . ' technicians are now available for assignment.</p>
          </div>';
} else {
    echo '<p>No technicians found in the database.</p>';
}

// Close HTML
echo '<div class="mt-8 text-center">
        <a href="schedule_maintenance.php?coach_id=1" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 mr-2">
            <i class="fas fa-calendar-plus mr-2"></i>Try Schedule Maintenance
        </a>
        <a href="index.php" class="inline-block px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
            <i class="fas fa-home mr-2"></i>Return to Dashboard
        </a>
      </div>
    </div>
  </div>
</body>
</html>';

// Close database connection
mysqli_close($conn);
?> 