<?php
session_start();

$email = strtolower($_SESSION['email']);


$file = str_replace(array('\\', '/', '%', '..'), '-', $_REQUEST['filen']);


$loc = $_SERVER['DOCUMENT_ROOT'] . '/files/' . $email . '/' . $file;


unlink($loc);


?>