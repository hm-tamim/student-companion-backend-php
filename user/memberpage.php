<?php require('includes/config.php');

$title = 'Members Page';
include '../head.php';


//if not logged in redirect to login page
if (!$user->is_logged_in()) {
    header('Location: login.php');
    exit();
}

//define page title

//include header template
require('layout/header.php');
?>

<div class="container">

    <div class="row">

        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">

            <h2>Welcome <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES); ?></h2>

            <p>Lots of new tools are coming for registered users. Hang on ;)</p><br/>
            <a href="/cgpa-analyzer"><i class="fa fa-bar-chart"></i> CGPA Analyzer</a><br/><br>

            <p><a href="/cgpa-calculator"><i class="fa fa-calculator"></i> CGPA Calculator</a></br><br>
                <a href="/faculty/"><i class="fa fa-user"></i> Faculty Predictor</a>
            </p>
            <hr>

        </div>
    </div>

</div><br><br>
</div>
</div>

<?php
//include header template
require('../foot.php');
?>
