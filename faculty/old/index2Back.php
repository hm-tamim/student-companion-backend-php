<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';


$csv = array();
$lines = file('fall2018.csv', FILE_IGNORE_NEW_LINES);

foreach ($lines as $key => $value) {
    $csv[$key] = str_getcsv($value);
}


$csv2 = array();
$lines2 = file('faculty.csv', FILE_IGNORE_NEW_LINES);

foreach ($lines2 as $key2 => $value2) {
    $csv2[$key2] = str_getcsv($value2);
}


$json = $csv;

$json2 = $csv2;


for ($i = 0; $i < sizeof($json); $i++) {


    $course = $json[$i]['1'];
    $section = $json[$i]['2'];
    $faculty = $json[$i]['3'];
    $date = $json[$i]['4'];

    $data = '';

    for ($j = 0; $j < sizeof($json2); $j++) {


        $course2 = $json2[$j]['1'];
        $section2 = $json2[$j]['2'];
        $faculty2 = $json2[$j]['3'];
        $date2 = $json2[$j]['4'];


        if (strcmp($course, $course2) == 0 && strcmp($date, $date2) == 0 && strcmp($faculty2, 'TBA') != 0) {


            $data .= $faculty2 . "@" . $section . "@" . $date . "@" . $section2 . "\n";


        }
    }


    $data = array(
        'course' => $course,
        'data' => $data,
    );


    $query = $db->insert('faculty3', $data);
    echo '<br/><div><b>Course Added</b></div>';


}


?>