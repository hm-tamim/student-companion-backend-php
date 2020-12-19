<?php
/**
 * Created by PhpStorm.
 * User: HM Tamim
 * Date: 7/18/2019
 * Time: 12:18 AM
 */


session_start();


if (isset($_SESSION["user_type"])) {


    if ($_SESSION["user_type"] == "admin")
        $user_type = "admin";
    else {
        $user_type = "chairman";

        $chairmanid = $_SESSION["chair_id"];

    }


} else {

    header('Location: /login.php');

}


header("Access-Control-Allow-Origin: *");