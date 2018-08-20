<?php get_header(); ?>

<section class="main-content">
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-7 col-md-8">
				<h3>SEARCH RESULTS</h3>
				
				
				<div class="top-bar-search big-search">
					

					<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
						<label style="position: relative; margin: 0; padding: 0; width: 100%;">
							<button type="submit">
								<i class="fa fa-search" aria-hidden="true"></i>
							</button>
							<input id="top-search-field" type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" />
						</label>
					</form>

							
						
				</div>

			<?php if (have_posts()) { ?>
				<div class="posts-list posts-list-search">
				<?php while(have_posts()) { the_post(); ?>
					<article class="post">
						<h1><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h1>
						<?php the_excerpt() ?>
					</article>
					
				<?php } ?>
				</div>
			<?php } else { ?>

				<h2>No results found.</h2>
			
			<?php } ?>
			</div>

			<?php //if ( is_active_sidebar( 'sidebar-404' ) ) { ?>
			<div class="hidden-xs-down col-sm-5 col-md-4">
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
			<?php //} ?>
			
		</div>
	</div>
</section>

<?php get_footer() ?> 