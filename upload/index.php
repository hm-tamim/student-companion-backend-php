<?php
require_once '../lib/init.php';
require_once '../includes/func.php';
require_once '../lib/pagination.class.php';

$thisPage = "file";

$dmeta = '<meta name="description" content="Your virtual pendrive. Upload, download and manage files easily."/>';


$title = 'Upload, Download and Transfer files easily.';
include '../head.php';


$uEmail = $_SESSION['email'];

if (isset($_REQUEST['submit'])) {
    $uEmail = $_REQUEST['email'];
}


?>

    <meta charset="utf-8"/>

    <link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet'/>


    <form id="upload" class="shadow" method="post" action="upload.php" enctype="multipart/form-data">
        <div class="rowww">

            <input class="basic-slide" type="text" name="email" placeholder="Enter your NSUer.Club's email..."
                   value="<?php echo $uEmail; ?>"/>
            <label for="email">EMAIL</label>
        </div>
        <div id="drop">
            Drop Here
            <br/>
            <a>Browse</a>
            <input type="file" name="upl" multiple/>
        </div>

        <ul>
            <!-- The file uploads will be shown here -->
        </ul>
        <div class="text">

<textarea id="tetx" name="txt"><?php

    if (isset($_REQUEST['editText'])) {
        $loc = $_SERVER['DOCUMENT_ROOT'] . '/files/' . strtolower($_SESSION['email']) . '/';

        $fileLocation = $loc . $_REQUEST['editText'];


        $filez = file_get_contents($fileLocation);


        echo $filez;
    } ?></textarea>
            <?php

            if (isset($_REQUEST['editText'])) {
                echo '<input type="hidden" name="dfile" value="' . $_REQUEST['editText'] . '">';
            } ?>
            <a class="buttonz" name="submit" onclick="saveText(this);  return false;" href="javascript:void(0)">SAVE
                TEXT ONLY</a>
        </div>
        <p class="">
            <br>
            File Uploader is like a virtual pendrive. Just enter the email that you used while registering account on
            NSUer.Club. If you are already logged-in, then you won't have to enter the email. Now select your files or
            copy-paste texts and click on Save button.
            <br><br>
            As you login to NSUer.Club with that same email, you will able to see all the files you uploaded on the
            sidebar, and you will able to download, copy, edit or delete whatever you want.
            <br><br>

            <b>Here is some tips:</b>
            <br>
            1. You can use it as an email too. E.g. enter your friend's email instead of yours, upload files/text to
            send them.
            <br>
            2. Use it as a file transfer tool, e.g. copying files/texts from phone to computer.
            <br><br>

            Upload limit is 20mb and expires after 2 month.

        </p>

    </form>

    <br>


    </div>
    <div class="sidebar">


        <?php
        ?>


        <style>
            #upload ul li span {

                background: url('/upload/assets/img/icons.png') no-repeat;

            }
        </style>


        <script src="assets/js/jquery.knob.js"></script>

        <script src="assets/js/jquery.ui.widget.js"></script>
        <script src="assets/js/jquery.iframe-transport.js"></script>
        <script src="assets/js/jquery.fileupload.js"></script>
        <script src="assets/js/script.js"></script>


        <?php

        $reff = 'upload';

        include '../addcoursebar.php';

        ?>
        <div class="addcontainer bar1 shadow">
            <h2>Disclaimer</h2>NSUer.Club is a poll website faculties of NSU. The ranking of faculties are determined by
            the count of votes given by students. Ranking doesn't mean to disrespect any faculty members.
        </div>
    </div>
    <div style="clear: both"></div></div>

<?php
include '../foot.php';

?>