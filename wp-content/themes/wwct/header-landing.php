<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>

	<?php if (get_field('page_language')) { ?>
	<link rel="alternate" href="<?php the_field('alternate_url') ?>" hreflang="<?php the_field('page_language') ?>" />
	<?php } ?>
	
	<link rel="shortcut icon" href="<?php echo get_field('favicon', 'option'); ?>" type="image/x-icon">
	<?php wp_head(); ?>

	<script> var $ = jQuery; </script>

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
	
	<?php echo get_field('tracking_codes_header_1', 'option'); ?>
</head>
<body <?php body_class(__FILE__) ?>>
<?php echo get_field('tracking_codes_header_2', 'option');  ?>

<?php
	// include cookies info banner
	get_template_part('tpl-part', 'cookies-info');
?>

	<header>
		<div class="container">
			<div class="row h-100">
				<div class="col-8 offset-2 text-center col-sm-5 offset-sm-0 text-sm-left col-md-4 col-lg-3 h-100">
					<h1 id="logo" class="h-100">
						<a href="<?php echo home_url() ?>" class="h-100">
						<?php if( (get_field('use_svg', 'options'))&&(get_field('svg_logo', 'options')) ){ ?>
							<object
								class="my-auto" 
							   type="image/svg+xml"
							   height="100%"
							   width="100%"
							   data="<?php echo get_field('svg_logo', 'options'); ?>">
							</object>
						<?php } else { ?>
							<img src="<?php echo get_template_directory_uri() ?>/img/worldwide-logo.png" alt="<?php echo get_bloginfo('name') ?>" title="<?php echo get_bloginfo('description') ?>">
						<?php } ?>
						</a>
					</h1>
				</div>
				<div class="col-12 text-center col-sm-7 text-sm-right col-md-8 col-lg-9">
					<?php if( get_field('phone_to_call', 'options') ){ ?>
					<div class="show-as-button call-button">
						<a class="btn text-nowrap" href="tel:+16109642000">
							<i class="fa fa-phone" aria-hidden="true"></i> +1-610-964-2000							
						</a>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</header>

	<main id="main">


