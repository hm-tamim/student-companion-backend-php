<?php

include $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';

if (!isset($_COOKIE['rememberme'])) {

}
require_once('includes/config.php');


//collect values from the url
$memberID = trim($_GET['x']);
$active = trim($_GET['y']);

//if id is number and the active token is not empty carry on
if (is_numeric($memberID) && !empty($active)) {

    //update users record set the active column to Yes where the memberID and active value match the ones provided in the array
    $stmt = $dbb->prepare("UPDATE members SET active = 'Yes' WHERE memberID = :memberID AND active = :active");
    $stmt->execute(array(
        ':memberID' => $memberID,
        ':active' => $active
    ));

    //if the row was updated redirect the user
    if ($stmt->rowCount() == 1) {

        //redirect to login page
        header('Location: /user/login.php?action=active');
        exit;

    } else {
        header('Location: /user/login.php?action=active');
        echo "Your account could not be activated.";
    }

}
?>