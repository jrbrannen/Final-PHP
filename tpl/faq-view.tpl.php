<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Faq | View</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatable" content="IE=edge">
        <meta name="viewport" content="width=device-width, intial-scale=1.0">
        <!--Jeremy Brannen-->
        <script>

        </script>
        <style>
            
        </style>
    </head>

    <body>
        <h1>Faq View</h1>
        <p>Faq Question: <?= isset($faqArray['faq_question']) ? $faqArray['faq_question'] : ''?></p>
        <p>Faq Answer: <?= isset($faqArray['faq_answer']) ? $faqArray['faq_answer'] : '' ?></p>
        <?php if (is_file(dirname(__FILE__) . "/../public/images/" . $faqArray['faq_id'] . "_faq.jpg")) { ?>
            <img src="images/<?php echo $faqArray['faq_id'] . "_faq.jpg"; ?>"/>
        <?php } ?>	
        <a href="faq-list.php"><button>Return To faq List</button></a>
    </body>

</html>