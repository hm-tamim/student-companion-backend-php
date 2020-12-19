<?php


require_once '../lib/init.php';
require_once '../includes/func.php';
require_once '../lib/pagination.class.php';


function cleans($str)
{

    $file = str_replace(array('\\', '/', '%', '..', '-', ' ', '\'', '='), '', $str);

    return $file;

}


$response = array("error" => FALSE);


$uid = cleans($_REQUEST['uid']);
$courses = strtoupper(cleans($_GET['course']));

$section = seoUrl($_GET['section']);


$courseJoined = $courses . "." . $section;


$user = $db->rawQuery("SELECT memberID FROM members WHERE uid = '$uid'");


if (!$user) {

    $response['error'] = TRUE;
    echo json_encode($response);

    die();
}


$memID = $user['0']['memberID'];

$dataU = array(
    'memID' => $memID,
    'course' => $courseJoined
);


if (preg_match('(CSE115|CSE215|CSE225|CSE231|EEE141)', $courses) === 0) {

    $data = $db->rawQuery("SELECT * FROM courseDataApp WHERE course = '$courses' AND section = $section");


} else {

    $data = $db->rawQuery("SELECT * FROM courseDataApp WHERE course LIKE '%$courses%' AND section = $section");

}


$book = $db->rawQuery("SELECT * FROM books WHERE course LIKE '%$courses%'");


$initial = $data[0]['faculty'];

$faculty = array();


if ($initial != NULL)
    $faculty = $db->rawQuery("SELECT * FROM facultyDatabase WHERE initial = '$initial'");


$finalData = array_merge($data, $book, $faculty);


$kson["dataArray"] = $finalData;

$json = json_encode($kson);


if ($data) {

    if (!$db->rawQuery("SELECT * FROM classMate WHERE memID='$memID' AND course = '$courseJoined'")) {


        $query = $db->insert('classMate', $dataU);

        if (!$query)
            $response['error'] = TRUE;


    }
}

print($json);
    
    
    








    
    
    
    