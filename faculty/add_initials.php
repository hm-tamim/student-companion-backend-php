<?php

// updated archive


// die();

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';


$csv = array();
$lines = file('csv/fall2019SomeTba.csv', FILE_IGNORE_NEW_LINES);

foreach ($lines as $key => $value) {
    $csv[$key] = str_getcsv($value);
}


$json = $csv;


for ($i = 0; $i < sizeof($json); $i++) {


    $course = $json[$i]['1'];
    $section = $json[$i]['2'];
    $faculty = $json[$i]['3'];
    $time = $json[$i]['4'];


    $data = array(
        'faculty' => $faculty,
        'course' => $course,
        'section' => $section,
        'time' => $time,
        'semester' => "Fall",
        'year' => "2019",
    );


    // $update = $db->rawQuery("UPDATE advising_archive SET faculty = '$faculty' WHERE course = '$course' AND section = '$section' AND semester = 'Spring' AND year = '2019'");
    // echo'Update</br>';


    $query = $db->insert('advising_archive', $data);
    echo '<br/><div><b>Course Added</b></div>';


}


?>