<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';

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


$ttl = str_replace(",", ", ", fresh($_GET['course']));

$ttl = ucwords($ttl);

$ttl2 = str_replace(",", ", ", fresh($_GET['faculty']));

$ttl2 = ucwords($ttl2);

$dmeta = '<meta name="description" content="' . $ttl2 . ' faculty section, class time for ' . $ttl . ' course in North South University"/>';


if (!empty($_GET['course'])) {
    if (empty($ttl2))
        $ttl2 = $_GET['section'];


    $title = $ttl2 . ' - Section, Class Time for ' . $ttl . ' Course';
} else
    $title = 'Predict faculty initials by searching with section';


$thisPage = "faculp";

include '../head.php';

?>

    <style>
        .abox {
            min-height: auto !important;
            border: 0px solid #ddd;
            padding: 0px !important;
            max-height: 0px;
            transition: 1s;
            overflow: hidden;

        }

        .abox.show {

            border: 1px solid #ddd;
            padding: 15px !important;
            max-height: 400px !important;
        }

        #container {
            display: table;
            width: 100%;
        }

        #temp {
            display: table-row;
        }

        #text, #btn {
            display: table-cell;
        }

        #text, #text input {
            width: 100%;
        }

        #btn button {
            width: 160px;
            padding-left: 8px;
            padding-right: 8px;
        }

        @media screen and (max-width: 500px) {
            tr td:nth-child(3) {
                max-width: 60px !important;
            }

            tr th:nth-child(3) {
                max-width: 55px !important;
                padding-left: 3px;
            }

            tr td:nth-child(2), tr th:nth-child(2) {
                max-width: 65px !important;
            }

            tr th:nth-child(2) {
                padding-left: 5px;
            }

            tr td:nth-child(1), tr th:nth-child(1) {
                max-width: 88px !important;
            }

            tr td:nth-child(5), tr th:nth-child(5) {
                padding-right: 8px;
                text-align: center;
            }

            tr td:nth-child(4), tr th:nth-child(4) {
                padding-right: 6px;
                padding-left: 8px;
            }

            tr th:nth-child(5) {
                padding-right: 6px;
                padding-left: 2px;
            }

            th {
                font-size: 14px;

            }

        }
    </style>
    <div class="fac-container">

        <div class="main">

            <a href="/cgpa-calculator/">
                <div class="dhid"
                     style="display: non; padding: 10px; margin-bottom: 10px; color: #fff; border-radius: 3px;background: #e59a23;">
                    <b>Check out new CGPA Calculator</b></div>
            </a>

            <div class="lbody">
                <form class="sForm" action="/faculty/index.php" method="GET">


                    <p class="ititle">Search by Section</p>


                    <input class="aa autoc" type="search" name="course" placeholder="Enter course initial..."
                           value="<?php echo $ttl; ?>" id="cachedl">

                    <select class="aaa" name="section">
                        <?php


                        $ttl3 = str_replace(",", ", ", fresh($_GET['faculty']));

                        $ttl3 = ucwords($ttl3);


                        for ($u = 1; $u < 100; $u++) {

                            if ($_GET['section'] == $u)
                                $selected = "selected";
                            else
                                $selected = "";

                            echo '
<option value="' . $u . '"' . $selected . '>' . $u . '</option>';
                        }
                        ?>
                    </select>
                    <button class="aaaa" type="submit">Search</button>
                </form>

                <p class="ititle2">Search by Faculty Initial</p>

                <form class="sForm" action="/faculty/index.php" method="GET">

                    <input class="bb autoc" type="search" name="course" placeholder="Enter course initial..."
                           value="<?php echo $ttl; ?>">

                    <input class="bbb" type="text" name="faculty" placeholder="Enter faculty initial..."
                           value="<?php echo $ttl3; ?>">
                    <button class="bbbb" type="submit">Search</button>
                </form>

            </div>

            <style>
                .ititle {
                    font-weight: bold;
                    margin-bottom: 5px;
                    margin-top: 5px;

                }

                .ititle2 {
                    font-weight: bold;
                    margin-bottom: 5px;
                    margin-top: 10px;

                }

                .aa {
                    width: 59% !important;
                }

                .aaa {
                    width: 17% !important;
                    height: 43px;
                    border-color: #ddd;
                    background: #fff;
                    border-radius: 3px;
                }

                .aaaa {
                    width: 21% !important;

                    border-radius: 3px;
                }

                .bb {
                    width: 38% !important;
                }

                .bbb {
                    width: 38% !important;
                }

                .bbbb {
                    width: 21% !important;

                    border-radius: 3px;
                }

                .lbody {
                    margin-bottom: 9px;
                    margin-top: -5px;
                }

                input, button {

                    border-radius: 3px !important;
                }

                .ititle4 a {
                    color: #fff;

                }

                .ititle4 i {
                    font-size: 15px;
                    margin-left: 3px;
                }

                .ititle4 {
                    background: #428bca;

                    color: #fff;
                    cursor: pointer;
                    height: 34px;
                    line-height: 35px;
                    padding: 0 30px;
                    text-decoration: none;
                    text-transform: uppercase;
                    border-top-right-radius: 3px;
                    border-top-left-radius: 3px;
                    display: inline-block;

                    font-weight: bold;
                }

            </style>

            <?php

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


            // $islogged == 1 ||

            if (isBot() == 1 || $islogged == 1 || $islogged == 0) {

                if (isset($_GET['course'])) {

                    $term = fresh($_GET['course']);

                    $sect = $_GET['section'];


                    $faculty = fresh($_GET['faculty']);


                    if (preg_match('(cse225|Cse225|CSE225)', $term) === 0) {
                    } else {

                        $term = "99999";
                    }


                    $idd = $db->rawQuery("SELECT * FROM faculty3 WHERE  course LIKE '%$term%' ORDER BY course");


// var_dump($idd);


                    $course = $idd[0]['course'];


                    $faculty = $idd[0]['data'];


                    if (!empty($course)) {


                        echo '
<p class="ititle">Possibilities:</p>';

                        echo '<span class="ititle4"><a href="/' . $course . '">' . $course . ' <i class="fa fa-external-link"></i></a></span>';


                        echo '<div class="table_round"><table>
<tr>
<th>Faculty</th>
<th>Section</th>
<th>Time</th>
<th>Possibility</th>

<th>Previous Sections</th>
</tr>';


                        $fsection = array();


                        for ($k = 0; $k < sizeof($idd); $k++) {

                            $course = $idd[$k]['course'];

                            $faculty = $idd[$k]['data'];

                            $fid = $idd[$k]['id'];

                            $json = $faculty;


                            $json = explode("\n", $faculty);


                            for ($i = 0; $i < sizeof($json); $i++) {

                                $json2 = explode("@", $json[$i]);

                                for ($j = 0; $j < sizeof($json2); $j++) {


                                    $faculty = $json2['0'];
                                    $section = $json2['1'];
                                    $date = $json2['2'];


                                    if (!in_multiarray($section, $fsection, $faculty)) {

                                        $fsection[$faculty][] = $section;

                                    }

                                }
                            }
                        }


                        print_r($fsection);


                        for ($k = 0; $k < sizeof($idd); $k++) {


                            $course = $idd[$k]['course'];


                            $faculty = $idd[$k]['data'];


                            $fid = $idd[$k]['id'];

                            $json = $faculty;

                            $item = array();


                            $json = explode("\n", $faculty);


                            for ($i = 0; $i < sizeof($json); $i++) {

                                $json2 = explode("@", $json[$i]);

                                for ($j = 0; $j < sizeof($json2); $j++) {


                                    $faculty = $json2['0'];
                                    $section = $json2['1'];
                                    $date = $json2['2'];
                                    $section2 = $json2['3'];


                                    if (!isset($_GET['faculty']) && empty($_GET['faculty'])) {

                                        $back = $course . '_' . $faculty . '_' . $section . '_' . $date;


                                        if (in_array($back, $items)) {
                                        } else {

                                            if ($sect == $section && $faculty != "Cancelled") {

                                                $section3 = $faculty . "." . $section2;

                                                $sec2[0] = $section3;

                                                echo '<tr>';
                                                echo '
<td>' . $faculty . '</td>';
                                                echo '
<td><b>' . $section . '</b></td>';
                                                echo '
<td>' . $date . '</td>';


                                                $section4 = $faculty . "." . $section;


                                                if (in_array((string)$section4, $sec2)) {
                                                    $perr = "<b>65%</b>";
                                                } else {
                                                    $perr = "55%";
                                                }


                                                echo '
<td>' . $perr . '</td>';


                                                echo '</tr>';


                                                $items[] = $back;

                                                if (!in_array($section3, $sec2)) {

                                                    $sec2[] = $section3;
                                                }


                                            }

                                        }

                                    } else {

                                        if (strcasecmp($faculty, $_GET['faculty']) == 0 && $faculty != "Cancelled") {

                                            $back = $course . '_' . $faculty . '_' . $section . '_' . $date;


                                            $section3 = $faculty . "." . $section2;

                                            $sec2[0] = $section3;

                                            if (in_array($back, $items)) {
                                            } else {

                                                echo '<tr>';
                                                echo '
<td>' . $faculty . '</td>';
                                                echo '
<td><b>' . $section . '</b></td>';
                                                echo '
<td>' . $date . '</td>';


                                                $section4 = $faculty . "." . $section;


                                                if (in_array($section4, $sec2)) {
                                                    $perr = "<b>65%</b>";
                                                } else {
                                                    $perr = "55%";
                                                }


                                                echo '
<td>' . $perr . '</td>';


                                                /*

                                                echo '<td>';

                                                for($i = 0; $i < count($fsection[$faculty]); $i++){

                                                echo $fsection[$faculty][$i];

                                                }

                                                echo '</td>';
                                                */

                                                echo '</tr>';


                                                $items[] = $back;


                                                if (!in_array($section3, $sec2)) {

                                                    $sec2[] = $section3;
                                                }


                                            }


                                        }


                                    }
                                }
                            }


                        }

                        echo '</table></div>';


                        ?>
                        <br/>


                        <?php

                    } else {

                        echo '<div class="addcontainer shadow">No Result Found!<br/>
</div>
';
                    }
                }
            } else {

                echo '<div class="addcontainer shadow">
You must <a href="/login"><b>login</b></a> to use the faculty prediction tool.<br/><br/>

Besides, you will need this account for upcoming new tools of NSUer.Club, such as CGPA calculator and Target/Desired GPA Calculator. 

<br/><br/>

Also a new program is coming soon that will select the sections of best faculties and create few sets for you without any contradiction in class time. All you have to do is just enter the course initials ;)
</div><br/>
';


            }
            ?>

        </div>
        <div class="sidebar">


            <div class="addcontainer bar1 shadow"
                 style="height: auto!important;max-height: auto!important; min-height: auto!important;">
                Please bookmark the URL and try it later if doesn't work. Sometimes server gets down due to too many
                requests. Hope you all understand.
            </div>


            <div class="addcontainer bar1 shadow">
                <h2>Disclaimer</h2>
                Faculty Predictor is a program that learns from previous few "Offered Courses" data and estimates the
                faculty initials by matching with the Course name, Time, Room and more. It's just to help you to guess
                the faculty, NSUer.Club is not responsible if section does not matches with the faculty after NSU
                publishes the real faculty initials.
            </div>


            <?php
            include '../addcoursebar.php';

            ?>

        </div>
        <style>

            .table_round td {
                width: auto !important;
                border-right: 1px solid #ddd;

            }

            .table_round td:last-child {
                border-right: 0px solid #ddd;

            }

        </style>

        <div style="clear: both"></div>

    </div>


<?php
include '../foot.php';

?>