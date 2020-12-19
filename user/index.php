<?php


include $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';

if (!isset($_COOKIE['rememberme'])) {
    require_once('includes/config.php');
}


$title = "Sign Up - NSUer.Club";

include '../head.php';


//if logged in redirect to members page
if ($user->is_logged_in()) {
    header('Location: /user/memberpage.php');
    exit();
}

//if form has been submitted process it
if (isset($_POST['submit'])) {

    if (!isset($_POST['username'])) $error[] = "Please fill out all fields";
    if (!isset($_POST['email'])) $error[] = "Please fill out all fields";
    if (!isset($_POST['password'])) $error[] = "Please fill out all fields";
    if (!isset($_POST['gender'])) $error[] = "Please fill out all fields";


    $email = strtolower($_POST['email']);
    $username = htmlspecialchars_decode($_POST['username'], ENT_QUOTES);;
    $gender = strtolower($_POST['gender']);

    $emailz = htmlspecialchars_decode($_POST['email'], ENT_QUOTES);


    $domains = array("aol.com", "att.net", "comcast.net", "facebook.com", "gmail.com", "gmx.com", "googlemail.com", "google.com", "hotmail.com", "hotmail.co.uk", "mac.com", "me.com", "mail.com", "msn.com", "live.com", "sbcglobal.net", "verizon.net", "yahoo.com", "yahoo.co.uk", "email.com", "fastmail.fm", "games.com", "gmx.net", "hush.com", "hushmail.com", "icloud.com", "iname.com", "inbox.com", "lavabit.com", "love.com", "outlook.com", "pobox.com", "protonmail.com", "rocketmail.com", "safe-mail.net", "wow.com", "ygm.com", "ymail.com", "zoho.com", "yandex.com", "northsouth.edu");


    $domain_name = strtolower(substr(strrchr($email, "@"), 1));


    if (in_array($domain_name, $domains)) {
    } else {
        $error[] = "Email extension doesn't support. Try gmail, yahoo or hotmail.";

    }


    if (strlen($_POST['password']) < 3) {
        $error[] = 'Password is too short.';
    }

    if (strlen($_POST['passwordConfirm']) < 3) {
        $error[] = 'Confirm password is too short.';
    }

    if ($_POST['password'] != $_POST['passwordConfirm']) {
        $error[] = 'Passwords do not match.';
    }

    //email validation
    $email = strtolower(htmlspecialchars_decode($_POST['email'], ENT_QUOTES));
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = 'Please enter a valid email address';
    } else {
        $stmt = $dbb->prepare('SELECT email FROM members WHERE email = :email');
        $stmt->execute(array(':email' => $email));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!empty($row['email'])) {
            $error[] = 'Email provided is already in use.';
        }

    }


    //if no errors have been created carry on
    if (!isset($error)) {

        //hash the password
        $hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

        //create the activasion code
        $activasion = md5(uniqid(rand(), true));
        $uid = md5(uniqid(time(), true));

        try {

            //insert into database with a prepared statement
            $stmt = $dbb->prepare('INSERT INTO members (username,password,email,gender,uid,active) VALUES (:username, :password, :email, :gender, :uid, :active)');
            $stmt->execute(array(
                ':username' => $username,
                ':password' => $hashedpassword,
                ':email' => $email,
                ':gender' => $gender,
                ':uid' => $uid,
                ':active' => $activasion
            ));
            $id = $dbb->lastInsertId('memberID');

            //send email
            $to = $_POST['email'];
            $subject = "Registration Confirmation";
            $body = "<p>Thank you for registering at NSUer.Club</p><br/>
			<p>To activate your account, please click on this link: <a href='" . DIR . "activate.php?x=$id&y=$activasion'>" . DIR . "activate.php?x=$id&y=$activasion</a></p><br/>
			<p>Regards<br/>Admin</p>";

            $mail = new Mail();
            $mail->setFrom(SITEEMAIL);
            $mail->addAddress($to);
            $mail->subject($subject);
            $mail->body($body);
            $mail->send();

            //redirect to index page
            header('Location: /user/index.php?action=joined');
            exit;

            //else catch the exception and show the error.
        } catch (PDOException $e) {
            $error[] = $e->getMessage();
        }

    }

}

//define page title
$title = 'Demo';

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
        font-size: 14px !important;
        border-color: #e9e0e0;
    }

    .gselect {
        border-color: #e9e0e0;
    }

</style>

<div class="container">

    <div class="row">

        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <form role="form" method="post" action="" autocomplete="off">
                <h3>Please Sign Up</h3>
                <p>Already a member? <a href='/login'>Login</a></p>
                <hr>

                <?php
                //check for any errors
                if (isset($error)) {
                    foreach ($error as $error) {
                        echo '<p class="bg-danger">' . $error . '</p>';
                    }
                }

                //if action is joined show sucess
                if (isset($_GET['action']) && $_GET['action'] == 'joined') {
                    echo "<p class='bg-success'>Registration successful, please check your email(inbox & spam box) to activate your account instantly or wait few hours to get manually activated by <a href='http://fb.me/hmtamim1'>admin</a>.</p>";
                }
                ?>

                <div class="row">
                    <div class="col-xs-8">

                        <div class="form-group">
                            <input type="text" name="username" id="username" class="form-control input-lg loginEmail"
                                   placeholder="Full Name" value="<?php if (isset($error)) {
                                echo htmlspecialchars($_POST['username'], ENT_QUOTES);
                            } ?>" tabindex="3">
                        </div>
                    </div>
                    <div class="col-xs-4">

                        <div class="form-group">
                            <select name="gender" class="form-control gselect" id="sel1">
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>

                    </div>

                </div>
                <div class="form-group">
                    <input type="email" name="email" id="email" class="form-control input-lg loginEmail"
                           placeholder="Email Address (for verification)" value="<?php if (isset($error)) {
                        echo htmlspecialchars($_POST['email'], ENT_QUOTES);
                    } ?>" tabindex="2">
                </div>
                <div class="row">
                    <div class="col-xs-6 spass">
                        <div class="form-group"><input type="password" name="password" id="password"
                                                       class="form-control input-lg loginPass" placeholder="Password"
                                                       tabindex="3"></div>
                    </div>
                    <div class="col-xs-6 spassc">
                        <div class="form-group"><input type="password" name="passwordConfirm" id="passwordConfirm"
                                                       class="form-control input-lg loginPass"
                                                       placeholder="Confirm Password" tabindex="4"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Register"
                                                          class="btn btn-primary btn-block btn-lg" tabindex="5"></div>
                </div>
            </form>
        </div>
    </div>

</div>
<br><br><br>
</div>
<br></div>
<br>
<br/>
<style>
    .gselect {
        height: 46px;
    }

</style>

<?php
//include header template

include '../foot.php';

?>
