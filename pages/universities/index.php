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
                <p>List of universities</p>
                <div class="clear"></div>

                <br>

                <table id="list_table">
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Type</th>
                        <th>Action</th>
                        <th>Delete</th>
                    </tr>


                    <?php


                    $total_results = $db->getValue("universities", "count(id)");
                    if ($total_results > 0) {
                        $perpage = 25;
                        $page = (int)$_GET['p'] == 0 ? 1 : (int)$_GET['p'];
                        if ($page > ceil($total_results / $perpage)) $page = ceil($total_results / $perpage);
                        $start = ($page - 1) * $perpage;
                        $tpages = ceil($total_results / $perpage);
                        $s_pages = new pag($total_results, $page, $perpage);

                        $show_pages = "<div class='lspages'>$s_pages->pages</div>";


                        $sites = $db->rawQuery('SELECT * FROM universities ORDER BY name DESC LIMIT ?,?', array($start, $perpage));

                        foreach ($sites as $sp) {
                            echo '<tr> <td> ' . $sp['name'] . ' </td>';
                            echo '<td> ' . $sp['address'] . '</td>';
                            echo '<td> ' . $sp['latitude'] . '</td>';
                            echo '<td> ' . $sp['longitude'] . '</td>';
                            echo '<td> ' . (($sp['is_govt'] == 1) ? 'Government' : 'Private') . '</td>';
                            echo '<td><span class="action3" onclick=\'deleteReview("",this);\'>Edit</span></td>';
                            echo '<td><span class="action2" onclick=\'deleteReview("",this);\'>Delete</span></td>';
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

        function markApproved(id, approved, dID) {


            dID.innerHTML = "<i class='fas fa-spinner'></i>";

            var xmlHttp = new XMLHttpRequest();
            xmlHttp.onreadystatechange = function () {
                if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {

                    if (approved == 0) {
                        dID.innerHTML = "Approve";
                        dID.className = "action";


                    } else {

                        dID.innerHTML = "Disapprove";

                        dID.className = "action3";
                    }


                }
            }
            xmlHttp.open("GET", "/evaly/api/mark-approved.php?type=shop&id=" + id + "&approved=" + approved, true); // true for asynchronous
            xmlHttp.send(null);

        }


        function deleteReview(id, dID) {

            var txt;
            var r = confirm("Are you sure you want to delete this review?");
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