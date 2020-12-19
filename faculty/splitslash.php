<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';


$sl = "/";


$json = $db->rawQuery("SELECT * FROM advising WHERE course LIKE '%$sl%' ORDER BY id");


for ($i = 0; $i < sizeof($json); $i++) {


    $id = $json[$i]['id'];

    $course = $json[$i]['course'];
    $section = $json[$i]['section'];
    $faculty = $json[$i]['faculty'];
    $date = $json[$i]['time'];


    $delete = $db->rawQuery("DELETE FROM advising WHERE id = $id");


    $courseArray = explode("/", $course);

    for ($j = 0; $j < sizeof($courseArray); $j++) {


        echo $courseArray[$j];

        echo '<br>';


        $data = array(
            'faculty' => $faculty,
            'course' => $courseArray[$j],
            'section' => $section,
            'time' => $date,
        );


        $query = $db->insert('advising', $data);
        echo '<br/><div><b>Course Added</b></div>';


    }


}


?>