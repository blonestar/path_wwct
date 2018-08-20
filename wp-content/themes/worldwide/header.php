<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	
	<link rel="shortcut icon" href="<?php echo get_field('favicon', 'option'); ?>" type="image/x-icon">
	<?php wp_head(); ?>
	<script> var $ = jQuery; </script>
	<?php echo get_field('tracking_codes_header_1', 'option'); ?>
</head>
<body <?php body_class() ?>>
<?php echo get_field('tracking_codes_header_2', 'option');  ?>
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
				<div class="nav-icon fa fa-bars"></div>
				<?php
					wp_nav_menu( array(
						'menu' => 'Top Menu',
						'menu_class' => 'top-nav',
						'container' => 'div',
						'container_class' => 'top-nav-zone',
					) );
				?>
				<div class="primary-nav-zone">
					<div class="nav-extras">
						<a href="<?php echo site_url('request-proposal') ?>" class="btn btn-default btn-sm">
							Request Proposal
						</a>
						<span class="search-toggle fa fa-search"></span>
						<div class="header-search">
							<span class="fa fa-times search-close"></span>
							
							<div id="p_lt_ctl03_SmartSearchBox_pnlSearch" class="searchBox" onkeypress="">
							
								<form action="<?php echo site_url('search-results') ?>">
								
									<label for="p_lt_ctl03_SmartSearchBox_txtWord" id="p_lt_ctl03_SmartSearchBox_lblSearch" style="display:none;">Search for:</label>
									<input name="s" type="text" maxlength="1000" id="p_lt_ctl03_SmartSearchBox_txtWord" class="form-control" />
									<input type="submit" value="Search" id="p_lt_ctl03_SmartSearchBox_btnSearch" class="btn btn-default" />
								</form>
								<div id="" class="predictiveSearchHolder">
								</div>
							</div>
						</div>
					</div>
					<?php
						wp_nav_menu( array(
							'menu' => 'Main Menu',
							'container' => 'nav',
							'container_class' => 'primary-nav',
							'walker' => new Walker_Worldwide_Menu()
							
						) );
						wp_nav_menu( array(
							'menu' => 'Mobile Menu',
							'container' => 'nav',
							'container_class' => 'mobile-nav',
							'items_wrap'	=> "
								<div class=\"root-nav\">
								<div class=\"scroll-wrapper\">
								<div class=\"section-title\"><a href=\"/\">Home</a></div>
								<div class=\"nav-icon fa fa-bars open\"></div>" .
								'<ul>%3$s</ul></div></div>',
							'walker' => new Walker_Worldwide_Menu_Mobile()
							
						) );
					?>
				</div>
			</div>
		</div>
	</div>
</header>
<div class="main-content">
<?php
/*
// HERO image
// todo refactor, extract to separated file
*/
$header_page_id = get_the_ID();
if (is_tax('resources_tax')) {
	$header_page_id = 'resources_tax_'.get_queried_object()->term_id;
} 
if (is_singular('in_the_news')) {
	$header_page_id = 19;  /* /about-us/in-the-news page */
}
if (is_singular('careers') || is_tax('careers_tax')) {
	$header_page_id = 3365;  /* careers page */
}
if (is_singular('resources')) {
	$trt = wp_get_post_terms(get_queried_object()->ID, 'resources_tax');
	$header_page_id = 'resources_tax_'.$trt[0]->term_id;
}
if (is_singular('team_members')) {
	$trt = wp_get_post_terms(get_queried_object()->ID, 'team_members_tax');
	$header_page_id = 'team_members_tax_'.$trt[0]->term_id;
}
if (is_home() || is_singular('post') || term_exists('post')) {
	$page = get_page_by_path( 'blog' );
	$header_page_id = $page->ID;
}
/*
if (is_404()) {
	// error options settings
	//$header_type = get_field('err_header_type', 'option');
	$header_size = get_field('err_header_size', 'option');
	$header_image = get_field('err_header_image', 'option'); 
?>
<div class="hero-image-webpart <?php echo $header_size ?> dark-image mobile-scaled">
	<div class="img-bg" style="background-image:url(<?php echo $header_image['url'] ?>); height: <?php echo $header_image['height'] ?>px"></div>
	<?php if (get_field('err_header_text', 'option')) { ?>
	<div class="container">
		<div class="hero-content">
			<?php the_field('err_header_text', 'option') ?>
		</div>
	</div>
	<?php } ?>
</div>
<?php

} else {
	$header_type = get_field('header_type', $post_id);
	$header_size = get_field('header_size', $post_id);
}
if (! is_404() && $header_type == 'image') {
	$header_image = get_field('header_image', $post_id); 
?>
<div class="hero-image-webpart <?php echo $header_size ?> dark-image mobile-scaled">
	<div class="img-bg" style="background-image:url(<?php echo $header_image['url'] ?>); height: <?php echo $header_image['height'] ?>px"></div>
	<?php if (get_field('header_text', $post_id)) { ?>
	<div class="container">
		<div class="hero-content">
			<?php the_field('header_text', $post_id) ?>
		</div>
	</div>
	<?php } ?>
</div>
<?php
} else if (@$header_type == 'image_scroll') {
	$header_image = get_field('header_image', $post_id); 
?>
<div class="hero-image-webpart <?php echo $header_size ?> dark-image mobile-scaled">
	<div class="img-bg" style="background-image:url(<?php echo $header_image['url'] ?>);"></div>
	<?php if (get_field('header_text', $post_id)) { ?>
	<div class="container">
		<div class="hero-content">
			<?php the_field('header_text', $post_id) ?>
		</div>
	</div>
	<?php } ?>
	<div class="down-arrow">
		<span class="icon-down-arrow"></span>
	</div>
</div>
<?php } else if (@$header_type == 'video') { ?>
<div class="about-video-hero">
	<div id="p_lt_ctl05_pageplaceholder_p_lt_ctl00_HeroVideoWithContent_divHero" class="hero-video-webpart">
		<div id="p_lt_ctl05_pageplaceholder_p_lt_ctl00_HeroVideoWithContent_divImg" class="img-bg"></div>
		<video src="<?php echo get_field('header_video') ?>" id="p_lt_ctl05_pageplaceholder_p_lt_ctl00_HeroVideoWithContent_videoHero" muted="" autoplay="" loop=""></video>
		<?php if (get_field('header_play_video_url')) { ?>
		<div class="container">
			<div id="p_lt_ctl05_pageplaceholder_p_lt_ctl00_HeroVideoWithContent_divContentRow" class="row hero-content">
				<div class="col-sm-8 col-sm-push-2">
					<div id="p_lt_ctl05_pageplaceholder_p_lt_ctl00_HeroVideoWithContent_divCopy">
						<p>&nbsp;</p>
						<br />
						<br />
						<br />
						<br />
						<br />
						<br />
						<br />
						<a class="btn btn-default btn-lg" data-target=".video-modal" data-title="About Worldwide Clinical Trials" data-toggle="modal" href="<?php echo get_field('header_play_video_url') ?>"><span class="fa fa-play"></span>&nbsp;Full Video</a>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>
<?php } */ ?>

