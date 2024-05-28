<?php
session_start();
include_once("../Layout/Header.php");

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: index.php");
    exit();
}

include('../dbConnection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question_id'])) {
    $question_id = $_POST['question_id'];
    $question_text = $_POST['question_text'];
    $category = $_POST['category'];
    $difficulty = $_POST['difficulty'];
    $correct_answer = $_POST['correct_answer'];
    $wrong_answers = $_POST['wrong_answers'];

    $stmt = $conn->prepare("UPDATE Questions SET question_text = ?, category = ?, difficulty = ?, correct_answer = ?, wrong_answers = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $question_text, $category, $difficulty, $correct_answer, $wrong_answers, $question_id);

    if ($stmt->execute()) {
        echo "Question updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$questions = $conn->query("SELECT * FROM Questions");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Question</title>
</head>
<body>
    <h2>Edit a Question</h2>

    <form method="post" action="">
        <label for="question_id">Select Question:</label>
        <select id="question_id" name="question_id" onchange="loadQuestionDetails(this.value)">
            <option value="">Select...</option>
            <?php while ($question = $questions->fetch_assoc()): ?>
                <option value="<?php echo $question['id']; ?>"><?php echo $question['question_text']; ?></option>
            <?php endwhile; ?>
        </select>
        <br>

        <div id="questionDetails" style="display: none;">
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

            <input type="submit" value="Update Question">
        </div>
    </form>

    <script>
        function loadQuestionDetails(questionId) {
            if (questionId === "") {
                document.getElementById("questionDetails").style.display = "none";
                return;
            }

            const xhr = new XMLHttpRequest();
            xhr.onload = function() {
                const question = JSON.parse(this.responseText);
                document.getElementById("question_text").value = question.question_text;
                document.getElementById("category").value = question.category;
                document.getElementById("difficulty").value = question.difficulty;
                document.getElementById("correct_answer").value = question.correct_answer;
                document.getElementById("wrong_answers").value = question.wrong_answers;
                document.getElementById("questionDetails").style.display = "block";
            };
            xhr.open("GET", `../Backend/GetQuiz.php?question_id=${questionId}`);
            xhr.send();
        }
    </script>
</body>
</html>

<?php include_once("../Layout/Footer.php"); ?>
