<?php
///**
// * Created by PhpStorm.
// * User: HP
// * Date: 3/5/2019
// * Time: 7:17 PM
// */
//
//
//
//
//
//$_SESSION['email'] = $_POST['email'];
//$_SESSION['first_name'] = $_POST['firstname'];
//$_SESSION['last_name'] = $_POST['lastname'];
//
//
//// Escape all $_POST variables to protect against SQL injections
//$first_name = $mysqli->escape_string($_POST['firstname']);
//$last_name = $mysqli->escape_string($_POST['lastname']);
//$email = $mysqli->escape_string($_POST['email']);
//$password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
//$hash = $mysqli->escape_string( md5( rand(0,1000) ) );
//
//
//
//
//if(strlen($_POST['password']) <8)
//{
//
//    $_SESSION['message'] = 'Password should have at least 8 characters ';
//    header("location: error.php");
//
//}
//// Check if user with that email already exists
//$result = $mysqli->query("SELECT * FROM users WHERE email='$email'") or die($mysqli->error());
//
//// We know user email exists if the rows returned are more than 0
//if ( $result->num_rows > 0 ) {
//
//    $_SESSION['message'] = 'User with this email already exists!';
//    header("location: error.php");
//
//}
//else { // Email doesn't already exist in a database, proceed...
//
//    // active is 0 by DEFAULT (no need to include it here)
//    $sql = "INSERT INTO users (first_name, last_name, email, password, hash,date_of_create,date_of_update) "
//        . "VALUES ('$first_name','$last_name','$email','$password', '$hash','$date_of_create','$date_of_update')";
//
//    // Add user to the database
//    if ( $mysqli->query($sql) ) {
//
//
//        $_SESSION['logged_in'] = true; // So we know the user has logged in
//
//        header("location: index.php");}
//
//
//    else {
//            $_SESSION['message'] = 'Registration failed!';
//            header("location: error.php");
//        }
//
//    }