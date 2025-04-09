<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
// using combine function to combine two arrays

// $name = array("Manoj", "Rahul", "Aneesh");
// $marks = array("56", "67", "45");
// $c=array_combine($name, $marks);
// print_r($c);

// using chunk function to split an array into chunks
// $courses=array("PHP","Laravel","Node js","HTML","CSS","ASP.NET");
// print_r(array_chunk($courses,2));

// echo "<br>";


// $courses=array("PHP","Laravel","Node js","HTML","CSS","ASP.NET");
// print_r(array_chunk($courses,2,true));

// using array_count_values function to count the values of an array

// $a=array("Manoj","Rahul","Aneesh","Manoj","Rahul","Aneesh","Manoj","Rahul","Aneesh","Manoj","Rahul","Aneesh");
// print_r(array_count_values($a));

// using array_diff function to compare two arrays and return the difference

//  $a=array("a"=>"red","b"=>"green","c"=>"blue","d"=>"yellow");
//  $b=array("e"=>"red");

//  $result = array_diff($a,$b);

//  print_r($result);


// using array_flip function to flip the keys and values of an array

// $a=array("a"=>"red","b"=>"green","c"=>"blue","d"=>"yellow");
// $result=array_flip($a);

// print_r($result);

// using array_intersect function to compare two arrays and return the matches

// $a1=array("a"=>"red","b"=>"green","c"=>"blue","d"=>"yellow");
// $a2=array("e"=> "red","f"=> "green","g"=> "blue");
// $a3=array("red","blue");

// $result=array_intersect($a1,$a2,$a3);
// print_r($result);

// using array_merge function to merge two arrays
// $a1=array("a"=>"red","b"=>"green");
// $a2=array("c"=> "blue ","d"=> "yellow");
// $a3=array("a"=> "orange",""=> "magenta");

// print_r(array_merge(array($a1, $a2), $a3));

// using pop function to remove the last element of an array

// $a=array("red","green","blue");
// print(array_pop($a));

// using reverse function to reverse the order of an array
// $a=array("volvo","Audi","mahindra","BMW");
// print(array_pop($a));
// print(array_reverse($a,true));


$result=array(
array(
    "name"=>"Manoj",
    "age"=>"25",
    "city"=>"Bangalore"
),
array(
    "name"=>"Rahul",
    "age"=>"26",
    "city"=>"Mumbai"
),
array(
    "name"=>"Aneesh",
    "age"=>"27",
    "city"=>"Chennai"

)
);

$name= array_column($result,"name");
print_r($name);




?>
</body>
</html>