<?php

require_once 'lib/init.php';
require_once 'includes/func.php';
require_once 'lib/pagination.class.php';

$title = 'Add Faculty - NSUer.Club';


$facc = "111";

$thisPage = "facul";

include 'head.php';


?>
    <div class="addcontainer">

    <p>Please don't spam. We are just helping students.<br/> <br/>
        You can add multiple faculties by separating with comma.(Example: SBS,ADF,NBM)
    </p>
    <br/>
    <form action="/addcourse.php" method="POST">
        <input type="text" name="course" value="<?php echo $_GET['course']; ?>" placeholder="Enter course initial"><br/>
        <input type="text" name="faculty" value="" placeholder="Enter faculty initial"><br/>
        <input type="submit" name="submit" value="ADD COURSE">
    </form>


<?php

$cc = fresh($_REQUEST['course']);

$id = $db->rawQuery('SELECT * from sites1 where course  = ?', Array($cc));

$idd = $id[0]['id'];

// echo $idd;

$json = unserialize($id[0]["faculty"]);


$fac = fresh($_REQUEST['faculty']);

$ck = 0;

if (strpos($fac, ',') !== false) {

    $myArray = explode(',', $fac);

    foreach ($myArray as $my_Array) {

        if (in_array_r($my_Array, $json)) {
        } else {

            if ($my_Array($fac) < 5 && $my_Array($fac) > 1) {
                $json[] = array('name' => $my_Array, 'vote' => 0);
                $ck = 1;
            }
        }
    }
} else {
    if (in_array_r($fac, $json)) {
    } else {
        if (strlen($fac) < 5 && strlen($fac) > 1) {
            $json[] = array('name' => $fac, 'vote' => 0);
            $ck = 1;
        }
    }
}


$json = serialize($json);


if (isset($_REQUEST['submit'])) {
    if (!empty($cc)) {

        if (strlen($cc) < 8 && strlen($cc) > 2 && $ck == 1) {


            $r = preg_match_all("/.*?(\d+)$/", $cc, $matches);

            if ($r > 0) {

                $data = array(
                    'course' => strtoupper($cc),
                    'faculty' => $json,
                );


                if (!$db->rawQuery('SELECT id from sites1 where course = ?', Array($cc))) {
                    $query = $db->insert('sites1', $data);
                    echo '<br><div><b>Faculty Initial Added</b></div>';
                } else {

                    $db->where('id', $idd);
                    if ($db->update('sites1', $data))
                        echo '<br><div><b>Faculty Initial Added</b></div>';
                }
            }
        }
    }


    header('Location: /');
}


echo '</div>';


include 'foot.php';


?>