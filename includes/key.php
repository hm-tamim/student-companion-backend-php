<?php


$_SITE = New Stdclass();


/** @var array Google API keys */

//AIzaSyAjhSLWUUqve3gsZTMFDGJEy2vXrdKj8rA
$_SITE->google_api_keys2 = array('AIzaSyA6TgpY9qsuGPaQKN5hJNscYXJKrAz3h4M', 'AIzaSyCiXToL633rQ5SZRKZSK-aJr08HYsfzdCY', 'AIzaSyD7k0VdUoaBBPP5uzaNXo5sile8nOm6Jrk');

$_SITE->google_api_keys = array();
$_SITE->google_api_keys['youtube-api-1'] = 'AIzaSyCjj_qof4BEAxUemvS54Npj2S14tIAo3zo';
$_SITE->google_api_keys['youtube-api-2'] = 'AIzaSyA3j_h1m2D-k55QC1yfMiq_Rv_wCVXFPqk';
$_SITE->google_api_keys['youtube-api-3'] = 'AIzaSyCjYqDIPLx-vFZ9W57kbQy5FI6bqj2VlvA';
$_SITE->google_api_keys['youtube-api-4'] = 'AIzaSyDMgKhjSMHkjPit7jmxIUxWokhDkZ5Oj_k';
$_SITE->google_api_keys['youtube-api-5'] = 'AIzaSyB7lb6pT703TBBVib2azqgu3th31mLuBZ4';
$_SITE->google_api_keys['youtube-api-6'] = 'AIzaSyAn_U8gebDdL-X5YQfOC_0IrYheh73GTu4';
$_SITE->google_api_keys['youtube-api-7'] = 'AIzaSyCnnpj1ruYgI-u-H9NppkVmJ3nWI84mBHg';
$_SITE->google_api_keys['youtube-api-8'] = 'AIzaSyBCqC38qldkkgSX_nBieV6QnXgCVh3QAlE';
$_SITE->google_api_keys['youtube-api-9'] = 'AIzaSyCHsxd1IkoV7VW5JquXl1IpdqrY4noRFv0';
$_SITE->google_api_keys['youtube-api-10'] = 'AIzaSyAhEpXZIrzAfwfr0f0rEVu5D39q_648s10';
$_SITE->google_api_keys['youtube-api-11'] = 'AIzaSyDj-vSsL_RYDtQFfbNKe5CEmFchZJ5vw78';
$_SITE->google_api_keys['youtube-api-12'] = 'AIzaSyB_C7QThGpOyuDu0wyjgrzik1UzuNRjWYI';
$_SITE->google_api_keys['youtube-api-13'] = 'AIzaSyD-ZIrR85UUmuCxaGYP-Gu6YTGYmaVyJGI';
$_SITE->google_api_keys['youtube-api-14'] = 'AIzaSyDU96Ka5ExKE9AVkKbp7fpkusUnw5XXGy0';
$_SITE->google_api_keys['youtube-api-15'] = 'AIzaSyAGV7f-PPERRt7jdyhNQ_zLr8r8KT71eSM';
$_SITE->google_api_keys['youtube-api-16'] = 'AIzaSyDrsHArOLQ1rKdtLiZaSOxFHkSM7P-o-P0';
$_SITE->google_api_keys['youtube-api-17'] = 'AIzaSyAXtoVHt20hOJn9o7OtjJFUkeogoALK7_I';
$_SITE->google_api_keys['youtube-api-18'] = 'AIzaSyDgcJ3SVOeWqSIy_8Ub6Rf_48ig3Iu6pNU';
$_SITE->google_api_keys['youtube-api-19'] = 'AIzaSyADe__pA4r3ZhkYM7-vBWY6pr6_CXmb2oE';
$_SITE->google_api_keys['youtube-api-20'] = 'AIzaSyDMon1ASSwG5lDSOCz3nmPeGHcf8nlu4C8';
$_SITE->google_api_keys['youtube-api-21'] = 'AIzaSyB4kkMJb3YWRU6S7b5EKCIK23CszvjWfCw';
$_SITE->google_api_keys['youtube-api-22'] = 'AIzaSyBCtVx0aFaKti-CO_5Qf-p_qEUH2xH8oi0';
$_SITE->google_api_keys['youtube-api-23'] = 'AIzaSyCyGbpEo73HFqQFsnupOVt1DNNLgy8gctc';
$_SITE->google_api_keys['youtube-api-24'] = 'AIzaSyBmafINcczUrzJgA_Uy8_Ewv7LF4w0IxBk';


function getRandomApiKey2()
{
    global $_SITE;
    $total = count($_SITE->google_api_keys2) - 1;
    $rand = rand(0, $total);
    return $_SITE->google_api_keys2[$rand];

}


function getRandomApiKey()
{
    global $_SITE;
    $hour = date("G");
    $api = '';
    switch ('' . $hour . '') {
        case '0':
            $api = $_SITE->google_api_keys['youtube-api-1'];
            break;

        case '1':
            $api = $_SITE->google_api_keys['youtube-api-2'];
            break;

        case '2':
            $api = $_SITE->google_api_keys['youtube-api-3'];
            break;

        case '3':
            $api = $_SITE->google_api_keys['youtube-api-4'];
            break;

        case '4':
            $api = $_SITE->google_api_keys['youtube-api-5'];
            break;

        case '5':
            $api = $_SITE->google_api_keys['youtube-api-6'];
            break;

        case '6':
            $api = $_SITE->google_api_keys['youtube-api-7'];
            break;

        case '7':
            $api = $_SITE->google_api_keys['youtube-api-8'];
            break;

        case '8':
            $api = $_SITE->google_api_keys['youtube-api-9'];
            break;

        case '9':
            $api = $_SITE->google_api_keys['youtube-api-10'];
            break;

        case '10':
            $api = $_SITE->google_api_keys['youtube-api-11'];
            break;

        case '11':
            $api = $_SITE->google_api_keys['youtube-api-12'];
            break;

        case '12':
            $api = $_SITE->google_api_keys['youtube-api-13'];
            break;

        case '13':
            $api = $_SITE->google_api_keys['youtube-api-14'];
            break;

        case '14':
            $api = $_SITE->google_api_keys['youtube-api-15'];
            break;

        case '15':
            $api = $_SITE->google_api_keys['youtube-api-16'];
            break;

        case '16':
            $api = $_SITE->google_api_keys['youtube-api-17'];
            break;

        case '17':
            $api = $_SITE->google_api_keys['youtube-api-18'];
            break;

        case '18':
            $api = $_SITE->google_api_keys['youtube-api-19'];
            break;

        case '19':
            $api = $_SITE->google_api_keys['youtube-api-20'];
            break;

        case '20':
            $api = $_SITE->google_api_keys['youtube-api-21'];
            break;

        case '21':
            $api = $_SITE->google_api_keys['youtube-api-22'];
            break;

        case '22':
            $api = $_SITE->google_api_keys['youtube-api-23'];
            break;
        case '23':
            $api = $_SITE->google_api_keys['youtube-api-24'];
            break;
    }

    return $api;
}

echo getRandomApiKey2();