<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 5/28/2019
 * Time: 9:50 AM
 */

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'speechart_mock';

$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);