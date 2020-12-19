<?php include 'headfunc.php';?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" type="text/css" href="/stylecss4.css"/>
    <link rel="apple-touch-icon" sizes="57x57" href="/images/fav/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/images/fav/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/fav/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/fav/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/fav/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/fav/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/fav/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/fav/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/fav/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/images/fav/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/images/fav/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/fav/favicon-16x16.png">
    <meta name="viewport" content="width=device-width">
    <meta property="og:image" content="https://scompanion.club/images/ogimg.png"/>
    <script
            src="//code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js" type="text/javascript"></script>


    <style>
        .votel, .commentIcon {
            box-shadow: 1px 1px 4px 0px rgba(0, 0, 0, 0.30);
        }

        .ui-autocomplete {
            position: absolute !important;

            background: #fff;
            border: 0px solid #ddd;
            list-style: none !important;
            padding-left: 0px;
            border-bottom: 0px solid #ddd;

            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.16), 0 0 0 1px rgba(0, 0, 0, 0.08);
            transition: box-shadow 200ms cubic-bezier(0.4, 0.0, 0.2, 1);
        }

        .ui-autocomplete .ui-state-focus {

            background: #eee;
        }

        .ui-autocomplete li a:hover {
            background: #eee;
        }

        .ui-autocomplete li a {
            padding: 12px;
            cursor: pointer;
            padding-left: 14px;
            display: block;
            border-bottom: 1px solid #ddd;
        }

        .ui-autocomplete li a:after {
            content: "\f08e";
            display: block;
            float: right;
            font: normal normal normal 14px/1 FontAwesome;
            margin-top: 3px;
        }

        .ui-autocomplete li:last-child a {
            border-bottom: 0px;
        }

        .ui-helper-hidden-accessible {
            display: none;
        }

        .navmenu {
            overflow-x: scroll;
            color: #fff;
            white-space: nowrap;
            margin-bottom: 5px;
            padding-left: 5px;
            background: #271f30;
        }

        .navmenu a {
            color: #b9c5dc;
            padding: 10px;
            padding-right: 8px;
            background: #271f30;
            display: inline-block;
        }

        .currentPage {
            background: #413351 !important;
        }

        .navmenu a:hover {

            background: #313351 !important;
        }

        @media screen and (max-width: 500px) {
            .navmenu a {
                padding: 10px;
                padding-right: 5px;
                padding-left: 8px;
            }

        }

        @media screen and (min-width: 500px) {

            body {
                padding-left: 225px;
                transition: .5s;
            }

            .fbottom {
                left: 0;
                max-width: 225px;
                overflow: hidden;

            }

            header {
                margin-left: -225px;
                position: sticky;
                top: 0;
                transition: 0.5s;
                z-index: 9999;

            }

            .close {
                display: none !important;
            }

            .overlay3 {
                width: 0px !important
            }

            .sidenav {
                left: 0;
                right: auto !important;
                width: 225px;
                position: fixed;
                top: 70px;
                padding-top: 20px !important;

                background-color: #1c2028;

            }

            .sidenav a {
                padding: 13px 6px 13px 28px;
                text-decoration: none;
                font-size: 16px;
                color: #b9c5dc;
                display: block;
                transition: 0.3s;
                white-space: nowrap;
                font-weight: normal;
            }

            .fbottom a:last-child {
                background: #25bb3d;
                padding-right: 20px;
                margin-right: 0px;
                padding-left: 21px;
            }

            .fbottom a:first-child {
                background: #2196f3;
                padding-right: 20px;
                margin-right: 0px;
                padding-left: 20px;
            }

            .close:before, .close:after {
                height: 27px;
                width: 3px;
            }

            .dhide {
                display: none;
            }

            .main {
                width: 63%;
                float: left;
            }

            .sidebar {
                width: 36.6%;
                float: right;
                padding: 0px 3px 10px 9px;
                position: stickym;
                top: 10px;
            }

            .fac-container {
                padding: 15px;
                padding-right: 10px;
            }

            .bar1 {
                margin-top: 0px;

            }

            header {
                height: 70px;
                padding-top: 22px;
                background: #312240;
                color: #fff;
                font-size: 19px;
                font-weight: bold;
            }

            .logo {
                max-width: 170px;
                margin-top: -7px;
                margin-left: 4px;
            }
        }


    </style>
    <?php
    if (empty($dmeta))
        echo '<meta property="og:description" content="Largest faculty poll of North South University. Add course, faculty initials and vote your favorite faculty."/>';
    else
        echo $dmeta;
    ?>
    <meta name="robots" content="index,follow"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="//www.googletagmanager.com/gtag/js?id=UA-84672147-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-84672147-3');


        function readCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }


    </script>
    <style>
        @media screen and (max-width: 500px) {
            .fac-container {
                padding: 8px !important;
            }
        }

    </style>
