<?php


$dmeta = '<meta name="description" content="CGPA Analyzer helps you determine what grades per course will be needed in current semester to achieve your targeted CGPA or overcome probation."/>';


$title = 'NSU CGPA Analyzer - Calculate Targeted GPA';


$facc = "111";

$thisPage = "cana";

include '../header.php';

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
<option>1.5</option>
<option>2</option>
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
        <div class="addcontainer bar1 shadow cgpa">
            <h2>CGPA Analyzer - for NSU</h2>
            <br/>


            <script src="canvasjs.js"></script>
            <?php
            if (!isset($_POST['submit'])) {
                if ($islogged == 0 || $hasCGPA == 0)
                    echo '<div class="alert_info" id="aboxx">CGPA Analyzed data will be saved if you are logged in and you won\'t have to fill the form again. So, <a href="/login"><b>login</b></a> first is recommended.</div> ';
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


                $currentCgpa = $_REQUEST['currentCgpa'];
                $currentCreditz = $_REQUEST['currentCredit'];
                $targetCgpa = $_REQUEST['targetCgpa'];


                $cCgpa = $_REQUEST['currentCgpa'];
                $cCredit = $_REQUEST['currentCredit'];


                $cgpaHour = $currentCgpa * $currentCreditz;


                $totalCredits = 0;
                $subGrade = 0;
                $k = 0;


                for ($i = 0; $i < sizeof($credits); $i++) {
                    $k = array_search($courses[$i], $courses);
                    if (getPoint($grades[$i]) < getPoint($grades[$k]) && $credits[$i] != 0) {

                        $currentCreditz = $currentCreditz - $credits[$i];

                        $retakeHour = $credits[$i] * getPoint($grades[$i]);

                        $cgpaHour = $cgpaHour - $retakeHour;

                        $currentCgpa = $cgpaHour / $currentCreditz;

                        $currentCreditz = $currentCreditz + $credits[$i];

                        $cCredits = $currentCreditz;
                    }
                }

                $count1 = 0;

                for ($i = sizeof($credits); $i >= 0; $i--) {
                    $k = array_search($courses[$i], $courses);

                    if (getPoint($grades[$i]) > getPoint($grades[$k]) && $credits[$k] != 0) {

                        $currentCreditz = $currentCreditz - $credits[$k];

                        $retakeHour = $credits[$k] * getPoint($grades[$k]);

                        $cgpaHour = $cgpaHour - $retakeHour;

                        $currentCgpa = $cgpaHour / $currentCreditz;

                        $currentCreditz = $currentCreditz + $credits[$k];

                        $cCredits = $currentCreditz;
                    }
                }


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


                $heightCount = 0;

                for ($i = 0; $i < sizeof($credits); $i++) {

                    $subGrade += $credits[$i] * getPoint($grades[$i]);


                    $totalCredits += $credits[$i];

                    if ($credits[$i] != 0)
                        $heightCount++;
                }

                $cgpaa = $subGrade / $totalCredits;


                $cgpa = round($cgpaa, 3);


                $arrayCourses = json_encode($courses);
                $arrayCredits = json_encode($credits);
                $arrayGrades = json_encode($grades);


                $semesterCreditz = $totalCredits;

                $totalCredits += $currentCreditz;


                $expectedCgpa3 = $currentCgpa * $currentCreditz;
                $expectedCgpa1 = $subGrade + $expectedCgpa3;
                $expectedCgpa2 = $totalCredits;
                $expectedCgpa = $expectedCgpa1 / $expectedCgpa2;


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
                            'currentCredit' => $cCredit,
                            'currentCgpa' => $cCgpa,
                            'expectedCgpa' => $expectedCgpa,
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

                        $heightCount = 0;

                        $totalCredits = $userr[0]['currentCredit'];

                        $k = 0;

                        for ($i = 0; $i < sizeof($credits); $i++) {
                            $k = array_search($courses[$i], $courses);
                            if (getPoint($grades[$i]) < getPoint($grades[$k]))
                                $credits[$i] = 0;
                        }
                        for ($i = sizeof($credits); $i >= 0; $i--) {
                            $k = array_search($courses[$i], $courses);
                            if (getPoint($grades[$i]) > getPoint($grades[$k]))
                                $credits[$k] = 0;
                        }


                        for ($i = 0; $i < sizeof($credits); $i++) {

                            $subGrade += $credits[$i] * getPoint($grades[$i]);


                            $totalCredits += $credits[$i];

                            if ($credits[$i] != 0)
                                $heightCount++;
                        }


                        $targetCgpa = $userr[0]['target'];

                        $currentCreditz1 = $userr[0]['credit'];

                        $currentCgpa = $userr[0]['currentCgpa'];

                        $totalCredits += $currentCreditz1;

                        $semesterCreditz = $userr[0]['credit'];


                        $currentCreditz = json_decode($userr[0]['currentCredit']);


                        $expectedCgpa = json_decode($userr[0]['expectedCgpa']);


                        $cCgpa = json_decode($userr[0]['currentCgpa']);

                        $cCredit = json_decode($userr[0]['currentCredit']);

                        $cCredit = $totalCredits;


                    }
                }


                $achiveCgpa1 = $targetCgpa * $totalCredits;
                $achiveCgpa2 = $currentCgpa * $currentCreditz;

                $achiveCgpa3 = $achiveCgpa1 - $achiveCgpa2;

                $targetAvgCgp = $achiveCgpa3 / $semesterCreditz;

                $targetAvgGrade = getGrade($targetAvgCgp);


                ?>


                <div id="chartContainer" style="height: 200px; width: 100%;"></div>


                <br/>

                <div id="chartContainers" style="<?php


                if ($heightCount >= 8)
                    echo 'height:600px;';
                elseif ($heightCount >= 7)
                    echo 'height:550px;';
                elseif ($heightCount >= 6)
                    echo 'height:440px;';
                elseif ($heightCount >= 5)
                    echo 'height:390px;';
                elseif ($heightCount >= 4)
                    echo 'height:340px;';
                elseif ($heightCount >= 3)
                    echo 'height:280px;';
                elseif ($heightCount >= 2)
                    echo 'height:220px;';
                else
                    echo 'height:160px;';


                ?>width: 103%; margin-left: -1%"></div>

                <br/>

                <div style="clear: both"></div>
            <?php

            if ($targetAvgCgp > 4) {

                echo '<br><div class="alert_info" style="padding: 10px; text-align: center; font-size: 18px!important;">You will need another semester to achieve your targeted CGPA. You will need <font color="#123c55" style="font-weight:bold">' . round($targetAvgCgp, 2) . '</font> points per course in this semester, which is not possible.</div>';
            } else {
                echo '<br><div class="alert_info" style="padding: 10px; text-align: center; font-size: 18px!important;">You will need at least  <font color="#123c55" style="font-weight:bold">' . round($targetAvgCgp, 2) . '(' . $targetAvgGrade . ')</font> per course in this semester to achieve your targeted CGPA.</div>';
            }


            ?>


                <script>
                    window.onload = function () {

                        var optionss = {
                            animationEnabled: true,
                            title: {
                                text: "GRADES COMPARISON",
                                fontSize: 19,
                                fontColor: "#333",
                                fontWeight: "bold",
                                margin: 25,
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

                            dataPointMinWidth: 25,
                            legend: {
                                verticalAlign: "bottom",
                            },
                            legend: {
                                fontSize: 12,
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
                                            if ($credits[$i] != 0)
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
                                            if ($credits[$i] != 0)
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
                                    {label: "Your CGPA", y: <?php echo $cCgpa;?> },
                                    {label: "Expected CGPA", y: <?php echo $expectedCgpa;?>, color: "#db843d",},

                                ]
                            }]
                        };


                        $("#chartContainers").CanvasJSChart(optionss);

                        $("#chartContainer").CanvasJSChart(options);

                    }
                </script>


                <div class="headingn">EXPECTED CGPA AFTER THIS SEMESTER</div>


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
                        $gcgpa = $expectedCgpa;
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


            echo '

