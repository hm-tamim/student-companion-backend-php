<?php


include '../lib/init.php';


if (isset($_REQUEST['district'])) {

    $district = $_REQUEST['district'];
    $json = $db->rawQuery("SELECT * from upazilas WHERE district_id = '$district'");
} else
    $json = $db->rawQuery('SELECT * from upazilas');


echo json_encode($json, JSON_UNESCAPED_UNICODE);



