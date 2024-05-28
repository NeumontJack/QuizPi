<?php
session_start();
include("../Layout/Header.php");

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: userHome.php");
    exit();
}

include('db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include('Header.php'); ?>

    <div class="container">
        <h2>Admin Dashboard</h2>

        <div class="admin-section">
            <h3>Manage Quizzes</h3>
            <a href="Quiz.php?action=create" class="btn">Create New Quiz</a>
            <a href="Quiz.php?action=view" class="btn">View/Edit Quizzes</a>
        </div>

        <div class="admin-section">
            <h3>Manage Scores</h3>
            <a href="Scoreboard.php" class="btn">View/Edit Scores</a>
        </div>

        <div id="adminButtons">
            <button onClick="location.href='create_quiz.php'">Create Quiz</button>
            <button onClick="location.href='edit_quiz.php'">Edit Quiz</button>
            <button onClick="location.href='delete_quiz.php'">Delete Quiz</button>
            <button onClick="location.href='manage_scores.php'">Manage Scores</button>
        </div>

    </div>

    <?php include('Footer.php'); ?>
</body>
</html>
