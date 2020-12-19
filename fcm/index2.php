<?php

session_start(); ?>

<html>
<head>
    <meta charset="UTF-8">
    <title>NSUer.Club</title>

    <meta name="robots" content="noindex,nofollow"/>

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
    <meta property="og:image" content="https://nsuer.club/images/ogimg.png"/>

    <style>

        input, textarea {

            width: 100%;
            border: 1px solid #ddd;
            padding: 15px;
            padding-left: 10px;
            min-height: 40px;
            margin-bottom: 10px;

        }

        html {

            max-width: 600px;
            margin: auto;

        }

    </style>

</head>


<body style="margin: auto; padding-left: 0px; max-width: 600px;">


<div style="padding: 40px;  ; margin: auto">

    <?php

    function sendFCM($mess, $title, $id, $type, $type2)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
            'to' => $id,
            'priority' => "high",
            'data' => array(
                "body" => $mess,
                "title" => $title,
                "icon" => "ic_status_icon",
                "sound" => "default",
                "type" => $type,
                "typeExtra" => $type2,
                "senderMemID" => "30000",
            )
        );
        $fields = json_encode($fields);
        $headers = array(
            'Authorization: key=' . "AIzaSyB99IR5Y7P5q4g9vAaD-lyfDyfYY8hAVe8",
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        $result = curl_exec($ch);

        echo $result;

        curl_close($ch);
    }


    /*

    'notification' => array (
                    "body" => $mess,
                    "title" => $title,
                    "icon" => "ic_launcher",
                    "sound"=> "default",
                    "click_action" => "MainActivity"
            ),

            */


    // /topics/nsuer


    $userEmail = $_SESSION['email'];

    if ($userEmail != "hmtamim7@gmail.com")
        die();


    //sendFCM("HM Tamim: Guys, we have lab class tomorrow","EEE141.8","/topics/USER.20");

    // eZBQRYQGhno:APA91bHYeipsNxHoPjaQoZEuJyCLr_UgxLZyWLnKC__RIT84XF8g2WOJsLRDOhcTTG5SB0VkblF4AGbt1dVSyK3z__hiHQih0BhrAHxmDT4CWgewwcJ7vBY4ZPt-vkrPfD2jIzcmAWEk


    ?>


    <form method="POST">

        <input value="USER.20" name="topic"><br>
        <input value="" placeholder="Type..." name="type"><br>
        <textarea value="" placeholder="Type extra..." name="type2"></textarea><br>
        <input value="" placeholder="Title..." name="title"><br>
        <textarea value="" placeholder="Message..." name="message"></textarea><br>

        <input type="submit" name="submit" value="Send">


    </form>

    <br><br>

    <?php


    if (isset($_REQUEST['submit'])) {

        $message = $_REQUEST['message'];
        $title = $_REQUEST['title'];
        $topic = $_REQUEST['topic'];
        $type = $_REQUEST['type'];;
        $type2 = $_REQUEST['type2'];;

        $act = "toast";

        sendFCM($message, $title, "/topics/" . $topic, $type, $type2);


    }


    ?>


</div>


</body>

</html>


