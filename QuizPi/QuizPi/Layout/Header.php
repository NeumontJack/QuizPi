<?php
if (isset($_SESSION['user_id'])){
    echo "Welcome to the member's area, " . htmlspecialchars($_SESSION['username']) . "!";
    header("../Layout/UserMenu");
} else {
    //echo "Please log in first to see this page.";
}


?>
<html>
<head>
    <title>QuizPi</title>
    <div class="navbar">
        <div class="empty"></div>
            <ul class="menu">
                <li><a href="/FrontEnd/userHome.php">Home</a></li> 
                <li><a href="/FrontEnd/Scoreboard.php">Scoreboard</a></li> 
                <li><a href="/FrontEnd/Options.php">Quiz Options</a></li> 
            </ul>
    </div>
    <link rel="stylesheet" href="../Layout/StyleSheet.css">
</head>
<body>
<br/>