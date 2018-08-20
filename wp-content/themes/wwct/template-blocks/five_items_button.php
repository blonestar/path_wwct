
<<?php echo $tag.$id.$class.$style ?>>

	<div class="<?php echo $container ?>">
		<div class="row">
			<div class="col as-title">
				<?php the_sub_field('content'); ?>
			</div>
		</div>
		<div class="row as-main">
			<?php while(have_rows('items')) { the_row(); ?>
			<div class="col col-12 col-sm-6 col-md-4 col-lg-2 text-center mx-auto">
				<div class="img-holder">
				<?php // echo wp_get_attachment_image( get_sub_field('image')) 
				if (get_sub_field('image')){ ?>
				<img class="main-serv-img" src="<?php the_sub_field('image') ?>"  alt="services">
				<?php } ?>
				<?php if (get_sub_field('image_on_hover')){ ?>
				<img class="sec-serv-img" src="<?php the_sub_field('image_on_hover') ?>"  alt="services">
				<?php } ?>
				</div>				
				<h3>
					<a href="<?php the_sub_field('link') ?>"><?php the_sub_field('label') ?></a>
				</h3>
				<?php the_sub_field('content') ?>
			</div>
			<?php } ?>
		</div>
		<?php if (get_sub_field('button_title') && get_sub_field('button_link')) { ?>
		<div class="row">
			<div class="col">
				<?php include "part_button.php"; ?>
			</div>
		</div>
		<?php } ?>
	</div>

</<?php echo $tag ?>>
