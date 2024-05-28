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
    $title = $_POST['title'];
    $category = $_POST['category'];
    $difficulty = $_POST['difficulty'];

    $stmt = $conn->prepare("INSERT INTO Quizzes (title, category, difficulty) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $category, $difficulty);

    if ($stmt->execute()) {
        echo "New quiz created successfully!";
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
    <title>Create Quiz</title>
</head>
<body>
    <h2>Create a New Quiz</h2>
    <form method="post" action="">
        <label for="title">Quiz Title:</label>
        <input type="text" id="title" name="title" required><br>

        <label for="category">Category:</label>
        <input type="text" id="category" name="category" required><br>

        <label for="difficulty">Difficulty:</label>
        <input type="text" id="difficulty" name="difficulty" required><br>

        <input type="submit" value="Create Quiz">
    </form>
</body>
</html>

<?php include_once("../Layout/Footer.php"); ?>
