<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';


$ttl = str_replace(",", ", ", fresh($_GET['course']));

$ttl = ucwords($ttl);

$ttl2 = str_replace(",", ", ", fresh($_GET['faculty']));

$ttl2 = ucwords($ttl2);

$userCourses = " ";

$dmeta = '<meta name="description" content="Advising Archive is a collection of offered courses during previous advising of North South University"/>';


$title = 'Advising Archive - Collection of Offered Courses List of NSU';


$thisPage = "advisingar";

include '../head.php';

if ($islogged == 1)
    $userEmail = trim($_SESSION['email']);


?>


    <div class="tabContaier">
        <ul>
            <li><a <?php
                if (empty($_GET['faculty']))
                    echo 'class="active"';

                ?> href="#tab1">Course</a></li>


            <li><a <a <?php
                if (!empty($_GET['faculty']))
                    echo 'class="active"';

                ?> href="#tab2">Faculty</a></li>


        </ul>

    </div>
    <div style="clear: both"></div>

    <div class="tabDetails bar1">
        <div id="tab1" class="tabContents">

            <p>
                <div class="lbody">


            <p class="ititle2">Search with course only</p>

            <form class="sForm" action="/advising-archive/" method="GET">

                <input id="sssss" class="bb autoc" style="text-transform: uppercase" type="search" name="course"
                       placeholder="Enter course initial..." value="<?php echo $ttl; ?>">
                <input type="hidden" name="type" value="course">
                <button class="bbbb" type="submit">Search</button>
            </form>

            <p id="comsug" class="tips"><i class="fa fa-info-circle"></i> Add comma to search multiple courses: <span>CSE215, MAT125, CHE101</span>
            </p>

        </div>


        </p>
    </div>

    <script>
        $("#comsug").hide();
        $("#sssss").focusin(function () {
            $("#comsug").show();
        }).focusout(function () {
            $("#comsug").hide();
        });
    </script>

    <div id="tab2" class="tabContents">

        <p>
            <div class="lbody">

                <form class="sForm" action="/advising-archive/" method="GET">


        <p class="ititle2">Search with faculty initial</p>


        <input class="aa autoc" style="text-transform: uppercase;     width: 35% !important;" type="search"
               name="course"
               placeholder="Enter course initial..." value="<?php echo $ttl; ?>" id="cachedl">

        <input class="aa" style="text-transform: uppercase;     width: 35% !important; margin-left: 10px" type="search"
               name="faculty"
               placeholder="Enter faculty initial..." value="<?php echo $_GET['faculty']; ?>" id="cachedl">


        <button class="aaaa" type="submit">Search</button>
        </form>


    </div>
    </p>
    </div>

    </div>


    <style>
        .ititle a {
            color: #fff;

        }

        .ititle i {
            font-size: 15px;
            margin-left: 3px;
        }

        .urcourse {
            padding-top: 20px;
            display: inherit;
            text-align: justify

        }

        .urcourse form button {
            padding: 0px 8px !important;
            height: 30px !important;
            line-height: 29px !important;
            padding-right: 0px !important;
            margin-right: 5px;
            margin-bottom: 8px;
            background: #0d939a !important;
            color: #fff;
            border-radius: 4px !important;
            display: inline-block;
            font-size: 15px;
            padding-bottom: 1px;
            font-weight: normal;
            width: auto !important;

        }

        .urcourse button i {

            padding-bottom: 1px;
            padding-right: 8px;
            margin-left: 5px;
            background: #e6e6e6;
            color: #555;
            border-radius: 0px 4px 4px 0px;
            padding-left: 8px;
            height: 30px;
            line-height: 29px;
            display: inline-block;
        }

        .urcourse button span {
            background: #eee;
            border-radius: 50%;
            font-size: 12px;
            color: #444;
            display: inline-block;
            width: 20px;
            min-height: 20px;
            line-height: 20px;
            text-align: center;
            margin-bottom: 3px;
            font-weight: bold;
        }

        .toggle-wrap {

            display: none;
        }

        .toggle-wrap[style="display: block;"] {
            display: inline-block !important;
        }

        .cfilled {
            color: #f3f3f3;
            background: #B94836 !important;
            text-align: center;
        }

        .ncfilled {
            color: #357c9f;
            background-color: #D9EDF7;
            text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
            border: 1px solid #BCE8F1;
            text-align: center;

        }

        tr td:nth-child(5), tr th:nth-child(5) {

            text-align: center;
        }

        .timeField {
            width: 100% !important;
            margin-bottom: 5px;

        }

        .timeDate {

            width: 15% !important;
            height: 43px;
            border-color: #ddd;
            background: #fff;
            border-radius: 3px;
            margin-right: 5px;
            min-width: 50px;
            text-align: center;
            padding-left: 5px;
        }

        .timeTime {

            width: 59% !important;
            height: 43px;
            border-color: #ddd;
            background: #fff;
            border-radius: 3px;
        }

        .aaaa {

            float: right;
            padding-left: 12px !important;

        }

        .searchIcon {
            width: 48px !important;
            float: right;
            border-radius: 3px;
            height: 43px;
        }

        .ititle {
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

        .radiustopleft {
            overflow: hidden;
            border-radius: 0px 3px 0 0;
            background: #ddd;
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, .14), 0 3px 1px -2px rgba(0, 0, 0, .2), 0 1px 5px 0 rgba(0, 0, 0, .12);
            border: 0px !important;
            margin-bottom: 15px;
        }

        .radiustopleft table tr {
            border-left: 0px !important;
            border-right: 0px !important;
        }

        .radiustopleft table tr:last-child {

            border-bottom: 0px !important;

        }

        .ititle2 {
            font-weight: normal;
            margin-bottom: 15px;

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
            width: 77% !important;
        }

        .bbb {
            width: 38% !important;
        }

        .bbbb {
            width: 21% !important;

            border-radius: 3px;
            float: right;
        }

        .lbody {

        }

        input, button {

            border-radius: 3px !important;
        }

    </style>


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

        .advising_archive tr td:nth-child(4), tr th:nth-child(4) {
            padding-right: 5px;
            padding-left: 5px;
            text-align: center;
        }

        @media screen and (max-width: 500px) {
            tr td:nth-child(3) {
                max-width: 70px !important;
            }

            tr th:nth-child(3) {
                max-width: 55px !important;
                padding-left: 3px;
            }

            tr td:nth-child(2), tr th:nth-child(2) {
                max-width: 55px !important;
            }

            tr th:nth-child(2) {
                padding-left: 5px;
            }

            tr td:nth-child(1), tr th:nth-child(1) {
                max-width: 88px !important;
            }

            tr td:nth-child(5), tr th:nth-child(5) {
                padding-right: 5px;
                text-align: center;
            }

            tr th:nth-child(5) {
                padding-right: 6px;
                padding-left: 2px;
            }

            th {
                font-size: 14px;

            }

        }

        input[type="search"] {
            padding-right: 4px;
            padding-left: 9px;
        }
    </style>
    <style>

        .table_round td {
            width: auto !important;
            border-right: 1px solid #ddd;

        }

        .table_round td:last-child {
            border-right: 0px solid #ddd;

        }

    </style>
    <style>

        .tips {
            background-colorr: #f1f9f7;
            borderr: 1px solid #e0f1e9;
            color: #125d45;
            margin-top: 10px;
            padding: 5px !important;
            display: block;
            border-radius: 3px;

        }

        .tips span {

            color: #0b3c2c;
        }

        .tabContaier {
            display: block;
            z-index: 2;
            position: relative;
        }

        .tabContaier ul {
            overflow: hidden;
            border-right: 1px solid #dddd
            height: 35px;
            z-index: 2;
            margin: 0;
            padding: 0;
            position: relative;
            border-top-left-radius: 3px;
        }

        .tabContaier li {
            float: left;
            list-style: none;
        }

        .tabContaier li a {
            background: #fff;
            border: 1px solid #e3e3e3;
            border-bottom: 0px;
            color: #444;
            cursor: pointer;
            display: block;
            height: 35px;
            line-height: 35px;
            padding: 0 25px;
            text-decoration: none;
            text-transform: uppercase;
            border-top-right-radius: 3px;
            border-top-left-radius: 3px;
            margin-right: 3px;
        }

        .tabContaier li a:hover {
            background: #eee;
        }

        .tabContaier li a.active {
            background: #428bca;
            border: 1px solid #428bca !important;

            color: #fff;

        }

        .tabDetails {
            background: #fff;
            margin: 0px 0 0;
            overflow: hidden;
            position: relative;
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, .14), 0 3px 1px -2px rgba(0, 0, 0, .2), 0 1px 5px 0 rgba(0, 0, 0, .12);
            box-shadoww: 0 0 2px #aaa;

            border-radius: 3px;
            border-top-left-radius: 0px;
            margin-bottom: 15px;

        }

        .tabContents {
            padding: 20px;
        }

        .tabContents h1 {
            font: normal 24px/1.1em Georgia, "Times New Roman", Times, serif;
            padding: 0 0 10px;
        }

        .tabContents p {
            padding: 0 0 0 0;
        }
    </style>


    <script>
        $(document).ready(function () {
            $(".tabContents").hide(); // Hide all tab content divs by default
            var activeTab1 = $(".active").attr("href");
            $(activeTab1).fadeIn();

            $(".tabContaier ul li a").click(function () { //Fire the click event

                var activeTab = $(this).attr("href"); // Catch the click link
                $(".tabContaier ul li a").removeClass("active"); // Remove pre-highlighted link
                $(this).addClass("active"); // set clicked link to highlight state
                $(".tabContents").hide(); // hide currently visible tab content div
                $(activeTab).fadeIn(); // show the target tab content div by matching clicked link.

                return false; //prevent page scrolling on tab click
            });
        });
    </script>


