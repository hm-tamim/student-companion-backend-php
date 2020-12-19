<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';


error_reporting(E_ALL);

function cleans($str)
{

    $file = str_replace(array('\\', '/', '%', '..', '=', '\'', '"'), ' ', $str);

    return $file;

}


$response = array("error" => FALSE);

$uid = cleans($_REQUEST['uid']);
$msgID = (int)cleans($_REQUEST['msgID']);
$sold = cleans($_REQUEST['sold']);


$user = $db->rawQuery("SELECT memberID FROM members WHERE uid = '$uid'");


if (!$user) {

    $response['error'] = TRUE;
    echo json_encode($response);

    die();

}


$memID = $user['0']['memberID'];


$post = $db->rawQuery("SELECT si, tm FROM shop WHERE id = $msgID");

$postMemID = (int)$post['0']['si'];
$time = (int)$post['0']['tm'];

if ($postMemID == $memID) {
    $delete = $db->rawQuery("UPDATE shop SET s = $sold WHERE id = $msgID");


} else {

    $response['error'] = TRUE;

}

echo json_encode($response);


?>