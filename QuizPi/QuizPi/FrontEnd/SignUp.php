<?php

include('../Layout/Header.php');

?>

<p>Think you know your stuff? Sign Up to play our amazing and wacky quizzes and see your score!</p>
<form action="../BackEnd/QuizQueries.php" method="post">
Username: <input type="text" name="Sname"><br>
Password: <input type="password" name="Spassword"><br>
<input type="submit">
send USER to respective homepage
</form>
<br/>
