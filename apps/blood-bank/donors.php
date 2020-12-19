<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';

error_reporting(E_ALL);

function cleans($str)
{
    $file = str_replace(array('\\', '/', '%', '..'), ' ', $str);
    return $file;
}

$start = cleans($_REQUEST['start']);
$loadByCat = cleans($_REQUEST['loadCat']);
$loadBySearch = cleans($_REQUEST['loadSearch']);
$query = cleans($_REQUEST['query']);
$cat = cleans($_REQUEST['cat']);

if ($loadByCat == "true")
    $data = $db->rawQuery("SELECT username, memberID, gender, picture, bgroup, phone, address 
                            FROM members 
                            WHERE members.bgroup IS NOT NULL AND bgroup = $cat AND memberID > $start 
                            ORDER BY memberID ASC LIMIT 30");

else if ($loadBySearch == "true")
    $data = $db->rawQuery("SELECT username, memberID, gender, picture, bgroup, phone, address 
                            FROM members 
                            WHERE bgroup IS NOT NULL AND UPPER(address) LIKE UPPER('%$query%') OR UPPER(bgroup) LIKE UPPER('%$query%') AND memberID > $start 
                            ORDER BY memberID ASC 
                            LIMIT 30");
else
    $data = $db->rawQuery("SELECT username, memberID, gender, picture, bgroup, phone, address 
                            FROM members 
                            WHERE bgroup IS NOT NULL AND memberID > $start 
                            ORDER BY memberID ASC LIMIT 30");

$arr = array();

$arr['dataArray'] = $data;

echo stripslashes(json_encode($arr, JSON_UNESCAPED_UNICODE));

?>