<?php

/*
 * --------------- theme setup ------------------
 */
function worldwide_setup() {
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 600, 9999 );
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(
		array(
			'main-menu' 	=> __( 'Main Menu' ),
			'top-menu' 		=> __( 'Top Menu' ),
			'mobile-menu' 	=> __( 'Mobile Menu' )
		)
	);
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		//'search-form',
		//'comment-form',
		//'comment-list',
		'gallery',
		'caption',
	) );
	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );
	 */
	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );


	add_image_size( 'image-size-2', 570, 370, true ); // 2 in a row
	add_image_size( 'image-size-3', 370, 245, true ); // 3 in a row
	add_image_size( 'image-size-4', 270, 189, true ); // 4 in a row
	add_image_size( 'image-size-6', 170, 122, true ); // 6 in a row
	//add_image_size( 'image-size-3-b', 370, '', true ); // 3 in a row
}
add_action( 'after_setup_theme', 'worldwide_setup' );

/*
 * Includes
 */
include_once "widgets/widgets.php";
include_once "inc/blog-search-widget.php";
include_once 'inc/acf.inc.php';
include_once 'inc/post_types.inc.php';
include_once 'inc/menu_walker.inc.php';
include_once 'inc/page_walker.inc.php';
include_once 'inc/share-study.inc.php';
include_once 'inc/sidebar.inc.php';



/*
 * Removing menus for NON @pathinteractive Admins
 */
add_action( 'admin_init', 'my_remove_menu_pages' );
function my_remove_menu_pages() {

	$current_user = wp_get_current_user();
	$email_splitted = explode("@", $current_user->user_email);


	if ( $email_splitted[1] != 'pathinteractive.com') {
		remove_menu_page('plugins.php'); // Plugins
		remove_menu_page('tools.php'); // Tools
		remove_menu_page('options-general.php'); // Settings
		
		global $submenu;

        // Appearance Menu
        unset($submenu['themes.php'][5]); // Themes submenu
        unset($submenu['themes.php'][6]); // Customize submenu
	}
}




function add_query_vars_filter( $vars ){
  $vars[] = "ordby";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );



/**
 * enqueue scripts and styles.
 */
function worldwide_theme_name_scripts() {
	
	if (get_post_type() == 'landing' && get_field('load_styles_2017')) {

		// Load 2017 Landing styles and scripts
		wp_enqueue_style( 'font-monserrat', 'https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,500');
//		wp_enqueue_style( 'font-awesome', 'https://opensource.keycdn.com/fontawesome/4.7.0/font-awesome.min.css');
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/inc/font-awesome-4.7.0/css/font-awesome.min.css');

		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/inc/bootstrap-4.0.0-alpha.6-dist/css/bootstrap.min.css');
		wp_enqueue_style( 'bxslider', get_template_directory_uri() . '/inc/bxslider/jquery.bxslider.min.css');
		wp_enqueue_style( 'styles', get_template_directory_uri() . '/css/landing.css', array(), filemtime( get_stylesheet_directory() . '/css/landing.css' ));

		wp_enqueue_script( 'munchkin', '//munchkin.marketo.net/munchkin.js', array('jquery'), '', false );
		wp_enqueue_script( 'marketo', '//app-ab07.marketo.com/js/forms2/js/forms2.min.js', array('jquery','munchkin'), '', false );
		wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/js/html5shiv.min.js', array('jquery'), '', true );
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/inc/bootstrap-4.0.0-alpha.6-dist/js/bootstrap.min.js', array('jquery'), '', true );
		wp_enqueue_script( 'bxslider', get_template_directory_uri() . '/inc/bxslider/jquery.bxslider.min.js', array('jquery'), '', true );
		wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/landing-scripts.js', array('jquery'), '', true );

	} else if (get_post_type() == 'landing') {

		// OLD Landing styles and scripts
		// load specific landing page styles
//		wp_enqueue_style( 'font-awesome', 'https://opensource.keycdn.com/fontawesome/4.7.0/font-awesome.min.css');
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/inc/font-awesome-4.7.0/css/font-awesome.min.css');

		wp_enqueue_style( 'fonts', get_template_directory_uri() . '/old-style/css/fonts.min.css');
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/old-style/css/bootstrap.min.css');
		wp_enqueue_style( 'bxslider', get_template_directory_uri() . '/inc/bxslider/jquery.bxslider.min.css');
		wp_enqueue_style( 'main', get_template_directory_uri() . '/old-style/css/landing.css');

		//wp_enqueue_script( 'jquery.scrollTo', get_template_directory_uri() . '/old-style/js/jquery.scrollTo.min.js', array('jquery'), '', true );
		//wp_enqueue_script( 'iscroll', get_template_directory_uri() . '/old-style/js/iscroll.js', array('jquery'), '', true );
		//wp_enqueue_script( 'slick', get_template_directory_uri() . '/old-style/js/slick.min.js', array('jquery'), '', true );


		wp_enqueue_script( 'jquery' );
	
		wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/old-style/js/html5shiv.min.js', array('jquery'), '', true );

		
		wp_enqueue_script( 'jquery.scrollTo', get_template_directory_uri() . '/old-style/js/jquery.scrollTo.min.js', array('jquery'), '', true );
		wp_enqueue_script( 'iscroll', get_template_directory_uri() . '/old-style/js/iscroll.js', array('jquery'), '', true );
		wp_enqueue_script( 'marketo', '//app-ab07.marketo.com/js/forms2/js/forms2.min.js', array('jquery'), '', false );
	//if (get_post_type() != 'landing') {
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/old-style/js/bootstrap.min.js', array('jquery'), '', true );
		wp_enqueue_script( 'bxslider', get_template_directory_uri() . '/inc/bxslider/jquery.bxslider.min.js', array('jquery'), '', true );
		//wp_enqueue_script( 'tracking', get_template_directory_uri() . '/js/tracking.js', array('jquery'), '', true );
		wp_enqueue_script( 'wwctrials', get_template_directory_uri() . '/old-style/js/wwctrials.js', array('jquery'), '', true );
		wp_enqueue_script( 'slick', get_template_directory_uri() . '/old-style/js/slick.min.js', array('jquery'), '', true );
		wp_enqueue_script( 'custom', get_template_directory_uri() . '/old-style/js/custom.js', array('jquery'), '', true );


	} else {
			
		wp_enqueue_style( 'font-monserrat', 'https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,500');
		//wp_enqueue_style( 'font-awesome', 'https://opensource.keycdn.com/fontawesome/4.7.0/font-awesome.min.css');
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/inc/font-awesome-4.7.0/css/font-awesome.min.css');
		
		// Bootstrap JS
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/inc/bootstrap-4.0.0-alpha.6-dist/css/bootstrap.min.css');
		//wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/inc/bootstrap-4.0.0-beta.2/css/bootstrap.min.css');

		wp_enqueue_style( 'bxslider', get_template_directory_uri() . '/inc/bxslider/jquery.bxslider.min.css');
		wp_enqueue_style( 'sumoselect', get_template_directory_uri() . '/inc/sumoselect/sumoselect.min.css');
		//wp_enqueue_style( 'slicknav', get_template_directory_uri() . '/inc/slicknav/dist/slicknav.min.css');


		wp_enqueue_style( 'layout', get_template_directory_uri() . '/css/layout.css', array(), filemtime( get_stylesheet_directory() . '/css/layout.css' ));
		wp_enqueue_style( 'header', get_template_directory_uri() . '/css/header.css', array(), filemtime( get_stylesheet_directory() . '/css/header.css'));
		wp_enqueue_style( 'hero', get_template_directory_uri() . '/css/hero.css', array(), filemtime( get_stylesheet_directory() . '/css/hero.css'));
		wp_enqueue_style( 'styles', get_template_directory_uri() . '/css/styles.css', array(), filemtime( get_stylesheet_directory() . '/css/styles.css'));
		wp_enqueue_style( 'participate', get_template_directory_uri() . '/css/participate.css', array(), filemtime( get_stylesheet_directory() . '/css/participate.css'));
		wp_enqueue_style( 'main', get_template_directory_uri() . '/css/main.css', array(), filemtime( get_stylesheet_directory() . '/css/main.css'));
		wp_enqueue_style( 'blocks', get_template_directory_uri() . '/css/blocks.css', array(), filemtime( get_stylesheet_directory() . '/css/blocks.css'));
		wp_enqueue_style( 'blog', get_template_directory_uri() . '/css/blog.css', array(), filemtime( get_stylesheet_directory() . '/css/blog.css'));

		//wp_enqueue_style( 'gravity-forms', get_template_directory_uri() . '/css/gravity-forms.css');
		wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css');

		if(!is_admin()) {
			//wp_deregister_script('jquery');
			//wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js', array(), '', false );
		}
	
		//wp_enqueue_style( 'custom', get_template_directory_uri() . '/old-style/css/custom.css');
		
		//wp_enqueue_script( 'jquery' );
		//wp_enqueue_script( 'maskedinput', get_template_directory_uri() . '/js/jquery.maskedinput.min.js', array('jquery'), '', true );
		
//wp_enqueue_script( 'postcapture', 'https://pthdev.com/worldwide.com/wp-content/plugins/gravityforms-repeater/js/jquery.postcapture.min.js', array('jquery'), '', true );
///		wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/js/html5shiv.min.js', array('jquery'), '', true );
		//wp_enqueue_script( 'bootstrap', 'https://code.jquery.com/jquery-3.1.1.slim.min.js', array('jquery'), '', true );
		wp_enqueue_script( 'tether', 'https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js', array('jquery'), '', true );
		
		// Bootstrap JS
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/inc/bootstrap-4.0.0-alpha.6-dist/js/bootstrap.min.js', array('jquery'), '', true );
		//wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/inc/bootstrap-4.0.0-beta.2/js/bootstrap.min.js', array('jquery'), '', true );
	
		wp_enqueue_script( 'bxslider', get_template_directory_uri() . '/inc/bxslider/jquery.bxslider.min.js', array('jquery'), '', false );
		wp_enqueue_script( 'sumoselect', get_template_directory_uri() . '/inc/sumoselect/jquery.sumoselect.min.js', array('jquery'), '', false );
		//wp_enqueue_script( 'slicknav', get_template_directory_uri() . '/inc/slicknav/dist/jquery.slicknav.min.js', array('jquery'), '', false);
		wp_enqueue_script( 'mobnav', get_template_directory_uri() . '/js/slidebars.js', array('jquery'), '', true );
		//wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery', 'bxslider', 'sumoselect', 'mobnav'), '', true );
	//	wp_enqueue_script( 'marketo', '//app-ab07.marketo.com/js/forms2/js/forms2.min.js', array('jquery'), '', false );
		wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery', 'bxslider', 'sumoselect', 'mobnav'), '', true );
		//wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '', true );

	}

	
	

	
	
	//wp_enqueue_script( 'jquery.scrollTo', get_template_directory_uri() . '/js/jquery.scrollTo.min.js', array('jquery'), '', true );
	//wp_enqueue_script( 'iscroll', get_template_directory_uri() . '/js/iscroll.js', array('jquery'), '', true );
	//wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), '', true );
	/*
	/////if (get_post_type() != 'landing') {
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true );
		//wp_enqueue_script( 'tracking', get_template_directory_uri() . '/js/tracking.js', array('jquery'), '', true );
		wp_enqueue_script( 'wwctrials', get_template_directory_uri() . '/js/wwctrials.js', array('jquery'), '', true );
		wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '', true );
	//} else {
		// load specific landing page scripts
	//}
	*/
}
add_action( 'wp_enqueue_scripts', 'worldwide_theme_name_scripts' );


