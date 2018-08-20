<?php
/*
 * Template name: Services Page with Sidebar
 */
get_header();
the_post();
?>

<?php if ( ! empty_content($post->post_content)) { ?>
<section class="main-content">
	<div class="container">
		<div class="row">
			<div class="col-4">
				<?php dynamic_sidebar( '' ); ?>
			</div>
			<div class="col-8">
				<?php the_content() ?>
			</div>
		</div>
	</div>
</section>
<?php } ?>

<section class="main-content">
	<div class="container">
		<div class="row">
			<div class="col">
                <pre>
<?php


	global $post;
        /* Get an array of Ancestors and Parents if they exist */
	$parents = get_post_ancestors( get_the_ID() );
        /* Get the top Level page->ID count base 1, array base 0 so -1 */ 
	$id = ($parents) ? $parents[count($parents)-1]: get_the_ID();
	/* Get the parent and set the $class with the page slug (post_name) */
    $parent = get_post( $id );
	$parent->post_name;



    $children = wp_list_pages( array(
        'title_li' => '',
        'child_of' => $parent->ID,
        'echo'     => 0
    ) );

 
if ( $children ) : ?>
    <ul>
        <?php echo $children; ?>
    </ul>
<?php endif; ?>
                </pre>
            </div>
        </div>
    </div>
</section>

<?php if( have_rows('template_blocks') ): ?>
	<?php get_template_blocks(get_the_ID()) ?>
<?php endif; ?>

<?php get_footer() ?> 
