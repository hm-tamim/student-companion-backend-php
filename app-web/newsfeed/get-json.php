<?php


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


$data = $db->rawQuery("SELECT * FROM groupPosts WHERE " . implode(' OR ', $searchTermBits) . " ORDER BY time DESC");

$arr = array();

$arr['dataArray'] = $data;


echo json_encode($arr);


?>