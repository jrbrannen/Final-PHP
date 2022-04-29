<?php

// connect to cms class
require_once('../inc/CMS.class.php');

// create object
$cms = new CMS();

if (!$cms->load($_GET['cms_id'])){
    die("CMS page not found");
}

$cmsArray = $cms->dataArray;

require_once('../tpl/cms-view.tpl.php');

?>