<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';

function seoUrli($str)
{
    $a = array('/(à|á|â|ã|ä|å|æ)/', '/(&amp;)/', '/(è|é|ê|ë)/', '/(ì|í|î|ï)/', '/(ð|ò|ó|ô|õ|ö|ø|œ)/', '/(ù|ú|û|ü)/', '/ç/', '/þ/', '/ñ/', '/ß/', '/(ý|ÿ)/', '/(=|\+|\/|\%0d|\\n|\\\|\.|\'|\"|\quot|\[|\]|\{|\}|\||\,|\;|\­|\_|↩|\^|\!|\|\:|\&|\\n|\#|\/|\?| |\(|\))/', '//s', '/-{2,}/s');
    $b = array('a', 'and', 'e', 'i', 'o', 'u', 'c', 'd', 'n', 'ss', 'y', '-', '', '-');
    $c = trim(preg_replace($a, $b, $str), '-');
    $d = preg_replace('/-{2,}/', '-', $c);
    $ee = str_replace(array("\r", "\n"), '', $d);
    $e = trim($ee, ' ');
    $f = preg_replace('/ {2,}/', '-', $e);

    $fg = trim(preg_replace('/-+/', '-', $f), '-');
    return trim($fg, '-');
}


error_reporting(E_ALL);

function cleans($str)
{

    $file = str_replace(array('\\', '/', '%', '..', '\'', '"'), ' ', $str);

    return $file;

}


function getBloodGroup($id)
{

    if ($id == 0)
        return "AB+";
    else if ($id == 1)
        return "AB-";
    else if ($id == 2)
        return "A+";
    else if ($id == 3)
        return "A-";
    else if ($id == 4)
        return "B+";
    else if ($id == 5)
        return "B-";
    else if ($id == 6)
        return "O+";
    else if ($id == 7)
        return "O-";
    else
        return "B+";
}


$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// $msgID = cleans($_REQUEST['msgID']);


$bloodGroup = cleans($_REQUEST['bgroup']);
$bags = cleans($_REQUEST['bags']);
$whenNeeded = cleans($_REQUEST['whenNeeded']);
$isEdit = cleans($_REQUEST['isEdit']);
$msgID = cleans($_REQUEST['msgID']);


$phone = mysqli_real_escape_string($con, $_REQUEST['phone']);
$address = mysqli_real_escape_string($con, $_REQUEST['address']);

$note = mysqli_real_escape_string($con, $_REQUEST['note']);

$uid = cleans($_REQUEST['uid']);


$user = $db->rawQuery("SELECT memberID, username FROM members WHERE uid = '$uid' LIMIT 1");

$username = $user['0']['username'];
$memberID = $user['0']['memberID'];


$time = time();


$data = array(
    'memID' => $memberID,
    'name' => $username,
    'bgroup' => $bloodGroup,
    'whenDate' => $whenNeeded,
    'bags' => $bags,
    'date' => time(),
    'phone' => $phone,
    'address' => $address,
    'note' => $note,
    'isManaged' => 0
);


if ($isEdit == "false") {

    $query = $db->insert('blood_requests', $data);

    if ($query) {
        echo '{"error":false,"msg":"' . $time . '"}';

        if ($bags == 1)
            $bagText = "Bag";
        else
            $bagText = "Bags";


        $groupName = getBloodGroup($bloodGroup);


        $desc = "";

        if (!empty($note)) {

            $desc = "

Note: " . stripslashes($note);
        }

        $notifyMessage = $bags . " " . $bagText . " (" . $groupName . ") Blood Needed at " . $address . $desc;

        $topic = "/topics/BLOOD." . $bloodGroup;

        $title = "NSUer App - Blood Bank";


        $dataa = array(
            "body" => $notifyMessage,
            "title" => $title,
            "icon" => "ic_status_icon",
            "sound" => "default",
            "senderMemID" => $memberID,
            "type" => "blood",
            "typeExtra" => $query,
            "typeExtra2" => $query

        );

        sendFCMdata($topic, $dataa);


    } else
        echo '{"error":true,"msg":"Error occured, try again."}';


} else {


    $post = $db->rawQuery("SELECT memID FROM blood_requests WHERE id = $msgID");

    $postMemID = (int)$post['0']['memID'];

    if ($postMemID == $memberID) {


        $update = $db->rawQuery("UPDATE blood_requests SET bgroup = $bloodGroup, bags = '$bags', whenDate = $whenNeeded,  phone = '$phone', address = '$address', note = '$note' WHERE id = $msgID");


        echo '{"error":false,"msg":"' . $time . '"}';


    } else {

        echo '{"error":true,"msg":"Error occured, try again."}';

    }


}
?>