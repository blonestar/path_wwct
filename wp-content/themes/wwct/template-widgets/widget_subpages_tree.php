<?php

global $post;
$parents = get_post_ancestors( get_the_ID() );
$id = ($parents) ? $parents[count($parents)-1]: get_the_ID();
$parent = get_post( $id );
$parent->post_name;

$children = wp_list_pages( array(
    'title_li' => '',
    'child_of' => $parent->ID,
    'echo'     => 0
) );

?>

<div class="widget <?php echo get_row_layout() ?> as-accord-holder <?php the_sub_field('widget_type') ?><?php echo (get_sub_field('show_star')) ? ' widget-with-star' : '' ?>">
    <h2<?php echo (get_the_ID() == $parent->ID) ? ' class="current_page"' : ''?>><a href="<?php echo get_permalink($parent->ID) ?>"><?php echo $parent->post_title ?></a></h2>
    <?php if ( $children ) : ?>
        <ul class="as-accord">
            <?php echo $children; ?>
        </ul>
    <?php endif; ?>
</div>