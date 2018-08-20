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
						
					</div>
				
					<div class="body">
						<?php the_content() ?>
						
						<ul>
							<li>LLOQ: <strong><?php echo wp_strip_all_tags(get_field('assay_lloq')) ?></strong></li>
							<li>ULOQ: <strong><?php echo wp_strip_all_tags(get_field('assay_uloq')) ?></strong></li>
							<li>Units: <strong><?php echo wp_strip_all_tags(get_field('assay_units')) ?></strong></li>
							<li>Species: <strong><?php echo wp_strip_all_tags(get_field('assay_species')) ?></strong></li>
							<li>Matrix: <strong><?php echo wp_strip_all_tags(get_field('assay_matrix')) ?></strong></li>
						</ul>
					</div>
				
					<div class="share bottom"><strong>Share</strong> &nbsp;
						<span class='st_linkedin_custom fa fa-linkedin' displayText='LinkedIn'></span>
						<span class='st_facebook_custom fa fa-facebook' displayText='Facebook'></span>
						<span class='st_twitter_custom fa fa-twitter' displayText='Tweet'></span>
						<span class='st_googleplus_custom fa fa-google-plus' displayText='Google +'></span>
						<span class='st_email_custom fa fa-evelope' displayText='Email'></span>
					</div>
					

					  

				</div>
				
				
				

			</div>
			
			
		</div>

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