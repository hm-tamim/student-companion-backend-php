<?php

ob_start();
session_start();


require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';


$userEmail = trim($_SESSION['email']);


//echo $userEmail;


$uid = $_REQUEST['uid'];


$cc = strtoupper(fresh($_REQUEST['course']));


$id = $db->rawQuery('SELECT * from advisingcourse where email  = ?', Array($userEmail));

if ($id) {

    $courses = $id[0]['courses'];
    $courses = str_replace($cc, '', $courses);

    $courses = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $courses);

    $data = array(
        'email' => $userEmail,
        'courses' => $courses,
    );


    $idd = $id[0]['id'];

    $db->where('id', $idd);
    if ($query = $db->update('advisingcourse', $data)) {
    }


}

header('Location: advising-assistant.php');


//echo '<script>window.location.replace("advising-assistant.php");</script>';


// $coursesArray = explode(PHP_EOL, $courses);

// print_r($coursesArray);



