<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<!-- <?php 
$x=15;
$name="John";
echo $x; 
echo " ";
echo $name;
?>


<?php $data1="PHP";
echo "I am learning $data1!";

echo "I am learning ". $data1 . "!";?>

<?php $value_1 =14;
$value_2=14;
echo $value_1 +$value_2;?> -->


<!-- <?php $number =11;
var_dump($number);
echo "";
$y=99.12;
var_dump($y);?> -->

<!-- <?php $x=true;
    var_dump($x);?>

<?php $languages = array("php", "java", "HTML" ,"<br>", "php","Android","<br>","C","C++","HTML",1, true,34.54);

var_dump($languages);?> -->
<!-- 
<?php $question = "How was your  day??";
$question=null;
var_dump($question);?> -->

<!-- <?php
// case-sensitive constant name
define("WISHES","Good Evening");
echo WISHES; ?> -->

<!-- <?php const WISHES= "Good day";
echo WISHES; ?> -->

<!-- <?php define("WISHES","Good Evening");
echo WISHES."<br>";
echo constant("WISHES");
// both are similar
?> -->

<!-- <?php 
define("courses",[
    "PHP",
    "HTML",
    "CSS"
    ]);
    echo courses[0];?> -->

<!-- <?php
const WISHES = array("PHP",
"HTML",
"CSS");
echo WISHES[0];?> -->


<!-- <?php echo "Directory of the Current PHP script name is ".__DIR__.".";?> <br> -->
<?php 

function hello(){
    static $x="Hello World ";
    return $x;
}
echo " The function name is" .$x;

hello();

?>





</body>
</html>