<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Marks Obtain by the student </h3>
    <?php 
    $marks=79;
    if($marks>=90){
        echo"A";
    }
    elseif($marks>=80 && $marks <=89){
        echo"B";
    }
    elseif($marks>=70 && $marks<=79){
        echo"C";
    }
    else{
        echo"Fail";
    }
    ?>
    <hr>
    <?php 

        $purchase=50;
        if($purchase >= 5000){
            echo "The Final price after the discount is: ".($purchase-($purchase*20)/100);
        }
        elseif($purchase <5000 && $purchase>2000){
            echo "The Final price after the discount is: ".($purchase-($purchase*10)/100);
        }
        else{
            echo"There is no discount, the price is :".($purchase);
        }
        
    
    ?>
    <hr>

    <?php 
    
        $num=10;

        for($i=1;$i<=10;$i++){
            
            echo "$num x $i = " .$num*$i. "<br>";   // . is used for concatenation
        }
        ?>
        <hr>

        <!-- Write a php script that prints all numbers from 1 to 20 and classifies them as "Even" or "Odd" using a while loop. -->
        <!-- <?php 
         
         $number=10;
         while()
        
        
        
        ?> -->

        <hr>

        <?php 
        
        // create a password attempt system where a user gets three chances to enter the correct password using a do-while loop. If the correct password is entered, display "Access Granted" otherwise, keep prompting .
        $password = 4321;
        do($password=)

        ?>
        <hr>
        <?php 
        
        // Simulate a digital wallet system where money is added and deducted based on transactions.

        ?>

        <hr>
        <?php 
        
        // Concatenate first and last names to generate a personalized email greeting.
        
        ?>

        <?php
        
        // A bank calculates simple interest using the formula:
            // SI =(PxRxT)/100  where P is Principal Amount R is Rate of Interest and T is Time in years 
            //Calculate the simple interest  for a principal amount of rs 5000 rate 5% and time 2 years.
        
        ?>

        <?php 
        
        // write a php script to swap two numbers(e.g. $a=5, $b=10) without using a third variable
        
        ?>

        <hr>
        <?php 
        
        // A company gives a 10% bonus to employees if their salary is above Rs.50,000. Otherwise, they get a 5% bonus. Write a PHP script that calculates the total salary after applying the bonus for an employee earning Rs.55,000.
        
        ?>
        <hr>

        <?php 
        
        // A shopping website allows users to add items to their cart . A customer adds three items priced at rs.10000, Rs.50020, and Rs.50020, and Rs. 3020. Write a PHP script to calculate the total cost.

        ?>
        <hr>

        <?php
        
        // An online store has a shopping cart with different product prices. Write a PHP script using a foreach loop to calculate the total amount the customer has to pay.
        
        ?>
        
        
</body>
</html>