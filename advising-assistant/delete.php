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

$arr = explode(",", $_REQUEST['course']);


print_r($arr);

$course = strtoupper(fresh($arr[0]));
$section = strtoupper(fresh($arr[1]));

$id = $db->rawQuery("DELETE FROM AdvisingCourseList WHERE memID = '$userEmail' AND course = '$course' AND section = '$section'");


header('Location: /advising-assistant');








// $coursesArray = explode(PHP_EOL, $courses);

// print_r($coursesArray);



