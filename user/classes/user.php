<?php
include($_SERVER['DOCUMENT_ROOT'] . '/user/classes/password.php');


class User extends Password
{

    private $_db;


    function __construct($dbb)
    {
        parent::__construct();

        $this->_db = $dbb;
    }

    public function isValidUsername($username)
    {
        if (strlen($username) < 3) return false;
        if (strlen($username) > 17) return false;
        if (!ctype_alnum($username)) return false;
        return true;
    }

    public function login($email, $password)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;
        if (strlen($password) < 3) return false;

        $row = $this->get_user_hash(strtolower($email));

        if ($this->password_verify($password, $row['password']) == 1) {

            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $row['email'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['memberID'] = $row['memberID'];
            $_SESSION['gender'] = $row['gender'];

            $uid = md5(uniqid(time(), true));


            if (is_null($row['uid'])) {


                try {
                    $stmt = $this->_db->prepare("UPDATE members SET uid = :uid WHERE email = :email");
                    $stmt->execute(array(
                        ':email' => strtolower($row['email']),
                        ':uid' => $uid
                    ));

                } catch (PDOException $e) {
                    $error[] = $e->getMessage();
                }

                $_SESSION['uid'] = $uid;
                $value = $uid;
            } else {

                $_SESSION['uid'] = $row['uid'];
                $value = $row['uid'];
            }


            setcookie("rememberme2", $value, time() + (10 * 365 * 24 * 60 * 60));
            return true;
        }
    }

    private function get_user_hash($email)
    {

        try {
            $stmt = $this->_db->prepare('SELECT password, username, email, gender, uid, memberID, picture, cgpa, credit, semester, dept, bgroup, phone, address, type, expire FROM members WHERE LOWER(email) = :email ');
            $stmt->execute(array('email' => $email));

            return $stmt->fetch();

        } catch (PDOException $e) {
            echo '<p class="bg-danger">' . $e->getMessage() . '</p>';
        }
    }

    public function applogin($email, $password)
    {


        $response = array("error" => FALSE);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;
        if (strlen($password) < 3) return false;

        $row = $this->get_user_hash(strtolower($email));

        if ($this->password_verify($password, $row['password']) == 1) {

            $response["error"] = FALSE;

            $uid = md5(uniqid(time(), true));

            if (is_null($row['uid'])) {


                try {

                    $stmt = $this->_db->prepare("UPDATE members SET uid = :uid WHERE email = :email");
                    $stmt->execute(array(
                        ':email' => strtolower($row['email']),
                        ':uid' => $uid
                    ));

                } catch (PDOException $e) {
                    $error[] = $e->getMessage();
                }

                $response['uid'] = $uid;

            } else {

                $response['uid'] = $row['uid'];

            }


            $response["user"]['email'] = $row['email'];
            $response["user"]['memberID'] = $row['memberID'];
            $response["user"]['name'] = $row['username'];
            $response["user"]['gender'] = $row['gender'];
            $response["user"]['picture'] = $row['picture'];
            $response["user"]['cgpa'] = $row['cgpa'];
            $response["user"]['credit'] = $row['credit'];
            $response["user"]['semester'] = $row['semester'];
            $response["user"]['dept'] = $row['dept'];
            $response["user"]['bgroup'] = $row['bgroup'];

            if ($response["user"]['bgroup'] == null)
                $response["user"]['bgroup'] = -1;

            $response["user"]['phone'] = $row['phone'];
            $response["user"]['address'] = $row['address'];
            $response["user"]['type'] = $row['type'];
            $response["user"]['expire'] = $row['expire'];

        } else {

            $response["error"] = TRUE;
            $response["error_msg"] = "Login error! Wrong email or password, try again.";
        }

        return $response;

    }

    public function cookielogin($email)
    {
        $row = $this->get_user_hash(strtolower($email));
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $row['email'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['memberID'] = $row['memberID'];

        $_SESSION['gender'] = $row['gender'];
    }

    public function uidlogin($uid)
    {
        $row = $this->get_user_hash_from_uid(strtolower($uid));
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $row['email'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['memberID'] = $row['memberID'];
        $_SESSION['uid'] = $row['uid'];
        $_SESSION['gender'] = $row['gender'];
        $days = 30;
        $value = $row['uid'];
        // setcookie ("rememberme2",$value,time() + (10 * 365 * 24 * 60 * 60));

    }

    private function get_user_hash_from_uid($uid)
    {

        try {
            $stmt = $this->_db->prepare('SELECT password, username, email, gender, memberID, email, picture, cgpa, credit, semester, dept, bgroup, phone, address, type, expire FROM members WHERE uid = :uid AND active="Yes" ');
            $stmt->execute(array('uid' => $uid));
            return $stmt->fetch();

        } catch (PDOException $e) {
            echo '<p class="bg-danger">' . $e->getMessage() . '</p>';
        }
    }

    public function logout()
    {
        session_destroy();
        setcookie("rememberme2", "", time() - 3600, '/');
    }


    public function is_logged_in()
    {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            return true;
        }
    }

}


function checkmyemail($email)
{

    $domains = array("aol.com", "att.net", "comcast.net", "facebook.com", "gmail.com", "gmx.com", "googlemail.com", "google.com", "hotmail.com", "hotmail.co.uk", "mac.com", "me.com", "mail.com", "msn.com", "live.com", "sbcglobal.net", "verizon.net", "yahoo.com", "yahoo.co.uk", "email.com", "fastmail.fm", "games.com", "gmx.net", "hush.com", "hushmail.com", "icloud.com", "iname.com", "inbox.com", "lavabit.com", "love.com", "outlook.com", "pobox.com", "protonmail.com", "rocketmail.com", "safe-mail.net", "wow.com", "ygm.com", "ymail.com", "zoho.com", "yandex.com", "northsouth.edu");


    $userdomain = strtolower(substr(strrchr($email, "@"), 1));

    if (array_key_exists($userdomain, $domains))
        return "yes";
    else
        return "no";
}

?>
