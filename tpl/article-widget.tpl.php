<div class="">
    <h3>Today's Articles</h3>
	<ul class="">
		<?php foreach ($articleList as $articleInfo) { ?>
			<?php if ($articleCount++ >= $articleLimit) break; ?>
			<li class=""><?= $articleInfo["article_title"]; ?></li>
		<?php } ?>
	</ul>
</div>