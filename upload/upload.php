<?php


require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/func.php";


$email = strtolower($_REQUEST['email']);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo '{"status":"error"}';

    die();

}

$loc = $_SERVER['DOCUMENT_ROOT'] . '/files/' . $email . '/';


if (!file_exists($loc)) {
    mkdir($loc, 0755, true);
}

function seoUrli($str)
{
    $a = array('/(à|á|â|ã|ä|å|æ)/', '/(&amp;)/', '/(è|é|ê|ë)/', '/(ì|í|î|ï)/', '/(ð|ò|ó|ô|õ|ö|ø|œ)/', '/(ù|ú|û|ü)/', '/ç/', '/þ/', '/ñ/', '/ß/', '/(ý|ÿ)/', '/(=|\+|\/|\%0d|\\n|\\\|\.|\'|\"|\quot|\[|\]|\{|\}|\||\,|\;|\­|\_|↩|\^|\!|\|\:|\&|\\n|\#|\/|\?| |\(|\))/', '//s', '/-{2,}/s');
    $b = array('a', 'and', 'e', 'i', 'o', 'u', 'c', 'd', 'n', 'ss', 'y', '-', '', '-');
    $c = trim(preg_replace($a, $b, $str), '-');
    $d = preg_replace('/-{2,}/', '-', $c);
    $ee = str_replace(array("\r", "\n"), '', $d);
    $e = trim($ee, ' ');
    $f = preg_replace('/ {2,}/', '-', $e);

    $fg = trim(preg_replace('/-+/', '-', $f), '-');
    return trim($fg, '-');
}

if (isset($_REQUEST['txt']) && !empty($_REQUEST['txt'])) {


    if (isset($_REQUEST['dfile']) && !empty($_REQUEST['dfile'])) {

        $dfile = $loc . $_REQUEST['dfile'];
        unlink($dfile);

    }
    $tt = truncate(seoUrli($_REQUEST['txt']), 30);


    $fileLocation = $loc . $tt . '.txt';
    $file = fopen($fileLocation, "w");
    $content = $_REQUEST['txt'];
    fwrite($file, $content);
    fclose($file);

}


$allowed = array('php', 'phps', 'php3', 'phtml');

if (isset($_FILES['upl']) && $_FILES['upl']['error'] == 0) {

    $extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

    if (in_array(strtolower($extension), $allowed)) {
        echo '{"status":"error"}';
        exit;
    }

    if (move_uploaded_file($_FILES['upl']['tmp_name'], $loc . $_FILES['upl']['name'])) {
        echo '{"status":"success"}';
        exit;
    }
}

