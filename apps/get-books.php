<?php


require_once '../lib/init.php';
require_once '../includes/func.php';
require_once '../lib/pagination.class.php';


function cleans($str)
{

    $file = str_replace(array('\\', '/', '%', '..', '='), ' ', $str);

    return $file;

}


$response = array("error" => FALSE);


$courses = strtoupper(seoUrl($_GET['course']));

$section = seoUrl($_GET['section']);


$courseJoined = $courses . "." . $section;


$book = $db->rawQuery("SELECT * FROM books WHERE course LIKE '%$courses%'");


$kson["dataArray"] = $book;

$json = json_encode($kson);

print($json);
    
    
    








    
    
    
    