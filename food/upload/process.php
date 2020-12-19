<?php
############ Configuration ##############
$config["generate_image_file"] = true;
$config["generate_thumbnails"] = true;
$config["image_max_size"] = 1200; //Maximum image size (height and width)
$config["thumbnail_size"] = 280; //Thumbnails will be cropped to 200x200 pixels
$config["thumbnail_prefix"] = ""; //Normal thumb Prefix
$config["destination_folder"] = $_SERVER['DOCUMENT_ROOT'] . '/images/thumb/'; //upload directory ends with / (slash)
$config["thumbnail_destination_folder"] = $_SERVER['DOCUMENT_ROOT'] . '/images/265x265/'; //upload directory ends with / (slash)
$config["upload_url"] = "https://nsuer.club/images/thumb/";
$config["quality"] = 95; //jpeg quality
$config["random_file_name"] = false; //randomize each file name


if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    exit;  //try detect AJAX request, simply exist if no Ajax
}

//specify uploaded file variable
$config["file_data"] = $_FILES["__files"];


//include sanwebe impage resize class
include("resize.class.php");


//create class instance 
$im = new ImageResize($config);


try {
    $responses = $im->resize(); //initiate image resize

    echo '<h3>Thumbnails</h3>';
    //output thumbnails
    foreach ($responses["thumbs"] as $response) {
        echo '<img src="/images/265x265/' . $response . '" class="thumbnails" title="' . $response . '" />';
        echo '<script>document.getElementsByName("image")[0].value="https://nsuer.club/images/thumb/' . $response . '";</script>';
    }

    echo '<h3>Images</h3>';
    //output images
    foreach ($responses["images"] as $response) {
        echo '<img src="' . $config["upload_url"] . $response . '" class="images" title="' . $response . '" />';
    }

} catch (Exception $e) {
    echo '<div class="error">';
    echo $e->getMessage();
    echo '</div>';
}


?>
