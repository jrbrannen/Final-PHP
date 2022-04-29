<?php

require_once('../inc/Faq.class.php');

// create a faq object
$faq = new Faq();

// get all faqs and store in an array to display on the view
$faqList = $faq->getList();

// include the view
require_once('../tpl/faq-list.tpl.php');

?>
