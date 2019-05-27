<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 5/26/2019
 * Time: 11:15 PM
 */

if (isset($_POST['fileLink'])) {
    $link = $_POST['fileLink'];
    readfile('../view/result.html');
    readfile("../LDA_visualizations/".$link);

}
else{
    $_SESSION['message'] = "Invalid Request";
    header("location: ../error.php");
    die();
}