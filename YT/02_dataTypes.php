<?php 

/* php data types
string
integer
float
boolean
object
array
null
*/
$name ="Amandeep";
$income=455;
$price=34.56;



$x=true;
$is_friend=false;

echo var_dump($x);
echo ("<br>");
echo var_dump($is_friend);

echo("<br>");

// object -- Instances of classes
// employee is a class --> aman can be one object

// Array - used to store multiple  values in a single variable of same data type

$friends= array("aman","abhishek","suraj","vikas","heartless");
echo var_dump($friends);

echo("<br>");

$name=NULL;
echo var_dump($name);
?>
