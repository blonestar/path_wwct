
<<?php echo $tag.$id.$class.$style?>>
    <div class="<?php echo $container ?>">
		<div class="column">
            <div class="col-12 text-center">
                <?php if (get_sub_field('image')) { ?>
                <amp-img src="<?php  the_sub_field('image') ?>" alt="" width="100" height="100"></amp-img>
                <?php } ?>
                <h2><?php the_sub_field('title') ?></h2>                
                        <?php if (get_sub_field('subpages')) { ?>
                            <select class="jump-on-select" on="change:AMP.setState({ url: event.value })">
                                <option value="1"><?php the_sub_field('title') ?></option>
                        <?php   while (have_rows('subpages')) { the_row() ?>
                                <!--<option value="<?php  the_sub_field('link_to') ?>"><?php  the_sub_field('label') ?></option>-->
                                <option value="a<?php echo @++$i ?>"><?php  the_sub_field('label') ?></option>
                        <?php   } ?>
                            </select>
                            
                        <?php } ?>                 
                <hr/>



        			<div class="text-center">
                        <?php the_sub_field('content') ?>
                        <?php if (get_sub_field('button_title') && get_sub_field('button_link')) { ?>

<?php

if (get_sub_field('button_type') != 'none') {
    $button_id = 'id'.uniqid();
?>

<div id="<?php echo $button_id ?>" class="btn-wrapper text-center">
<?php if (get_sub_field('button_type') == 'normal' || ! get_sub_field('button_type')) { ?>
    <a href="<?php the_sub_field('button_link') ?>" class="btn btn-primary<?php //echo $button_class ?><?php echo (get_sub_field('button_outline')) ? ' btn-outline' : '' ?>"<?php echo (get_sub_field('button_rel')) ? ' rel="'.get_sub_field('button_rel').'"' : '' ?><?php echo (get_sub_field('button_target')) ? ' target="'.get_sub_field('button_target').'"' : ''; ?><?php //echo $style_inline ?>><?php the_sub_field('button_icon') ?> <?php the_sub_field('button_title') ?></a>
<?php } else { ?>
        <a href="" class="btn btn-chat <?php echo (get_sub_field('button_outline')) ? ' btn-outline' : '' ?>" data-title-online="<?php the_sub_field('button_online_title') ?>" data-title-away="<?php the_sub_field('button_away_title') ?>" data-title-offline="<?php the_sub_field('button_offline_title') ?>"><?php the_sub_field('button_icon') ?> <span><?php the_sub_field('button_online_title') ?></span></a>
        
<?php } ?>
</div>

<?php

} // endif
?>
                        <?php } ?>
        	        </div>

            </div>
	    </div>
	</div>
</<?php echo $tag ?>>