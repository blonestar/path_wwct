<?php
/*
 * Template Name: Sitemap
 */
get_header();
the_post(); ?>

<div class="container-wrapper standard-container-wrapper">
	<div class="container">
		<?php if (get_the_content()) { ?>
		<div class="row">
			<div class="col-md-12">
				<?php the_content() ?>
			</div>
		</div>
		<?php } ?>
		<div class="row">
			<div class="col-md-12">
			
				<?php
					wp_nav_menu( array(
						'menu' => 'Sitemap',
						'container' => 'nav',
						'container_class' => 'sitemap-nav'
					) );
				?>
				
			</div>
		</div>
	</div>
</div>

<?php get_footer() ?>