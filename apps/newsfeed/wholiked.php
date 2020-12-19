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

$msgID = (int)cleans($_REQUEST['msgID']);


$post = $db->rawQuery("SELECT likedBy FROM groupPosts WHERE id = $msgID");


if ($post) {

    $likedBy = $post['0']['likedBy'];


    $likeArr = json_decode($likedBy);

    if (sizeof($likeArr) > 0) {


        $searchTerms = $likeArr;
        $searchTermBits = array();
        foreach ($searchTerms as $term) {
            $term = trim($term);
            if (!empty($term)) {
                $searchTermBits[] = "memberID= '$term'";
            }
        }


        $data = $db->rawQuery("SELECT members.username, members.memberID, members.gender, members.picture,  members.dept, members.email FROM members  WHERE " . implode(' OR ', $searchTermBits));

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


    } else {

        echo '{"dataArray":[]}';

    }


} else {

    echo '{"dataArray":[]}';

}


?>