
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
                $columns_count = count(get_sub_field('columns'));
                $lg = (12 / $columns_count);
                $md = ($columns_count == 4) ? 6 : (12 / $columns_count);

                if( have_rows('columns') ):
                    
                    while ( have_rows('columns') ) : the_row();
                        $link_title = get_sub_field('title');
                        $link_url = get_sub_field('category');
                        $link = get_sub_field('link');
                        if (!$link_title)
                            $link_title = $link['title'];
                ?>

                    <div class="col-12 col-md-<?php echo $md ?> col-lg-<?php echo $lg ?> my-2 my-md-3 my-lg-0">
                        <?php if ($link) { ?>
                        <a class="column-block h-100" href="<?php echo $link['url'] ?>">
                        <?php } else { ?>
                        <div class="column-block h-100">
                        <?php } ?>
                        <div class="column-block-inner position-relative" style="background-image: url(<?php the_sub_field('image') ?>);">
                            <div class="vertical-center text-center text-white">
                                <h4 class="column_title"><?php echo $link_title ?></h4>
                                <p class="column_category"><?php the_sub_field('category') ?></p>
                            </div>
                        </div>
                        <?php if ($link) { ?>
                        </a>
                        <?php } else { ?>
                        </div>
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
    .block_related_categories_module  .column-block {
        border: 1px solid #ddd;
        padding: 10px;
        display: block;
    }
    .block_related_categories_module  .column-block:hover .column-block-inner {
        opacity: 0.85;
        filter: alpha(opacity=85); // IE 5-7
    }
    .block_related_categories_module .column-block-inner {
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        height: 220px;
    }
    .block_related_categories_module a.column-block {
        text-decoration: none;
    }
    @media (max-width: 1200px) {
        .block_related_categories_module .column-block-inner > * {
            font-size:80%;
        }
    }
    @media (max-width: 992px) {
        .block_related_categories_module .column-block-inner > * {
            font-size:75%;
        }
    }
/*
    .template-block.block_column_blocks .column-block {
        background-color: #f1f4f4;
        padding: 24px 24px;
        position: relative;
    }
    .template-block.block_column_blocks .column_content {
        padding-bottom: 36px;
    }
    .template-block.block_column_blocks .column_link {
        position: absolute;
        bottom: 20px;
    }
    .template-block.block_column_blocks .column_title {
        color: #005a84;
        font-size: 18px;
        line-height: 20px;
        padding-left: 24px;
    }
    .template-block.block_column_blocks .column_content p {
        font-size: 14px;
        line-height: 24px;
    }
    .template-block.block_column_blocks .column_header {
        margin-bottom: 16px;
    }
    .template-block.block_column_blocks .column_header i {
        color: #005a84;
        font-size: 38px;
        line-height: 14px;
        font-weight: bold;
        float: left;
    }
    .column-block:hover .column_header i,
    .column-block:hover .column_header .column_title,
    .column-block:hover .column_link {
        color: #aa2d78;
    }
    */
</style>