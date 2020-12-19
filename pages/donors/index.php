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


    </style>

    <div class="single-line">
        <div class="">
            <div class="brd c-left list-holder village-list">
                <p>List of Blood Donors</p>
                <div class="clear"></div>

                <br>

                <table id="list_table">
                    <tr>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Blood Group</th>
                        <th>University</th>
                    </tr>


                    <?php


                    $total_results = $db->getValue("members", "count(memberID)");
                    if ($total_results > 0) {
                        $perpage = 25;
                        $page = (int)$_GET['p'] == 0 ? 1 : (int)$_GET['p'];
                        if ($page > ceil($total_results / $perpage)) $page = ceil($total_results / $perpage);
                        $start = ($page - 1) * $perpage;
                        $tpages = ceil($total_results / $perpage);
                        $s_pages = new pag($total_results, $page, $perpage);

                        $show_pages = "<div class='lspages'>$s_pages->pages</div>";


                        $sites = $db->rawQuery('SELECT members.*, universities.name as universityName FROM members, universities WHERE members.university = universities.id ORDER BY memberID ASC LIMIT ?,?', array($start, $perpage));

                        foreach ($sites as $sp) {
                            echo '<tr> <td> ' . $sp['username'] . ' </td>';
                            echo '<td> ' . gender($sp['gender']) . '</td>';
                            echo '<td> ' . (($sp['phone'] == "") ? 'Not Given' : $sp['phone']) . '</td>';
                            echo '<td> ' . (($sp['address'] == "") ? 'Not Given' : $sp['address']) . '</td>';
                            echo '<td> ' . getBloodGroup($sp['bgroup']) . '</td>';
                            echo '<td> ' . $sp['universityName'] . '</td>';
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
            var r = confirm("Are you sure you want to delete this user?");
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