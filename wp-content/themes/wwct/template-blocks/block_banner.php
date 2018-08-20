
<<?php echo $tag.$id.$class.$style?>>
    <div class="<?php echo $container ?>">
        <div class="row">
            <div class="col-12 col-sm-10 push-sm-1">
            
                <div class="row align-items-center">
                    <?php 
                        $image = get_sub_field('image');
                        if ($image) {
                    ?>
                            <div class="col-2 text-center">
                                <?php echo wp_get_attachment_image( $image, 'full', null, array( "class" => "banner-image-icon vcent" ) ); ?>
                            </div>
                    <?php
                        }
                    ?>

                    <div class="col">
                        <?php the_sub_field('content') ?>
                        <?php if (get_sub_field('button_title') && get_sub_field('button_link')) { ?>
				            <?php include "part_button.php"; ?>
		                <?php } ?>
                    </div>
                </div>

            </div>
	    </div>
	</div>
</<?php echo $tag ?>>