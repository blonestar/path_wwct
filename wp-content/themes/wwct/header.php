<!DOCTYPE html>

<html <?php language_attributes(); ?> class="no-js">

<head>

<meta name="msvalidate.01" content="7E1BA8CB6624282D661800ADB50DF5FB" />

	<?php if ($_SERVER['SERVER_NAME'] == 'pthdev.com') { ?>
	<META HTTP-EQUIV='PRAGMA' CONTENT='NO-CACHE'>
	<META HTTP-EQUIV='CACHE-CONTROL' CONTENT='NO-CACHE'>
	<?php } ?>

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta charset="<?php bloginfo( 'charset' ); ?>">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php endif; ?>

	

	<link rel="shortcut icon" href="<?php echo get_field('favicon', 'option'); ?>" type="image/x-icon">

	<?php wp_head(); ?>

	<script>
		function loadAsync(src, callback, relative){
			var baseUrl = "/resources/script/";
			var script = document.createElement('script');
			if(relative === true){
				script.src = baseUrl + src;  
			}else{
				script.src = src; 
			}

			if(callback !== null){
				if (script.readyState) { // IE, incl. IE9
					script.onreadystatechange = function() {
						if (script.readyState == "loaded" || script.readyState == "complete") {
							script.onreadystatechange = null;
							callback();
						}
					};
				} else {
					script.onload = function() { // Other browsers
						callback();
					};
				}
			}
			document.getElementsByTagName('head')[0].appendChild(script);
		}
	</script>

	<?php echo get_field('tracking_codes_header_1', 'option'); ?>

	<!--[if lt IE 9]>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
	<![endif]-->

</head>

<body <?php body_class() ?>>

<?php //if ( function_exists( 'gtm4wp_the_gtm_tag' ) ) { gtm4wp_the_gtm_tag(); } ?>

<?php //echo get_field('tracking_codes_header_2', 'option');  ?>

<div canvas="container">


<?php

	// include cookies info banner
	set_query_var( 'cookies_pageID', 'option' );
	get_template_part('tpl-part', 'cookies-info');

?>


<?php do_action('header_above_top_menu'); ?>

<div class="hidden-sm-down">



<?php



$top_menu = wp_get_nav_menu_items('Top Bar');

foreach($top_menu as $top_menu_item) {

	$parent_id = $top_menu_item->menu_item_parent;

	if ($parent_id)

		$child_top_menus[] = (int)$parent_id;

}



$child_top_menus = array_unique($child_top_menus);





foreach($child_top_menus as $child_top_menu) { ?>

		<div id="top-menu-item-<?php echo $child_top_menu ?>" class="top-bar-slide" style="display:none">

			<div class="container h-100">

				<div class="row h-100">

					<div class="col-11 h-100 text-right">

						<?php

							wp_nav_menu( array(

								'theme_location' => 'top-menu',

								'menu_id' 		=> 'top-menu-id-'.$child_top_menu,

								'level'			=> 2,

								'child_of' 		=> $child_top_menu,

								'fallback_cb'   => false,

								'container'		=> 'nav',

								'item_spacing' 	=> 'discard',

								'walker'		=> new Walker_Main_Menu()

								 ));

						?>

					</div>

					<div class="col-1 my-auto text-center">

						<i class="fa fa-times fa-1x close-top-bar-slide" aria-hidden="true"></i>

					</div>

				</div>

			</div>

		</div>

<?php

}



