
<<?php echo $tag.$id.$class.$style?>>
	<div class="container">
		<div class="row">
            <div class="col-11 offset-1">
                <h2><?php the_sub_field('title') ?></h2>                
                        <?php if (get_sub_field('subpages')) { ?>
                            <select class="jump-on-select float-right">
                                <option value=""><?php the_sub_field('title') ?></option>
                        <?php   while (have_rows('subpages')) { the_row() ?>
                                <option value="<?php  the_sub_field('link_to') ?>"><?php  the_sub_field('label') ?></option>
                        <?php   } ?>
                            </select>
                        <?php } ?>                 
                <hr/>
            </div>
		</div>
		<div class="row">
            <div class="col-10 offset-1">
                <div class="row">
        			<div class="col-2" style="background-image:url( <?php  the_sub_field('image') ?>)">
                        <?php // echo wp_get_attachment_image( get_sub_field('image') ) ?>
        	        </div>
        			<div class="col mt-4">
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