<?php


date_default_timezone_set('Asia/Dhaka');


$domain = 'scompanion.club';


function getUrlFac($dept1) {
    $imageUrlz = null;
        switch ($dept1) {
            case "6":
                $imageUrlz = "http://institutions.northsouth.edu/cee/";
                break;
            case "16":
                $imageUrlz = "http://ece.northsouth.edu/people/";
                break;
            default:
                $imageUrlz = "http://www.northsouth.edu/";
        }

        return $imageUrlz;
    }

function gender($value)
{
    if ($value == 0)
        return "Male";
    elseif ($value == 1)
        return "female";
    else
        return $value;
}

function getUniversityColor($id)
{
    if ($id == 0)
        return "#4f81bd";
    else if ($id == 1)
        return "#9bbc58";
    else if ($id == 2)
        return "#6A1FF5";
    else if ($id == 3)
        return "#4f81bd";
    else if ($id == 4)
        return "#5bcc58";
    else if ($id == 5)
        return "#6b8cbc";
    else if ($id == 6)
        return "#4196AF";
    else if ($id == 7)
        return "#6B8CBC";
    else
        return "#4f81bd";
}

function getBloodGroup($id)
{
    if ($id == 0)
        return "AB+";
    else if ($id == 1)
        return "AB-";
    else if ($id == 2)
        return "A+";
    else if ($id == 3)
        return "A-";
    else if ($id == 4)
        return "B+";
    else if ($id == 5)
        return "B-";
    else if ($id == 6)
        return "O+";
    else if ($id == 7)
        return "O-";
}

function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}


function freshTitle($title)
{

    $titlez = preg_replace('/(\(|\)|\!|\||\[|\]|\{|\}|,|#|\/|\")/i', "", $title);

    $titlez = preg_replace('/&39;/i', "'", $titlez);

    return $titlez;
}


function isBot()
{
    if (preg_match('/bot|crawl|curl|dataprovider|search|get|spider|find|java|majesticsEO|google|yahoo|teoma|contaxe|yandex|libwww-perl|facebookexternalhit/i', $_SERVER['HTTP_USER_AGENT'])) {
        return 1;
    } else
        return 0;

}


