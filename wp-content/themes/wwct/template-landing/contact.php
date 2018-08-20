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
	
		<div class="container-wrapper blue-container-wrapper ">
			<div class="container">
				<div class="col-sm-8 col-sm-push-2">
				
				
				<h2 style="text-align: center;">Email Us – How Can We Help?</h2>
				<div class="contact-us-webpart">


		<?php

		//get_field('info_option_label');
		$select_items = get_field('contact_menu_item');
		while(have_rows('contact_menu_item')) { the_row();
			$options[] = array(sanitize_title(get_sub_field('label')), get_sub_field('label'));
		}



		?>
			<select class="contact-options">
				<option value="" disabled="disabled" selected="selected"><?php echo get_field('info_option_label') ?></option>
				<?php foreach($options as $option) { ?>
				<option value="<?php echo $option[0] ?>"><?php echo $option[1] ?></option>
				<?php } ?>
			</select>
			
			<?php
				$i = 0;
				while(have_rows('contact_menu_item')) { the_row();
			?>
			
				<?php if (get_sub_field('type') == 'text') { ?>
				
						<div class="<?php echo $options[$i][0] ?> contact-text" style="display: none">
						<?php the_sub_field('text'); ?>
						</div>
					
				<?php } else if (get_sub_field('type') == 'form') { ?>
				
						<div class="<?php if (get_sub_field('two_column_form')) echo 'two-rows-form ' ?><?php echo $options[$i][0] ?>" style="display: none">
							<div class="<?php echo $options[$i][0] ?>-form">
							  <div id="mktoForm_<?php the_sub_field('form_id') ?>" class="marketo-form"></div>
							</div>
							<script>
								MktoForms2.loadForm("//app-ab07.marketo.com", "935-DOM-994", <?php the_sub_field('form_id') ?>, function (form) {
									MktoForms2.$("#mktoForm_<?php the_sub_field('form_id') ?>").append(form.getFormElem());
										form.onSuccess(function (values, followUpUrl) {
											form.getFormElem().hide();
											window.parent.location = followUpUrl;
											return false;
										});
								});
							</script>
							<div class="marketo-form-success">
								<?php the_sub_field('form_success_text') ?>
							</div>
						</div>

				
				<?php
						
					}
				?>

			
			<?php 
					$i++;
				}
			?>

			

					</div>
					
				</div>
			</div>
		</div>
		<div style="clear: both;"></div>
	</div>
	


<div class="row">
<div class="container-wrapper white-container-wrapper ">
  <div class="container">
    <div class="row">
	
	<div class="container-wrapper white-container-wrapper ">
		<div class="container">
			<div class="col-md-push-1 col-md-10 ">
				<h2 style="text-align: center;">There&#39;s No Substitute For Expertise</h2>
<div style="text-align: center;"><br />
Worldwide Clinical Trials has extraordinary depth of medical expertise in key therapeutic areas.<br />
<br />
&nbsp;
<div class="col-md-12">
<div class="col-md-4"><a href="/about-us/global-reach"><img alt="" src="<?php echo bloginfo('url'); ?>/wp-content/uploads/2016/10/global-expertise.png" /></a>
<p><strong>Global Expertise<br />
With a Local Touch</strong></p>
</div>
<div class="col-md-4"><a href="/solutions"><img alt="" src="<?php echo bloginfo('url'); ?>/wp-content/uploads/2016/10/comprehensive-services.png" /></a>
<p><strong>Comprehensive<br />
Selection of Solutions</strong></p>
</div>
<div class="col-md-4"><a href="/therapeutic-areas"><img alt="" src="<?php echo bloginfo('url'); ?>/wp-content/uploads/2016/10/therapeutic-expertise.png" /></a>
<p><strong>Medical Expertise in<br />
Key Therapeutic Areas</strong></p>
</div>
</div>
</div>
</div>
  </div>
</div></div>
  </div>
