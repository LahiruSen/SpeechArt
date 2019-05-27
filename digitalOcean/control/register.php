<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 3/5/2019
 * Time: 7:17 PM
 */



require '../model/db.php';

require 'validator.php';
if (session_status() == PHP_SESSION_NONE) {    session_start();}

//Defining validation check and old variable arrays

$old = array();
$validation_result = array();


if(isset($_POST['firstname'])){
    $old['firstname'] = $_POST['firstname'];
    $validation_result[] = array('firstname',name_validator($_POST['firstname']));}
else{
    $validation_result[] = array('firstname',"Please put a valid first name");}


if(isset($_POST['lastname'])){
    $old['lastname'] = $_POST['lastname'];
    $validation_result[] = array('lastname',name_validator($_POST['lastname']));}
else{
    $validation_result[] = array('lastname',"Please put a valid last name");}

if(isset($_POST['email'])){
    $old['email'] = $_POST['email'];
    $validation_result[] = array('email',email_validator($_POST['email']));}
else{
    $validation_result[] = array('email',"Please put a valid email.");}

if(isset($_POST['password'])){
    $old['password'] = $_POST['password'];
    $validation_result[] = array('password',password_character_matching_validator($_POST['password']));}
else{
    $validation_result[] = array('password',"Password is not valid.");}

if(isset($_POST['password1'])){
    $old['password1'] = $_POST['password1'];
    $validation_result[] = array('password1',password_matching_validator($_POST['password'],$_POST['password1']));}
else{
    $validation_result[] = array('password1',"Password doesn't match.");}

$error_counter = 0;
$error_array = array();

for($i=0;$i< sizeof($validation_result);$i++)
{

    if($validation_result[$i][1] != 'Y')
    {
        $error_counter++;
        $error_array[$validation_result[$i][0]] = $validation_result[$i][1];
    }

}



if($error_counter==0) {


    $_SESSION['email'] = $_POST['email'];
    $_SESSION['first_name'] = $_POST['firstname'];
    $_SESSION['last_name'] = $_POST['lastname'];


// Escape all $_POST variables to protect against SQL injections

    $first_name = $mysqli->escape_string($_POST['firstname']);
    $last_name = $mysqli->escape_string($_POST['lastname']);
    $email = $mysqli->escape_string($_POST['email']);
    $password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
    $hash = $mysqli->escape_string(md5(rand(0, 1000)));


    if (strlen($_POST['password']) < 8) {

        $_SESSION['message'] = 'Password should have at least 8 characters ';
        header("location: ../error.php");

    }
// Check if user with that email already exists
    $result = $mysqli->query("SELECT * FROM users WHERE email='$email'") or die($mysqli->error());

// We know user email exists if the rows returned are more than 0
    if ($result->num_rows > 0) {

        $_SESSION['message'] = 'User with this email already exists!';
        header("location: ../error.php");

    } else { // Email doesn't already exist in a database, proceed...

        // active is 0 by DEFAULT (no need to include it here)
        $sql = "INSERT INTO users (first_name, last_name, email, password, hash,date_of_create,date_of_update) "
            . "VALUES ('$first_name','$last_name','$email','$password', '$hash','$date_of_create','$date_of_update')";

        // Add user to the database
        if ($mysqli->query($sql)) {


            $_SESSION['logged_in'] = true; // So we know the user has logged in

            $_SESSION['message'] = 'Registered Successfully. Please login to continue.';
            header("location: ../success.php");

        } else {
            $_SESSION['message'] = 'Registration failed!';
            header("location: ../error.php");
        }

    }


}
else{
    $message = implode( ", ", $error_array );
    $_SESSION['message'] = $message;
    header("location: ../error.php");
}