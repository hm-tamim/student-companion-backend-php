<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';


$thisPage = "advisingp";

include 'head.php';


if ($islogged == 1)
    $memberID = trim($_SESSION['memberID']);

if (!empty($_REQUEST['email'])) {
    $memberID = trim($_REQUEST['email']);
    $islogged = 1;

}

?>


    <style>

        body {

            padding: 0px !important;
            margin: auto;
        }

        .main {
            width: 100% !important;

        }

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

        @media screen and (max-width: 600px) {
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

            tr td:nth-child(4), tr th:nth-child(4) {
                padding-right: 6px;
                padding-left: 6px;
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


    <div class="fac-container">

        <div class="main">


            <div class="tabContaier">
                <ul>
                    <li><a <?php
                        if (empty($_GET['section']) && empty($_GET['times']))
                            echo 'class="active"';

                        ?> href="#tab1">Course</a></li>


                    <li><a <a <?php
                        if (!empty($_GET['section']))
                            echo 'class="active"';

                        ?> href="#tab2">Section</a></li>


                    <li><a <a <?php
                        if (!empty($_GET['times']))
                            echo 'class="active"';

                        ?> href="#tab3">Time</a></li>
                </ul>

            </div>
            <div style="clear: both"></div>

            <div class="tabDetails bar1">
                <div id="tab1" class="tabContents">

                    <p>
                        <div class="lbody">


                    <p class="ititle2">Search with course only</p>

                    <form class="sForm" action="/apps/advising-assistant.php" method="GET">

                        <input id="sssss" class="bb autoc" style="text-transform: uppercase" type="search" name="course"
                               placeholder="Enter course initial..." value="<?php echo $ttl; ?>">
                        <input type="hidden" name="type" value="course">
                        <button class="bbbb" type="submit">Search</button>
                    </form>

                    <p id="comsug" class="tips"><i class="fa fa-info-circle"></i> Add comma to search multiple courses:
                        <span>CSE215, MAT125, CHE101</span>
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

                        <form class="sForm" action="/apps/advising-assistant.php" method="GET">


                <p class="ititle2">Search with section</p>


                <input class="aa autoc" style="text-transform: uppercase" type="search" name="course"
                       placeholder="Enter course initial..." value="<?php echo $ttl; ?>" id="cachedl">

                <select class="aaa" name="section">
                    <?php
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


            </div>
            </p>
        </div>


        <div id="tab3" class="tabContents">

            <p>
                <div class="lbody">

                    <form class="sForm" action="/apps/advising-assistant.php" method="GET">


            <p class="ititle2">Search with time</p>


            <input class="timeField autoc" style="text-transform: uppercase" type="search" name="course"
                   placeholder="Enter course initial..." value="<?php echo $ttl; ?>" id="cachedl">


            <select class="timeDate" name="days">


                <?php


                $days = array("ST", "MW", "RA", "STMW", "S", "T", "R", "A", "M", "W", "F");


                $times = array(
                    "06:00 PM - 09:00 PM",
                    "06:00 PM - 09:10 PM",
                    "07:00 PM - 10:10 PM",
                    "07:30 AM - 10:30 AM",
                    "08:00 AM - 09:30 AM",
                    "08:00 AM - 11:10 AM",
                    "09:40 AM - 11:10 AM",
                    "09:40 AM - 12:50 PM",
                    "09:00 AM - 12:00 PM",
                    "11:20 AM - 12:50 PM",
                    "11:20 AM - 02:30 PM",
                    "01:00 PM - 02:30 PM",
                    "01:10 PM - 05:00 PM",
                    "02:40 PM - 04:10 PM",
                    "02:00 PM - 05:00 PM",
                    "03:00 PM - 06:00 PM",
                    "03:00 PM - 06:30 PM",
                    "04:20 PM - 05:50 PM",
                );


                for ($i = 0; $i < count($days); $i++) {

                    if ($_GET['days'] == $days[$i])
                        $selected = "selected";
                    else
                        $selected = "";

                    echo ' <option value="' . $days[$i] . '"' . $selected . '>' . $days[$i] . '</option>';
                }

                echo '</select><select class="timeTime" name="times">';

                for ($i = 0; $i < count($times); $i++) {

                    if ($_GET['times'] == $times[$i])
                        $selected = "selected";
                    else
                        $selected = "";
                    echo ' <option value="' . $times[$i] . '"' . $selected . '>' . $times[$i] . '</option>';
                }

                echo '</select>';

                ?>
                <button class="aaaa" type="submit">Search</button>
                </form>

                <p class="tips"><i class="fa fa-info-circle"></i> ST = Sunday-Tuesday, MW = Monday-Wednesday. RA =
                    Thursday-Saturday</p>


        </div>
        </p>
    </div>


    </div>


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

    echo '<a style="display: block; padding: 10px 15px; background: #023d6f; color: #fff; margin-bottom: 15px; border-radius: 5px;" href="/apps/advising-assistant.php">Go back from Search <i class="fa fa-arrow-circle-o-left fa-2" style="float: right; font-size: 20px;"></i></a>';

}

if (isBot() == 1 || $islogged == 1 || $islogged == 0) {

    if (isset($_GET['course'])) {


        $term = fresh($_GET['course']);
        $sect = trim($_GET['section']);

        $timez = $_GET['days'] . ' ' . $_GET['times'];


        $searchTerms = explode(',', fresh($_GET['course']));
        $searchTermBits = array();


        foreach ($searchTerms as $term) {

            $term = trim($term);

            if (!empty($term)) {

                if (!empty($sect))

                    $searchTermBits[] = "course LIKE '%$term%' AND section = $sect";

                else if (!empty($_GET['type']))
                    $searchTermBits[] = "course LIKE '%$term%'";

                else if (!empty($timez))
                    $searchTermBits[] = "course LIKE '%$term%' AND time LIKE '%$timez%'";


            }
        }


        $idd = $db->rawQuery("SELECT * FROM advisingTBA WHERE " . implode(' OR ', $searchTermBits) . " ORDER BY id");


        $fcourse = trim($idd[0]['course']);

        if (!empty($fcourse)) {

            echo '<span class="ititle"><a href="/' . $fcourse . '">' . $fcourse . ' <i class="fa fa-external-link"></i></a></span>';

            $tableHeader = '
<div class="table_round radiustopleft">
    <table>
        <tr>
            <th>Faculty</th>
            <th>Section</th>
            <th>Time</th>
            <th>Room</th>
            <th>Seats Left</th>
        </tr>
        ';


            if (!empty($fcourse)) {

                echo $tableHeader;

                for ($i = 0; $i < sizeof($idd); $i++) {

                    $course = trim($idd[$i]['course']);

                    if ($course != $fcourse) {
                        $fcourse = trim($idd[$i]['course']);
                        echo '</table></div>';
                        echo '<span class="ititle"><a href="/' . $fcourse . '">' . $fcourse . ' <i class="fa fa-external-link"></i></a></span>';

                        echo $tableHeader;

                    }


                    $faculty = trim($idd[$i]['faculty']);


                    $section = trim($idd[$i]['section']);

                    $course = trim($course);

                    $date = $idd[$i]['time'];

                    $room = $idd[$i]['room'];
                    $capacity = $idd[$i]['capacity'];


                    echo '<tr>';
                    echo '<td><a href="/faculty/section/' . $course . '/' . $section . '">' . $faculty . '</td>';
                    echo '<td><b>' . $section . '</b></td>';
                    echo '<td>' . $date . '</td>';
                    echo '<td>' . $room . '</td>';

                    if ($capacity == 0)
                        $cfilled = 'class="cfilled"';
                    else if ($capacity < 5)
                        $cfilled = 'class="ncfilled"';
                    else
                        $cfilled = '';

                    echo '<td ' . $cfilled . '>' . $capacity . '</td>';


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

        Besides, you will need this account for upcoming new tools of NSUer.Club, such as CGPA calculator and
        Target/Desired GPA Calculator.

        <br/><br/>

        Also a new program is coming soon that will select the sections of best faculties and create few sets for you
        without any contradiction in class time. All you have to do is just enter the course initials ;)
    </div>
    <br/>
    ';


}


if (!empty($_GET['course'])) {

    echo '<a style="display: block; padding: 10px 15px; background: #023d6f; color: #fff; margin-bottom: 15px; border-radius: 5px;" href="/apps/advising-assistant.php">Go back from Search <i class="fa fa-arrow-circle-o-left fa-2" style="float: right; font-size: 20px;"></i></a>';

}
?>


    <span class="ititle" style="font-weight: normal;     padding: 0 25px;">Your Courses</span>
    <div class="tabDetails bar1" style="background: #fff;border-top-left-radius: 0px; border; padding: 20px;">


        <div class="lbody">


            <form class="sForm" action="addcourse-advising-assistant.php" method="GET">
                <p class="ititle2">Add courses with/without section</p>
                <input id="ssss" class="aa autoc disableComma" maxlength="7" style="text-transform: uppercase"
                       type="search" name="course"
                       placeholder="Enter course initial..." value="" id="cachedl">

                <select class="aaa" name="section">

                    <?php
                    for ($u = 0; $u < 100; $u++) {

                        if ($u == 0)
                            $uu = "All";
                        else
                            $uu = $u;

                        $selected = "";

                        echo '<option value="' . $u . '"' . $selected . '>' . $uu . '</option>';
                    }
                    ?>
                </select>
                <button class="aaaa" type="submit">Add</button>
            </form>

            <p id="comsug2" class="tips"><i class="fa fa-info-circle toggle-trigger"></i> Select <b>All</b> to include
                all sections of that course. </p>


            <?php


            if ($islogged == 1 || $islogged == 0 || (isset($_REQUEST['email']) && !empty($_REQUEST['email']))) {

                $userCourses = $db->rawQuery("SELECT * from AdvisingCourseList WHERE memID  = '$memberID'");


                if ($userCourses) {

                    echo '<div class="urcourse">
    
    
    
    <form action="delete-advising-assistant.php" method="GET">';


                    echo '<input type="hidden" value="' . $_REQUEST['uid'] . '">';

                    for ($i = 0; $i < count($userCourses); $i++) {

                        $course = $userCourses[$i]['course'];
                        $section = $userCourses[$i]['section'];


                        if ($section != "0")
                            $insideSection = '<span>' . trim($section) . '</span>';
                        else
                            $insideSection = '';


                        if (!empty($course))
                            echo '<button type="submit" name="course" value="' . $course . ',' . $section . '">' . $course . ' ' . $insideSection . '<i class="fa fa-times fa-1" aria-hidden="true"></i></button>';

                    }

                    echo '</form>
    </div>';
                }

            }

            ?>
        </div>
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


<?php


if ($userCourses) {

    $term = '';
    $sect = '';


    $term = fresh($_GET['course']);
    $sect = trim($_GET['section']);

    $timez = $_GET['days'] . ' ' . $_GET['times'];

    $searchTermBits = array();


    for ($i = 0; $i < count($userCourses); $i++) {


        $insideCourse = $userCourses[$i]['course'];
        $insideSection = $userCourses[$i]['section'];

        if (!empty($insideCourse)) {

            if ($insideSection != 0)

                $searchTermBits[] = "course LIKE '%$insideCourse%' AND section = $insideSection";
            else
                $searchTermBits[] = "course LIKE '%$insideCourse%'";
        }

    }


    $idd = $db->rawQuery("SELECT * FROM advisingTBA WHERE " . implode(' OR ', $searchTermBits) . " ORDER BY id");


    $fcourse = trim($idd[0]['course']);

    if (!empty($fcourse)) {

        echo '<span class="ititle"><a href="/' . $fcourse . '">' . $fcourse . ' <i class="fa fa-external-link"></i></a></span>';


        $tableHeader = '
                            <div class="table_round radiustopleft">
                                <table>
                                    <tr>
                                        <th>Faculty</th>
                                        <th>Section</th>
                                        <th>Time</th>
                                        <th>Room</th>
                                        <th>Seats Left</th>
                                    </tr>
                            ';


        if (!empty($fcourse)) {

            echo $tableHeader;

            for ($i = 0; $i < sizeof($idd); $i++) {

                $course = trim($idd[$i]['course']);

                if ($course != $fcourse) {
                    $fcourse = trim($idd[$i]['course']);
                    echo '</table></div>';
                    echo '<span class="ititle"><a href="/' . $fcourse . '">' . $fcourse . ' <i class="fa fa-external-link"></i></a></span>';

                    echo $tableHeader;

                }


                $faculty = trim($idd[$i]['faculty']);


                $section = trim($idd[$i]['section']);

                $course = trim($course);

                $date = $idd[$i]['time'];

                $room = $idd[$i]['room'];
                $capacity = $idd[$i]['capacity'];


                echo '<tr>';
                echo '<td><a href="/faculty/section/' . $course . '/' . $section . '">' . $faculty . '</td>';
                echo '<td><b>' . $section . '</b></td>';
                echo '<td>' . $date . '</td>';
                echo '<td>' . $room . '</td>';

                if ($capacity == 0)
                    $cfilled = 'class="cfilled"';
                else if ($capacity < 5)
                    $cfilled = 'class="ncfilled"';
                else
                    $cfilled = '';

                echo '<td ' . $cfilled . '>' . $capacity . '</td>';


            }


        }

        echo '</table></div><br>
    
    <br><br><br>';
    }
}


include 'foot.php';


