<?php


$dmeta = '<meta name="description" content="The Most advanced CGPA calculator for North South University Bangladesh. The CGPA calculation is followed by the Official Grading System of NSU."/>';


$title = 'NSU CGPA Calculator - Followed by North South University Grading Policy';


$facc = "111";


include '../head.php';


if ($islogged == 1) {


    require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/db.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/MysqliDb.php";


    require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/func.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/pagination.class.php";


    $db = new MysqliDb($db_host, $db_user, $db_pass, $db_name);


}

$userEmail = $_SESSION['email'];

echo $userEmail;

$creditz = '
<select class="nice-select" name="credit[]">
<option>3</option>
<option>1</option>
<option selected="selected">0</option>
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

    <div class="fac-container">
        <div class="main">


            <div class="lbody">
                <div class="addcontainer bar1 shadow cgpa">
                    <h2>CGPA Calculator - for NSU</h2>


                    <?php


                    if (isset($_REQUEST['course'])) {


                        $courses = $_REQUEST['course'];
                        $credits = $_REQUEST['credit'];
                        $grades = $_REQUEST['grade'];


                        if (is_numeric($grades[0])) {
//array_unshift($courses, "semester");
                        }


                        $arrayCourses = json_encode($courses);


                        $arrayCredits = json_encode($credits);


                        $arrayGrades = json_encode($grades);


                        if (isset($_REQUEST['course'])) {


                            if ($islogged == 1) {

                                $idd = $db->rawQuery('SELECT id from cgpa where email = ?', Array($userEmail));


                                $data = array(
                                    'email' => $userEmail,
                                    'courses' => $arrayCourse,
                                    'credits' => $arrayCredits,
                                    'grades' => $arrayGrades,

                                );


                                if (!$db->rawQuery('SELECT id from cgpa where email = ?', Array($userEmail))) {
                                    $query = $db->insert('cgpa', $data);
                                    echo '<br/><div><b>Course Added</b></div>';
                                } else {

                                    $db->where('id', $idd);
                                    if ($db->update('cgpa', $data))
                                        echo '<br/><div><b>Course Added</b></div>';
                                }


                            }


                        }

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


                        $totalCredits = 0;

                        $subGrade = 0;

                        for ($i = 0; $i < sizeof($credits); $i++) {

                            $subGrade += $credits[$i] * getPoint($grades[$i]);


                            $totalCredits += $credits[$i];

                        }

                        $cgpa = $subGrade / $totalCredits;

//echo 'Total credit: '.$totalCredits.'<br><br>';

//echo 'CGPA: '.$cgpa;


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

                        <style>
                            .cgholder {

                                display: block;

                                margin-auto;
                                text-align: center;
                                margin-left: -15px;
                            }

                            .circle {
                                width: 100px;
                                margin: 6px 20px 20px;
                                position: relative;
                                text-align: center;
                                vertical-align: top;
                                display: inline-block;
                            }

                            .circle strong {
                                position: absolute;
                                top: 28px;
                                left: 10px;
                                width: 100%;
                                text-align: center;
                                line-height: 45px;
                                font-size: 30px;
                            }

                            .circle p {
                                position: absolute;
                                top: 70px;
                                left: 10px;
                                width: 100%;
                                text-align: center;
                                color: #555;
                            }

                            @media screen and (min-width: 500px) {

                                .circle {
                                    width: 170px;
                                }

                                .circle strong {
                                    left: -1px;
                                }

                                .circle p {
                                    left: 0px;
                                }

                                .cgholder {
                                    margin-top: 20px;
                                }
                            }
                        </style>

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
                                $(this).find('strong').text((stepValue * 124).toFixed(0));
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


                                $fcgpa = $totalCredits / 124;

                                echo $fcgpa;
                                ?>,
                                fill: {
                                    color: '#f3a424'
                                }
                            });


                        </script>

                        <?php


                    }

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
                    <form action="/cgpa-calculator/" method="POST">

                        <?php


                        function checkg($a, $b)
                        {
                            if ($a == $b)
                                return ' selected="selected"';
                            else
                                return false;
                        }


                        if (isset($_REQUEST['course'])) {


                            for ($i = 0; $i < sizeof($credits); $i++) {

                                if ($i == 0 && is_numeric($grades[0]) && empty($courses[$i])) {

                                    echo '<div class="form-group courseInput">
<table>
<tbody>
<tr>
<td><p  class="sembase">Semester</p><input name="course[]" value="" type="hidden"></td>
<td><input class="input45" name="credit[]" placeholder="Credits" value="' . $credits[$i] . '" maxlength="16" type="text"></td>
<td><input class="input45" name="grade[]" placeholder="CGPA" value="' . $grades[$i] . '" maxlength="16" type="text"> </td>
<td><a href="javascript:void(0)" class="removeCourse"> <i class="fa fa-window-close bsiz"></i></a></td>
</tr></tbody></table>
</div>';

                                    continue;

                                }

                                if (empty($courses[$i]) && $credits[$i] == 0) {

                                    continue;

                                    echo '<input value="' . $courses[$i] . '">';

                                } else {

                                    echo '<div class="form-group courseInput">
<table>
<tbody><tr>
<td><input name="course[]" placeholder="Optional" value="' . $courses[$i] . '" maxlength="16" size="16" type="text"></td>
<td>';

                                    echo '<select class="nice-select" name="credit[]">';

                                    if ($credits[$i] == 3)
                                        echo '<option selected="selected">3</option>';
                                    else
                                        echo '<option>3</option>';

                                    if ($credits[$i] == 1)
                                        echo '<option selected="selected">3</option>';
                                    else
                                        echo '<option>1</option>';

                                    if ($credits[$i] == 0)
                                        echo '<option selected="selected">0</option>';
                                    else
                                        echo '<option>0</option>';

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
<td><p class="sembase">Semester</p><input name="course[]" value="" type="hidden"></td>
<td><input class="input45" name="credit[]" placeholder="Credits" value="" maxlength="16" type="text"></td>
<td><input class="input45" name="grade[]" placeholder="CGPA" value="" maxlength="16" type="text"> </td>
<td><a href="javascript:void(0)" class="removeCourse"> <i class="fa fa-window-close bsiz"></i></a></td>
</tr></tbody></table>
</div>';

                                    continue;

                                }

                                echo '<div class="form-group courseInput">
<table>
<tbody><tr>
<td><input name="course[]" placeholder="Optional" value="" maxlength="16" type="text"></td>
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

                        <input type="submit" value="Calculate CGPA">
                </div>


                </form>


                <style>


                    .sembase {

                        text-align: center;
                        box-shadow: inset 0 1px 5px rgba(11, 11, 11, 0.13);
                        display: block;
                        width: 100%;
                        border: 1px solid #ddd;
                        border-radius: 3px;
                        background: #fff5af;
                        height: 42px;
                        padding-top: 11px;
                        box-sizing: border-box;
                        margin: auto;
                        font-weight: bold;
                        color: #444;
                        font-size: 15px;
                    }

                    .input45 {
                        max-width: 80px !important;
                        min-width: 60px !important;

                    }

                    select {
                        max-width: 80px !important;
                        min-width: 60px !important;

                    }

                    @media screen and (min-width: 500px) {
                        .input45 {
                            max-width: 80px !important;
                            min-width: 80px !important;

                        }

                        select {
                            max-width: 80px !important;
                            min-width: 80px !important;

                        }

                        .nice-select {

                            padding-right: 0px !important;
                        }
                    }

                    .cgpa input {
                        height: 42px;
                        padding-left: 8px;
                        padding-right: 6px;
                        box-sizing: border-box;
                        margin: auto;
                        padding-top: 5px;
                        padding-bottom: 5px;
                    }

                    .input45 {
                        padding-left: 6px !important;
                        text-align: center;
                    }

                    .cgpa select {
                        margin: auto;

                    }

                    .cgpa input[type="submit"], .cgpa input[type="button"] {
                        height: 54px;
                    }

                    .cgpa tr td {

                        padding-top: 10px !important;
                        padding-bottom: 10px !important;
                        white-space: nowrap;
                    }

                    tr {
                        white-space: nowrap;
                    }

                    tr td {
                        width: auto;
                        text-align: center;
                        white-space: nowrap;
                    }

                    tr td:first-child {
                        width: 36%;
                        border-right: 0px solid #ddd;
                    }

                    tr td:nth-child(3) {
                        width: auto !important;
                    }

                    .nice-select {
                        -webkit-tap-highlight-color: transparent;
                        background-color: #fff;
                        border-radius: 5px;
                        border: solid 1px #e0e7ee;
                        box-sizing: border-box;
                        clear: both;
                        cursor: pointer;
                        font-family: inherit;
                        font-size: 14px;
                        font-weight: normal;
                        height: 42px;
                        line-height: 40px;
                        outline: none;
                        padding-left: 18px;
                        padding-right: 30px;
                        position: relative;
                        text-align: left !important;
                        transition: all 0.2s ease-in-out;
                        user-select: none;
                        white-space: nowrap;
                        width: auto;
                    }

                    .nice-select option {
                        border-radius: 3px;
                        background-color: #eee;
                        color: #333;
                    }

                    h2 {
                        font-size: 15px;
                        font-weight: 900;
                        color: #444;
                        margin: -3px 0 1px;
                        padding: 7px;
                        border-bottom: 4px solid #e9e9e9;
                        border-bottom-style: double;
                        box-shadow: 0 1px 0 #fcfaf6;
                        text-transform: uppercase;
                        margin-bottom: 12px;
                        padding-bottom: 15px;
                    }

                    @media screen and (max-width: 500px) {
                        tr td:first-child {
                            width: 45% !important;
                            border-right: 0px solid #ddd;
                            padding-left: 5px;
                        }

                        .nice-select {

                            padding-right: 0px;

                        }

                    }

                    .bsiz {
                        font-size: 20px;
                        color: #cc4d4d;
                    }

                    .removeCourse {
                        margin-left: 5px;

                    }

                    .gradingc tr td:first-child {
                        width: 30% !important;
                    }

                    .gradingc tr td:nth-child(3) {
                        width: 30% !important;
                        padding-left: 10px;
                    }

                    .gradingc tr td:last-child {
                        width: 5% !important;

                    }
                </style>


                <div id="trtext" class="courseBackup" style="display: none;">

                    <?php

                    for ($jj = 0; $jj < 1; $jj++) {

                        echo '<table>
<tbody><tr>
<td><input name="course[]" placeholder="Optional" value="" maxlength="16" size="16" type="text"></td>
<td>' . $creditz . '</td>
<td>
' . $gradez . '</td><td>
 <a href="javascript:void(0)" class="removeCourse"> <i class="fa fa-window-close bsiz"></i></a></td></tr></tbody></table>';
                    }
                    ?>

                </div>

                <script type="text/javascript">
                    $(document).ready(function () {
                        var maxGroup = 25;
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
                </script>

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


                <div class="addcontainer bar1 shadow gradingc">
                    The most advanced CGPA calculator for North South University, Bangladesh. CGPA calculation is
                    followed by the official grading system of NSU. You can calculate your CGPA just by entering the
                    credits and grades. If you are a registered user then CGPA data will be saved on your account, so
                    that you won't have to enter the grades again in future.
                </div>


            </div>
        </div>

        <div class="sidebar">
<?php

include '../addcoursebar.php';

echo '
</div>
<div style="clear: both"></div>
</div>';

include '../foot.php';

?>