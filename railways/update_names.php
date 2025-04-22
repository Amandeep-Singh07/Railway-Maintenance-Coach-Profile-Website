<?php
// Include database configuration
require_once "config.php";

// Start HTML output
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Technician Names</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Updating Technician Names to Indian Names</h1>
        <div class="space-y-4">';

// Update existing technicians
$sql_statements = [
    "UPDATE technicians SET name = 'Rajesh Kumar' WHERE id = 1",
    "UPDATE technicians SET name = 'Priya Sharma' WHERE id = 2",
    "UPDATE technicians SET name = 'Vikram Singh' WHERE id = 3",
    "UPDATE technicians SET name = 'Ananya Patel' WHERE id = 4",
    "UPDATE technicians SET name = 'Suresh Reddy' WHERE id = 5",
    "UPDATE technicians SET name = 'Meera Gupta' WHERE id = 6"
];

foreach ($sql_statements as $sql) {
    if (mysqli_query($conn, $sql)) {
        echo '<div class="p-3 bg-green-100 text-green-700 rounded">
                <p><i class="fas fa-check-circle mr-2"></i><span class="font-bold">Success:</span> ' . $sql . '</p>
              </div>';
    } else {
        echo '<div class="p-3 bg-red-100 text-red-700 rounded">
                <p><i class="fas fa-times-circle mr-2"></i><span class="font-bold">Error:</span> ' . $sql . ' - ' . mysqli_error($conn) . '</p>
              </div>';
    }
}

// Insert new technicians
echo '<h2 class="text-xl font-bold mt-8 mb-4">Adding More Indian Technicians</h2>';

$new_technicians = [
    ['Aditya Verma', 'Mechanical', '555-789-0123', 'aditya.verma@railway.com', 'Available'],
    ['Neha Kapoor', 'Electrical', '555-890-1234', 'neha.kapoor@railway.com', 'Available'],
    ['Rohit Iyer', 'HVAC Systems', '555-901-2345', 'rohit.iyer@railway.com', 'Available'],
    ['Deepika Malhotra', 'Brake Systems', '555-012-3456', 'deepika.malhotra@railway.com', 'Available'],
    ['Arjun Nair', 'Suspension', '555-123-4567', 'arjun.nair@railway.com', 'Available'],
    ['Kavita Desai', 'Door Mechanisms', '555-234-5678', 'kavita.desai@railway.com', 'Available'],
    ['Siddharth Joshi', 'Wheel & Axle', '555-345-6789', 'siddharth.joshi@railway.com', 'Available'],
    ['Lakshmi Rao', 'Plumbing', '555-456-7890', 'lakshmi.rao@railway.com', 'Available']
];

foreach ($new_technicians as $tech) {
    $sql = "INSERT INTO technicians (name, specialization, contact_number, email, status) 
            VALUES (?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $tech[0], $tech[1], $tech[2], $tech[3], $tech[4]);
    
    if (mysqli_stmt_execute($stmt)) {
        echo '<div class="p-3 bg-green-100 text-green-700 rounded">
                <p><i class="fas fa-check-circle mr-2"></i><span class="font-bold">Added:</span> ' . $tech[0] . ' (' . $tech[1] . ')</p>
              </div>';
    } else {
        echo '<div class="p-3 bg-red-100 text-red-700 rounded">
                <p><i class="fas fa-times-circle mr-2"></i><span class="font-bold">Error adding:</span> ' . $tech[0] . ' - ' . mysqli_error($conn) . '</p>
              </div>';
    }
    
    mysqli_stmt_close($stmt);
}

// Update coaches
echo '<h2 class="text-xl font-bold mt-8 mb-4">Updating Coach Assignments</h2>';

$coach_updates = [
    "UPDATE coaches SET assigned_technician = 'Rajesh Kumar' WHERE id = 1",
    "UPDATE coaches SET assigned_technician = 'Priya Sharma' WHERE id = 2",
    "UPDATE coaches SET assigned_technician = 'Vikram Singh' WHERE id = 3"
];

foreach ($coach_updates as $sql) {
    if (mysqli_query($conn, $sql)) {
        echo '<div class="p-3 bg-green-100 text-green-700 rounded">
                <p><i class="fas fa-check-circle mr-2"></i><span class="font-bold">Success:</span> ' . $sql . '</p>
              </div>';
    } else {
        echo '<div class="p-3 bg-red-100 text-red-700 rounded">
                <p><i class="fas fa-times-circle mr-2"></i><span class="font-bold">Error:</span> ' . $sql . ' - ' . mysqli_error($conn) . '</p>
              </div>';
    }
}

// Update maintenance history
echo '<h2 class="text-xl font-bold mt-8 mb-4">Updating Maintenance History</h2>';

$history_updates = [
    "UPDATE maintenance_history SET technician = 'Rajesh Kumar' WHERE technician = 'Rajesh Kumar' OR technician LIKE '%John%' OR technician LIKE '%Michael%' OR technician LIKE '%David%'",
    "UPDATE maintenance_history SET technician = 'Priya Sharma' WHERE technician = 'Priya Sharma' OR technician LIKE '%Jennifer%' OR technician LIKE '%Sarah%' OR technician LIKE '%Jessica%'",
    "UPDATE maintenance_history SET technician = 'Vikram Singh' WHERE technician = 'Vikram Singh' OR technician LIKE '%Robert%' OR technician LIKE '%William%' OR technician LIKE '%James%'"
];

foreach ($history_updates as $sql) {
    if (mysqli_query($conn, $sql)) {
        echo '<div class="p-3 bg-green-100 text-green-700 rounded">
                <p><i class="fas fa-check-circle mr-2"></i><span class="font-bold">Success:</span> Updated maintenance history</p>
              </div>';
    } else {
        echo '<div class="p-3 bg-red-100 text-red-700 rounded">
                <p><i class="fas fa-times-circle mr-2"></i><span class="font-bold">Error:</span> Updating maintenance history - ' . mysqli_error($conn) . '</p>
              </div>';
    }
}

// Show current technicians
echo '<h2 class="text-xl font-bold mt-8 mb-4">Current Technicians</h2>';

$sql = "SELECT id, name, specialization, status FROM technicians ORDER BY id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo '<div class="overflow-x-auto mt-4">
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
        echo '<tr class="hover:bg-gray-50">
                <td class="py-2 px-4 border-b">' . $row['id'] . '</td>
                <td class="py-2 px-4 border-b font-medium">' . $row['name'] . '</td>
                <td class="py-2 px-4 border-b">' . $row['specialization'] . '</td>
                <td class="py-2 px-4 border-b">' . $row['status'] . '</td>
              </tr>';
    }
    
    echo '</tbody></table></div>';
} else {
    echo '<p>No technicians found in the database.</p>';
}

// Close HTML
echo '<div class="mt-8 text-center">
        <p class="text-green-600 font-bold mb-4"><i class="fas fa-check-circle mr-2"></i>All names have been updated to Indian names!</p>
        <a href="index.php" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
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