
<div class="container-wrapper standard-container-wrapper image-gallery" style="">
	<div class="container">
		<div class="row">
			<?php if (get_sub_field('content')) { ?>
			<div class="col-md-12 text-center">
				<?php the_sub_field('content')?>
				<br>
			</div>
			<?php } ?>
			<?php
                $images_in_a_row = get_sub_field('images_in_a_row');

			
                $image_gallery = get_sub_field('images');
				//print_r( $image_gallery);
				?>
			<?php if ($image_gallery) { ?>
            <?php 	foreach($image_gallery as $image) { ?>
                <div class="col-md-<?php echo (12/$images_in_a_row); ?> text-center image-container">
						<?php echo wp_get_attachment_image( $image['ID'], 'image-size-'.$images_in_a_row ) ?>
				</div>
			<?php 	} ?>
			<?php } ?>
		</div>
	</div>
</div>
		