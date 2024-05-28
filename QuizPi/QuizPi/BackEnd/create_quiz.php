<?php
session_start();
include_once("../Layout/Header.php");

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: index.php");
    exit();
}

include('../dbConnection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question_text = $_POST['question_text'];
    $category = $_POST['category'];
    $difficulty = $_POST['difficulty'];
    $correct_answer = $_POST['correct_answer'];
    $wrong_answers = $_POST['wrong_answers'];

    $stmt = $conn->prepare("INSERT INTO Questions (question_text, category, difficulty, correct_answer, wrong_answers) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $question_text, $category, $difficulty, $correct_answer, $wrong_answers);

    if ($stmt->execute()) {
        echo "New question created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Question</title>
</head>
<body>
    <h2>Create a New Question</h2>
    <form method="post" action="">
        <label for="question_text">Question:</label>
        <input type="text" id="question_text" name="question_text" required><br>

        <label for="category">Category:</label>
        <input type="text" id="category" name="category" required><br>

        <label for="difficulty">Difficulty:</label>
        <input type="text" id="difficulty" name="difficulty" required><br>

        <label for="correct_answer">Correct Answer:</label>
        <input type="text" id="correct_answer" name="correct_answer" required><br>

        <label for="wrong_answers">Wrong Answers (comma-separated):</label>
        <input type="text" id="wrong_answers" name="wrong_answers" required><br>

        <input type="submit" value="Create Question">
    </form>
</body>
</html>

<?php include_once("../Layout/Footer.php"); ?>
