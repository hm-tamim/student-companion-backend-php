<?php
error_reporting(E_ALL & ~E_NOTICE);
include "lib/session_header.php";
include "lib/func.php";
include 'lib/init.php';
require_once 'lib/pagination.class.php';
require_once 'includes/func.php';

?>
<html>
<head>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width">
    <meta name="robots" content="noindex,nofollow"/>
    <link rel="stylesheet" href="/fontawesome/css/all2.css">

    <link rel="stylesheet" href="/assets/css/bootstrap-3.3.2.min.css">
    <link rel="stylesheet" href="/assets/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="/styles.css"/>
    <script src="/assets/js/jquery-2.2.4.min.js"></script>
    <script src="/assets/js/jquery-ui.min.js"></script>
    <script src="/assets/js/circle.js"></script>
    <script src="/assets/js/bootstrap-multiselect.js"></script>
    <script src="/assets/js/bootstrap-3.3.2.min.js"></script>
    <script src="/assets/js/canvasjs.js"></script>
</head>
<body>

<div class="main-container">

    <div class="header">
        <div class="header-left">
            <i class="fal fa-bars" style="font-size: 28px;"></i>


        </div>


        <div class="header-right">
            <span class="user-name"><?php
                if ($user_type == "admin")
                    echo "Admin";
                else
                    echo $_SESSION['chair_name'];

                ?></span> <i class="fas fa-user-circle" style="font-size: 28px;"></i>
        </div>

        <div class="clear"></div>

    </div>

    <div class="sidebar">
        <div class="sidebar-inner">


            <div class="logo">
                <img src="/logo.png"/>

            </div>


            <ul class="sidebar-menu scrollable pos-r ps">

                <li class="nav-item mT-30 active">
                    <a class="sidebar-link" href="/">
                            <span class="icon-holder">
                                <i class="far fa-home"></i>
                            </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>


                <li class="nav-item mT-30 active">
                    <a class="sidebar-link" href="/pages/members/">
                            <span class="icon-holder">
                                <i class="fal fa-user-friends"></i>
                            </span>
                        <span class="title">Students</span>
                    </a>
                </li>

                <li class="nav-item mT-30 active">
                    <a class="sidebar-link" href="/pages/donors">
                            <span class="icon-holder">
                                <i class="far fa-tint"></i>
                            </span>
                        <span class="title">Blood Donors</span>
                    </a>
                </li>

                <li class="nav-item mT-30 active">
                    <a class="sidebar-link" href="/pages/blood-requests">
                            <span class="icon-holder">
                                <i class="far fa-file-alt"></i>
                            </span>
                        <span class="title">Blood Requests</span>
                    </a>
                </li>


                <li class="nav-item mT-30 active">
                    <a class="sidebar-link" href="/pages/universities">
                            <span class="icon-holder">
                                <i class="far fa-map-marker-alt"></i>
                            </span>
                        <span class="title">Universities</span>
                    </a>
                </li>


                <li class="nav-item mT-30 active">
                    <a class="sidebar-link" href="/pages/teachers/">
                            <span class="icon-holder">
                                <i class="far fa-users-crown"></i>
                            </span>
                        <span class="title">Teachers</span>
                    </a>
                </li>

                <li class="nav-item mT-30 active">
                    <a class="sidebar-link" href="/logout.php">
                            <span class="icon-holder">
                                <i class="far fa-sign-out"></i>
                            </span>
                        <span class="title">Logout</span>
                    </a>
                </li>


            </ul>
        </div>

    </div>
