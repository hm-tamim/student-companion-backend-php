<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';


function cleans($str)
{

    $file = str_replace(array('\\', '/', '%', '..'), ' ', $str);

    return $file;


}

$uid = cleans($_REQUEST['uid']);
$course = cleans($_REQUEST['course']);


$user = $db->rawQuery("SELECT memberID FROM members WHERE uid = '$uid'");


if (!$user) {

    $response['error'] = TRUE;
    echo json_encode($response);

    die();
}

$memID = $user['0']['memberID'];


$update = $db->rawQuery("DELETE FROM classMate WHERE course = '$course' AND memID='$memID'");


echo '{"error":false,"msg":"Course deleted!"}';

?>