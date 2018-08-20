<?php get_header() ?>
<?php

$page = get_page_by_path( 'blog' );
$page_id = $page->ID;

$main_col_width = 12;
		
if ( is_active_sidebar( 'sidebar-blog' ) ) {
	$main_col_width = 8;
}
?>

<div class="container-wrapper standard-container-wrapper " style="background-color: <?php echo get_field('background_color') ?>">
	<div class="container">
		<div class="row">
			<div class="col-sm-<?php echo $main_col_width ?>">
				<?php while(have_posts()) { the_post(); ?>
				<div class="blog-post">
					<div class="title">
						<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
					</div>
					<a href="<?php the_permalink() ?>">
						<?php the_post_thumbnail('full', array('class' => 'post-img')) ?>
					</a>
					<?php $author = (get_field('author')) ? get_field('author') : get_the_author_meta( 'display_name' ); ?>
					<div class="author"> By <?php echo $author ?>, <?php the_date() ?></div>
					<div class="teaser">
						<p><?php the_excerpt() ?></p>
					</div>
					<a href="<?php the_permalink() ?>">Read More ></a>
						
				</div>
				<?php } ?>
			</div>
			
			<?php if ( is_active_sidebar( 'sidebar-blog' ) || have_rows('widgets')) { ?>
			<div class="col-sm-3 col-sm-offset-1">
				<?php dynamic_sidebar( 'sidebar-blog' ); ?>
			</div>
			<?php } ?>
			
			<?php if (have_rows('widgets', $page_id)) { ?>
			<div class="col-sm-3 col-sm-offset-1">
				<?php get_template_widgets($page_id) ?>
			</div>
			<?php } ?>
			
		</div>
	</div>
</div>


<?php get_footer() ?> 