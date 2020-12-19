<?php


$dmeta = '<meta name="description" content="The most advanced CGPA calculator for North South University, Bangladesh. GPA calculation is followed by the Official Grading System of NSU."/>';


$title = 'NSU CGPA Calculator - Followed by North South University Grading Policy';


$facc = "111";

$thisPage = "ccal";

include '../apps/head.php';

if ($islogged == 1) {


    require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/db.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/MysqliDb.php";


    require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/func.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/pagination.class.php";


    $db = new MysqliDb($db_host, $db_user, $db_pass, $db_name);


}

if ($islogged == 1) {

    $userEmail = $_SESSION['email'];

}

if ($islogged == 1) {
    if ($db->rawQuery('SELECT id from cgpa where email = ?', Array($userEmail)))
        $hasCGPA = 1;
    else
        $hasCGPA = 0;
} else {
    $hasCGPA = 0;
}


$totalCredits = 0;

$cgpa = 0.00;

$creditz = '
<select class="nice-select" name="credit[]">
<option>3</option>
<option>1</option>
<option selected="selected">0</option>
<option>1.5</option>
<option>2</option>
<option>4</option>
</select>';

$gradez = '
<select class="nice-select" name="grade[]">
<option>A</option>
<option>A-</option>
<option>B+</option>
<option>B</option>
<option>B-</option>
<option>C+</option>
<option>C</option>
<option>C-</option>
<option>D+</option>
<option>D</option>
<option>F</option>
</select>
';

?>

<script src="/cgpa-calculator/circle.js"></script>
<div id="anaTop"></div>


