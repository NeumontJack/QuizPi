<?php
include_once("../Layout/Header.php");
//It's just one form, but a function
//HERE
//After SUBMIT click, check if person is a USER or ADMIN
//if sucessful send to respectful homepage
//if not sucessful send an alert for person, "refresh page"
//regex? to check password is certain length, characters, special characters, or nums in it
//Create an account can sign a person in and give either admin or user permission depening on credentials
?>
<h1>Welcome to the QuizPi</h1>
<br/>
<p>Think you know your stuff? Login to play our amazing and wacky quizzes and see your score!</p>
<form action="userHome.php" method="post">
Username: <input type="text" name="name"><br>
Password: <input type="password" name="password"><br>
<input type="submit">
send USER to respective homepage
</form>
<br/>
<form action="adminHome.php" method="post">
Username: <input type="text" name="name"><br>
Password: <input type="password" name="password"><br>
<input type="submit">
send ADMIN to respective homepage
</form>
<br/>
<p>Orrrrrrr, create an account because it's your first time with us!</p>
<form action="" method="post">
Full Name: <input type="text" name="name"><br>
Username: <input type="text" name="username"><br>
Password: <input type="password" name="password"><br>
<input type="submit">
send person to respective homepage, while logging them in
</form>



Modal display here would super cool, some pictures of the project

<?php
include_once("../Layout/Footer.php");

?>