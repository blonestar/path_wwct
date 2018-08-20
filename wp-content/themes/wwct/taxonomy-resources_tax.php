<?php get_header(); ?>
<?php the_post() ?>

<?php
	$main_col_width = 10;

	if (have_rows('widgets')) {
		$main_col_width = 7;
	}



	$terms = get_terms( array(
		'taxonomy' => 'resources_tax',
		'posts_per_page' => -1,
		'hide_empty' => false,
	) );
	
	/* sort taxonomies by tax_order field */
	$count = count($terms);
	for ($i=0; $i<$count; $i++) {
		$terms[$i]->sort_order = get_field('tax_order', 'resources_tax_'.$terms[$i]->term_id);
	}
	usort($terms, 'worldwide_sort_terms_function');			

	$all_selected = is_tax() ? "" : " selected";
		
        /*
	$query = new WP_Query(array(
						'post_type'			=> 'resources',
						'posts_per_page'	=> -1,
						'orderby'			=> 'date',
						'order'				=>  'desc'
					));
	*/
	$root_page = get_page_by_path('resources/resource-library');
?>

<section class="posts-filter">
	<div class="container">
		<div class="row">
			<div class="offset-1 col-5">
				<div class="filter-by"><span>Filter by:</span> &nbsp; 
					<select id="resources-cat" class="terms-filter">
						<option selected disabled>ASSET TYPE</option>
						<?php 
							$terms = get_terms( 'resources_tax' );
							foreach ($terms as $term) {
						?>
							<option value="<?php echo get_term_link($term) ?>" data-term-id="<?php echo $term->term_taxonomy_id ?>"<?php echo (get_query_var( 'term' ) == $term->slug) ? ' selected' : '' ?>><?php echo $term->name ?></option>
						<?php
							}
						?>
					</select>
				</div>
			</div>
			<div class="col text-right">
				<select placeholder="THERAPEUTIC AREAS">
					<option>2017</option>
					<option>2016</option>
				</select>
				<input class="search-form" placeholder="Search">
			</div>
		</div>
	</div>
</section>



<script>
	
/* <![CDATA[ */
(function() {
	var dropdown = document.getElementById( "resources-cat" );
	function onCatChange() {
		if ( dropdown.options[ dropdown.selectedIndex ].value != '' ) {
			location.href = dropdown.options[ dropdown.selectedIndex ].value;
		}
	}
	dropdown.onchange = onCatChange;
})();
/* ]]> */
</script>

<section class="main-content posts-list resources-list">
	<div class="container">

		<div class="row">
			<div class="col-1">
				<?php echo do_shortcode('[addtoany]'); ?>
			</div>
			<div class="col">
						<div class="row">
				<?php while ( have_posts() ) { the_post(); ?>
							<div class="col-md-4">
								<article class="news-post h-100">
									<div class="article-border h-100">
										<span class="post-date news-post-date"><?php the_date() ?></span>
										<h1 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
										<p clas="filter">FILTER CATEGORY</p>
										<?php the_post_thumbnail('full', array('class' => 'post-img')) ?>
										<?php the_excerpt(); ?>
										<?php get_read_more_link() ?>
									</div>
								</article>
							</div>
				<?php } // endwhile ?>
						</div>
				
			</div>
		</div>

	</div>
</section>

<?php get_footer() ?> 