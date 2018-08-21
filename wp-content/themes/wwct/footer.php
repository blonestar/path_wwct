
	</main>


	<footer id="footer">

        <?php do_action('footer_above'); ?>

		<div class="footer">
			<div class="container">
				<div class="row">


                    <div class="col-md-4 my-auto text-center">
						<a href="<?php echo home_url() ?>" class="foot-logo">
							<!--<img class="footer-logo" src="<?php echo get_template_directory_uri() ?>/img/worldwide-logo-footer.jpg" alt="worldwide-logo-footer" title="WORLDWIDE CLINICAL TRIALS">-->
							<object
							   type="image/svg+xml"
							   height="63"
							   width="222"
							   data="<?php echo get_template_directory_uri() ?>/img/wwct-logo-white.svg">
							</object>
						</a>
                    </div>
                    <div class="col-md-4 col-sm-6 text-center footer-nav">
						<h3><a href="<?php echo site_url('about-us/') ?>">ABOUT</a></h3>
						<h3><a href="<?php echo site_url('services/') ?>">SERVICES</a></h3>
						<h3><a href="<?php echo site_url('therapeutic-areas/') ?>">THERAPEUTIC AREAS</a></h3>
                        <h3><a href="<?php echo site_url('participate-in-a-study/') ?>">PARTICIPATE IN A STUDY</a></h3>
						<h3><a href="<?php echo site_url('subscription-center/') ?>">SUBSCRIPTION CENTER</a></h3>
						<h3><a href="<?php echo site_url('careers/') ?>">CAREERS</a></h3>
						<h3><a href="<?php echo site_url('contact-us/') ?>">CONTACT</a></h3>
                    </div>
					<div class="col-md-4 my-auto col-sm-6 text-center footer-nav">
						<div class="footer-social-wrapper">
							CONNECT WITH WORLDWIDE<br>
							<?php if (have_rows('social', 'option')) { ?>
							<ul class="social">
								<?php while(have_rows('social', 'option')) {  the_row(); ?>
								<li><a href="<?php the_sub_field('link') ?>" title="<?php the_sub_field('label') ?>" target="_blank"><?php the_sub_field('icon') ?></a></li>
								<?php } ?>
							</ul>
							<?php } ?>
						</div>
                    </div>

				</div>
			</div>
		</div>

		<div class="copyright">
			<div class="container">
				<div class="row">
					<div class="col text-center">
						<?php if (get_field('footer_bar', 'option')) { ?>
						<ul>
						<?php while(have_rows('footer_bar', 'option')) { the_row() ?>
							<li>
							<?php if (get_sub_field('link')) { ?>
								<a href="<?php the_sub_field('link') ?>"><?php the_sub_field('label') ?></a>
							<?php } else { ?>
								<?php the_sub_field('label') ?>
							<?php } ?>
							</li>
						<?php } ?>
						</ul>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>

        <?php do_action('footer_bellow'); ?>

	</footer>

	


</div>
<div off-canvas="id-1 right push" class="right-in">
<?php
						wp_nav_menu( array(
							'theme_location'	=> 'mobile-menu',
							'container'			=> 'nav',
							'container_class'	=> 'mobile-menu-wrapper'
							//'fallback_cb'   	=> 'Walker_Main_Menu::fallback',
							//'walker'			=> new Walker_Main_Menu(),
							//'item_spacing'		=> 'discard'
						) )
					?>
</div>


    <div class="modal" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true" style="display:none;">
        <div class="vertical-alignment-helper">
            <div class="modal-dialog vertical-align-center">
                <div class="modal-content">
                    <div class="modal-body" style="height: 95%;">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <div style="height: 95%;">
                            <iframe width="100%" height="100%" src=""></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true" style="display:none;">
        <div class="vertical-alignment-helper">
            <div class="modal-dialog vertical-align-center">
                <div class="modal-content">
                    <div class="modal-body" style="height: 95%;">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <div style="height: 95%;">
                           <img src="<?php echo site_url('/wp-admin/images/wpspin_light-2x.gif') ?>" class="img-responsive" data-spinner="<?php echo site_url('/wp-admin/images/wpspin_light-2x.gif') ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
	
	

<!-- Modal -->
<div class="" id="imageModal2" tabindex="-1" role="dialog1" aria-labelledby="myModalLabel" aria-hidden="true">
    <img src="" class="img-responsive">
</div>

					 

	
<?php /*
	<div id="overlay" style="display: none">
		<div class="absolute-center">
			<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
			<span class="sr-only">Please wait...</span>
		</div>
	</div>
*/ ?>

<?php 
	
	if( get_field('enable_chat_script', 'options') ){

		$pages = array(4219, 4250, 4241, 8418, 11);
		
		$pagesArr = array();
		
		foreach($pages as $value) {
			
			array_push($pagesArr, $value);
			
			$args = array(
			    'post_type'      => 'page',
			    'posts_per_page' => -1,
			    'post_parent'    => $value,
			    'order'          => 'ASC'
			 );
			
			$parent = new WP_Query( $args );
			
			if ( $parent->have_posts() ) :
			
			    while ( $parent->have_posts() ) : $parent->the_post(); 
			    
				array_push($pagesArr, get_the_id());
				
				endwhile;
			
			endif; wp_reset_query();	
		
		}
		
		if(!is_page($pagesArr)) {
			
			if(!is_single() || is_singular( 'resources' )) {
	
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
		
		} else {
			
			echo '<!--Tawk.to Disabled-->' . "\n\r";
			
		}
		
	}
?>


<?php wp_footer() ?>

<script> var $ = jQuery; </script>
<?php echo get_field('tracking_codes_header_2', 'option');  ?>

</body>
</html>