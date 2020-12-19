<?php

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));

if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/bot|crawl|slurp|spider/i', $_SERVER['HTTP_USER_AGENT'])) {

    die();
}

// echo $_SERVER["HTTP_CF_CONNECTING_IP"];

//  if(preg_match('(110.76.128.71|110.76.128|103.231.160|103.231.162|110.76.129.198|110.76.128.65|64.233.173)', $_SERVER['REMOTE_ADDR']) === 0) {
// echo $_SERVER['REMOTE_ADDR'];
// exit();
// }


$server = '127.0.0.1';
$user = 'tmasvpgh_ck';
$pass = 'Toolsmashdb420';
$db = 'tmasvpgh_nsuer';

$db_host = '127.0.0.1';
$db_user = 'tmasvpgh_ck';
$db_pass = 'Toolsmashdb420';
$db_name = 'tmasvpgh_nsuer';


$connection = mysql_connect($server, $user, $pass)

or die ("Could not connect to server ... \n" . mysql_error());

mysql_select_db($db)

or die ("Could not connect to database ... \n" . mysql_error());

mysql_query('SET character_set_results=utf8');
mysql_query('SET names=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_results=utf8');
mysql_query('SET collation_connection=utf8_general_ci');


?>