<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';


error_reporting(E_ALL);

function cleans($str)
{

    $file = str_replace(array('\\', '/', '%', '..', '\'', '"'), ' ', $str);

    return $file;

}


$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

$phone = mysqli_real_escape_string($con, $_REQUEST['phone']);

if (empty($phone))
    $phone = null;

$address = mysqli_real_escape_string($con, $_REQUEST['address']);

$bgroup = cleans($_REQUEST['bgroup']);


$uid = cleans($_REQUEST['uid']);


$user = $db->rawQuery("SELECT memberID, username FROM members WHERE uid = '$uid' LIMIT 1");

$username = $user['0']['username'];
$memberID = $user['0']['memberID'];


$update = $db->rawQuery("UPDATE members SET bgroup = '$bgroup', phone = '$phone', address = '$address'  WHERE memberID = $memberID");

if ($update)

    echo '{"error":false,"msg":"Success"}';
else {

    echo '{"error":true,"msg":"Error occured, try again."}';

}


?>