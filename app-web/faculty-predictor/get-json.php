<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';

function seoUrli($str)
{
    $a = array('/(à|á|â|ã|ä|å|æ)/', '/(&amp;)/', '/(è|é|ê|ë)/', '/(ì|í|î|ï)/', '/(ð|ò|ó|ô|õ|ö|ø|œ)/', '/(ù|ú|û|ü)/', '/ç/', '/þ/', '/ñ/', '/ß/', '/(ý|ÿ)/', '/(=|\+|\/|\%0d|\\n|\\\|\.|\'|\"|\quot|\[|\]|\{|\}|\||\,|\;|\­|\_|↩|\^|\!|\|\:|\&|\\n|\#|\/|\?| |\(|\))/', '//s', '/-{2,}/s');
    $b = array('a', 'and', 'e', 'i', 'o', 'u', 'c', 'd', 'n', 'ss', 'y', '-', '', '-');
    $c = trim(preg_replace($a, $b, $str), '-');
    $d = preg_replace('/-{2,}/', '-', $c);
    $ee = str_replace(array("\r", "\n"), '', $d);
    $e = trim($ee, ' ');
    $f = preg_replace('/ {2,}/', '-', $e);

    $fg = trim(preg_replace('/-+/', '-', $f), '-');
    return trim($fg, '-');
}


function cleans($str)
{

    $file = str_replace(array('\\', '/', '%', '..'), ' ', $str);

    return $file;


}

function removeHyphen($str, $to)
{

    $strr = str_replace("-", $to, $str);

    return $strr;

}

function per($num1, $num2)
{

    $num1 = (int)$num1;

    $num2 = (int)$num2;

    if ($num1 > $num2) {
        $temp = $num2;
        $num2 = $num1;
        $num1 = $num2;
    }

    $percentage = $num1 / $num2;
    $percentage = $percentage * 100;
    return $percentage . "%";
}

$facc = "111";

function val_in_arr($item, $array)
{
    return preg_match('/"' . $item . '"/i', json_encode($array));
}


function in_multiarray($elem, $array, $field)
{
    $top = sizeof($array) - 1;
    $bottom = 0;
    while ($bottom <= $top) {
        if ($array[$field][$bottom] == $elem)
            return true;
        else
            if (is_array($array[$field][$bottom]))
                if (in_multiarray($elem, ($array[$field][$bottom])))
                    return true;

        $bottom++;
    }
    return false;
}


if (isset($_GET['course'])) {

    $term = fresh($_GET['course']);

    $sect = $_GET['section'];


    $faculty = fresh($_GET['faculty']);


    $allArray = array();


    $getFaculty = fresh($_GET['faculty']);
    $getSection = fresh($_GET['section']);
    $getCourse = strtoupper(fresh($_GET['course']));


    if (!empty($_GET['section'])) {

        $idd = $db->rawQuery("SELECT * FROM advising2018Pre WHERE course = '$getCourse' AND section = '$getSection' ORDER BY id");


        $advisingDate = $idd[0]['time'];


        $idd = $db->rawQuery("SELECT * FROM facultySections WHERE course = '$getCourse' AND time LIKE '%$advisingDate%' ORDER BY id");


    } else {


        $idd = $db->rawQuery("SELECT * FROM facultySections WHERE course = '$getCourse' AND faculty = '$getFaculty' ORDER BY id");


        for ($i = 0; $i < count($idd); $i++) {
            $advisingDates[] = $idd[$i]['time'];


            $staticFaculty = $idd[0]['faculty'];

            $searchTermBits = array();
            foreach ($advisingDates as $term) {
                $term = trim($term);
                if (!empty($term)) {

                    $searchTermBits[] = "course = '$getCourse' AND time LIKE '%$term%'";
                }
            }
        }


        $idd = $db->rawQuery("SELECT * FROM advising2018Pre WHERE " . implode(' OR ', $searchTermBits) . " ORDER BY id");


    }


    if (empty($_GET['section'])) {

        $getSec = $db->rawQuery("SELECT section FROM facultySections WHERE faculty LIKE '%$getFaculty%' AND course = '$getCourse'");

        $sections = "";

        $checker = array();


        for ($i = 0; $i < count($getSec); $i++) {

            if (!in_array($getSec[$i]['section'], $checker)) {
                $checker[] = $getSec[$i]['section'];

                $sections .= $getSec[$i]['section'] . ',';
            }


        }

    }


    $course = $idd[0]['course'];

    $faculty = $staticFaculty;

    $section = $getSection;


    if (!empty($course)) {


        $jsonArray = array();


        $jsonArray['faculty'] = $faculty;

        for ($k = 0; $k < sizeof($idd); $k++) {


            $prevSection = null;


            if (!empty($_GET['section'])) {


                $jsonArray['faculty'] = $idd[$k]['faculty'];
                $faculty = $idd[$k]['faculty'];

                $jsonArray['section'] = $getSection;

            }


            $jsonArray['time'] = removeHyphen($idd[$k]['time'], "");


            if (empty($_GET['section'])) {
                $jsonArray['section'] = $idd[$k]['section'];
                $section = $idd[$k]['section'];
            }


            if (empty($_GET['section'])) {

                $getSec = explode(",", $sections);


                for ($i = 0; $i < count($getSec); $i++) {


                    if ($getSec[$i] == $section)
                        $prevSection .= '<b><font color="red">' . $getSec[$i] . '</font></b>' . ", ";
                    else
                        $prevSection .= $getSec[$i] . ", ";


                    $jsonArray['previousSections'] = rtrim($prevSection, ', ');
                }


            } else {

                $getSec = $db->rawQuery("SELECT section FROM facultySections WHERE faculty LIKE '%$faculty%' AND course = '$getCourse'");


                $sections = array();


                $prevSection = "";

                for ($i = 0; $i < count($getSec); $i++) {


                    if (!in_array($getSec[$i]['section'], $sections)) {
                        $sections[] = $getSec[$i]['section'];

                        if ($getSec[$i]['section'] == $getSection)
                            $prevSection .= '<b><font color="#bf1d1d">' . $getSec[$i]['section'] . '</font></b>' . ", ";
                        else
                            $prevSection .= $getSec[$i]['section'] . ", ";

                    }

                }


                $jsonArray['previousSections'] = rtrim($prevSection, ', ');

            }


            $allArray[] = $jsonArray;

        }


    }
}


$array = array();

$array['dataArray'] = $allArray;

echo json_encode($array);

