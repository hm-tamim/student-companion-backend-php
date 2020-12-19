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


$start = cleans($_REQUEST['start']);

if (empty($start) || $start == 0)
    $start = 100000;

$loadByCat = cleans($_REQUEST['loadCat']);
$loadBySearch = cleans($_REQUEST['loadSearch']);
$query = cleans($_REQUEST['query']);

$id = cleans($_REQUEST['cat']);


if ($loadByCat == "true") {
    $data = $db->rawQuery("SELECT * FROM shop WHERE c = $id AND id < $start ORDER BY id DESC LIMIT 30");
} else if ($loadBySearch == "true") {


    $data = $db->rawQuery("SELECT * FROM shop WHERE UPPER(t) LIKE UPPER('%$query%') AND id < $start ORDER BY id DESC LIMIT 30");


} else {


    $data = $db->rawQuery("SELECT * FROM shop WHERE id < $start ORDER BY id DESC LIMIT 30");


}

//   for($i = 0; $i < count($data); $i++){

//     //  $data[$i]['t'] = stripslashes($data[$i]['t']);
//     //  $data[$i]['d'] = stripslashes($data[$i]['d']);

//   }

$arr = array();

$arr['dataArray'] = $data;


echo stripslashes(json_encode($arr, JSON_UNESCAPED_UNICODE));

?>