<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';

error_reporting(E_ALL);

function cleans($str)
{

    $file = str_replace(array('\\', '/', '%', '..', '=', '\'', '"'), ' ', $str);

    return $file;

}


$response = array("error" => FALSE);


$uid = cleans($_REQUEST['uid']);

$to = cleans($_REQUEST['to']);


$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
$message = mysqli_real_escape_string($con, $_REQUEST['message']);


// $user = $db->rawQuery("SELECT memberID, username, picture FROM members WHERE uid = '$uid'");

$user = $db->rawQuery("SELECT memberID, username, picture FROM members WHERE memberID = '7'");


if (!$user || empty($message)) {

    $response['error'] = TRUE;
    echo json_encode($response);

    die();
}


$from_id = $user['0']['memberID'];
$from_name = $user['0']['username'];
$from_image = $user['0']['picture'];


$time = time();
$data = array(
    'f' => $from_id,
    't' => $to,
    'm' => $message,
    'tm' => $time,
);


$query = $db->insert('chat', $data);


if (!$query) {
    $response['error'] = TRUE;
    echo json_encode($response);
} else {


    $response['id'] = $query;
    echo json_encode($response);


    fastcgi_finish_request();


    $notifyMessage = $from_name . " sent you a message on NSUer App";

    $topic = "'USER." . $to . "' in topics";


    $data = array(
        "body" => $_REQUEST['message'],
        "title" => "NSUer App",
        "icon" => "ic_status_icon",
        "sound" => "default",
        "click_action" => ".MainActivity",
        "type" => "message",
        "senderMemID" => $from_id,
        "typeExtra" => $from_name,
        "typeExtra2" => $query,
        "typeExtra3" => $notifyMessage,
        "typeExtra4" => $time
    );


    $notification = array(
        "click_action" => ".MainActivity",
        "body" => $notifyMessage,
        "title" => "NSUer App",
        "icon" => "ic_status_icon"
    );


    sendFCMdataTopicChat($topic, $data, $notification);


}
?>