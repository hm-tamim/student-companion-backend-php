<?php
/**
 * Created by PhpStorm.
 * User: HM Tamim
 * Date: 7/15/2019
 * Time: 11:43 PM
 */


include '../lib/init.php';

include '../lib/func.php';

if (isset($_REQUEST['user_id'])) {

    $data = array(
        'user_id' => cleans($_REQUEST['user_id']),
        'time' => time(),
        'q1' => cleans($_REQUEST['q1']),
        'q2' => cleans($_REQUEST['q2']),
        'q3' => cleans($_REQUEST['q3']),
        'q4' => cleans($_REQUEST['q4']),
        'q5' => cleans($_REQUEST['q5']),
        'q6' => cleans($_REQUEST['q6']),
        'q7' => cleans($_REQUEST['q7']),
        'q8' => cleans($_REQUEST['q8']),
        'q9' => cleans($_REQUEST['q9']),
    );


    $query = $db->insert('surveys', $data);

    if ($query)
        echo "yes";
    else
        echo "false";


}