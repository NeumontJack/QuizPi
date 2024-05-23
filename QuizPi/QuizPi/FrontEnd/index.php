<?php
include_once("../Layout/Header.php");
//include("../Layout/Menu.php");
//It's just one form, but a function
//HERE
//After SUBMIT click, check if person is a USER or ADMIN
//if sucessful send to respectful homepage
//if not sucessful send an alert for person, "refresh page"
//regex? to check password is certain length, characters, special characters, or nums in it
//Create an account can sign a person in and give either admin or user permission depening on credentials


//if (isset($_SESSION['userInfo'])) {
//    header("Location: UserPage.php");
//}

?>

<h1>Welcome to the QuizPi</h1>
<br/>
<h3>Think you know your stuff? <br/>Login to play our amazing and wacky quizzes and see your score!</h3>
<div>
<form action="../BackEnd/QuizQueries.php" method="post">
Username: <input type="text" name="name"><br>
Password: <input type="password" name="password"><br>
<input type="submit">
</form>
</div>
<br/>
<form><a href="SignUp.php">Sign Up Here</a></form>
<br/>
<?php
include_once("../Layout/Footer.php");

?>