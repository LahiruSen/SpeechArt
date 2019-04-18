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

    $result = $mysqli->query("SELECT * FROM uploads WHERE userId='$user_id'") or die($mysqli->error());
    $records = array();


    if ( $result->num_rows > 0 ) {

        while ($row = $result->fetch_object()) {
            $records[] = $row;
        }
        $result->free();


    }
    else{
        $_SESSION['message'] = 'You have not uploaded files before...';
        header("location: ../error.php");
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
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/app.css">
    <script src="../js/bootstrap.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Shadows+Into+Light" rel="stylesheet">
    <!-- load font awesome here for recordIcon used on the page -->
</head>
<body>

<h1 align="center"> Welcome to SpeechArt </h1>

<div class="container">

    <table id="file_uploads" class="table table-danger">
        <h2> Choose your document to proceed...</h2>

        <tbody>

        <tr>

            <th>Document_Name</th>
            <th>Topic</th>
            <th>Display</th>
        </tr>


        <?php


        foreach ($records as $r) { ?>


        <tr>
            <form action="app.php" method="post">



                <td><?php echo $r->location; ?></td>
                <td><?php echo $r->topic; ?></td>
                <td><input class="btn btn-dark text-light" type="submit" value="display" name="display"></td>
                <td><input type="hidden" value="<?php echo $r->location; ?>" name="location"> </td>


            </form>

        </tr>

        <?php } ?>


</div>
