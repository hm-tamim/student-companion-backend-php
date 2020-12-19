<?php

include 'includes/func.php';
include 'header.php';


$totalUniversities = $db->rawQuery("SELECT * FROM universities");
$totalFaculties = $db->rawQuery("SELECT * FROM facultydatabase");
$total_people = $db->rawQuery("SELECT * FROM members");
$totalDonors = $db->rawQuery("SELECT * FROM members WHERE bgroup IS NOT NULL");


$totalFaculties = count($totalFaculties);
$totalUniversities = count($totalUniversities);
$total_people = count($total_people);
$totalDonors = count($totalDonors);


$bloodDonors = $db->rawQuery("SELECT bgroup, count(*) as donorCount FROM members WHERE bgroup IS NOT NULL GROUP BY bgroup");
$bloodDonorMax = 0;
foreach ($bloodDonors as $item) {
    if ($item["donorCount"] > $bloodDonorMax)
        $bloodDonorMax = $item["donorCount"];
}

$bloodRequest = $db->rawQuery("SELECT * FROM blood_requests ORDER BY date DESC LIMIT 30");

$recentUsers = $db->rawQuery("SELECT members.*, universities.name as universityName FROM members, universities WHERE members.university = universities.id ORDER BY memberId DESC LIMIT 30");

$universityStudents = $db->rawQuery("SELECT universities.name, members.university as id, count(memberId) as studentCount FROM universities, members GROUP BY members.university");


?>


    <div class="content">


        <div class="stats">

            <div class="stats-box">
                <div class="stats-box-inside">
                    <h6>Members</h6>
                    <h2><?php echo $total_people; ?></h2>
                    <i class="far fa-user-friends"></i>
                </div>
            </div>

            <div class="stats-box">
                <div class="stats-box-inside">
                    <h6>Universities</h6>
                    <h2><?php echo $totalUniversities; ?></h2>
                    <i class="far fa-map-marker-alt"></i>

                </div>
            </div>
            <div class="stats-box">
                <div class="stats-box-inside">
                    <h6>Teachers</h6>
                    <h2><?php echo $totalFaculties; ?></h2>
                    <i class="far fa-users-crown"></i>
                </div>
            </div>

            <div class="stats-box">
                <div class="stats-box-inside">
                    <h6>Blood Donors</h6>
                    <h2><?php echo $totalDonors; ?></h2>
                    <i class="far fa-tint"></i>
                </div>
            </div>


        </div>


        <div class="single-line">
            <div class="left">
                <div class="brd c-left">
                    <p>Donors Breakdown</p> <br>
                    <div id="chartContainer" style="height: 300px;"></div>
                </div>
            </div>

            <div class="right">
                <div class="brd c-left">
                    <p>University Students</p><br>
                    <div id="chartContainerPie" style="height: 300px;"></div>
                </div>
            </div>
        </div>


        <div class="single-line list-holder">
            <div class="one">
                <div class="brd c-left">
                    <p>Recent users</p> <br>
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>University</th>
                        </tr>

                        <?php
                        foreach ($recentUsers as $sp) {
                            echo '<tr> <td> ' . $sp['username'] . '</td> <td> ' . $sp['email'] . '</td> <td> ' . $sp['universityName'] . '</td></tr>';
                        }

                        ?>

                    </table>

                </div>
            </div>

            <div class="two">
                <div class="brd c-left">
                    <p>Recent Blood Request</p><br>

                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Blood Group</th>
                            <th>Bags</th>
                            <th>Time</th>
                        </tr>

                        <?php
                        foreach ($bloodRequest as $sp) {
                            echo '<tr> <td> ' . $sp['name'] . '</td> <td> ' . getBloodGroup($sp['bgroup']) . '</td> <td> ' . $sp['bags'] . '</td>  <td> ' . humanTiming($sp['date']) . '</td></tr>';
                        }
                        ?>

                    </table>


                </div>
            </div>
        </div>


    </div>

    </div>


    </div>


    <script>


        var options = {
            animationEnabled: true,
            title: {
                text: ""
            },
            axisY: {
                interval: 500,
                minimum: 0,
                maximum: <?php echo $bloodDonorMax; ?>,
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
                yValueFormatString: "#",
                indexLabel: "{y}",
                indexLabelFontSize: 15,
                dataPoints: [
                    {label: "AB+", y: <?php echo $bloodDonors[0]["donorCount"]; ?> },
                    {label: "AB-", y: <?php echo $bloodDonors[1]["donorCount"]; ?> },
                    {label: "A+", y: <?php echo $bloodDonors[2]["donorCount"]; ?> },
                    {label: "A-", y: <?php echo $bloodDonors[3]["donorCount"]; ?> },
                    {label: "B+", y: <?php echo $bloodDonors[4]["donorCount"]; ?> },
                    {label: "B-", y: <?php echo $bloodDonors[5]["donorCount"]; ?> },
                    {label: "O+", y: <?php echo $bloodDonors[6]["donorCount"]; ?> },
                    {label: "O-", y: <?php echo $bloodDonors[7]["donorCount"]; ?> },
                ]
            }]
        };


        $("#chartContainer").CanvasJSChart(options);


    </script>

    <script type="text/javascript">
        window.onload = function () {
            var chart = new CanvasJS.Chart("chartContainerPie", {
                animationEnabled: true,
                title: {
                    text: "",
                    fontColor: "#333",
                    fontSize: 20,
                    fontWeight: 50,
                },
                data: [
                    {
                        showInLegend: true,
                        type: "pie",
                        indexLabel: "#percent%",
                        percentFormatString: "#0.##",
                        toolTipContent: "{label} (#percent%)",
                        dataPoints: [

                            <?php
                            foreach ($universityStudents as $item) {
                                echo '{label: "' . $item['name'] . '", y: ' . ($item['studentCount']) * 100 / $total_people . ', color: "' . getUniversityColor($item['id']) . '", name: "' . $item['name'] . '",},';
                            }
                            ?>

                            {label: "Independent University", y: 5, color: "#f5584e", name: "Independent University",}
                        ]
                    }
                ]
            });
            chart.render();
        }
    </script>

<?php

include 'footer.php';

?>