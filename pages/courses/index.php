<?php

$title = "Universities";

include $_SERVER['DOCUMENT_ROOT'] . '/header.php';

echo '<div class="content">';


?>

    <style>

        .list-holder table td, .list-holder table th {

            text-align: left;
            min-width: 150px;
            padding: 19px 20px 20px 20px;

        }

        @media screen and (max-width: 1300px) {
            .list-holder table td, .list-holder table th {

                text-align: left;
                min-width: 100px;
                padding: 19px 20px 20px 20px;

            }

            .list-holder table td:nth-child(3), .list-holder table th:nth-child(3) {
                min-width: 140px;

            }

        }

        .show_paid a {
            padding: 5px 10px;
            background: #fff;
            color: #333;
            border: 1px solid #333;
            border-radius: 5px;
        }

        .show_paid a.active {

            background: #333;
            color: #fff;
            border-radius: 5px;

        }

        .grid-container {
            display: grid;
            grid-template-areas: 'header header header' 'header header header';
            grid-gap: 10px;
            padding: 10px;
        }

        .grid-container select {
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 0px;
        }

        .grid-container input {

            width: 100% !important;
            border: 1px solid #ddd;
            border-radius: 0px;
        }

    </style>


    <div class="single-line add-form"">
    <div class="">
        <div class="brd c-left">
            <p>Add New Course</p> <br>
            <form action="" method="post">

                <div class="grid-container">
                    <div class="grid-item">
                        <label for="name">Course Name</label>
                        <input name="name" type="text" placeholder="Enter course name" required/></div>
                    <div class="grid-item">
                        <label for="section">Section</label>
                        <select id="section" name="section" required>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                            <option>13</option>
                            <option>14</option>
                            <option>15</option>
                            <option>16</option>
                            <option>17</option>
                            <option>18</option>
                            <option>19</option>
                            <option>20</option>
                        </select></div>
                    <div class="grid-item">
                        <label for="time">Course Time</label>
                        <input name="time" type="text" placeholder="Enter course time" required/></div>

                    <div class="grid-item">
                        <label for="name">Room</label>
                        <input name="room" type="text" placeholder="Enter class room" required/>
                    </div>

                    <div class="grid-item">
                        <label for="university">University</label>
                        <select id="university" name="section" required>
                            <option>North South University</option>
                            <option>American International University</option>
                            <option>Independent University</option>
                            <option>BRAC University</option>
                            <option>East West University</option>
                            <option>Dhaka College</option>
                        </select>
                    </div>

                    <div class="grid-item">
                        <input style="width: 100%; margin-top: 26px" type="submit" name="add-course" value="Add Course" required/></div>
                </div>
        </div>


        </form>
    </div>
    </div>

    <div class="single-line">
        <div class="">
            <div class="brd c-left list-holder village-list">
                <p>List of Course</p>
                <div class="clear"></div>

                <br>

                <table id="list_table">
                    <tr>
                        <th>Course Initial</th>
                        <th>Section</th>
                        <th>Faculty</th>
                        <th>Time</th>
                        <th>Room</th>
                        <th>University</th>
                        <th>Action</th>
                        <th>Delete</th>
                    </tr>


                    <?php


                    $total_results = $db->getValue("advising", "count(id)");
                    if ($total_results > 0) {
                        $perpage = 25;
                        $page = (int)$_GET['p'] == 0 ? 1 : (int)$_GET['p'];
                        if ($page > ceil($total_results / $perpage)) $page = ceil($total_results / $perpage);
                        $start = ($page - 1) * $perpage;
                        $tpages = ceil($total_results / $perpage);
                        $s_pages = new pag($total_results, $page, $perpage);

                        $show_pages = "<div class='lspages'>$s_pages->pages</div>";


                        $sites = $db->rawQuery('SELECT * FROM advising LIMIT ?,?', array($start, $perpage));

                        foreach ($sites as $sp) {
                            echo '<tr> <td> ' . $sp['course'] . ' </td>';
                            echo '<td> ' . $sp['section'] . ' </td>';
                            echo '<td> ' . $sp['faculty'] . ' </td>';
                            echo '<td> ' . $sp['time'] . ' </td>';
                            echo '<td> ' . $sp['room'] . ' </td>';
                            echo '<td> North South University</td>';
                            echo '<td><span class="action3" onclick=\'editById("",this);\'>Edit</span></td>';
                            echo '<td><span class="action2" onclick=\'deleteById("",this);\'>Delete</span></td>';
                            echo '</tr>';

                        }
                    }

                    ?>

                </table>

                <?php
                echo $show_pages;
                ?>


            </div>
        </div>
    </div>


    <script>


        function deleteById(id, dID) {

            var txt;
            var r = confirm("Are you sure you want to delete this course?");
            if (r == true) {

            } else {
                return;
            }

            dID.innerHTML = "<i class='fas fa-spinner'></i>";

            var xmlHttp = new XMLHttpRequest();
            xmlHttp.onreadystatechange = function () {
                if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {

                    var d = dID.parentNode.parentNode.rowIndex;

                    document.getElementById("list_table").deleteRow(d);
                }
            }
            xmlHttp.open("GET", "/evaly/api/delete-review.php?type=shop&id=" + id, true); // true for asynchronous
            xmlHttp.send(null);

        }


    </script>


<?php

include $_SERVER['DOCUMENT_ROOT'] . '/footer.php';

?>