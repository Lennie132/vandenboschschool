<?php
/** Hier eventeel nog een sfeerbeeld of kruimels o.i.d. inladen * */
$sfeer = get_sfeerafbeelding($DATA['page'], 1);

/** Hier wordt het grid met de content ingelezen * */
//echo $this->buildHTMLgrid($DATA['page']);

?>

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<?= get_all_content_html(); ?>
		</div>
	</div>
</div>