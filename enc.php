<?php


function encryptCookie($value)
{
    $key = '1544724019';
    $newvalue = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $value, MCRYPT_MODE_CBC, md5(md5($key)));
    return ($newvalue);
}

function decryptCookie($value)
{
    $key = '1544724019';
    $newvalue = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), $value, MCRYPT_MODE_CBC, md5(md5($key))), "\0");
    return ($newvalue);
}


$yes = str_rot13('cba');

echo $yes;

echo '<br/>';
echo '<br/>';


$no = str_rot13($yes);

echo $no;

?>