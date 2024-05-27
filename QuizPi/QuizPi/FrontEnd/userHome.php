<?php
session_start();
include("../Layout/UserMenu.php");
include("../BackEnd/dbConnection.php");

$username = $_SESSION['name'];
$password = $_SESSION['pass'];

$dbConn = dbconnect();

$feedBack = getLoginConformation($dbConn, $username, $password);

if ($feedBack) {
    // loop through each record and format the json (apply any needed business logic)
    while ($row = mysqli_fetch_array($feedBack)) {
        $rowArray[] = json_decode($row[0]);
    }
}
mysqli_close($dbConn);

?>


<h1 class="userName">Nice to see you again <?php echo $_SESSION['name']; ?>!</h1>

<img class="proPic" alt="ProfilePicture"/>
<br/>
<div>
<button id="updateBtn">Update Image</button>
<br/>
<input type="text" id="imgUrl" placeholder="New Image URL"/>
<br/>
<button>Update</button>
</div>


<div class="scoreDiv"><h3 class="scoreHeader">Your Highest Score: <?php echo $rowArray[0]->score; ?></h3></div>
<?php
include_once("../Layout/Footer.php");
?>