<?php


include '../lib/init.php';


if (isset($_REQUEST['upazila'])) {

    $upazila = $_REQUEST['upazila'];
    $json = $db->rawQuery("SELECT * from villages WHERE upazila = '$upazila'");

} else if (isset($_REQUEST['union'])) {

    $unions = $_REQUEST['union'];
    $json = $db->rawQuery("SELECT * from villages WHERE unions = '$unions'");
} else
    $json = $db->rawQuery('SELECT * from villages');


echo json_encode($json, JSON_UNESCAPED_UNICODE);



