<?php
/* Main page with two forms: sign up and log in */
require 'db.php';
if (session_status() == PHP_SESSION_NONE) {    session_start();}

if ( $_SESSION['logged_in'] != 1 ) {
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: error.php");
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $location = $_POST['location'];

    }



}







?>


<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Speech Recognition</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="app.css">
    <script src="js/bootstrap.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Shadows+Into+Light" rel="stylesheet">
    <!-- load font awesome here for recordIcon used on the page -->
</head>
<body>

<h1 align="center"> Welcome to SpeechArt </h1>

<div class="container">
<form class="container"  action="" method="get"> <!--page container -->
    <strong> Your speech will be displayed here...</strong>
    <div>
    <div id="inputText" name="inputText" class="text-box" contenteditable="true" type="text" value="Type here"  style=" max-height: 100%; max-width: 100%; background-color: rgba(0,0,255,.1)"></div>
    <!--text box which will contain spoken text -->
        <!--<i class="fa fa-microphone"></i> &lt;!&ndash; microphone recordIcon to be clicked before speaking &ndash;&gt;-->

    </div>
    <audio class="sound" src="chime.wav"></audio>
    <!-- sound to be played when we click recordIcon => http://soundbible.com/1598-Electronic-Chime.html -->

    <button  id="recordButton" type="button" class="btn btn-primary btn-block">Record</button>
    <button  id="stopButton" type="button" class="btn btn-primary btn-block">Stop</button>
    <button id="generateArticle" onclick="sendText()" type="button"  value="GenerateArticle" name="submit" class="btn btn-primary btn-block" >Generate Article</button>
        <br>


    <script>
        function sendText() {
            console.log("http://127.0.0.1:5000/capture?inputText=" + paragraph.textContent);
            var url = "http://127.0.0.1:5000/capture?inputText=" + paragraph.textContent
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", url, true ); // false for synchronous request
            xmlHttp.send( null );
            console.log(xmlHttp.responseText);

        }
    </script>

</form>


    <form action="upload.php" method="post" enctype="multipart/form-data">

        Select text or pdf to upload :<br>
        <input type="file" name="fileToUpload" id="fileToUpload" class="btn btn-primary"> <br> <br>

        <input type="submit" value="Upload File" name="submit" class="btn btn-primary btn-block"> <br>
    </form>

    <button onclick="window.location.href = 'viewUploads.php';" id="displayContent" type="button" class="btn btn-primary btn-block">Display Uploads</button> <br>




</div>
    <script src="app.js"></script>

</body>

</html>







