<?php
// Function to set a cookie
define("COOKIE_NAME", "user_name");
function setGreetingCookie($name, $expireDays = 7) {
    $expireTime = time() + ($expireDays * 24 * 60 * 60); // Convert days to seconds
    setcookie(COOKIE_NAME, $name, $expireTime, "/");
}

// Function to get the cookie value
function getGreetingCookie() {
    return isset($_COOKIE[COOKIE_NAME]) ? $_COOKIE[COOKIE_NAME] : null;
}

// Function to delete the cookie
function deleteGreetingCookie() {
    setcookie(COOKIE_NAME, "", time() - 3600, "/"); // Set expiration time in the past
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["name"])) {
        setGreetingCookie($_POST["name"]);
    }
    if (isset($_POST["delete"])) {
        deleteGreetingCookie();
    }
}

$name = getGreetingCookie();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personalized Greeting</title>
</head>
<body>
    <h1>
        <?php echo $name ? "Welcome back, " . htmlspecialchars($name) . "!" : "Hello, guest!"; ?>
    </h1>
    
    <form method="post">
        <label for="name">Enter your name:</label>
        <input type="text" id="name" name="name" required>
        <button type="submit">Set Name</button>
    </form>
    
    <form method="post">
        <button type="submit" name="delete" value="1">Delete Cookie</button>
    </form>
</body>
</html>
