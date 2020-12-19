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
        $searchTermBits[] = "members.memberID=groupPosts.memID AND course = '$term'";
    }
}


//$data = $db->rawQuery("SELECT * FROM groupPosts WHERE ".implode(' OR ', $searchTermBits)." ORDER BY time DESC");


$data = $db->rawQuery("SELECT members.username, members.email, members.memberID, members.gender, members.picture, groupPosts.course, groupPosts.post, groupPosts.time FROM members, groupPosts WHERE " . implode(' OR ', $searchTermBits) . " ORDER BY time DESC LIMIT 20");

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


?>