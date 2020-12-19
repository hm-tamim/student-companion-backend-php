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

if (empty($memID))
    $data = $db->rawQuery("SELECT * FROM  blood_requests ORDER BY date DESC LIMIT 50");
else
    $data = $db->rawQuery("SELECT * FROM  blood_requests WHERE memID = $memID ORDER BY date DESC LIMIT 50");


$arr = array();

$arr['dataArray'] = $data;


echo stripslashes(json_encode($arr, JSON_UNESCAPED_UNICODE));

?>