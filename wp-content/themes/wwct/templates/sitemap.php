<?php
/*
 * Template Name: Sitemap
 */
get_header();
the_post(); ?>

<section class="main-content">
	<div class="container">
		<?php if (get_the_content()) { ?>
		<div class="row">
			<div class="col-md-12">
				<?php the_content() ?>
			</div>
		</div>
		<?php } ?>
		<div class="row">
			<div class="col-md-8">
			
				<?php
					wp_nav_menu( array(
						'menu' => 'Sitemap',
						'container' => 'nav',
						'container_class' => 'sitemap-nav'
					) );
				?>
				
			</div>
			<div class="col-4">
				<aside>
					<?php //dynamic_sidebar('sidebar-404') ?>

					<?php // currently hardcoded - TODO: add as dynamic sidebar or acf widget block sidebar ?>
					<div class="widget widget_subpages_tree as-accord-holder widget-subpages-tree-hollow">
    					<h2 class=""><a>Popular Pages</a></h2>
						<?php
							wp_nav_menu( array(
								'menu'				=> 'Popular Pages', 
								'container'			=> '',
							) );
						?>
					</div>
				</aside>
			</div>
		</div>
	</div>
</section>

<?php get_footer() ?>