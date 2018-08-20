
<<?php echo $tag.$id.$class.$style?>>
    <div class="<?php echo $container ?>">
        <div class="row">
            <?php if (trim(get_sub_field('content')) != '') { ?>
            <div class="col-12 mb-4">

                <?php the_sub_field('content') ?>
                
            </div>
            <?php } ?>
	    </div>
		<div class="row">
            <?php
                $bullets_count = count(get_sub_field('bullet_blocks'));
                $lg = (12 / $bullets_count);
                $md = ($bullets_count == 4) ? 6 : (12 / $bullets_count);
                if( have_rows('bullet_blocks') ):
                    
                    while ( have_rows('bullet_blocks') ) : the_row();
                ?>
                    <div class="col-12 col-md-<?php echo $md ?> col-lg-<?php echo $lg ?> my-2 my-md-3 my-lg-0 box-hover">
                        <?php if (get_sub_field('link_title') && get_sub_field('link_to')) { ?>
                        <a href="<?php the_sub_field('link_to') ?>" class="bullet-link">
                        <?php } ?>
                        <div class="bullet-block h-100">
                            <div class="bullet_header">
                                <i class="fa fa-angle-right" aria-hidden="true"></i> <h4 class="bullet_title"><?php the_sub_field('title') ?></h4>
                            </div>
                            <div class="bullet_content">
                                <?php the_sub_field('content') ?>
                                <?php if (get_sub_field('link_title') && get_sub_field('link_to')) { ?>
                                <span class="bullet_link"><?php the_sub_field('link_title') ?> <i class="fa fa-angle-right" aria-hidden="true"></i></span>
                                <?php } ?>
                            </div>
                        </div>
                        <?php if (get_sub_field('link_title') && get_sub_field('link_to')) { ?>
                        </a>
                        <?php } ?>
                    </div>
            <?php
                    endwhile;
                endif;    
            ?>

	    </div>
	</div>
</<?php echo $tag ?>>
<style>
    .template-block.block_bullet_blocks .bullet-block {
        background-color: #f1f4f4;
        padding: 24px 24px;
        position: relative;
    }
    .template-block.block_bullet_blocks .bullet_content {
        padding-bottom: 36px;
    }
    .template-block.block_bullet_blocks .bullet_link {
        position: absolute;
        bottom: 20px;
    }
    .template-block.block_bullet_blocks .bullet_title {
        color: #005a84;
        font-size: 18px;
        line-height: 20px;
        padding-left: 24px;
    }
    .template-block.block_bullet_blocks .bullet_content p {
        font-size: 14px;
        line-height: 24px;
    }
    .template-block.block_bullet_blocks .bullet_header {
        margin-bottom: 16px;
    }
    .template-block.block_bullet_blocks .bullet_header i {
        color: #005a84;
        font-size: 38px;
        line-height: 14px;
        font-weight: bold;
        float: left;
    }
    .template-block.block_bullet_blocks .bullet-block:hover .bullet_header i,
    .template-block.block_bullet_blocks .bullet-block:hover .bullet_header .bullet_title,
    .template-block.block_bullet_blocks .bullet-block:hover .bullet_link {
        color: #aa2d78;
    }
    .template-block.block_bullet_blocks .bullet-link:hover,
    .template-block.block_bullet_blocks .bullet-link:hover * {
        text-decoration: inherit;
    }
    .template-block.block_bullet_blocks .box-hover:hover .bullet-link .bullet-block {
        background: #fbfbfb;
        -webkit-box-shadow: 0px 0px 7px 0px rgba(0,0,0,0.38);
        -moz-box-shadow: 0px 0px 7px 0px rgba(0,0,0,0.38);
        box-shadow: 0px 0px 7px 0px rgba(0,0,0,0.38);
        --border: solid 1px #aa2d78;
    }

</style>