<?php

ob_start();
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';


if (!isset($_SESSION['email'])) {
    header("Location: /login");
    die();
}

$userEmail = trim($_SESSION['memberID']);

$course = strtoupper(fresh($_REQUEST['course']));
$section = fresh($_REQUEST['section']);


$id = $db->rawQuery("SELECT * from AdvisingCourseList WHERE memID = '$userEmail' AND course = '$course' AND section = '$section'");

if (!$id) {

    $data = array(
        'memID' => $userEmail,
        'course' => $course,
        'section' => $section
    );

    if (!empty($course)) {

        $query = $db->insert('AdvisingCourseList', $data);
    }

} 
 