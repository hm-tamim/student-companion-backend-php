<?php

header("Access-Control-Allow-Origin: *");

// error_reporting(E_ALL ^ E_NOTICE); // hide the notice
require_once "db-evaly.php";
require_once "MysqliDb.php";
// Connect to the Database
//$db = new MysqliDb($db_host, $db_user, $db_pass, $db_name);


$db = new MysqliDb(Array(
        'host' => $db_host,
        'username' => $db_user,
        'password' => $db_pass,
        'db' => $db_name,
        'charset' => 'utf8mb4')
);
