<?php
/*
 * Template Name: Resources
 */
?><?php get_header() ?>
<?php the_post() ?>

<?php
	$main_col_width = 10;

	if (have_rows('widgets')) {
		$main_col_width = 7;
	}
	
	
	$terms = get_terms( array(
		'taxonomy' => 'resources_tax',				'posts_per_page' => -1,
		'hide_empty' => false,
	) );		/* sort taxonomies by tax_order field */	$count = count($terms);	for ($i=0; $i<$count; $i++) {		$terms[$i]->sort_order = get_field('tax_order', 'resources_tax_'.$terms[$i]->term_id);	}	usort($terms, 'worldwide_sort_terms_function');			

	$all_selected = is_tax() ? "" : " selected";
	
	
	
?>

<div class="container-wrapper standard-container-wrapper ">
	<div class="container">
		<div class="tabs">
			<div class="row">
				<a class="tab<?php echo $all_selected ?>" href="<?php echo site_url('resources/resource-library') ?>">All</a>
				<?php
					$i = 0;
					foreach ($terms as $term) {
						$active = ($term->term_id == get_queried_object()->term_id) ? ' selected' : '';
						if (++$i==5) echo "<br>";
				?>
				<a class="tab<?php echo $active ?>" href="<?php echo site_url('resources/resource-library/' . $term->slug) ?>"><?php echo $term->name ?></a>
				<?php } ?>
			</div>
		</div>
		
		<?php if ($featured_articles = get_field('featured_articles')) { ?>
		<div class="library-featured">
			<?php if (get_field('featured_articles_title')) { ?>
			<div class="featured-heading"><?php the_field('featured_articles_title') ?></div>
			<?php } ?>
			<?php 
				foreach($featured_articles as $post) { 
					setup_postdata($post); 
					$featured_articles_ids[] = get_the_ID();
			?>
			<div class="featured-item">
				<div class="library-thumb">
					<?php get_read_more_link(get_the_post_thumbnail(get_the_ID(), 'post-thumbnails')) ?>
				</div>
				<div class="library-title">
					<?php get_read_more_link(get_the_title()) ?>
				</div>
				<?php if (has_excerpt()) { ?>
				<div class="library-summary"><?php the_excerpt() ?></div>
				<?php } ?>
				<div class="read-more">
					<?php get_read_more_link() ?>
				</div>

			</div>
			<?php } ?>
		</div>
		<?php } ?>


		<?php 
		
			$query = new WP_Query(array(
								'post_type'			=> 'resources',
								'posts_per_page'	=> -1,
								'orderby'			=> 'date',
								'order'				=>  'desc'
							));
		
		
		if ( $query->have_posts() ) : ?>
		<div class="library-list">
			<h2 class="alt-heading">All</h2>
			<div class="row">
				<div>
					<div class="col-sm-12">
					
						<?php while ( $query->have_posts() ) : $query->the_post(); ?>
						<div class="library-item">
							<div class="library-title"><?php the_title() ?></div>
							<?php if (has_excerpt()) { ?>
							<div class="library-summary"><?php the_excerpt() ?></div>
							<?php } ?>
							<div class='read-more '>
								<?php $featured_resource = (@in_array(get_the_ID(), $featured_articles_ids)) ? ' featured-resource' : '' ?>
								<div class="view-video<?php echo $featured_resource ?>">
									<?php get_read_more_link() ?>
								</div>
							</div>
						</div>
						<?php endwhile; ?>

					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>
	</div>
</div>
			
	
<?php if( have_rows('template_blocks') ): ?>
	<?php get_template_blocks(get_the_ID()) ?>
<?php endif; ?>

<?php get_footer() ?>