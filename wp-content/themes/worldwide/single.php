<?php get_header() ?>
<?php
$page = get_page_by_path( 'blog' );
$page_id = $page->ID;
$main_col_width = 12;
		
if ( is_active_sidebar( 'sidebar-blog' ) ) {
	$main_col_width = 8;
}
the_post();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
?>
<div class="container-wrapper standard-container-wrapper " style="background-color: <?php echo get_field('background_color') ?>">
	<div class="container">
		<div class="row">
			<div class="col-sm-<?php echo $main_col_width ?>">
			
				<div class="blog-post-detail">
					<div class="title"><?php the_title() ?></div>
					<div class="row">
						<?php if (get_field('author')) { ?>
						<div class="col-md-5 author">By <?php the_field('author') ?></div>
						<?php } ?>
						<?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { ?>
						<div class="col-md-7 share top">Share &nbsp;
							<?php ADDTOANY_SHARE_SAVE_KIT(); ?>
						</div>
						<?php } ?>
					</div>
				
					<div class="body">
						<?php the_content() ?>
					</div>
				
					<?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { ?>
					<div class="share bottom"><strong>Share</strong> &nbsp;
						<?php ADDTOANY_SHARE_SAVE_KIT(); ?>
					</div>
					<?php } ?>
					
					<?php 
						$tags = wp_get_post_tags($post->ID);
						//print_r($tags);
						if (!empty($tags)) {
					?>
					<div class='blog-sep'></div>
					<div class='tags'>
						<strong>Tags:</strong>&nbsp;
						<?php
							foreach($tags as $tag)
								$tags_html[] = '<a href="' . get_term_link($tag). '">' . ucwords($tag->name) . '</a>';
							echo implode($tags_html, ', ');
						?>
					</div>
					<?php } ?>
					  
					<div class="blog-sep"></div>
					<?php
						$prev_post = get_previous_post();
						$next_post = get_next_post();
					
					?>
					<div class="next-post">
						<?php if (!empty($prev_post)) { ?>
						<strong>Previous Post:</strong>
						<a href="<?php echo $prev_post->guid ?>"><?php echo $prev_post->post_title ?> ></a>
						<?php } ?>
						<br>
						<?php if (!empty($next_post)) { ?>
						<strong>Next Post:</strong>
						<a href="<?php echo $next_post->guid ?>"><?php echo $next_post->post_title ?> ></a>
						<?php } ?>
					</div>
				</div>
				
				
				
			</div>
			
			
			<?php if ( is_active_sidebar( 'sidebar-blog' ) ) { ?>
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
<?php
	//for use in the loop, list 3 post titles related to first tag on current post
	$tags = wp_get_post_tags($post->ID, array('fields'=>'ids'));
	if ($tags) {
		$args=array(
			'tag__in' => $tags,
			'post__not_in' => array($post->ID),
			'posts_per_page'=>3,
			'ignore_sticky_posts' => 1
		);
		$my_query = new WP_Query($args);
		if( $my_query->have_posts() ) {
?>
		<div class="row">
			<div class="col-sm-12">
				<div class="related-posts">
					<h4>Related Posts</h4>
					<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
					<div class="col-md-4">
						<div class="post">
							<div class='image'><a href='<?php the_permalink() ?>'>
								<?php the_post_thumbnail(array(324,182), array('class'=>'post-img')); ?>
								<div class="title"><a href='<?php the_permalink() ?>'><?php the_title() ?></a></div>
								<div class="link"><a href='<?php the_permalink() ?>'>Read More ></a></div>
							</div>
						</div>
					</div>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
<?php
		}
		wp_reset_query();
	}
?>
	</div>
</div>
	
<?php /*
<div class="container-wrapper gradient-container-wrapper back-bar click-first-link">
	<div class="container">
		<a href="<?php echo site_url('blog') ?>">Back to Blog<br />
			<span class="fa fa-angle-down"></span>
		</a>
	</div>
</div>
*/ ?>
<?php get_footer() ?> 