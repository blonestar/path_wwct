
<<?php echo $tag.$id.$class.$style?>>
<div class="<?php echo $container ?>">
    <div class="row<?php echo $no_gutters ?>">
            <?php $pos = get_sub_field('text_side'); ?>
            <?php if ($pos=='left') { ?>
            <div class="col-12 col-sm-7 mb-5 mb-sm-0">
            
                <div class="block_text_and_blockquote__content">
                    <?php the_sub_field('text') ?>
                </div>

            </div>
            <?php } ?>
            <div class="col-12 col-sm-5<?php echo ($pos=='right') ? ' mb-5 mb-sm-0' : '' ?>">

                <div class="block_text_and_blockquote__blockquote">

                    <?php the_sub_field('blockquote') ?>
                    <?php if (get_sub_field('button_title') && get_sub_field('button_link')) { ?>
                        <br>
                    <?php include "part_button.php"; ?>
                    <?php } ?>

                </div>

            </div>
            <?php if ($pos=='right') { ?>
            <div class="col-12 col-sm-7">
            
            <div class="block_text_and_blockquote__content">
                    <?php the_sub_field('text') ?>
                </div>

            </div>
            <?php } ?>
	    </div>
	</div>
</<?php echo $tag ?>>
