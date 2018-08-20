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
		
		<link href="<?php //echo get_template_directory_uri() ?>/old-style/css/landing-a.css" rel="stylesheet" type="text/css" />
		<?php wp_head() ?>
		<link href="<?php echo get_template_directory_uri() ?>/old-style/css/landing-international.css" rel="stylesheet" type="text/css" />
		
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
	
	<body <?php body_class('landing landing-form-header with-fixed-header international') ?>>
	
	<?php //////////// echo get_field('tracking_codes_header_2', 'option'); ?>
	
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
							</object>					</a>
				</div>
			  <div class="col-xs-8 col-sm-9 nav-zones-wrapper">
<!--
				<div class="top-nav-zone">
				  
				</div>
-->
				<div class="primary-nav-zone">
				  <div class="nav-extras"><a class="btn btn-hollow btn-blue btn-sm landing-contact" href="tel:+1-610-964-2000">
						<span class="fa fa-phone"> </span>
						+1-610-964-2000
						</a>
				   </div>
				</div>
			  </div>
			</div>
		  </div>
		  
		</header>
		<div class="main-content container-fluid">

			<div class="row">
			<div class="col-md-12">

					<div id="divHero" class="hero-image-webpart " style="background-color:transparent">
						<div id="" class="img-bg" style="background-image:url(<?php the_field('landing_header_image') ?>);background-repeat:no-repeat; background-size:cover;"></div>
						<?php $mobile_image = (get_field('landing_header_image_mobile')) ? get_field('landing_header_image_mobile') : get_field('landing_header_image') ?>
						<div id="" class="img-bg mobile-img-bg" style="background-image:url(<?php echo $mobile_image ?>);background-repeat:no-repeat;"></div>
							<div class="container">
								<div id="" class="row hero-content">
									<div class="col-md-8 col-sm-6 col-xs-12">
										<div id="" class="landing-header-content" style="width:66%; margin: 10% auto 0;">
											<?php the_field('landing_header_content') ?>
										</div>
									</div>
									<div class="col-md-4 col-sm-6 col-xs-12 form-box">
										<div class="col-md-12">  
											<div id="mktoForm_<?php echo get_field('landing_marketo_id') ?>" class="marketo-form"></div>
											<script>
												MktoForms2.loadForm("//app-ab07.marketo.com", "935-DOM-994", <?php echo get_field('landing_marketo_id') ?>, function (form) {
													MktoForms2.$("#mktoForm_<?php echo get_field('landing_marketo_id') ?>").append(form.getFormElem());
													form.onSuccess(function (values, followUpUrl) {
														form.getFormElem().hide();
														window.parent.location = followUpUrl;
														return false;
													});
												});
											</script>
											<div class="marketo-form-success">
												<?php the_field('landing_marketo_on_submit_message') ?>
											</div>
										</div>
									</div>
									<div style="clear: both;"></div>
								</div>
							</div>
						</div>



			</div>
			</div>
			
		</div>
	
	
		<?php if (trim(get_the_content()) != '') { ?>
		<div class="container-wrapper light-container-wrapper content-block-2">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
					<?php the_content() ?>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
				
		
		
		<?php if( have_rows('template_blocks') ): ?>
			<?php get_template_blocks(get_the_ID()) ?>
		<?php endif; ?>


		<footer class="container-wrapper footer">
			<div class="container">
				<div class="row">
					<div class="col-md-12 noLeftOrRightPadding text-center">
					
					<ul class="lower-footer-nav">
						<li>
							<span>&copy; Worldwide Clinical Trials <?php echo date('Y'); ?></span>
						</li>
						<li>
							<a href="<?php echo site_url('privacy-statement-terms-of-use/') ?>">Privacy Statement & Terms of Use</a>
						</li>
						<li>
							<a href="<?php echo site_url('ethics-compliance/') ?>">Ethics & Compliance</a>
						</li>
						<li>
							<a href="<?php echo site_url('sitemap/') ?>">Sitemap</a>
						</li>
						
					</ul>
					
					</div>
					<div style="clear: both;"></div>
				</div>
			</div>
		</footer>
		
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
		