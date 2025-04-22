<?php
// Include database configuration
require_once "config.php";

// Display the technicians table structure
echo "Checking Technicians Table Structure:<br><br>";
$sql = "DESCRIBE technicians";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Error: " . mysqli_error($conn) . "<br>";
} else {
    echo "<table border='1'>";
    echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['Field'] . "</td>";
        echo "<td>" . $row['Type'] . "</td>";
        echo "<td>" . $row['Null'] . "</td>";
        echo "<td>" . $row['Key'] . "</td>";
        echo "<td>" . $row['Default'] . "</td>";
        echo "<td>" . $row['Extra'] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
}

// Display all technician records
echo "<br><br>All Technician Records:<br><br>";
$sql = "SELECT * FROM technicians";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Error: " . mysqli_error($conn) . "<br>";
} else {
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1'>";
        
        // Get field names
        $row = mysqli_fetch_assoc($result);
        echo "<tr>";
        foreach ($row as $key => $value) {
            echo "<th>" . $key . "</th>";
        }
        echo "</tr>";
        
        // Reset pointer
        mysqli_data_seek($result, 0);
        
        // Display data
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . $value . "</td>";
            }
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "No records found in the technicians table.";
    }
}

// Count technicians by status
echo "<br><br>Technician Status Counts:<br><br>";
$sql = "SELECT status, COUNT(*) as count FROM technicians GROUP BY status";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Error: " . mysqli_error($conn) . "<br>";
} else {
    echo "<table border='1'>";
    echo "<tr><th>Status</th><th>Count</th></tr>";
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['status'] . "</td>";
        echo "<td>" . $row['count'] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
}

// Close database connection
mysqli_close($conn);
?> 