<?php get_header(); ?>
<?php

// get Page 404
$slug = '404-not-found';
$page_obj = get_page_by_path( $slug );

if (!$page_obj) { ?>
<section class="main-content">
	<div class="container">
		<div class="row">
			<div class="col">
				<p>Page with slug <strong>'/<?php echo $slug ?>'</strong> does not exists, please create it!<br>Note: Set visibility to Private.</p>
			</div>
		</div>
	</div>
</section>
<?php

} else {

?>

<section class="main-content">
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-7 col-md-8">

				<?php echo $page_obj->post_content ?>

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
			
				<a class="btn" href="<?php echo site_url('contact-us/') ?>">Contact Us</a>

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

<?php

}

?>

<?php get_footer() ?> 