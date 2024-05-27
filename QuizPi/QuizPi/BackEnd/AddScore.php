<?php
require_once "QuizQueries.php";

if (array_key_exists('score', $_GET)) {
    $score = $_GET['score']; 
}

if (array_key_exists('name', $_SESSION)) {
    $username = $_SESSION['name']; 
}

$connection = dbconnect();
$result = addScoreToUser($connection, $score, $username);

$myJSON = null;
$row = null;


if ($result) {
    header('Location: ../FrontEnd/Scoreboard.php');
}else{
    header('Location: ../FrontEnd/userHome.php');
}

mysqli_close($connection);
echo $myJSON;

?>
