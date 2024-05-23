<?php


DEFINE("SERVER", "localhost");
DEFINE("USERN", "root");
DEFINE("PASS", "Y2KBest!");
DEFINE("DBNAME", "quizusers");
function dbconnect()
{
    $dbConn = mysqli_connect(SERVER, USERN, PASS, DBNAME);

    if (!$dbConn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $dbConn;
}

// Get All records ordered by score
function getAllRecordsByScore($dbConn) 
{
    $query = "SELECT JSON_OBJECT(
                'userN', username,
                'score', score) from users order by score desc";

    return mysqli_query($dbConn, $query);
}

// Gets the top Five users by score
function getTopFiveRecords($dbConn) {

    $query = "";

    return mysqli_query($dbConn, $query);
}

function getAllRecords($dbConn) {

    $query = "";

    return mysqli_query($dbConn, $query);
}

function getLoginConformation($dbConn, $userN, $pass) 
{

    $query = "SELECT JSON_OBJECT(
            'id', id,
            'userN', username,
            'pass', password,
            'score', score,
            'role', role)
            from users WHERE username = '". $userN ."' and password = '". $pass ."'";

    return mysqli_query($dbConn, $query);

}

function addNewUser($dbConn, $userN, $pass) {

    $query = "INSERT INTO users (username, password, score, role) VALUES ('". $userN."', '". $pass."', '0', 'USER')";

    return mysqli_query($dbConn, $query);
}


function getQuiz($dbConn, $difficulty, $category, $amount)
{

    $query = "SELECT JSON_OBJECT(
            'id', id,
            'question', question,
            'difficulty', difficulty,
            'answer', answer,
            'category', category,
            'wrong_answers', wrong_answers)
            from food WHERE difficulty = " . $difficulty . " and category = '" . $category . "' LIMIT " . $amount . "";

    return mysqli_query($dbConn, $query);
}

?>
