<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';


$csv = array();
$lines = file('ac.csv', FILE_IGNORE_NEW_LINES);

foreach ($lines as $key => $value) {
    $csv[$key] = str_getcsv($value);
}

$jsonArr = array();


for ($i = 0; $i < sizeof($csv); $i++) {


    $tempArr = array();
    $date = $csv[$i]['0'];


    $regex2 = '/(\d+)-(\d+)( |-)(\w+)-(\d+)/m';

    if (preg_match($regex2, $date, $data)) {

        $first = (int)$data[1];
        $last = (int)$data[2];

        for ($j = $first; $j <= $last; $j++) {
            $month = strtoupper(substr($data[4], 0, 3));

            if ($j == $first)
                $details = $csv[$i]['2'];
            else
                $details = "No clasess";


            $date = (string)$j;

            if (strlen($date) == 1)
                $date = "0" . $date;

            $tempArr['date'] = $date;

            $month = strtoupper(substr($data[4], 0, 3));

            $tempArr['month'] = $month;


            $year = "20" . $data[5];


            $date2 = $date . "-" . $month . "-" . $year;

            $day = date('l', strtotime($date2));


            $tempArr['day'] = $day;


            $tempArr['year'] = $year;


            $tempArr['event'] = $details;
            $jsonArr[] = $tempArr;

        }


        continue;

    }


    $regex = '/(\d+)-(\w+)-(\d+)/m';
    if (preg_match($regex, $date, $match)) {
    }


    $day = $csv[$i]['1'];
    $details = $csv[$i]['2'];
    $date = $match[1];

    if (strlen($date) == 1)
        $date = "0" . $date;

    $tempArr['date'] = $date;
    $month = strtoupper(substr($match[2], 0, 3));

    $year = "20" . $match[3];

    $tempArr['month'] = $month;
    $tempArr['day'] = $day;

    $tempArr['year'] = $year;

    $tempArr['event'] = $details;

    $jsonArr[] = $tempArr;


}

$calendar = array();

$calendar['calendar'] = $jsonArr;

echo json_encode($calendar);


?>