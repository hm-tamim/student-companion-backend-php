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


if (isset($_GET['faculty']) && !empty($_GET['faculty']))
    $showFac = true;
else
    $showFac = false;


$facData = $db->rawQuery("SELECT * FROM facultyDatabase WHERE LOWER(initial) = LOWER('$ttl2')");


if (!facData)
    $showFac = false;


$facName2 = $facData[0]['name'];
$facEmail = $facData[0]['email'];
$facImage = $facData[0]['image'];
$facRank = $facData[0]['rank'];
$facOffice = $facData[0]['office'];
$facPhone = $facData[0]['phone'];
$facExt = $facData[0]['ext'];

$dept = $facData[0]['dept'];


if (empty($facName2)) {
    $facName = "";
    $showFac = false;
} else
    $facName = "(" . $facName2 . ")";


$dmeta = '<meta name="description" content="' . $ttl2 . ' ' . $facName . ' faculty section, class time for ' . $ttl . ' course in North South University(NSU)"/>';


if (!empty($_GET['course'])) {
    if (empty($ttl2))
        $ttl2 = $_GET['section'];


    $title = $ttl2 . ' ' . $facName . ' - Section, Class Time for ' . $ttl . ' Course';
} else
    $title = 'Predict faculty initials by searching with section';


$thisPage = "faculp";

include '../head.php';


