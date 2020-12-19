<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';


function cleans($str)
{

    $file = str_replace(array('\\', '/', '%', '..', '\'', '"'), ' ', $str);

    return $file;

}

$uid = cleans($_REQUEST['uid']);


$user = $db->rawQuery("SELECT uid FROM subscription WHERE uid = '$uid'");

$user2 = $db->rawQuery("SELECT uid FROM subscriptionTemp WHERE uid = '$uid'");

if ($user || $user2) {
    ?>

    {
    "version": "2.7",
    "msg": "You are not using the latest version. Kindly update the app to run it smoothly.",
    "isPremium": "true",
    "closeMainActivity": "false",
    "expire": "true",
    "showMembershipDialog": true,
    "advisingTools": true

    }

    <?php

} else {

    ?>

    {
    "version": "2.7",
    "msg": "You are not using the latest version. Kindly update the app to run it smoothly.",
    "isPremium": "false",
    "closeMainActivity": "false",
    "expire": "true",
    "showMembershipDialog": true,
    "advisingTools": true

    }

    <?php

}

?>
  