</div>
</div>



	

	
	<div class="row">
		<h2 style="text-align: center;">Recognition &amp; Credentials</h2>
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
<?php
/*
  <div class="row"><div id="divHero" class="hero-image-webpart " style="background-color:transparent">
	
    <div id="p_lt_ctl05_pageplaceholder_p_lt_ctl00_RowLayout_Bootstrap1_RowLayout_Bootstrap1_1_HeroImageWithContent_divImg" class="img-bg" style="background-image:url(&#39;/WorldwideClinicalTrials/media/landing-page-images/wwct_Contact_02.jpg?ext=.jpg&#39;);background-repeat:no-repeat;"></div>
    <div id="p_lt_ctl05_pageplaceholder_p_lt_ctl00_RowLayout_Bootstrap1_RowLayout_Bootstrap1_1_HeroImageWithContent_divMobileImg" class="img-bg mobile-img-bg"></div>
    <div class="container">
        <div id="p_lt_ctl05_pageplaceholder_p_lt_ctl00_RowLayout_Bootstrap1_RowLayout_Bootstrap1_1_HeroImageWithContent_divContentRow" class="row hero-content textAtBottom">
            <div class="col-xs-10 col-xs-push-1">
                <div id="p_lt_ctl05_pageplaceholder_p_lt_ctl00_RowLayout_Bootstrap1_RowLayout_Bootstrap1_1_HeroImageWithContent_divCopy" class=" centerText" style="width:60%;">
                    <h1>Scientifically Minded,<br />
Medically Driven</h1>
<h1>&nbsp;</h1>
<p>&nbsp;</p>
<p>&nbsp;</p>
                </div>
            </div>
        </div>
    </div>
    
</div>
</div><div class="row"><div class="container-wrapper blue-container-wrapper ">
  <div class="container">
    <div class="col-sm-8 col-sm-push-2">
    <h2 style="text-align: center;">Email Us &ndash; How Can We Help?</h2>
<div class="contact-us-webpart">
    <select name="p$lt$ctl05$pageplaceholder$p$lt$ctl00$RowLayout_Bootstrap1$RowLayout_Bootstrap1_2$ContactUsStackedFields$ContactOptions" id="p_lt_ctl05_pageplaceholder_p_lt_ctl00_RowLayout_Bootstrap1_RowLayout_Bootstrap1_2_ContactUsStackedFields_ContactOptions" class="contact-options">
	<option value="" disabled="disabled" selected="selected">*To get started select your type of inquiry</option>
	<option value="healthy-studies-contact">Participate in a Clinical Study</option>
	<option value="sales-contact">Sales Inquiry</option>
	<option value="general-contact">General Inquiry</option>
	<option value="investigator-contact">Investigator Inquiry</option>
	<option value="career-contact">Career Inquiry</option>
	<option value="become-vendor-contact">Become a Vendor</option>
	<option value="technical-contact">Password Reset for Client Log in</option>
</select>
    
    <div class="healthy-studies-contact contact-text">
        <p>
            If you have any Healthy Study questions or comments, we’d love to hear from you.<br/>
            Please visit <a target="_blank" href="https://www.healthystudies.com/contact-us/">healthystudies.com</a>
            to get in touch.
        </p>
    </div>
    
    <div class="general-contact">
        <div id="mktoForm_1255" class="marketo-form"></div>
        <script>
            MktoForms2.loadForm("//app-ab07.marketo.com", "935-DOM-994", 1255, function (form) {
                MktoForms2.$("#mktoForm_1255").append(form.getFormElem());
                    form.onSuccess(function (values, followUpUrl) {
                        form.getFormElem().hide();
                        window.parent.location = followUpUrl;
                        return false;
                    });
            });
        </script>
        <div class="marketo-form-success">
            <p>
                Your form has been successfully submitted! Thank you for your interest
                in Worldwide Clinical Trials. We will respond to your inquiry as soon
                as possible.
            </p>
        </div>
    </div>
    
    <div class="sales-contact">
        <div id="mktoForm_1471" class="marketo-form"></div>
        <script>
            MktoForms2.loadForm("//app-ab07.marketo.com", "935-DOM-994", 1471, function (form) {
                MktoForms2.$("#mktoForm_1471").append(form.getFormElem());
                    form.onSuccess(function (values, followUpUrl) {
                        form.getFormElem().hide();
                        window.parent.location = followUpUrl;
                        return false;
                    });
            });
        </script>
        <div class="marketo-form-success">
            <p>
                Your form has been successfully submitted! Thank you for your interest
                in Worldwide Clinical Trials. We will respond to your inquiry as soon
                as possible.
            </p>
        </div>
    </div>
    
    <div class="investigator-contact contact-text">
        <h2>Interested in becoming an Investigator?</h2>
        <p>
            Please contact <a href="mailto:Investigators@worldwide.com">Investigators@worldwide.com</a>
            to get in touch. 
        </p>
    </div>
    
    <div class="career-contact contact-text">
        <p>
            Please contact <a href="mailto:stacie.alexander@worldwide.com">Stacie Alexander</a> for all
            career related inquiries. 
        </p>
    </div>
    
    <div class="become-vendor-contact contact-text">
        <h2>Interested in becoming a vendor?</h2>
        <p>
            Reach out to <a href="mailto:info@worldwide.com">info@worldwide.com</a>
            for more information. 
        </p>
    </div>
    
    <div class="technical-contact contact-text">
        <h2>Technical issues or problems<br/>Logging in to our Client Login?</h2>
        <p>
            Reach out to <a href="mailto:trial-support@worldwide.com">Clinical Trial Support</a>
            for assistance. 
        </p>
    </div>
</div>
    </div>
  </div>
</div></div>


<div class="container-wrapper white-container-wrapper ">
  <div class="container">
    <div class="row">
	
	<div class="container-wrapper white-container-wrapper ">
		<div class="container">
			<div class="col-md-push-1 col-md-10 ">
				<h2 style="text-align: center;">There&#39;s No Substitute For Expertise</h2>
<div style="text-align: center;"><br />
Worldwide Clinical Trials has extraordinary depth of medical expertise in key therapeutic areas.<br />
<br />
&nbsp;
<div class="col-md-12">
<div class="col-md-4"><a href="/about-us/global-reach"><img alt="" src="/WorldwideClinicalTrials/media/landing-page-images/global-expertise.png" /></a>
<p><strong>Global Expertise<br />
With a Local Touch</strong></p>
</div>
<div class="col-md-4"><a href="/solutions"><img alt="" src="/WorldwideClinicalTrials/media/landing-page-images/comprehensive-services.png" /></a>
<p><strong>Comprehensive<br />
Selection of Solutions</strong></p>
</div>
<div class="col-md-4"><a href="/therapeutic-areas"><img alt="" src="/WorldwideClinicalTrials/media/landing-page-images/therapeutic-expertise.png" /></a>
<p><strong>Medical Expertise in<br />
Key Therapeutic Areas</strong></p>
</div>
</div>
</div>
</div>
  </div>
</div></div>
  </div>
</div>


</div>

*/