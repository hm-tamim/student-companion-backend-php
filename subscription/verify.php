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

echo '{"error":false,"msg":"done"}';


$uid = cleans($_REQUEST['uid']);
$payment_type = cleans($_REQUEST['payment_type']);
$account_type = cleans($_REQUEST['account_type']);
$trxID = cleans($_REQUEST['trxID']);


$queryv = $db->rawQuery("SELECT * FROM members WHERE uid= '$uid'");

if (!$queryv)
    die();


$querysx = $db->rawQuery("SELECT * FROM subscription WHERE uid='$uid'");
if ($querysx)
    die();


$queryuu = $db->rawQuery("SELECT * FROM subscriptionTemp WHERE uid='$uid'");
if ($queryuu)
    die();


$data = array(
    'uid' => $uid,
    'payment_type' => $payment_type,
    'account_type' => $account_type,
    'trxID' => $trxID,
    'date' => time()

);
$query = $db->insert('subscriptionTemp', $data);

// if($query)
//  echo '{"error":false,"msg":"'.$time.'"}';
// else
//   echo '{"error":true,"msg":"Error occured, try again."}';

?>