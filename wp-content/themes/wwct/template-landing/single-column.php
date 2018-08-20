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
	
	<body class="LTR Gecko Gecko49 ENUS ContentBody landing" >
	
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
										<object class="my-auto" type="image/svg+xml" data="https://www.worldwide.com/wp-content/uploads/2017/06/wwct_logo.svg" width="100%" height="100%">
							</object>
									</a>
								</div>
								<div class="col-xs-8 col-sm-9 nav-zones-wrapper">
<!--
									<div class="top-nav-zone">

									</div>
-->
									<div class="primary-nav-zone">
										<div class="nav-extras"><a href="tel:610-964-2000" class="btn btn-hollow btn-blue btn-sm landing-contact">
												<span class="fa fa-phone">&nbsp;</span>610-964-2000
											</a></div>
									</div>
								</div>
							</div>
						</div>

					</header>


					<div class="main-content">
					<div class="container-fluid">
						<div class="row">

							<div id="divHero" class="hero-image-webpart <?php the_field('landing_header_height') ?> <?php the_field('landing_header_dark') ?>" style="background-color:transparent">

								<div id="p_lt_ctl05_pageplaceholder_p_lt_ctl00_ColumnLayout_Bootstrap_ColumnLayout_Bootstrap_1_HeroImageWithContent_divImg" class="img-bg" style="background-image:url(<?php the_field('landing_header_image') ?>);background-repeat:no-repeat;"></div>
								<?php $mobile_image = (get_field('landing_header_image_mobile')) ? get_field('landing_header_image_mobile') : get_field('landing_header_image') ?>
								<div id="p_lt_ctl05_pageplaceholder_p_lt_ctl00_ColumnLayout_Bootstrap_ColumnLayout_Bootstrap_1_HeroImageWithContent_divMobileImg" class="img-bg mobile-img-bg" style="background-image:url(<?php echo $mobile_image ?>);background-repeat:no-repeat;"></div>
								<div class="container">
									<div id="" class="row hero-content textInMiddle">
										<div class="col-xs-10 col-xs-push-1">
											<div id="" class="" style="width:100%;">
												<?php the_field('landing_header_content') ?>
											</div>
										</div>
									</div>
								</div>



							</div>
						</div>


							

							<div class="row">
								<div class="container-wrapper white-container-wrapper ">
									<div class="container">
										<div class="col-md-push-1 col-md-10 ">
										
											<?php the_content() ?>

										</div>
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
		