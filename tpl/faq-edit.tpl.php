<html>
    <body>
        <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post" enctype="multipart/form-data">
            <?php if (isset($faqErrorsArray['faq_question'])) { ?>
                <div><?php echo $faqErrorsArray['faq_question']; ?></div>
            <?php }elseif (isset($faqErrorsArray['faq_answer'])) { ?>
                <div><?= $faqErrorsArray['faq_answer']; ?></div>
            <?php } ?>

            Faq Question: <input type="text" name="faq_question" value="<?php echo (isset($faqArray['faq_question']) ? $faqArray['faq_question'] : ''); ?>"/><br>
            Faq Answer: <input type="text" name="faq_answer" value="<?php echo (isset($faqArray['faq_answer']) ? $faqArray['faq_answer'] : ''); ?>"/><br>
            Image: <input type="file" name="image"/><br>
            
            <input type="hidden" name="faq_id" value="<?php echo (isset($faqArray['faq_id']) ? $faqArray['faq_id'] : ''); ?>"/>
            <input type="submit" name="Save" value="Save"/>
            <input type="submit" name="Cancel" value="Cancel"/>            
        </form>        
    </body>
</html>