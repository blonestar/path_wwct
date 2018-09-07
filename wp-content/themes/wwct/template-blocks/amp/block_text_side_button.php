

<<?php echo $tag.$id.$class.$style?>>
	
    <div class="<?php echo $container ?>">
		<div class="columns">
	    	<div class="column col-6 col-md-12">
                <?php the_sub_field('content') ?>
            </div>
            <?php if (get_sub_field('button_title') && get_sub_field('button_link')) { ?>
	    	<div class="columns col-6 col-md-12">
                <?php include "part_button.php"; ?>
            </div>
            <?php } ?>
        </div>
    </div>

</<?php echo $tag ?>>
