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


$user = $db->rawQuery("SELECT memberID FROM members WHERE uid = '$uid' LIMIT 1");


if (!$user) {

    echo '{"error":true,"msg":"Error occured, try again."}';
    die();
}


$si = $user['0']['memberID'];

//if($si == 20)
//$data = $db->rawQuery("SELECT * FROM shop ORDER BY tm DESC LIMIT 1000");
//else
$data = $db->rawQuery("SELECT * FROM shop WHERE si = '$si' ORDER BY tm DESC LIMIT 100");


$arr = array();

$arr['dataArray'] = $data;


echo stripslashes(json_encode($arr, JSON_UNESCAPED_UNICODE));

?>