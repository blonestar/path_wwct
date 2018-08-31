
<<?php echo $tag.$id.$class.$style ?>>

    <div class="<?php echo $container ?>">
		<div class="columns">
			<div class="col-12 as-title">
				<?php the_sub_field('content'); ?>
			</div>
		</div>
		<div class="columns as-main">
			<?php while(have_rows('items')) { the_row(); ?>
			<div class="col-4 col-md-12 text-center col-mx-auto">
				<div class="img-holder">
				<?php // echo wp_get_attachment_image( get_sub_field('image')) 
				if (get_sub_field('image')){ ?>
				<amp-img class="main-serv-img" src="<?php the_sub_field('image') ?>"  alt="services" width="82" height="82"></amp-img>
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
		<div class="columns">
			<div class="col-12">
				<?php include "part_button.php"; ?>
			</div>
		</div>
		<?php } ?>
	</div>

</<?php echo $tag ?>>
