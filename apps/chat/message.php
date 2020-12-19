<?php
// $time_start = microtime(true);

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';


error_reporting(E_ALL);

function cleans($str)
{

    $file = str_replace(array('\\', '/', '%', '..'), ' ', $str);

    return $file;

}

$uid = cleans($_REQUEST['uid']);

$otherMemID = cleans($_REQUEST['otherMemID']);


$chatStartID = cleans($_REQUEST['chatStartID']);


$user = $db->rawQuery("SELECT memberID FROM members WHERE uid = '$uid' LIMIT 1");


if (!$user) {

    echo '{"error":true,"msg":"Error occured, try again."}';
    die();
}


$memID = $user['0']['memberID'];


$data = $db->rawQuery("SELECT * FROM chat WHERE ((f = '$memID' AND t = '$otherMemID') OR (t = '$memID' AND f = '$otherMemID')) AND  id>$chatStartID ORDER BY id ASC LIMIT 2000");


$userData = $db->rawQuery("SELECT members.username, members.memberID, members.gender, members.picture FROM members WHERE members.memberID = '$otherMemID'");


$user = array();

$user['username'] = $userData['0']['username'];
$user['gender'] = $userData['0']['gender'];
$user['picture'] = $userData['0']['picture'];
$user['memberID'] = $userData['0']['memberID'];


$arr['user'] = $user;
$arr['messages'] = $data;


echo stripslashes(json_encode($arr, JSON_UNESCAPED_UNICODE));

?>