/*
 * Load Admin scripts
 */
function yournamespace_enqueue_scripts( $hook ) {

  //  if( !in_array( $hook, array( 'post.php', 'post-new.php' ) ) )
  //      return;


    wp_enqueue_script( 
        'admin-scripts',                         // Handle
        get_template_directory_uri() . '/js/admin-scripts.js',  // Path to file
        array( 'jquery' )                             // Dependancies
    );
}
add_action( 'admin_enqueue_scripts', 'yournamespace_enqueue_scripts', 2000 );



//add_action( 'init', 'replace_jquery_src' );
/**
 * Modify loaded scripts
 */
function replace_jquery_src() {
    if ( ! is_admin() ) {

        // Remove the default jQuery
        wp_deregister_script( 'jquery' );

        // Register our own under 'jquery' and enqueue it
        wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js', false, '1.11.3' );
        wp_enqueue_script( 'jquery' );
    }
}

//add_filter( 'script_loader_tag', 'add_async_to_jquery', 10, 3 );
/**
 * Filter script tag output
 *
 * @param string $tag    HTML output
 * @param string $handle registered name
 * @param string $src    path to JS file
 *
 * @return string
 */
function add_async_to_jquery( $tag, $handle, $src ) {


    // Check for our registered handle and add async
    if ( 'jquery' === $handle || 'marketo' === $handle  || 'addtoany' === $handle  || 'bxslider' === $handle  || 'sumoselect' === $handle ) {
        return str_replace( ' src=', ' async src=', $tag );
    }

    // Allow all other tags to pass
    return $tag;
}



/*Function to defer or asynchronously load scripts*/
function js_async_attr($tag){

	# Do not add defer or async attribute to these scripts
	$scripts_to_exclude = array('script1.js', 'script2.js', 'script3.js');

	foreach($scripts_to_exclude as $exclude_script){
	if(true == strpos($tag, $exclude_script ) )
	return $tag; 
	}

	# Defer or async all remaining scripts not excluded above
	return str_replace( ' src', ' defer="defer" src', $tag );
}
//add_filter( 'script_loader_tag', 'js_async_attr', 10 );






/**
 * Registers an editor stylesheet for the theme.
 */
function wpdocs_theme_add_editor_styles() {
    add_editor_style( 'js/editor-style.css' );
}
add_action( 'admin_init', 'wpdocs_theme_add_editor_styles' );

// some WP_DEBUG dependent stuff
if (WP_DEBUG) { // if debugging

	// if anything is needed
	
} else { // if not
	
	// Remove WP Version From Styles	
	add_filter( 'style_loader_src', 'wct_remove_ver_css_js', 9999 );
	// Remove WP Version From Scripts
	add_filter( 'script_loader_src', 'wct_remove_ver_css_js', 9999 );

	// Function to remove version numbers
	function wct_remove_ver_css_js( $src ) {
		if ( strpos( $src, 'ver=' ) )
			$src = remove_query_arg( 'ver', $src );
		return $src;
	}

}


/*
 * Sidebars
 */
