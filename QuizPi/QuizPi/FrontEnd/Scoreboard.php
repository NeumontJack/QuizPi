<?php
include_once("../Layout/Header.php");
//Leaderboard that displays the top 10 scores ranked from highest to lowest
//doesn't matter the category or difficulty 
//Later can create different functions to sort/filter based on category, time, etc.
//include("../Layout/UserMenu.php");
include('../BackEnd/dbConnection.php');
include("../Layout/UserMenu.php");

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



<input  id="inputUser" type="text" placeholder="Enter Username"/>
<button onclick="findUser()">Search User</button>

<p id="searchedUser"></p>


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

<script>
    
    var request = new XMLHttpRequest();

    function findUser() {
        var user = document.getElementById('inputUser').value;
        request.open('Get', '../BackEnd/QuizQueries.php?find=' + user)
        request.onload = loadFound;
        request.send();
    }

    function loadFound(evt) {
        var myResponse;
        var myData;
        var myReturn = "<table class='searchScores'><tr><td>User ID &nbsp;  &nbsp; </td><td>UserName &nbsp;  &nbsp; </td><td>Score &nbsp;  &nbsp; </td></tr>";

        myResponse = request.responseText;
        console.log(myResponse);
        myData = JSON.parse(myResponse);
        console.log(myData);
        for (index in myData) {
            myReturn += "<tr><td>" + myData[index].id + "</td><td>" +
                myData[index].userN + "</td><td>" +
                myData[index].score + "</td><td>" +
                "</tr>";
        }
        myReturn += "</table>";
        document.getElementById("searchedUser").innerHTML = myReturn;
    }

</script>

<?php
include_once("../Layout/Footer.php");
?>