if ($islogged == 1)
    $userEmail = trim($_SESSION['email']);


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


        $getFaculty = fresh($_GET['faculty']);
        $getSection = fresh($_GET['section']);
        $getCourse = strtoupper(fresh($_GET['course']));


        if (preg_match('(CSE225|BIO103|MAT120|ECOO101|PHY107|BEN205)', strtoupper($term)) === 0) {
        } else {


            if (preg_match('(hmtamim7@gmail.com|sultanafahima16@gmail.com)', $userEmail) === 0) {
// $getCourse = "jhj";
            }
        }


        if (!empty($_GET['section'])) {

            $idd = $db->rawQuery("SELECT * FROM advisingTBA_predictor WHERE course = '$getCourse' AND section = '$getSection' ORDER BY id");


            $advisingDate = $idd[0]['time'];


            $idd = $db->rawQuery("SELECT * FROM advising_archive WHERE course = '$getCourse' AND time LIKE '%$advisingDate%' ORDER BY id");


        } else {


            $idd = $db->rawQuery("SELECT * FROM advising_archive WHERE course = '$getCourse' AND faculty = '$getFaculty' ORDER BY id");


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


            $idd = $db->rawQuery("SELECT * FROM advisingTBA_predictor  WHERE " . implode(' OR ', $searchTermBits) . " ORDER BY id");


        }


        if (empty($_GET['section'])) {

            $getSec = $db->rawQuery("SELECT section FROM advising_archive WHERE faculty LIKE '%$getFaculty%' AND course = '$getCourse'");

            $sections = "";

            for ($i = 0; $i < count($getSec); $i++) {

                $sections .= $getSec[$i]['section'] . ',';

            }

        }


        $course = $idd[0]['course'];

        $faculty = $staticFaculty;

        $section = $getSection;


        if (!empty($course)) {


            echo '
<p class="ititle">Possibilities:</p>';

            echo '<span class="ititle4"><a href="/' . $course . '">' . $course . ' <i class="fa fa-external-link"></i></a></span>';


            echo '<div class="table_round"><table>
<tr>
<th>Faculty</th>
<th>Section</th>
<th>Time</th>
<th>Prev Sections</th>
<th>Prev Sem, year</th>
</tr>';


            for ($k = 0; $k < sizeof($idd); $k++) {


                $course = $idd[$k]['course'];

                if (!empty($_GET['section']))
                    $faculty = $idd[$k]['faculty'];


                $date = $idd[$k]['time'];


                if (empty($_GET['section']))
                    $section = $idd[$k]['section'];


                echo '<tr>';
                echo '
<td>' . $faculty . '</td>';
                echo '
<td><b>' . $section . '</b></td>';
                echo '
<td>' . $date . '</td>';


                echo '<td>';


                if (empty($_GET['section'])) {

                    $getSec = explode(",", $sections);

                    for ($i = 0; $i < count($getSec); $i++) {


                        if ($getSec[$i] == $section)
                            echo '<b style="background: #d83d38; color: #fff; border-radius: 4px; padding: 3px 5px;">' . $getSec[$i] . '</b>';
                        else
                            echo $getSec[$i];


                        if ($i != count($getSec) - 1)
                            echo ", ";

                    }


                } else {

                    $getSec = $db->rawQuery("SELECT section FROM advising_archive WHERE faculty LIKE '%$faculty%' AND course = '$getCourse'");

                    $sections = array();

                    for ($i = 0; $i < count($getSec); $i++) {


                        if (!in_array($getSec[$i]['section'], $sections)) {
                            $sections[] = $getSec[$i]['section'];

                            if ($getSec[$i]['section'] == $getSection)
                                echo '<b style="background: #d83d38; color: #fff; border-radius: 4px; padding: 3px 5px;">' . $getSec[$i]['section'] . '</b>';
                            else
                                echo $getSec[$i]['section'];


                            if ($i != count($getSec) - 1)
                                echo ", ";


                        }

                    }
                }


                echo '</td>';


                echo '<td>';
                echo $idd[$k]['semester'] . " " . $idd[$k]['year'];
                echo '</td>';


                echo '</tr>';


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


switch ($dept) {

    case "6":
        $facImageURL = "http://institutions.northsouth.edu/cee/" . $facImage;
        break;
    case "16":
        $facImageURL = "http://ece.northsouth.edu/wp-content/" . $facImage;
        break;
    default:
        $facImageURL = "http://www.northsouth.edu/" . $facImage;
}

if (empty($facImage))
    $facImageURL = "/images/app-icons/default_user_pic.png";


$dept2 = "";

switch ($dept) {

    case "1":
        $dept2 = "Department Of Accounting & Finance";
        break;
    case "2":
        $dept2 = "Department Of Economics";
        break;
    case "3":
        $dept2 = "Department Of Management";
        break;
    case "4":
        $dept2 = "Dept Of Marketing & International Business";
        break;
    case "5":
        $dept2 = "Department Of Architecture";
        break;
    case "6":
        $dept2 = "Dept Of Civil and Environmental Engineering";
        break;
    case "7":
        $dept2 = "Department Of Mathematics & Physics";
        break;
    case "8":
        $dept2 = "Department Of English & Modern Languages";
        break;
    case "9":
        $dept2 = "Department Of Political Science & Sociology";
        break;
    case "10":
        $dept2 = "Department Of Law";
        break;
    case "11":
        $dept2 = "Department Of History & Philosophy";
        break;
    case "12":
        $dept2 = "Department Of Biochemistry & Microbiology";
        break;
    case "13":
        $dept2 = "Dept Of Environmental Science & Management";
        break;
    case "14":
        $dept2 = "Department Of Pharmaceutical Sciences";
        break;
    case "15":
        $dept2 = "Department Of Public Health";
        break;
    case "16":
        $dept2 = "Dept Of Electrical & Computer Engineering";
        break;

}


?>

    </div>
    <div class="sidebar">

        <?php if ($showFac) {

            ?>

            <div class="addcontainer bar1 shadow facProfileHolder"
                 style="height: auto!important;max-height: auto!important; min-height: auto!important;">
                <h2>Faculty Info</h2>

                <div class="facImage"><img src="<?php echo $facImageURL; ?>"></div>

                <h3><?php echo $facName2; ?></h3>


                <div class="faculty_contact">
                    <div class="faculty_email"><img src="/images/app-icons/message_win.svg" alt="Email Address"> <a
                                href="mailto:<?php echo $facEmail; ?>"><?php echo $facEmail; ?></a></div>

                    <div class="faculty_phone"><img src="/images/app-icons/phone_win.svg" alt="Phone Number"> <a
                                href="tel:<?php echo $facPhone; ?>"><?php echo $facPhone; ?></a> Ext
                        - <?php echo $facExt; ?></div>

                    <div class="faculty_office"><img src="/images/app-icons/marker_win.svg"
                                                     alt="Office Number"> <?php echo $facOffice ?></div>
                    <div class="faculty_dept"><img src="/images/app-icons/university_win.svg" "Department
                        Name"> <?php echo $dept2; ?></div>
                </div>


            </div>

            <?php

        }


        if (isset($_GET['course']) && !empty($_GET['course'])) {


            $course = strtoupper($_GET['course']);

            $id2 = $db->rawQuery("SELECT * FROM books WHERE course = '$course' ORDER BY course");


            for ($i = 0; $i < sizeof($id2); $i++) {


                $books = json_decode($id2[$i]['books']);


                echo '<span class="ititle4">Books</span>';
                echo '
<div class="booklist">
<div class="table_round" style=" background: #fff; color: #333; font-weight: bold; margin-bottom: 18px"> 
' . $id2[$i]['course'] . ' - ' . $books->courseName . ' 
</div>
<ul>

';

                foreach ($books->books as $book) {

                    echo '<li>';

                    echo '<a rel="nofollow" href="/books/download/' . $book->link . '">' . $book->name . '</a>';

                    echo '</li>';
                }

                echo '</ul></div>';


            }


        }


        ?>


        <style>

            .booklist {

                background: #fff;
                border-radius: 3px;

                min-height: 135px;
                border: 1px solid #e9e9e9;
                padding: 15px;
                border-top: 2px solid #428bca !important;
                border-spacing: 0;
                border-top-left-radius: 0px !important;
                margin-bottom: 10px;
                margin-top: -2px;
            }

            .booklist li {
                color: #232323;
                padding-top: 10px;
                padding-bottom: 10px;
                font-size: 15px;
                background: #f9f1f1;
                border-radius: 5px;
                padding-left: 15px;
                margin-bottom: 6px;
                margin-top: 8px;
                padding-right: 15px;
            }

            .booklist li:before {
                content: "\f02d"; /* FontAwesome Unicode */
                font-family: FontAwesome;
                font-size: 20px;
                display: inline-block;
                margin-left: -50px;
                width: 50px;
                margin-top: -5px;

            }

            .booklist ul {
                list-style: none;
                padding-left: 40px;

            }

            .facProfileHolder h3 {
                text-align: center;
                margin-top: 10px;
                margin-bottom: 20px;

            }

            .faculty_contact img {

                filter: invert(0.6) sepia(3) saturate(2) hue-rotate(150deg);
                width: 20px;
                margin-bottom: -5px;
            }

            .faculty_contact div {
                margin-top: 10px;
                font-size: 15px;

            }

            .facImage img {
                max-width: 100%;
                object-fit: cover;
                height: 100%;
                min-width: 100%;
                position: relative;
            }

            .facImage {

                width: 150px;
                height: 150px;
                border-radius: 50%;
                overflow: hidden;
                margin: auto;
            }
        </style>


        <div class="addcontainer bar1 shadow"
             style="height: auto!important;max-height: auto!important; min-height: auto!important;">
            Please bookmark the URL and try it later if doesn't work. Sometimes server gets down due to too many
            requests. Hope you all understand.
        </div>


        <div class="addcontainer bar1 shadow">
            <h2>Disclaimer</h2>
            Faculty Predictor is a program that learns from previous few "Offered Courses" data and estimates the
            faculty initials by matching with the Course name, Time, Room and more. It's just to help you to guess the
            faculty, NSUer.Club is not responsible if section does not match with the predicted faculty after NSU
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

        @media screen and (max-width: 500px) {
            .table_round td:last-child, .table_round th:last-child {
                border-right: 0px solid #ddd;
                max-width: 60px !important;

            }
        }

        .table_round td:first-child, .table_round th:first-child {

            max-width: 60px !important;

        }

        .table_round td:nth-child(2), .table_round th:nth-child(2) {
            max-width: 40px !important;

        }

        .table_round {

            border-top-left-radius: 0px !important;
    </style>

    <div style="clear: both"></div>

    </div>


<?php
include '../foot.php';

?>