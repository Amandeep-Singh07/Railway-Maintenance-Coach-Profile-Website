<?php
// Initialize students array
$students = [
    ["id" => 101, "name" => "Alice", "grades" => [85, 90, 78]],
    ["id" => 102, "name" => "Bob", "grades" => [70, 75, 80]],
    ["id" => 103, "name" => "Charlie", "grades" => [95, 88, 92]]
];

// Function to calculate total and average grades
function calculateAverage($grades) {
    $total = array_sum($grades);
    $average = $total / count($grades);
    return ["total" => $total, "average" => $average];
}

// Function to determine grade category
function getGradeCategory($average) {
    if ($average >= 90) return "A";
    if ($average >= 80) return "B";
    if ($average >= 70) return "C";
    return "D";
}

// Add new student
if (isset($_POST["add_student"])) {
    $new_student = [
        "id" => $_POST["id"],
        "name" => $_POST["name"],
        "grades" => array_map('intval', explode(",", $_POST["grades"]))
    ];
    $students[] = $new_student;
}

// Update student grades
if (isset($_POST["update_student"])) {
    foreach ($students as &$student) {
        if ($student["id"] == $_POST["id"]) {
            $student["grades"] = array_map('intval', explode(",", $_POST["grades"]));
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Grade Manager</title>
</head>
<body>
    <h1>Student Grade Manager</h1>

    <!-- Form to Add Student -->
    <h3>Add New Student</h3>
    <form method="post">
        ID: <input type="number" name="id" required>
        Name: <input type="text" name="name" required>
        Grades (comma-separated): <input type="text" name="grades" required>
        <button type="submit" name="add_student">Add Student</button>
    </form>

    <!-- Form to Update Student Grades -->
    <h3>Update Student Grades</h3>
    <form method="post">
        ID: <input type="number" name="id" required>
        New Grades (comma-separated): <input type="text" name="grades" required>
        <button type="submit" name="update_student">Update Grades</button>
    </form>

    <!-- Student Records Table -->
    <h3>Student Records</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Total Marks</th>
            <th>Average</th>
            <th>Grade</th>
        </tr>
        <?php foreach ($students as $student): ?>
            <?php 
                $result = calculateAverage($student["grades"]); 
                $grade = getGradeCategory($result["average"]);
            ?>
            <tr>
                <td><?php echo $student["id"]; ?></td>
                <td><?php echo $student["name"]; ?></td>
                <td><?php echo $result["total"]; ?></td>
                <td><?php echo round($result["average"], 2); ?></td>
                <td><?php echo $grade; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>