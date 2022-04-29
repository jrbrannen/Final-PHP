<!DOCTYPE html>
<html lang="en">
    <head>
        <title>CMS | View</title>
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
        <h1>CMS View</h1>
        <h3>Page Title: <?= isset($cmsArray['page_title']) ? $cmsArray['page_title'] : ''?></h3>
        <h5>Meta Tags: <?= isset($cmsArray['meta_tags']) ? $cmsArray['meta_tags'] : '' ?></h5>
        <p>H1: <?= isset($cmsArray['h1']) ? $cmsArray['h1'] : '' ?></p>
        <p>Content: <?= isset($cmsArray['content']) ? $cmsArray['content'] : '' ?></p>
        <p>Url Key: <?= isset($cmsArray['url_key']) ? $cmsArray['url_key'] : '' ?></p>
        <?php if (is_file(dirname(__FILE__) . "/../public/images/" . $cmsArray['cms_id'] . "_cms.jpg")) { ?>
            <img src="images/<?php echo $cmsArray['cms_id'] . "_cms.jpg"; ?>"/>
        <?php } ?>	
        <a href="cms-list.php"><button>Return To CMS List</button></a>
    </body>

</html>