</head>
<body>
<script>


    if (readCookie("remembermme2") = h = null) {

        if (document.referrer.indexOf('scompanion.club') >= 0) {

            var str = window.location.href;

            var matches = str.match(/login|sign-up|user|upload/g);

            var txt;

            if (matches == null) {

                var r = confirm("You need to login first to use scompanion.club. Press OK to login.");
                if (r == true) {

                    window.location.replace("https://scompanion.club/login");

                } else {

                    window.location.replace("https://scompanion.club/");
                }

            }
        }

    }
    else {

        var cookieee = readCookie("rememberme2");

        $.getJSON('https://scompanion.club/apps/version.php?uid=' + cookieee, function (data) {

            if (data['isPremium'] == "false") {
                openNavSub();

            }
        });


    }
</script>

<script>


    function openNavSub() {
        document.getElementById("myNavSub").style.height = "100%";
    }

    /* Close */
    function closeNavSub() {
        document.getElementById("myNavSub").style.height = "0%";
    }


    function loadsub(typez, uidz) {

        var uid = readCookie("rememberme2");

        var pay;
        var price;
        var price2;

        if (typez == 1) {

            pay = "1 Year Subscription";
            price = "100 TK"
            price2 = "Send 100 TK to selected number";
        } else {


            pay = "Lifetime Subscription";
            price = "250 TK"
            price2 = "Send 250 TK to selected number";


        }


        document.getElementById("sub-conk").innerHTML = "<div class=\"sub-attention1\">\n" +
            "    <br>\n" +
            "    <h2>Payment for subscription</h2>\n" +
            "    <br>\n" +
            "\n" +
            "    <form action=\"https://scompanion.club/subscription/verify.php\" method=\"POST\" id=\"subs-form\">\n" +
            "    \n" +
            "    <div class=\"subbox\">\n" +
            "        <b>" + pay + "</b> <p style=\"float: right;\"><b>" + price + "</b></p>\n" +
            "        <div style=\"clear: both\"></div>\n" +
            "    </div>\n" +
            "    \n" +
            "    <div class=\"subbox\">\n" +
            "        <p><b>Payement By</b> (via send money)</p><br>\n" +
            "        \n" +
            "        <input type=\"radio\" name=\"payment_type\" value=\"1\" required> bKash - 01308347415 (personal)<br>\n" +
            "       \n" +
            "        <input type=\"radio\" name=\"payment_type\" value=\"2\" required> Rocket - 013083474154<br>\n" +
            "    </div>\n" +
            "    \n" +
            "        \n" +
            "    <div class=\"subbox\">\n" +
            "        <center><b>" + price2 + "</b></center>\n" +
            "    </div>\n" +
            "    \n" +
            "    <div class=\"subbox\">\n" +
            "        <p><b>Verify Payment</b></p><br>\n" +
            "        \n" +
            "        <p>After sending money, you will get a confirmation message that contains a TrxID/TxnID number. Enter that, or the phone number you sent the money from.\n" +
            "        </p><br>\n" +
            "        \n" +
            "        \n" +
            "        <input type=\"hidden\" name=\"account_type\" value=\"" + typez + "\">\n" +
            "        \n" +
            "        <input type=\"hidden\" name=\"uid\" value=\"" + uid + "\">\n" +
            "        \n" +
            "        <input type=\"text\" class=\"subi\" placeholder=\"Enter here\" name=\"trxID\" required>\n" +
            "        <input type=\"submit\" class=\"subi\" name=\"submit\" value=\"Submit Payment Info\">\n" +
            "    \n" +
            "    <br> <br>\n" +
            "    \n" +
            "    <p>If bKash or Rocket payment fails, please contact at nsuer.app@gmail.com</p>\n" +
            "    </div>\n" +
            "    \n" +
            "    \n" +
            "    \n" +
            "        \n" +
            "    </form>\n" +
            "    \n" +
            "    </div>";


        $("#subs-form").submit(function (e) {

            e.preventDefault(); // avoid to execute the actual submit of the form.

            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function (data) {
                    // closeNavSub();

                    alert("Thank you for the contribution. Your account will be activated within next few minutes.");
                }
            });


        });


    }


