<?php
/*
 * Template name: Participate - Current Studies
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

<section class="container-wrapper light-container-wrapper ">
	<div class="container">
		<div class="row">
			<div class="col">
				<?php the_content() ?>
			</div>
		</div>
		<div class="row">



						<?php
							$query = new WP_Query(array(
												'post_type'			=> 'studies',
												'posts_per_page'	=> -1,
												'meta_key'			=> 'study_active',
												'meta_value'		=> '1'
											));
							while($query->have_posts()) {
								$query->the_post();
						?>
						<div class="col-sm-4">

							<article class="current-study">
								<header>
									<h2><?php the_title() ?></h2>
									<p class="study-summary"><?php if (has_excerpt()) the_excerpt() ?></p>
								</header>
								
								
								<p class="study-info">
									<strong>Compensation</strong> <?php the_field('study_compensation') ?>
								</p>
								
								<p class="study-info">
									<strong>Needed</strong> <?php the_field('study_needed') ?>
								</p>
								
								<p class="study-info">
									<strong>Dates</strong> <?php the_field('study_dates') ?>
								</p>
								
								<p class="study-info">
									<strong>Location</strong> <?php the_field('study_location') ?>
								</p>

									
								<div class="study-btns">
									<a href="<?php the_permalink() ?>" class="btn btn-small btn-default block">View Details</a>
								</div>

								<footer>
									<!-- //TODO - Social icons area -->
								</footer>
							</article>
						</div>
						<?php } ?>
						<?php wp_reset_query(); ?>




		</div>
	</div>
</section>

<style>
.less-link,
.more-link {
    display: block;
}
.less-link,
span.more-content  {
    display: none;
}
</style>
	
<?php if( have_rows('template_blocks') ): ?>
	<?php get_template_blocks(get_the_ID()) ?>
<?php endif; ?>

<?php get_footer() ?> 