<?php 
$i=1;
while($i<=10){
    echo $i."<br>";
    $i++;
}

echo "<hr>";

// example of do-while loop
$j=1;
do{
    echo $j."<br>";
    $j++;
}while($j<=10);

echo "<hr>";

$superheroes=array(
    "name"=>"Superman",
    "email"=>"super@gmail.com",
    "age"=>30,
);

// example of foreach loop 
foreach($superheroes as $key=>$value){
    echo $key." : ".$value."<br>";
}
echo "<hr>";

$numbers = array(1, 2, 3, 4, 5);

// example of foreach loop with indexed array
foreach($numbers as $number){
    echo $number."<br>";
}

echo "<hr>";

$students = array(
    array("name" => "John", "age" => 20),
    array("name" => "Jane", "age" => 22),
    array("name" => "Doe", "age" => 21),
);

// example of nested foreach loop
foreach($students as $student){
    foreach($student as $key => $value){
        echo $key." : ".$value."<br>";
    }
    echo "<br>";
}

// nested break statement
for($i=1;$i<=5;$i++){
    for($j=1;$j<=5;$j++){
        echo $i." ".$j."<br>";
        if($j==3){
            break;
        }
    }
}

// break statement in array
$numbers = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
foreach($numbers as $number){
    if($number==5){
        break;
    }
    echo $number."<br>";
}

?>