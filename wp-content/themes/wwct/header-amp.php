<!doctype html>
<html amp <?php language_attributes(); ?>>

    <head>

        <meta charset="utf-8">
        <link rel="canonical" href="<?php the_permalink() ?>">
        <script async src="https://cdn.ampproject.org/v0.js"></script>
        <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
        <script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>
        <script async custom-element="amp-fit-text" src="https://cdn.ampproject.org/v0/amp-fit-text-0.1.js"></script>
        <script async custom-element="amp-bind" src="https://cdn.ampproject.org/v0/amp-bind-0.1.js"></script>
        <script async custom-element="amp-youtube" src="https://cdn.ampproject.org/v0/amp-youtube-0.1.js"></script>
        <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet">
        <?php //wp_head(); ?>
        <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style>
        <noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
        <style amp-custom>
        <?php echo file_get_contents(get_template_directory_uri().'/css/base-amp.css'); ?>
        <?php // echo file_get_contents(get_template_directory_uri().'/css/spectre.min.css'); ?>
        <?php echo file_get_contents(get_template_directory_uri().'/css/styles-amp.css'); ?>
        </style>

    </head>

    <body <?php body_class() ?>>

        <header class="headerbar">
            <div id="header-content" class="container">
                <div class="columns">
                <div class="column">
                    <div role="button" on="tap:sidebar1.toggle" tabindex="0" class="hamburger">☰</div>
                    <a href="<?php echo site_url() ?>"><amp-img src="<?php echo get_template_directory_uri() ?>/img/worldwide-logo.png" alt="Worldwide Clinical Trials" width="269" height="74"></amp-img></a>
                </div>
                </div>
            </div>
        </header>

        <amp-sidebar id="sidebar1" layout="nodisplay" side="right">
            <div role="button" aria-label="close sidebar" on="tap:sidebar1.toggle" tabindex="0" class="close-sidebar">✕</div>
            <?php
                wp_nav_menu( array(
                'theme_location' => 'amp-menu',
                'menu_id' 		=> 'amp-menu',
                'fallback_cb'   => false,
                'item_spacing' 	=> 'discard',
                ));
            ?>
        </amp-sidebar>

        <main>
            <div id="main-content">
<?php



/*
// HERO image/slider
// todo refactor, extract to separated file
*/

$header_page_id = get_the_ID();


// get scheduled HERO for current page, if any
$header_page_id = get_scheduled_hero_by_page_id($header_page_id);



if (is_search()) {
	$header_page_id = false;
}

if (is_tax('resources_tax')) {
	$header_page_id = 'resources_tax_'.get_queried_object()->term_id;
} 

if (is_singular('in_the_news')|| is_post_type_archive('in_the_news') ) {
	$header_page_id = 19;  /* /about-us/in-the-news page */
}

if (is_singular('careers') || is_tax('careers_tax')) {
	$header_page_id = 3365;  /* careers page */
}

if (is_singular('studies')) {
	$header_page_id = 8422;  /* careers page */
}

if (is_singular('resources')) {
	$trt = wp_get_post_terms(get_queried_object()->ID, 'resources_tax');
	$header_page_id = 'resources_tax_'.$trt[0]->term_id;
}

if (is_singular('team_members')) {

	$trt = wp_get_post_terms(get_queried_object()->ID, 'team_members_tax');

	$header_page_id = 'team_members_tax_'.$trt[0]->term_id;

}

if (is_home()||is_singular('post')) {

	$header_page_id = 65;

}



do_action('header_above_hero');


