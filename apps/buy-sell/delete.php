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
$msgID = (int)cleans($_REQUEST['msgID']);


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

if ($postMemID == $memID || $memID == 20) {
    $delete = $db->rawQuery("DELETE FROM shop WHERE id = $msgID");


    $loc = $_SERVER['DOCUMENT_ROOT'] . '/images/shop/' . $time . '.jpg';


    unlink($loc);


} else {

    $response['error'] = TRUE;

}

echo json_encode($response);


?>