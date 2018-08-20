<?php

global $post;
if (is_singular('studies')) {
    $parent = get_page_by_path('participate-in-a-study');
} else {
    $parents = get_post_ancestors( get_the_ID() );
    $id = ($parents) ? $parents[count($parents)-1]: get_the_ID();
    $parent = get_post( $id );
    $parent->post_name;
}
$children = wp_list_pages( array(
    'title_li' => '',
    'child_of' => $parent->ID,
    'echo'     => 0,
	'depth'		=> 1,
	'exclude'	=> '8424,10530', // join-a-study page, friendshippays
	'item_spacing'   => 'discard',
    'walker'				=> new Walker_Page_study()
) );


?>


<nav class="hero-menu">
	<div class="container">
		<div class="row">
			<div class="col text-center">
				<?php if ( $children ) : ?>
					<ul>
						<li<?php echo ($parent->ID == get_the_ID()) ? ' class="current_page_item"' : ''?>><a href="<?php the_permalink($parent->ID) ?>"><?php echo $parent->post_title ?></a></li><?php echo $children; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>
	</div>
</nav>