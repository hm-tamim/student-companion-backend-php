<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';


function cleans($str)
{

    $file = str_replace(array('\\', '/', '%', '..', '\'', '"'), ' ', $str);

    return $file;

}


function parseString($string)
{
    $string = str_replace("\\b", "\b", $string);
    $string = str_replace("\\t", "\t", $string);
    $string = str_replace("\\n", "\n", $string);
    $string = str_replace("\\f", "\f", $string);
    $string = str_replace("\\r", "\r", $string);
    $string = str_replace("\\u", "\u", $string);
    return $string;
}


function cb($content)
{

    if (!mb_check_encoding($content, 'UTF-8')
        OR !($content === mb_convert_encoding(mb_convert_encoding($content, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32'))) {

        $content = mb_convert_encoding($content, 'UTF-8');

    }
    return $content;
}

$course = cleans($_REQUEST['course']);


if (empty($course)) {
    echo '{"dataArray":[]}';
    die();

}


$searchTerms = explode(',', $course);
$searchTermBits = array();
foreach ($searchTerms as $term) {
    $term = trim($term);
    if (!empty($term)) {
        $searchTermBits[] = "members.memberID=groupPosts.memID AND course = '$term'";
    }
}


//$data = $db->rawQuery("SELECT * FROM groupPosts WHERE ".implode(' OR ', $searchTermBits)." ORDER BY time DESC");


$data = $db->rawQuery("SELECT members.username, members.memberID, members.gender, members.picture, groupPosts.id, groupPosts.course, groupPosts.post, groupPosts.time, groupPosts.likes, groupPosts.comments, groupPosts.likedBy FROM members, groupPosts WHERE " . implode(' OR ', $searchTermBits) . " ORDER BY time DESC LIMIT 20");


$c = 0;
foreach ($data as $arr) {


    // $data[$c]['post'] = parseString($data[$c]['post']);

    if ($arr['picture'] == null) {

        $data[$c]['picture'] = "0";

    }

    if ($arr['likedBy'] == null) {

        $data[$c]['likedBy'] = "[]";

    }


    $c++;
}

$arr = array();

$arr['dataArray'] = $data;


echo json_encode($arr, JSON_UNESCAPED_UNICODE);


?>