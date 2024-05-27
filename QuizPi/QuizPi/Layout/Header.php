<?php
if (isset($_SESSION['user_id'])){
    echo "Welcome to the member's area, " . htmlspecialchars($_SESSION['username']) . "!";
    header("../Layout/UserMenu");
} else {
    //echo "Please log in first to see this page.";
}


?>
<html>
<head>
    <link rel="stylesheet" href="../Layout/GradientStyles.css">
    <title>QuizPi</title>
    
</head>
<body>
    <nav>
        <div class="navbar">
        <div class="empty"></div>
            <div class="dropdown">  
                <button class="dropbtn">Themes</button>  
                <div name="colors" class="dropdown-content" >  
                    <a href="#" class="theme-link" onclick="changeColor('blue')">Blue Sky</a>
                    <a href="#" class="theme-link" onclick="changeColor('mocha')">Mocha</a>
                    <a href="#" class="theme-link" onclick="changeColor('night-sky')">Night Sky</a>
                    <a href="#" class="theme-link" onclick="changeColor('sunrise-sunset')">Sunrise / Sunset</a>
                </div>
            </div>
    </div>
    <div class="ball"></div>
    <div class="cloud-container"><div class="cloud"></div><div class="cloud2"></div></div>
    </nav>
<br/>

<script>

    var request = new XMLHttpRequest();

    window.onload = function () {
        getCss();
    }

    function getCss() {
        request.open('Get', '../BackEnd/JsonQuizQueries.php?');
        request.onload = changeColorOnLoad;
        request.send();
    }

    function upCss(colorClass) {

        if (colorClass == 'blue') {
            num = 1;
        }
        if (colorClass == 'mocha') {
            num = 2;
        }
        if (colorClass == 'night-sky') {
            num = 3;
        }
        if (colorClass == 'sunrise-sunset') {
            num = 4;
        }

        request.open('Get', '../BackEnd/QuizQueries.php?css=' + num);
        request.onload = load;
        request.send();
    }

    function load(evt) {
        getCss();
    }

    function changeColorOnLoad(evt) {
        var element = document.body
        element.classList.remove('blue', 'mocha', 'night-sky', 'sunrise-sunset');
        var myResponse;
        var myData;

        myResponse = request.responseText;
        console.log(myResponse);
        myData = JSON.parse(myResponse);
        console.log(myData);
        for (index in myData) {
            colorClass = myData[index].css;
        }

        if (colorClass == 1) {
            css = 'blue';
        }
        if (colorClass == 2) {
            css = 'mocha';
        }
        if (colorClass == 3) {
            css = 'night-sky';
        }
        if (colorClass == 4) {
            css = 'sunrise-sunset';
        }
        
        element.classList.add(css);
    }

    function changeColor(colorClass) {
        var element = document.body;
        // Remove all existing color classes
        element.classList.remove('blue', 'mocha', 'night-sky', 'sunrise-sunset');
        // Add the selected color class
        element.classList.add(colorClass);
        upCss(colorClass);
        console.log(colorClass);
    }
</script>