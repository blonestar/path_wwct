
<<?php echo $tag.$id.$class.$style ?>>

    <div class="<?php echo $container ?>">
		<div class="column">
			<div class="col-12">
				<?php the_sub_field('text'); ?>
			</div>
		</div>
		<?php if (get_sub_field('button_title') && get_sub_field('button_link') || get_sub_field('button_type') == 'normal' || get_sub_field('button_type') == 'chat') { ?>
		<div class="column">
			<div class="col-12">
				<?php include "part_button.php"; ?>
			</div>
		</div>
		<?php } ?>
	</div>

</<?php echo $tag ?>>
