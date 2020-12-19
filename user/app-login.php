<?php
//include config

include $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';


require_once('includes/config.php');

$response = array("error" => FALSE);


$email = strtolower($_REQUEST['email']);
$password = $_REQUEST['password'];

$response = $user->applogin($email, $password);


echo json_encode($response);


if (!isset($_REQUEST['email'])) $error[] = "Please fill out all fields";
if (!isset($_REQUEST['password'])) $error[] = "Please fill out all fields";


?>
