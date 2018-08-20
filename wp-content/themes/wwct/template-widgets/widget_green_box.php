
<div class="widget <?php echo get_row_layout() ?> text-center">
    <h2><?php the_sub_field('title') ?></h2>
    <div class="widget-content">
    <?php the_sub_field('content') ?>
        <?php if (get_sub_field('button_label') && get_sub_field('button_link')) { ?>
        <div>
            <a href="<?php the_sub_field('button_link') ?>" class="btn btn-outline btn-white"><?php the_sub_field('button_label') ?></a>
        </div>
        <?php } ?>
    </div>
</div>
