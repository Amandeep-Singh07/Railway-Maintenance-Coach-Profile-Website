<?php
session_start();

// Initialize session variables if not set
if (!isset($_SESSION['current_question'])) {
    $_SESSION['current_question'] = 0;
    $_SESSION['score'] = 0;
    $_SESSION['answers'] = [];
}

// Quiz questions array
function getQuizQuestions() {
    return [
        [
            'question' => 'What does PHP stand for?',
            'options' => [
                'Personal Home Page',
                'PHP: Hypertext Preprocessor',
                'Program Hypertext Processor',
                'Preprocessed Hypertext Pages'
            ],
            'correct_answer' => 1
        ],
        [
            'question' => 'Which of the following is used to declare a constant in PHP?',
            'options' => [
                'const',
                'constant',
                'define()',
                'Both A and C'
            ],
            'correct_answer' => 3
        ],
        [
            'question' => 'Which of the following is NOT a valid PHP variable name?',
            'options' => [
                '$variable',
                '$_variable',
                '$variable_name',
                '$2variable'
            ],
            'correct_answer' => 3
        ],
        [
            'question' => 'Arrays in PHP are actually...',
            'options' => [
                'Maps or dictionaries',
                'Ordered hash tables',
                'Objects of the Array class',
                'Lists of variables'
            ],
            'correct_answer' => 1
        ],
        [
            'question' => 'Which function is used to find the length of a string in PHP?',
            'options' => [
                'len()',
                'count()',
                'strlen()',
                'length()'
            ],
            'correct_answer' => 2
        ]
    ];
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $questions = getQuizQuestions();
    
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'restart') {
            // Reset the quiz
            $_SESSION['current_question'] = 0;
            $_SESSION['score'] = 0;
            $_SESSION['answers'] = [];
        } elseif ($_POST['action'] === 'submit' && isset($_POST['answer'])) {
            // Process answer submission
            $current = $_SESSION['current_question'];
            $selected_answer = (int)$_POST['answer'];
            
            // Store the user's answer
            $_SESSION['answers'][$current] = $selected_answer;
            
            // Check if the answer is correct
            if ($selected_answer === $questions[$current]['correct_answer']) {
                $_SESSION['score']++;
            }
            
            // Move to the next question
            $_SESSION['current_question']++;
        }
    }
}

// Get current state
$questions = getQuizQuestions();
$current_question = $_SESSION['current_question'];
$total_questions = count($questions);
$is_quiz_completed = $current_question >= $total_questions;

// Functions for displaying quiz results
function calculatePercentage($score, $total) {
    return ($total > 0) ? round(($score / $total) * 100) : 0;
}

function getPerformanceMessage($percentage) {
    if ($percentage >= 80) {
        return 'Excellent! You have a great understanding of PHP.';
    } elseif ($percentage >= 60) {
        return 'Good job! You have a solid understanding of PHP.';
    } elseif ($percentage >= 40) {
        return 'Not bad. Keep practicing to improve your PHP knowledge.';
    } else {
        return 'You might need more practice with PHP concepts.';
    }
}

function displayQuizResults($score, $total) {
    $percentage = calculatePercentage($score, $total);
    $message = getPerformanceMessage($percentage);
    
    echo "<div class='result-container'>";
    echo "<h2>Quiz Results</h2>";
    echo "<p>You scored $score out of $total</p>";
    echo "<p>Percentage: $percentage%</p>";
    echo "<p>$message</p>";
    
    // Display the restart button
    echo "<form method='post'>";
    echo "<input type='hidden' name='action' value='restart'>";
    echo "<button type='submit' class='btn'>Take Again</button>";
    echo "</form>";
    echo "</div>";
}

function reviewAnswers($questions, $user_answers) {
    echo "<div class='review-container'>";
    echo "<h3>Review Your Answers</h3>";
    
    foreach ($user_answers as $index => $selected) {
        $question = $questions[$index];
        $is_correct = ($selected === $question['correct_answer']);
        
        echo "<div class='question " . ($is_correct ? 'correct' : 'incorrect') . "'>";
        echo "<p><strong>Question " . ($index + 1) . ":</strong> {$question['question']}</p>";
        echo "<p>Your answer: " . $question['options'][$selected] . "</p>";
        
        if (!$is_correct) {
            echo "<p>Correct answer: " . $question['options'][$question['correct_answer']] . "</p>";
        }
        
        echo "</div>";
    }
    
    echo "</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Quiz Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .quiz-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .progress {
            margin-bottom: 20px;
            color: #555;
        }
        .question-container {
            margin-bottom: 20px;
        }
        .options {
            margin-top: 15px;
        }
        .option {
            display: block;
            margin: 10px 0;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
        }
        .option:hover {
            background-color: #eaeaea;
        }
        .option input {
            margin-right: 10px;
        }
        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .result-container {
            text-align: center;
            margin-top: 20px;
        }
        .review-container {
            margin-top: 30px;
        }
        .question {
            margin: 15px 0;
            padding: 15px;
            border-radius: 4px;
        }
        .correct {
            background-color: rgba(76, 175, 80, 0.1);
            border-left: 5px solid #4CAF50;
        }
        .incorrect {
            background-color: rgba(244, 67, 54, 0.1);
            border-left: 5px solid #F44336;
        }
    </style>
</head>
<body>
    <div class="quiz-container">
        <h1>PHP Quiz</h1>
        
        <?php if (!$is_quiz_completed): ?>
            <!-- Display the quiz -->
            <div class="progress">
                Question <?php echo $current_question + 1; ?> of <?php echo $total_questions; ?>
            </div>
            
            <div class="question-container">
                <h3><?php echo $questions[$current_question]['question']; ?></h3>
                
                <form method="post" class="options">
                    <?php foreach ($questions[$current_question]['options'] as $key => $option): ?>
                        <label class="option">
                            <input type="radio" name="answer" value="<?php echo $key; ?>" required>
                            <?php echo $option; ?>
                        </label>
                    <?php endforeach; ?>
                    
                    <input type="hidden" name="action" value="submit">
                    <button type="submit" class="btn">Next Question</button>
                </form>
            </div>
        <?php else: ?>
            <!-- Display the results -->
            <?php 
                displayQuizResults($_SESSION['score'], $total_questions);
                reviewAnswers($questions, $_SESSION['answers']);
            ?>
        <?php endif; ?>
    </div>
</body>
</html>