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

include '../apps/head.php';


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

    html {

        margin-left: 15px;
        margin-right: 15px;
        margin-top: 15px;
    }
</style>

<div class="lbody">
    <form class="sForm" action="/faculty/index-app.php" method="GET">


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
?>

</div>
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


