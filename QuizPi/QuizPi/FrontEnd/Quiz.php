<?php
include_once("../Layout/Header.php");


if (array_key_exists('difficulty', $_POST)) {
    $difficulty = $_POST['difficulty']; //this is how you get parameters
}
if (array_key_exists('category', $_POST)) {
    $category = $_POST['category']; //this is how you get parameters
}

if (array_key_exists('amount', $_POST)) {
    $amount = $_POST['amount']; //this is how you get parameters
}

if (array_key_exists('timer', $_POST)) {
    $timer = $_POST['timer']; //this is how you get parameters

}
?>
//toss timer for now

<input type="hidden" id="difficulty" value="<?php echo $difficulty ?>" />
<input type="hidden" id="category" value="<?php echo $category ?>" />
<input type="hidden" id="amount" value="<?php echo $amount ?>" />
<input type="hidden" id="timer" value="<?php echo $timer ?>" />
<div id="quizSection" >

</div>

<script>
        const req = new XMLHttpRequest();

        window.onload = () => {
        var diff = document.getElementById("difficulty").value;
        var cate = document.getElementById("category").value;
        var size = document.getElementById("amount").value;
        
        let url = "../Backend/GetQuiz.php?difficulty=" + diff + "&category=" + cate + "&amount=" + size;
        req.onload = loadComplete;
        req.open("GET", url);
        req.responseType = "application/json";
        req.send();
        };

    function loadComplete(){
           var myResponse;
            var myData;
            // create a table for display
            var myReturn = "<table><tr><td>Id &nbsp;  &nbsp; </td><td>question &nbsp;  &nbsp; </td><td>answer &nbsp;  &nbsp; <tr><td>Id &nbsp; &nbsp;  &nbsp; </td></tr>";
            myResponse = req.responseText;
            //alert("A: " + myResponse); // Use for debug
            //document.getElementById("A").innerHTML = myResponse; // Display the json for debugging
            myData = JSON.parse(myResponse);

            // Loop through each json record and create the HTML
            for (index in myData) {
                myReturn += "<tr><td>" +
                    myData[index].id + "</td><td>" +
                    myData[index].question + "</td><td>" +
                    myData[index].answer + "</td></tr>";
                    myData[index].wrong_answers + "</td></tr>";

            }
            myReturn += "</table>";
            document.getElementById("quizSection").innerHTML = myReturn; // Display table
    }

</script>
<?php

include_once("../Layout/Footer.php");

?>