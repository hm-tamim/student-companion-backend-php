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

    $file = str_replace(array('\\', '/', '%', '..'), ' ', $str);

    return $file;


}

$uid = cleans($_REQUEST['uid']);
$name = cleans($_REQUEST['name']);
$cgpa = cleans($_REQUEST['cgpa']);
$credit = cleans($_REQUEST['credit']);
$semester = cleans($_REQUEST['semester']);
$dept = cleans($_REQUEST['dept']);


$update = $db->rawQuery("UPDATE members SET username = '$name', cgpa = '$cgpa', credit = '$credit', semester = '$semester', dept = '$dept'  WHERE uid = '$uid'");

if ($update)
    echo '{"error":fale,"msg":"Information updated!"}';
else
    echo '{"error":true,"msg":"Error occured, try again."}';

?>