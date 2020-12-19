<?php
require_once 'lib/init.php';
require_once 'includes/func.php';
require_once 'lib/pagination.class.php';

$ttl = str_replace(",", ", ", fresh($_GET['query']));

$ttl = strtoupper($ttl);

$dmeta = '<meta name="description" content="Best faculties for ' . strtoupper($ttl) . ' course in North South University and find eBooks of ' . strtoupper($ttl) . '"/>';

$title = $ttl . ' - Best Faculties, Books & Ranking Based on Votes ';
include 'head.php';

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


    <div style="display: non; padding: 10px; margin-bottom: 10px; color: #fff; border-radius: 3px;  background: #e59a23; box-shakdow: 0 2px 15px rgba(0, 0, 0, 0), 0 2px 6px rgba(19, 17, 17, 0.26);">
        <b>Bookmark</b> the website so that you can choose the right faculty for your courses during upcoming advising.
    </div>


    <div class="lbody">
        <form class="sForm" action="/action.php" method="POST" id="autoform">
            <input type="search" class="autoc" id="autoinput" name="query" placeholder="Enter course initial..."
                   value="<?php echo $ttl; ?>" id="cachedl">
            <button type="submit">Search</button>
        </form>
    </div>


<?php

$searchTerms = explode(',', fresh($_GET['query']));
$searchTermBits = array();
foreach ($searchTerms as $term) {
    $term = trim($term);
    if (!empty($term)) {
        $searchTermBits[] = "course LIKE '%$term%'";
    }
}


$idd = $db->rawQuery("SELECT * FROM sites WHERE " . implode(' OR ', $searchTermBits) . "ORDER BY course");


// var_dump($idd);


$course = $idd[0]['course'];


$faculty = $idd[0]['faculty'];


if (!empty($course)) {


    echo '<div class="table_round shadow"><table>
<tr>
<th>Course</th>
<th>Faculty</th>
</tr>';


    for ($k = 0; $k < sizeof($idd); $k++) {


        $course = $idd[$k]['course'];


        $faculty = $idd[$k]['faculty'];

        $fid = $idd[$k]['id'];

        $json = $faculty;


        echo '<tr>
<td><a class="afac" href="/addfaculty.php?course=' . $course . '">' . $course . '</a></td>
<td>';

        $json = unserialize($json);


        $c = 1;

        echo ' <div class="facrow" id="k' . $fid . '">';

        for ($i = 0; $i < sizeof($json); $i++) {

            $name = $json[$i]['name'];
            $vote = $json[$i]['vote'];

            if (!empty($name)) {

                $mou = $course . '_' . $name;
                $cou = $_COOKIE[$mou];

                if ($cou >= 1 || isset($_COOKIE[$mou]) && $_COOKIE[$mou] != 0) {
                    $voted = ' voted';
                    $ted = 'd';
                } else {
                    $voted = '';
                    $ted = '';
                }
                if ($c == 6)
                    echo '<div class="hide" id="f' . $fid . '">';


                echo '<span><b>' . $c . '.</b> <a href="/faculty/' . $course . '/' . $name . '"' . ucwords($name) . '">' . ucwords($name) . '</a> <a onClick="svote(this); return false;" rel="nofollow" class="votel' . $voted . '" href="/vote.php?course=' . $course . '&faculty=' . $name . '">' . $vote . ' Vote' . $ted . '</a></span>';


                $c++;
            }

        }


        if ($c > 6)
            echo '</div>';

        echo '</div>';


        if ($c > 6) {
            echo '<div class="more" id="m' . $fid . '" onclick="show(\'' . $fid . '\')">Show More</div>';
        }


        echo '</td></tr>';
    }

    echo '</table></div>';
    ?>
    <br/>


    <script>


        function copy(mel) {
            var copyText = document.getElementById("myInput");
            copyText.select();
            document.execCommand("Copy");

            mel.innerHTML = "Copied";
            mel.style.backgroundColor = "#e59a23";
            document.getElementById("abox").classList.add("show");
            document.getElementById("abox").classList.add("bar1");

        }
    </script>


    <?php

} else {

    echo '<div class="addcontainer shadow">No Result Found!<br/><br/>Search with your browser instead, type CTRL+F<br/><br/>
For Mobile Device, click on Menu then select <b>Find in Page</b>
<br><br>
<b>Please add courses if missing on the site.</b>
</div>
';
}


