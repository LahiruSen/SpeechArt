<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 5/28/2019
 * Time: 10:55 PM
 */
use PHPUnit\Framework\TestCase;


    class UserLoginUI extends TestCase
{
        public function setUp()
    {
        $this->setHost('localhost');
        $this->setPort(4444);
        $this->setBrowserUrl('http://localhost/speechart/');
        $this->setBrowser('firefox');
    }

    public function tearDown()
    {
        $this->stop();
    }

    public function testFormSubmissionWithUsername()
    {
        $this->byName('email')->value('lahiru@gmail.com');
        $this->byName('password')->value('123456789');
        $this->byId('loginButtonId')->submit();
        $content = $this->byXpath('/html/body/h1')->text();
//        $content = $this->by('body')->text();
        $this->assertEquals('Welcome to SpeechArt', $content);
    }

//        $this->byName('username')->value('younesrafie');
//        $this->byId('subscriptionForm')->submit();

}
