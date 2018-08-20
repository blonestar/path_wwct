<?php get_header(); ?>
<?php
//var_dump(get_query_var( 'page' ));
//var_dump(get_query_var( 'paged' ));
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; 
//$args = array('posts_per_page' => 3, 'paged' => $paged );
//query_posts($args);
?>

<section class="main-content blog-posts-list">
	<div class="container">
		<div class="row">
			<div class="col-lg-1 hidden-md-down">
				<?php get_template_part( 'template-parts/tpl-part-share-vertical' ) ?>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8">
				<?php while(have_posts()) { the_post(); ?>
					<article class="blog-post">
						<a href="<?php the_permalink() ?>" class="hover-box">
							<h2><?php the_title(); ?></h2>
							<?php the_post_thumbnail('full', array('class' => 'post-img')) ?>
							<div class="author">
								<?php if (get_field('author')) { ?> By <?php echo get_field('author') ?>, <?php } ?><span class="post-date"><?php the_date() ?></span>
							</div>
							<p><?php echo strip_tags(get_the_excerpt()) ?></p>
							<p class="read-more">Read More <i class="fa fa-angle-right" aria-hidden="true"></i></p>
						</a>
					</article>
				<?php



				?>
				<?php } // endwhile ?>
				<?php if (function_exists('custom_pagination')) { ?>
					<?php custom_pagination($wp_query->max_num_pages,"",$paged); ?>
				<?php } ?>
			</div>
			<div class="col-lg-3 col-md-4 col-sm-4">
				<aside>
					<?php dynamic_sidebar( 'sidebar-blog' ); ?>
				</aside>
			</div>
		</div>
	</div>
</section>

<?php echo do_shortcode( '[templateblock id="14542"]' ); ?>

<?php get_footer() ?> 