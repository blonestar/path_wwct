<?php
/*
 * Template Name: Careers
 */
get_header();
?>
<?php the_post() ?>

<?php
	
	if (get_the_content() != "") {
?>
<div class="container-wrapper standard-container-wrapper " style="background-color: <?php echo get_field('background_color') ?>">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<?php the_content() ?>
			</div>
		</div>
	</div>
</div>
<?php } ?>





<!--
<div class="hero-video-webpart hero-xl  dark-image  mobile-scaled" style="background-color: #eee">
    <div class="img-bg" style="background-image: url(http://147.75.128.123/~pthdevco/worldwide.com/wp-content/uploads/2016/11/careers_static_banner.jpg); background-repeat: no-repeat;"></div>
      <video src="http://147.75.128.123/~pthdevco/worldwide.com/wp-content/uploads/2016/11/14-careers-preview-for-web.mp4" loop="" poster="http://147.75.128.123/~pthdevco/worldwide.com/wp-content/uploads/2016/11/careers_static_banner.jpg" autoplay="" muted=""></video>
    <div class="container" style="position: relative; height: 100%">
        <div class="row  ">
            <div class="col-sm-10 col-sm-push-1 hero-content textInMiddle heroContentBanner">
                <div class="hero-container centerText " style="width: 95%;">
					<h1 style="text-align: center;">JOIN OUR ALZHEIMER'S AWARENESS MONTH WEBINAR ON CLINICAL TRIALS CHALLENGES</h1>

					 <div class="col-sm-12 ">
						<p style="text-align: center;">
							<a class="btn btn-hollow btn-lg _gt" data-action="Learn More" href="http://go.worldwide.com/November_Alzheimers_Webinar_Registration.html?campaign=7010G000000z6fd" target="_blank">RESERVE YOUR SPOT</a>
						</p>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
-->


<?php

	$current_term = get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy') );
	
	$terms_arr = get_terms( array(
		'taxonomy' => 'careers_tax',
		'hide_empty' => false,
		'posts_per_page' => -1,
		'orderby'	=> 'menu_order',
		'order'	=> 'asc',
		'exclude' => array(63)
	) );
	/* sort taxonomies by tax_order field */
	$count = count($terms_arr);	for ($i=0; $i<$count; $i++) {
		$terms_arr[$i]->sort_order = get_field('tax_order', 'careers_tax_'.$terms_arr[$i]->term_id);
	}
	usort($terms_arr, 'worldwide_sort_terms_function');		

	//print_r($terms_arr);
	
	$all_selected = is_tax() ? "" : " selected";
	
	
wp_reset_query();
?>


<?php if( have_rows('template_blocks') ): ?>
	<?php get_template_blocks(get_the_ID()) ?>
<?php endif; ?>
	<?php echo get_field('tracking_codes_footer', 'option'); ?>

	<?php
		
		//conditional tracking codes

		//tawk.io
		if(!is_page(4219) && $post->post_parent != 4219 ) {

	?>
	
	<!--Start of Tawk.to Script-->
	
	<script type="text/javascript">
	
	var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
	
	(function(){
	
	var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
	
	s1.async=true;
	
	s1.src='https://embed.tawk.to/57eebdbabb785b3a47d141ae/default';
	
	s1.charset='UTF-8';
	
	s1.setAttribute('crossorigin','*');
	
	s0.parentNode.insertBefore(s1,s0);
	
	})();
	
	</script>
	
	<!--End of Tawk.to Script-->

	<?php		
		}
		//end tawk.io

	?>
	
	<?php wp_footer() ?>