<?php 
/*operators in php

Arithmetic operator
assignment operator
comparison operator 
logical operator

*/

 //arithmetic operator
 $a= 20;
 $b= 3;
echo "<i>For a+b, the result is ".($a + $b). "<br></i>";
echo "<i>For a-b, the result is ".($a - $b). "<br></i>";
echo "<i>For a*b, the result is ".($a * $b). "<br></i>";
echo "<i>For a/b, the result is ".($a / $b). "<br></i>";
echo "<i>For a%b, the result is ".($a % $b). "<br></i>";
echo "<i>For a**b, the result is ".($a ** $b). "<br></i>";

echo "<br>";
echo "<hr>";
echo "<br>";

// assignment operator

$x=$a;
echo "The value of x is: ". $x."<br>";

$x+=6;
echo "now the value is: ".$x."<br>";


// comparison operator
$x=45;
$y=56;
echo "For x==y, the result is ";
echo var_dump($x==$y);
echo "<br>";

echo "The two strings are not equal (\$x<>\$y): ";
echo var_dump($x<>$y); // <> representation of not equals to


// logical operator in php are (and , or) and we can write like (&& , ||)
// logical operator are applicable on boolean values in php

?>