<div class="lbody cgpaPage">
    <div class="addcontainer cgpa">
        <br>

        <?php
        if (!isset($_POST['submit'])) {
            if ($islogged == 0 || $hasCGPA == 0)
                echo '<div class="alert_info" id="aboxx">CGPA data will be saved if you are logged in and you won\'t have to fill the form again. So, <a href="/login"><b>login</b></a> first is recommended.</div> ';
        }
        ?>



        <?php


        function getPoint($grade)
        {
            $point = 0.0;
            if ($grade == "A")
                $point = 4.0;
            elseif ($grade == "A-")
                $point = 3.7;
            elseif ($grade == "A-")
                $point = 3.7;
            elseif ($grade == "B+")
                $point = 3.3;
            elseif ($grade == "B")
                $point = 3.0;
            elseif ($grade == "B-")
                $point = 2.7;
            elseif ($grade == "C+")
                $point = 2.3;
            elseif ($grade == "C")
                $point = 2.0;
            elseif ($grade == "C-")
                $point = 1.7;
            elseif ($grade == "D+")
                $point = 1.3;
            elseif ($grade == "D")
                $point = 1.0;
            elseif ($grade == "F")
                $point = 0.0;
            else
                $point = $grade;

            return $point;
        }


        if (isset($_REQUEST['course']) || $islogged == 1 && $hasCGPA == 1) {


            $courses = $_REQUEST['course'];
            $credits = $_REQUEST['credit'];
            $grades = $_REQUEST['grade'];


            $totalCredits = 0;

            $subGrade = 0;

            $k = 0;


            for ($i = 0; $i < sizeof($credits); $i++) {

                $k = array_search($courses[$i], $courses);
                if (getPoint($grades[$i]) < getPoint($grades[$k]) && $credits[$i] != 0)

                    $credits[$i] = 0;

            }


            for ($i = sizeof($credits); $i >= 0; $i--) {

                $k = array_search($courses[$i], $courses);
                if (getPoint($grades[$i]) > getPoint($grades[$k]) && $credits[$k] != 0)
                    $credits[$k] = 0;

            }


            for ($i = 0; $i < sizeof($credits); $i++) {


                $subGrade += $credits[$i] * getPoint($grades[$i]);

                $totalCredits += $credits[$i];


            }

            $cgpaa = $subGrade / $totalCredits;


            $cgpa = round($cgpaa, 3);


            $arrayCourses = json_encode($courses);


            $arrayCredits = json_encode($credits);


            $arrayGrades = json_encode($grades);


            if (isset($_REQUEST['course'])) {


                if ($islogged == 1) {


                    $idd = $db->rawQuery('SELECT * from cgpa where email = ?', Array($userEmail));

                    $idm = $idd[0]['id'];

                    $data = array(
                        'email' => $userEmail,
                        'courses' => $arrayCourses,
                        'credits' => $arrayCredits,
                        'grades' => $arrayGrades,
                        'cgpa' => $cgpa,
                        'credit' => $totalCredits
                    );


                    if (!$db->rawQuery('SELECT id from cgpa where email = ?', Array($userEmail))) {
                        $query = $db->insert('cgpa', $data);
                        echo '';
                    } else {

                        $db->where('id', $idm);
                        if ($db->update('cgpa', $data))
                            echo '';
                    }


                }
            }


            if (!isset($_REQUEST['submit'])) {
                if ($islogged == 1) {

                    $userr = $db->rawQuery('SELECT * from cgpa where email = ?', Array($userEmail));


                    $uid = $userr[0]['id'];


                    $courses = json_decode($userr[0]['courses']);

                    $credits = json_decode($userr[0]['credits']);

                    $grades = json_decode($userr[0]['grades']);

                    $cgpa = json_decode($userr[0]['cgpa']);

                    $totalCredits = json_decode($userr[0]['credit']);

                }
            }
        }
        ?>

        <div class="cgholder">
            <div class="circle" id="circle-c">
                <strong></strong><br>
                <p>CGPA</p>
            </div>

            <div class="circle" id="circle-b">
                <strong></strong><br>
                <p>CREDITS</p>
            </div>
        </div>

        <script>
            var progressBarOptions = {
                startAngle: -1.55,
                size: 120,
                value: 0.75,
                fill: {
                    color: '#bbdefb'
                }
            }
            $('#circle-c').circleProgress(progressBarOptions).on('circle-animation-progress', function (event, progress, stepValue) {
                $(this).find('strong').text((stepValue * 4.0).toFixed(2));
            });

            $('#circle-b').circleProgress(progressBarOptions).on('circle-animation-progress', function (event, progress, stepValue) {
                $(this).find('strong').text((stepValue * 130).toFixed(0));
            });

            $('#circle-c').circleProgress({
                value: <?php
                $gcgpa = $cgpa;
                $fcgpa = $gcgpa / 4.0;
                echo $fcgpa;
                ?>,
                fill: {
                    color: '#16a9ff'
                }
            });
            $('#circle-b').circleProgress({
                value: <?php
                $fcgpa = $totalCredits / 130;
                echo $fcgpa;
                ?>,
                fill: {
                    color: '#f3a424'
                }
            });
        </script>

        <?php


        ?>

        <div class="courseInput">

            <table id="cgpatable">
                <tr>
                    <th>Course</th>
                    <th>Credits</th>
                    <th>Grade</th>
                    <th>#</th>
                </tr>


            </table>
        </div>
        <form action="/cgpa-calculator/index-app.php" method="POST">

            <?php


            function checkg($a, $b)
            {
                if ($a == $b)
                    return ' selected="selected"';
                else
                    return false;
            }


            if (isset($_REQUEST['course']) || $islogged == 1 && $hasCGPA == 1) {

                $kjk = 0;


                for ($i = 0; $i < sizeof($credits); $i++) {

                    if ($i == 0 && is_numeric($grades[0]) && empty($courses[$i])) {

                        echo '<div class="form-group courseInput">
<table>
<tbody>
<tr>
<td><p class="sembase">Manually</p><input name="course[]" value="" type="hidden"></td>
<td><input class="input45" name="credit[]" autocomplete="off" placeholder="Credits" pattern="[0-9.]*" value="' . $credits[$i] . '" maxlength="16" type="number"></td>
<td><input class="input45" name="grade[]" autocomplete="off" placeholder="CGPA" value="' . $grades[$i] . '" maxlength="16" type="text"> </td>
<td><a href="javascript:void(0)" class="removeCourse"> <i class="fa fa-window-close bsiz"></i></a></td>
</tr></tbody></table>
</div>';
                        $kjk++;
                        continue;
                    } else {
                        if ($kjk == 0) {
                            echo '<div class="form-group courseInput">
<table>
<tbody>
<tr>
<td><p class="sembase">Manually</p><input  name="course[]" value="" type="hidden"></td>
<td><input class="input45" name="credit[]" autocomplete="off" placeholder="Credits" pattern="[0-9.]*" value="" maxlength="16" type="number"></td>
<td><input class="input45" name="grade[]" autocomplete="off"  placeholder="CGPA" value="" maxlength="16" type="text"> </td>
<td><a href="javascript:void(0)" class="removeCourse"> <i class="fa fa-window-close bsiz"></i></a></td>
</tr></tbody></table>
</div>';
                        }
                        $kjk++;
                    }

                    if (empty($courses[$i]) && $credits[$i] == 0) {

                        continue;

                    } else {

                        echo '<div class="form-group courseInput">
<table>
<tbody><tr>
<td><div class="tooltip"><input name="course[]" autocomplete="off" placeholder="Course" value="' . strtoupper($courses[$i]) . '" maxlength="16" size="16" type="text">';
                        if ($i == 1)
                            echo '<div class="tooltiptext">Adding course initial is optional, but it will help you remember next time.</div>';
                        echo '</div></td>
<td>';

                        echo '<select class="nice-select" name="credit[]">';

                        if ($credits[$i] == 3)
                            echo '<option selected="selected">3</option>';
                        else
                            echo '<option>3</option>';

                        if ($credits[$i] == 1)
                            echo '<option selected="selected">1</option>';
                        else
                            echo '<option>1</option>';

                        if ($credits[$i] == 0)
                            echo '<option selected="selected">0</option>';
                        else
                            echo '<option>0</option>';

                        if ($credits[$i] == 1.5)
                            echo '<option selected="selected">1.5</option>';
                        else
                            echo '<option>1.5</option>';

                        if ($credits[$i] == 2)
                            echo '<option selected="selected">2</option>';
                        else
                            echo '<option>2</option>';

                        if ($credits[$i] == 4)
                            echo '<option selected="selected">4</option>';
                        else
                            echo '<option>4</option>';

                        echo '</select>';

                        echo '</td><td>';

                        echo '<select class="nice-select" name="grade[]">';

                        echo '
<option' . checkg($grades[$i], 'A') . '>A</option>
<option' . checkg($grades[$i], 'A-') . '>A-</option>
<option' . checkg($grades[$i], 'B+') . '>B+</option>
<option' . checkg($grades[$i], 'B') . '>B</option>
<option' . checkg($grades[$i], 'B-') . '>B-</option>
<option' . checkg($grades[$i], 'C+') . '>C+</option>
<option' . checkg($grades[$i], 'C') . '>C</option>
<option' . checkg($grades[$i], 'C-') . '>C-</option>
<option' . checkg($grades[$i], 'D+') . '>D+</option>
<option' . checkg($grades[$i], 'D') . '>D</option>
<option' . checkg($grades[$i], 'F') . '>F</option>';

                        echo '</select>';

                        echo '</td><td><a href="javascript:void(0)" class="removeCourse"> <i class="fa fa-window-close bsiz"></i></a></td></tr></tbody></table>
</div>';

                    }
                }
            } else {


                for ($jj = 0; $jj < 4; $jj++) {

                    if ($jj == 0) {

                        echo '<div class="form-group courseInput">
<table>
<tbody>
<tr>
<td><p class="sembase">Manually</p><input name="course[]" value="" type="hidden"></td>
<td><input class="input45" name="credit[]" autocomplete="off" placeholder="Credits" pattern="[0-9.]*" value="" maxlength="16" type="number"></td>
<td><input class="input45" name="grade[]" autocomplete="off" placeholder="CGPA" value="" maxlength="16" type="text"> </td>
<td><a href="javascript:void(0)" class="removeCourse"> <i class="fa fa-window-close bsiz"></i></a></td>
</tr></tbody></table>
</div>';

                        continue;

                    }

                    echo '<div class="form-group courseInput">
<table>
<tbody><tr>
<td><div class="tooltip"><input autocomplete="off" name="course[]" placeholder="Course" value="" maxlength="16" type="text">';
                    if ($jj == 1)
                        echo '<div class="tooltiptext">Adding course initial is optional, but it will help you remember next time.</div>';
                    echo '</div></td>
<td>' . $creditz . '</td>
<td>
' . $gradez . '</td>
<td> <a href="javascript:void(0)" class="removeCourse"> <i class="fa fa-window-close bsiz"></i></a></td></tr></tbody></table>
</div>';
                }

            }


            ?>


            <a class="addCourse" href="javascript:void(0)" style="font-size: 50px; float: right;"><i
                        class="fa fa-plus-circle fa-3" aria-hidden="true"></i></a>
            <div style="clear: both; margin-bottom: 10px;"></div>

            <input type="submit" name="submit" value="Calculate CGPA">


            <div class="tips" style="padding: 15px;">
                <br/>
                <ul>
                    <li>Add course initials twice with previous grades if you've retaken. Best grade will be counted
                        only and credit will be adjusted automatically.
                    </li>
                </ul>
            </div>

    </div>


    </form>


    <div id="trtext" class="courseBackup" style="display: none;">

        <?php

        for ($jj = 0; $jj < 1; $jj++) {

            echo '<table>
<tbody><tr>
<td><input name="course[]" placeholder="Course" value="" maxlength="16" size="16" type="text"></td>
<td>' . $creditz . '</td>
<td>
' . $gradez . '</td><td>
 <a href="javascript:void(0)" class="removeCourse"> <i class="fa fa-window-close bsiz"></i></a></td></tr></tbody></table>';
        }
        ?>

    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            var maxGroup = 50;
            var minGroup = 2;
            $(".addCourse").click(function () {
                if ($('body').find('.courseInput').length < maxGroup) {
                    var fieldHTML = '<div class="form-group courseInput">' + $(".courseBackup").html() + '</div>';
                    $('body').find('.courseInput:last').after(fieldHTML);
                } else {
                    alert('Maximum ' + maxGroup + ' groups are allowed.');
                }
            });
            $("body").on("click", ".removeCourse", function () {

                if ($('body').find('.courseInput').length > minGroup) {
                    $(this).parents(".courseInput").remove();
                }
            });
        });

        setTimeout(
            function () {
                document.getElementById("aboxx").style.opacity = "0";

                setTimeout(
                    function () {
                        document.getElementById("aboxx").style.display = "none";
                    }, 300);

            }, 20000);
    </script>

    <script>
        $(document).on('blur', "input[type=text]", function () {
            $(this).val(function (_, val) {
                return val.toUpperCase();
            });
        });</script>

    <?php
    if (isset($_REQUEST['submit']))
        echo "<script>
