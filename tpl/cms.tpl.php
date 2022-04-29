<html>
    <title><?= isset($cmsArray['page_title']) ? $cmsArray['page_title'] : ''?></title>
    <meta name="description" keywords='<?= isset($cmsArray['meta_tags']) ? $cmsArray['meta_tags'] : '' ?>'>
    
    <body>
        <h1><?= isset($cmsArray['h1']) ? $cmsArray['h1'] : '' ?></h1>
        <p><?= isset($cmsArray['content']) ? $cmsArray['content'] : '' ?></p>
        <?php if (is_file(dirname(__FILE__) . "/../public/images/" . $cmsArray['cms_id'] . "_cms.jpg")) { ?> -->
            <img src="images/<?php echo $cmsArray['cms_id'] . "_cms.jpg"; ?>"/>
        <?php  } ?>	
    <?= $weatherWidgetHTML ?><br>
    <hr>
    <?= $articleWidgetHTML ?><br>
    <hr>
    <?= $faqWidgetHTML ?><br>
    </body>
    
</html>