<?php
if (!empty($_GET['course'])) {

    echo '<a style="display: block; padding: 10px 15px; background: #023d6f; color: #fff; margin-bottom: 15px; border-radius: 5px;" href="/advising-archive/">Go back from Search <i class="fa fa-arrow-circle-o-left fa-2" style="float: right; font-size: 20px;"></i></a>';

}

if (isBot() == 1 || $islogged == 1 || $islogged == 0) {

    if (isset($_GET['course'])) {


        $term = fresh($_GET['course']);
        $sect = trim($_GET['faculty']);


        $searchTerms = explode(',', fresh($_GET['course']));
        $searchTermBits = array();


        foreach ($searchTerms as $term) {

            $term = trim($term);

            if (!empty($term)) {

                if (!empty($sect))

                    $searchTermBits[] = "course = '$term' AND faculty = '$sect'";

                else if (!empty($_GET['type']))
                    $searchTermBits[] = "course = '$term'";


            }
        }


        $idd = $db->rawQuery("SELECT * FROM advising_archive WHERE " . implode(' OR ', $searchTermBits) . " ORDER BY year DESC, semester DESC");


        $fcourse = trim($idd[0]['course']);
        $prevSemester = trim($idd[0]['semester']) . "_" . trim($idd[0]['year']);

        if (!empty($fcourse)) {

            echo '<span class="ititle"><a href="/' . $fcourse . '">' . $fcourse . ' <i class="fa fa-external-link"></i></a></span>';

            $tableHeader = '
                            <div class="table_round radiustopleft">
                                <table class="advising_archive">
                                    <tr>
                                        <th>Faculty</th>
                                        <th>Section</th>
                                        <th>Time</th>
                                        <th>Semester</th>
                                        <th>Year</th>
                                    </tr>';


            if (!empty($fcourse)) {

                echo $tableHeader;

                for ($i = 0; $i < sizeof($idd); $i++) {

                    $course = trim($idd[$i]['course']);

                    $semesterNow = trim($idd[$i]['semester']) . "_" . trim($idd[$i]['year']);


                    if ($semesterNow != $prevSemester) {
                        $fcourse = trim($idd[$i]['course']);
                        echo '</table></div>';
                        echo '<span class="ititle"><a href="/' . $fcourse . '">' . $fcourse . ' <i class="fa fa-external-link"></i></a></span>';

                        echo $tableHeader;

                        $prevSemester = trim($idd[$i]['semester']) . "_" . trim($idd[$i]['year']);

                    }


                    $faculty = trim($idd[$i]['faculty']);


                    $section = trim($idd[$i]['section']);

                    $course = trim($course);

                    $date = $idd[$i]['time'];

                    $semester = $idd[$i]['semester'];
                    $year = $idd[$i]['year'];


                    echo '<tr>';
                    echo '<td><a href="/faculty/section/' . $course . '/' . $section . '"> ' . $faculty . '</a></td>';
                    echo '<td><b>' . $section . '</b></td>';
                    echo '<td>' . $date . '</td>';
                    echo '<td>' . $semester . '</td>';
                    echo '<td>' . $year . '</td>';


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

    echo '
    <div class="addcontainer shadow">
        You must <a href="/login"><b>login</b></a> to use the faculty prediction tool.<br/><br/>

    </div>
    <br/>
    ';


}


if (!empty($_GET['course'])) {

    echo '<a style="display: block; padding: 10px 15px; background: #023d6f; color: #fff; margin-bottom: 15px; border-radius: 5px;" href="/advising-archive/">Go back from Search <i class="fa fa-arrow-circle-o-left fa-2" style="float: right; font-size: 20px;"></i></a>';

}
?>


    </div>

    <script>
        $("#comsug2").hide();
        $("#ssss").focusin(function () {
            $("#comsug2").show();
        }).focusout(function () {
            $("#comsug2").hide();
        });
    </script>

    <script>


        $('.disableComma').on('change keydown keypress keyup mousedown click mouseup propertychange input paste', function () {

            var regex = /[^a-z0-9]/gi;
            this.value = this.value.replace(regex, "");

        });

    </script>


    <div class="sidebar">


        <div class="addcontainer bar1 shadow">
            <h2>What is it</h2>
            Advising Archive is a collection of offered courses during previous advising of North South University.
        </div>


        <div class="addcontainer bar1 shadow"
             style="height: auto!important;max-height: auto!important; min-height: auto!important;">
            Please bookmark the URL and try it later if doesn't work. Sometimes server gets down due to too many
            requests. Hope you all understand.
        </div>

        <?php
        include '../addcoursebar.php';

        ?>

    </div>


    <div style="clear: both"></div>

    </div>


<?php
include '../foot.php';

?>