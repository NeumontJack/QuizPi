<?php
session_start();
include_once("../Layout/Header.php");

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: index.php");
    exit();
}

include('../dbConnection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['quiz_id'])) {
    $quiz_id = $_POST['quiz_id'];
    $title = $_POST['title'];
    $category = $_POST['category'];
    $difficulty = $_POST['difficulty'];

    $stmt = $conn->prepare("UPDATE Quizzes SET title = ?, category = ?, difficulty = ? WHERE id = ?");
    $stmt->bind_param("sssi", $title, $category, $difficulty, $quiz_id);

    if ($stmt->execute()) {
        echo "Quiz updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$quizzes = $conn->query("SELECT * FROM Quizzes");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Quiz</title>
</head>
<body>
    <h2>Edit a Quiz</h2>

    <form method="post" action="">
        <label for="quiz_id">Select Quiz:</label>
        <select id="quiz_id" name="quiz_id" onchange="loadQuizDetails(this.value)">
            <option value="">Select...</option>
            <?php while ($quiz = $quizzes->fetch_assoc()): ?>
                <option value="<?php echo $quiz['id']; ?>"><?php echo $quiz['title']; ?></option>
            <?php endwhile; ?>
        </select>
        <br>

        <div id="quizDetails" style="display: none;">
            <label for="title">Quiz Title:</label>
            <input type="text" id="title" name="title" required><br>

            <label for="category">Category:</label>
            <input type="text" id="category" name="category" required><br>

            <label for="difficulty">Difficulty:</label>
            <input type="text" id="difficulty" name="difficulty" required><br>

            <input type="submit" value="Update Quiz">
        </div>
    </form>

    <script>
        function loadQuizDetails(quizId) {
            if (quizId === "") {
                document.getElementById("quizDetails").style.display = "none";
                return;
            }

            const xhr = new XMLHttpRequest();
            xhr.onload = function() {
                const quiz = JSON.parse(this.responseText);
                document.getElementById("title").value = quiz.title;
                document.getElementById("category").value = quiz.category;
                document.getElementById("difficulty").value = quiz.difficulty;
                document.getElementById("quizDetails").style.display = "block";
            };
            xhr.open("GET", `../Backend/GetQuiz.php?quiz_id=${quizId}`);
            xhr.send();
        }
    </script>
</body>
</html>

<?php include_once("../Layout/Footer.php"); ?>
