<?php
// Include database configuration
require_once "config.php";

// Start HTML output
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Maintenance Types</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Updating Maintenance Types</h1>
        <div class="space-y-4">';

// Update coaches table maintenance types
$sql = "UPDATE coaches SET 
    maintenance_type = CASE 
        WHEN maintenance_type = 'Routine' THEN 'General Inspection'
        WHEN maintenance_type = 'Preventive' THEN 'Electrical System Check'
        WHEN maintenance_type = 'Corrective' THEN 'Brake System Repair'
        ELSE maintenance_type
    END";

if (mysqli_query($conn, $sql)) {
    echo '<div class="p-4 bg-green-100 text-green-700 rounded">
            <p><span class="font-bold">Success:</span> Coaches table updated successfully.</p>
          </div>';
} else {
    echo '<div class="p-4 bg-red-100 text-red-700 rounded">
            <p><span class="font-bold">Error:</span> Error updating coaches table: ' . mysqli_error($conn) . '</p>
          </div>';
}

// Update maintenance_history table maintenance types
$sql = "UPDATE maintenance_history SET 
    maintenance_type = CASE 
        WHEN maintenance_type = 'Routine' THEN 'General Inspection'
        WHEN maintenance_type = 'Preventive' THEN 'Electrical System Check'
        WHEN maintenance_type = 'Corrective' THEN 'Brake System Repair'
        ELSE maintenance_type
    END";

if (mysqli_query($conn, $sql)) {
    echo '<div class="p-4 bg-green-100 text-green-700 rounded">
            <p><span class="font-bold">Success:</span> Maintenance history table updated successfully.</p>
          </div>';
} else {
    echo '<div class="p-4 bg-red-100 text-red-700 rounded">
            <p><span class="font-bold">Error:</span> Error updating maintenance history table: ' . mysqli_error($conn) . '</p>
          </div>';
}

// Update maintenance_schedule table maintenance types
$sql = "UPDATE maintenance_schedule SET 
    maintenance_type = CASE 
        WHEN maintenance_type = 'Routine' THEN 'General Inspection'
        WHEN maintenance_type = 'Preventive' THEN 'Electrical System Check'
        WHEN maintenance_type = 'Corrective' THEN 'Brake System Repair'
        ELSE maintenance_type
    END";

if (mysqli_query($conn, $sql)) {
    echo '<div class="p-4 bg-green-100 text-green-700 rounded">
            <p><span class="font-bold">Success:</span> Maintenance schedule table updated successfully.</p>
          </div>';
} else {
    echo '<div class="p-4 bg-red-100 text-red-700 rounded">
            <p><span class="font-bold">Error:</span> Error updating maintenance schedule table: ' . mysqli_error($conn) . '</p>
          </div>';
}

// Show sample of updated data
echo '<div class="mt-8 p-4 bg-blue-50 text-blue-700 rounded">
        <h2 class="text-lg font-bold mb-2">Sample of Updated Data:</h2>';

// Show sample from coaches table
$sql = "SELECT id, name, maintenance_type FROM coaches LIMIT 3";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo '<h3 class="text-md font-semibold mt-4">Coaches Table:</h3>
          <table class="w-full border-collapse border border-gray-300 mt-2">
            <thead>
              <tr class="bg-gray-200">
                <th class="p-2 border border-gray-300">ID</th>
                <th class="p-2 border border-gray-300">Name</th>
                <th class="p-2 border border-gray-300">Maintenance Type</th>
              </tr>
            </thead>
            <tbody>';
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>
                <td class="p-2 border border-gray-300">' . htmlspecialchars($row['id']) . '</td>
                <td class="p-2 border border-gray-300">' . htmlspecialchars($row['name']) . '</td>
                <td class="p-2 border border-gray-300">' . htmlspecialchars($row['maintenance_type']) . '</td>
              </tr>';
    }
    
    echo '</tbody></table>';
} else {
    echo '<p>No data found in coaches table.</p>';
}

// Show sample from maintenance_history table
$sql = "SELECT id, coach_id, maintenance_type FROM maintenance_history LIMIT 3";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo '<h3 class="text-md font-semibold mt-4">Maintenance History Table:</h3>
          <table class="w-full border-collapse border border-gray-300 mt-2">
            <thead>
              <tr class="bg-gray-200">
                <th class="p-2 border border-gray-300">ID</th>
                <th class="p-2 border border-gray-300">Coach ID</th>
                <th class="p-2 border border-gray-300">Maintenance Type</th>
              </tr>
            </thead>
            <tbody>';
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>
                <td class="p-2 border border-gray-300">' . htmlspecialchars($row['id']) . '</td>
                <td class="p-2 border border-gray-300">' . htmlspecialchars($row['coach_id']) . '</td>
                <td class="p-2 border border-gray-300">' . htmlspecialchars($row['maintenance_type']) . '</td>
              </tr>';
    }
    
    echo '</tbody></table>';
} else {
    echo '<p>No data found in maintenance_history table.</p>';
}

echo '</div>';

// Close HTML
echo '<div class="mt-8 text-center">
        <a href="index.php" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Return to Dashboard</a>
      </div>
    </div>
  </div>
</body>
</html>';

// Close database connection
mysqli_close($conn);
?> 