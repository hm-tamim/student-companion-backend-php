<?php


include '../lib/init.php';


$json = $db->rawQuery('SELECT * from districts');

echo json_encode($json, JSON_UNESCAPED_UNICODE);



