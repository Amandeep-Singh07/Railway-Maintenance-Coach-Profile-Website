  <?php
$default_theme = "light";

if (isset($_POST['theme'])) {
    setcookie('user_theme', $_POST['theme'], time() + 3600, '/');
    header("Location: " . $_SERVER['PHP_SELF']); // Refresh to apply the theme
    exit();
}

if (isset($_POST['reset'])) {
    setcookie('user_theme', $default_theme, time() + 3600, '/');
    header("Location: " . $_SERVER['PHP_SELF']); // Refresh to apply the theme
    exit();
}

$current_theme = isset($_COOKIE['user_theme']) ? $_COOKIE["user_theme"] : $default_theme;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theme Selector</title>
</head>
<body style="background-color: <?php echo $current_theme == 'dark' ? '#333' : '#fff'; ?>; 
             color: <?php echo $current_theme == 'dark' ? '#fff' : '#000'; ?>;">

    <h2>Select theme</h2>
    <form method="post">
        <button type="submit" name="theme" value="light">Light Theme</button>
        <button type="submit" name="theme" value="dark">Dark Theme</button>
        <button type="submit" name="reset">Reset to default</button>
    </form>

    <p>Current theme: <?php echo $current_theme; ?></p>

</body>
</html>
