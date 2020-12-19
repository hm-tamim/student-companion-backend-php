<?php


ob_start();
session_start();

$title = $_SESSION['username'] . ' - Profile';


include '../head.php';


if ($islogged == 1) {


    require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/db.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/MysqliDb.php";


    require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/func.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/pagination.class.php";


    $db = new MysqliDb($db_host, $db_user, $db_pass, $db_name);


}


$userEmail = $_SESSION['email'];

//echo $userEmail;


if ($islogged == 1) {
    if ($db->rawQuery('SELECT id from cgpa where email = ?', Array($userEmail)))
        $hasCGPA = 1;
    else
        $hasCGPA = 0;
} else {
    $hasCGPA = 0;
}


if ($islogged == 1) {

    $userr = $db->rawQuery('SELECT * from cgpa where email = ?', Array($userEmail));


    $uid = $userr[0]['id'];


    $courses = json_decode($userr[0]['courses']);

    $credits = json_decode($userr[0]['credits']);

    $grades = json_decode($userr[0]['grades']);


    $cgpa = json_decode($userr[0]['cgpa']);

    $totalCredits = json_decode($userr[0]['credit']);

}


?>


<script src="/cgpa-calculator/circle.js"></script>

<div class="fac-container">

    <div class="addcontainer bar1 shadow">


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

        echo '<b>Name:</b> ' . ucwords($_SESSION['username']) . '</br></br>';

        echo '<b>Gender:</b> ' . ucwords($_SESSION['gender']) . '</br></br>';

        echo '<b>Email:</b> ' . $_SESSION['email'] . '</br>';

        ?>


    </div>

    <style>
        .flist h2 {
            font-size: 15px;
            font-weight: 900;
            color: #444;
            margin: -5px 0 1px;
            padding: 6px;
            border-bottom: 1px solid #eee;
            box-shadow: 0 0px 0 #fcfaf6;
            text-transform: uppercase;
            margin-bottom: 12px;
            padding-bottom: 15px;
        }

        .flist li {
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

        ul {
            padding-left: 15px;
            list-style: square outside none;
        }
    </style>

    <?php
    if ($islogged == 1) {

        echo '<div class="addcontainer bar1 shadow flist"><h2>YOUR FILES</h2>';


        $dir = $_SERVER['DOCUMENT_ROOT'] . '/files/' . strtolower($_SESSION['email']) . '/';

        $dir2 = 'files/' . strtolower($_SESSION['email']) . '/';

        function scan_dir($dir)
        {
            $ignored = array('.', '..', '.svn', '.htaccess');

            $files = array();
            foreach (scandir($dir) as $file) {
                if (in_array($file, $ignored)) continue;
                $files[$file] = filemtime($dir . '/' . $file);
            }

            arsort($files);
            $files = array_keys($files);

            return ($files) ? $files : false;
        }


        $ffs = scan_dir($dir);

        ksort($ffs);
        echo '<ul>';

        $p = 0;
        $t = 0;
        foreach ($ffs as $ff) {
            if ($ff != '.' && $ff != '..') {
                echo '<li id="p' . $p . '">';


                if (is_dir($dir . '/' . $ff)) {
                    echo $ff;
                    listFolderFiles($dir . '/' . $ff);
                } else {

                    $ffff = ucfirst(str_replace('-', ' ', $ff));

                    echo "<a href='$dir2$ff' download><b class=\"fttl\">$ffff</b></a> <br><div class='fileInfo'>Size: <b>" . formatBytes(filesize($dir . '/' . $ff)) . "</b> - " . date('F d, Y', filectime($dir . '/' . $ff));

                    $path_info = pathinfo($ff);
                    $ext = $path_info['extension'];
                    $allowed = array('txt', 'java', 'c', 'sql');


                    if (in_array(strtolower($ext), $allowed)) {

                        $loc = $_SERVER['DOCUMENT_ROOT'] . '/files/' . strtolower($uEmail) . '/';

                        $fileLocation = $dir . '/' . $ff;


                        $filez = file_get_contents($fileLocation);


                        echo "<textarea id='$t' class='txtview' readonly>$filez</textarea>";
                    }

                    echo '
<div class="actionbtn">
<form action="" method="post">
<input type="hidden" name="editText" value="' . $ff . '">

<button type="submit" class="edt" ';


                    if (!in_array(strtolower($ext), $allowed))
                        echo "disabled";


                    echo '>Edit</button> ';


                    echo ' <a class="dlt" onclick="deleteFile(this,\'p' . $p . '\');return false" href="delete.php?filen=' . $ff . '">Delete</a> ';

                    if (in_array(strtolower($ext), $allowed))
                        echo '<button class="edt cpy" onclick="copyt(this,\'' . $t . '\'); return false;">COPY</button>';

                    echo '</form>

</div>
</div>';


                }
                $p++;
                $t++;
                echo '</li>';
            }
        }


        echo '</ul>
</div>
';

    }

    echo '
</div>';

    include '../foot.php';

    ?>



