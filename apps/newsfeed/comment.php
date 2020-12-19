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


$data = $db->rawQuery("SELECT members.username, members.memberID, members.gender, members.picture, groupComments.id, groupComments.memID, groupComments.comment, groupComments.commentTime FROM members, groupComments WHERE groupComments.msgID = $msgID AND members.memberID = groupComments.memID ORDER BY commentTime LIMIT 30");

$c = 0;
foreach ($data as $arr) {

    if ($arr['picture'] == null) {

        $data[$c]['picture'] = "0";

    }

    $c++;
}

$arr = array();

$arr['dataArray'] = $data;


echo stripslashes(json_encode($arr, JSON_UNESCAPED_UNICODE));

//echo 'Total execution time in seconds: ' . (microtime(true) - $time_start);

?>