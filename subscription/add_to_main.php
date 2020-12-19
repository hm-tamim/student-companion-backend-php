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


function cleans($str)
{

    $file = str_replace(array('\\', '/', '%', '..', '\'', '"'), ' ', $str);

    return $file;

}


$id = $_REQUEST['id'];
$memID = $_REQUEST['memID'];

$name = $_REQUEST['name'];

$uid = $_REQUEST['uid'];


$query = $db->rawQuery("SELECT * FROM subscriptionTemp WHERE id=" . $id);


$data = array(
    'uid' => $query[0]['uid'],
    'payment_type' => $query[0]['payment_type'],
    'account_type' => $query[0]['account_type'],
    'trxID' => $query[0]['trxID'],
    'date' => time()
);


if ($db->rawQuery("SELECT * FROM subscription WHERE uid='$uid'")) {

    $query2 = 1;


    $q4 = $db->rawQuery("DELETE FROM subscriptionTemp WHERE id=$id");


    echo '{"error":true,"msg":"Error occured, try again."}';


} else {


    $query2 = $db->insert('subscription', $data);

    if ($query2) {
        echo '{"error":false,"msg":"' . $time . '"}';


        $notifyMessage = "Dear " . ucwords($name) . ", your membership subscription for NSUer App has been successfully started. Thank you for the contribution.";

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


        // delete


        $q4 = $db->rawQuery("DELETE FROM subscriptionTemp WHERE id=$id");


    } else
        echo '{"error":true,"msg":"Error occured, try again."}';


}
?>