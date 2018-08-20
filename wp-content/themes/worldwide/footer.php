		<?php

	if (get_field('hide_footer_blocks') !== true) {
		
		$main_post_ID = get_the_ID();
		$template_block_shows = false;
		$args = array( 'post_type' => 'template_blocks', 'posts_per_page' => -1 );
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();
			$template_block_show_on_page = get_field('template_block_show_on_page', get_the_ID());
			if ($template_block_show_on_page)
			foreach ($template_block_show_on_page as $template_block_show_on_page_id) {
				if ($template_block_show_on_page_id == $main_post_ID) {
					get_template_blocks($loop->ID);
					$template_block_shows = true;
				}
			}
		endwhile;


			wp_reset_query();
			if ($template_block_shows !== true) {
				get_template_blocks(get_field('footer_template_block', 'option'));
			}
	}
		?>
		
		<div class="modal fade video-modal modal-fullscreen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
					<div class="modal-body">
						<iframe class="video-iframe" allowtransparency="yes" frameborder="0" scrolling="no"></iframe>
					</div>
				</div>
			</div>
		</div>

		<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade library-signup-modal modal-fade" role="dialog" tabindex="-1">
			<div class="modal-dialog"><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				<div class="modal-content">
					<div class="modal-body">
						<div class="modal-title">Fill out the form to gain instant access.</div>
						<div class="featured-form" id="mktoForm_1254"><span style="display:none;">&nbsp;</span></div>
						<script type="text/javascript">MktoForms2.loadForm("//app-ab07.marketo.com", "935-DOM-994", 1254, function (form) {
								MktoForms2.$("#mktoForm_1254").append(form.getFormElem());
								form.onSuccess(function (values, followUpUrl) {

								  window.wwctrials.main.setCookie('libsignup', '1');

function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/; domain=<?php echo $_SERVER['HTTP_HOST'] ?>";
}

createCookie('libsignup','1');



								  form.getFormElem().hide();
								  jQuery('.feature-signup-success').show();

									var win = jQuery('.feature-signup-success').find('a').attr('href');
								  
								  if (jQuery('.library-signup-modal').data('modal') == '1') { // if video
								 

										function convertToYouTubeEmbedUrl(url) {
											var youtubeCodeRegex = /v=([^&]+)/;
											var match = youtubeCodeRegex.exec(url);
											if (match != null && match.length > 1) {
												return "https://www.youtube.com/embed/" + match[1] + "?autoplay=1&autohide=0";
											}
											return "";
										}
									

										var $modal = jQuery('.video-modal');
										var $iframe = $modal.find('.video-iframe');
										var $title = $modal.find('.modal-title');
										$modal.on('show.bs.modal', function(event) {
										   var $link = jQuery(event.relatedTarget);
											//var title = $link.data('title');
											//$title.text(title);
										   var url = convertToYouTubeEmbedUrl(win);
											$iframe.attr('src', url);
										});
										jQuery('.library-signup-modal').modal('hide');
										$modal.modal('show');
			

									  
								  } else {
									  
										window.location = win;
										//win.focus();
								  }
								  
								  return false;
								});
							});
						</script>
						<div class="feature-signup-success">
							<p>Your form has been successfully submitted! <a target="_blank">Click here to continue.</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
</div><!-- main content end -->
<footer class="footer">
  <div class="container">
    
<ul class="upper-footer-nav"><li>
  <a href="<?php echo site_url() ?>/about-us" class=""><span>About Us</span></a>
  <ul><li>
  <a href="<?php echo site_url() ?>/about-us/meet-the-team" class=""><span>Meet The Team</span></a>
  
</li><li>
  <a href="<?php echo site_url() ?>/about-us/global-reach" class=""><span>Global Reach</span></a>
  
</li><li>
  <a href="<?php echo site_url() ?>/careers" class=""><span>Careers</span></a>
  
</li><li>
  <a href="<?php echo site_url() ?>/about-us/in-the-news" class=""><span>In The News</span></a>
  
