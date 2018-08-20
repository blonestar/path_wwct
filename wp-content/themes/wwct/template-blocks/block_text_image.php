
<<?php echo $tag.$id.$class.$style?>>
	<div class="<?php echo $container ?>">
		<div class="row">

                    <?php if (get_sub_field('image_side') && get_sub_field('image_side') == 'left') { ?>
        			<div class="col-5">
                        <?php if (get_sub_field('video_as_image')){ ?>
                        <div class="videoWrapper">
                             <?php the_sub_field('video_embed_code'); ?>
                         </div>
                         <?php } else { ?>
                            <?php echo wp_get_attachment_image( get_sub_field('image'), array(404,286) ) ?>
                         <?php } ?>
        	        </div>
                    <?php } ?>
        			<div class="col">
                        <?php the_sub_field('content') ?>
                        <?php if (get_sub_field('button_title') && get_sub_field('button_link')) { ?>
                        <?php include "part_button.php"; ?>
                        <?php } ?>
        	        </div>
                    <?php if (get_sub_field('image_side') == 'right') { ?>
        			<div class="col-5">
                         <?php if (get_sub_field('video_as_image')){ ?>
                          <div class="videoWrapper">
                             <?php the_sub_field('video_embed_code'); ?>
                         </div>
                         <?php } else { ?>
                            <?php echo wp_get_attachment_image( get_sub_field('image'), array(404,286) ) ?>
                         <?php } ?>
        	        </div>
                    <?php } ?>

	    </div>
	</div>
</<?php echo $tag ?>>