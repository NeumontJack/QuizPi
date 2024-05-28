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
    $question_id = $_POST['question_id'];

    $stmt = $conn->prepare("DELETE FROM Questions WHERE id = ?");
    $stmt->bind_param("i", $question_id);

    if ($stmt->execute()) {
        echo "Question deleted successfully!";
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
    <title>Delete Question</title>
</head>
<body>
    <h2>Delete a Question</h2>
    <form method="post" action="">
        <label for="question_id">Select Question:</label>
        <select id="question_id" name="question_id">
            <option value="">Select...</option>
            <?php while ($question = $questions->fetch_assoc()): ?>
                <option value="<?php echo $question['id']; ?>"><?php echo $question['question_text']; ?></option>
            <?php endwhile; ?>
        </select>
        <br>
        <input type="submit" value="Delete Question">
    </form>
</body>
</html>

<?php include_once("../Layout/Footer.php"); ?>
