<?php
require_once '../lib/init.php';
require_once '../includes/func.php';
require_once '../lib/pagination.class.php';


$title = 'NSUer.Club - Find & Vote Best Faculties, Calculate CGPA';
include '../head.php';

?>
    <link rel="stylesheet" type="text/css" href="styles.css"/>


    <script src="https://rawgit.com/tuupola/jquery_lazyload/2.x/lazyload.js"></script>
    <div class="fac-container">
        <div class="mainn">
            <div>

                <?php

                $total_results = $db->getValue("food", "count(id)");
                if ($total_results > 0) {


                    $perpage = 25;
                    $page = (int)$_GET['p'] == 0 ? 1 : (int)$_GET['p'];
                    if ($page > ceil($total_results / $perpage)) $page = ceil($total_results / $perpage);
                    $start = ($page - 1) * $perpage;
                    $tpages = ceil($total_results / $perpage);
                    $s_pages = new pag($total_results, $page, $perpage);

                    $show_pages = "<div class='lspages'>$s_pages->pages</div>";


                    $sites = $db->ObjectBuilder()->rawQuery('SELECT * from food ORDER BY food.like DESC LIMIT ?,?', array($start, $perpage));


                    $i = 0;
                    $count = 1;

                    foreach ($sites as $site) {

                        $i++;


                        $fid = $site->id;
                        $shop = $site->shop;
                        $faculty = $site->foods;
                        $json = $faculty;

                        $shopLike = $site->like;

                        $json = unserialize($json);

                        if (sizeof($json) > 0) {


                            $spou = 'shoplike_' . seoUrl($shop);


                            if ($_COOKIE[$spou] >= 1 || isset($_COOKIE[$spou]) && $_COOKIE[$spou] != 0) {
                                $ssvoted = ' voted';
                            } else {
                                $ssvoted = '';
                            }


                            echo '<div class="reviewBox">
<div class="shopName"><span>' . $count . '</span><h3>' . $shop . ' 
<p class="shopeVote">
<a onClick="svote(this); return false;" rel="nofollow" class="like votel' . $ssvoted . '" href="shopVote.php?shop=' . $shop . '">' . $shopLike . '</a>
</p></h3></div>

<div style="clear: both"></div>

<div class="foodScroll f' . $count . '" id="f' . $count . '">
';

                            $c = 1;

                            for ($i = 0; $i < sizeof($json); $i++) {


                                $name = $json[$i]['name'];
                                $vote = $json[$i]['vote'];
                                $downvote = $json[$i]['downvote'];


                                $price = $json[$i]['price'];

                                if (!empty($name)) {

                                    $mou = 'like_' . seoUrl($shop) . '_' . seoUrl($name);

                                    $dou = 'dislike_' . seoUrl($shop) . '_' . seoUrl($name);


                                    $cou = $_COOKIE[$mou];


                                    $dcou = $_COOKIE[$dou];

                                    if ($cou >= 1 || isset($_COOKIE[$mou]) && $_COOKIE[$mou] != 0) {
                                        $voted = ' voted';
                                    } else {
                                        $voted = '';
                                    }

                                    if ($dou >= 1 || isset($_COOKIE[$dou]) && $_COOKIE[$dou] != 0) {
                                        $dvoted = ' voted';
                                    } else {
                                        $dvoted = '';
                                    }


                                    $product = seoUrl($shop) . '_' . seoUrl($name);

                                    $half = ceil(sizeof($json) / 2);
                                    if ($i == $half)
                                        echo '';

                                    echo '<div class="shadow foodItem" style="">
<div class="thumbnail" style=""><img onclick="loadRating(\'' . $product . '\',\'' . $shop . '\',\'' . $name . '\',\'' . $price . '\')" class="b-lazy" data-src="/images/265x265/' . seoUrl($shop) . '_' . seoUrl($name) . '.jpg" src="data:image/gif;base64,R0lGODdhAQABAPAAAMPDwwAAACwAAAAAAQABAAACAkQBADs=">
<span class="price">' . $price . ' ৳</span>
</div>
<div class="innerTxt" style="padding: 10px;">
<p class="foodName">
<b>' . $cv . '</b> <a href="/faculty/' . $shop . '/' . $name . '"' . ucwords($name) . '">' . ucwords($name) . '</a> 
</p>
<div class="actionButton">
<a onClick="svote(this); return false;" rel="nofollow" class="like votel' . $voted . '" href="foodLike.php?shop=' . $shop . '&food=' . $name . '">' . $vote . '</a>
<a onClick="svote(this); return false;" rel="nofollow" class="dislike votel' . $dvoted . '" href="foodDislike.php?shop=' . $shop . '&food=' . $name . '">' . $downvote . '</a>';


                                    echo '<a class="commentIcon" onclick="loadRating(\'' . $product . '\')" href="#"><i class="fa fa-star-o"></i></a>
</div>
</div>
</div>';

                                    $c++;
                                }

                            }


                        }


                        echo '


<button class="scroller lefter" id="sLf' . $count . '" onClick="scrollLeftt(\'f' . $count . '\')"><i class="fa fa-chevron-left"></i></button>
<button class="scroller" id="sRf' . $count . '" onClick="scrollRight(\'f' . $count . '\')"> <i class="fa fa-chevron-right"></i></button>
</div></div>';


                        $count++;
                    }


                    ?>


                    <div id="myNav" class="overlayy">
                        <div class="loader"></div>
                    </div>

                    <script>


                        function loadRating(data, shop, food, price) {

                            document.getElementById("myNav").style.height = "100%";

                            var theUrl = 'product.php?urls=' + data + '&shop=' + shop + '&food=' + food + '&price=' + price;
                            $.get(theUrl, function (data) {
                                document.getElementById("myNav").innerHTML = data;
                            });


                        }


                        function closeRating() {
                            document.getElementById("myNav").style.height = "0%";
                            document.getElementById("myNav").innerHTML = '<div class="loader"></div>';
                        }

                    </script>


                    <style>


                    </style>
                    <!--
                    <section class='rating-widget'>

                      <div class='rating-stars text-center'>
                        <ul id='stars'>
                          <li class='star' title='Poor' data-value='1'>
                            <i class='fa fa-star fa-fw'></i>
                          </li>
                          <li class='star' title='Fair' data-value='2'>
                            <i class='fa fa-star fa-fw'></i>
                          </li>
                          <li class='star' title='Good' data-value='3'>
                            <i class='fa fa-star fa-fw'></i>
                          </li>
                          <li class='star' title='Excellent' data-value='4'>
                            <i class='fa fa-star fa-fw'></i>
                          </li>
                          <li class='star' title='WOW!!!' data-value='5'>
                            <i class='fa fa-star fa-fw'></i>
                          </li>
                        </ul>
                      </div>

                      <div class='success-box'>
                        <div class='clearfix'></div>
                        <img alt='tick image' width='32' src='https://i.imgur.com/3C3apOp.png'/>
                        <div class='text-message'></div>
                        <div class='clearfix'></div>
                      </div>

                    </section>
                      -->


                    <style>

                        * {
                            -webkit-box-sizing: border-box;
                            -moz-box-sizing: border-box;
                            box-sizing: border-box;
                        }

                        *:before, *:after {
                            -webkit-box-sizing: border-box;
                            -moz-box-sizing: border-box;
                            box-sizing: border-box;
                        }

                        .clearfix {
                            clear: both;
                        }

                        .text-center {
                            text-align: center;
                        }

                        .success-box {
                            margin: 50px 0;
                            padding: 10px 10px;
                            border: 1px solid #eee;
                            background: #f9f9f9;
                        }

                        .success-box img {
                            margin-right: 10px;
                            display: inline-block;
                            vertical-align: top;
                        }

                        .success-box > div {
                            vertical-align: top;
                            display: inline-block;
                            color: #888;
                        }

                        /* Rating Star Widgets Style */
                        .rating-stars ul {
                            list-style-type: none;
                            padding: 0;

                            -moz-user-select: none;
                            -webkit-user-select: none;
                        }

                        .rating-stars ul > li.star {
                            display: inline-block;

                        }

                        /* Idle State of the stars */
                        .rating-stars ul > li.star > i.fa {
                            font-size: 18px; /* Change the size of the stars */
                            color: #ccc; /* Color on idle state */
                        }

                        /* Hover state of the stars */
                        li.star.hover > i.fa {
                            color: #FFCC36;
                        }

                        /* Selected state of the stars */
                        .rating-stars ul > li.star.selected > i.fa {
                            color: #FF912C;
                        }
                    </style>

                    <script>
                        $(document).ready(function () {

                            /* 1. Visualizing things on Hover - See next part for action on click */
                            $('#stars li').on('mouseover', function () {
                                var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

                                // Now highlight all the stars that's not after the current hovered star
                                $(this).parent().children('li.star').each(function (e) {
                                    if (e < onStar) {
                                        $(this).addClass('hover');
                                    }
                                    else {
                                        $(this).removeClass('hover');
                                    }
                                });

                            }).on('mouseout', function () {
                                $(this).parent().children('li.star').each(function (e) {
                                    $(this).removeClass('hover');
                                });
                            });


                            /* 2. Action to perform on click */
                            $('#stars li').on('click', function () {
                                var onStar = parseInt($(this).data('value'), 10); // The star currently selected
                                var stars = $(this).parent().children('li.star');

                                for (i = 0; i < stars.length; i++) {
                                    $(stars[i]).removeClass('selected');
                                }

                                for (i = 0; i < onStar; i++) {
                                    $(stars[i]).addClass('selected');
                                }

                                // JUST RESPONSE (Not needed)
                                var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
                                var msg = "";
                                if (ratingValue > 1) {
                                    msg = "Thanks! You rated this " + ratingValue + " stars.";
                                }
                                else {
                                    msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
                                }
                                responseMessage(msg);

                            });


                        });


                        function responseMessage(msg) {
                            $('.success-box').fadeIn(200);
                            $('.success-box div.text-message').html("<span>" + msg + "</span>");
                        }
                    </script>

                    <script>
                        function scrollRight(id) {
                            $("." + id).animate({
                                scrollLeft: '+=320px'
                            }, 500);

                            document.getElementById("sL" + id).classList.add('displayBock');
                        }

                        function scrollLeftt(id) {
                            $("." + id).animate({
                                scrollLeft: '-=320px'
                            }, 500);
                        }

                        $(".foodScroll").scroll(function () {

                            var id = this.id;
                            var newScrollLeft = $('#' + id).scrollLeft();
                            var divWidth = $('#' + id).outerWidth();
                            var scrollwidth = $('#' + id).get(0).scrollWidth;
                            if (newScrollLeft === scrollwidth - divWidth) {

                                document.getElementById("sR" + id).classList.add('displayNone');
                            } else {

                                document.getElementById("sR" + id).classList.remove('displayNone');
                            }
                            var pp = $("#" + id).scrollLeft();

                            if (pp < 80) {
                                document.getElementById("sL" + id).classList.remove('displayBlock');

                            } else {
                                document.getElementById("sL" + id).classList.add('displayBlock');

                            }

                        });

                    </script>

                    <style>


                    </style>


                    <script>
                        $(function () {
                            $('.b-lazy').lazy(
                                {
                                    appendScroll: $('.foodScroll'),
                                    effect: 'fadeIn',
                                    afterLoad: function (element) {
                                        // called after an element was successfully handled
                                    },


                                }
                            );
                        });


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

                            } else {
                                a.classList.add('voted');

                                votez++;
                            }


                            a.innerHTML = votez;

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


                    <?

                    echo '<div style="clear: both"></div><div class="pag">';
                    echo $show_pages;
                    echo '</div>';
                }


                ?>

            </div>

        </div>
        <div class="sidebarb">

            <?php

            include '../addcoursebar.php';

            ?>
            <div class="addcontainer bar1 shadow">
                <h2>Disclaimer</h2>NSUer.Club is a poll website faculties of NSU. The ranking of faculties are
                determined by the count of votes given by students. Ranking doesn't mean to disrespect any faculty
                members.
            </div>
        </div>
        <div style="clear: both"></div>
    </div>
<?php
include '../foot.php';

?>