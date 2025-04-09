<html>
    <body>
        <h1>PHP INT220</h1>

        <?php echo "SERVER SIDE SCRIPTING HO RAHI HAI BHAI !!! <br>";

        
        
        date_default_timezone_set("Asia/Kolkata"); //setting the timezone 
        
        $d= date("D");
        if($d =="Thu"){
            echo "it's Thursday today";
        }

        echo "<br>";
        echo "<hr>";

        $t= date("H");
        echo "The time is " . $t . "<br>";
        if($t < "20"){
            echo "Have a good day!";
        }
        
        echo "<hr>";

        $num=13;
        if($num%2==0){
            echo "the number is even";
        }
        else{
            echo "the number is odd";
        }
        
        echo "<hr>";
        
        // calculate the grade of a student according to the marks obtained
        $marks=90;
        if($marks>=90){
            echo "Grade A";
        }
        elseif($marks>=80){
            echo "Grade B";
        }
        elseif($marks>=70){
            echo "Grade C";
        }
        else{
            echo "Grade D";
        }
        echo "<hr>";

        //  applying conditions on nationality and age
        $nationality="Indian";
        $age=17;
        if($nationality=="Indian" && $age>=18){
            echo "You are eligible to vote";
        }
        else{
            echo "You are not eligible to vote";
        }

        echo "<hr>";
         
        // learning about switch case
        $num=20;
        switch($num){
            case 10:
                echo "The number is 10";
                break;
            case 20:
                echo "The number is 20";
                break;
            case 30:
                echo "The number is 30";
                break;
            default:
                echo "The number is not 10, 20 or 30";
        }

        echo "<hr>";
        // switch case to find vowels 
        $char='o';
        switch($char){
            case 'a':
                echo "The character is a vowel";
                break;
            case 'e':
                echo "The character is a vowel";
                break;
            case 'i':
                echo "The character is a vowel";
                break;
            case 'o':
                echo "The character is a vowel";
                break;
            case 'u':
                echo "The character is a vowel";
                break;
            default:
                echo "The character is not a vowel";
        }

        echo "<hr>";
        // switch case for different courses and duration
        $course="B.Tech";
        switch($course){
            case 'B.Tech':
                echo "The duration of B.Tech is 4 years";
                break;
            case 'M.Tech':
                echo "The duration of M.Tech is 2 years";
                break;
            case 'B.Sc':
                echo "The duration of B.Sc is 3 years";
                break;
            case 'M.Sc':
                echo "The duration of M.Sc is 2 years";
                break;
            default:
                echo "The course is not available";
        }


        
        
        
        
        ?>

    </body>
</html>