add_action( 'widgets_init', 'theme_slug_widgets_init' );
function theme_slug_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Blog Sidebar', 'worldwide' ),
        'id' => 'sidebar-blog',
        'description' => __( 'Widgets in this area will be shown on all blog posts.', 'worldwide' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name' => __( 'News Sidebar', 'worldwide' ),
        'id' => 'sidebar-news',
        'description' => __( 'Widgets in this area will be shown In The News.', 'worldwide' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name' => __( 'Resources Sidebar', 'worldwide' ),
        'id' => 'sidebar-resources',
        'description' => __( 'Widgets in this area will be displayed in Resource Articles.', 'worldwide' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name' => __( 'Events Sidebar', 'worldwide' ),
        'id' => 'sidebar-events',
        'description' => __( 'Widgets in this area will be displayed in Events section.', 'worldwide' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>',
    ) );
	/*
    register_sidebar( array(
        'name' => __( 'Search Sidebar', 'worldwide' ),
        'id' => 'sidebar-search',
        'description' => __( 'Widgets in this area will be displayed on main Search Reasults Page.', 'worldwide' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name' => __( '404 Sidebar', 'worldwide' ),
        'id' => 'sidebar-404',
        'description' => __( 'Widgets in this area will be displayed on 404 Page.', 'worldwide' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>',
    ) );
	*/
	register_sidebar( array(
        'name' => __( 'Paricipate Sidebar', 'worldwide' ),
        'id' => 'sidebar-participate',
        'description' => __( 'Widgets in this area will be displayed in Participate area.', 'worldwide' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>',
    ) );
	
    register_sidebar( array(
        'name' => __( 'Services Sidebar', 'worldwide' ),
        'id' => 'sidebar-services',
        'description' => __( 'Widgets in this area will be shown on all Service Template pages.', 'worldwide' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name' => __( 'Services Sidebar Subpages', 'worldwide' ),
        'id' => 'sidebar-services-subpages',
        'description' => __( 'Widgets in this area will be shown on all Service Template pages.', 'worldwide' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name' => __( 'Therapeutic Areas Sidebar', 'worldwide' ),
        'id' => 'sidebar-therapeutic',
        'description' => __( 'Therapeutic Areas Widgets.', 'worldwide' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name' => __( 'Therapeutic Areas Sidebar Subpages', 'worldwide' ),
        'id' => 'sidebar-therapeutic-subpages',
        'description' => __( 'Therapeutic Areas Widgets.', 'worldwide' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>',
    ) );
	/*
    register_sidebar( array(
        'name' => __( 'About Us', 'worldwide' ),
        'id' => 'sidebar-about',
        'description' => __( 'Widgets in this area will be shown on all About Us Template pages.', 'worldwide' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name' => __( 'About Us / Global Reach', 'worldwide' ),
        'id' => 'sidebar-about-global',
        'description' => __( 'Widgets in this area will be shown on all About Us / Global reach page.', 'worldwide' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>',
    ) );
	*/
}


/*
 * --------------- tweeking and utilities ------------------
 */
 
function worldwide_append_query_string($url) {
	
	$doc_type = get_field('document_type');
	if ($doc_type == 'url') {
		return get_field('document_external_url');
	}
	if ($doc_type == 'file') {
		$doc = get_field('document_attachment');
		return $doc;
	}	
	if ($doc_type == 'video') {
		return get_field('document_video_url', false, false);
	}		
	if ($doc_type == 'lead') {
		return false;
	}	
    return add_query_arg($_GET, $url);
}
add_filter('the_permalink', 'worldwide_append_query_string');



/*
function feed_dir_rewrite( $wp_rewrite ) {
    $feed_rules = array( 'search-results/(.+)' => 'index.php?s=' . $wp_rewrite->preg_index(1));
    $wp_rewrite->rules = $feed_rules + $wp_rewrite->rules;
}
add_filter( 'generate_rewrite_rules', 'feed_dir_rewrite' );
*/


add_action( 'wp_loaded', 'my_flush_rules' );
function my_flush_rules() {
    if (!$rules = get_option('rewrite_rules'))
        $rules = array();

    if (!isset($rules['getattachment/(\d+)/([^/]+)/?$'])) {
        global $wp_rewrite;
        $wp_rewrite->flush_rules();
    }
}




function get_post_read_label($post_id, $default_label = "Read More") {	
	$label = get_field('document_link_label', $post_id);
	if ($label)
		return $label;
	return $default_label;
}

function the_read_more_link($default_label = false, $post_id = false, $attributes = false) {
	echo get_read_more_link($default_label, $post_id, $attributes);
}

function get_read_more_link($default_label = false, $post_id = false, $attributes = false) {

	if (is_null($post_id))
		$post_id = get_the_ID();
	
	//$default_label = "Read More &rsaquo;"
	
	//echo $default_label;
	
	$type = get_field('document_type', $post_id);
	
	if ($type == 'file') {
		$url = get_field('document_attachment');
		$attributes['target'] = '_blank';
		if (get_field('document_gated'))
			$attributes['data-gated'] = 'true';
			
	} else if ($type == 'video') {
		$url = get_field('document_video_url', false, false);
		$yt_id = youtube_id_from_url($url);
		$url = 'https://www.youtube.com/embed/'.$yt_id.'?rel=0&amp;showinfo=0&amp;autoplay=1';
 
		
		$attributes['data-thevideo'] = $url;
		$attributes['data-toggle'] = 'modal';
		$attributes['data-target'] = '#videoModal';
		$attributes['data-title'] = get_the_title($post_id);
	} else if ($type == 'url') {
		$attributes['target'] = '_blank';
		$url = get_field('document_external_url', false, false);
		
	} else if ($type == 'lead') {
		return false; // nothing
	} else {
		// is article
		$url = get_permalink($post_id);		
	}
	
	if (!$default_label) {
		$label = get_field('document_link_label', $post_id);
		$label = ($label) ? $label . ' &rsaquo;' :  "VIEW &rsaquo;";
		
		
		// REPLACED JUN 2017
		$label = "VIEW >";

	} else {
		$label = $default_label;
	}

	$att_html = '';
	if ($attributes)
		foreach($attributes as $attr_key => $attr_value)
			$att_html .= " $attr_key='$attr_value'";

		
	return "<a href='".$url."'".$att_html.">" . $label . "</a>\n";
}
 

   /*
    * get youtube video ID from URL
    *
    * @param string $url
    * @return string Youtube video id or FALSE if none found. 
    */
    function youtube_id_from_url($url) {
            $pattern = 
                '%^# Match any youtube URL
                (?:https?://)?  # Optional scheme. Either http or https
                (?:www\.)?      # Optional www subdomain
                (?:             # Group host alternatives
                  youtu\.be/    # Either youtu.be,
                | youtube\.com  # or youtube.com
                  (?:           # Group path alternatives
                    /embed/     # Either /embed/
                  | /v/         # or /v/
                  | /watch\?v=  # or /watch\?v=
                  )             # End path alternatives.
                )               # End host alternatives.
                ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
                $%x'
                ;
            $result = preg_match($pattern, $url, $matches);
            if ($result) {
                return $matches[1];
            }
            return false;
        }


add_action('wp_ajax_nopriv_assays_ajax_search','assays_ajax_search');
add_action('wp_ajax_assays_ajax_search','assays_ajax_search');
function assays_ajax_search(){
	
	//error_reporting(E_ALL);
	$query = new WP_Query(array(
						'post_type'			=> 'assays',
						'posts_per_page'	=> -1,
						'orderby'			=> 'name',
						'order'				=> 'asc'
					));	
	while ( $query->have_posts() ) :
		$query->the_post();
		
		$title = preg_replace('/\s*,\s*/', '<br>', get_the_title());
		//update_field('assay_status', 'Validated', get_the_ID());

		$assay_analytename = get_field('assay_analytename');
		$assay_analytename = (!preg_match('/<p>/', $assay_analytename)) ? "<p>" .  preg_replace('/(\n\s*)/', '<br>', $assay_analytename) . '</p>' : $assay_analytename;

		$assay_lloq = get_field('assay_lloq');
		$assay_lloq = (!preg_match('/<p>/', $assay_lloq)) ? "<p>" .  preg_replace('/(\n\s*)/', '<br>', $assay_lloq) . '</p>' : $assay_lloq;

		$assay_uloq = get_field('assay_uloq');
		$assay_uloq = (!preg_match('/<p>/', $assay_uloq)) ? "<p>" .  preg_replace('/(\n\s*)/', '<br>', $assay_uloq) . '</p>' : $assay_uloq;

		$return[] = array(
					'name'		=> $assay_analytename,
					'lloq'		=> $assay_lloq,
					'uloq'		=> $assay_uloq,
					'units'		=> "<p>".get_field('assay_units')."</p>",
					'species'	=> "<p>".get_field('assay_species')."</p>",
					'matrix'	=> "<p>".get_field('assay_matrix')."</p>",
					'status'	=> "<p>".get_field('assay_status')."</p>",
		);
		
	endwhile;
	
	echo json_encode($return);
	exit;
}


/*
 * Excerpt stuff
 */
function wpdocs_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
    return 220;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );


function get_excerpt($length = 220){
	$excerpt = get_the_content();
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt, '<br>');
	$excerpt = substr($excerpt, 0, $length);
	$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
	/*
	$excerpt = preg_replace(" ([.*?])",'',$excerpt);
	$excerpt = substr($excerpt, 0, strripos($excerpt, " ")) */;
	$excerpt = $excerpt.'...';
	return $excerpt;
}



if ( ! function_exists( 'pietergoosen_custom_wp_trim_excerpt' ) ) : 
    function pietergoosen_custom_wp_trim_excerpt($pietergoosen_excerpt) {
    global $post;
    $raw_excerpt = $pietergoosen_excerpt;
        if ( '' == $pietergoosen_excerpt ) {
            $pietergoosen_excerpt = get_the_content('');
            $pietergoosen_excerpt = strip_shortcodes( $pietergoosen_excerpt );
            $pietergoosen_excerpt = apply_filters('the_content', $pietergoosen_excerpt);
            $pietergoosen_excerpt = str_replace(']]>', ']]&gt;', $pietergoosen_excerpt);
            //Set the excerpt word count and only break after sentence is complete.
                $excerpt_word_count = 75;
                $excerpt_length = apply_filters('excerpt_length', $excerpt_word_count); 
                $tokens = array();
                $excerptOutput = '';
                $count = 0;
                // Divide the string into tokens; HTML tags, or words, followed by any whitespace
                preg_match_all('/(<[^>]+>|[^<>\s]+)\s*/u', $pietergoosen_excerpt, $tokens);
                foreach ($tokens[0] as $token) { 
                    if ($count >= $excerpt_word_count && preg_match('/[\?\.\!]\s*$/uS', $token)) { 
                    // Limit reached, continue until  ? . or ! occur at the end
                        $excerptOutput .= trim($token);
                        break;
                    }
                    // Add words to complete sentence
                    $count++;
                    // Append what's left of the token
                    $excerptOutput .= $token;
                }
            $pietergoosen_excerpt = trim(force_balance_tags($excerptOutput));
            return $pietergoosen_excerpt;   
        }
        return apply_filters('pietergoosen_custom_wp_trim_excerpt', $pietergoosen_excerpt, $raw_excerpt);
    }
endif; 
//remove_filter('get_the_excerpt', 'wp_trim_excerpt');
//add_filter('get_the_excerpt', 'pietergoosen_custom_wp_trim_excerpt'); 

/*
 * Search page url
 * /
function isu_search_url( $query ) {
    $page_id = 1773; // This is ID of page with your structure -> http://example.com/mysearch/
    $per_page = 10;
   // $post_type = 'activity'; // I just modify a bit this querry
    // Now we must edit only query on this one page
    if ( !is_admin() && @$query->is_main_query() && @$query->queried_object->ID == $page_id  ) {
        // I like to have additional class if it is special Query like for activity as you can see
        add_filter( 'body_class', function( $classes ) {
            $classes[] = 'filter-search';
            return $classes;
        } );
        $query->set( 'pagename', '' ); // we reset this one to empty!
            $query->set( 'posts_per_page', $per_page ); // set post per page or dont ... :)
            //$query->set( 'post_type', $post_type ); // we set post type if we need (I need in this case)
            // 3 important steps (make sure to do it, and you not on archive page, 
            // or just fails if it is archive, use e.g. Query monitor plugin )
            $query->is_search = true; // We making WP think it is Search page 
            $query->is_page = false; // disable unnecessary WP condition
            $query->is_singular = false; // disable unnecessary WP condition
        }
} */



add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );
add_filter( 'gform_field_content', 'gform_form_input_autocomplete', 11, 5 ); 
function gform_form_input_autocomplete( $input, $field, $value, $lead_id, $form_id ) {
	
/*
		$input = preg_replace('/(<input) ?(([^>]*)class="([^"]*)")?/', "$1 form-control$2", $input);
		$input = preg_replace('/(<input.*?class=\'?)(.*?)(\'.*?>?)/', "$1$2 form-control$3", $input);
		$input = preg_replace('/(<textarea.*?class=\'?)(.*?)(\'.*?>?)/', "$1$2 form-control$3", $input);
*/
		$input = preg_replace('/(<select|<textarea) ?(([^>]*)class="([^"]*)")?/', '$1 $3 class="$4 form-control"', $input);
		/* $input = preg_replace('/(<select.*?class=\'?)(.*?)(\'.*?>?)/', "$1$2 form-control$3", $input); */
		$input = preg_replace('/(<li.*?class=\'?)(gchoice_.*?)(\'.*?>?)/', "$1$2 checkbox checkbox-list-vertical$3", $input);
		$input = preg_replace('/<(\/?)h2/', "<$1h3", $input);
    return $input;
}
add_filter( 'gform_pre_render', 'add_input_type_gravity_forms', 11, 5 );
function add_input_type_gravity_forms( $form ) {
	foreach ( $form['fields'] as &$field ) {
		if ($field->type == 'text' || $field->type == 'email' || $field->type == 'checkbox' || $field->type == 'select' || $field->type == 'list1' || $field->type == 'textarea') {
//       print_r($field);
	   $field->cssClass .= ' form-group';  
		}
	}
	return $form;
}
/* gravity forms */
add_filter( 'gform_form_tag', 'form_tag', 10, 2 );
function form_tag( $form_tag, $form ) {
		$form_tag = preg_replace('/(<form.*?class=\')(.*?)(\'.*?>)/', "$1$2 wwc-form$3", $form_tag);
   // $form_tag = preg_replace( "/>/", " class='wwc-form'>", $form_tag );
    return $form_tag;
}
add_filter( 'gform_submit_button', 'form_submit_button', 10, 2 );
function form_submit_button( $button, $form ) {
    return "<button class='button FormButton btn btn-primary' id='gform_submit_button_{$form['id']}'><span>Submit</span></button>";
}
/* search */
/* search query */
function SearchFilter($query) {
   // If 's' request variable is set but empty
   
   if (isset($_GET['s']) && !empty($_GET['s']) && is_paged() && $query->is_main_query()) {
       $query->is_search = false;
       $query->is_home = false;
       $query->is_posts_page = true;
   } else
   if (isset($_GET['s']) && !empty($_GET['s']) && $query->is_main_query() && $query->is_posts_page) {
        $query->query['s'] = $_GET['s'];
        $query->query_vars['s'] = $_GET['s'];   
   } else 
   if (isset($_GET['s']) && empty($_GET['s']) && $query->is_main_query()){
      $query->is_search = true;
      $query->is_home = false;
   } else
    if (isset($_GET['s']) && $query->is_main_query() && $query->is_single){
        unset( $query->query['s'] );
        unset( $query->query_vars['s'] );
   }
   return $query;
}
add_filter('pre_get_posts','SearchFilter');



function worldwide_sort_terms_function($a, $b) {

	if ($a->sort_order == $b->sort_order) {
		return 0;
	} elseif ($a->sort_order < $b->sort_order) {
		return -1;
	} else {
		return 1;
	}
}




function todo_restrict_manage_posts() {
    global $typenow;
    $args=array( 'public' => true, '_builtin' => false ); 
    $post_types = get_post_types($args);
    if ( in_array($typenow, $post_types) ) {
    $filters = get_object_taxonomies($typenow);
        foreach ($filters as $tax_slug) {
            $tax_obj = get_taxonomy($tax_slug);
            wp_dropdown_categories(array(
                'show_option_all' => __('Show All '.$tax_obj->label ),
                'taxonomy' => $tax_slug,
                'name' => $tax_obj->name,
                'orderby' => 'term_order',
                'selected' => @$_GET[$tax_obj->query_var],
                'hierarchical' => $tax_obj->hierarchical,
                'show_count' => false,
				'hide_empty' => true,
				'value_field' => 'slug',
            ));
        }
    }
}
function todo_convert_restrict($query) {
    global $pagenow;
    global $typenow;
    if ($pagenow=='edit.php') {
        $filters = get_object_taxonomies($typenow);
        foreach ($filters as $tax_slug) {
           // echo $var = &$query->query_vars[$tax_slug];
            if ( isset($var) ) {
                $term = get_term_by('slug',$var,$tax_slug);
                $var = $term->slug;
            }
        }
    }
    return $query;
}
add_action( 'restrict_manage_posts', 'todo_restrict_manage_posts' );
add_filter('parse_query','todo_convert_restrict');



/*
 * Ajax get more posts (Events)
 */
add_action( 'wp_ajax_get_more_events_posts', 'get_more_events_posts' );
add_action( 'wp_ajax_nopriv_get_more_events_posts', 'get_more_events_posts' );
function get_more_events_posts() {
	
	
	$page = @$_POST['page'] + 1;
	$s = $_POST['s'];
	$year = (isset($_POST['year'])) ? $_POST['year'] : false;
	$post_type = $_POST['post_type'];
	$posts_per_page = get_option( 'posts_per_page' );
	$orderby = isset($_POST['ordby']) ? $_POST['ordby'] : 'date';
	$order = (isset($_POST['ord']) && ($_POST['ord'] == 'asc' || $_POST['ord'] == 'desc')) ? $_POST['ord'] : 'desc';
	$eventstype_arr = $_POST['eventtypes'];
	$locations_arr = $_POST['locations'];
	
	remove_all_filters('posts_orderby');


    $query = new WP_Query(array(
							'post_status' => 'publish',        
							'post_type' => 'events',
							'posts_per_page' => $posts_per_page,
							'paged' => $page,
							's' => $s,
							'year' => $year,
							'orderby' => $orderby,
							'order' => $order,
							'tax_query' 		=> array(
													'relation' => 'OR',
													$eventstype_arr,
                                    				$locations_arr
												),
						)
					);

				$return['query'] = $query->query;
				$return['posts_per_page'] = $posts_per_page;
				$return['found_posts'] = $query->found_posts;
				$return['post_count '] = $query->post_count;
				$return['pages'] = ceil($query->found_posts / $posts_per_page);
				$return['page'] = $page;
				$return['resourcetype_arr'] = json_encode( $resourcetype_arr );
				$return['therapareas_arr'] = json_encode( $therapareas_arr );
				
				
				if ($query->have_posts()) {
					ob_start();
					while($query->have_posts()) {
						$query->the_post();


				
                        // destroy vars
						if (isset($locations_terms)) unset($locations_terms, $locations_term_arr);
						if (isset($event_type_terms)) unset($event_type_terms, $event_type_term_arr);

                        $locations_terms = get_the_terms( get_the_ID(), 'locations' );
                        $event_type_terms = get_the_terms( get_the_ID(), 'event_type_tax' );

						if ($locations_terms!==false)
						foreach($locations_terms as $locations_term)
							$locations_term_arr[] = $locations_term->name;
						
                        if ($event_type_terms!==false)
						foreach($event_type_terms as $event_type_term)
							$event_type_term_arr[] = $event_type_term->name;
				?>


				
				<div class="col-sm-6 col-md-12 col-lg-6  post-wrapper">
								<article class="event-post h-100">
									<div class="article-border h-100">
										<header style="background-image: url(<?php echo get_the_post_thumbnail_url( get_the_ID(),  'image-size-3') ?>);">

											<p class="event-date"><?php echo format_event_date(get_field('event_start_date'),get_field('event_end_date')) ?></p>

											<?php if (isset($locations_term_arr)) {
													$locations_str = implode(', ', $locations_term_arr); ?>
												<p class="event-locations"><?php echo $locations_str ?></p>
											<?php } ?>
											<h1 class="event-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
											<?php if (isset($event_type_term_arr)) {
													$event_types_str = implode(', ', $event_type_term_arr); ?>
												<p class="filter event-type"><?php echo $event_types_str ?></p>
											<?php } ?>
										</header>
										<div class="event-exerpt">
											<?php echo get_excerpt(); ?>
											<p><a href="<?php the_permalink() ?>" class="read-more">Read More <i class="fa fa-chevron-right" aria-hidden="true"></i></a></p>
										</div>
										<footer>
											<?php echo do_shortcode( '[addtoany url="'.get_permalink().'" title="'.get_the_title().'"]' ); ?>
											
										</footer>
									</div>
								</article>
							</div>
				<?php
					}
					$return['html'] = ob_get_contents();
					ob_end_clean();
				} else {
					$return['empty'] = true;
				}
	echo json_encode( $return );
	exit;
}



/*
 * Ajax get more posts (Resources)
 */
add_action( 'wp_ajax_get_more_resources_posts', 'get_more_resources_posts' );
add_action( 'wp_ajax_nopriv_get_more_resources_posts', 'get_more_resources_posts' );
function get_more_resources_posts() {
	
	
	$page = @$_POST['page'] + 1;
	$s = $_POST['s'];
	$post_type = 'resources'; //$_POST['post_type'];
	$posts_per_page = get_option( 'posts_per_page' );
	$orderby = isset($_POST['ordby']) ? $_POST['ordby'] : 'date';
	$order = (isset($_POST['ord']) && ($_POST['ord'] == 'asc' || $_POST['ord'] == 'desc')) ? $_POST['ord'] : 'desc';
	$resourcetype_arr = $_POST['resources'];
	$therapareas_arr = $_POST['therapareas'];
	
	remove_all_filters('posts_orderby');


    $query = new WP_Query(array(
							'post_status' => 'publish',        
							'post_type' => $post_type,
							'posts_per_page' => $posts_per_page,
							'paged' => $page,
							's' => $s,
							'orderby' => $orderby,
							'order' => $order,
							'tax_query' 		=> array(
													'relation' => 'OR',
													$resourcetype_arr,
													$therapareas_arr
												),
						)
					);
		
		//print_r($query);

				$return['query'] = $query->query;
				$return['posts_per_page'] = $posts_per_page;
				$return['found_posts'] = $query->found_posts;
				$return['post_count '] = $query->post_count;
				$return['pages'] = ceil($query->found_posts / $posts_per_page);
				$return['page'] = $page;
				$return['resourcetype_arr'] = json_encode( $resourcetype_arr );
				$return['therapareas_arr'] = json_encode( $therapareas_arr );
				
				
				if ($query->have_posts()) {
					ob_start();
					while($query->have_posts()) {
						$query->the_post();

						// destroy vars
						if (isset($resources_tax_terms)) unset($resources_tax_terms, $resource_types_arr);
						if (isset($therapeutic_areas_tax_terms)) unset($therapeutic_areas_tax_terms, $therap_areas_arr);
						
						$resources_tax_terms = get_the_terms( get_the_ID(), 'resources_tax' );
						$therapeutic_areas_tax_terms = get_the_terms( get_the_ID(), 'therapeutic_areas_tax' );

						//print_r($resources_tax_terms);
						if ($resources_tax_terms!==false)
						foreach($resources_tax_terms as $resources_tax_term)
							$resource_types_arr[] = $resources_tax_term->name;
						
						
						if ($therapeutic_areas_tax_terms!==false)
						foreach($therapeutic_areas_tax_terms as $therapeutic_areas_tax_term)
							$therap_areas_arr[] = $therapeutic_areas_tax_term->name;
				?>
				<div class="col-12 col-md-6 col-xl-4 post-wrapper">
					<article class="resources-post h-100">
						<div class="article-border h-100">
							<div class="article-border-in">
								<?php if (isset($resource_types_arr)) {
									$resource_types = implode(', ', $resource_types_arr); ?>
								<p class="resource-type"><?php echo $resource_types ?></p>
								<?php } ?>
								<h1 class="post-title"><?php the_read_more_link(get_the_title()) ?></h1>
								<?php if (isset($therap_areas_arr)) {
										$therap_areas = implode(', ', $therap_areas_arr); ?>
								<p class="resource-therapeutic-area"><?php echo $therap_areas ?></p>
								<?php } ?>
								<?php if (has_post_thumbnail()) { ?>
									<?php the_post_thumbnail('full', array('class' => 'post-img')) ?>
								<?php } else if (get_field('resources_default_featured_image', 'resources_tax_'.$resources_tax_terms[0]->term_id)) { ?>
									<img src="<?php echo get_field('resources_default_featured_image', 'resources_tax_'.$resources_tax_terms[0]->term_id) ?>" class="post-img">
								<?php } ?>
								<div class="excerpt"><?php the_excerpt(); ?></div>
								<div class="read_more"><?php the_read_more_link() ?></div>
							</div>
							<?php echo do_shortcode('[addtoany]'); ?>
						</div>
					</article>
				</div>
				<?php
					}
					$return['html'] = ob_get_contents();
					ob_end_clean();
				} else {
					$return['empty'] = true;
				}
	echo json_encode( $return );
	exit;
}

/*
 * Ajax get more posts (News)
 */
add_action( 'wp_ajax_get_more_news_posts', 'get_more_news_posts' );
add_action( 'wp_ajax_nopriv_get_more_news_posts', 'get_more_news_posts' );
function get_more_news_posts() {
	
	
	$page = @$_POST['page'] + 1;
	$s = $_POST['s'];
	$year = (isset($_POST['year'])) ? $_POST['year'] : false;
	$month = (isset($_POST['month'])) ? $_POST['month'] : false;
	$post_type = 'in_the_news'; //$_POST['post_type'];
	$posts_per_page = get_option( 'posts_per_page' );
	$orderby = isset($_POST['ordby']) ? $_POST['ordby'] : 'date';
	$order = (isset($_POST['ord']) && ($_POST['ord'] == 'asc' || $_POST['ord'] == 'desc')) ? $_POST['ord'] : 'desc';
	$resourcetype_arr = $_POST['resources'];
	$therapareas_arr = $_POST['therapareas'];
	//error_log( $_POST['resources'] );
	//error_log( print_r($_POST['resources'], true) );
	//error_log( print_r(json_decode($_POST['resources']), true) );

	//die(json_encode(array('test'=>'aaaaaaaa')));
	
	remove_all_filters('posts_orderby');


    $query = new WP_Query(array(
							'post_status' => 'publish',        
							'post_type' => $post_type,
							'posts_per_page' => $posts_per_page,
							'paged' => $page,
							'year' => $year,
							'monthnum' => $month,
							's' => $s,
							'orderby' => $orderby,
							'order' => $order,
							'tax_query' 		=> array(
													'relation' => 'OR',
													$resourcetype_arr,
													$therapareas_arr
												),
						)
					);
		
		//print_r($query);

				$return['query'] = $query->query;
				$return['posts_per_page'] = $posts_per_page;
				$return['found_posts'] = $query->found_posts;
				$return['post_count '] = $query->post_count;
				$return['pages'] = ceil($query->found_posts / $posts_per_page);
				$return['page'] = $page;
				$return['resourcetype_arr'] = json_encode( $resourcetype_arr );
				$return['therapareas_arr'] = json_encode( $therapareas_arr );
				
				
				if ($query->have_posts()) {
					ob_start();
					while($query->have_posts()) {
						$query->the_post();
				?>


				<?php

// destroy vars
						if (isset($resources_tax_terms)) unset($resources_tax_terms, $resource_types_arr);
						if (isset($therapeutic_areas_tax_terms)) unset($therapeutic_areas_tax_terms, $therap_areas_arr);
						
						$resources_tax_terms = get_the_terms( get_the_ID(), 'resources_tax' );
						$therapeutic_areas_tax_terms = get_the_terms( get_the_ID(), 'therapeutic_areas_tax' );

						//print_r($resources_tax_terms);
						if ($resources_tax_terms!==false)
						foreach($resources_tax_terms as $resources_tax_term)
							$resource_types_arr[] = $resources_tax_term->name;
						
						

						//print_r($therapeutic_areas_tax_terms);
						if ($therapeutic_areas_tax_terms!==false)
						foreach($therapeutic_areas_tax_terms as $therapeutic_areas_tax_term)
							$therap_areas_arr[] = $therapeutic_areas_tax_term->name;
				?>
							<div class="col-sm-6 col-md-12 col-lg-6 post-wrapper">
								<article class="news-post h-100">
									<div class="article-border h-100">
										<span class="post-date news-post-date"><?php the_date() ?></span>
										<h1 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
										
										<?php the_post_thumbnail('image-size-3', array('class' => 'post-img')) ?>
										<?php echo get_excerpt(); ?>
										<p><a href="<?php the_permalink() ?>" class="read-more">Read More <i class="fa fa-chevron-right" aria-hidden="true"></i></a></p>
										<footer>
											<?php echo do_shortcode('[addtoany]'); ?>
										</footer>
									</div>
								</article>
							</div>
				<?php
					}
					$return['html'] = ob_get_contents();
					ob_end_clean();
				} else {
					$return['empty'] = true;
				}
	echo json_encode( $return );
	exit;
}

/*
 * Ajax get more posts (StudiesNews)
 */
add_action( 'wp_ajax_get_more_studies_posts', 'get_more_studies_posts' );
add_action( 'wp_ajax_nopriv_get_more_studies_posts', 'get_more_studies_posts' );
function get_more_studies_posts() {
	
	$page = @$_POST['page'] + 1;
	$post_type = 'studies';
	$classes = (isset($_POST['classes'])) ? $_POST['classes'] : 'col-md-3 post-wrapper';
	$posts_per_page = 3;
	$orderby = isset($_POST['ordby']) ? $_POST['ordby'] : 'date';
	$order = (isset($_POST['ord']) && ($_POST['ord'] == 'asc' || $_POST['ord'] == 'desc')) ? $_POST['ord'] : 'asc';
	//remove_all_filters('posts_orderby');

    $query = new WP_Query(array(    
							'post_type' 		=> $post_type,
							'posts_per_page' 	=> $posts_per_page,
							'offset'			=> $posts_per_page,
							'paged' 			=> $page,
							'meta_key'			=> 'study_active',
							'meta_value'		=> '1',
							'orderby' 			=> $orderby,
							'order' 			=> $order,
						)
					);
		

				$return['query'] = $query->query;
				$return['posts_per_page'] = $posts_per_page;
				$return['found_posts'] = $query->found_posts;
				$return['post_count '] = $query->post_count;
				$return['pages'] = ceil($query->found_posts / $posts_per_page);
				$return['page'] = $page;
				
				
				if ($query->have_posts()) {
					ob_start();
					while($query->have_posts()) {
						$query->the_post();
					?>
					<div class="<?php echo $classes ?>">
						<?php get_template_part('tpl-part-study'); // get template part for render ?>
					</div>
					<?php
					}
					$return['html'] = ob_get_contents();
					ob_end_clean();
				} else {
					$return['empty'] = true;
				}
	echo json_encode( $return );
	exit;
}



function hex2rgba($color, $opacity = false) {
 
	$default = 'rgb(0,0,0)';
 
	//Return default if no color provided
	if(empty($color))
		  return $default; 
 
	//Sanitize $color if "#" is provided 
		if ($color[0] == '#' ) {
			$color = substr( $color, 1 );
		}
 
		//Check if color has 6 or 3 characters and get values
		if (strlen($color) == 6) {
				$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
		} elseif ( strlen( $color ) == 3 ) {
				$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
		} else {
				return $default;
		}
 
		//Convert hexadec to rgb
		$rgb =  array_map('hexdec', $hex);
 
		//Check if opacity is set(rgba or rgb)
		if($opacity){
			if(abs($opacity) > 1)
				$opacity = 1.0;
			$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
		} else {
			$output = 'rgb('.implode(",",$rgb).')';
		}
 
		//Return rgb(a) color string
		return $output;
}


/* check is content empty */
function empty_content($str) {
    return trim(str_replace('&nbsp;','',strip_tags($str))) == '';
}


/* pagination */
function custom_pagination($numpages = '', $pagerange = '', $paged='') {

  if (empty($pagerange)) {
    $pagerange = 2;
  }

  /**
   * This first part of our function is a fallback
   * for custom pagination inside a regular loop that
   * uses the global $paged and global $wp_query variables.
   * 
   * It's good because we can now override default pagination
   * in our theme, and use this function in default quries
   * and custom queries.
   */
  //global $paged;
    global $wp_query;

//print($wp_query->query_vars);
 // $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; 
  if ($paged=='') {
    $paged = 1;
  }
  if ($numpages == '') {
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }
  
  //echo "p=".$paged;
  /** 
   * We construct the pagination arguments to enter into our paginate_links
   * function. 
   */
  $pagination_args = array(
    //'base'            => get_pagenum_link(1) . '%_%',
    //'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
    'next_text'       => '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {
    echo "<nav class='pagination'>";
      echo "<span class='page-text'>Page </span> " . $paginate_links;
    echo "</nav>";
  }
  wp_reset_query();

}


/* AJAX Calls - get more posts - RESOURCES */
add_action( 'wp_ajax_nopriv_load_more_posts', 'load_more_posts' );
add_action( 'wp_ajax_load_more_posts', 'load_more_posts' );

function load_more_posts() {
	
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) { 
		
	}
	die();
}


/* 
 * Eevent format date eg '6-7 Seprember 2017'
 */
function format_event_date($start_date, $end_date = false) {

	if ($start_date)
		$start = strtotime($start_date);
	
	if ($end_date)
		$end = strtotime($end_date);

	// start_date is set only
	if ($start_date && (!$end_date || $end_date == ''))
		$date_str = date('F d, Y', $start);

	// both dates are set
	if ($start_date && $end_date) {

		// same month
		if (date('n', $start) == date('n', $end))
			$date_str = date('F d', $start) . '-' . date('d, Y', $end);

		// diff months
		if (date('n', $start) != date('n', $end))
			$date_str = date('F d', $start) . ' - ' . date('F d, Y', $end);
	}

	// return
	return $date_str;
}


/*
 * Youtube videos popup - link conversion
 */
//add_filter( 'the_content', 'filter_the_content_in_the_main_loop' );
//add_filter( 'acf_the_content', 'filter_the_content_in_the_main_loop' );
function filter_the_content_in_the_main_loop( $content ) {
    // Check if we're inside the main loop in a single post page.
    if (in_the_loop() && is_main_query() ) {
		return preg_replace('/<a.*?href="(.*?youtu.*?\/(.*?))\/?">/', '<a href="$1" data-toggle="modal" data-target="#videoModal" data-thevideo="https://www.youtube.com/embed/$2?rel=0&amp;showinfo=0&amp;autoplay=1">', $content);
    }
    return $content;
}



function get_scheduled_hero_by_page_id($page_id) {

	//$gmt_offset_sec = get_option('gmt_offset') * 60 * 60;
	//echo get_option('timezone_string');
	date_default_timezone_set(get_option('timezone_string'));
	//echo "<br>";
	//echo date('T');
	//echo "<br>";
	$today = date('Y-m-d H:i:s');
	//echo "<br>";

	$args = array( 
            'post_type'			=> 'hero', 
            'posts_per_page'	=> 1,
			
			'meta_query' => array(

				'relation'		=> 'AND',
				array(
					'key'	 	=> 'hero_page',
					'value'	  	=> $page_id,
					'compare' 	=> 'LIKE',
				),
				array(
					'relation'		=> 'OR',
					array(
						'relation'		=> 'AND',
						array(
							'key'		=> 'hero_start',
							'compare'	=> '<=',
							'value'		=> $today,
							'type'		=> 'DATETIME'
						),
						array(
							'key'		=> 'hero_end',
							'compare'	=> '>',
							'value'		=> $today,
							'type'		=> 'DATETIME'
						),
					),
					array(
						'relation'		=> 'AND',
						array(
							'key'		=> 'hero_start',
							'compare'	=> '<=',
							'value'		=> $today,
							'type'		=> 'DATETIME'
						),
						array(
							'key'		=> 'hero_end',
							'compare'	=> '=',
							'value'		=> '',
							//'type'		=> 'DATETIME'
						),
					),
				),
			),
			'meta_key'		=> 'hero_start',
			'meta_compare'	=> '<=',
			'meta_value'	=> $today,
			'meta_type'		=> 'DATETIME',
	);

	$query = new WP_Query( $args );
	if ($query->have_posts() ) {
		//echo "IMA ($page_id)";
		while($query->have_posts()) {
			$query->the_post();
			$page_id = get_the_ID();
		}

	}
	
	return $page_id;
}


/*
 * WP Image Zoom hook - custom made the_content hook
 * adding <div class="zoooom"> around <img> tag ONLY if image is wider then 730px (content column width)
 */
function image_modal_the_content_filter($content) {

	$content = preg_replace_callback('/(<img.*?src="(.*?)".*?>)/',
		function($match) {
			//print_r($match);
			//$trt = '';
			//if (isset($match[4])) {
				//&& strpos($match[3],'zoom')
			//	$trt =  "ZOOM enabled";
				//exit();
			//}
			if (isset($match[2]) && preg_match('/class=".*?zoom.*?"/', $match[0])) {
				
				//$size = getimagesize($match[2]);
				//if ($size[0] > 730) {
					return '<a href="#" class="image-popup" data-toggle="modal" data-target="#imageModal" data-imagesrc="'.$match[2].'">'.$match[0].'</a>';
				//} else {
				//	return $match[0];
				//}
			} else {
				return $match[0];
			}
		},
		$content
	);

	return $content;
}
add_filter( 'the_content', 'image_modal_the_content_filter' );


/*
 * exclude page from search results by ACF field
 */
function exclude_from_search_results_by_acf( $query ) {
    if ( !is_admin() && $query->is_main_query() && $query->is_search()) {

		// number of search results
		// TODO - add as theme option
		$query->set( 'posts_per_page' , 20 );

		$meta_query = $query->get('meta_query');
		$meta_query[] = array(
			'relation'	=> 'OR',
			array(
				'key'		=> 'remove_from_search_results', // ACF group: 'Page - Options'
				'compare'	=> 'NOT EXISTS',
				//'value'	=> '',
			),
			array(
				'key'		=> 'remove_from_search_results', // ACF group: 'Page - Options
				'compare'	=> '!=',
				'value'		=> '1'
			)
		);
		$query->set( 'meta_query', $meta_query );
	}
}
add_action( 'pre_get_posts', 'exclude_from_search_results_by_acf' );




/* Template Blocks SHORTCODE funtionality */

add_filter('manage_edit-template_blocks_columns', 'templateblock_shortcode_func_columns');
function templateblock_shortcode_func_columns($columns) {
    $columns['shortcode'] = 'Shortcode';
    return $columns;
}
add_action( 'manage_template_blocks_posts_custom_column', 'templateblock_shortcode_func_column_content', 10, 2 );
function templateblock_shortcode_func_column_content( $column_name, $post_id ) {
    if ( 'shortcode' != $column_name )
        return;
    echo '[templateblock id="'.$post_id.'"]';
}
add_shortcode( 'templateblock', 'templateblock_shortcode_func' );
function templateblock_shortcode_func( $atts ) {

	if (is_admin()) // but why is this needed?!
		return;

	$a = shortcode_atts( array(
        'id' => false
	), $atts );
	
	if ($a['id']) {
		ob_start();
		echo get_template_blocks($a['id']);
		return ob_get_clean();
	}
	
	// TODO
	// error log
	// return "ID is NOT set";
}


/* Template Blocks HIDE funtionality */

add_filter('manage_edit-template_blocks_columns', 'templateblock_visible_func_columns');
function templateblock_visible_func_columns($columns) {
    $columns['visible'] = 'Visibility';
    return $columns;
}
add_action( 'manage_template_blocks_posts_custom_column', 'templateblock_visible_func_column_content', 10, 2 );
function templateblock_visible_func_column_content( $column_name, $post_id ) {
    if ( 'visible' != $column_name )
		return;
	$visible = get_field('template_block_hide');
	if ($visible)
		echo '<span style="color:red">Disabled</span>';
	else
		echo '<span style="color:green">Enabled</span>';
}


add_action('header_above_top_menu',  'insert_template_blocks');
add_action('header_below_top_menu',  'insert_template_blocks');
//add_action('header_above_breadcrumbs',  'insert_template_blocks');
add_action('header_above_hero',  'insert_template_blocks');
add_action('header_below_hero',  'insert_template_blocks');
add_action('footer_above',  'insert_template_blocks');
add_action('footer_below',  'insert_template_blocks');
function insert_template_blocks() {
	global $post;

	echo "\n<!-- FILTER: " . current_filter() . " -->\n";
	//echo current_filter();
	
	//$current_page_ID = $post->ID;
	if (isset($post->ID))
		$current_page_ID = $post->ID;
	else if (is_404())
		$current_page_ID = 9194;
	else
		return;
	
	//echo get_the_ID();
	//echo "<br>curr page id: " . $current_page_ID . "<br>";
	
	//print_r(get_field('template_block_exclude_pages',$post->ID));
	

	$args = array( 
		'post_type'			=> 'template_blocks', 
		'posts_per_page'	=> -1,
		'suppress_filters'	=> FALSE,
		'meta_query' => array(
							'relation'		=> 'AND',
								array(
									'key'	 	=> 'template_block_display_where',
									'compare' 	=> 'LIKE',
									'value'	  	=> 'all_pages',
								),
								array(
									'key'	 	=> 'template_block_page_position',
									'compare' 	=> 'LIKE',
									'value' 	=> '"'. current_filter() .'"',
								),
								array(
									'relation'		=> 'OR',
									array(
										'relation'		=> 'AND',
										array(
											'key'		=> 'template_block_exclude_particular_pages',
											'compare'	=> '=',
											'value'		=> '1'
										),
										array(
											'key'		=> 'template_block_exclude_pages',
											//'compare'	=> 'IN',
											'compare'	=> 'NOT LIKE',
											'value'		=> '"'. $current_page_ID . '"'
											//'value'		=> $current_page_ID
										),
									),

									array(
										'key'		=> 'template_block_exclude_particular_pages',
										'compare'	=> 'NOT EXISTS'
									),
									
									
									array(
										'key'		=> 'template_block_exclude_particular_pages',
										'compare'	=> '=',
										'value'		=> '0'
									),
									/*
									*/	
										
									
								),
							),
		);

	$query = new WP_Query( $args );
	//print_r($query);
	if ($query->have_posts() ) {
		//echo "IMA";
		while($query->have_posts()) {
			$query->the_post();
			//print_r(get_field('template_block_exclude_pages'));
			//echo $current_page_ID;
			//if ( get_field('template_block_exclude_particular_pages') && ! in_array($current_page_ID, get_field('template_block_exclude_pages')))
				$template_ids[] = get_the_ID();
			//var_dump(get_field('template_block_exclude_particular_pages'));
			//echo "\n<br>exclude:</br>";
		}

	} 
	
	$args = array( 
		'post_type'			=> 'template_blocks', 
		'posts_per_page'	=> -1,
		'suppress_filters'	=> FALSE,
		'meta_query' 		=> array(
								'relation'		=> 'AND',
								array(
									'key'	 	=> 'template_block_display_where',
									'compare' 	=> 'LIKE',
									'value'	  	=> 'selected_pages',
								),
								/*
								array(
									'key'	 	=> 'template_block_pages_%_page',
									//'value'	  	=> '"' . $current_page_ID . '"',
									'value'	  	=> $current_page_ID,
									//'compare' 	=> 'LIKE',
									'compare' 	=> '=',
								),
								
								array(
									'key'	 	=> 'template_block_pages_%_position',
									'value' 	=> '"' . current_filter() . '"',
									'compare' 	=> 'LIKE',
								),				
								*/
							),
		);
			
		$query = new WP_Query( $args );
		if ($query->have_posts() ) {
			//echo "IMA2";
			while($query->have_posts()) {
				$query->the_post();
				$data = get_field('template_block_pages', get_the_ID());
				
				//echo "<br>" . current_filter() . " : " . get_the_ID(). "<br>";
				//print_r($data);
				//echo "<br>";

				if ($data)
				foreach($data as $dd) {
					if ((int)$dd['page'] == (int)$current_page_ID) {
						foreach($dd['position'] as $position) {
							if ($position == current_filter()) {
								$template_ids[] = get_the_ID();
							}
						}
						
					}
				}
			}
			
		}
	
		
		
	wp_reset_query();	

	/*
	echo "<pre>";
	print_r(get_field('template_block_display_where', 12986));
	echo "\n";
	print_r(get_field('template_block_pages', 12986));
	print_r($args);
	echo "</pre>";
	*/
	

	
	
	if (isset($template_ids)) {
		//print_r($template_ids);
		foreach($template_ids as $template_id)
		get_template_blocks($template_id);
	}
	echo "\n<!-- end " . current_filter() . " -->\n";
}
add_filter('manage_edit-template_blocks_columns', 'templateblock_position_func_columns');
function templateblock_position_func_columns($columns) {
    $columns['position'] = 'Display globally on';
    return $columns;
}
add_action( 'manage_template_blocks_posts_custom_column', 'templateblock_position_func_column_content', 20, 2 );
function templateblock_position_func_column_content( $column_name, $post_id ) {
	if ( 'position' != $column_name )
		return;
		
	if (($where = get_field('template_block_display_where', $post_id))) {
		//echo "<pre>";
		//print_r($where);
		echo $where['label'];
		if ($where['value'] == 'all_pages' && (get_field('template_block_exclude_particular_pages'))) {
			echo " (excluding some)";
		}
		/*
		foreach(get_field('template_block_pages', $post_id) as $page) {
		//print_r(get_field('page_position', $post_id));
		$pp = get_post($page);
		//print_r($pp);
		echo '<a href="'.get_permalink($page).'" target="_blank" title="'.$pp->post_title.'">' . $page . "</a> (".implode(',', get_field('page_position', $post_id)).")";
		echo "</pre>";
		}*/
	} else 
		echo '-';
}


// filter NEEDED!
function my_posts_where( $where ) {
	$where = str_replace("meta_key = 'template_block_pages_%", "meta_key LIKE 'template_block_pages_%", $where);
	return $where;
}
add_filter('posts_where', 'my_posts_where');



/* shortcode for the current year */
function year_shortcode() {
	$year = date('Y');
	return $year;
}
add_shortcode('year', 'year_shortcode');

/* shortcode for the current year ACF */
function acf_year_shortcode_replace($value, $post_id, $field )
{
	$value = str_replace('[year]', date('Y'), $value);
    return $value;
}
add_filter('acf/format_value', 'acf_year_shortcode_replace', 10, 3);




/**
 * Filter Content and ACF Content
 */
function filter_and_replace_content( $content ) {

	// replace PDF link with button (a href with class .btn.btn-pdf)
	$content = preg_replace_callback('/(<a.*?class="(viewpdf)".*?>(.*?)<\/a>)/i', 'replace_pdf_link_with_button', $content);
	////$content = preg_replace_callback('/(<a.*?href="(.*?\.pdf)".*? >(.*?)<\/a>)/', 'replace_pdf_link_with_button', $content);
	
    return $content;
}
add_filter( 'the_content', 'filter_and_replace_content', 20 );
add_filter( 'acf_the_content', 'filter_and_replace_content', 20 );

function replace_pdf_link_with_button($matches) {

	if (preg_match('/href="(.*?)"/', $matches[0], $href)) {
	}
	if (preg_match('/class="(.*?)"/', $matches[0], $class_match)) {
		//$class='btn btn-pdf '.$class_match[1];
	} else {
		//$class='btn btn-pdf';
	}

	return '<a href="'.$href[1].'" class="'.$class_match[1].'" target="_blank" title="'.$matches[3].'"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> View PDF</a>';
}



/*
 * Landing pages
 * add column in admin
 */
function wct_landing_head_index_paid($defaults) {
	$column_name = 'index';//column slug
	$column_heading = 'Robots';//column heading
	$defaults[$column_name] = $column_heading;
	$column_name = 'paid';//column slug
	$column_heading = 'Paid';//column heading
	$defaults[$column_name] = $column_heading;
	return $defaults;
}
function wct_landing_content_index_paid($name, $post_ID) {
    $column_name = 'index';//column slug	
    if ($name == $column_name) {
        $post_meta = get_post_meta($post_ID, '_yoast_wpseo_meta-robots-noindex', true);
        if ($post_meta) {
            echo '<span style="color:red">NOINDEX</span>';
        } else {
            echo '<span style="color:green">INDEX</span>';
        }
    }
    $column_name = 'paid';//column slug	
    if ($name == $column_name) {
        echo (get_field( 'landing_paid', $post_id )) ? "PAID" : "-";
    }
}

// ADD STYLING FOR COLUMN
function wct_landing_style_index_paid(){
	$column_name = 'type';//column slug	
	echo "<style>.column-$column_name{width:10%;}</style>";
}

add_filter('manage_landing_posts_columns', 'wct_landing_head_index_paid');
add_action('manage_landing_posts_custom_column', 'wct_landing_content_index_paid', 10, 2);
add_filter('admin_head', 'wct_landing_style_index_paid');
