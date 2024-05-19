<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: login.php");
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
            <a href="admin_quiz.php?action=create" class="btn">Create New Quiz</a>
            <a href="admin_quiz.php?action=view" class="btn">View/Edit Quizzes</a>
        </div>

        <div class="admin-section">
            <h3>Manage Scores</h3>
            <a href="admin_scoreboard.php" class="btn">View/Edit Scores</a>
        </div>

        <div class="admin-section">
            <h3>Categories</h3>
            <a href="admin_categories.php" class="btn">Manage Categories</a>
        </div>

        <div class="admin-section">
            <h3>Admin Settings</h3>
            <a href="admin_settings.php" class="btn">Settings</a>
        </div>

        <div class="admin-section">
            <h3>Logout</h3>
            <a href="logout.php" class="btn">Logout</a>
        </div>
    </div>

    <?php include('Footer.php'); ?>
</body>
</html>
