<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php 

echo"While Loops <br>";

$i=1;
while($i<=5){
    echo"$i <br>";
    $i++;
}

?>
<hr>

<?php 

echo"for loop in action <br>";

for ($index = 1; $index <= 5; $index++) {
    echo "The number is $index <br>";
}

?>

<?php
echo "Welcome to the world of foreach loops <br>";
$arr = array("Bananas", "Apples", "Harpic", "Bread", "Butter");
foreach ($arr as  $value) {
    echo "$value <br>";
}
?>

<?php
$x =10;
do {
  echo "The number is: $x <br>";
  $x++;
} while ($x <= 9);
?>




    
</body>
</html>
