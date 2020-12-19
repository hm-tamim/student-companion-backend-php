<?php


ob_start();

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


require_once "../simple_html_dom.php";


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


$url = 'http://www.northsouth.edu/nsu-announcements/';


$html = dlPage($url);


$notices = $html->find('div[class=body-content]', 0);


$data = array();

foreach ($notices->find('div[class=post-scroller-item]') as $row) {


    $title = trim(strip_tags($row->find('a', 0)->innertext));

    $url = trim(strip_tags($row->find('a', 0)->href));


    $c = count($row->find('span'));

    $c--;


    $date = trim(strip_tags($row->find('span', $c)->plaintext));


    $data[] = array(
        'title' => $title,
        'url' => $url,
        'date' => $date,

    );


}


$kson["dataArray"] = $data;

$json = json_encode($kson);

$type = "notice";

file_put_contents($type . '.json', $json);

echo "Updated";


?>