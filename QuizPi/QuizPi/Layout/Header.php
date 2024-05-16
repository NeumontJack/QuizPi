<?php
//create a nav bar
//function to check if user is logged in, if not use an alert and "refresh the page" 
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo "Welcome to the member's area, " . htmlspecialchars($_SESSION['username']) . "!";
} else {
    echo "Please log in first to see this page.";
}
//function to check what the person is 
//Either USER or ADMIN
//Sends them to the respective page
?>
<html>
<head>
<title>QuizPi</title>
<a href="/FrontEnd/userHome.php">Home</a>(Will send to user homepage at the moment)
<a href="/FrontEnd/Scoreboard.php">Scoreboard</a>
<a href="/FrontEnd/Quiz.php">Game</a>
</head>
<body>
<br/>
<?php    
?>