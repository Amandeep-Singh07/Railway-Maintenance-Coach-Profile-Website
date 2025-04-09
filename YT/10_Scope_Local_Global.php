<?php

echo "Welcome to scope and local global variables in php<br>";

// in php the global variable have their scope outside the function means they are not accessible to the function if we define any variable outside the function and to solve this problem we use global keyword inside the function

$a = 98;
function printValue(){
    $a = 97; // Local variable 
    global $a; // Give me the access to this global variable
    echo "The value of your variable is $a";
}

printValue();

echo var_dump($GLOBALS); // this  line prints all the global variables.
echo "<br>";
echo var_dump($GLOBALS["a"]);
?>