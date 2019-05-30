<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 5/28/2019
 * Time: 10:10 AM
 */

use PHPUnit\Framework\TestCase;

class dbTest extends TestCase
{
    public function testWriteFileLocationToDb(){

        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $db = 'speechart_mock';

        $mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);

        $user_id = 1;
        $target_file = "Dummy Directory";
        $sql = "INSERT INTO uploads (userId, location) ". "VALUES ('$user_id','$target_file')";

        $this->assertTrue($mysqli->query($sql),"Directory Write Fails.");

        $email = "lahiru@gmail.com";
        $password = "123456789";
        $result = $mysqli->query("SELECT * FROM users WHERE email='$email'");

        $user = $result->fetch_assoc();
        $result->free();

        $this->assertTrue(password_verify($password, $user['password']),"Password Verification Fails.");
    }






}
