
<section class="three_columns_block">
	<div class="<?php echo $container ?>">
		<div class="columns">
			<?php if (get_sub_field('content')) { ?>
			<div class="column col-12 col-md-12 text-center">
				<?php the_sub_field('content')?>
				<br>
			</div>
			<?php } ?>
			<?php if (have_rows('columns')) { ?>
			<?php 	while(have_rows('columns')) { the_row(); ?>

				<div class="column col-md-4 col-sm-12 text-center">
					<?php
                        $timg = get_sub_field('image');
                        if ($timg) {
                            echo '<amp-img src="' . wp_get_attachment_image_url( $timg, array(370,240) ) . '" width="370" height="240"></amp-img>';
                        }
					?>
					
					<h4><?php the_sub_field('title') ?></h4>
					<p><?php the_sub_field('text')?></p>
				</div>
			<?php 	} ?>
			<?php } ?>
		</div>
	</div>
</section>
		