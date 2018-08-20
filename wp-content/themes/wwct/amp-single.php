<?php get_header(); ?>
<?php the_post(); ?>

<article class="main-content">
	<div class="container">
		<div class="row">

			<div class="col-2 col-lg-1 hidden-md-down">
				<?php get_template_part( 'template-parts/tpl-part-share-vertical' ) ?>
			</div>

			<div class="col  blog-post">
				<h1><?php the_title() ?></h1>
				<div class="author">
					<?php if (get_field('author')) { ?> By <?php echo get_field('author') ?>, <?php } ?><span class="post-date"><?php the_date() ?></span>
				</div>
				<?php the_content() ?>


				<div class="post-categories">

					<?php 
						$cats = wp_get_post_categories($post->ID);
						//print_r($tags);
						if (!empty($cats)) {
					?>
					<div class='blog-sep'></div>
					<div class='cats'>
						<strong>CATEGORIES</strong>&nbsp;
						<?php
						//print_r($cats);
							foreach($cats as $cat) {
								$category = get_category($cat);
								$cats_html[] = '<a class="tag category" href="' . get_term_link($category). '">' . ucwords($category->name) . '</a>';
							}
						?>
						<div class="post-categories-wrapp">
							<?php echo implode($cats_html, ' '); ?>
						</div>
					</div>
					<?php } ?>
					  
					<?php
						$prev_post = get_previous_post();
						$next_post = get_next_post();
					
					?>
					<div class="row post-prev-next">
						<div class="col text-right">
							<?php if (!empty($prev_post)) { ?>
							<p class="post-prev-next-label"><a href="<?php echo $prev_post->guid ?>"><i class="fa fa-chevron-left" aria-hidden="true"></i> Previous Post</a></p>
							<p><a href="<?php echo $prev_post->guid ?>"><?php echo $prev_post->post_title ?></a></p>
							<?php } ?>
						</div>
						<div class="col text-left">
							
							<?php if (!empty($next_post)) { ?>
							<p class="post-prev-next-label"><a href="<?php echo $next_post->guid ?>">Next Post <i class="fa fa-chevron-right" aria-hidden="true"></i></a></p>
							<p><a href="<?php echo $next_post->guid ?>"><?php echo $next_post->post_title ?></a></p>
							<?php } ?>
						</div>
					</div>

				</div>
			</div>

			<div class="col-12 col-sm-10 offset-sm-2 col-md-5 offset-md-0 col-lg-4 col-xl-3">
				<aside>
					<?php dynamic_sidebar( 'sidebar-blog' ); ?>
				</aside>
			</div>

		</div>
	</div>
</article>


<?php
	wp_reset_query();

	// RELATED POSTS
	//for use in the loop, list 3 post titles related to first tag on current post
	$tags = wp_get_post_tags($post->ID, array('fields'=>'ids'));
	if ($tags) {
		$args=array(
			'post_type' => 'post',
			'tag__in' => $tags,
			'post__not_in' => array($post->ID),
			'posts_per_page'=>3,
			'ignore_sticky_posts' => 1
		);
		$my_query = new WP_Query($args);
		if( $my_query->have_posts() ) {
?>
<section class="related-posts">
	<div class="container">
		<div class="row">
			<div class="col offset-1">
				<h4>Related Posts</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-1">
			</div>
			<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
			<div class="col-md-3">
				<article class="news-post">
					<?php the_post_thumbnail('image-size-3', array('class' => 'post-img')) ?>
					<h1 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
					<a href="<?php the_permalink() ?>" class="read-more">Read More <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
				</article>
			</div>
			<?php endwhile; ?>


		</div>
	</div>
</section>
<?php
		}
		wp_reset_query();
	}
?>

<?php echo do_shortcode( '[templateblock id="14542"]' ); ?>

<?php get_footer() ?> 