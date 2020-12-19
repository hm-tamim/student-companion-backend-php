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
$date = (int)cleans($_REQUEST['date']);
$reminderDate = (int)cleans($_REQUEST['reminderDate']);
$color = (int)cleans($_REQUEST['color']);
$doReminder = cleans($_REQUEST['doReminder']);


$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

$subject = mysqli_real_escape_string($con, $_REQUEST['subject']);
$type = mysqli_real_escape_string($con, $_REQUEST['type']);
$extraNote = mysqli_real_escape_string($con, $_REQUEST['extraNote']);


$user = $db->rawQuery("SELECT memberID FROM members WHERE uid = '$uid'");


if (!$user) {

    $response['error'] = TRUE;
    echo json_encode($response);

    die();
}

$memID = $user['0']['memberID'];


$data = array(
    'mi' => $memID,
    's' => $subject,
    't' => $type,
    'c' => $color,
    'd' => $date,
    'rd' => $reminderDate,
    'dr' => $doReminder,
    'en' => $extraNote
);


// $isExist = $db->rawQuery("SELECT si, mi FROM schedules WHERE mi = $memID AND si = $scheduleID");

// $creator = $isExist['0']['mi'];

//   if($isExist){

//       // $memID == $creator

//     // $update = $db->rawQuery("UPDATE groupPosts SET post = '$text' WHERE id = $msgID");

//   } else{


$query = $db->insert('schedules', $data);


if ($query)
    echo '{"error":false,"msg":"' . $query . '"}';
else
    echo '{"error":true,"msg":"Error occured, try again."}';


?>