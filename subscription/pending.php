<?php
$title = 'Pending Subscription - Admin Panel';
$head = '<meta name="robots" content="noindex">';
include '../head.php';

// print_r($_SESSION);

if ($_SESSION["memberID"] != "20")
    die();

echo '<div class="lbody">';


include('connect-db.php');


$per_page = 600;

$result = mysql_query("SELECT * FROM subscriptionTemp, members WHERE subscriptionTemp.uid = members.uid ORDER BY date DESC");

$total_results = mysql_num_rows($result);

$total_pages = ceil($total_results / $per_page);


if (isset($_GET['page']) && is_numeric($_GET['page'])) {

    $show_page = $_GET['page'];


    if ($show_page > 0 && $show_page <= $total_pages) {

        $start = ($show_page - 1) * $per_page;

        $end = $start + $per_page;

    } else {

        $start = 0;
        $end = $per_page;
    }
} else {
    $start = 0;
    $end = $per_page;
}


echo "<p><a class='cpp'  href='/labib'>View All</a> | <b>View Page: </b> <span class='pgs'>";

for ($i = 1; $i <= $total_pages; $i++) {

    echo " <a href='?page=$i'>$i</a> ";


}

echo "</span></p><br/> ";

echo "<table class='shadow' cellpadding='10'>";

echo "<tr> <th>ID (" . $total_results . ")</th>
<th>Name</th>
<th>MemebrID</th>
<th>Account Type</th>
<th>Payment Type</th>
<th>trxID</th>
<th>Confirm</th>
<th>Delete</th></tr>";

?>

    <div class="lbdy">

    </div>

<?php

for ($i = $start; $i < $end; $i++) {


    if ($i == $total_results) {
        break;
    }


    echo "<tr id='" . mysql_result($result, $i, 'id') . "'>"; // tr


    echo '<td>' . mysql_result($result, $i, 'id') . '</td>';
    echo '<td>' . mysql_result($result, $i, 'username') . '</td>';
    echo '<td>' . mysql_result($result, $i, 'memberID') . '</td>';
    echo '<td>' . mysql_result($result, $i, 'account_type') . '</td>';
    echo '<td>' . mysql_result($result, $i, 'payment_type') . '</td>';
    echo '<td>' . mysql_result($result, $i, 'trxID') . '</td>';


    echo '<td><a target="_blank" href="add_to_main.php?id=' . mysql_result($result, $i, 'id') . '&memID=' . mysql_result($result, $i, 'memberID') . '&name=' . mysql_result($result, $i, 'username') . '&uid=' . mysql_result($result, $i, 'uid') . '" onclick="subConfirm(this.href, \'' . mysql_result($result, $i, 'id') . '\'); return false;">Confirm</a></td>';

    echo '<td><a id="d' . mysql_result($result, $i, 'id') . '" href="delete.php?id=' . mysql_result($result, $i, 'id') . '&memID=' . mysql_result($result, $i, 'memberID') . '&name=' . mysql_result($result, $i, 'username') . '&uid=' . mysql_result($result, $i, 'uid') . '" onclick="deletes(this.href, \'' . mysql_result($result, $i, 'id') . '\'); return false;">Delete</a></td>';

    echo "</tr>";

}

// close table>

echo "</table>";


echo "<p><a class='cpp'  href='/labib'>View All</a> | <a class='cpp' href='/ckbb'>Add</a> | <b>View Page: </b> <span class='pgs'>";

for ($i = 1; $i <= $total_pages; $i++) {

    echo " <a href='?page=$i'>$i</a> ";

}

echo "</span></p><br/> ";

?>


    <script language="javascript">

        function deletes(url, id) {


            document.getElementById(id).style.background = '#daa6a6';


            var xmlHttp = new XMLHttpRequest();
            xmlHttp.onreadystatechange = function () {
                if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {


                }
            }
            xmlHttp.open("GET", url, true);
            xmlHttp.send(null);


            setTimeout(function () {

                document.getElementById(id).style.background = '#fff';

                document.getElementById(id).style.width = '50px';


                document.getElementById(id).style.display = 'none';
            }, 100);


        }

    </script>

    <script language="javascript">

        function subConfirm(url, id) {


            document.getElementById(id).style.background = '#daa6a6';


            var xmlHttp = new XMLHttpRequest();
            xmlHttp.onreadystatechange = function () {
                if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {


                }
            }
            xmlHttp.open("GET", url, true);
            xmlHttp.send(null);


            setTimeout(function () {

                document.getElementById(id).style.background = '#fff';

                document.getElementById(id).style.width = '50px';

                document.getElementById(id).style.display = 'none';
            }, 100);


            return false;
        }

    </script>


    <p></p></div>

    <style>

        tr:hover {
            box-shadow: inset 0 0 10px #ccc;

        }

        .topt {
            display: none
        }

        .pgs a {
            padding: 7px;
            background: white;
            border: 1px solid #bbb;
            border-radius: 3px;
        }

        .pgs a:hover {
            background: #eee;
        }

        table a, .cpp, .mmps a {
            color: #fcfaf6;
            padding: 7px;
            background: rgb(30, 140, 166);
            border-radius: 3px;
        }

        .lbody {
            padding: 20px
        }

        @media screen and (max-width: 500px) {

            .lbody {
                padding: 10px !important;
                padding-top: 25px !important;

            }

        }

        .actb {
            background: #ddd
        }

        table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 2rem;
            background-color: #fff;
        }

        th {
            font-weight: 400;
            color: #333;
            vertical-align: middle;
            border-bottom: 1px solid rgba(0, 0, 0, 0.12);
            padding: 20px;
            text-align: left;
            font-weight: bold;
        }

        td {
            padding: 20px;
            max-width: 785px;
        }

        tr {
            transition: all .2s ease-in-out;
        }

        th:first-child {
            border-radius: 3px 0 0 0;
        }

        th:last-child {
            border-radius: 0 3px 0 0;
        }

        th:only-child {
            border-radius: 3px 3px 0 0;
        }

        .lbdy {

            margin-bottom: 10px;
        }
    </style>

    </div>

    </div>
    </div>


<?php

include '../foot.php';

?>