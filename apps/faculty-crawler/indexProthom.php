<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

set_time_limit(0);
//ob_start();


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
    $string = preg_replace("/\s|&nbsp;/", ' ', $str);

    $string = preg_replace("/   /", '', $string);
    $string = preg_replace("/<p>/", ' ', $string);

    $string = preg_replace("/<\/p>/", ' ', $string);

    return $string;
}

function cleanTags2($str)
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


?>


    <html>
    <title>Faculty Data Crawler</title>

    <body>

    <form method="POST">

        Page URL: <br>
        <input type="text" name="url" placeholder="Enter Url"
               value="https://service.prothomalo.com/abashonmela/stall/3/assure-group">
        <br>
        <br>

        <input type="submit" name="submit" value="Submit">

    </form>


    <style>

        body {

            margin: auto;

            max-width: 600px;

            margin-top: 50px;
        }

        input {

            padding: 20px;
            width: 100%;

        }


    </style>
    </body>
    </html>


<?php


$url = $_REQUEST['url'];

$html = dlPage($url);


$notices = $html->find('div[class=mosh-portfolio]', 0);


$data = array();


$length = sizeof($notices->find('div[class=flat]'));

echo 'Total Ads: ' . $length . '<br><br>';


$facultyArr = $notices->find('div[class=flat]');


for ($j = 0; j < $length; $j++) {


    $row = $facultyArr[$j];


    $title = "";
    $location = "";
    $image = "";
    $size = "";
    $price = "";


    $image = $row->find('img', 0)->src;


    echo '<img src="' . $image . '">';


    echo '<br>';

    $title = $row->find('p', 0)->plaintext;

    echo 'Title';

    echo '<input value="' . $title . '">';


    $location = cleanTags($row->find('p[class=place]', 0)->plaintext);


    echo 'Location';

    echo '<input value="' . $location . '">';


    $size = $row->find('p', 2);


    echo 'Size';

    echo '<input value="' . cleanTags($size) . '">';


    $price = $row->find('p[class=price]', 0)->plaintext;


    echo 'Price';


    echo '<input value="' . $title . '">';


    $discount = $row->find('p[class=discount]', 0)->plaintext;


    echo 'Discount';

    echo '<input value="' . $discount . '">';


    echo '<br>';
    echo '<br>';
    echo '<br>';

    echo '<br>';
    echo '<br>';
    echo '<br>';
}


?>