<?php

ob_start();
session_start();

date_default_timezone_set('Europe/London');




if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $islogged = 1;

} else {
    $islogged = 0;
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/user/includes/config.php');



if (isset($_REQUEST['uid'])) {

    $userid = $_REQUEST['uid'];


    $user->uidlogin($userid);


    setcookie("rememberme2", $userid, time() + (6 * 30 * 24 * 3600));

    $islogged = 1;

} else if (isset($_COOKIE['rememberme2']) && $islogged == 0) {

    $userid = $_COOKIE['rememberme2'];


    $user->uidlogin($userid);


    setcookie("rememberme2", $userid, time() + (6 * 30 * 24 * 3600));

    $islogged = 1;

}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" type="text/css" href="/stylecss4.css"/>
    <link rel="icon" href="/images/favicon.png"/>
    <meta name="viewport" content="width=device-width">
    <meta property="og:image" content="https://nsuer.club/images/ogimg.png"/>
    <script
            src="//code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js" type="text/javascript"></script>
    <script>
        if (location.hostname == "nsuer.club") {
        } else {
            window.location = "https://nsuer.club";
        }
    </script>

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

        body {

            padding: 0px !important;
            margin: auto;
            margin-bottom: 160px;
        }

        .main {
            width: 100% !important;

        }

        .addcontainer {

            border: 0px !important;
        }

        ul {

            list-style: inside;

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

    <script>
        function myScrollTop() {

            $(window).scrollTop(0);
        }
    </script>


</head>
<body onload="myScrollTop();">