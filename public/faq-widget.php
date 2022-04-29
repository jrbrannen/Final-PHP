<?php
require_once('../inc/Faq.class.php');

$faqLimit = (isset($_GET["limit"]) ? intval($_GET["limit"]) : 2);

$newsFaq = new Faq();

$faqList = $newsFaq->getList();

$faqCount = 0;

// display the widget view
require_once('../tpl/faq-widget.tpl.php');
?>