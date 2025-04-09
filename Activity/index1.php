<?php
// Start the session to track user progress and answers
session_start();

// Initialize or reset the quiz
if (!isset($_SESSION['quiz_started']) || isset($_POST['reset_quiz'])) {
    $_SESSION['quiz_started'] = true;
    $_SESSION['current_question'] = 0;
    $_SESSION['user_answers'] = [];
    $_SESSION['score'] = 0;
    $_SESSION['quiz_completed'] = false;
}

// Define quiz questions
$quiz_questions = [
    [
        'id' => 1,
        'question' => "What is the capital of France?",
        'options' => ["London", "Berlin", "Paris", "Madrid"],
        'correct_answer' => "Paris",
        'points' => 10
    ],
    [
        'id' => 2,
        'question' => "Which planet is known as the Red Planet?",
        'options' => ["Earth", "Mars", "Jupiter", "Venus"],
        'correct_answer' => "Mars",
        'points' => 10
    ],
    [
        'id' => 3,
        'question' => "What is 9 × 7?",
        'options' => ["56", "63", "72", "81"],
        'correct_answer' => "63",
        'points' => 10
    ],
    [
        'id' => 4,
        'question' => "Who wrote 'Romeo and Juliet'?",
        'options' => ["Charles Dickens", "William Shakespeare", "Jane Austen", "Mark Twain"],
        'correct_answer' => "William Shakespeare",
        'points' => 10
    ],
    [
        'id' => 5,
        'question' => "What is the chemical symbol for gold?",
        'options' => ["Go", "Gd", "Au", "Ag"],
        'correct_answer' => "Au",
        'points' => 10
    ]
];

// Handle answer submission
if (isset($_POST['submit_answer'])) {
    $current_question = $_SESSION['current_question'];
    $question_id = $quiz_questions[$current_question]['id'];
    $selected_option = $_POST['selected_option'] ?? null;
    
    if ($selected_option !== null) {
        $is_correct = ($selected_option === $quiz_questions[$current_question]['correct_answer']);
        $_SESSION['user_answers'][$question_id] = [
            'selected_option' => $selected_option,
            'is_correct' => $is_correct
        ];
        
        // Update score if answer is correct
        if ($is_correct) {
            $_SESSION['score'] += $quiz_questions[$current_question]['points'];
        }
        
        // Move to next question
        if ($current_question < count($quiz_questions) - 1) {
            $_SESSION['current_question']++;
        } else {
            $_SESSION['quiz_completed'] = true;
        }
    }
}

// Calculate total possible score
$total_possible_score = 0;
foreach ($quiz_questions as $question) {
    $total_possible_score += $question['points'];
}

// Get current question
$current_question = $_SESSION['current_question'];
$current_question_data = $quiz_questions[$current_question];

// Function to display quiz header
function displayQuizHeader() {
    echo '<div class="quiz-header">';
    echo '<h1>PHP Quiz Application</h1>';
    echo '</div>';
}

// Function to display current question
function displayQuestion($question_data, $question_number, $total_questions) {
    echo '<div class="question-container">';
    echo '<div class="question-progress">Question ' . ($question_number + 1) . ' of ' . $total_questions . '</div>';
    echo '<h2>' . htmlspecialchars($question_data['question']) . '</h2>';
    
    echo '<form method="post" action="">';
    foreach ($question_data['options'] as $option) {
        echo '<div class="option">';
        echo '<input type="radio" name="selected_option" id="' . htmlspecialchars($option) . '" value="' . htmlspecialchars($option) . '">';
        echo '<label for="' . htmlspecialchars($option) . '">' . htmlspecialchars($option) . '</label>';
        echo '</div>';
    }
    
    echo '<div class="question-footer">';
    echo '<div class="points">Points: ' . $question_data['points'] . '</div>';
    echo '<button type="submit" name="submit_answer">Submit Answer</button>';
    echo '</div>';
    echo '</form>';
    echo '</div>';
}