</script>


<div id="myNavSub" class="overlay-sub">

    <a href="javascript:void(0)" class="closebtn" onclick="closeNavSub()">&times;</a>

    <!-- overlay-sub content -->
    <div class="overlay-sub-content" id="sub-conk">

        <br>
        <center><h2>Attention!</h2></center>
        <br>

        <img src="https://scompanion.club/images/fav/apple-icon-76x76.png">
        <br>

        <div class="sub-text-holder">
            <br>
            Last year, NSUer app and scompanion.club website were released. My goal has been to help students to make
            their
            life easier to manage. Glad so say that I'm successful, as so many of you are using this app and loving it.

            <br>
            <br>
            It's been over a year, I'm spending my pocket money to run this website and app. But as the users are
            growing, it requires more expensive server, and other services to renew. I can't bear the maintenance cost
            of this app alone.
            <br><br>

            As many of you suggested, there will be a membership system in NSUer App. Cost will be 30TK per semester.

            <br><br>

            Your subscription fee will be considered as contribution to this app. And keep the app ads free. Most
            importantly, it will make the platform self-sustainable.

            <br><br>

            Using our own fund, we will upgrade to higher powered servers, build more advanced features, develop books
            and course resource(slides, projects) collection and more.

            <br><br>

            If you have any valid reason, then you can get membership for free. Contact at nsuer.app@gmail.com

            <br><br>

            <div class="sub-pack">

                <div class="sub1" onclick="loadsub(1, 'yes')">
                    <h1>1</h1>
                    <span>Year</span>
                    <br>
                    <span>Membership</span>
                    <br><br>
                    <b>100 TK</b>

                </div>


                <div class="sub2" onclick="loadsub(2, 'yes')">
                    <h2>Lifetime</h2>
                    <br>
                    <span>Membership</span>
                    <br><br>
                    <b>250 TK</b>

                </div>

                <div style="clear:both"></div>
            </div>

        </div>

    </div>

</div>

<div style="clear:both"></div>
</div>


