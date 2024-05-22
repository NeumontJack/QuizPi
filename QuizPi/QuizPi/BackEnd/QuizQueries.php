<?php

include("dbConnection.php");
session_start();
header('Content-Type: application/json');


$myJSON = "";
$row = null;
$myGet = null;
$rowArray = null;

if(array_key_exists('name', $_POST) == TRUE)
{
    $username = $_POST['name'];
    $password = $_POST['password'];

    $dbConn = dbconnect();

    $feedBack = getLoginConformation($dbConn, $username, $password);

    //echo $username;
    //echo $password;


    if ($feedBack) {
        // loop through each record and format the json (apply any needed business logic)
        while ($row = mysqli_fetch_array($feedBack)) {
            $rowArray[] = json_decode($row[0]);
        }
        // Format array as json
        //$myGet = json_encode($rowArray);
    }
    mysqli_close($dbConn);
    if ($rowArray[0]->id == null) {
        
        header('Location: ../FrontEnd/index.php');
        
    } else {
        //echo $rowArray[0]->role;
        if ($rowArray[0]->role == "USER"){
            $_SESSION['user_id'] = $rowArray[0]->id;
            $_SESSION['name'] = $rowArray[0]->userN;
            $_SESSION['pass'] = $rowArray[0]->pass;
            header('Location: ../FrontEnd/userHome.php'); //?credname=' . $rowArray[0]->userN);
        }else {
            $_SESSION['user_id'] = $rowArray[0]->id;
            $_SESSION['is_admin'] = true;
            header('Location: ../FrontEnd/adminHome.php');
        }
    }
}

if (array_key_exists('Sname', $_POST) == TRUE) {

    $username = $_POST['Sname'];
    $password = $_POST['Spassword'];

    $dbConn = dbconnect();

    addNewUser($dbConn, $username, $password);

    $feedBack = getLoginConformation($dbConn, $username, $password);

    if ($feedBack) {
        // loop through each record and format the json (apply any needed business logic)
        while ($row = mysqli_fetch_array($feedBack)) {
            $rowArray[] = json_decode($row[0]);
        }
    }
    mysqli_close($dbConn);
    if ($rowArray[0]->id == null) {

        header('Location: ../FrontEnd/index.php');

    } else {
        //echo $rowArray[0]->role;
        if ($rowArray[0]->role == "USER") {
            $_SESSION['name'] = $rowArray[0]->userN;
            $_SESSION['pass'] = $rowArray[0]->pass;
            header('Location: ../FrontEnd/userHome.php'); //?credname=' . $rowArray[0]->userN);
        } else {
            header('Location: ../FrontEnd/adminHome.php');
        }
    }
}

?>
