<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 5/22/2019
 * Time: 1:03 PM
 */

//$HOST = 'http://localhost/SpeechArt/';
$dbhost = 'localhost';
$dbuser = 'phpmyadmin';
$dbpass = 'digitalDh@2415698';
$dbname = 'speechart';
//
//$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);

$link = mysqli_connect($dbhost,$dbuser,$dbpass) or die("Unable to connect to '$dbhost'");

$test_query  = "SHOW TABLES FROM $dbname";

$result = mysqli_query($link, $test_query);

$tblCnt = 0;
while($tbl = mysqli_fetch_array($result)) {
    $tblCnt++;
    #echo $tbl[0]."<br />\n";
}

if (!$tblCnt) {
    echo "There are no tables. \n";
} else {
    echo "There are $tblCnt tables in '$dbname' database.\n";
}