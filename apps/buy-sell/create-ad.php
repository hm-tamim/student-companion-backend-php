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

function cleanStrip($str)
{

    $file = str_replace(array('"'), "''", $str);

    return $file;

}


$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);


$doUpdate = cleans($_REQUEST['doUpdate']);


$doUpdateImage = cleans($_REQUEST['doUpdateImage']);

$msgID = cleans($_REQUEST['msgID']);


$title = cleanStrip(mysqli_real_escape_string($con, $_REQUEST['title']));
$category = cleans($_REQUEST['category']);
$price = mysqli_real_escape_string($con, $_REQUEST['price']);;
$description = cleanStrip(mysqli_real_escape_string($con, $_REQUEST['description']));
$uid = cleans($_REQUEST['uid']);


$user = $db->rawQuery("SELECT memberID, username FROM members WHERE uid = '$uid' LIMIT 1");

$username = $user['0']['username'];
$memberID = $user['0']['memberID'];


$time = time();


$data = array(
    'si' => $memberID,
    'sn' => $username,
    't' => $title,
    'p' => $price,
    'tm' => $time,
    'c' => $category,
    'd' => $description,
    'a' => 0,
    's' => 0
);


if ($doUpdate == 0) {

    $query = $db->insert('shop', $data);

    if ($query)
        echo '{"error":false,"msg":"' . $time . '"}';
    else
        echo '{"error":true,"msg":"Error occured, try again."}';


} else {


    $post = $db->rawQuery("SELECT si FROM shop WHERE id = $msgID");

    $postMemID = (int)$post['0']['si'];

    if ($postMemID == $memberID) {


        if ($doUpdateImage == 1) {
            $update = $db->rawQuery("UPDATE shop SET si = '$memberID', sn = '$username', t = '$title', p = '$price', c = $category, tm = $time, d =  '$description'  WHERE id = '$msgID'");
        } else {

            $update = $db->rawQuery("UPDATE shop SET si = '$memberID', sn = '$username', t = '$title', p = '$price', c = $category, d=  '$description'  WHERE id = '$msgID'");


        }
        echo '{"error":false,"msg":"' . $time . '"}';


    } else {

        echo '{"error":true,"msg":"Error occured, try again."}';

    }


}
?>