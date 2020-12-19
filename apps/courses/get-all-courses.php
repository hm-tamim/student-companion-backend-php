<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';


error_reporting(E_ALL);


function cleans($str)
{

    $file = str_replace(array('\\', '/', '%', '..', '\'', '"'), ' ', $str);

    return $file;

}


$response = array("error" => FALSE);


$memID = cleans($_REQUEST['memID']);


$courseDB = $db->rawQuery("SELECT course FROM classMate WHERE memID = '$memID'");


if ($courseDB) {


    $courseArr = array();
    $sectionArr = array();

    $courseArrInitial = array();
    $sectionArrInitial = array();

    foreach ($courseDB as $coursez) {

        $searchTerms = explode('.', $coursez['course']);

        $courseArr[] = $searchTerms[0];
        $sectionArr[] = $searchTerms[1];


    }

    $courseSectionSql = array();


    $courseLike = array();

    $i = 0;

    foreach ($courseArr as $term) {
        $term = trim($term);
        if (!empty($term)) {

            if (preg_match('(CSE115|CSE215|CSE225|CSE231|EEE141)', $term) === 0)
                $courseSectionSql[] = "course = '$term' AND section = '$sectionArr[$i]'";
            else
                $courseSectionSql[] = "course LIKE '%$term%' AND section = '$sectionArr[$i]'";

            $courseLike[] = "course LIKE '%$term%'";

            $i++;

        }
    }


    $data = $db->rawQuery("SELECT * FROM courseDataApp WHERE  " . implode(' OR ', $courseSectionSql));


    $book = $db->rawQuery("SELECT * FROM books WHERE " . implode(' OR ', $courseLike));


    $facultyArr = array();

    foreach ($data as $courseData) {

        $initial = $courseData['faculty'];

        if ($initial != NULL)
            $facultyArr[] = $initial;


    }


    $initialArr = array();


    foreach ($facultyArr as $term) {

        $term = trim($term);
        $initialArr[] = "initial = '$term'";

    }

    $fcount = count($initialArr);

    //  $faculty = $db->rawQuery("SELECT courseDataApp.course, courseDataApp.section, courseDataApp.faculty, facultyDatabase.initial, facultyDatabase.name, facultyDatabase.rank, facultyDatabase.image, facultyDatabase.url, facultyDatabase.phone, facultyDatabase.ext, facultyDatabase.email, facultyDatabase.dept, facultyDatabase.office  FROM courseDataApp, facultyDatabase WHERE ".implode(' OR ', $searchTermBits));

    if ($fcount > 0) {
    }

    $faculty = $db->rawQuery("SELECT * FROM facultyDatabase WHERE " . implode(' OR ', $initialArr));


    for ($i = 0; $i < sizeof($faculty); $i++) {

        $initial = $faculty[$i]['initial'];


        for ($j = 0; $j < sizeof($data); $j++) {

            $facultyz = $data[$j]['faculty'];
            $section = $data[$j]['section'];
            $course = $data[$j]['course'];

            if ($facultyz == $initial) {
                $faculty[$i]['course'] = $course;
                $faculty[$i]['section'] = $section;
                break;
            }

        }
    }


    $finalData = array_merge($data, $book, $faculty);


    $kson["dataArray"] = $finalData;

    $json = json_encode($kson);

    print($json);

} else {

    echo '{"dataArray":[]}';
}


?>
    
    
    
    