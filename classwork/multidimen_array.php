<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    $result = array(
        array("Manoj",7.8,"pass"),
        array("Aditya",8.5,"pass"),
        array("Anuj",4.9,"fail"),
    );
    echo $result[0][0]. "--CGPA is: ".$result[0][1]." and his status is ".$result[0][2]."<br>";
    echo $result[1][0]."--CGPA is : ".$result[1][1]."and his status is".$result[1][2]."<br>";
    echo $result[2][0]."--CGPA is :".$result[2][1]." and his status is".$result[2][2]."<br>";

    for ($i = 0; $i < 3; $i++){
    echo "<h4> Row number $i</h4>";

foreach ($result[$i] as $resul) {
    echo $resul."<br>";
}
}
?>

<hr>

<?php 
    $result = array(
        array(
            "name" => "Manoj",
            "cgpa" => "7.8",
            "status" => "pass"
        ),
        array(
            "name" => "anuj",
            "cgpa" => "7.9",
            "status" => "pass"
        ),
        array(
            "name" => "aman",
            "cgpa" => "9.9",
            "status" => "pass"
        )
    );

echo $result[0]["name"] . "---CGPA is: " . $result[0]["cgpa"] . "and his status is " . $result[0]["status"] . "<br>";
echo $result[1]["name"]."---CGPA is: ".$result[1]["cgpa"]. "and his status is ".$result[1]["status"]."<br>";
echo $result[2]["name"]."---CGPA is: ".$result[2]["cgpa"]. "and his status is ".$result[2]["status"]."<br>";



?>

    
</body>
</html>
