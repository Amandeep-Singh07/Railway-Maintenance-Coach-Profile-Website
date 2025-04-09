<?php

$cookie_name = "user";
$cookie_value = "";
setcookie($cookie_name, $cookie_value, time() - 3600, path: "/");

?>

<html>
    <body>
        <?php
        if(!isset($_COOKIE[$cookie_name])){
            echo "Cookies is not set";
        }
        else{
            echo "Cookie is set";
        }
        ?>
    </body>
</html>