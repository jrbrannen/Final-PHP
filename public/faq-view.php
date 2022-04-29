<?php

// connect to faq class
require_once('../inc/Faq.class.php');

// create object
$faq = new Faq();

if (!$faq->load($_GET['faq_id'])){
    die("faq page not found");
}

$faqArray = $faq->dataArray;

require_once('../tpl/faq-view.tpl.php');

?>