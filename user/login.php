<?php
//include config

include $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';

if (!isset($_COOKIE['rememberme2'])) {
    require_once('includes/config.php');
}


$title = "Sign In- NSUer.Club";

$thisPage = "logg";

include '../head.php';

/*
if( $user->is_logged_in() ){ 

if(!empty($_REQUEST['ref'])){
	header('Location: /'.$_REQUEST['ref']);
exit;
}else{
header('Location: /user/memberpage.php'); exit(); 
}
}

*/


if (isset($_POST['submit'])) {

    if (!isset($_POST['email'])) $error[] = "Please fill out all fields";
    if (!isset($_POST['password'])) $error[] = "Please fill out all fields";

    $email = trim(strtolower($_POST['email']));
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (!isset($_POST['password'])) {
            $error[] = 'A password must be entered';
        }
        $password = $_POST['password'];

        if ($user->login($email, $password)) {
            $_SESSION['email'] = $email;

            if (!empty($_REQUEST['ref'])) {
                header('Location: /' . $_REQUEST['ref']);
                exit;

            } else {

                header('Location: /user/memberpage.php');

                exit;
            }

        } else {
            $error[] = 'Wrong email or password or your account has not been activated.';
        }
    } else {
        $error[] = 'emails are required to be Alphanumeric, and between 3-16 characters long';
    }


}//end if submit

//define page title
$title = 'Login';

//include header template
require('layout/header.php');
?>


<style>

    .loginEmail {

        border-radius: 3px;
        border: 1px solid #e9e0e0;
    }

    .loginPass {

        border: 1px solid #e9e0e0;
        border-radius: 3px;

    }

    .loginButton {

        width: 100%;
        border-radius: 3px;

    }

    .input-lg {
        font-size: 16px !important;
        border-color: #e9e0e0;
    }

    .input-group {
        margin-bottom: 20px;
    }

    .input-group-addon {
        border-color: #e9e0e0;

    }
</style>

<div class="container">

    <div class="row">

        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <form role="form" method="post" action="" autocomplete="off">
                <h3>Please Login</h3>
                <p>Don't have account? <b><a href='/sign-up'>Sign up</a></b></p>
                <hr>

                <?php
                //check for any errors
                if (isset($error)) {
                    foreach ($error as $error) {
                        echo '<p class="bg-danger">' . $error . '</p>';
                    }
                }

                if (isset($_GET['action'])) {

                    //check the action
                    switch ($_GET['action']) {
                        case 'active':
                            echo "<h2 class='bg-success'>Your account is now active you may now log in.</h2>";
                            break;
                        case 'reset':
                            echo "<h2 class='bg-success'>Please check your inbox for a reset link.</h2>";
                            break;
                        case 'resetAccount':
                            echo "<h2 class='bg-success'>Password changed, you may now login.</h2>";
                            break;
                    }

                }


                ?>

                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="text" name="email" id="email" class="form-control input-lg loginEmail"
                           placeholder="Email Address" value="<?php if (isset($error)) {
                        echo htmlspecialchars($_POST['email'], ENT_QUOTES);
                    } ?>" tabindex="1">
                </div>

                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input type="password" name="password" id="password" class="form-control input-lg loginPass"
                           placeholder="Password" tabindex="3">
                </div>


                <div>
                    <div><input type="submit" name="submit" value="Login"
                                class="btn btn-primary btn-block btn-lg loginButton form-control input-lg" tabindex="5">
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-xs-9 col-sm-9 col-md-9">
                        <a href='/user/reset.php'>Forgot your Password?</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<br><br><br>
</div>
<br/>


</div>
<br>
<br>
<br>

<?php


include '../foot.php';

?>
