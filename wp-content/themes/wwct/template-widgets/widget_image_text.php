
<div class="widget widget_image_text_widget <?php echo get_row_layout() ?><?php echo (get_sub_field('show_star')) ? ' widget-with-star' : '' ?>">
    <?php
        $image = get_sub_field('image');
     ?>

    <?php if (get_sub_field('link_to')) { ?>
    <a href="<?php the_sub_field('link_to') ?>" title="<?php the_sub_field('title') ?>">
    <?php } ?>
			<?php if($image): ?>
			<div class="text-center">
				<?php echo wp_get_attachment_image( $image, 'image-size-3' ) ?>
			</div>
			<?php endif; ?>
			<div class="widget-text-wrapp">
				<h3><?php the_sub_field('title') ?></h3>
				<?php the_sub_field('content') ?>
			</div>
	<?php if (get_sub_field('link_to')) { ?>
    </a>
    <?php } ?>
</div>


