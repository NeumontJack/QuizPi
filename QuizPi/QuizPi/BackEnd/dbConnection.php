<?php

DEFINE("SERVER", "localhost");
DEFINE("USERN", "root");
DEFINE("PASS", "Dr.Phid21@");
DEFINE("DBNAME", ""); // Need to determine what the db name to be

// Try connection with db
function dbconnect()
{
    $dbConn = mysqli_connect(SERVER, USERN, PASS, DBNAME);

    if (!$dbConn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $dbConn;
}

function getAllRecords($dbConn, $info) 
{
    $query = "";

    return mysqli_query($dbConn, $query);
}

?>