echo '
</div>
<div class="sidebar">';


$id2 = $db->rawQuery("SELECT * FROM books WHERE " . implode(' OR ', $searchTermBits) . " ORDER BY course");


for ($i = 0; $i < sizeof($id2); $i++) {


    $books = json_decode($id2[$i]['books']);


    echo '<span class="ititle4">Books</span>';
    echo '
<div class="booklist">
<div class="table_round" style=" background: #fff; color: #333; font-weight: bold; margin-bottom: 18px"> 
' . $id2[$i]['course'] . ' - ' . $books->courseName . ' 
</div>
<ul>

';

    foreach ($books->books as $book) {

        echo '<li>';

        echo '<a rel="nofollow" href="/books/download/' . $book->link . '">' . $book->name . '</a>';

        echo '</li>';
    }

    echo '</ul></div>';


}


?>


    <style>

        .booklist {

            background: #fff;
            border-radius: 3px;

            min-height: 135px;
            border: 1px solid #e9e9e9;
            padding: 15px;
            border-top: 2px solid #428bca !important;
            border-spacing: 0;
            border-top-left-radius: 0px !important;
            margin-bottom: 10px;
            margin-top: -2px;
        }

        .booklist li {
            color: #232323;
            padding-top: 10px;
            padding-bottom: 10px;
            font-size: 15px;
            background: #f9f1f1;
            border-radius: 5px;
            padding-left: 15px;
            margin-bottom: 6px;
            margin-top: 8px;
            padding-right: 15px;
        }

        .booklist li:before {
            content: "\f02d"; /* FontAwesome Unicode */
            font-family: FontAwesome;
            font-size: 20px;
            display: inline-block;
            margin-left: -50px;
            width: 50px;
            margin-top: -5px;

        }

        .booklist ul {
            list-style: none;
            padding-left: 40px;

        }
    </style>


    <script>
        function show(gid) {
            var content = document.getElementById("f" + gid).classList;
            if (content.contains("show")) {
                document.getElementById("f" + gid).classList.remove("show");
                setTimeout(function () {
                    document.getElementById("m" + gid).innerHTML = "Show More";
                }, 300);
            }
            else {
                document.getElementById("f" + gid).classList.add('show');
                setTimeout(function () {
                    document.getElementById("m" + gid).innerHTML = "Show Less";
                }, 300);
            }
        }
    </script>

    <script>
        function svote(a) {
            var myLink = a.getAttribute('href');
            var htext = a.innerHTML;
            var votez = htext.replace(/[^0-9]/g, '');
            var vclass = a.classList;
            if (vclass.contains("voted")) {
                a.classList.remove('voted');
                votez--;
                a.innerHTML = votez + " Vote";
                myLink = myLink.replace(/vote.php/g, 'votedown.php');
                var xhr;
                var loadUrl = function (url) {
                    if (xhr && xhr.readyState > 0 && xhr.readyState < 4) {
                        xhr.abort();
                    }
                    xhr = $.get(url, function () {
                        console.log('success', this);
                    });
                };
                loadUrl(myLink);

            } else {
                votez++;
                a.innerHTML = votez + " Voted";
                a.classList.add('voted');
                var xhr;
                var loadUrl = function (url) {
                    if (xhr && xhr.readyState > 0 && xhr.readyState < 4) {
                        xhr.abort();
                    }
                    xhr = $.get(url, function () {
                        console.log('success', this);
                    });
                };
                loadUrl(myLink);
            }
        }
    </script>


    <div id="container" class="lbody">
        <div id="temp">
            <div id="text"><input type="text" id="myInput"
                                  value="<?php echo 'http://nsuer.club/' . strtoupper(fresh($_GET['query'])); ?>"/>
            </div>
            <div id="btn">
                <button onclick="copy(this)">COPY URL & SHARE</button>
            </div>
        </div>
    </div>

    <div id="abox" class="addcontainer shadow abox">
        Page URL is copied. Now you can share it on facebook just by pasting.
    </div>

<?php

include 'addcoursebar.php';

?>

    <div class="addcontainer bar1 shadow">
        <h2>Disclaimer</h2>
        NSUer.Club is a poll website faculties of NSU. The ranking of faculties are determined by the count of votes
        given by students. Ranking doesn't mean to disrespect any faculty members.
    </div>


    </div>


    <div style="clear: both"></div>

    </div>
<?php
include 'foot.php';

?>