<?php
echo "Functions in PHP <br>";

function processMarks($marksArr){
    $sum = 0;
    foreach($marksArr as $value){
        $sum += $value;
    }
    return $sum;
}

function avgMarks($marksArr){
    $sum = 0;
    $i = 0;
    foreach($marksArr as $value){
        $sum += $value;
        $i++;
    }
    return $sum / $i;
}

$rohanDas=[34,45,56,67,78,89,90];
$sumMarks=processMarks($rohanDas);
$avgMarksRohan=avgMarks($rohanDas);


echo "The total marks scored by rohan is $sumMarks <br>";
echo "The average marks scored by rohan is $avgMarksRohan <br>";