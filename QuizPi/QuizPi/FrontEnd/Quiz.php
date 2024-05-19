<?php
include_once("../Layout/Header.php");
//Before test can begin show an 'options' menu
//Time
//Category
//Size
//Type of question
//All of these can be changed when deciding the difficulty
include("../Layout/UserMenu.php");
include("../BackEnd/dbConnection.php");



?>
<style>
    #secondSelectionContainer {
        display: none;
    }
    #thirdSelectionContainer {
        display: none;
    }
    #fourthSelectionContainer {
        display: none;
    }
    </style>

<h3>Check out our cool feature, depending on the level of difficulty you choose your questions and time will match accordingly, if you dare!</h3>

  <form action="" method="post">
        <label for="difficulty">Difficulty:</label>
        <select id="difficulty" name="difficulty">
            <option value="" disabled selected>Select an option</option>
            <option value="1">Option 1</option>
            <option value="2">Option 2</option>
            <option value="3">Option 3</option>
            <option value="3">Option 3</option>
        </select>
        
        <br/>
      <br/>

        <div id="secondSelectionContainer">
            <label for="timer">Time:</label>
            <select id="timer" name="timer">
                <option value="" disabled selected>Select an option</option>
                <option value="1">Option 1</option>
                <option value="2">Option 2</option>
                <option value="3">Option 3</option>
                <option value="3">Option 3</option>
            </select>
        </div>
      <br/>

      <div id="thirdSelectionContainer">
      <label for="category">Category:</label>
        <select id="category" name="category">
            <option value="" disabled selected>Select an option</option>
            <option value="1">Option 1</option>
            <option value="2">Option 2</option>
            <option value="3">Option 3</option>
            <option value="3">Option 3</option>
        </select>
        </div>
      <br/>
      <div id="fourthSelectionContainer">
      <label for="amount">Amount of Questions:</label>
        <select id="amount" name="amount">
            <option value="" disabled selected>Select an option</option>
            <option value="1">Option 1</option>
            <option value="2">Option 2</option>
            <option value="3">Option 3</option>
            <option value="3">Option 3</option>
        </select>
          </div>
        <br/>

        <input type="submit" value="Submit">
    </form>


<script>
        function syncSelections() {
            var firstSelect = document.getElementById("difficulty");
            var secondSelectContainer = document.getElementById("secondSelectContainer");
            var secondSelect = document.getElementById("timer");
            var thirdSelection = document.getElementById("category");
            var fourthSelection = document.getElementById("amount");
            firstSelect.addEventListener("change", function() {
                secondSelect.value = firstSelect.value;
                thirdSelection.value = secondSelect.value;
                fourthSelection.value = thirdSelection.value;
                secondSelectionContainer.style.display = "block";
                thirdSelectionContainer.style.display = "block";
                fourthSelectionContainer.style.display = "block";
            });
        }
        document.addEventListener("DOMContentLoaded", syncSelections);
    </script>
<?php
include_once("../Layout/Footer.php");
?>