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


$memID = cleans($_REQUEST['memID']);


$data = $db->rawQuery("SELECT schedules.* FROM schedules WHERE schedules.mi = '$memID' ORDER BY d DESC LIMIT 300");


$arr = array();

$arr['dataArray'] = $data;


echo stripslashes(json_encode($arr, JSON_UNESCAPED_UNICODE));

?>