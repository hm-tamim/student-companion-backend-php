<?php

// $_SERVER['DOCUMENT_ROOT'] = dirname(dirname(__FILE__));

//  ob_start();

//     // Send your response.
//     echo "Running in background";

//     // Get the size of the output.
//     $size = ob_get_length();

//     // Disable compression (in case content length is compressed).
//     header("Content-Encoding: none");

//     // Set the content length of the response.
//     header("Content-Length: {$size}");

//     // Close the connection.
//     header("Connection: close");

//     // Flush all output.
//     ob_end_flush();
//     ob_flush();
//     flush();


require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/pagination.class.php';


require_once $_SERVER['DOCUMENT_ROOT'] . '/app/simple_html_dom.php';


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

$url = 'https://rds2.northsouth.edu/index.php/common/showofferedcourses';
$table = dlPage($url);


$iddp = $db->rawQuery("TRUNCATE TABLE courseDataApp");

foreach ($table->find('tr') as $tr) {


    $id = trim($tr->find('td', 0)->plaintext);
    $course = trim($tr->find('td', 1)->plaintext);
    $section = trim($tr->find('td', 2)->plaintext);
    $faculty = trim($tr->find('td', 3)->plaintext);
    $time = trim($tr->find('td', 4)->plaintext);
    $room = trim($tr->find('td', 5)->plaintext);
    $capacity = trim($tr->find('td', 6)->plaintext);


    $courseArray = explode("/", $course);

    for ($j = 0; $j < sizeof($courseArray); $j++) {

        $arr = preg_split('/ +-? *(?=\d)/', $time);

        // $idd = $db->rawQuery("SELECT * FROM courseDataApp WHERE faculty = '$faculty' AND course = '$courseArray[$j]' AND section = '$section'");

        // if(!$idd){
        // }

        // if(strcmp($faculty, 'TBA') != 0){
        // }


        $data = array(
            'faculty' => $faculty,
            'course' => $courseArray[$j],
            'section' => $section,
            'day' => $arr[0],
            'startTime' => $arr[1],
            'endTime' => $arr[2],
            'room' => $room
        );


        $query = $db->insert('courseDataApp', $data);
        echo '<br/><div><b>Course Added</b></div>';


    }


}


echo "";


die();


?>