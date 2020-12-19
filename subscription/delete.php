<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';


echo 'hm';
include('connect-db.php');


if (isset($_GET['id']) && is_numeric($_GET['id'])) {


    $id = $_GET['id'];
    $memID = $_REQUEST['memID'];
    $name = $_REQUEST['name'];


    $result = mysql_query("DELETE FROM subscriptionTemp WHERE id=$id")

    or die(mysql_error());


    echo 'done';


    $notifyMessage = "Dear " . ucwords($name) . ", your membership subscription payment couldn't be verified. Please submit your TrxID or the bKash number again. Contact at nsuer.app@gmail.com if you face any further issue.";

    $topic = "/topics/USER." . $memID;


    $data = array(
        "body" => $notifyMessage,
        "title" => $title,
        "icon" => "ic_status_icon",
        "sound" => "default",
        "senderMemID" => "65656",
        "type" => "alert",
        "typeExtra" => $notifyMessage,
        "typeExtra2" => ""

    );


    sendFCMdata($topic, $data);


} else {

    header("Location: /cke");

}


?>