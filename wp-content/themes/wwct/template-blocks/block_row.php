
<<?php echo $tag.$id.$class.$style?>>
	<div class="<?php echo $container ?>">
		<div class="row">
            <?php if( have_rows('columns') ) { ?>
                <?php while ( have_rows('columns') ) { the_row(); ?>

                    <div class="col-<?php the_sub_field('width') ?> <?php the_sub_field('class') ?>">
                        <?php foreach(get_sub_field('template_block') as $tblock_id) { ?>
                            <br><?php echo $tblock_id."<br>"; ?>
                            <?php echo get_template_blocks($tblock_id); ?>
                        <?php } ?>
                    </div>

                <?php } ?>
            <?php } ?>
    	</div>
	</div>
</<?php echo $tag ?>>
