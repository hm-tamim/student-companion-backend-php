<?php


$dmeta = '<meta name="description" content="CGPA Analyzer helps you determine what grades per course will be needed in current semester to achieve your targeted CGPA or overcome probation."/>';


$title = 'NSU CGPA Analyzer - Calculate Targeted GPA';


$facc = "111";


include '../head.php';

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
    if ($db->rawQuery('SELECT id from cgpaAnalyze where email = ?', Array($userEmail)))
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

    <div class="fac-container cgpaPage">
        <div class="main">


            <div class="lbody">
                <div class="addcontainer bar1 shadow cgpa">
                    <h2>CGPA Analyzer - for NSU</h2>

                    <script src="canvasjs.js"></script>


                    <?php


                    function getPoint($grade)
                    {
                        $point = 0.0;
                        if ($grade == "A")
                            $point = 4.0;
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


                    function getGrade($point)
                    {


                        if ($point >= 4.0)
                            $grade = "A";
                        elseif ($point >= 3.7)
                            $grade = "A-";
                        elseif ($point >= 3.3)
                            $grade = "B+";
                        elseif ($point >= 3.0)
                            $grade = "B";
                        elseif ($point >= 2.7)
                            $grade = "B-";
                        elseif ($point >= 2.3)
                            $grade = "C+";
                        elseif ($point >= 2.0)
                            $grade = "C";
                        elseif ($point >= 1.7)
                            $grade = "C-";
                        elseif ($point >= 1.3)
                            $grade = "D+";
                        elseif ($point >= 1.0)
                            $grade = "D";
                        else
                            $grade = "F";

                        return $grade;
                    }


                    if (isset($_REQUEST['course']) || $islogged == 1 && $hasCGPA == 1) {


                        $courses = $_REQUEST['course'];
                        $credits = $_REQUEST['credit'];
                        $grades = $_REQUEST['grade'];


                        $totalCredits = 0;

                        $subGrade = 0;

                        for ($i = 0; $i < sizeof($credits); $i++) {

                            $subGrade += $credits[$i] * getPoint($grades[$i]);


                            $totalCredits += $credits[$i];

                        }

                        $cgpaa = $subGrade / $totalCredits;


                        $cgpa = round($cgpaa, 3);


                        $arrayCourses = json_encode($courses);
                        $arrayCredits = json_encode($credits);
                        $arrayGrades = json_encode($grades);


                        $semesterCreditz = $totalCredits;
                        $currentCgpa = $_REQUEST['currentCgpa'];
                        $currentCreditz = $_REQUEST['currentCredit'];

                        $totalCredits += $_REQUEST['currentCredit'];

                        $targetCgpa = $_REQUEST['targetCgpa'];


                        if (isset($_REQUEST['course'])) {


                            if ($islogged == 1) {


                                $idd = $db->rawQuery('SELECT * from cgpaAnalyze where email = ?', Array($userEmail));

                                $idm = $idd[0]['id'];

                                $data = array(
                                    'email' => $userEmail,
                                    'courses' => $arrayCourses,
                                    'credits' => $arrayCredits,
                                    'grades' => $arrayGrades,
                                    'cgpa' => $cgpa,
                                    'credit' => $semesterCreditz,
                                    'target' => $targetCgpa,
                                    'currentCredit' => $currentCreditz,
                                    'currentCgpa' => $currentCgpa,
                                );


                                if (!$db->rawQuery('SELECT id from cgpaAnalyze where email = ?', Array($userEmail))) {
                                    $query = $db->insert('cgpaAnalyze', $data);
                                    echo '';
                                } else {

                                    $db->where('id', $idm);
                                    if ($db->update('cgpaAnalyze', $data))
                                        echo '';
                                }


                            }
                        }

                        if (!isset($_REQUEST['submit'])) {
                            if ($islogged == 1) {

                                $userr = $db->rawQuery('SELECT * from cgpaAnalyze where email = ?', Array($userEmail));

                                $uid = $userr[0]['id'];

                                $courses = json_decode($userr[0]['courses']);

                                $credits = json_decode($userr[0]['credits']);

                                $grades = json_decode($userr[0]['grades']);


                                $cgpa = json_decode($userr[0]['cgpa']);


                                for ($i = 0; $i < sizeof($credits); $i++) {

                                    $subGrade += $credits[$i] * getPoint($grades[$i]);


                                }


                                $totalCredits = json_decode($userr[0]['currentCredit']);


                                $targetCgpa = json_decode($userr[0]['target']);

                                $currentCreditz1 = json_decode($userr[0]['credit']);

                                $currentCgpa = json_decode($userr[0]['currentCgpa']);

                                $totalCredits += $currentCreditz1;

                                $semesterCreditz = json_decode($userr[0]['credit']);


                                $currentCreditz = json_decode($userr[0]['currentCredit']);
                            }
                        }


                        $expectedCgpa3 = $currentCgpa * $currentCreditz;
                        $expectedCgpa1 = $subGrade + $expectedCgpa3;
                        $expectedCgpa2 = $totalCredits;
                        $expectedCgpa = $expectedCgpa1 / $expectedCgpa2;


                        $achiveCgpa1 = $targetCgpa * $totalCredits;
                        $achiveCgpa2 = $currentCgpa * $currentCreditz;

                        $achiveCgpa3 = $achiveCgpa1 - $achiveCgpa2;

                        $targetAvgCgp = $achiveCgpa3 / $semesterCreditz;

                        $targetAvgGrade = getGrade($targetAvgCgp);


                        ?>


                        <div id="chartContainer" style="height: 200px; width: 100%;"></div>


                        <br/>

                        <div id="chartContainers" style="height: 270px; width: 100%;"></div>

                        <br/>
                    <?php

                    if ($targetAvgCgp > 4) {

                        echo '<br><div class="alert_info" style="padding: 10px; text-align: center; font-size: 18px!important;">You will need another semester to achieve your targeted CGPA.</div>';
                    } else {
                        echo '<br><div class="alert_info" style="padding: 10px; text-align: center; font-size: 18px!important;">You will need at least  <font color="#123c55">' . round($targetAvgCgp, 2) . '(' . $targetAvgGrade . ')</font> points per course in this semester to achieve your targeted CGPA.</div>';
                    }


                    ?>


                        <script>
                            window.onload = function () {

                                var optionss = {
                                    animationEnabled: true,
                                    title: {
                                        text: "GRADES COMPARISON",
                                        fontSize: 19,
                                        fontColor: "Peru",
                                        fontWeight: "bold",
                                        margin: 20,
                                    },
                                    axisY: {
                                        valueFormatString: " ",
                                        interval: 1,
                                        minimum: 0,
                                        maximum: 4,
                                        gridThickness: 0
                                    },
                                    axisX: {
                                        labelFontSize: 15,
                                        labelFontColor: "black",

                                    },
                                    dataPointMaxWidth: 40,
                                    legend: {
                                        verticalAlign: "bottom",
                                    },
                                    data: [

                                        {
                                            indexLabelFontSize: 14,

                                            showInLegend: true,
                                            name: "Minimum Grades for Target",
                                            toolTipContent: "<span style=\"color:#333\">{indexLabel} Grade (Required to Achieve Target)</span>",
                                            indexLabelPlacement: "inside",
                                            indexLabelFontColor: "white",
                                            type: "bar",
                                            dataPoints: [

                                                <?php

                                                for ($i = 0; $i < sizeof($credits); $i++) {
                                                    echo '{ y: ' . $targetAvgCgp . ', label: "' . strtoupper($courses[$i]) . '", indexLabel: "' . $targetAvgGrade . '", color:"#599AD3", },';

                                                }
                                                ?>

                                            ]
                                        },

                                        {
                                            indexLabelFontSize: 14,

                                            showInLegend: true,
                                            name: "Your Expected Grades",
                                            toolTipContent: "<span style=\"color:#333\">{indexLabel} Grade (Your Expectation)</span>",
                                            indexLabelPlacement: "inside",
                                            indexLabelFontColor: "white",
                                            type: "bar",
                                            dataPoints: [

                                                <?php

                                                for ($i = 0; $i < sizeof($credits); $i++) {

                                                    echo '{ y: ' . getPoint($grades[$i]) . ', label: "' . strtoupper($courses[$i]) . '", indexLabel: "' . $grades[$i] . '", color: "#db843d", },';


                                                }

                                                ?>

                                            ]
                                        },]
                                };

                                var options = {
                                    animationEnabled: true,
                                    title: {
                                        text: ""
                                    },
                                    axisY: {

                                        interval: 0.5,
                                        minimum: 1,
                                        maximum: 4,
                                        labelFontSize: 13,
                                        gridColor: "#ddd",

                                    },

                                    axisX: {

                                        labelFontSize: 14,
                                        gridColor: "#ddd",
                                        labelAngle: 0,
                                        labelWrap: true,

                                    },
                                    data: [{
                                        type: "column",
                                        indexLabelPlacement: "inside",
                                        indexLabelFontColor: "white",
                                        indexLabelFontWeight: 600,
                                        yValueFormatString: "#.#0",
                                        indexLabel: "{y}",
                                        indexLabelFontSize: 15,
                                        dataPoints: [
                                            {label: "Total CGPA", y: 4.0},
                                            {label: "Target CGPA", y: <?php echo $targetCgpa;?>, color: "#269ea9"},
                                            {label: "Your CGPA", y: <?php echo $currentCgpa;?> },
                                            {label: "Expected CGPA", y: <?php echo $expectedCgpa;?>, color: "#db843d",},

                                        ]
                                    }]
                                };


                                $("#chartContainers").CanvasJSChart(optionss);

                                $("#chartContainer").CanvasJSChart(options);

                            }
                        </script>


                        <div class="headingn">ONLY CURRENT SEMESTER'S EXPECTED CGPA</div>


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


                    <?php


                    if (isset($_REQUEST['submit'])) {


// echo 'Target CGPA: '.$_REQUEST['targetcgpa'];


                    }


                    ?>


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
                                $fcgpa = $semesterCreditz / 124;
                                echo $fcgpa;
                                ?>,
                                fill: {
                                    color: '#f3a424'
                                }
                            });
                        </script>

                        <?php


                    }


                    echo '

