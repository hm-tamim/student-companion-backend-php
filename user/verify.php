<?php

function rememberMe()
{

    $cookie = isset($_COOKIE['rememberme']) ? $_COOKIE['rememberme'] : '';

    if ($cookie) {
        list ($username, $token, $mac) = explode(':', $cookie);
        if ($mac !== hash_hmac('sha256', $username . ':' . $token, "mynameistamim")) {
            return false;
        }

        function fetchTokenByUsername($username)
        {
            $host = "127.0.0.1";
            $dbusername = "toolvehw_db";
            $dbpassword = "Toolsmashdb420";
            $database = "toolvehw_nsuer";

            global $mysqli;
            $stmt = $mysqli->prepare("SELECT email, token
                                              FROM cookielogin
                                              WHERE email=? //pull most recent cookie key from DB
                                              ORDER BY keyid DESC
                                              LIMIT 1");
            $stmt->bind_param('s', $username);
            if (!$stmt) {
                header('Location: login.php');
                die();
            }
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($userjunk, $userToken);
            $stmt->fetch();
            return $userToken;
        }

        function logUserIn($username)
        {
            $host = "127.0.0.1";
            $dbusername = "toolvehw_db";
            $dbpassword = "Toolsmashdb420";
            $database = "toolvehw_nsuer";

            global $mysqli;

            $active = 1;
            $stmt = $mysqli->prepare("SELECT id, email, username, password, salt FROM users WHERE email=? AND active=?");
            $stmt->bind_param('si', $username, $active);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $email, $xusername, $xpassword, $salt);
            $stmt->fetch();
            if (!$stmt) {
                header('Location: login.php');
                die();
            }
            $numrows = $stmt->num_rows;
            if ($numrows == 0) {
                $_SESSION['loggedin'] = false;
                $_SESSION['error'] = ("Incorrect username and password combination, please try to log in again");
                exit();
            }
            session_regenerate_id(); // set session information
            $_SESSION['user_id'] = $id;
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $xusername;
            $_SESSION['gender'] = $gender;
            $_SESSION['loggedin'] = true;
        }

        function timingSafeCompare($userToken, $token)
        {
            //removed for brevity (and pulled from a library, so I am confident in it's abilities)
        }

        $userToken = fetchTokenByUsername($username);
        if (timingSafeCompare($userToken, $token) === 0) {
            logUserIn($username);
            return true;
        }
    } else {
        return false;
    }
}

if ((isset($_SESSION['username']) && $_SESSION['username'] != '') || (rememberMe() == true)) ;


?>