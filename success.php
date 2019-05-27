<?php
/* Displays all successful messages */
if (session_status() == PHP_SESSION_NONE) {    session_start();}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>Success</title>
    <?php include 'css/css.html'; ?>
</head>
<body>
<div class="form">
    <div class="text-center jumbotron bg-white">
        <h1><?= 'Success'; ?></h1>
        <h5 class="text-success">
            <?php
            if( isset($_SESSION['message']) ){

                echo $_SESSION['message'];
                unset($_SESSION['message']);
         }
            else {
                header("location: index.php");
            }
            ?>
        </h5>
    </div>

    <?php
    if(isset($_GET['filename'])){
        $path = $_GET['filename'].".html";
        ?>
        <form action="control/combine.php" method="post">
            <input type="hidden" name="fileLink" value="<?php echo $path ?>">
            <button type="submit" class="button button-block">View Results</button>

        </form>

    <?php

       // echo "<a href=".$path." id=\"back_btn\"><button class=\"button button-block\">View Results</button></a>";
        echo "<br>";
    }

    ?>

    <a href="index.php"><button class="button button-block">Home</button></a>


    <div class="m-4">
<!--        <a href="view/app.php" id="back_btn"><button class="button button-block">Back</button></a>-->
        <a  id="back_btn"><button class="button button-block" onclick="goBack()">Back</button></a>
    </div>

</div>




<!-- Bootstrap core JavaScript -->
<script src="js/jquery.min.js"></script>
<script src="js/moment.min.js"></script>
<script type="text/javascript" src="js/tempusdominus-bootstrap-4.min.js"></script>

<script src="js/bootstrap.bundle.min.js"></script>

<!-- Plugin JavaScript -->
<script src="js/jquery.easing.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>

<!-- Contact Form JavaScript -->
<script src="js/jqBootstrapValidation.min.js"></script>

<script src="js/contact_me.js"></script>
<!-- Custom scripts for this template -->
<script src="js/freelancer.js"></script>


<!--<script type="text/javascript">-->
<!--    $("#back_btn").on('click',function (e) {-->
<!---->
<!--        window.history.back();-->
<!--    })-->
<!--</script>-->


<script>
    function goBack() {
        window.history.back();
    }
</script>
</body>
</html>