function sendFCM($mess, $title, $id, $data)
{
    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = array(
        'to' => $id,
        'notification' => array(
            "body" => $mess,
            "title" => $title,
            "icon" => "ic_status_icon",
            "sound" => "default"
        ),
        'data' => array(
            "openActivity" => $data
        )
    );
    $fields = json_encode($fields);
    $headers = array(
        'Authorization: key=' . "AIzaSyB99IR5Y7P5q4g9vAaD-lyfDyfYY8hAVe8",
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

    $result = curl_exec($ch);

    // echo $result;

    curl_close($ch);
}


function sendFCMdata($id, $data)
{
    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = array(
        'to' => $id,
        'priority' => "high",
        'data' => $data,
    );
    $fields = json_encode($fields);
    $headers = array(
        'Authorization: key=' . "AIzaSyB99IR5Y7P5q4g9vAaD-lyfDyfYY8hAVe8",
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

    $result = curl_exec($ch);

    // echo $result;

    curl_close($ch);
}


function sendFCMdataCon($id, $data)
{
    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = array(
        'condition' => $id,
        'priority' => "high",
        'data' => $data,
    );
    $fields = json_encode($fields);
    $headers = array(
        'Authorization: key=' . "AIzaSyB99IR5Y7P5q4g9vAaD-lyfDyfYY8hAVe8",
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

    $result = curl_exec($ch);

    // echo $result;

    curl_close($ch);
}

function sendFCMdataTopic($id, $data)
{
    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = array(
        'to' => $id,
        'priority' => "high",
        'data' => $data,
    );
    $fields = json_encode($fields);
    $headers = array(
        'Authorization: key=' . "AIzaSyB99IR5Y7P5q4g9vAaD-lyfDyfYY8hAVe8",
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

    $result = curl_exec($ch);

    // echo $result;

    curl_close($ch);
}


function sendFCMdataTopicChat($id, $data, $notification)
{
    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = array(
        'condition' => $id,
        'priority' => "high",
        'notification' => $notification,
        'data' => $data,
    );
    $fields = json_encode($fields);
    $headers = array(
        'Authorization: key=' . "AIzaSyB99IR5Y7P5q4g9vAaD-lyfDyfYY8hAVe8",
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

    $result = curl_exec($ch);

    // echo $result;

    curl_close($ch);
}


function seoUrliF($str)
{
    $a = array('/(à|á|â|ã|ä|å|æ)/', '/(&amp;)/', '/(è|é|ê|ë)/', '/(ì|í|î|ï)/', '/(ð|ò|ó|ô|õ|ö|ø|œ)/', '/(ù|ú|û|ü)/', '/ç/', '/þ/', '/ñ/', '/ß/', '/(ý|ÿ)/', '/(=|\+|\/|\%0d|\\n|\\\|\.|\'|\"|\quot|\[|\]|\{|\}|\||\,|\;|\­|\_|↩|\^|\!|\|\:|\&|\\n|\#|\/|\?| |\(|\))/', '//s', '/-{2,}/s');
    $b = array('a', 'and', 'e', 'i', 'o', 'u', 'c', 'd', 'n', 'ss', 'y', '-', '', '-');
    $c = trim(preg_replace($a, $b, $str), '-');
    $d = preg_replace('/-{2,}/', '-', $c);
    $ee = str_replace(array("\r", "\n"), '', $d);
    $e = trim($ee, ' ');
    $f = preg_replace('/ {2,}/', '-', $e);

    $fg = trim(preg_replace('/-+/', '-', $f), '-');
    return trim($fg, '-');
}


function formatBytes($bytes, $precision = 2)
{
    $units = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= pow(1024, $pow);
    return round($bytes, $precision) . '' . $units[$pow];
}

function countWords($string)
{
    $string = preg_replace('/\s+/', ' ', trim($string));
    $words = explode(" ", $string);
    return count($words);
}

function in_array_r($item, $array)
{
    return preg_match('/"' . $item . '"/i', json_encode($array));
}


function fresh($string)
{

    $clean_code = preg_replace('/[^a-zA-Z0-9,.]/', '', $string);

    return $clean_code;
}

$cacheT = 'off';
$cacheW = 'off';


//$juttlog = $_SERVER['HTTP_HOST'];
//$load = sys_getloadavg();
//$limit = 15000;
//if ($load[0] >= $limit) {
//    header('location: /index.php');
//
//}
//

function ngegrab($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    $header[] = "Accept-Language: en";
    $header[] = "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.0; de; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3";
    $header[] = "Pragma: no-cache";
    $header[] = "Cache-Control: no-cache";
    $header[] = "Accept-Encoding: gzip,deflate";
    $header[] = "Content-Encoding: gzip";
    $header[] = "Content-Encoding: deflate";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    $load = curl_exec($ch);
    curl_close($ch);
    return $load;
}

function potong($content, $start, $end)
{
    if ($content && $start && $end) {
        $r = explode($start, $content);
        if (isset($r[1])) {
            $r = explode($end, $r[1]);
            return $r[0];
        }
        return '';
    }
}


function humanTiming($time)
{

    $time = time() - $time; // to get the time since that moment
    $time = ($time < 1) ? 1 : $time;
    $tokens = array(
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '');
    }

}


function getfilesize($url)
{
    $data = get_headers($url, true);
    if (isset($data['Content-Length']))
        return (int)$data['Content-Length'];
}


function sam($content, $start, $end)
{
    if ($content && $start && $end) {
        $r = explode($start, $content);
        if (isset($r[1])) {
            $r = explode($end, $r[1]);
            return $r[0];
        }
        return '';
    }
}

function format_time($t)
{
    $sam = str_replace('PT', '', $t);
    $sam = str_replace('H', ':', $sam);
    $sam = str_replace('M', ':', $sam);
    $sam = str_replace('S', '', $sam);
    return $sam;
}

function write_to_file($q)
{
    $filename = 'sitemap.txt';
    $fh = fopen($filename, "a");
    if (flock($fh, LOCK_EX)) {
        fwrite($fh, $q);
        flock($fh, LOCK_UN);
    }
    fclose($fh);
}

function dateyt($date)
{
    $sam = str_replace('T', ' ', $date);
    $sam = str_replace('.000Z', '', $sam);
    return $sam;
}


function seoUrl($str)
{
    $a = array('/(à|á|â|ã|ä|å|æ)/', '/(&amp;)/', '/(è|é|ê|ë)/', '/(ì|í|î|ï)/', '/(ð|ò|ó|ô|õ|ö|ø|œ)/', '/(ù|ú|û|ü)/', '/ç/', '/þ/', '/ñ/', '/ß/', '/(ý|ÿ)/', '/(=|\+|\/|\%0d|\\n|\\\|\.|\'|\"|\quot|\[|\]|\{|\}|\||\,|\;|\­|\_|↩|\^|\!|\|\:|\&|\\n|\#|\/|\?| |\(|\))/', '//s', '/-{2,}/s');
    $b = array('a', 'and', 'e', 'i', 'o', 'u', 'c', 'd', 'n', 'ss', 'y', '-', '', '-');
    $c = trim(preg_replace($a, $b, strtolower($str)), '-');
    $d = preg_replace('/-{2,}/', '-', $c);
    $ee = str_replace(array("\r", "\n"), '', $d);
    $e = trim($ee, ' ');
    $f = preg_replace('/ {2,}/', '-', $e);
    return trim($f, '-');
}


function mbstring_binary_safe_encoding($reset = false)
{
    static $encodings = array();
    static $overloaded = null;

    if (is_null($overloaded))
        $overloaded = function_exists('mb_internal_encoding') && (ini_get('mbstring.func_overload') & 2);

    if (false === $overloaded)
        return;

    if (!$reset) {
        $encoding = mb_internal_encoding();
        array_push($encodings, $encoding);
        mb_internal_encoding('ISO-8859-1');
    }

    if ($reset && $encodings) {
        $encoding = array_pop($encodings);
        mb_internal_encoding($encoding);
    }
}

function reset_mbstring_encoding()
{
    mbstring_binary_safe_encoding(true);
}


function seems_utf8($str)
{
    mbstring_binary_safe_encoding();
    $length = strlen($str);
    reset_mbstring_encoding();
    for ($i = 0; $i < $length; $i++) {
        $c = ord($str[$i]);
        if ($c < 0x80) $n = 0; # 0bbbbbbb
        elseif (($c & 0xE0) == 0xC0) $n = 1; # 110bbbbb
        elseif (($c & 0xF0) == 0xE0) $n = 2; # 1110bbbb
        elseif (($c & 0xF8) == 0xF0) $n = 3; # 11110bbb
        elseif (($c & 0xFC) == 0xF8) $n = 4; # 111110bb
        elseif (($c & 0xFE) == 0xFC) $n = 5; # 1111110b
        else return false; # Does not match any model
        for ($j = 0; $j < $n; $j++) { # n bytes matching 10bbbbbb follow ?
            if ((++$i == $length) || ((ord($str[$i]) & 0xC0) != 0x80))
                return false;
        }
    }
    return true;
}


function utf8_uri_encode($utf8_string, $length = 0)
{
    $unicode = '';
    $values = array();
    $num_octets = 1;
    $unicode_length = 0;

    mbstring_binary_safe_encoding();
    $string_length = strlen($utf8_string);
    reset_mbstring_encoding();

    for ($i = 0; $i < $string_length; $i++) {

        $value = ord($utf8_string[$i]);

        if ($value < 128) {
            if ($length && ($unicode_length >= $length))
                break;
            $unicode .= chr($value);
            $unicode_length++;
        } else {
            if (count($values) == 0) $num_octets = ($value < 224) ? 2 : 3;

            $values[] = $value;

            if ($length && ($unicode_length + ($num_octets * 3)) > $length)
                break;
            if (count($values) == $num_octets) {
                if ($num_octets == 3) {
                    $unicode .= '%' . dechex($values[0]) . '%' . dechex($values[1]) . '%' . dechex($values[2]);
                    $unicode_length += 9;
                } else {
                    $unicode .= '%' . dechex($values[0]) . '%' . dechex($values[1]);
                    $unicode_length += 6;
                }

                $values = array();
                $num_octets = 1;
            }
        }
    }

    return $unicode;
}


function seoUrls($title, $raw_title = '', $context = 'display')
{
    $title = strip_tags($title);
    // Preserve escaped octets.
    $title = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $title);
    // Remove percent signs that are not part of an octet.
    $title = str_replace('%', '', $title);
    // Restore octets.
    $title = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $title);

    if (seems_utf8($title)) {
        if (function_exists('mb_strtolower')) {
            $title = mb_strtolower($title, 'UTF-8');
        }
        $title = utf8_uri_encode($title, 500);
    }

    $title = strtolower($title);
    $title = preg_replace('/&.+?;/', '', $title); // kill entities
    $title = str_replace('.', '-', $title);

    if ('save' == $context) {
        // Convert nbsp, ndash and mdash to hyphens
        $title = str_replace(array('%c2%a0', '%e2%80%93', '%e2%80%94'), '-', $title);

        // Strip these characters entirely
        $title = str_replace(array(
            // iexcl and iquest
            '%c2%a1', '%c2%bf',
            // angle quotes
            '%c2%ab', '%c2%bb', '%e2%80%b9', '%e2%80%ba',
            // curly quotes
            '%e2%80%98', '%e2%80%99', '%e2%80%9c', '%e2%80%9d',
            '%e2%80%9a', '%e2%80%9b', '%e2%80%9e', '%e2%80%9f',
            // copy, reg, deg, hellip and trade
            '%c2%a9', '%c2%ae', '%c2%b0', '%e2%80%a6', '%e2%84%a2',
            // acute accents
            '%c2%b4', '%cb%8a', '%cc%81', '%cd%81',
            // grave accent, macron, caron
            '%cc%80', '%cc%84', '%cc%8c',
        ), '', $title);

        // Convert times to x
        $title = str_replace('%c3%97', 'x', $title);
    }

    $title = preg_replace('/[^%a-z0-9 _-]/', '', $title);
    $title = preg_replace('/\s+/', '-', $title);
    $title = preg_replace('|-+|', '-', $title);
    $title = trim($title, '-');

    return $title;
}


function truncate($string, $length, $etc = '', $charset = 'UTF-8',
                  $break_words = false, $middle = false)
{
    if ($length == 0)
        return '';

    if (strlen($string) > $length) {
        $length -= min($length, strlen($etc));
        if (!$break_words && !$middle) {
            $string = preg_replace('/\s+?(\S+)?$/', '', mb_substr($string, 0, $length + 1, $charset));
        }
        if (!$middle) {
            return mb_substr($string, 0, $length, $charset) . $etc;
        } else {
            return mb_substr($string, 0, $length / 2, $charset) . $etc . mb_substr($string, -$length / 2, $charset);
        }
    } else {
        return $string;
    }
}

