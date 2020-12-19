<?php

ob_start();
session_start();

date_default_timezone_set('Europe/London');


function encryptCookie($value)
{
    $key = 'mynameidtami540AAAppp999tamim888';
    $newvalue = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $value, MCRYPT_MODE_CBC, md5(md5($key))));
    return ($newvalue);
}

function decryptCookie($value)
{
    $key = 'mynameidtami540AAAppp999tamim888';
    $newvalue = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($value), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
    return ($newvalue);
}

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $islogged = 1;

} else {
    $islogged = 0;
}

if (isset($_COOKIE['rememberme2']) && $islogged == 0) {

    $userid = $_COOKIE['rememberme2'];

    require_once($_SERVER['DOCUMENT_ROOT'] . '/user/includes/config.php');


    $user->uidlogin($userid);


//setcookie("rememberme2",$userid,time() + (6*30*24*3600));


    $islogged = 1;

} else {


    $userid = $_REQUEST['uid'];

    require_once($_SERVER['DOCUMENT_ROOT'] . '/user/includes/config.php');


    $user->uidlogin($userid);


}
