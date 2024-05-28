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
    $quiz_id = $_POST['quiz_id'];

    $stmt = $conn->prepare("DELETE FROM Quizzes WHERE id = ?");
    $stmt->bind_param("i", $quiz_id);

    if ($stmt->execute()) {
        echo "Quiz deleted successfully!";
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
    <title>Delete Quiz</title>
</head>
<body>
    <h2>Delete a Quiz</h2>
    <form method="post" action="">
        <label for="quiz_id">Select Quiz:</label>
        <select id="quiz_id" name="quiz_id">
            <option value="">Select...</option>
            <?php while ($quiz = $quizzes->fetch_assoc()): ?>
                <option value="<?php echo $quiz['id']; ?>"><?php echo $quiz['title']; ?></option>
            <?php endwhile; ?>
        </select>
        <br>
        <input type="submit" value="Delete Quiz">
    </form>
</body>
</html>

<?php include_once("../Layout/Footer.php"); ?>
