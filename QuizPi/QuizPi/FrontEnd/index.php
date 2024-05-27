<?php
include_once("../Layout/Header.php");
?>

<h2>Welcome to the QuizPi</h2>
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