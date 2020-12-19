<?php


include $_SERVER['DOCUMENT_ROOT'] . '/includes/func.php';

require_once('includes/config.php');


$response = array("error" => FALSE);


if (!isset($_REQUEST['username'])) $error[] = "Please fill out all fields";
if (!isset($_REQUEST['email'])) $error[] = "Please fill out all fields";
if (!isset($_REQUEST['password'])) $error[] = "Please fill out all fields";
if (!isset($_REQUEST['gender'])) $error[] = "Please fill out all fields";


$email = strtolower($_REQUEST['email']);
$username = htmlspecialchars_decode($_REQUEST['username'], ENT_QUOTES);;
$gender = strtolower($_REQUEST['gender']);

$emailz = htmlspecialchars_decode($_REQUEST['email'], ENT_QUOTES);


$domains = array("aol.com", "att.net", "comcast.net", "facebook.com", "gmail.com", "gmx.com", "googlemail.com", "google.com", "hotmail.com", "hotmail.co.uk", "mac.com", "me.com", "mail.com", "msn.com", "live.com", "sbcglobal.net", "verizon.net", "yahoo.com", "yahoo.co.uk", "email.com", "fastmail.fm", "games.com", "gmx.net", "hush.com", "hushmail.com", "icloud.com", "iname.com", "inbox.com", "lavabit.com", "love.com", "outlook.com", "pobox.com", "protonmail.com", "rocketmail.com", "safe-mail.net", "wow.com", "ygm.com", "ymail.com", "zoho.com", "yandex.com", "northsouth.edu");


$domain_name = strtolower(substr(strrchr($email, "@"), 1));


if (in_array($domain_name, $domains)) {
} else {
    $error[] = "Email extension doesn't support. Try gmail, yahoo or hotmail.";

}


if (strlen($_REQUEST['password']) < 3) {
    $error[] = 'Password is too short.';
    $response["error"] = TRUE;
    $response["error_msg"] = "Password is too short, try again.";

}

// 	if(strlen($_REQUEST['passwordConfirm']) < 3){
// 		$error[] = 'Confirm password is too short.';
// 		$response["error"] = TRUE;
//         $response["error_msg"] = "Password is too short, try again.";

// 	}

// 	if($_REQUEST['password'] != $_REQUEST['passwordConfirm']){
// 		$error[] = 'Passwords do not match.';
// 		$response["error"] = TRUE;
//         $response["error_msg"] = "Confirm password doesn't match, try again.";

// 	}

//email validation
$email = strtolower(htmlspecialchars_decode($_REQUEST['email'], ENT_QUOTES));
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error[] = 'Please enter a valid email address';
    $response["error"] = TRUE;
    $response["error_msg"] = "Please enter a valid address.";

} else {
    $stmt = $dbb->prepare('SELECT email FROM members WHERE email = :email');
    $stmt->execute(array(':email' => $email));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!empty($row['email'])) {
        $error[] = 'Email provided is already in use.';

        $response["error"] = TRUE;
        $response["error_msg"] = "Email provided is already in use, try again.";
    }

}


//if no errors have been created carry on
if (!isset($error)) {

    //hash the password
    $hashedpassword = $user->password_hash($_REQUEST['password'], PASSWORD_BCRYPT);

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


        $response['uid'] = $uid;
        $response["user"]['email'] = $email;
        $response["user"]['memberID'] = $id;
        $response["user"]['name'] = $username;
        $response["user"]['gender'] = $gender;


        //send email
        $to = $_REQUEST['email'];
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


        //else catch the exception and show the error.
    } catch (PDOException $e) {
        $error[] = $e->getMessage();

        $response["error"] = TRUE;
        $response["error_msg"] = "Login error!, try again from https://nsuer.club";

    }

}


echo json_encode($response);


?>