<style>

    .subbox input {

        margin-left: 10px;
    }

    .subbox .subi {

        padding: 15px;
        border: 1px solid #ddd;
        width: 94%;
        margin-bottom: 10px;

    }

    .subbox {

        margin: 10px;
        border-radius: 5px;
        padding: 15px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, .3);
        margin-bottom: 20px;

    }

    .sub-attention1 h2 {

        margin-left: 20px;

    }

    .sub-attention1 {

        margin-left: 10px;
        margin-right: 10px;
        width: 95%;
        max-width: 550px;
        text-align: left;
        padding-bottom: 30px;

    }

    .sub-attention {

        margin-left: 10px;
        margin-right: 10px;
        width: 95%;
        max-width: 550px;

    }

    .sub-pack {
        width: 100%;
        padding: 10px;
        padding-top: 20px;
        text-align: center;
        margin: auto;

        padding-bottom: 30px;
    }

    .sub1, .sub2 {

        width: 45%;
        display: inline-block;
        border: 1px solid #eee;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        background: #2196F3;
        color: #fff !important;
        min-height: 166px;
        float: left;
        -webkit-touch-callout: none; /* iOS Safari */
        -webkit-user-select: none; /* Safari */
        -khtml-user-select: none; /* Konqueror HTML */
        -moz-user-select: none; /* Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
        user-select: none;
        /* Non-prefixed version, currently
                                         supported by Chrome and Opera */

    }

    .sub1:hover, .sub2:hover, .sub1:focus, .sub2:focus {

        background: #225d93;

    }

    .sub1 {

        margin-right: 10px;

    }

    .sub2 {

        float: right;

        margin-left: 10px;
    }

    .sub-text-holder {

        padding-left: 20px;
        padding-right: 20px;
        text-align: left;

    }

    /* The overlay-sub (background) */
    .overlay-sub {
        /* Height & width depends on how you want to reveal the overlay (see JS below) */
        height: 0;
        width: 100%;
        position: fixed; /* Stay in place */
        z-index: 99999; /* Sit on top */
        left: 0;
        top: 0;
        background-color: rgb(0, 0, 0); /* Black fallback color */
        background-color: rgba(0, 0, 0, 0.9); /* Black w/opacity */
        overflow-x: hidden; /* Disable horizontal scroll */
        transition: 0.5s; /* 0.5 second transition effect to slide in or slide down the overlay (height or width, depending on reveal) */
    }

    /* Position the content inside the overlay */
    .overlay-sub-content {
        position: relative;
        top: 5%;
        width: 100%;
        text-align: center;
        margin-top: 30px;
        background: #fff;
        max-width: 526px;
        margin: auto;
        height: auto;
        margin-bottom: 30px;
        border-radius: 10px;
    }

    /* The navigation links inside the overlay-sub */
    .overlay-sub a {
        padding: 8px;
        text-decoration: none;
        font-size: 36px;
        color: #818181;
        display: block; /* Display block instead of inline */
        transition: 0.3s; /* Transition effects on hover (color) */
    }

    /* When you mouse over the navigation links, change their color */
    .overlay-sub a:hover, .overlay-sub a:focus {
        color: #f1f1f1;
    }

    /* Position the close button (top right corner) */
    .overlay-sub .closebtn {
        position: absolute;
        top: 20px;
        right: 45px;
        font-size: 50px;
    }

    /* When the height of the screen is less than 450 pixels, change the font-size of the links and position the close button again, so they don't overlap */
    @media screen and (max-height: 450px) {
        .overlay-sub a {
            font-size: 20px
        }

        .overlay-sub .closebtn {
            font-size: 40px;
            top: 15px;
            right: 35px;
        }
    }

    @media screen and (max-width: 500px) {

        .sub-pack h2 {
            font-size: 22px
        }

        .overlay-sub-content {
            position: relative;
            top: 10px;

            margin-top: 0px;
            width: 95%;
            text-align: center;
            background: #fff;
            max-width: 526px;
            margin: auto;
            height: auto;
            margin-bottom: 30px;
            border-radius: 10px;
        }

        .overlay-sub {
            background-color: rgb(0, 0, 0); /* Black fallback color */
            background-color: rgba(0, 0, 0, 0.5); /* Black w/opacity */
        }

        .overlay-sub .closebtn {
            position: absolute;
            top: 8px;
            right: 20px;
            font-size: 30px;
            z-index: 99999999;
        }

    }


</style>

<header id="headfi">
    <a href="/"><img class="logo" src="/images/nsuerclublogo.svg" alt="scompanion.club Logo"></a>

    <div id="myCanvasNav" class="overlay3" onclick="closeNav()"></div>

    <div onclick="openNav()" id="navbtn" class="navTrigger showwed" style="margin-top: -4px;">
        <j class="fa fa-bars" style="font-size: 33px; color: #e9e2e2"></j>
    </div>

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="close" onclick="closeNav()"></a>


        <a href="/"><i class="fa fa-home"></i> Home</a>


        <a href="/app/"><i class="fa fa-mobile"></i> Web App</a>
        <a href="/advising-archive/"><i class="fa fa-list-ul"></i> Advising Archive</a>
        <a href="/advising-assistant/"><i class="fa fa-list-ul"></i> Advising Assistant</a>

        <a href="/faculty/"><i class="fa fa-user"></i> Faculty Predictor</a>
        <a href="/videos/"><i class="fa fa-play-circle"></i> Videos</a>

        <a href="/books/"><i class="fa fa-book"></i> Find eBooks</a>

        <a href="/upload/"><i class="fa fa-cloud-upload"></i> Upload Files</a>

        <a href="/food/"><i class="fa fa-cutlery"></i> Food Ratings</a>
        <a href="/cgpa-calculator/"><i class="fa fa-calculator"></i> CGPA Calculator</a>
        <a href="/cgpa-analyzer/"><i class="fa fa-bar-chart"></i> CGPA Analyzer</a>
        <a href="http://fb.me/hmtamim1"><i class="fa fa-envelope"></i> Contact</a>
        <div id="lsb" class="fbottom">
            <?
            if ($islogged == 1)
                echo '<a href="/profile"><i class="fa fa-user-circle"></i> Profile</a><a href="/logout" class="lout"><i class="fa fa-sign-out"></i> Logout</a>';
            else
                echo '<a href="/sign-up"><i class="fa fa-user-plus"></i> Sign up</a><a href="/login"><i class="fa fa-sign-in"></i> Login</a>'; ?>
        </div>
    </div>
