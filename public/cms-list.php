<?php

require_once('../inc/CMS.class.php');

// create a cms object
$cms = new CMS();

// get all cmss and store in an array to display on the view
$cmsList = $cms->getList();

// include the view
require_once('../tpl/cms-list.tpl.php');

?>
