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


$sendLike = false;


$response = array("error" => FALSE);


$uid = cleans($_REQUEST['uid']);
$msgID = (int)cleans($_REQUEST['msgID']);


$user = $db->rawQuery("SELECT memberID, username, picture FROM members WHERE uid = '$uid'");


if (!$user) {

    $response['error'] = TRUE;
    echo json_encode($response);

    die();
}

$name = $user['0']['username'];


$dp = $user['0']['picture'];

$memID = $user['0']['memberID'];


$post = $db->rawQuery("SELECT likes, likedBy, post FROM groupPosts WHERE id = $msgID");


$likes = (int)$post['0']['likes'];

$likedBy = $post['0']['likedBy'];

$post = $post['0']['post'];

$likeArr = json_decode($likedBy);


if (in_array($memID, $likeArr)) {
    $likeArr = array_diff($likeArr, array($memID));
    if ($likes >= 0)
        $likes--;

    $response['liked'] = FALSE;

} else {

    $likeArr[] = $memID;
    $likes++;


    $response['liked'] = TRUE;

    $sendLike = true;
}


$likedJson = json_encode(array_values($likeArr));


$likes = (string)$likes;


$query = $db->rawQuery("UPDATE groupPosts SET likes = '$likes', likedBy = '$likedJson'  WHERE id = $msgID");


echo json_encode($response);

if ($sendLike) {


    $notifyMessage = $name . " liked your post: " . truncate($post, 50, "...");

    $topic = "/topics/COMMENT." . $msgID;


    sendFCM($notifyMessage, "NSUer", $topic, "newsfeed");


}


?>