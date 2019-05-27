<?php
/* Displays all error messages */
if (session_status() == PHP_SESSION_NONE) {    session_start();
}

/* Main page with two forms: sign up and log in */
require '../model/db.php';

if(isset($_POST['email'])) {
// Escape email to protect against SQL injections
    $email = $mysqli->escape_string($_POST['email']);
    $result = $mysqli->query("SELECT * FROM users WHERE email='$email'");

    if ($result->num_rows == 0) { // User doesn't exist

        $_SESSION['message'] = "User with that email doesn't exist!";
        header("location: ../error.php");
    } else { // User exists
        $user = $result->fetch_assoc();
        $result->free();
        if (password_verify($_POST['password'], $user['password'])) {


            $_SESSION['email'] = $user['email'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['user_id'] = $user['id'];

            // This is how we'll know the user is logged in
            $_SESSION['logged_in'] = true;


            header("location: ../view/app.php");


        } else {
            $_SESSION['message'] = "You have entered wrong password, try again!";
            header("location: ../error.php");
        }
    }
}else{
    header("location: ../index.php");

}
?>