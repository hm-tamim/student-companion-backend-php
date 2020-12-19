<?php
require_once '../lib/init.php';
require_once '../includes/func.php';
require_once '../lib/pagination.class.php';


$title = 'NSUer.Club - Find & Vote Best Faculties, Calculate CGPA';
include 'head.php';

?>
<div class="fac-container">
    <div class="main">

        <!--
<div class="lbody"><form class="sForm" action="/action.php" method="POST" id="autoform">
<input type="search" class="autoc" id="autoinput" name="query" placeholder="Add comma to search multiple courses..." value="<?php echo $_GET['query']; ?>" id="cachedl"><button type="submit">Search</button>
</form>
</div>

-->

        <div class="table_round shadow">
            <table>
                <tr>
                    <th>Course</th>
                    <th>Faculty</th>
                </tr>
                <?php


                $total_results = $db->getValue("sites", "count(id)");


                if ($total_results > 0) {

                if (!isset($_GET['query']) && empty($_GET['query'])) {


                    $perpage = 24;
                    $page = (int)$_GET['p'] == 0 ? 1 : (int)$_GET['p'];
                    if ($page > ceil($total_results / $perpage)) $page = ceil($total_results / $perpage);
                    $start = ($page - 1) * $perpage;
                    $tpages = ceil($total_results / $perpage);
                    $s_pages = new pag($total_results, $page, $perpage);

                    $show_pages = "<div class='lspages'>$s_pages->pages</div>";


                    $sites = $db->ObjectBuilder()->rawQuery('SELECT * from sites WHERE LENGTH(faculty) > 90 ORDER BY course LIMIT ?,?', array($start, $perpage));


                } else {


                    $searchTerms = explode(',', fresh($_GET['query']));
                    $searchTermBits = array();
                    foreach ($searchTerms as $term) {
                        $term = trim($term);
                        if (!empty($term)) {
                            $searchTermBits[] = "course LIKE '%$term%'";
                        }
                    }


                    $sites = $db->ObjectBuilder()->rawQuery("SELECT * FROM sites WHERE " . implode(' OR ', $searchTermBits) . "ORDER BY course");


                }


                $i = 0;
                $count = 0;

                foreach ($sites as $site) {

                    $i++;


                    $fid = $site->id;

                    $course = $site->course;


                    $faculty = $site->faculty;


                    $json = $faculty;

                    $dial = '';
                    if ($count == 0) {
                        $dial = '<div id="dial" style="display: none;" class="arrowBox">Click on Course Name to Add Faculty</div>';

                    }


                    $json = unserialize($json);

                    if (sizeof($json) > 0) {


                        echo '<tr><td>' . $dial . '<a class="afac" href="/' . $course . '">' . $course . '</a></td><td>';


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

                        echo '</td>
</tr>';


                        ++$count;
                    }

                }


                ?>
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
                <script>
                    function showy(gid) {
                        var gclass = document.getElementById("f" + gid).classList;
                        if (gclass == "facrow") {
                            document.getElementById("f" + gid).classList.remove('facrow');
                            document.getElementById("m" + gid).innerHTML = "Show Less";
                        }
                        else {
                            document.getElementById("f" + gid).classList.add('facrow');
                            document.getElementById("m" + gid).innerHTML = "Show More";
                        }
                    }
                </script>
                <script>
                    function show(gid) {
                        var content = document.getElementById("f" + gid).classList;
                        if (content.contains("show")) {
                            document.getElementById("f" + gid).classList.remove("show");
                            setTimeout(function () {
                                document.getElementById("m" + gid).innerHTML = "Show More";
                            }, 200);
                        }
                        else {
                            document.getElementById("f" + gid).classList.add('show');
                            setTimeout(function () {
                                document.getElementById("m" + gid).innerHTML = "Show Less";
                            }, 200);
                        }
                    }
                </script>
            </table>
        </div>
        <script>
            var alerted = localStorage.getItem('alerteddddz') || '';
            if (alerted != 'yes') {
                document.getElementById("dial").style.display = "block";
                localStorage.setItem('alerteddddz', 'yes');
            }
            setTimeout(
                function () {
                    document.getElementById("dial").style.display = "none";
                }, 8000);
        </script>
        <?

        echo '<div style="clear: both"></div><div class="pag">';
        echo $show_pages;
        echo '</div>';
        }


        ?>
