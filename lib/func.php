<?php
/**
 * Created by PhpStorm.
 * User: HM Tamim
 * Date: 6/10/2019
 * Time: 1:31 PM
 */


function randomPassword()
{
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function cleans($str)
{
    return str_replace(array('\\', '/', '%', '..', '\'', '"'), ' ', $str);
}
