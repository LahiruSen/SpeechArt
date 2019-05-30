<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'speechart';

$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);