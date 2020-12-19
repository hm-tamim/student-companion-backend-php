<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';


$csv = array();
$lines = file('csv/summer2020pre.csv', FILE_IGNORE_NEW_LINES);

foreach ($lines as $key => $value) {
    $csv[$key] = str_getcsv($value);
}


$json = $csv;

// print_r($json);

// die();


$clear = $db->rawQuery("TRUNCATE TABLE advising");

for ($i = 0; $i < sizeof($json); $i++) {


    $course = $json[$i]['1'];
    $section = $json[$i]['2'];
    $faculty = $json[$i]['3'];
    $date = $json[$i]['4'];
    $room = $json[$i]['5'];
    $capacity = $json[$i]['6'];


    $idd = $db->rawQuery("SELECT * FROM advising WHERE faculty LIKE '%$faculty%' AND course LIKE '%$course%' AND section LIKE '%$section%' AND time LIKE '%$date%'");


    if (!$idd) {

        $data = array(
            'course' => $course,
            'section' => $section,
            'faculty' => $faculty,
            'time' => $date,
            'room' => $room,
            'capacity' => $capacity
        );


        $query = $db->insert('advising', $data);


        print_r($query);
        echo '<br/><div><b>Course Added</b></div>';

    }


}


?>