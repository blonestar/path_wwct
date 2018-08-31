
<<?php echo $tag.$id.$class ?><?php echo $style ?>>
    <div class="<?php echo $container ?>">
		<div class="columns">

			<?php while (have_rows('info_box')) : the_row(); ?>
				<?php $img = get_sub_field('image') ?>
				<div class="column col-4 col-sm-12">
                    <div class="container">
                        <div class="columns">
                            <div class="column col-4">
                            <amp-img src="<?php echo $img['url'] ?>" alt="<?php echo $img['alt'] ?>" width="1.33" height="1" layout="responsive"></amp-img>
                            </div>
                            <div class="column col-8">
                                <strong><?php the_sub_field('title') ?></strong><br />
                                <?php the_sub_field('description') ?>
                                <a href='<?php the_sub_field('link_url') ?>' target="_blank" class="block-link"><?php the_sub_field('link_text') ?> ></a>
                            </div>
                        </div>
                    </div>
				</div>
			<?php endwhile; ?>

		</div>
	</div>
</<?php echo $tag ?>>
