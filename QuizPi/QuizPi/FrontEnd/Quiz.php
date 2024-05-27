<?php
include_once("../Layout/Header.php");
include("../Layout/UserMenu.php");

// Check if the user is logged in and if they are an admin
$is_admin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'];

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
<input type="hidden" id="difficulty" value="<?php echo $difficulty ?>" />
<input type="hidden" id="category" value="<?php echo $category ?>" />
<input type="hidden" id="amount" value="<?php echo $amount ?>" />
<input type="hidden" id="userTimer" value="<?php echo $timer ?>" />

<h3 id="displayTimer">0</h3>
<br/>
<h3 id="element"></h3>
<br/>
<h3 id="currentQuestions"></h3>
<h3 id="correctQuestions"></h3>
<br/>
<div id="quizSection"></div>

<h3 id="correct"></h3>
<h3 id="wrong"></h3>
<h3 id="Over"></h3>

<?php if ($is_admin): ?>
    <!-- Admin-specific CRUD buttons -->
    <div id="adminButtons">
        <button onClick="location.href='create_quiz.php'">Create Quiz</button>
        <button onClick="location.href='edit_quiz.php'">Edit Quiz</button>
        <button onClick="location.href='delete_quiz.php'">Delete Quiz</button>
        <button onClick="location.href='manage_scores.php'">Manage Scores</button>
    </div>
<?php endif; ?>

<script>
        const req = new XMLHttpRequest();
        var currentQuestion = -1;
        var correctAnswers = 0;
        var myData;
        var totalTime = false;
        var time = 0;
    var timer = document.getElementById("displayTimer");
    var interval;
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

    function loadComplete() {
        var myResponse;
        myResponse = req.responseText;
        myData = JSON.parse(myResponse);
        loadNextQuestion();
        timerFunction();
        }

    function loadNextQuestion() {
        setTimeout(function () {
               currentQuestion++;
        if (myData.length > currentQuestion) {
            var questionDisplay = "<div>" + myData[currentQuestion].question + "</div>";
            var allAnswers = myData[currentQuestion].wrong_answers + "," + myData[currentQuestion].answer;
            allAnswers = shuffleAnswers(allAnswers.split(","));
            for (index in allAnswers) {
                questionDisplay += "<button id='button-space' onClick=checkAnswer(this)>" + allAnswers[index] + "</button>";
            }
            document.getElementById("quizSection").innerHTML = questionDisplay;
            document.getElementById("currentQuestions").innerText = "Current Question: " + currentQuestion + "/" + myData.length;
            document.getElementById("correctQuestions").innerText = "Correct Answers: " + correctAnswers + "/" + myData.length;
        } else {
            document.getElementById("currentQuestions").innerText = "Current Question: " + currentQuestion + "/" + myData.length;
            document.getElementById("correctQuestions").innerText = "Correct Answers: " + correctAnswers + "/" + myData.length;
            endQuiz();
        }
       }, 1000);
    }

    function checkAnswer(button) {
        if (button.textContent == myData[currentQuestion].answer) {
            correctAnswers++;
            document.getElementById('correct').innerText = "That's Correct! ";
            setTimeout(function () {
                document.getElementById('correct').innerText = "";
               }, 1000);
        } else {
            document.getElementById('wrong').innerText = "That's Incorrect! ";
            setTimeout(function () {
               document.getElementById('wrong').innerText = "";
              }, 1000);
        }
        loadNextQuestion();
    }

     function shuffleAnswers(data) {
        for (let i = data.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [data[i], data[j]] = [data[j], data[i]];
        }
        return data;
    }

    function endQuiz() {
        clearInterval(interval);
        let url = "../Backend/AddScore.php?score=" + correctAnswers;
        req.open("GET", url);
        req.responseType = "application/json";
        req.send();
        document.getElementById("Over").innerText = "Quiz Complete, do like your score?";
    }

    function timerFunction() {
        var totalSeconds = document.getElementById("userTimer").value;
        totalSeconds = Number(totalSeconds);
        totalSeconds = totalSeconds * 1000;
        interval = setInterval(function () {
            time++;
            timer.textContent = time;
        }, 1000);
        setTimeout(function() {
            clearInterval(interval);
            timeUp();
        }, totalSeconds);
    };

    function timeUp() {
         document.getElementById("element").innerText = "Time's Up!";
         endQuiz();
    }

</script>
<?php
include_once("../Layout/Footer.php");
?>