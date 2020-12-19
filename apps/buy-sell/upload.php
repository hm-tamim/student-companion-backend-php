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


$file_path = $_SERVER['DOCUMENT_ROOT'] . "/images/shop/";

$filetype = seoUrli(pathinfo(basename($_FILES['bill']['name']), PATHINFO_EXTENSION));

$allowed = array("jpeg", "JPEG", "PNG", "png", "JPG", "jpg");


if (in_array($filetype, $allowed)) {
} else {
    //  die();

}


$uid = $_GET['uid'];


$time = seoUrli($_GET['time']);

$memberIDdb = $db->rawQuery("SELECT memberID FROM members WHERE uid = '$uid'");


if (!$memberIDdb)
    die();

$memberID = $memberIDdb['0']['memberID'];

$filetype = "jpg";

$file_path = $file_path . $time . "." . $filetype;


$short_path = $time . "." . $filetype;


//   $file_path = $file_path . basename( $_FILES['bill']['name']);


if (copy($_FILES['bill']['tmp_name'], $file_path)) {
    echo "success";


} else {
    echo "fail";
}


?>