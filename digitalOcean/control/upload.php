
<?php
require '../model/db.php';
/* Displays user information and some useful messages */
if (session_status() == PHP_SESSION_NONE) {    session_start();}

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
    $_SESSION['message'] = "You must log in before viewing this page!";
    header("location: ../error.php");
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $user_id = $_SESSION['user_id'];

    $target_dir = "../uploads/";
    $basename =  basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $FileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
//    $newfilename = round(microtime(true)) . '.' . end($user_id);
// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        if($basename!=""){
        $uploadOk = 1;
// Check file size
        if ($_FILES["fileToUpload"]["size"] > 50000000) {
            $uploadOk = 0;
            $_SESSION['message'] = "Sorry, your file is too large.";
            header("location: ../error.php");
            die();

        }
// Allow certain file formats
        if ( $FileType != "txt" ) {
            $uploadOk = 0;

            $_SESSION['message'] = "Sorry, only TEXT files are allowed.";
            header("location: ../error.php");
            die();
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {

            $_SESSION['message'] = "Sorry. Your file could not be uploaded";
            header("location: ../error.php");
            die();
// if everything is ok, try to upload file
        } else {


            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {


                $sql = "INSERT INTO uploads (userId, location) "
                    . "VALUES ('$user_id','$target_file')";

                if ($mysqli->query($sql)) {

                    $_SESSION['message'] = "Your file is uploaded successfully";
                    header("location: ../success.php");
                    $uploadOk = 1;
                    die();

                } else {
                    $_SESSION['message'] = "Sorry. Your file could not be uploaded";
                    header("location: ../error.php");
                    die();
                }

            }

    }
// Check if file already exists


}

    else{
        $_SESSION['message'] = "Please select a text file to upload.";
        header("location: ../error.php");
        die();



    }
    }
    }
?>

<script src="../js/app.js"></script>
