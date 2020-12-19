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
        $searchTermBits[] = "members.memberID=classMate.memID AND course = '$term'";
    }
}


//$data = $db->rawQuery("SELECT members.username, members.memberID FROM members, classMate WHERE members.memberID=classMate.memID AND ".implode(' OR ', $searchTermBits));


//  $data = $db->rawQuery("SELECT * FROM classMate WHERE ".implode(' OR ', $searchTermBits).", members WHERE members.memberID=classMate.memID");


$data = $db->rawQuery("SELECT members.username, members.email, members.memberID, members.gender, members.picture,  members.dept, classMate.course FROM members, classMate WHERE " . implode(' OR ', $searchTermBits) . " ORDER by members.username");


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