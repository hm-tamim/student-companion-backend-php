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


$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
$text = mysqli_real_escape_string($con, $_REQUEST['post']);


$user = $db->rawQuery("SELECT memberID FROM members WHERE uid = '$uid'");


if (!$user || empty($text)) {

    $response['error'] = TRUE;
    echo json_encode($response);

    die();
}


$memID = $user['0']['memberID'];


$post = $db->rawQuery("SELECT memID FROM groupPosts WHERE id = $msgID");

$postMemID = $post['0']['memID'];


if ($postMemID == $memID) {

    $update = $db->rawQuery("UPDATE groupPosts SET post = '$text' WHERE id = $msgID");

} else {

    $response['error'] = TRUE;

}

echo json_encode($response);


?>