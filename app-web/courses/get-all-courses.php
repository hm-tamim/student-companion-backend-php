<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';


function cleans($str)
{

    $file = str_replace(array('\\', '/', '%', '..', '='), ' ', $str);

    return $file;

}


$response = array("error" => FALSE);


$memID = cleans($_REQUEST['memID']);


$courseDB = $db->rawQuery("SELECT course FROM classMate WHERE memID = '$memID'");

if ($courseDB) {


    $courseArr = array();
    $sectionArr = array();

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


    $faculty = $db->rawQuery("SELECT * FROM facultyDatabase WHERE " . implode(' OR ', $initialArr));


    $finalData = array_merge($data, $book, $faculty);


    $kson["dataArray"] = $finalData;

    $json = json_encode($kson);

    print($json);

} else {

    print(json_encode($response));

}


?>
    
    
    
    