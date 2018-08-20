
<<?php echo $tag.$id.$class ?><?php echo $style ?>>
	<div class="<?php echo $container ?>">
		<div class="row">

			<?php while (have_rows('info_box')) : the_row(); ?>
				<?php $img = get_sub_field('image') ?>
				<div class="col-md-4 main-block">
					<div class="row">
						<div class="col-4">
							<img alt="<?php echo $img['alt'] ?>" src="<?php echo $img['url'] ?>" />
						</div>
						<div class="col-8">
							<strong><?php the_sub_field('title') ?></strong><br />
							<?php the_sub_field('description') ?>
							<a href='<?php the_sub_field('link_url') ?>' target="_blank" class="block-link"><?php the_sub_field('link_text') ?> ></a>
						</div>
					</div>
				</div>
			<?php endwhile; ?>

		</div>
	</div>
</<?php echo $tag ?>>