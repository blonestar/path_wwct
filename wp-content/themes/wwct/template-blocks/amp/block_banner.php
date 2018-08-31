
<<?php echo $tag.$id.$class.$style?>>
    <div class="<?php echo $container ?>">
        <div class="columns">
            <?php 
                $image_bg = get_sub_field('image');
                if ($image) {
                    $style_bg = ' style="background-image: url('.$image.')"';
                }
            ?>
            <div class="col-12 text-center"<?php echo $style_bg ?>>
            
                <?php the_sub_field('content') ?>
                <?php if (get_sub_field('button_title') && get_sub_field('button_link')) { ?>
                    <?php include "part_button-amp.php"; ?>
                <?php } ?>

            </div>
	    </div>
	</div>
</<?php echo $tag ?>>