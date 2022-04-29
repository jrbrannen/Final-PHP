<?php
// weather widget controller

// weather api url
$url = 'http://api.weatherunlocked.com/api/current/us.32738?app_id=9ee0fdef&app_key=b53006b902f35b1cd13a9108944e2d19';

// create a curl handle
$ch = curl_init();

// set option for curl destination
curl_setopt($ch, CURLOPT_URL, $url);

// set the header option to get json instead of xml
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));

// option for redirection to follow redirection
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

// option to return the transfer as a string, could set up a callback function
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// browser identification
$userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36';

// option to use a specific browser type
curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);

// output var will contain the output string from curl_exec
$output = curl_exec($ch);

// close the curl resource variable to free up system resources
curl_close($ch);

// convert json into a php object
$outputObj = json_decode($output);

require_once('../tpl/weather-widget.tpl.php');
?>