<form action="/cgpa-analyzer/" method="POST">


<div class="form-group courseInput">
<table>
<tbody>
<tr>
<td><p  class="sembase">Currently</p></td>
<td><input class="input45" name="currentCredit" placeholder="Credits" value="' . $cCredit . '" maxlength="16" type="text"></td>
<td><input class="input45" name="currentCgpa" placeholder="CGPA" value="' . $cCgpa . '" maxlength="16" type="text"> </td>
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

                        if ($credits[$i] == 1.5)
                            echo '<option selected="selected">1.5</option>';
                        else
                            echo '<option>1.5</option>';

                        if ($credits[$i] == 2)
                            echo '<option selected="selected">2</option>';
                        else
                            echo '<option>2</option>';


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


            <div class="tips">
                <br/>
                <ul>
                    <li>Add course initials twice with previous grades if you are retaking. Best grade will be counted
                        only and credit will be adjusted automatically.
                    </li>
                    <li>If you are on probation, set CGPA target <b>2.0</b>. Thereupon, you can easily find the minimum
                        grade/points per course in current semester to overcome your probation.
                    </li>
                </ul>
            </div>

        </div>


        </form>


        <style>

            .headingn {
                font-size: 20px;
                font-family: arial;
                color: peru;
                font-weight: bold;
                padding: 30px 10px 20px 10px;
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
            CGPA Analyzer helps you determine what grades per course will be needed in current semester to achieve your
            targeted CGPA. Just set a target for your CGPA, enter your current CGPA and courses of current semester.
            This program will analyze the data and tell you which grades will be need to achieve your goal. If you are
            on probation, this program will also tell you the minimum grades you will need to overcome your probation.
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