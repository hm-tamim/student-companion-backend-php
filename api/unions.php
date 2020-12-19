<?php


include '../lib/init.php';

if (isset($_REQUEST['upazila'])) {

    $upazila = $_REQUEST['upazila'];
    $json = $db->rawQuery("SELECT * from unions WHERE upazila_id = '$upazila'");
} else
    $json = $db->rawQuery('SELECT * from unions');

echo json_encode($json, JSON_UNESCAPED_UNICODE);



