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


$course = cleans($_REQUEST['courses']);


if (empty($course)) {
    echo '{"dataArray":[]}';
    die();

}

$searchTerms = explode(',', $course);
$searchTermBits = array();
foreach ($searchTerms as $term) {
    $term = trim($term);
    if (!empty($term)) {
        $searchTermBits[] = "members.memberID=schedules.mi AND s = '$term'";
    }
}


$data = $db->rawQuery("SELECT schedules.*, members.username FROM schedules, members WHERE " . implode(' OR ', $searchTermBits) . "  ORDER BY d DESC LIMIT 300");


$arr = array();

$arr['dataArray'] = $data;


echo stripslashes(json_encode($arr, JSON_UNESCAPED_UNICODE));

?>