<?php 

echo "Welcome to Multi-dimensional Arrays in PHP<br>";

// Creating a 2 dimensional array
$multiDim = array(array(2,5,7,8),
                    array(1,2,4,5),
                    array(5,2,6,9));

// echo var_dump($multiDim);

// echo $multiDim[1][2]; // accessing the element of the array

// Printing the contents of 2 dimensional array
// for ($i = 0; $i < count($multiDim);$i++){
//     echo var_dump($multiDim[$i]);
//     echo "<br>";
// }

for ($i = 0; $i < count($multiDim);$i++){
    for($j=0; $j< count($multiDim[$i]); $j++){
        echo $multiDim[$i][$j];
        echo " ";
    }
    echo "<br>";
}


?>