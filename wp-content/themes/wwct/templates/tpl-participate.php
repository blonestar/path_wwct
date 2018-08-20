<?php
/*
 * Template name: Participate
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
	'exclude'	=> '8424', // join-a-study page
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

			<?php if (get_field('show_sidebar') && get_field('sidebar_side') == 'left' && have_rows('template_widgets')) { ?>
			<div class="col-md-<?php the_field('sidebar_column_width') ?> col-sm-12">
				<aside> 
					<?php get_template_widgets(get_the_ID()) ?>
				</aside>
			</div>
			<?php } ?>

			<div class="col<?php echo (get_field('show_sidebar') && have_rows('template_widgets')) ? '' : '-10 offset-1'; ?>">
				<?php the_content() ?>
			</div>

			<?php if (get_field('show_sidebar') && get_field('sidebar_side') == 'right' && have_rows('template_widgets')) { ?>
			<div class="col-md-<?php the_field('sidebar_column_width') ?> col-sm-12">
				<aside> 
					<?php get_template_widgets(get_the_ID()) ?>
				</aside>
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
