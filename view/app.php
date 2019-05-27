<?php
/* Main page with two forms: sign up and log in */
require '..\model\db.php';
if (session_status() == PHP_SESSION_NONE) {    session_start();}

if ( $_SESSION['logged_in'] != 1 ) {
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: ../error.php");
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $user_id = $_SESSION['user_id'];
}

?>


<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Speech Recognition</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/app.css">
    <script src="../js/bootstrap.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Shadows+Into+Light" rel="stylesheet">
    <!-- load font awesome here for recordIcon used on the page -->
</head>
<body>

<h1 align="center"> Welcome to SpeechArt </h1>

<div class="container">
    <h3>Logged in as :<?php echo $first_name ?></h3><a href="../control/logout.php" type="button" class="btn btn-primary btn-block">Logout</a>
<form class="container" action="app.php" method="post"> <!--page container -->
    <strong> Your speech will be displayed here...</strong>
    <div>
    <div id="inputText" name="inputText" class="text-box" contenteditable="true" type="text" value="Type here"  style=" max-height: 100%; max-width: 100%; background-color: rgba(0,0,255,.1)">

        <?php






            if ($_SERVER['REQUEST_METHOD'] == 'POST') {




                if(isset($_POST['location'])){
            $location = $_POST['location'];
                $contents =  file_get_contents($location);
                $contents1 = str_replace("\""," ",$contents);
                $contents1 = str_replace("\'"," ",$contents1);
                echo $contents1;
                echo "<br><br>";


                }

                else if(isset($_POST['contents'])){
                    if (($_POST['contents']=="-1") & ($_POST['voiceText']=="not")){

                        $_SESSION['message'] = "Please Input Contents to Identify the Topic";
                        header("location: ../error.php");
                        die();}



                    else{
                        if ($_POST['voiceText'] == "not"){

                            $newContent = $_POST['contents'];
                            $newContent = trim(preg_replace('/\s+/', ' ', $newContent));
                            $newContent = '"' . $newContent . '"';
                        }
                        else{
                            $newContent = $_POST['voiceText'];
                            $newContent = trim(preg_replace('/\s+/', ' ', $newContent));
                            $newContent = '"' . $newContent . '"';
                        }
//                        $output =   exec("C:/xampp/htdocs/SpeechArt/identifyTopic.py ".$newContent);

                        $time = date("D M d, Y G:i");
                        $time = preg_replace("/[^a-zA-Z0-9]+/", "", $time);
                        $unique = '"'.$user_id.$time.'"';
                        $python = "C:/Users/HP/PycharmProjects/CorseEraNLP/venv/Scripts/python.exe";
                        $script = "C:/xampp/htdocs/SpeechArt/model/identifyTopic.py 2>&1";
                        $cmd = "$python $script $newContent $unique";
                        $output =   exec("$cmd",$output1, $return);
                        if ($return==0){
                            $_SESSION['message'] = "Topic Identification was Successful";
                            header("location: ../success.php?filename=".$user_id.$time);
                            die();
                        }
                        else{
                            $_SESSION['message'] = $output.$output1;
                            header("location: ../error.php");
                            die();
                        }

                }}
                else{
                    $_SESSION['message'] = "Please Record or Upload a text file before Identifying the Topic";
                    header("location: ../error.php");
                    die();

                }


            }
            ?>

    <!--text box which will contain spoken text -->
        <!--<i class="fa fa-microphone"></i> &lt;!&ndash; microphone recordIcon to be clicked before speaking &ndash;&gt;-->

    </div>
    <audio class="sound" src="../chime.wav"></audio>
    <!-- sound to be played when we click recordIcon => http://soundbible.com/1598-Electronic-Chime.html -->

    <button  id="recordButton" type="button" class="btn btn-primary btn-block">Record</button>
    <button  id="stopButton" type="button" class="btn btn-primary btn-block">Stop</button>
    <input type="hidden" name="contents" value="<?php if(isset($contents1)){ echo $contents1; }  else{echo "-1";} ?>"><br>
        <input type="hidden" value="not"  name="voiceText" id="voiceText">
        <button id="identifyTopic"  type="submit"  value="Identify Topic" name="submit" class="btn btn-primary btn-block" >Identify Topic</button>


  </form>




        <br>


<!--    <script>-->
<!--        function sendText() {-->
<!--            console.log("http://127.0.0.1:5000/capture?inputText=" + paragraph.textContent);-->
<!--            var url = "http://127.0.0.1:5000/capture?inputText=" + paragraph.textContent-->
<!--            var xmlHttp = new XMLHttpRequest();-->
<!--            xmlHttp.open( "GET", url, true ); // false for synchronous request-->
<!--            xmlHttp.send( null );-->
<!--            console.log(xmlHttp.responseText);-->
<!---->
<!--        }-->
<!--    </script>-->

</form>


    <form action="../control/upload.php" method="post" enctype="multipart/form-data">

        Select text or pdf to upload :<br>
        <input type="file" name="fileToUpload" id="fileToUpload" class="btn btn-primary"> <br> <br>

        <input type="submit" value="Upload File" name="submit" class="btn btn-primary btn-block"> <br>
    </form>

    <button onclick="window.location.href = 'viewUploads.php';" id="displayContent" type="button" class="btn btn-primary btn-block">Display Uploads</button> <br>




</div>
    <script src="../js/app.js"></script>


</body>

</html>







