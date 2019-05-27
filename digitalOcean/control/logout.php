<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 4/26/2019
 * Time: 8:58 PM
 */

session_start();
session_destroy();
header('Location: ../index.php');
exit;

?>