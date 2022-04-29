<html>
    <body>
        <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post" enctype="multipart/form-data">
            <?php if (isset($cmscmsErrorsArray['page_title'])) { ?>
                <div><?php echo $cmsErrorsArray['page_title']; ?></div>
            <?php }elseif (isset($cmsErrorsArray['meta_tags'])) { ?>
                <div><?= $cmsErrorsArray['meta_tags']; ?></div>
            <?php }elseif (isset($cmsErrorsArray['h1'])) { ?>
                <div><?= $cmsErrorsArray['h1']; ?></div>
            <?php }elseif (isset($cmsErrorsArray['content'])) { ?>
                <div><?= $cmsErrorsArray['content']; ?></div>
            <?php }elseif (isset($cmsErrorsArray['url_key'])) { ?>
                <div><?= $cmsErrorsArray['url_key']; ?></div>
            <?php } ?>

            Title: <input type="text" name="page_title" value="<?php echo (isset($cmsArray['page_title']) ? $cmsArray['page_title'] : ''); ?>"/><br>
            H1: <input type="text" name="h1" value="<?php echo (isset($cmsArray['h1']) ? $cmsArray['h1'] : ''); ?>"></input><br>
            Meta Tags: <input type="text" name="meta_tags" value="<?php echo (isset($cmsArray['meta_tags']) ? $cmsArray['meta_tags'] : ''); ?>"/><br>
            Url Key: <input type="text" name="url_key" value="<?php echo (isset($cmsArray['url_key']) ? $cmsArray['url_key'] : ''); ?>"/><br>
            Content: <textarea name="content"><?php echo (isset($cmsArray['content']) ? $cmsArray['content'] : ''); ?></textarea><br>
            Image: <input type="file" name="image"/><br>
            
            <input type="hidden" name="cms_id" value="<?php echo (isset($cmsArray['cms_id']) ? $cmsArray['cms_id'] : ''); ?>"/>
            <input type="submit" name="Save" value="Save"/>
            <input type="submit" name="Cancel" value="Cancel"/>            
        </form>        
    </body>
</html>