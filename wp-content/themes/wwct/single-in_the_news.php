<?php get_header(); ?>
<?php the_post(); ?>

<article class="main-content in-the-news">
	<div class="container">
		<div class="row">
			<div class="offset-sm-0 col-sm-12  col-md-12 offset-md-0 col-lg-11 offset-lg-1 col-xl-11 offset-xl-1">
				<h1><?php the_title() ?></h1>
			</div>
		</div>
		<div class="row">

			<div class="col-2 col-lg-1 hidden-md-down">
				<?php get_template_part( 'template-parts/tpl-part-share-vertical' ) ?>
			</div>

			<div class="col">
				<hr class="gray-top">
				<div class="row">
					<div class="col-2">
						<?php the_date() ?>
					</div>
					<div class="col main-page-content">
						<?php the_content() ?>
					</div>
				</div>
			</div>

			<div class="col-10 offset-2 col-md-5 offset-md-0 col-lg-4 col-xl-3">
				<aside>
					<?php dynamic_sidebar( 'sidebar-news' ); ?>
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
			'post_type' => 'in_the_news',
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
			<div class="col">
				<h4>Related Posts</h4>
			</div>
		</div>
		<div class="row">
				<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
				<div class="col-md-4">
					<article class="news-post h-100">
						<div class="article-border h-100">
							<span class="post-date news-post-date"><?php the_date() ?></span>
							<h1 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
							
							<?php the_post_thumbnail('image-size-3', array('class' => 'post-img')) ?>
							<?php the_excerpt(); ?>
							<a href="<?php the_permalink() ?>" class="read-more">Read More <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
						</div>
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

<?php get_footer() ?> 