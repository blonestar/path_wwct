<div class="container-wrapper blue-container-wrapper big-horizontal content-block-1">
	<div class="container">
		<div class="row">
			<ul class>
				<?php while(have_rows('items')) { the_row(); ?>
				<li><i class="fa fa-check" aria-hidden="true"></i> <?php the_sub_field('label') ?></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>