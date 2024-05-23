<?php
include_once("../Layout/Header.php");
//Leaderboard that displays the top 10 scores ranked from highest to lowest
//doesn't matter the category or difficulty 
//Later can create different functions to sort/filter based on category, time, etc.
//include("../Layout/UserMenu.php");
include('../BackEnd/dbConnection.php');

$dbConn = dbconnect();

$feedBack = getAllRecordsByScore($dbConn);

if ($feedBack) {
    // loop through each record and format the json (apply any needed business logic)
    while ($row = mysqli_fetch_array($feedBack)) {
        $rowArray[] = json_decode($row[0]);
    }
}
mysqli_close($dbConn);

//echo var_dump($rowArray);
//echo count($rowArray);
?>

<table>
    <tr>
        <th>Place</th>
        <th>Username</th>
        <th>Score</th>
    </tr>
    <?php foreach ($rowArray as $i): ?>
        <?php $int += 1 ?>
        <tr>
            <td><?= $int ?></td>
            <td><?= $i->userN?></td>
            <td><?= $i->score?></td>
            
        </tr>
    <?php endforeach; ?>
</table>

Scoreboard

<?php
include_once("../Layout/Footer.php");
?>