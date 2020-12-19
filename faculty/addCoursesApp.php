<?php

// die();

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';


// $csv = array();
// $lines = file('csv/spring2020pre.csv', FILE_IGNORE_NEW_LINES);

// foreach ($lines as $key => $value)
// {
//     $csv[$key] = str_getcsv($value);
// }


$json = $db->rawQuery("SELECT * FROM advisingTBA");


$iddp = $db->rawQuery("TRUNCATE TABLE courseDataApp");

for ($i = 0; $i < sizeof($json); $i++) {

    $course = $json[$i]["course"];

    $section = $json[$i]['section'];
    $faculty = $json[$i]['faculty'];
    $time = $json[$i]['time'];
    $room = $json[$i]['room'];


    $courseArray = explode("/", $course);

    for ($j = 0; $j < sizeof($courseArray); $j++) {

        $arr = preg_split('/ +-? *(?=\d)/', $time);

        $idd = $db->rawQuery("SELECT * FROM courseDataApp WHERE faculty = '$faculty' AND course = '$courseArray[$j]' AND section = '$section'");

        if (!$idd) {

            if (strcmp($faculty, 'TBA') != 0) {
            }


            $data = array(
                'faculty' => $faculty,
                'course' => $courseArray[$j],
                'section' => $section,
                'day' => $arr[0],
                'startTime' => $arr[1],
                'endTime' => $arr[2],
                'room' => $room
            );


            $query = $db->insert('courseDataApp', $data);
            echo '<br/><div><b>Course Added</b></div>';


        }
    }


}


?>