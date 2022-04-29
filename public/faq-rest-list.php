<?php
require_once('../inc/Faq.class.php');

$faq = new Faq();

// retrieve faqs
$faqList = $faq->getList(
    (isset($_GET['sortColumn']) ? $_GET['sortColumn'] : null),
    (isset($_GET['sortDirection']) ? $_GET['sortDirection'] : null),
    (isset($_GET['filterColumn']) ? $_GET['filterColumn'] : null),
    (isset($_GET['filterText']) ? $_GET['filterText'] : null)
);

// var_dump($faqList);die;

// convert the array to json
echo json_encode($faqList);
?>