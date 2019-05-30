<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 5/27/2019
 * Time: 10:55 PM
 */

use PHPUnit\Framework\TestCase;

class uploadFileTest extends TestCase
{
    public function testFileUploadDirectoryExists(){
        $this->assertDirectoryIsReadable('C:\xampp\htdocs\SpeechArt\sampleSpeech' );
    }

    public function testFileIsMovable(){
        $this->assertDirectoryIsWritable('C:\xampp\htdocs\SpeechArt\uploads');
    }



}
