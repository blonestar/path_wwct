<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">

<?php if (get_field('page_language')) { ?>
		<link rel="alternate" href="<?php the_field('alternate_url') ?>" hreflang="<?php the_field('page_language') ?>" />
<?php } ?>
		
		<link rel="shortcut icon" href="<?php echo get_field('favicon', 'option'); ?>" type="image/x-icon">
		
		<?php wp_head() ?>
		
		<?php echo get_field('tracking_codes_header_1', 'option'); ?>

		<link href="<?php echo get_template_directory_uri() ?>/css/landing-a.css" rel="stylesheet" type="text/css" />
		
		<?php if (get_field('landing_custom_css')) { ?>
		<style>
		<?php the_field('landing_custom_css') ?>
		</style>
		<?php } ?>		
		
		<?php if (get_field('landing_header_scripts')) { ?>
		<script>
		<?php the_field('landing_header_scripts') ?>
		</script>
		<?php } ?>
		
	</head>
	
	<?php the_post() ?>
	
	<body <?php body_class() ?>>
	
	<?php echo get_field('tracking_codes_header_2', 'option'); ?>
	
	
	
	

<header class="header">
  <div class="container">
    <div class="row">
      <div class="col-xs-4 col-sm-3 logo-zone-wrapper">
			<a href="<?php echo home_url() ?>" class="logo">
				<?php

					$args = array(
					   'post_type' => 'attachment',
					   'numberposts' => 1,
					   'post_status' => null,
					   'include' => get_field('logo', 'option'),
					   'orderby' => 'menu_order',
					   'order' => 'ASC',
					  );

					$logo_attachment = get_posts( $args );
				?>
				<?php //echo wp_get_attachment_image($logo_attachment[0]->ID, array('', ''), false, array('title' => apply_filters('the_title', $logo_attachment[0]->post_title) )) ?>
				<?php echo wp_get_attachment_image($logo_attachment[0]->ID, array('', ''), false, array('title' => apply_filters('the_title', $logo_attachment[0]->post_title) )) ?>
			</a>
		</div>
      <div class="col-xs-8 col-sm-9 nav-zones-wrapper">
        <div class="top-nav-zone">
          
        </div>
        <div class="primary-nav-zone">
          <div class="nav-extras"></div>
        </div>
      </div>
    </div>
  </div>
  
</header>


					<div class="main-content  container-fluid">
						<div class="row"></div>
						<div class="row"></div>
						<div class="row">
							<div class="container-fluid" style=" background: url(<?php the_field('landing_header_image') ?>) no-repeat center top">
								<div class="container content">
									<div>
										<div class="col-md-6 ">
											<h2><span>Are You A Pharmaceutical Sponsor</span><br />
											Looking For An Expert CRO?</h2>
											<a class="btn1" href="<?php echo site_url() ?>">Go To Worldwide.com</a>
										</div>
										<div class="col-md-6 ">
											<h2><span>Are You Interested In Participating</span><br />
											In A Clinical Trial?</h2>
											<a class="btn1" href="https://www.healthystudies.com">Go To HealthyStudies.com</a>
										</div>
										<div style="clear: both;"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
	
	
	
	

					<div class="container-wrapper medium-gray-wrapper ">
						<div class="container">
							<div>
								<div class="col-md-6 noLeftOrRightPadding">
									<span>&copy; Worldwide Clinical Trials <?php echo date('Y') ?></span>
								</div>
								<div class="col-md-6 noLeftOrRightPadding">
									<?php the_field('landing_footer') ?>
								</div>
								<div style="clear: both;"></div>
							</div>
						</div>
					</div>
					

	<?php if (get_field('landing_footer_scripts')) { ?>
	<script>
		<?php the_field('landing_footer_scripts') ?>
	</script>
	<?php } ?>
	
	<?php echo get_field('tracking_codes_footer', 'option'); ?>

	<?php
		
		//conditional tracking codes

		//tawk.io
		
		/*
		if(!is_page(array(2032,4219)) && $post->post_parent != 4219 ) {

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
		*/

	?>
	
	<?php wp_footer() ?>
		
	</body>
</html>
		