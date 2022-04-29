<div class="">
    <h3>Check Out Our Faq's</h3>
	<ul class="">
		<?php foreach ($faqList as $faqInfo) { ?>
			<?php if ($faqCount++ >= $faqLimit) break; ?>
			<li class=""><?= $faqInfo["faq_question"]; ?></li>
		<?php } ?>
	</ul>
</div>