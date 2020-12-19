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

$uid = cleans($_REQUEST['uid']);


$user = $db->rawQuery("SELECT memberID FROM members WHERE uid = '$uid' LIMIT 1");


if (!$user) {

    echo '{"error":true,"msg":"Error occured, try again."}';
    die();
}


$memID = $user['0']['memberID'];


// $data = $db->rawQuery("SELECT * FROM chat WHERE f = '$memID' OR t = '$memID' ORDER BY tm DESC LIMIT 100");

// $data = $db->rawQuery("SELECT * FROM chat WHERE f = '$memID' OR t = '$memID' GROUP BY t,f ORDER BY id DESC LIMIT 100");


$data = $db->rawQuery("SELECT * FROM chat WHERE id IN (SELECT MAX(id) FROM chat WHERE f = '$memID' OR t = '$memID' GROUP BY t,f) ORDER BY id DESC LIMIT 100");


if ($data) {

    $newData = array();

    $memArr = array();


    // $memArr[] = $memID;

    for ($i = 0; $i < sizeof($data); $i++) {

        $to = $data[$i]['t'];
        $from = $data[$i]['f'];

        if ($to == $memID)
            $newMem = $from;
        else
            $newMem = $to;

        if (!in_array($newMem, $memArr)) {
            $memArr[] = $newMem;
            $newData[] = $data[$i];

        }

    }


    $searchTerms = $memArr;
    $searchTermBits = array();
    foreach ($searchTerms as $term) {
        $term = trim($term);
        if (!empty($term)) {
            $searchTermBits[] = "memberID='$term'";
        }
    }


    $userData = $db->rawQuery("SELECT members.username, members.memberID, members.gender, members.picture FROM members WHERE " . implode(' OR ', $searchTermBits));

    $userArr = array();


    for ($i = 0; $i < sizeof($userData); $i++) {

        $userID = $userData[$i]['memberID'];

        $userArr[$userID] = $userData[$i];

    }

    for ($i = 0; $i < sizeof($newData); $i++) {

        $to = $newData[$i]['t'];
        $from = $newData[$i]['f'];


        if ($to == $memID)
            $final = $from;
        else
            $final = $to;

        $newData[$i]['n'] = $userArr[$final]['username'];
        $newData[$i]['ci'] = $userArr[$final]['memberID'];
        $newData[$i]['g'] = $userArr[$final]['gender'];
        $newData[$i]['p'] = $userArr[$final]['picture'];


    }

    $arr = array();

    $arr['dataArray'] = $newData;

//   echo '<pre>';
//   print_r($newData);
//  echo '</pre>';


    echo stripslashes(json_encode($arr, JSON_UNESCAPED_UNICODE));
} else {

    echo '{"error":true,"msg":"Error occured, try again."}';
    die();

}

?>