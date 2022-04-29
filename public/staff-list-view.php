<?php

// connect to cms class
require_once('../inc/CMS.class.php');

// create object
$cms = new CMS();

if (isset($_REQUEST['url_key'])){
    $_REQUEST['page'] = $_REQUEST['url_key'];
}
// shut down the page if cms does not load or is NOT available
if (!$cms->load($_REQUEST['page'])){
    die("CMS page not found");
}
// load the cms if it IS available
if (isset($_REQUEST['page']) && $_REQUEST['page'] > 0) {
    // $_REQUEST['page'] = $_REQUEST['url_key'];
    $cms->load($_REQUEST['page']);
    $cmsArray = $cms->dataArray;
}

$ch = curl_init();
       
    // set url
    curl_setopt($ch, CURLOPT_URL, 'http://localhost/wdv441/week13/CMS-Module-PHP/public/weather-widget.php');

    // if redirected, follow it
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $userAgent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36";

    curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);

    // $output contains the output string
    $weatherWidgetHTML = curl_exec($ch);

    // close curl resource to free up system resources
    curl_close($ch);

$ch = curl_init();
       
    // set url
    curl_setopt($ch, CURLOPT_URL, 'http://localhost/wdv441/week13/CMS-Module-PHP/public/article-widget.php');

    // if redirected, follow it
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $userAgent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36";

    curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);

    // $output contains the output string
    $articleWidgetHTML = curl_exec($ch);

    // close curl resource to free up system resources
    curl_close($ch);

// display view
require_once('../tpl/page-view.tpl.php');



?>