<form action="/cgpa-analyzer/" method="POST">


<div class="form-group courseInput">
<table>
<tbody>
<tr>
<td><p  class="sembase">Currently</p></td>
<td><input class="input45" name="currentCredit" placeholder="Credits" value="' . $currentCreditz . '" maxlength="16" type="text"></td>
<td><input class="input45" name="currentCgpa" placeholder="CGPA" value="' . $currentCgpa . '" maxlength="16" type="text"> </td>
<td><a href="javascript:void(0)" class="removeCouse"> <i class="fa fa-window-close bsiz" style="color: white;"></i></a></td>
</tr>

<tr>
<td><p  class="sembase">Target CGPA</p></td>
<td colspan="2"><input class="tgcg" name="targetCgpa" placeholder="CGPA" value="' . $targetCgpa . '" maxlength="16" type="text"> </td>
<td><a href="javascript:void(0)" class="removeCoure"> <i class="fa fa-window-close bsiz" style="color: white;"></i></a></td>
</tr>

</tbody></table>
</div>';


                    ?>


                    <div class="courseInput">


                        <div class="headingn">CURRENT SEMESTER's</div>


                        <table id="cgpatable">
                            <tr>
                                <th>Course</th>
                                <th>Credits</th>
                                <th>Expected Grade</th>
                                <th>#</th>
                            </tr>


                        </table>
                    </div>

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


                            if (empty($courses[$i]) && $credits[$i] == 0) {

                                continue;

                            } else {

                                echo '<div class="form-group courseInput">
<table>
<tbody><tr>
<td><input name="course[]" placeholder="Course" value="' . strtoupper($courses[$i]) . '" maxlength="16" size="16" type="text"></td>
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


                        for ($jj = 0; $jj < 3; $jj++) {


                            echo '<div class="form-group courseInput">
<table>
<tbody><tr>
<td><input name="course[]" placeholder="Course" value="" maxlength="16" type="text"></td>
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

                    <input type="submit" name="submit" value="ANALYZE CGPA">
                </div>


                </form>


                <style>

                    .headingn {
                        font-size: 20px;
                        font-family: arial;
                        color: peru;
                        font-weight: bold;
                        padding: 30px 10px 30px 10px;
                        text-align: center;

                    }

                    .canvasjs-chart-credit {
                        display: none !important;

                    }

                    .tgcg {

                        max-width: 248px !important;
                    }

                    .semArrow {
                        position: relative;
                        background: #88b7d5;
                        border: 2px solid #7baac8;
                        border-radius: 3px;
                        color: #fff;
                        text-align: center;
                        padding: 10px;
                        font-weight: bold;
                        margin-top: 10px;
                        margin-bottom: 10px;
                        height: 42px;
                    }

                    .semArrow:after, .semArrow:before {
                        top: 100%;
                        left: 45%;
                        border: solid transparent;
                        content: " ";
                        height: 0;
                        width: 0;
                        position: absolute;
                        pointer-events: none;
                    }

                    .semArrow:after {
                        border-color: rgba(136, 183, 213, 0);
                        border-top-color: #88b7d5;
                        border-width: 15px;

                    }

                    .semArrow:before {
                        border-color: rgba(194, 225, 245, 0);
                        border-top-color: #7baac8;
                        border-width: 18px;
                        margin-left: -3px;

                    }

                </style>


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
                    CGPA Analyzer helps you determine what grades per course will be needed in current semester to
                    achieve your targeted CGPA. Just set a target for your CGPA, enter your current CGPA and courses of
                    current semester. This program will analyze the data and tell you which grades will be need to
                    achieve your goal. If you are on probation, this program will also tell you the minimum grades you
                    will need to overcome your probation.
                </div>

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

        <div class="sidebar">
<?php

include '../addcoursebar.php';

echo '
</div>
<div style="clear: both"></div>
</div>';

include '../foot.php';

?>