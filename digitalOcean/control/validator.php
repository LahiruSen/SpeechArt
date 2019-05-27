<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 4/26/2019
 * Time: 5:54 PM
 */

/* user

first_name
last_name
email

*/

function name_validator($val)
{

    if(isset($val)) {


        if (strlen($val) == 0) {
            return "Can't be empty!";
        } else {

            if (preg_match("/^([a-zA-Z' ]+)$/", $val)) {
                return "Y";
            } else {
                return "This is not a valid name!";
            }
        }
    } else
    {
        return "This input did not receive!";
    }

}

function email_validator($val)
{
    if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format";
    }
    else{
        return "Y";
    }


}



function password_matching_validator($pass,$cpass)
{
    if($pass == $cpass)
    {

        return "Y";
    }
    else
    {
        return "Password should be matched";

    }

}



function password_character_matching_validator($pass)
{
    if(strlen($pass)>=8)
    {

        return "Y";
    }
    else
    {
        return "Password should have at least 8 character";

    }

}



?>