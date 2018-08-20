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
		
		<link href="<?php //echo get_template_directory_uri() ?>/css/landing-a.css" rel="stylesheet" type="text/css" />
		<?php wp_head() ?>
		
		<?php echo get_field('tracking_codes_header_1', 'option'); ?>
		
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
	
	<body <?php body_class('landing-master') ?>>
	
	
	<?php echo get_field('tracking_codes_header_2', 'option'); ?>
	
	<?php
	
	// include cookies info banner
	get_template_part('tpl-part', 'cookies-info');

?>
	

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
<object class="my-auto" type="image/svg+xml" data="https://www.worldwide.com/wp-content/uploads/2017/06/wwct_logo.svg" width="100%" height="100%">
							</object>
			</a>
		</div>
      <div class="col-xs-8 col-sm-9 nav-zones-wrapper">
        <div class="top-nav-zone">
          
        </div>
        <div class="primary-nav-zone">
          <div class="nav-extras"><a class="btn btn-hollow btn-blue btn-sm landing-contact" href="tel:610-964-2000">
<span class="fa fa-phone"> </span>
610-964-2000
</a></div>
        </div>
      </div>
    </div>
  </div>
  
</header>


<div class="main-content container-fluid">
	<div class="row">
		<div id="divHero" class="hero-image-webpart " style="background-color:transparent">
	
			<div id="" class="img-bg" style="background-image:url(<?php the_field('landing_header_image') ?>);background-repeat:no-repeat;"></div>
			<div id="" class="img-bg mobile-img-bg"></div>
			<div class="container">
				<div id="" class="row hero-content textAtBottom">
					<div class="col-xs-10 col-xs-push-1">
						<div id="" class=" centerText" style="width:80%;">
							<?php the_field('landing_header_content') ?>

						</div>
					</div>
				</div>
			</div>
			

		</div>
	</div>

	<div class="row">
		<div class="container-wrapper light-gray-wrapper ">
			<div class="container">
				<h3 style="text-align: center;">
					Do you need ballpark pricing, a comprehensive proposal,
					<br>
					or strategic review of your protocol or clinical development plan?
				</h3>
				<p style="text-align: center;">Simply fill out the following form to submit your RFI/RFP and we'll be in touch shortly.</p>
			</div>
		</div>
	</div>

	<div class="row">
			<div class="container-wrapper white-container-wrapper ">
				<div class="container">
					<div class="col-md-7">
					
						<?php the_content() ?>

					</div>
					<div class="col-md-5">
						<?php the_field('landing_marketo_above_text') ?>
						<div id="mktoForm_<?php echo get_field('landing_marketo_id') ?>" class="marketo-form"></div>
						<script>
							MktoForms2.loadForm("//app-ab07.marketo.com", "935-DOM-994", <?php echo get_field('landing_marketo_id') ?>, function (form) {
								MktoForms2.$("#mktoForm_<?php echo get_field('landing_marketo_id') ?>").append(form.getFormElem());
								form.onSuccess(function (values, followUpUrl) {
									form.getFormElem().hide();
									// Return false to prevent the submission handler from taking the lead to the follow up url
									window.parent.location = followUpUrl;
									// Return false to prevent the submission handler from taking the lead to the follow up url
									return false;
								});
							});
						</script>
						<div class="marketo-form-success">
							<?php the_field('landing_marketo_on_submit_message') ?>
						</div>

					</div>
				</div>
			</div>
		</div>
	
	
<div class="row">
<?php get_template_blocks(2042); ?>
</div>

<div class="row"><h2 style="text-align: center;">Recognition &amp; Credentials</h2>

<div style="text-align: center;"><br />
Worldwide Clinical Trials Recognized as a Leader in Quality, Productivity, and Innovation<br />
<br />
&nbsp;
<div class="col-md-8 col-md-offset-2">
<div class="col-md-4"><img alt="" src="<?php echo get_template_directory_uri() ?>/img/cro-innovation-award.png" /></div>

<div class="col-md-4"><img alt="" src="<?php echo get_template_directory_uri() ?>/img/cro-qualtiy-award.png" /></div>

<div class="col-md-4"><img alt="" src="<?php echo get_template_directory_uri() ?>/img/cro-productivity-award.png" /></div>
</div>
</div>
</div>
</div>


					<div class="container-wrapper medium-gray-wrapper ">
						<div class="container">
							<div>
								<div class="col-md-12 noLeftOrRightPadding text-center">
									<span>&copy; Worldwide Clinical Trials <?php echo date('Y') ?></span>
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

	
	<?php wp_footer() ?>		
		
	</body>
</html>
		