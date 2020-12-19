<?php

set_time_limit(0);
ini_set('max_execution_time', 0); //0=NOLIMIT


error_reporting(E_ALL);
ini_set('display_errors', 1);


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
        <input type="text" name="url" placeholder="Enter Url" value="<?php echo $_REQUEST['url']; ?>">
        <br>
        <br>
        Department:<br>
        <input type="text" name="dept" placeholder="Enter department" value="<?php echo $_REQUEST['dept']; ?>">
        <br>
        <br>
        Page no:<br>
        <input type="text" name="page" placeholder="Enter page no" value="<?php echo $_REQUEST['page']; ?>">
        <br><br>
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

$dp = $_GET['dept'];

$database = $db->rawQuery("SELECT * FROM facultyDatabase WHERE phone LIKE '%8200%' AND dept = $dp");


$length = sizeof($database);


$k = 0;

for ($j = 0; i < $length; $j++) {


    // $g = $k + 4;

    // if($j==g)
    //     break;


    $row = $database[$j];


    $initial = $row['initial'];


    $name = "";
    $image = "";
    $url = "";
    $rank = "";
    $phone = $row['phone'];

    $url = $row['url'];


    $email = "";
    $office = "";
    $string = "";
    $ext = "";


    $url = 'http://ece.northsouth.edu/people/' . $url;


    $facultyHtml = dlPage($url);


    $facultyData = $facultyHtml->find('div[class=staff-box]', 0);


// $contact = $facultyData->find('div[class=col-md-9]',0);


    $plaintext = $facultyData->plaintext;


    /*

    $regex = "/Phone:(.*)\n/";
    if (preg_match($regex, $plaintext, $match))
        $phone = cleanTags($match[1]);

    $regex = "/(.*)Ext/";
        if (preg_match($regex, $phone, $match))
        $phone = cleanTags($match[1]);


    $regex = "/Email:(.*)\n/";
    if (preg_match($regex, $plaintext, $match))
        $email = cleanTags($match[1]);

    $regex = "/Office:(.*)(.\d)/";
    if (preg_match($regex, $plaintext, $match))
        $office = cleanTags($match[1] . $match[2]);


      */


    $regex = "/Ext (:|-|.|–|) (.\d+)/";
    if (preg_match($regex, $plaintext, $match))
        $ext = cleanTags($match[2]);


    if ($ext == null)
        continue;


    $data = array(
        'ext' => $ext,
    );


    if ($db->rawQuery('SELECT id from facultyDatabase where initial = ?', Array($initial))) {

        $db->where('initial', $initial);
        if ($db->update('facultyDatabase', $data))
            echo '<br/><div><b>Course Added</b></div>';


        echo '<pre>';

        print_r($data);

        echo '</pre>';


    }


}


// Flush all output.
ob_end_flush();
ob_flush();
flush();

die();

?>