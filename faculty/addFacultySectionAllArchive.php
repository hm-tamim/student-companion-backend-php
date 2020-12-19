<?php

// added with year and semester for archive


die();


require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';


$csv = array();
$lines = file('csv/spring2020.csv', FILE_IGNORE_NEW_LINES);

foreach ($lines as $key => $value) {
    $csv[$key] = str_getcsv($value);
}


$json = $csv;


for ($i = 0; $i < sizeof($json); $i++) {


    $course = $json[$i]['0'];
    $section = $json[$i]['1'];
    $faculty = $json[$i]['2'];
    $date = $json[$i]['3'];


    $courseArray = explode("/", $course);

    for ($j = 0; $j < sizeof($courseArray); $j++) {


        $data = array(
            'faculty' => $faculty,
            'course' => $courseArray[$j],
            'section' => $section,
            'time' => $date,
            'semester' => "Spring",
            'year' => "2020"
        );


        $query = $db->insert('advising_archive', $data);
        echo '<br/><div><b>Course Added</b></div>';


    }


}


?>