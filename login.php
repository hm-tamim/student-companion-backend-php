<?php

session_start();

include "lib/func.php";
include 'lib/init.php';

if (isset($_REQUEST['submit'])) {

    $email = $_REQUEST['email'];
    $pass = $_REQUEST['password'];

    if ($email == "admin") {
        if ($pass == "qaz1234") {
            $_SESSION["user_type"] = "admin";
            header('Location: /');
        } else
            echo '<script>alert("Incorrect password!");</script>';
    }
}


?>
<html>
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width">
    <meta name="robots" content="noindex,nofollow"/>
    <link rel="stylesheet" type="text/css" href="styles.css"/>
    <link rel="stylesheet" href="fontawesome/css/all2.css">
    <script src="assets/js/jquery-2.2.4.min.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
</head>


<body>


<div class="login-holder">
    <div class="login-box">
        <div class="login-inside">

            <div class="logo">
                <img src="logo.png">

            </div>


            <form method="POST">

                <input type="text" value="" name="email" placeholder="Enter email address"/>
                <input type="password" name="password" placeholder="Enter password"/>

                <input type="submit" name="submit" value="Login"/>

            </form>
        </div>

    </div>
</div>


<style>

    .login-holder {

        width: 100%;
        height: 100%;
        position: relative;
        background: #f1f3f4;

    }

    .login-holder img {

        max-width: 200px;
        margin-top: 30px;
        margin-bottom: 50px;

    }

    .login-box {

        height: 500px;
        width: 500px;
        background: #fff;
        top: 10%;
        left: 0px;
        right: 0px;
        position: absolute;
        margin-left: auto;
        margin-right: auto;
        border: 1px solid #eee;
        border-radius: 10px;
        padding: 10px;
        text-align: center;

    }

    .login-inside {

        position: relative;
    }

    .login-holder input {

        display: block;
        padding: 15px;
        width: 350px;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 15px;
        font-size: 17px;
        border-radius: 5px;
        border: 1px solid #eee

    }

    .login-holder input[type="submit"] {

        background: #0f9aee;
        border: 1px solid #0f9aee;
        color: #fff;

    }

</style>


</body>
</html>