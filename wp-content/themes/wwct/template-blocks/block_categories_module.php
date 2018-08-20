
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
                ?>


<?php
// Set up the objects needed
$my_wp_query = new WP_Query();
$all_wp_pages = $my_wp_query->query(array('post_type' => 'page', 'posts_per_page' => '-1'));

// Get the page as an Object
$what_page =  get_sub_field('page');
//echo '<pre>1' . print_r( $what_page, true ) . '2</pre>';
//var_dump( $what_page);
$page_title = $what_page->post_title;
if (get_sub_field('title'))
    $page_title = get_sub_field('title');

// Filter through all pages and find Portfolio's children
$page_children = get_page_children( $what_page->ID, $all_wp_pages );

// echo what we get back from WP to the browser
//echo '<pre>' . print_r( $page_children, true ) . '</pre>';
?>

                    <div class="col-12 col-md-<?php echo $md ?> col-lg-<?php echo $lg ?> my-2 my-md-3 my-lg-0">
                        <div class="column-block h-100">
                            <div class="column_header">
                                <a href="<?php echo get_permalink($what_page->ID) ?>"> <h4 class="column_title"><?php echo $page_title ?></h4>
                            </div>
                            <div class="column_content">
                                <ul>
                                <?php foreach($page_children as $pc) { ?>
                                    <li>
                                        <a href="<?php echo get_permalink($pc->ID) ?>" class="column_link"><?php echo $pc->post_title ?></a>
                                    </li>
                                <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
            <?php
                    endwhile;
                endif;    
            ?>

	    </div>
	</div>
</<?php echo $tag ?>>
<style>
    .column_header {
        border-bottom: 2px #005a84 solid;
        margin-bottom: 16px;
    }
    .column_header h4 {
        font-size: 18px;
    }
    .column_content ul {
        padding: 0;
        margin: 0;
    }
    .column_content ul li {
        list-style: none;
        margin-bottom: 4px;
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