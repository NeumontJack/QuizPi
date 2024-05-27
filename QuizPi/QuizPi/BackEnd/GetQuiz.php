<?php

require_once "dbConnection.php";

if (array_key_exists('difficulty', $_GET)) {
    $difficulty = $_GET['difficulty']; //this is how you get parameters
}
if (array_key_exists('category', $_GET)) {
    $category = $_GET['category']; //this is how you get parameters
}

if (array_key_exists('amount', $_GET)) {
    $amount = $_GET['amount']; //this is how you get parameters
}


$connection = dbconnect();
$result = getQuiz($connection, $difficulty, $category, $amount);

$myJSON = null;
$row = null;


if ($result) {
    while ($row = mysqli_fetch_array($result)) {
        $rowArray[] = json_decode($row[0]);
    }
    $myJSON = json_encode($rowArray);
}

mysqli_close($connection);
echo $myJSON;
?>


