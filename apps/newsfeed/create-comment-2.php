<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';

//error_reporting(E_ALL);

function cleans($str)
{

    $file = str_replace(array('\\', '/', '%', '..', '=', '\'', '"'), ' ', $str);

    return $file;

}


$response = array("error" => FALSE);


$uid = cleans($_REQUEST['uid']);
$msgID = cleans($_REQUEST['msgID']);


$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
$comment = mysqli_real_escape_string($con, $_REQUEST['comment']);


$user = $db->rawQuery("SELECT memberID, username FROM members WHERE uid = '$uid'");


if (!$user || empty($comment)) {

    $response['error'] = TRUE;
    echo json_encode($response);

    die();
}


$memID = $user['0']['memberID'];
$user = $user['0']['username'];


$data = array(
    'memID' => $memID,
    'msgID' => $msgID,
    'comment' => $comment,
    'commentTime' => time(),
);


$query = $db->insert('groupComments', $data);

if (!$query) {
    $response['error'] = TRUE;
    echo json_encode($response);
} else {


    $response['id'] = $query;
    echo json_encode($response);


    $commentors = $db->rawQuery("SELECT groupComments.memID FROM groupComments WHERE groupComments.msgID = $msgID LIMIT 30");


    $post = $db->rawQuery("SELECT comments FROM groupPosts WHERE id = $msgID");


    $comments = (int)$post['0']['comments'];

    $comments++;

    $query = $db->rawQuery("UPDATE groupPosts SET comments = '$comments' WHERE id = $msgID");


    $notifyMessage = $user . " commented on a post you are following";

    // $topic = "'USER.20' in topics";

    $topic = "/topics/COMMENT." . $msgID;

    $data = array(
        "body" => $notifyMessage,
        "title" => $title,
        "icon" => "ic_status_icon",
        "sound" => "default",
        "senderMemID" => $memID,

        "type" => "comment",
        "typeExtra" => $msgID,
        "typeExtra2" => $msgID

    );


    sendFCMdataCon($topic, $data);


}
?>