?>



		<!-- Top navbar -->

		<nav class="navbar navbar-light bg-faded">

			<div class="container h-100">

				<div class="row h-100">


					<div class="col-12 col-md-3  my-auto text-center text-md-left">

						<div class="a2a_kit header-share-buttons">
							
							<!-- linkedin -->
							<script src="https://platform.linkedin.com/in.js" type="text/javascript" async> lang: en_US</script>
							<script type="IN/FollowCompany" data-id="229786"></script>
							
							<!-- facebook -->
							<a class="a2a_button_facebook_like" data-colorscheme='light' data-layout="button"></a>
							
							<!-- twitter -->
							<iframe class="head-tw-follow"
							src="https://platform.twitter.com/widgets/follow_button.html?screen_name=worldwidetrials&show_screen_name=false&show_count=false&size=2"
							width="80"
							height="20"
							style="border: 0; overflow: hidden;"
							scrolling="no"
							></iframe>


						</div>

					</div>

					<div class="col-12 col-md-9 my-auto text-lg-right text-md-center">

						<?php wp_nav_menu( array(

							'theme_location'	=> 'top-menu',

							'container'			=> false,

							'fallback_cb'		=> false,

							'item_spacing' 		=> 'discard',

							'walker'			=> new Walker_Main_Menu(),

						) ) ?>

					</div>

				</div>

			</div>

		</nav>

	</div>


	<?php do_action('header_below_top_menu'); ?>



	<header id="header" class="sticky-top">



		<div id="top-search" class="top-bar-slide top-bar-search">

			<div class="container h-100">

				<div class="row h-100">

					<div class="offset-md-2 col-md-8 my-auto">



						<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">

							<label style="position: relative; margin: 0; padding: 0; width: 100%;">

								<button type="submit">

									<i class="fa fa-search" aria-hidden="true"></i>

								</button>

								<input id="top-search-field" type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" />

							</label>

						</form>



					</div>

					<div class="offset-md-1 col-md-1 my-auto text-center">

						<i class="fa fa-times fa-1x close-top-bar-slide" aria-hidden="true"></i>

					</div>

				</div>

			</div>

		</div>


		
		

		<div class="container">

			<div class="row h-100">

				<div class="col-8 offset-2 text-center text-md-left col-md-3 offset-md-0 col-sm-8 h-100">



					<h1 id="logo" class="h-100">

						<a href="<?php echo home_url() ?>" class="h-100">

						<?php if( (get_field('use_svg', 'options'))&&(get_field('svg_logo', 'options')) ){ ?>

							<object

								class="logo my-auto" 

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

				

				<div class="col-2 col-sm-2 col-md-8 hidden-lg-up text-right">

					<div class="mobile-menu-button-wrapper h-100">

						<a id="mobile-menu-button" class="center-vertical" href="#"><i class="fa fa-bars fa-3" aria-hidden="true"></i></a>

					</div>

				</div>

				<div class="col-md-9 h-100 hidden-md-down text-right text-nowrap">

					<?php

						wp_nav_menu( array(

							'theme_location'	=> 'main-menu',

							'container'			=> 'nav',

							'container_class'	=> 'h-100 main-menu-wrapper',

							//'fallback_cb'   	=> 'Walker_Main_Menu::fallback',

							'walker'			=> new Walker_Main_Menu(),

							'item_spacing'		=> 'discard'

						) )

					?>

					<div class="nav-search vertical-center">

						<a class="search-btn vertical-center"><i class="fa fa-search" aria-hidden="true"></i></a>

					</div>

				</div>

				

			</div>

		</div>


		<?php //do_action('header_above_breadcrumbs'); ?>


		<?php // if ( ! get_field('hide_breadcrumbs') && ! is_front_page() && ! is_404() && ! is_tax('careers_tax')) { ?>

		<?php  if ( ! is_front_page() && ! is_404() ) { ?>

		<div class="container-wrapper standard-container-wrapper breadcrumbs">

		<div class="container" typeof="BreadcrumbList" vocab="http://schema.org/">

			<!--<span  class="CMSBreadCrumbsCurrentItem">Breadcrumbs goes here...</span>-->

			<!--<div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">-->

				<?php

					if(function_exists('bcn_display')) {

						bcn_display();

					}

				?>

			<!--</div>-->

		</div>

		</div>

		<?php  } ?>



	</header>



	<main id="main">

<?php



/*

// HERO image

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

	//$page = get_page_by_path( 'blog' );

	//$header_page_id = $page->ID;

	$header_page_id = 65;

}

//var_dump($header_page_id);

 ?>



<?php


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

		<div class="container">

			<div class="row h-100">

				<div class="col h-100" style="background: url(<?php echo $header_image['url'] ?>) no-repeat center center; background-size: cover;">



	<!--<div class="img-bg" style="background-image:url(<?php echo $header_image['url'] ?>);" data-imgurl="<?php echo $header_image['url'] ?>"></div>-->

	<?php } ?>



					<?php // video header

					 if (get_field('header_type', $header_page_id) == 'video') { ?>

					<!--<video loop poster="<?php the_field('header_video_background_image', $header_page_id) ?>" autoplay="" muted="">



						<?php if (get_field('header_video', $header_page_id)) { 

								$video_f = get_field('header_video', $header_page_id);

							?>

							<source src="<?php echo $video_f['url'] ?>" type="<?php echo $video_f['mime_type'] ?>">

						<?php } ?>

						<?php if (get_field('header_video_2', $header_page_id)) { 

								$video_f = get_field('header_video_2', $header_page_id);

							?>

							<source src="<?php echo $video_f['url'] ?>" type="<?php echo $video_f['mime_type'] ?>">

						<?php } ?>

						<?php if (get_field('header_video_3', $header_page_id)) { 

								$video_f = get_field('header_video_3', $header_page_id);

							?>

							<source src="<?php echo $video_f['url'] ?>" type="<?php echo $video_f['mime_type'] ?>">

						<?php } ?>

					</video>-->

					<?php } ?>



	<?php if (trim(get_field('header_text', $header_page_id)) != '' && (get_field('header_type', $header_page_id) != 'slider' && get_field('header_type', $header_page_id) != 'none' )) { ?>

	

		<?php

				$text_bg_color =  get_field('header_text_background_color', $header_page_id);

				$text_bg_color_rgba = hex2rgba($text_bg_color, get_field('header_text_background_opacity') / 100);

		?>

		<?php // if (get_field('header_play_video_url', $header_page_id)) { ?>

        <!--<div class="row hero-content textInMiddle<?php if (get_field('header_text_background', $header_page_id) === true) { ?> heroContentBanner" style="background-color: <?php echo $text_bg_color_rgba ?><?php } ?>">

			<div class="col-sm-8 col-sm-push-2">

				<div id="">

					<p>&nbsp;</p>

					<br>

					<br>

					<br>

					<br>

					<br>

					<br>

					<br>

					<a class="btn btn-default btn-lg" data-target=".video-modal" data-title="About Worldwide Clinical Trials" data-toggle="modal" href="<?php the_field('header_play_video_url', $header_page_id, false, false) ?>" target="_blank"><span class="fa fa-play"></span>&nbsp;Full Video</a>

				</div>

			</div>

        </div>-->

		<?php // } else { ?>

		<div class="hero-lines"></div>

		<div class="hero-white-border text-center text-white">			

					<div class="my-auto">

						<?php the_field('header_text', $header_page_id) ?>

						<?php if (have_rows('header_buttons', $header_page_id)) { ?>

							<?php while (have_rows('header_buttons', $header_page_id)) { the_row(); ?>

								<a class="btn" href="<?php echo get_sub_field('url', $header_page_id) ?>" target=""><?php the_sub_field('label') ?></a>						

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



       <!-- <div class="row hero-content textInMiddle<?php if (get_field('header_text_background', $header_page_id) === true) { ?> heroContentBanner" style="background-color: <?php echo $text_bg_color_rgba ?><?php } ?>">

            <div class="col-sm-10 col-sm-push-1">

                <div class="hero-container centerText" style="width: 95%;">

					<?php the_field('header_text', $header_page_id) ?>



					<?php if (have_rows('header_buttons', $header_page_id)) { ?>

					 <div class="col-sm-12" style="margin-top: 20px">

						<p style="text-align: center;">

							<?php while (have_rows('header_buttons', $header_page_id)) { the_row(); ?>

							<a class="btn btn-hollow btn-lg _gt" href="<?php the_sub_field('url') ?>" target=""><?php the_sub_field('label') ?></a>

							<?php } ?>

						</p>

					</div>

					<?php } ?>

               </div>

            </div>

        </div>-->

		<?php // } ?>

    

	<?php } ?>















	<?php  // image header

	 if (get_field('header_type', $header_page_id) == 'slider') { ?>



		



						<div class="slider_simple">

						<div class="image-slider-hero-wrapper"  style="height:400px">

						<div class="image-slider-hero"  style="height:400px">



							<?php while (have_rows('header_slides', $header_page_id)) : the_row(); ?>



								<?php $img = get_sub_field('background_image');

									//print_r($img);



								?>



								<div class="image-slide1" style="height:100%; background:url(<?php echo $img ?>) no-repeat center center; background-size: cover;" data-imgurl="<?php echo $img ?>">

									<div class="hero-lines"></div>

									<div class="hero-white-border text-center text-white">



										<div class="vertical-center1">

											<?php echo get_sub_field('content'); ?>

											<?php if (get_sub_field('button_title') && get_sub_field('button_link')) { ?>

											<div class="slide-buttons" style="margin-top: 20px">

													<?php include "template-blocks/part_button.php"; ?>

											</div>

											<?php } ?>

										</div>

									</div>

										

								</div>



							<?php endwhile; ?>



						</div>	

							<span class="prev-slide"></span>



							<span class="next-slide"></span>



						</div>	

						</div>	

					

			



    

	<?php } ?>















	<?php if (get_field('header_type', $header_page_id) == 'slider1111') { ?>



		<!--<div class="image-slider-hero"  style="height:100%;">



			<?php while (have_rows('slides', $header_page_id)) : the_row(); ?>



				<?php $img = get_sub_field('background_image');

					//print_r($img);



				 ?>



				<div class="image-slide" style="height:100%; background:url(<?php echo $img ?>) no-repeat center center; background-size: cover;" data-imgurl="<?php echo $img ?>">

					

						<div class="vertical-center">

							<?php echo get_sub_field('content'); ?>

							<?php if (have_rows('buttons')) { ?>

							<div class="slide-buttons" style="margin-top: 20px">

								<br>

								<p style="text-align: center;">

									<?php while (have_rows('buttons')) { the_row(); ?>

									<a class="btn btn-hollow btn-lg _gt" href="<?php the_sub_field('url') ?>" target=""><?php the_sub_field('label') ?></a>

									<?php } ?>

								</p>

							</div>

							<?php } ?>

						</div>

						

				</div>



			<?php endwhile; ?>



			<span class="prev-slide"></span>



			<span class="next-slide"></span>



		</div>-->



	<?php } ?>



	

	<?php //var_dump(get_field('header_scroll_button', $header_page_id))  ?>

	<?php if (get_field('header_scroll_button', $header_page_id)) { ?>

	<!--<div class="down-arrow">

		<?php if (trim(get_field('header_scroll_text', $header_page_id)) != '') { ?>

		<span class="scroll-text"><?php the_field('header_scroll_text', $header_page_id) ?></span>

		<?php } ?>

		<span class="icon-down-arrow"></span>

	</div>-->

	<?php } ?>





</section>

<?php

}

?>



<?php wp_reset_query() ?>

<?php do_action('header_below_hero'); ?>

