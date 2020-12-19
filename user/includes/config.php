<?php
//set timezone

ob_start();
session_start();

//set timezone
date_default_timezone_set('Europe/London');


$db_host = '127.0.0.1';
$db_user = 'tmasvpgh_ck';
$db_pass = 'Toolsmashdb420';
$db_name = 'tmasvpgh_nsuer';

//database credentials
define('DBHOST', $db_host);
define('DBUSER', $db_user);
define('DBPASS', $db_pass);
define('DBNAME', $db_name);

//application address
define('DIR', 'http://nsuer.club/user/');
define('SITEEMAIL', 'noreply@nsuer.club');

try {

    //create PDO connection
    $dbb = new PDO("mysql:host=" . DBHOST . ";charset=utf8mb4;dbname=" . DBNAME, DBUSER, DBPASS);
    //$dbb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);//Suggested to uncomment on production websites
    $dbb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Suggested to comment on production websites
    $dbb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

} catch (PDOException $e) {
    //show error
    echo '<p class="bg-danger">' . $e->getMessage() . '</p>';
    exit;
}

//include the user class, pass in the database connection
include($_SERVER['DOCUMENT_ROOT'] . '/user/classes/user.php');
include($_SERVER['DOCUMENT_ROOT'] . '/user/classes/phpmailer/mail.php');
$user = new User($dbb);


?>
