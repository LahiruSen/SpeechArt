<?php

$host = 'localhost';
$user = 'phpmyadmin';
$pass = 'digitalDh@2415698';
$db = 'speechart';

$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);