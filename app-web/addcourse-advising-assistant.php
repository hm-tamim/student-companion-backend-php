<?php

ob_start();
session_start();


require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';


$userEmail = trim($_SESSION['email']);


$cc = strtoupper(fresh($_REQUEST['course']) . "," . fresh($_REQUEST['section']));


$id = $db->rawQuery('SELECT * from advisingcourse where email  = ?', Array($userEmail));

if (!$id) {
    $data = array(
        'email' => $userEmail,
        'courses' => $cc,
    );

    $query = $db->insert('advisingcourse', $data);

} else {


    $courses = $id[0]['courses'];
    $courses .= PHP_EOL . $cc;

    $courses = preg_replace('/^\h*\v+/m', '', $courses);;

    $data = array(
        'email' => $userEmail,
        'courses' => $courses,
    );


    $idd = $id[0]['id'];

    $db->where('id', $idd);
    if ($query = $db->update('advisingcourse', $data)) {
    }

}

header('Location: /app/advising-assistant.php');








// $coursesArray = explode(PHP_EOL, $courses);

// print_r($coursesArray);



