<?php


require_once '../lib/init.php';
require_once '../includes/func.php';
require_once '../lib/pagination.class.php';


$response = array("error" => FALSE);

$initial = strtoupper(seoUrl($_GET['faculty']));

if (strlen($initial) > 3)
    $faculty = $db->rawQuery("SELECT * FROM facultyDatabase WHERE initial = '$initial' or name LIKE '%$initial%'");
else
    $faculty = $db->rawQuery("SELECT * FROM facultyDatabase WHERE initial = '$initial'");


$kson["dataArray"] = $faculty;

$json = json_encode($kson);

print($json);
    
    
    








    
    
    
    