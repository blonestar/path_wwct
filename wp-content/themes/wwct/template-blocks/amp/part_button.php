<?php

if (get_sub_field('button_type') != 'none') {


    $button_id = 'id'.uniqid();

    
?>

<div id="<?php echo $button_id ?>" class="btn-wrapper text-<?php the_sub_field('button_align') ?>">
<?php if (get_sub_field('button_type') == 'normal' || ! get_sub_field('button_type')) { ?>
    <a href="<?php the_sub_field('button_link') ?>" class="btn btn-primary<?php //echo $button_class ?><?php echo (get_sub_field('button_outline')) ? ' btn-outline' : '' ?>"<?php echo (get_sub_field('button_rel')) ? ' rel="'.get_sub_field('button_rel').'"' : '' ?><?php echo (get_sub_field('button_target')) ? ' target="'.get_sub_field('button_target').'"' : ''; ?><?php //echo $style_inline ?>><?php the_sub_field('button_icon') ?> <?php the_sub_field('button_title') ?></a>
<?php } else { ?>
        <a href="" class="btn btn-chat <?php echo (get_sub_field('button_outline')) ? ' btn-outline' : '' ?>" data-title-online="<?php the_sub_field('button_online_title') ?>" data-title-away="<?php the_sub_field('button_away_title') ?>" data-title-offline="<?php the_sub_field('button_offline_title') ?>"><?php the_sub_field('button_icon') ?> <span><?php the_sub_field('button_online_title') ?></span></a>
        
<?php } ?>
</div>

<?php

} // endif