// Function to display quiz results
function displayResults($quiz_questions, $user_answers, $score, $total_possible_score) {
    echo '<div class="results-container">';
    echo '<h2>Quiz Results</h2>';
    
    echo '<div class="score-summary">';
    echo '<div class="total-score">Your Score: ' . $score . ' / ' . $total_possible_score . '</div>';
    $percentage = round(($score / $total_possible_score) * 100);
    echo '<div class="percentage">Percentage: ' . $percentage . '%</div>';
    echo '</div>';
    
    echo '<div class="answers-review">';
    foreach ($quiz_questions as $index => $question) {
        $question_id = $question['id'];
        $user_answer = isset($user_answers[$question_id]) ? $user_answers[$question_id] : ['selected_option' => 'No answer', 'is_correct' => false];
        
        echo '<div class="question-review">';
        echo '<div class="question-header">';
        echo '<span class="question-number">Q' . ($index + 1) . ':</span>';
        echo '<span class="question-text">' . htmlspecialchars($question['question']) . '</span>';
        
        if ($user_answer['is_correct']) {
            echo '<span class="points-earned">+' . $question['points'] . ' points</span>';
        } else {
            echo '<span class="points-missed">0 points</span>';
        }
        echo '</div>';
        
        echo '<div class="answer-details">';
        echo '<div class="user-answer">Your answer: ';
        $answer_class = $user_answer['is_correct'] ? 'correct-answer' : 'incorrect-answer';
        echo '<span class="' . $answer_class . '">' . htmlspecialchars($user_answer['selected_option']) . '</span>';
        echo '</div>';
        
        if (!$user_answer['is_correct']) {
            echo '<div class="correct-answer">Correct answer: ' . htmlspecialchars($question['correct_answer']) . '</div>';
        }
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
    
    echo '<form method="post" action="">';
    echo '<button type="submit" name="reset_quiz">Try Again</button>';
    echo '</form>';
    echo '</div>';
}

// Function to display progress
function displayProgress($user_answers, $quiz_questions, $score) {
    echo '<div class="progress-container">';
    echo '<div class="current-score">Current Score: ' . $score . '</div>';
    echo '<div class="questions-answered">Questions Answered: ' . count($user_answers) . ' / ' . count($quiz_questions) . '</div>';
    echo '</div>';
}

// HTML and CSS for the application
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
            line-height: 1.6;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .quiz-header h1 {
            text-align: center;
            color: #333;
        }
        .question-container, .results-container, .progress-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .question-progress {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }
        h2 {
            color: #333;
            margin-top: 0;
        }
        .option {
            margin: 10px 0;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
        }
        .option:hover {
            background-color: #f9f9f9;
        }
        .option input[type="radio"] {
            margin-right: 10px;
        }
        .question-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }
        .points {
            font-weight: bold;
            color: #555;
        }
        button {
            background-color: #4a90e2;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #3a7dca;
        }
        .score-summary {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .total-score {
            font-size: 18px;
            font-weight: bold;
        }
        .percentage {
            color: #555;
            margin-top: 5px;
        }
        .question-review {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 15px;
            margin-bottom: 15px;
        }
        .question-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .question-number {
            font-weight: bold;
            margin-right: 5px;
        }
        .question-text {
            flex-grow: 1;
        }
        .points-earned {
            color: green;
            font-weight: bold;
        }
        .points-missed {
            color: red;
            font-weight: bold;
        }
        .answer-details {
            font-size: 14px;
            margin-top: 10px;
        }
        .correct-answer {
            color: green;
            margin-top: 5px;
        }
        .incorrect-answer {
            color: red;
        }
        .progress-container {
            text-align: center;
            background-color: #f9f9f9;
        }
        .current-score {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .questions-answered {
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <?php
    // Display quiz header
    displayQuizHeader();
    
    // Display quiz content
    if (!$_SESSION['quiz_completed']) {
        displayQuestion($current_question_data, $current_question, count($quiz_questions));
        displayProgress($_SESSION['user_answers'], $quiz_questions, $_SESSION['score']);
    } else {
        displayResults($quiz_questions, $_SESSION['user_answers'], $_SESSION['score'], $total_possible_score);
    }
    ?>
</body>
</html>