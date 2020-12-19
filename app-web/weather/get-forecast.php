<?php

// http://dataservice.accuweather.com/forecasts/v1/daily/5day/27905?apikey=MAP9YFKNtfU4cdFF5X1Swog0uX1EOgkz&metric=true


//http://dataservice.accuweather.com/currentconditions/v1/27905?apikey=MAP9YFKNtfU4cdFF5X1Swog0uX1EOgkz


function dlPage($href)
{

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_URL, $href);
    curl_setopt($curl, CURLOPT_REFERER, $href);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.125 Safari/533.4");
    $str = curl_exec($curl);
    curl_close($curl);


    return $str;
}

date_default_timezone_set('Asia/Dhaka');

$now = new Datetime("now");
$begintime = new DateTime('01:00');
$endtime = new DateTime('06:00');

if ($now >= $begintime && $now <= $endtime) {
    // between times
    echo "yay";
    die();
}


$items = array("zP3bc2FA1uniQdrvu8ulMArwptVNMjFC", "MAP9YFKNtfU4cdFF5X1Swog0uX1EOgkz");
$rand_keys = $items[rand(0, count($items) - 1)];


$forecast = dlPage("http://dataservice.accuweather.com/forecasts/v1/daily/5day/27905?apikey=" . $rand_keys . "&metric=true");


file_put_contents('forecast.json', $forecast);


$current = file_get_contents('current.json');


$arr = array();


$mArray = json_decode($current, true);


$arr['title'] = $mArray[0]['WeatherText'];

$arr['time'] = $mArray[0]['LocalObservationDateTime'];


$arr['icon'] = $mArray[0]['WeatherIcon'];

$arr['temp'] = (string)round($mArray[0]['Temperature']['Metric']['Value']);

$arr['realfeel'] = (string)round($mArray[0]['RealFeelTemperature']['Metric']['Value']);


$fArray = json_decode($forecast, true);


$forarr = array();


foreach ($fArray['DailyForecasts'] as $farr) {


    $temp = array();


    $temp['min'] = (string)round($farr['Temperature']['Minimum']['Value']);
    $temp['max'] = (string)round($farr['Temperature']['Maximum']['Value']);

    $temp['icon'] = $farr['Day']['Icon'];

    $temp['date'] = $farr['Date'];

    $temp['title'] = $farr['Day']['IconPhrase'];


    //    $arr['forecast'][] = $temp;

    $forarr[] = $temp;


}


$forecastJson = json_encode($forarr);


$arr['forecast'] = $forecastJson;


$kson["current"] = array($arr);

$weather = json_encode($kson);


file_put_contents('weather.json', $weather);

echo "Updated";


?>