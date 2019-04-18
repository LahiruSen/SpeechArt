<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 4/17/2019
 * Time: 9:01 AM
 */


//    ; $text = "LAhiru";
////    var_dump($text);
////    die();
//    $cmd = "python test.py".$text;
//        shell_exec($cmd)


    $start_word = "Lahiru";
    $end_word = "Senevirathne";
//    $output = shell_exec("python test.py ".$start_word." ".$end_word);
//    $output = passthru("python test.py ");
//    var_dump("dg");
//    die();
//    echo $output;

  $output =   exec("../test.py Lahiru Senevirathne");
  var_dump($output);
  die();


?>