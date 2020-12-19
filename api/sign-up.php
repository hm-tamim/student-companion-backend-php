<?php
/**
 * Created by PhpStorm.
 * User: HM Tamim
 * Date: 7/15/2019
 * Time: 11:49 PM
 */


include '../lib/init.php';
include '../lib/func.php';

if (isset($_REQUEST['name'])) {


    $data = array(
        'name' => cleans($_REQUEST['name']),
        'password' => cleans($_REQUEST['password']),
        'phone' => cleans($_REQUEST['phone']),
        'village' => cleans($_REQUEST['village']),
        'father_name' => cleans($_REQUEST['father_name']),
        'nid' => cleans($_REQUEST['nid']),
        'family_members' => cleans($_REQUEST['family_members']),
        'age' => cleans($_REQUEST['age']),
        'occupation' => cleans($_REQUEST['occupation']),
    );


    $query = $db->insert('people', $data);

    echo $query;


}