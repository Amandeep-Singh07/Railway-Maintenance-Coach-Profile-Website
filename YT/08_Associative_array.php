<?php

echo "Welcome to Associative Arrays in PHP<br>";

// A normal Array or indexed array
// $arr = array("this", "that", "what");
// echo $arr[0];
// echo $arr[1];
// echo $arr[2];

// Associative arrays

$favColor = array(
    'aman' => 'yellow',
    'abhishek' => 'black',
    'suraj' => 'blue',
    'vikas' => 'green',
    8=>'this'               // in associative arrays, key can be integer also
);

echo $favColor['aman'];
echo "<br>";
echo $favColor[8];

foreach ($favColor as $key => $value){
    echo "<br> Favourite color of $key is $value";
}

?>