</li></ul>
</li><li>
  <a href="<?php echo site_url() ?>/therapeutic-areas" class=""><span>Therapeutic Areas</span></a>
  <ul><li>
  <a href="<?php echo site_url() ?>/therapeutic-areas/neuroscience" class=""><span>Neuroscience</span></a>
  
</li><li>
  <a href="<?php echo site_url() ?>/therapeutic-areas/cardiovascular" class=""><span>Cardiovascular</span></a>
  
</li><li>
  <a href="<?php echo site_url() ?>/therapeutic-areas/inflammation" class=""><span>Inflammation</span></a>
  
</li><li>
  <a href="<?php echo site_url() ?>/therapeutic-areas/rare-disease" class=""><span>Rare Disease</span></a>
  
</li><li>
  <a href="<?php echo site_url() ?>/therapeutic-areas/other-therapeutic-expertise" class=""><span>Other Therapeutic Expertise</span></a>
  
</li></ul>
</li><li>
  <a href="<?php echo site_url() ?>/solutions" class=""><span>Solutions</span></a>
  <ul><li>
  <a href="<?php echo site_url() ?>/solutions/bioanalytical-sciences" class=""><span>Bioanalytical Sciences</span></a>
  
</li><li>
  <a href="<?php echo site_url() ?>/solutions/phase-i-iia-clinical-trials" class=""><span>Phase I-IIA Clinical Trials</span></a>
  
</li><li>
  <a href="<?php echo site_url() ?>/solutions/phase-iib-iiib-clinical-trials" class=""><span>Phase IIB-IIIB Clinical Trials</span></a>
  
</li><li>
  <a href="<?php echo site_url() ?>/solutions/phase-iv-clinical-trials" class=""><span>Phase IV Clinical Trials</span></a>
  
</li><li>
  <a href="<?php echo site_url() ?>/solutions/rater-services" class=""><span>Rater Services</span></a>
  
</li><li>
  <a href="<?php echo site_url() ?>/solutions/technology" class=""><span>Technology</span></a>
  
</li></ul>
</li><li>
  <a href="<?php echo site_url() ?>/resources/resource-library/" class=""><span>Resources</span></a>
  <ul><li>
  <a href="<?php echo site_url() ?>/resources/resource-library" class=""><span>Resource Library</span></a>
  
</li><li>
  <a href="<?php echo site_url() ?>/resources/assay-methods-search" class=""><span>Assay Methods Search</span></a>
  
</li></ul>
</li><li>
  <a href="javascript:void(0);" class="hidden"><span>Connect</span></a>
  <ul><li>
  <a href="https://www.facebook.com/worldwideclinicaltrials" class="fa fa-facebook" title="Facebook"><span>Facebook</span></a>
  
</li><li>
  <a href="https://twitter.com/worldwidetrials" class="fa fa-twitter" title="Twitter"><span>Twitter</span></a>
  
</li><li>
  <a href="https://www.linkedin.com/company/worldwide-clinical-trials-inc-?trk=top_nav_home" class="fa fa-linkedin" title="LinkedIn"><span>LinkedIn</span></a>
  
</li><li>
  <a href="https://www.instagram.com/worldwidetrials/" class="fa fa-instagram" title="Instagram"><span>Instagram</span></a>
  
</li></ul>
</li></ul>
			<ul class="lower-footer-nav">
				<li>
					<span>&copy; Worldwide Clinical Trials 2017</span>
				</li>
				<li>
					<a href="<?php echo site_url('privacy-statement-terms-of-use') ?>" >Privacy Statement & Terms of Use</a>
				</li><li>
					<a href="<?php echo site_url('ethics-compliance') ?>" >Ethics & Compliance</a>
				</li><li>
					<a href="<?php echo site_url('sitemap') ?>">Sitemap</a>
				</li>
			</ul>
		</div>
	</footer>
	
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
	
	<script type="text/javascript">var BASE = "<?php echo home_url() ?>";</script>

</body>
</html>