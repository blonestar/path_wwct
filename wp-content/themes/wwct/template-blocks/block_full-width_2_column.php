
<<?php echo $tag.$id.$class.$style?>>
	<div class="<?php echo $container ?>">
		<div class="row no-gutters">
            <?php $pos = get_sub_field('image_side'); ?>
            <?php $bgstyle = ' style="background: url('.get_sub_field('image').') center center no-repeat; background-size: cover; min-height: 250px;"'; ?>
            <?php if ($pos=='left') { ?>
            <div class="col-12 col-sm-12 col-md-6">
                <div class="h-100 w-100 d-table"<?php echo $bgstyle ?>>
                    <?php 
                        $overlay_image = get_sub_field('overlay_image');
                        $overlay_image_desc = get_sub_field('overlay_image_description'); ?>
                    <?php if ($overlay_image || $overlay_image_desc) { ?>
                    <div class="h-100 d-table-cell align-middle text-center">
                        <?php if ($overlay_image) { ?>
                            <?php echo wp_get_attachment_image($overlay_image, 'full') ?>
                            <?php if ($overlay_image_desc) { ?>
                                <div class="overlay-image-delim"></div>
                            <?php } ?>
                        <?php } ?>
                        <?php if ($overlay_image_desc) { ?>
                        <div class="overlay-image-description text-center text-white"><?php echo $overlay_image_desc ?></div>
                        <?php } ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
            <div class="col-12 col-sm-12 col-md-6">
                <div class="block-content">

                
                <?php the_sub_field('content') ?>
                
            </div>
            </div>
            <?php if ($pos=='right') { ?>
                <div class="col-12 col-sm-12 col-md-6"<?php echo $bgstyle ?>>
                    <div class="h-100"<?php echo $bgstyle ?>>&nbsp;</div>
                </div>
            <?php } ?>
	    </div>
	</div>
</<?php echo $tag ?>>
<style>
    .template-block.block_full-width_2_column .block-content {
        <?php if (get_sub_field('content_background_color')) { ?>
        background-color: <?php the_sub_field('content_background_color') ?>;
        <?php } ?>
        padding: 26px 40px;
    }
    .template-block.block_full-width_2_column > .container-fluid {
        padding-left: 0; 
        padding-right: 0; 
    }
    .template-block.block_full-width_2_column .overlay-image-delim {
        border-top: 2px solid #fff;
        border-bottom: 2px solid #fff;
        width: 100px;
        margin: 20px auto;
    }
    .template-block.block_full-width_2_column .overlay-image-description {
        font-weight: bold;
    }
    @media (max-width: 768px) {
        .template-block.block_full-width_2_column .d-table,
        .template-block.block_full-width_2_column .d-table-cell {
            --display: block !important;
        }
        .template-block.block_full-width_2_column .h-100 {
            height: unset !important;
            padding: 20px 0;
        }
    }

</style>