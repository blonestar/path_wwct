

<<?php echo $tag.$id.$class.$style?>>
	
    <div class="<?php echo $container ?>">
		<div class="row">
	    	<div class="col">
                <?php the_sub_field('content') ?>
            </div>
            <?php if (get_sub_field('button_title') && get_sub_field('button_link')) { ?>
	    	<div class="col">
                <?php include "part_button.php"; ?>
            </div>
            <?php } ?>
        </div>
    </div>

</<?php echo $tag ?>>
