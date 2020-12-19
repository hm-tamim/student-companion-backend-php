<?php


$time_start = microtime(true);
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';


function cleans($str)
{

    $file = str_replace(array('\\', '/', '%', '..'), ' ', $str);

    return $file;

}

$course = cleans($_REQUEST['course']);

$searchTerms = explode(',', $course);
$searchTermBits = array();
foreach ($searchTerms as $term) {
    $term = trim($term);
    if (!empty($term)) {
        $searchTermBits[] = "course = '$term'";
    }
}


$data = $db->rawQuery("SELECT * FROM classMate WHERE " . implode(' OR ', $searchTermBits));

$arr = array();

$arr['dataArray'] = $data;


echo json_encode($arr);


//echo 'Total execution time in seconds: ' . (microtime(true) - $time_start);


?>