<?php


$time_start = microtime(true);
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';


function cleans($str)
{

    $file = str_replace(array('\\', '/', '%', '..', '\'', '"'), ' ', $str);

    return $file;

}


$data = $db->rawQuery("SELECT members.username, members.memberID, members.gender, members.picture, blood_donors.bgroup, blood_donors.phone, blood_donors.address FROM members, blood_donors WHERE members.memberID=blood_donors.memID ORDER by members.username");


print_r($data);

$c = 0;
foreach ($data as $arr) {

    if ($arr['picture'] == null) {

        $data[$c]['picture'] = "0";

    }

    $c++;
}


$arr = array();

$arr['dataArray'] = $data;


echo json_encode($arr);

//echo 'Total execution time in seconds: ' . (microtime(true) - $time_start);

?>