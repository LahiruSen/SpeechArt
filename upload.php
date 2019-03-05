
<?php
require 'db.php';
/* Displays user information and some useful messages */
if (session_status() == PHP_SESSION_NONE) {    session_start();}

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: error.php");
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $user_id = $_SESSION['user_id'];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
//    $newfilename = round(microtime(true)) . '.' . end($user_id);
// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {

        $uploadOk = 1;
        if (file_exists($target_file)) {
            $uploadOk = 0;
            $_SESSION['message'] = "Sorry, file already exists.";
            header("location: error.php");
            die();
        }
// Check file size
        if ($_FILES["fileToUpload"]["size"] > 50000000) {
            $uploadOk = 0;
            $_SESSION['message'] = "Sorry, your file is too large.";
            header("location: error.php");
            die();

        }
// Allow certain file formats
        if ($imageFileType != "pdf" && $imageFileType != "txt" && $imageFileType != "doc") {
            $uploadOk = 0;

            $_SESSION['message'] = "Sorry, only PDF, DOC, TEXT files are allowed.";
            header("location: error.php");
            die();
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {

            $_SESSION['message'] = "Sorry. Your file could not be uploaded";
            header("location: error.php");
            die();
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {


                $sql = "INSERT INTO uploads (userId, location) "
                    . "VALUES ('$user_id','$target_file')";

                if ($mysqli->query($sql)) {

                    $_SESSION['message'] = "Your file is uploaded successfully";
                    header("location: success.php");
                    $uploadOk = 1;
                    die();

                } else {
                    $_SESSION['message'] = "Sorry. Your file could not be uploaded";
                    header("location: error.php");
                    die();
                }

            }

    }
// Check if file already exists


}}
?>

<script src="app.js"></script>