if ($header_page_id && get_field('header_type', $header_page_id) && get_field('header_type', $header_page_id) != 'none') {

	$header_id = get_field('header_id', $header_page_id);
	if ($header_id)
		$header_id = 'id="' . $header_id . '" ';

	$header_class = get_field('header_class', $header_page_id);

	$header_background_color = '#efefef';

	if (get_field('header_type', $header_page_id) == 'color') {

		$header_background_color = (get_field('header_background_color', $header_page_id)) ? get_field('header_background_color', $header_page_id) : '#efefef';

	}

?>

<section <?php echo $header_id ?>class="hero hero-image-webpart<?php echo (get_field('header_type', $header_page_id) == 'video') ? ' hero-video-webpart' : '' ?> <?php if (get_field('header_size', $header_page_id)) { the_field('header_size', $header_page_id); } else { echo 'hero-sm'; } ?> mobile-scaled<?php echo (get_field('header_light_image', $header_page_id)) ? "" : " dark-image" ?><?php echo ($header_class) ? ' ' . $header_class : '' ?>" style="background-color: <?php echo $header_background_color ?>">

	<?php  // image header

	 if (get_field('header_type', $header_page_id) == 'image' || get_field('header_type', $header_page_id) == 'image_scroll') { ?>

	<?php $header_image = get_field('header_image', $header_page_id);?>

		<div class="container-fluid">

			<div class="columns">

				<div class="column col-12 hero-image-bg" style="background: url(<?php echo $header_image['url'] ?>) no-repeat center center; background-size: cover;">


	<?php } ?>


	<?php if (trim(get_field('header_text', $header_page_id)) != '' && (get_field('header_type', $header_page_id) != 'slider' && get_field('header_type', $header_page_id) != 'none' )) { ?>

	
		<?php

				$text_bg_color =  get_field('header_text_background_color', $header_page_id);

				$text_bg_color_rgba = hex2rgba($text_bg_color, get_field('header_text_background_opacity') / 100);

		?>

		<div class="hero-lines"></div>

		<div class="hero-white-border text-center text-white">			

					<div class="my-auto">

						<?php the_field('header_text', $header_page_id) ?>

						<?php if (have_rows('header_buttons', $header_page_id)) { ?>

							<?php while (have_rows('header_buttons', $header_page_id)) { the_row(); ?>

								<a class="btn" href="<?php echo get_sub_field('url', $header_page_id) ?>"><?php the_sub_field('label') ?></a>						

							<?php } ?>

						<?php } ?>						

					</div>

				</div>

			<?php if (get_field('show_hero_contact', $header_page_id)) { ?>

			<div class="hero-contact text-right text-white hidden-sm-down">

				<?php if (get_field('hero_contact', $header_page_id)) { ?>

					<?php the_field('hero_contact', $header_page_id); ?>

				<?php } ?>

				<?php if (get_field('facebook_link', $header_page_id)) { ?>

					<a href="<?php the_field('facebook_link', $header_page_id); ?>"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>

				<?php } ?>

				<?php if (get_field('instagram_link', $header_page_id)) { ?>

					<a href="<?php the_field('instagram_link', $header_page_id); ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a>

				<?php } ?>

			</div>

			<?php } ?>

    
            </div>
            </div>

        </div>

	<?php } ?>




<?php  // AMP slider hero
if (get_field('header_type', $header_page_id) == 'slider') {

?>
<div class="container-fluid">
    <amp-carousel class="hero-carousel" width="1" height="0.4" layout="responsive" type="slides" autoplay delay="2000">
    <?php
        while (have_rows('header_slides', $header_page_id)) : 
            the_row(); 
            $slide_img = get_sub_field('background_image');
    ?>
        <div class="slide">
            <amp-img src="<?php echo $slide_img ?>" layout="fill" alt="a sample image"></amp-img>
            <amp-fit-text layout="responsive" width="1" height="0.4">
                <center>
                <?php echo get_sub_field('content'); ?>
                <?php if (get_sub_field('button_title') && get_sub_field('button_link')) { ?>
                <div class="slide-buttons" style="margin-top: 20px">
                    <?php include "template-blocks/amp/part_button.php"; ?>
                </div>
                <?php } ?>
                </center>
            </amp-fit-text>
        </div>
    <?php
        endwhile;
    ?>
    </amp-carousel>

</div>

<?php 
    }

}
?>

 
        </section>
<?php /* END // HERO image/slider */ ?>


