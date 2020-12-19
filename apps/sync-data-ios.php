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

            if (preg_match('(CSE115|CSE215|CSE225|CSE231|EEE141)', $term) === 0) {

                $courseSectionSql[] = "courseDataApp.course = '$term' AND courseDataApp.section = '$sectionArr[$i]'";

            } else {

                $term2 = $term . "L";

                $courseSectionSql[] = "courseDataApp.course = '$term' AND courseDataApp.section = '$sectionArr[$i]'";

                $courseSectionSql[] = "courseDataApp.course = '$term2' AND courseDataApp.section = '$sectionArr[$i]'";
            }
            $i++;

        }
    }


    $data = $db->rawQuery("SELECT courseDataApp.*, facultyDatabase.*, books.books 
                            FROM courseDataApp
                            LEFT  JOIN facultyDatabase ON facultyDatabase.initial = courseDataApp.faculty
                            LEFT  JOIN books ON books.course = courseDataApp.course  WHERE " . implode(' OR ', $courseSectionSql));


    $courseArr = array();
    $booksArr = array();
    $facultyArr = array();


    if ($data)


        for ($i = 0; $i < count($data); $i++) {


            $id = $data[$i]['id'];
            $faculty = $data[$i]['faculty'];
            $course = $data[$i]['course'];
            $section = $data[$i]['section'];
            $startTime = $data[$i]['startTime'];
            $endTime = $data[$i]['endTime'];
            $day = $data[$i]['day'];
            $room = $data[$i]['room'];
            $initial = $data[$i]['initial'];
            $name = $data[$i]['name'];
            $image = $data[$i]['image'];
            $url = $data[$i]['url'];
            $rank = $data[$i]['rank'];
            $phone = $data[$i]['phone'];
            $ext = $data[$i]['ext'];
            $email = $data[$i]['email'];
            $office = $data[$i]['office'];
            $dept = $data[$i]['dept'];
            $books = $data[$i]['books'];


            $arrCourse = array("id" => $id, "faculty" => $faculty, "course" => $course, "section" => $section, "startTime" => $startTime, "endTime" => $endTime, "day" => $day, "room" => $room);
            $courseArr[] = $arrCourse;


            $arrFaculty = array("id" => $id, "initial" => $initial, "course" => $course, "section" => $section, "name" => $name, "image" => $image, "url" => $url, "rank" => $rank, "phone" => $phone, "ext" => $ext, "email" => $email, "office" => $office, "dept" => $dept);

            if ($name != null)
                $facultyArr[] = $arrFaculty;

            $arrBooks = array("id" => $id, "course" => $course, "books" => $books);

            if ($books != null)
                $booksArr[] = $arrBooks;


        }


    $finalData = array_merge($courseArr, $booksArr, $facultyArr);


    $kson["dataArray"] = $finalData;

    $json = json_encode($kson);

    print($json);

} else {

    print(json_encode($response));

}


?>
    
    
    
    