<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';


function cleans($str)
{

    $file = str_replace(array('\\', '/', '%', '..', '='), ' ', $str);

    return $file;

}


$response = array("error" => FALSE);


$uid = cleans($_REQUEST['uid']);
$course = strtoupper(cleans($_REQUEST['course']));
$post = cleans($_REQUEST['post']);


$user = $db->rawQuery("SELECT * FROM members WHERE uid = '$uid'");


if (!$user || empty($post)) {

    $response['error'] = TRUE;
    echo json_encode($response);

    die();
}

$name = $user['0']['username'];


$dp = $user['0']['picture'];

$memID = $user['0']['memberID'];

$gender = $user['0']['gender'];


$data = array(
    'memID' => $memID,
    'course' => $course,
    'post' => $post,
    'time' => time(),
);


$query = $db->insert('groupPosts', $data);

if (!$query)
    $response['error'] = TRUE;


echo json_encode($response);


?>