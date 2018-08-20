<?php

if (get_sub_field('button_type') != 'none') {

    //var_dump(get_sub_field('button_outline'));

    $button_id = 'id'.uniqid();

    $style = "";
    if (get_sub_field('button_color'))
        $style[] ="background-color: " . get_sub_field('button_color') . " ";
        
        if (get_sub_field('button_outline') && get_sub_field('button_outline_color')) {
            $style[] = "border-color: " . get_sub_field('button_outline_color') . " ";
            $style[] = "border-style: solid";
            $style[] = "border-width: 1px";
        }
        if (get_sub_field('button_text_color'))
        $style[] ="color: " . get_sub_field('button_text_color') . " ";
        
        // echo 111111111;
        //print_r($style);
        //echo 222222222;
        
        $style_hover = "";
    if (get_sub_field('button_color_hover'))
        $style_hover[] ="background-color: " . get_sub_field('button_color_hover') . " !important";
        
    if (get_sub_field('button_outline') && get_sub_field('button_outline_color_hover'))
        $style_hover[] ="border-color: " . get_sub_field('button_outline_color_hover') . " !important";
    if (get_sub_field('button_outline') && !get_sub_field('button_color'))
        $style[] ="background-color:  rgba(0,0,0,0)";

    if (get_sub_field('button_text_color_hover'))
        $style_hover[] ="color: " . get_sub_field('button_text_color_hover') . " !important";

    if (is_array($style)) {
        $style_inline = implode('; ', array_filter($style));
        $style_inline = preg_replace('/;+/', ';', trim($style_inline).';');
        $style_inline = ' style="'.$style_inline.'"';
    }

    if (is_array($style)) {
        $style = implode('; ', array_filter($style));
        $style = preg_replace('/;+/', ';', trim($style).';');
    }

    if (is_array($style_hover)) {
        $style_hover = implode('; ', array_filter($style_hover));
        $style_hover = preg_replace('/;+/', ';', trim($style_hover).';');
    }
    
?>

<div id="<?php echo $button_id ?>" class="btn-wrapper text-<?php the_sub_field('button_align') ?>"<?php if (get_sub_field('button_margins')!='') echo ' style="margin: '.get_sub_field('button_margins').';"'; ?>>
<?php if (get_sub_field('button_type') == 'normal' || ! get_sub_field('button_type')) { ?>
    <a href="<?php the_sub_field('button_link') ?>" class="btn<?php //echo $button_class ?><?php echo (get_sub_field('button_outline')) ? ' btn-outline' : '' ?>"<?php echo (get_sub_field('button_rel')) ? ' rel="'.get_sub_field('button_rel').'"' : '' ?><?php echo (get_sub_field('button_target')) ? ' target="'.get_sub_field('button_target').'"' : ''; ?><?php //echo $style_inline ?>><?php the_sub_field('button_icon') ?> <?php the_sub_field('button_title') ?></a>
<?php } else { ?>
        <a href="" class="btn btn-chat <?php echo (get_sub_field('button_outline')) ? ' btn-outline' : '' ?>" data-title-online="<?php the_sub_field('button_online_title') ?>" data-title-away="<?php the_sub_field('button_away_title') ?>" data-title-offline="<?php the_sub_field('button_offline_title') ?>"><?php the_sub_field('button_icon') ?> <span><?php the_sub_field('button_online_title') ?></span></a>
        
<?php } ?>
</div>
<style>
    <?php echo "#".$button_id ?> > .btn {
        <?php echo $style ?>
    }
    <?php echo "#".$button_id ?> > .btn:hover {
        <?php echo $style_hover ?>
    }
</style>

<?php /* if (get_sub_field('button_color_hover')) { ?>
<style><?php echo "#{$button_id}:".get_sub_field('button_color_hover'); ?>/style>
<?php } */ ?>

<?php

} // endif