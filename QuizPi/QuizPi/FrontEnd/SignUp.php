<?php
include('../Layout/Header.php');
//include("../Layout/Menu.php");

?>

<h3>Or if you're new create an account to play!</h3>
<form action="../BackEnd/QuizQueries.php" method="post">
Username: <input type="text" name="Sname"><br>
Password: <input type="password" name="Spassword"><br>
<input type="submit">
</form>
<br/>