<?php
//$header_page_id = get_the_ID();

//var_dump(get_field('header_type', $header_page_id));
if (get_field('header_type', $header_page_id) && get_field('header_type', $header_page_id) != 'none') {
	
	$header_background_color = '#efefef';
	if (get_field('header_type', $header_page_id) == 'color') {
		$header_background_color = (get_field('header_background_color', $header_page_id)) ? get_field('header_background_color', $header_page_id) : '#efefef';
	}
?>
<div class="hero hero-image-webpart<?php echo (get_field('header_type', $header_page_id) == 'video') ? ' hero-video-webpart' : '' ?> <?php if (get_field('header_size', $header_page_id)) { the_field('header_size', $header_page_id); } else { echo 'hero-sm'; } ?> mobile-scaled<?php echo (get_field('header_light_image', $header_page_id)) ? "" : " dark-image" ?>" style="background-color: <?php echo $header_background_color ?>">
	<?php //var_dump(get_field('header_type', $header_page_id)) ?>
	<?php if (get_field('header_type', $header_page_id) == 'image' || get_field('header_type', $header_page_id) == 'image_scroll') { ?>
	<?php $header_image = get_field('header_image', $header_page_id);
	
	//print_r($header_image);
	
	?>
	<div class="img-bg" style="background-image:url(<?php echo $header_image['url'] ?>);" data-imgurl="<?php echo $header_image['url'] ?>"></div>
	<?php } ?>
	<?php if (get_field('header_type', $header_page_id) == 'video') { ?>
	<video loop poster="<?php the_field('header_video_background_image', $header_page_id) ?>" autoplay="" muted="">

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
	</video>
	<?php } ?>

	<?php if (trim(get_field('header_text', $header_page_id)) != '' && (get_field('header_type', $header_page_id) != 'slider' && get_field('header_type', $header_page_id) != 'none' )) { ?>
	<div class="container">
		<?php
				$text_bg_color =  get_field('header_text_background_color', $header_page_id);
				$text_bg_color_rgba = hex2rgba($text_bg_color, get_field('header_text_background_opacity') / 100);
		?>
		<?php if (get_field('header_play_video_url', $header_page_id)) { ?>
        <div class="row hero-content textInMiddle<?php if (get_field('header_text_background', $header_page_id) === true) { ?> heroContentBanner" style="background-color: <?php echo $text_bg_color_rgba ?><?php } ?>">
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
        </div>
		<?php } else { ?>
        <div class="row hero-content textInMiddle<?php if (get_field('header_text_background', $header_page_id) === true) { ?> heroContentBanner" style="background-color: <?php echo $text_bg_color_rgba ?><?php } ?>">
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
        </div>
		<?php } ?>
    </div>
	<?php } ?>

	<?php if (get_field('header_type', $header_page_id) == 'slider') { ?>

		<div class="image-slider-hero"  style="height:100%;">

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

		</div>

	<?php } ?>

	
	<?php //var_dump(get_field('header_scroll_button', $header_page_id))  ?>
	<?php if (get_field('header_scroll_button', $header_page_id)) { ?>
	<div class="down-arrow">
		<?php if (trim(get_field('header_scroll_text', $header_page_id)) != '') { ?>
		<span class="scroll-text"><?php the_field('header_scroll_text', $header_page_id) ?></span>
		<?php } ?>
		<span class="icon-down-arrow"></span>
	</div>
	<?php } ?>
</div>
<?php
}
?>

<?php wp_reset_query() ?>

<?php if ( ! get_field('hide_breadcrumbs') && ! is_front_page() && ! is_404() && ! is_tax('careers_tax')) { ?>
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
<?php } ?>