<?php


if (preg_match('/bot|crawl|curl|dataprovider|search|get|spider|find|java|majesticsEO|google|yahoo|teoma|contaxe|yandex|libwww-perl|facebookexternalhit/i', $_SERVER['HTTP_USER_AGENT'])) {
    die();
}

if (empty($_SERVER['HTTP_REFERER'])) {
//die();

}
session_start();


require_once '../lib/init.php';
require_once '../includes/func.php';
require_once '../lib/pagination.class.php';


$mou = 'shoplike_' . seoUrl($_GET['shop']);

$cou = $_COOKIE[$mou];


if ($_COOKIE[$mou] >= 1 || isset($_COOKIE[$mou]) && $_COOKIE[$mou] != 0)
    $cou = -1;

setcookie($mou, ++$cou, time() + (86040070 * 7));


$cc = $_GET['shop'];

$id = $db->rawQuery('SELECT * from food where shop  = ?', Array($cc));
$idd = $id[0]['id'];


$json = $id[0]["like"];


if ($_COOKIE[$mou] >= 1 || isset($_COOKIE[$mou]) && $_COOKIE[$mou] != 0) {
    $json -= 1;
} else
    $json += 1;


if ($cou < 2) {

    $data = array(
        'shop' => $cc,
        'like' => $json,
    );
    $db->where('id', $idd);
    if ($db->update('food', $data)) {
        echo $db->count . ' records were updated';
    }
}


?>