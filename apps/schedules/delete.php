<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';


//error_reporting(E_ALL);

function cleans($str)
{

    $file = str_replace(array('\\', '/', '%', '..', '=', '\'', '"'), ' ', $str);

    return $file;

}


$response = array("error" => FALSE);

$uid = cleans($_REQUEST['uid']);
$scheduleID = (int)cleans($_REQUEST['scheduleID']);


$user = $db->rawQuery("SELECT memberID FROM members WHERE uid = '$uid'");


if (!$user) {

    $response['error'] = TRUE;
    echo json_encode($response);

    die();

}


$memID = $user['0']['memberID'];


$post = $db->rawQuery("SELECT mi, id FROM schedules WHERE id = $scheduleID");

$postMemID = (int)$post['0']['mi'];


if ($postMemID == $memID) {
    $delete = $db->rawQuery("DELETE FROM schedules WHERE  mi = $memID AND id = $scheduleID");


} else {

    $response['error'] = TRUE;

}

echo json_encode($response);


?>