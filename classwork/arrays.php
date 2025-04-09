<?php
$languague = array("PHP","Java","HTML","PHP","Android","
c","c++","html",1);
var_dump($languague);
?>

<!-- indexed array -->

<?php
echo"<h1> Indexed Array</h1> <br>";

$course = array("Php","java","c","cpp","python","html","css") ;
echo"I like ".$course[0].", ".$course[2].", ".$course[3].", ".$course[4].", ".$course[5].", ".$course[6];
echo "<br>";
echo "<br>";
echo "<br>";
echo "<hr>";
?>

<?php
echo"<h1> loop through Indexed Array</h1> <br>";

$course = array("Php","java","c","cpp","python","html","css") ;
$l = count($course);
for ($i = 0; $i < $l; $i++) {
    echo "".$course[$i].", ";
}

echo "<br>";
echo "<br>";
echo "<br>";
echo "<hr>";
?>

<?php
echo"<h1> loop through Indexed Array using foreach loop</h1> <br>";

$course = array("Php","java","c","cpp","python","html","css") ;
$l = count($course);
foreach ($course as $v) {
    echo " ".$v.",";
}
echo "<br>";
echo "<br>";
echo "<br>";
echo "<hr>";
?>

<?php
echo"<h1> Associative Array</h1> <br>";

$course = array("INT220"=>"Php","INT221"=>"java","INT222"=>"c","INT223"=>"cpp","INT224"=>"python","INT225"=>"html","INT226"=>"css") ;

echo "INT 220  is ".$course['INT220'].", "."INT 221  is  ".$course['INT221'].", "."INT 222  is ".$course['INT222'].", "."INT 223  is ".$course['INT223'].", "."INT 224  is ".$course['INT224'].", "."INT 225  is ".$course['INT225'].", "."INT 226  is ".$course['INT226'];
echo "<br>";
echo "<br>";
echo "<br>";
echo "<hr>";
?>

<?php
echo"<h1> Associative Array using foreach loop </h1> <br>";

$course = array("INT220"=>"Php","INT221"=>"java","INT222"=>"c","INT223"=>"cpp","INT224"=>"python","INT225"=>"html","INT226"=>"css") ;

foreach ($course as $course => $value) {
    echo "key=".$course.", "."value = ".$value."   " ;
}

echo "<br>";
echo "<br>";
echo "<br>";
echo "<hr>";
?>