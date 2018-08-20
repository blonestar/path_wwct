
<<?php echo $tag.$id.$class.$style ?>>

	<div class="<?php echo $container ?>">
		<div class="row">
		<?php if (get_sub_field('block_full_screen_width')) { ?>
			<div class="col">
		<?php } else { ?>
			<div class="col-8 offset-2 col-md-12 offset-md-0 col-sm-12 offset-sm-0">
		<?php } ?>
				<?php the_sub_field('text'); ?>
			</div>
		</div>
		<?php if (get_sub_field('button_title') && get_sub_field('button_link') || get_sub_field('button_type') == 'normal' || get_sub_field('button_type') == 'chat') { ?>
		<div class="row">
			<div class="col">
				<?php include "part_button.php"; ?>
			</div>
		</div>
		<?php } ?>
	</div>

</<?php echo $tag ?>>