if(screen.width<600){
   document.getElementById('anaTop').scrollIntoView();
}
</script>";
    ?>


    <div class="addcontainer bar1 shadow gradingc">
        <h2>North South University - Grading System</h2>

        <table border="1" bordercolor="#eee">
            <tbody>
            <tr>
                <th>Scores</th>
                <th>Grade</th>
                <th>Points</th>
            </tr>
            <tr>
                <td>
                    <p>93+</p>
                </td>
                <td>
                    <p>A Excellent</p>
                </td>
                <td>
                    <p>4.0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>90 - 92</p>
                </td>
                <td>
                    <p>A-</p>
                </td>
                <td>
                    <p>3.7</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>87 - 89</p>
                </td>
                <td>
                    <p>B+</p>
                </td>
                <td>
                    <p>3.3</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>83 - 86</p>
                </td>
                <td>
                    <p>B Good</p>
                </td>
                <td>
                    <p>3.0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>80 - 82</p>
                </td>
                <td>
                    <p>B-</p>
                </td>
                <td>
                    <p>2.7</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>77 - 79</p>
                </td>
                <td>
                    <p>C+</p>
                </td>
                <td>
                    <p>2.3</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>73 - 76</p>
                </td>
                <td>
                    <p>C Average</p>
                </td>
                <td>
                    <p>2.0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>70 - 72</p>
                </td>
                <td>
                    <p>C-</p>
                </td>
                <td>
                    <p>1.7</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>67 - 69</p>
                </td>
                <td>
                    <p>D+</p>
                </td>
                <td>
                    <p>1.3</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>60 - 66</p>
                </td>
                <td>
                    <p>D Poor</p>
                </td>
                <td>
                    <p>1.0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>Below 60</p>
                </td>
                <td>
                    <p>F* Failure</p>
                </td>
                <td>
                    <p>0.0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>&nbsp;</p>
                </td>
                <td>
                    <p>I** Incomplete</p>
                </td>
                <td>
                    <p>0.0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>&nbsp;</p>
                </td>
                <td>
                    <p>W** Withdrawal</p>
                </td>
                <td>
                    <p>0.0</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>&nbsp;</p>
                </td>
                <td>
                    <p>R** Retaken</p>
                </td>
                <td>
                    <p>0.0</p>
                </td>
            </tr>
            </tbody>
        </table>


    </div>


</div>
</div>

<script src="/suggestion.js"></script>

