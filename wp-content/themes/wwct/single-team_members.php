<?php get_header() ?>
<?php the_post() ?>

<article>
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="back-link">
					<a href="<?php echo site_url('about-us/meet-the-team/') ?>"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Back to Meet the Team</a>
				</div>
			</div>
		</div>
		<div class="row leadership-member-detail">
			<div class="col-md-4">
				<div class="leadership-image">
					<?php the_post_thumbnail()?>
				</div>
				<div class="widget widget_green_box text-center">
					<h2>GET IN TOUCH</h2>
					<div class="widget-content">
						See what Worldwide Clinical Trials can do for you.
						<div>
							<a href="<?php echo site_url('contact-us/') ?>" class="btn btn-outline btn-white">Contact Us</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<h1 class="leadership-name"><?php the_title() ?></h1>
				<div class="leadership-title"><?php the_field('position') ?></div>
				<?php the_content() ?>
			</div>
		</div>
	</div>
</article>




<?php
	$main_col_width = 10;
	if (have_rows('widgets')) {
		$main_col_width = 7;
	}
	
		
	$terms_arr = get_terms( array(
		'taxonomy' => 'team_members_tax',
		'hide_empty' => false,
		'posts_per_page' => -1,
		'orderby'	=> 'menu_order',
		'order'	=> 'asc'
	) );
	/* sort taxonomies by tax_order field */
	$count = count($terms_arr);	for ($i=0; $i<$count; $i++) {
		$terms_arr[$i]->sort_order = get_field('tax_order', 'team_members_tax_'.$terms_arr[$i]->term_id);
	}
	usort($terms_arr, 'worldwide_sort_terms_function');		
	
	
?>


<?php

//print_r($terms_arr);
$i = 0;
foreach($terms_arr as $term_arr) {

	$query = new WP_Query(array(
					'post_type' => 'team_members',
					'orderby'	=> 'menu_order',
					'order'		=> 'asc',
					'posts_per_page'	=> -1,
					'tax_query' => array(
									array(
										'taxonomy' => 'team_members_tax',
										'field' => 'term_id',
										'terms' => $term_arr->term_id
										)
									)
				));
	if ( $query->have_posts() ) {
	?>
	<section class="team-members">
		<div class="container">
			<div class="row">
				<div class="col-12 text-center">
					<h2><?php echo $term_arr->name ?></h2>
					<br>
				</div>
				<?php
				
				while ( $query->have_posts() ) {
					$query->the_post();	?>
		
				<?php if($i==0): ?>
				<div class="col-xs-6 col-sm-4 col-md-4 leadership-member-summary">
				<?php else: ?>
				<div class="col-xs-6 col-sm-3 col-md-3 leadership-member-summary">
				<?php endif; ?>
				
					<a href="<?php the_permalink() ?>">
						<div class="leadership-image">
							<?php the_post_thumbnail() ?>
						</div>
						<div class="leadership-name">
							<h2><?php the_title() ?></h2>
						</div>
						<div class="leadership-title"><?php the_field('position') ?></div>
					</a>
				</div>
				
				<?php } ?>
			</div>
		</div>
	</section>
<?php 
	}
	$i++;
}
wp_reset_postdata();
?>

<?php 
$parent_page = get_page_by_path( 'about-us/meet-the-team' );
if( have_rows('template_blocks', $parent_page->ID) ): ?>
	<?php get_template_blocks($parent_page->ID) ?>
<?php
endif;
?>

<?php get_footer() ?> 