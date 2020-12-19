<?php


ob_start();


/*
    // Send your response.
    echo "Running in background";

    // Get the size of the output.
    $size = ob_get_length();

    // Disable compression (in case content length is compressed).
    header("Content-Encoding: none");

    // Set the content length of the response.
    header("Content-Length: {$size}");

    // Close the connection.
    header("Connection: close");

    // Flush all output.
    ob_end_flush();
    ob_flush();
    flush();

*/


require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';


require_once "../simple_html_dom.php";

function cleanTags($str)
{
    $string = preg_replace("/\s|&nbsp;/", '', $str);
    return $string;
}


function dlPage($href)
{

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_URL, $href);
    curl_setopt($curl, CURLOPT_REFERER, $href);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.125 Safari/533.4");
    $str = curl_exec($curl);
    curl_close($curl);


    $dom = new simple_html_dom();
    $dom->load($str);

    return $dom;
}

$url = 'http://www.northsouth.edu/faculty-members/sbe/acc-fin/sharif.ahkam.html';

$html = dlPage($url);


$facultyData = $html->find('div[class=body-content]', 0);


$contact = $facultyData->find('div[class=col-md-9]', 0);


$contact = $facultyData->find('strong[plaintext^=Phone]');


$contact = $contact[0]->parent();


$plaintext = $contact->plaintext;

$regex = "/Phone:(.*)\n/";
if (preg_match($regex, $plaintext, $match))
    $phone = $match[1];

$regex = "/(.*)Ext/";
if (preg_match($regex, $phone, $match))
    echo $match[1];


$regex = "/Email:(.*)\n/";
if (preg_match($regex, $plaintext, $match))
    echo $match[1];

$regex = "/Office:(.*)/";
if (preg_match($regex, $plaintext, $match))
    echo $match[1];


?>