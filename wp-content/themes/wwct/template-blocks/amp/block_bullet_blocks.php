
<<?php echo $tag.$id.$class.$style?>>
    <div class="<?php echo $container ?>">
        <div class="columns">
            <?php if (trim(get_sub_field('content')) != '') { ?>
            <div class="column col-12 mb-4">

                <?php the_sub_field('content') ?>
                
            </div>
            <?php } ?>
	    </div>
		<div class="columns">
            <?php
                $bullets_count = count(get_sub_field('bullet_blocks'));
                $lg = (12 / $bullets_count);
                $md = ($bullets_count == 4) ? 6 : (12 / $bullets_count);
                if( have_rows('bullet_blocks') ):
                    
                    while ( have_rows('bullet_blocks') ) : the_row();
                ?>
                    <div class="column col-sm-12 col-md-<?php echo $md ?> col-lg-<?php echo $lg ?> box-hover">
                        <?php if (get_sub_field('link_title') && get_sub_field('link_to')) { ?>
                        <a href="<?php the_sub_field('link_to') ?>" class="bullet-link">
                        <?php } ?>
                        <div class="bullet-block h-100">
                            <div class="bullet_header">
                                <i class="fa fa-angle-right" aria-hidden="true"></i> <h4 class="bullet_title"><?php the_sub_field('title') ?></h4>
                            </div>
                            <div class="bullet_content">
                                <?php the_sub_field('content') ?>
                                <?php if (get_sub_field('link_title') && get_sub_field('link_to')) { ?>
                                <span class="bullet_link"><?php the_sub_field('link_title') ?> <i class="fa fa-angle-right" aria-hidden="true"></i></span>
                                <?php } ?>
                            </div>
                        </div>
                        <?php if (get_sub_field('link_title') && get_sub_field('link_to')) { ?>
                        </a>
                        <?php } ?>
                    </div>
            <?php
                    endwhile;
                endif;    
            ?>

	    </div>
	</div>
</<?php echo $tag ?>>
