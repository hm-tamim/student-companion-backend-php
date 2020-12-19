<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';


function cleans($str)
{

    $file = str_replace(array('\\', '/', '%', '..', '=', '\'', '"'), ' ', $str);

    return $file;

}


$response = array("error" => FALSE);


$uid = cleans($_REQUEST['uid']);
$course = strtoupper(cleans($_REQUEST['course']));


$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
$post = mysqli_real_escape_string($con, $_REQUEST['post']);


$user = $db->rawQuery("SELECT memberID, username FROM members WHERE uid = '$uid'");


if (!$user || empty($post)) {

    $response['error'] = TRUE;
    echo json_encode($response);

    die();
}

//   $name = $user['0']['username'];

//   $gender = $user['0']['gender'];

//   $dp = $user['0']['picture'];

$memID = $user['0']['memberID'];
$user = $user['0']['username'];


$data = array(
    'memID' => $memID,
    'course' => $course,
    'post' => $post,
    'time' => time(),
);


$query = $db->insert('groupPosts', $data);

if (!$query) {
    $response['error'] = TRUE;
    echo json_encode($response);
} else {


    $response['id'] = $query;
    echo json_encode($response);

    $notifyMessage = $user . ": " . truncate($post, 80, "...");

    $topic = "/topics/" . $course;


    $data = array(
        "body" => $notifyMessage,
        "title" => $title,
        "icon" => "ic_status_icon",
        "sound" => "default",
        "senderMemID" => $memID,

        "type" => "like",
        "typeExtra" => $query,
        "typeExtra2" => $query

    );


    sendFCMdata($topic, $data);


}
?>