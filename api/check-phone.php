<?php
/**
 * Created by PhpStorm.
 * User: HM Tamim
 * Date: 7/16/2019
 * Time: 1:18 AM
 */

include '../lib/init.php';


$phone = $_REQUEST['phone'];

$json = $db->rawQuery("SELECT id from people WHERE phone LIKE '%$phone%'");

if ($json)
    echo "yes";
else
    echo "no";

