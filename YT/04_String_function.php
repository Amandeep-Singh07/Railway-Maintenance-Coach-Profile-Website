<?php

$name="RAM "; // we join to strings in  php using . (dot) operator.
$address="durgapuri colony, lucknow, uttar pradesh";

echo $name;
echo "<br>";

echo "The length of"." my string is ".strlen($name);
echo "<br>";

// word count
echo str_word_count($address);

echo "<br>";

// string reverse
echo strrev($name);

echo "<br>";

// to search any string
echo strpos($address,"co");

echo "<br>";

// to replace with something
echo str_replace("uttar pradesh","UTTAR PRADESH",$address);

echo "<br>";

// to repeat some text again and again
echo str_repeat($name,10);
echo "<br>";


// to trim any string
echo "<pre>";
echo rtrim("    aman is a good boy    ");
echo "<br>";
echo ltrim("    aman is a bad boy     ");
echo "</pre>";


?>