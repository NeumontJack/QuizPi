<?php
session_start();
include_once("../Layout/Header.php");
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

$id = $rowArray[0]->id;

?>


<h1 class="userName">Nice to see you again <?php echo $_SESSION['name']; ?>!</h1>

<img class="proPic" alt="ProfilePicture" src="<?php echo $rowArray[0]->img; ?>"/>
<button id="showUp" onclick="showUpdate()">Update Image</button>
<input type="text" id="imgUrl" placeholder="New Image URL" hidden/>
<button id="btnUpdate" onclick="upPic()" hidden>Update</button>

<div class="scoreDiv"><h3 class="scoreHeader">Your Highest Score: <?php echo $rowArray[0]->score; ?></h3></div>

<div><a class="ScoreBoardLink" href="Scoreboard.php">ScoreBoard</a></div>

You're on the user homepage

<script>

    var request = new XMLHttpRequest();

    function showUpdate() {
        document.getElementById("btnUpdate").hidden = false;
        document.getElementById("imgUrl").hidden = false;
        document.getElementById("showUp").hidden = true;
    }

    function upPic() {
        var url = document.getElementById('imgUrl').value;
        var uInfo = "<?php echo $id ?>";
        uInfo = uInfo + "///" + url;
        request.open('Get', '../BackEnd/QuizQueries.php?upPic=' + uInfo)
        request.onload = loadPic;
        request.send();
    }

    function loadPic(evt) {
        document.getElementById("btnUpdate").hidden = true;
        document.getElementById("imgUrl").hidden = true;
        document.getElementById("showUp").hidden = false;
        location.reload();
    }

</script>

<?php
include_once("../Layout/Footer.php");
?>