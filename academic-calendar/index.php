<?php

die();

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';


$csv = array();
$lines = file('../apps/academic-calendar/ac.csv', FILE_IGNORE_NEW_LINES);

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
                $details = $csv[$i]['2'];


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


$dmeta = '<meta name="description" content="Official NSU Academic Calendar of Summer 2019, North South University(NSU), Bangladesh. This calendar is automatically updated in every 12 hours."/>';


$thisPage = "academic_calendar";

$title = 'NSU Academic Calendar of Summer 2019 - North South University';
include '../head.php';

?>

    <div class="lbody">


        <div class="bar1 shadow academic_calendar">


            <h2>NSU Academic Calendar</h2>


            <table class="acitem acTitle">
                <tbody>
                <tr>
                    <td class="acleft">Date</td>
                    <td class="acborder" valign="top"></td>
                    <td class="acright">Events</td>
                </tr>
                </tbody>
            </table>

            <?php


            foreach ($jsonArr as $ac) {


                echo '<table class="acitem"><tbody><tr>
        <td class="acleft" valign="top"><span class="ndate">' . $ac['date'] . '</span><span class="nmonth">' . $ac['month'] . '</span></td>
        <td class="acborder" valign="top">
            <div class="acCircle"></div>
        </td>
        <td class="acright"><b>' . $ac['day'] . '</b><p>' . $ac['event'] . '</p></td>
    </tr></tbody></table>';


            }


            ?>

        </div>
    </div>
    </div>

    <div class="sidebar">


        <?php

        include '../addcoursebar.php';

        ?>


    </div>

    <style>
        .fac-container {

            background: #fff;

        }

        .academic_calendar h2 {
            font-size: 15px;
            font-weight: 900;
            color: #444;
            margin: -3px 0 1px;
            padding: 7px;
            border-bottom: 1px solid #eeee;
            border-bottom-styles: double;
            box-shadow: 0 0px 0 #fcfaf6;
            text-transform: uppercase;
            padding-bottom: 15px;
            padding: 15px;
        }

        .class_date {

            background-color: #388096;
            padding: 15px;
            text-align: center;

        }

        .crleft {

            width: 30px;
        }

        .acitem {

            min-height: 25px;
        }

        .fullheight {

            height: 100% !important;
            overflow: hidden;
            max-height: 300px;

        }

        .class_list_holder {

            overflow: hidden;
        }

        .class_list_holder td {

            font-size: 18px !important;
        }

        .no_class_r {

            display: none;
            padding-top: 30px;
            font-size: 18px;
            color: #777;
        }

        .acCircle {
            border: 1px solid #eee;
            border-radius: 5px;
            width: 9px;
            height: 9px;
            margin-left: -5px;
            background: #fff;
            margin-top: 5px;
        }

        .acpassed {

            background: #ccc;
        }

        .acborder {

            width: 20px;
            border-left: 1px solid #eeee !important;
            padding: 0px !important;
        }

        .acleft {

            text-align: center;
            padding: 0px !important;
            padding-left: 10px !important;

            padding-right: 10px !important;
            font-weight: normal !important;
            width: 60px !important;
            border-right: 0px !important;
        }

        .acitem {

            border-collapse: inherit !important;

        }

        .acitem td {

            padding: 0px !important;

        }

        td span {

            padding-bottom: 0px !important;

        }

        .acright {

            width: auto !important;

        }

        .acitem {

            width: 100%;

        }

        table {
            border-spacing: 0px;
        }

        .acTitle {

            height: 60px;
            color: #666;
            top: 60;

        }

        .ndate {
            display: block;
            margin-left: 5px;
            margin-right: 5px;
            font-size: 20px;
        }

        .nmonth {
            display: block;
            font-size: 12px;
        }

        .acright p {

            padding-top: 5px;
            padding-right: 10px;
            padding-bottom: 25px;
            color: #555;

        }

        .acright b {

            color: #555;
        }


    </style>

    <div style="clear: both"></div>

    </div>
<?php
include '../foot.php';

?>