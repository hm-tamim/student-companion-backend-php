<?php


if (preg_match('/bot|crawl|curl|dataprovider|search|get|spider|find|java|majesticsEO|google|yahoo|teoma|contaxe|yandex|libwww-perl|facebookexternalhit/i', $_SERVER['HTTP_USER_AGENT'])) {
    die();
}

if (empty($_SERVER['HTTP_REFERER'])) {
    die();

}
session_start();

$mou = $_GET['course'] . '_' . $_GET['faculty'];

$cou = $_COOKIE[$mou];

setcookie($mou, ++$cou, time() + (6 * 30 * 24 * 3600));


require_once 'lib/init.php';
require_once 'includes/func.php';
require_once 'lib/pagination.class.php';


$cc = fresh($_GET['course']);

$id = $db->rawQuery('SELECT * from sites where course  = ?', Array($cc));
$idd = $id[0]['id'];


$json = unserialize($id[0]["faculty"]);


for ($i = 0; $i < sizeof($json); $i++) {

    $name = $json[$i]['name'];


    if ($name === $_GET['faculty']) {

//echo $json[$i]['name'];

        $json[$i]['vote'] += 1;

        break;
    }

}


function invenDescSort($item1, $item2)
{
    if ($item1['vote'] == $item2['vote']) return 0;
    return ($item1['vote'] < $item2['vote']) ? 1 : -1;
}

usort($json, 'invenDescSort');


//print_r($json);


$json = serialize($json);


if ($cou < 2) {

    $data = array(
        'course' => $cc,
        'faculty' => $json,
    );
    $db->where('id', $idd);
    if ($db->update('sites', $data)) {
        // echo $db->count . ' records were updated';
    }
}


header('Location: /');


?>