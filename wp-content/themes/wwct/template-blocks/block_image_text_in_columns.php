
<<?php echo $tag.$id.$class.$style?>>
	
    <div class="<?php echo $container ?>">
		<div class="row">
            <div class="col">
                <?php the_sub_field('content') ?>
            </div>
        </div>
		<div class="row">
            <?php $rows = count( get_sub_field('columns') ) ?>
            <?php while (have_rows('columns')) { the_row(); ?>
                <div class="col-12 col-md-6 col-lg-3 text-center text-lg-center mb-4 mx-auto">
                    <?php echo wp_get_attachment_image( get_sub_field('image'), 'image-size-4' ) ?>
                    <p class="title"><strong><?php the_sub_field('title') ?></strong></p>
                    <?php the_sub_field('content') ?>
                </div>
            <?php } ?>
	    </div>
    </div>
	
</<?php echo $tag ?>>
