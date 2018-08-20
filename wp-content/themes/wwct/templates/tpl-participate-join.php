<?php
/*
 * Template name: Participate Join
 */
get_header();
the_post();

/*
global $post;
$parents = get_post_ancestors( get_the_ID() );
$id = ($parents) ? $parents[count($parents)-1]: get_the_ID();
$parent = get_post( $id );
$parent->post_name;

$children = wp_list_pages( array(
    'title_li' => '',
    'child_of' => $parent->ID,
    'echo'     => 0,
	'depth'		=> 1,
	'item_spacing'   => 'discard'
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
*/

get_template_part( 'template-parts/tpl-part-mid-page-submenu' );

?>

<?php if ( ! empty_content($post->post_content)) { ?>
<section class="main-content">
	<div class="container">
		<div class="row">
			<div class="col">
				<?php the_content() ?>
			</div>
			<?php if (@$widget) { // TODO ?>
			<div class="col-4">
                <div class="widget">
					TODO
			    </div>
			</div>
			<?php } ?>
		</div>
	</div>
</section>
<?php } ?>

<?php if( have_rows('template_blocks') ): ?>
	<?php get_template_blocks(get_the_ID()) ?>
<?php endif; ?>

<?php get_footer() ?> 