</header>
<div class="navmenuWraper">
    <div class="navmenu">
        <?php
        if ($islogged == 0) {
            ?>
            <a href="/login"<?php if ($thisPage == "logg") echo ' class="currentPage"' ?>><i class="fa fa-sign-in"></i>
                Login</a>
            <?php
        }
        ?>

        <a href="/app/"><i class="fa fa-mobile"></i> Web App</a>

        <a href="/advising-assistant/"<?php if ($thisPage == "advisingp") echo ' class="currentPage"' ?>><i
                    class="fa fa-list-ul"></i> Advising Assistant</a>

        <a href="/advising-archive/"<?php if ($thisPage == "advisingar") echo ' class="currentPage"' ?>><i
                    class="fa fa-database"></i> Advising Archive</a>

        <a href="/faculty/"<?php if ($thisPage == "faculp") echo ' class="currentPage"' ?>><i class="fa fa-user"></i>
            Faculty Predictor</a>
        <a href="/videos/"><i class="fa fa-play-circle"></i> Videos</a>

        <a href="/academic-calendar/"<?php if ($thisPage == "academic_calendar") echo ' class="currentPage"' ?>><i
                    class="fa fa-calendar"></i> Academic Calendar</a>
        <a href="/books/"<?php if ($thisPage == "ebooks") echo ' class="currentPage"' ?>><i class="fa fa-book"></i>
            Books</a>

        <a href="/cgpa-calculator/"<?php if ($thisPage == "ccal") echo ' class="currentPage"' ?>><i
                    class="fa fa-calculator"></i> CGPA Calculator</a>
        <a href="/cgpa-analyzer/"<?php if ($thisPage == "cana") echo ' class="currentPage"' ?>><i
                    class="fa fa-bar-chart"></i> CGPA Analyzer</a>

        <a href="/upload/"<?php if ($thisPage == "file") echo ' class="currentPage"' ?>><i
                    class="fa fa-cloud-upload"></i> Upload</a>
        <a href="/food/"<?php if ($thisPage == "food") echo ' class="currentPage"' ?>><i class="fa fa-cutlery"></i> Food</a>
    </div>
</div>
<div id="stop"></div>


<script>
    function openNav() {

        if (screen.width > 600) {

            var vclass = document.getElementById("navbtn").classList;

            if (vclass.contains("showwed")) {

                document.getElementById("navbtn").classList.remove('showwed');

                document.getElementById("mySidenav").style.width = "0px";
                document.getElementById("myCanvasNav").style.width = "0px";
                document.body.style.paddingLeft = "0px";
                document.getElementById("headfi").style.marginLeft = "0px";

                document.getElementById("lsb").style.left = "-230px";
            } else {

                document.getElementById("mySidenav").style.width = "225px";
                document.getElementById("myCanvasNav").style.width = "100%";
                document.getElementById("myCanvasNav").style.opacity = "0.8";
                document.body.style.paddingLeft = "225px";

                document.getElementById("headfi").style.marginLeft = "-225px";

                document.getElementById("lsb").style.left = "0";

                document.getElementById("navbtn").classList.add('showwed');
            }
        } else {

            document.getElementById("mySidenav").style.width = "250px";
            document.getElementById("myCanvasNav").style.width = "100%";
            document.getElementById("myCanvasNav").style.opacity = "0.8";
            document.body.style.overflow = "hidden";
        }
    }


    function closeNav() {

        if (screen.width > 600) {

            document.getElementById("mySidenav").style.width = "225px";
            document.getElementById("myCanvasNav").style.width = "100%";
            document.getElementById("myCanvasNav").style.opacity = "0.8";
            document.body.style.overflow = "hidden";
            document.body.style.paddingLeft = "225px";
            document.getElementById("lsb").style.display = "block";
        }
        else {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("myCanvasNav").style.right = "0";
            document.getElementById("myCanvasNav").style.opacity = "0";
            document.body.style.overflow = "auto";
            setTimeout(
                function () {
                    document.getElementById("myCanvasNav").style.width = "0";
                }, 300);
        }
    }


</script>
<script>
    $('.navmenu').animate({
        scrollLeft: $(".currentPage").offset().left
    }, 6500);

</script>
<div class="fac-container">
    <div class="main">

        <?php

        $url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];


        if (strpos($url, '/') !== false) {

        } else {


        ?>
<?php


}

?>