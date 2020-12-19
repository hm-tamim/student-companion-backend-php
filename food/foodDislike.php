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


$mou = 'dislike_' . seoUrl($_GET['shop']) . '_' . seoUrl($_GET['food']);

$cou = $_COOKIE[$mou];

if ($_COOKIE[$mou] >= 1 || isset($_COOKIE[$mou]) && $_COOKIE[$mou] != 0)
    $cou = -1;

setcookie($mou, ++$cou, time() + (86040070 * 7));


$cc = $_GET['shop'];

$id = $db->rawQuery('SELECT * from food where shop  = ?', Array($cc));
$idd = $id[0]['id'];


$json = unserialize($id[0]["foods"]);


print_r($json);


for ($i = 0; $i < sizeof($json); $i++) {

    $name = $json[$i]['name'];

    $vote = $json[$i]['vote'];


    if ($name === $_GET['food']) {


        if ($_COOKIE[$mou] >= 1 || isset($_COOKIE[$mou]) && $_COOKIE[$mou] != 0)
            $json[$i]['downvote'] -= 1;
        else
            $json[$i]['downvote'] += 1;


        break;
    }

}


/*

function invenDescSort($item1,$item2)
{
    if ($item1['vote'] == $item2['vote']) return 0;
    return ($item1['vote'] < $item2['vote']) ? 1 : -1;
}
usort($json,'invenDescSort');


*/

//print_r($json);


$json = serialize($json);


if ($cou < 2) {

    $data = array(
        'shop' => $cc,
        'foods' => $json,
    );
    $db->where('id', $idd);
    if ($db->update('food', $data)) {
        echo $db->count . ' records were updated';
    }
}


?>