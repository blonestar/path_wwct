<?php
ini_set( 'mysql.trace_mode', 0 );
/*
 * dependencies (ACF,...)
 */
if( !is_admin() && !class_exists('Acf') ) {
    //die( 'ACF plugin is required by the theme, please inform administrator.<br>Install it for free <a href="https://wordpress.org/plugins/advanced-custom-fields/">here</a>.' );
    die( 'ACF plugin is required by the theme, please inform administrator.' );
}
function worldwide_admin_notice__error() {
	if( ! class_exists('Acf') ) {
		$class = 'notice notice-error';
		$message = 'Theme error! <a href="' . get_admin_url(null, 'plugin-install.php?tab=plugin-information&plugin=advanced-custom-fields&TB_iframe=true&width=600&height=550') . '">ACF plugin</a> is required in order to run the theme.';
		printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message ); 
	}
}
add_action( 'admin_notices', 'worldwide_admin_notice__error' );
/*
 * hide ACF from ordinary users
 */
function worldwide_acf_show_admin( $show ) {
    return current_user_can('manage_options');
}
add_filter('acf/settings/show_admin', 'worldwide_acf_show_admin');
/*
 * ACF options page
 */
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'General Settings',
		'menu_title'	=> 'Wordwide Settings',
		'menu_slug' 	=> 'general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'general-settings',
	));
	
	/*
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Blog Settings',
		'menu_title'	=> 'Blog',
		'parent_slug'	=> 'general-settings',
	));
	*/
	
}
/*
 * Adding Content to Tab (ACF)
 */
function my_acf_admin_head() {
    ?>
    <script type="text/javascript">
    (function($) {
        
        $(document).ready(function(){
            
            $('.acf-field-57e76cc1b1ec1 .acf-input').append( $('#postdivrich') );
            
        });
        
    })(jQuery);    
    </script>
    <style type="text/css">
        .acf-field #wp-content-editor-tools {
            background: transparent;
            padding-top: 0;
        }
    </style>
    <?php    
    
}
add_action('acf/input/admin_head', 'my_acf_admin_head');
/*
 * Combining ACF Tabs
 */
add_action('admin_footer', function() {
	$screen = get_current_screen();
	if ( $screen->base == 'post' ) {
		echo '
		<!-- ACF Merge Tabs -->
		<script>		
			var $boxes = jQuery(".postbox .acf-field-tab").parent(".inside");
			if ( $boxes.length > 1 ) {
			    var $firstBox = $boxes.first();
			    $boxes.not($firstBox).each(function(){
				    jQuery(this).children().appendTo($firstBox);
				    jQuery(this).parent(".postbox").remove();				    
			    });
				
			}
			
		</script>';
	}
	
});
function acf_load_landing_template( $field ) {
    
    // reset choices
    $field['choices'] = array();
			
			if ($handle = @opendir(get_template_directory() . '/template-landing')) {
				while (false !== ($entry = readdir($handle))) {
					if ($entry != "." && $entry != "..") {
						$field['choices'][ $entry ] = $entry;
					}
				}
				closedir($handle);
			}
            
    return $field;
    
}
add_filter('acf/load_field/name=landing_template_file', 'acf_load_landing_template');




// ADD NEW COLUMN
function v2008_c_head($defaults) {
	$column_name = 'type';//column slug
	$column_heading = 'Type';//column heading
	$defaults[$column_name] = $column_heading;
	return $defaults;
}
 
// SHOW THE COLUMN CONTENT
function v2008_c_content($name, $post_ID) {
    $column_name = 'type';//column slug	
    $column_field = 'document_type';//field slug	
    if ($name == $column_name) {
        $post_meta = get_post_meta($post_ID,$column_field,true);
        if ($post_meta) {
            echo $post_meta;
        }
    }
}

// ADD STYLING FOR COLUMN
function v2008_c_style(){
	$column_name = 'type';//column slug	
	echo "<style>.column-$column_name{width:10%;}</style>";
}

add_filter('manage_resources_posts_columns', 'v2008_c_head');
add_action('manage_resources_posts_custom_column', 'v2008_c_content', 10, 2);
add_filter('admin_head', 'v2008_c_style');





/*
 * ACF - get template block from ./template-blocks folder
 */
function get_template_blocks($page_id) {
	
	if( have_rows('template_blocks', $page_id) ):
		while ( have_rows('template_blocks', $page_id) ) : the_row();
			if (get_row_layout() == "template_block") {
				$templ = get_sub_field('template_block' );
				if (get_sub_field('hide')  !== true)
					get_template_blocks($templ->ID);
				
			} else {
				
				if (get_sub_field('hide')  !== true) {
					if (file_exists(get_template_directory() . "/template-blocks/" . get_row_layout() . ".php")) {
						include(get_template_directory() . "/template-blocks/" . get_row_layout() . ".php");
					} else {
						echo "<h4>Template block file missing!<br>/template-blocks/" . get_row_layout() . ".php</h4>";
					}
				}
			}
			
		endwhile;
	endif;
	
}
function get_template_widgets($page_id) {
	
	if( have_rows('widgets', $page_id) ):
		while ( have_rows('widgets', $page_id) ) : the_row();
		
			get_template_blocks(get_sub_field('widget'));
	
		endwhile;
		
	endif;
	
}
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
}
add_action( 'after_setup_theme', 'worldwide_setup' );

function add_query_vars_filter( $vars ){
  $vars[] = "ordby";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );
/*
 * Includes
 */
include "inc/blog-search-widget.php";
/*
 * fixing meadia urls (conflict with posts)
 * /
add_filter( 'attachment_link', 'wpd_attachment_link', 20, 2 );
function wpd_attachment_link( $link, $attachment_id ){
    $attachment = get_post( $attachment_id );
    return $parent_link . '/attachment/' .  $attachment_id;
}
add_action( 'init', function() {
    add_rewrite_rule( 'attachment/(\d*)/?$', 'index.php?attachment_id=$matches[1]', 'top' );
});
/**
 * enqueue scripts and styles.
 */
function worldwide_theme_name_scripts() {
	
    //wp_enqueue_style( 'favicon', get_template_directory_uri() . '/img/favicon.ico');
    //wp_enqueue_style( 'font', '//cloud.typography.com/6357712/764768/css/fonts.css');
	wp_enqueue_style( 'fonts', get_template_directory_uri() . '/css/fonts.min.css');
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
	
		wp_enqueue_style( 'main', get_template_directory_uri() . '/css/main.css');
	if (get_post_type() == 'landing') {
		// load specific landing page styles
		wp_enqueue_style( 'main', get_template_directory_uri() . '/css/landing.css');
	} else {
		wp_enqueue_style( 'custom', get_template_directory_uri() . '/css/custom.css');
		
	}
	
	wp_enqueue_script( 'jquery' );
	
	wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/js/html5shiv.min.js', array('jquery'), '', true );

	
	wp_enqueue_script( 'jquery.scrollTo', get_template_directory_uri() . '/js/jquery.scrollTo.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'iscroll', get_template_directory_uri() . '/js/iscroll.js', array('jquery'), '', true );
    wp_enqueue_script( 'marketo', '//app-ab07.marketo.com/js/forms2/js/forms2.min.js', array('jquery'), '', false );
	//if (get_post_type() != 'landing') {
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true );
		//wp_enqueue_script( 'tracking', get_template_directory_uri() . '/js/tracking.js', array('jquery'), '', true );
		wp_enqueue_script( 'wwctrials', get_template_directory_uri() . '/js/wwctrials.js', array('jquery'), '', true );
		wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), '', true );
		wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '', true );
	//} else {
		// load specific landing page scripts
	//}
	
}
add_action( 'wp_enqueue_scripts', 'worldwide_theme_name_scripts' );
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
}
/*
 * --------------- custom post types ------------------
 */
 
// Register Custom Post Type
function template_blocks_post_type() {
	$labels = array(
		'name'                  => _x( 'Template blocks', 'Post Type General Name', 'worldwide' ),
		'singular_name'         => _x( 'Template blocks', 'Post Type Singular Name', 'worldwide' ),
		'menu_name'             => __( 'Template blocks', 'worldwide' ),
		'name_admin_bar'        => __( 'Template blocks', 'worldwide' ),
		'archives'              => __( 'Item Archives', 'worldwide' ),
		'parent_item_colon'     => __( 'Parent Item:', 'worldwide' ),
		'all_items'             => __( 'All Template Blocks', 'worldwide' ),
		'add_new_item'          => __( 'Add New Template Block', 'worldwide' ),
		'add_new'               => __( 'Add New', 'worldwide' ),
		'new_item'              => __( 'New Block', 'worldwide' ),
		'edit_item'             => __( 'Edit Block', 'worldwide' ),
		'update_item'           => __( 'Update Block', 'worldwide' ),
		'view_item'             => __( 'View Block', 'worldwide' ),
		'search_items'          => __( 'Search', 'worldwide' ),
		'not_found'             => __( 'Not found', 'worldwide' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'worldwide' ),
		'featured_image'        => __( 'Featured Image', 'worldwide' ),
		'set_featured_image'    => __( 'Set featured image', 'worldwide' ),
		'remove_featured_image' => __( 'Remove featured image', 'worldwide' ),
		'use_featured_image'    => __( 'Use as featured image', 'worldwide' ),
		'insert_into_item'      => __( 'Insert into item', 'worldwide' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'worldwide' ),
		'items_list'            => __( 'Items list', 'worldwide' ),
		'items_list_navigation' => __( 'Items list navigation', 'worldwide' ),
		'filter_items_list'     => __( 'Filter items list', 'worldwide' ),
	);
	$args = array(
		'label'                 => __( 'Template Blocks', 'worldwide' ),
		'description'           => __( 'Predefined Template Blocks', 'worldwide' ),
		'labels'                => $labels,
		'supports'              => array( 'title', ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-exerpt-view',
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'rewrite'               => false,
		'capability_type'       => 'page',
	);
	register_post_type( 'template_blocks', $args );
}
add_action( 'init', 'template_blocks_post_type', 0 );


// Register Custom Post Type
function in_the_news_post_type() {
	$labels = array(
		'name'                  => _x( 'Articles', 'Post Type General Name', 'worldwide' ),
		'singular_name'         => _x( 'Article', 'Post Type Singular Name', 'worldwide' ),
		'menu_name'             => __( 'In The News', 'worldwide' ),
		'name_admin_bar'        => __( 'In The News', 'worldwide' ),
		'archives'              => __( 'Item Archives', 'worldwide' ),
		'parent_item_colon'     => __( 'Parent Item:', 'worldwide' ),
		'all_items'             => __( 'All Articles', 'worldwide' ),
		'add_new_item'          => __( 'Add New Article', 'worldwide' ),
		'add_new'               => __( 'Add Article', 'worldwide' ),
		'new_item'              => __( 'New Article', 'worldwide' ),
		'edit_item'             => __( 'Edit Article', 'worldwide' ),
		'update_item'           => __( 'Update Article', 'worldwide' ),
		'view_item'             => __( 'View Article', 'worldwide' ),
		'search_items'          => __( 'Search Article', 'worldwide' ),
		'not_found'             => __( 'Not found', 'worldwide' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'worldwide' ),
		'featured_image'        => __( 'Featured Image', 'worldwide' ),
		'set_featured_image'    => __( 'Set featured image', 'worldwide' ),
		'remove_featured_image' => __( 'Remove featured image', 'worldwide' ),
		'use_featured_image'    => __( 'Use as featured image', 'worldwide' ),
		'insert_into_item'      => __( 'Insert into article', 'worldwide' ),
		'uploaded_to_this_item' => __( 'Uploaded to this article', 'worldwide' ),
		'items_list'            => __( 'Articles list', 'worldwide' ),
		'items_list_navigation' => __( 'Items list navigation', 'worldwide' ),
		'filter_items_list'     => __( 'Filter items list', 'worldwide' ),
	);
	$rewrite = array(
		'slug'                  => 'about-us/in-the-news',
		'with_front'            => false,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'In The News', 'worldwide' ),
		'description'           => __( 'In The News', 'worldwide' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-list-view',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( 'in_the_news', $args );
}
add_action( 'init', 'in_the_news_post_type', 0 );


// Register Custom Post Type
function team_members_post_type() {
	$labels = array(
		'name'                  => _x( 'Team', 'Post Type General Name', 'worldwide' ),
		'singular_name'         => _x( 'Team', 'Post Type Singular Name', 'worldwide' ),
		'menu_name'             => __( 'Team', 'worldwide' ),
		'name_admin_bar'        => __( 'Team', 'worldwide' ),
		'archives'              => __( 'Item Archives', 'worldwide' ),
		'parent_item_colon'     => __( 'Parent Item:', 'worldwide' ),
		'all_items'             => __( 'All Team Members', 'worldwide' ),
		'add_new_item'          => __( 'Add New Team Member', 'worldwide' ),
		'add_new'               => __( 'Add New', 'worldwide' ),
		'new_item'              => __( 'New Team Member', 'worldwide' ),
		'edit_item'             => __( 'Edit', 'worldwide' ),
		'update_item'           => __( 'Update', 'worldwide' ),
		'view_item'             => __( 'View', 'worldwide' ),
		'search_items'          => __( 'Search Team Member', 'worldwide' ),
		'not_found'             => __( 'Not found', 'worldwide' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'worldwide' ),
		'featured_image'        => __( 'Team Member Image', 'worldwide' ),
		'set_featured_image'    => __( 'Set member image', 'worldwide' ),
		'remove_featured_image' => __( 'Remove member image', 'worldwide' ),
		'use_featured_image'    => __( 'Use as member image', 'worldwide' ),
		'insert_into_item'      => __( 'Insert into article', 'worldwide' ),
		'uploaded_to_this_item' => __( 'Uploaded to this article', 'worldwide' ),
		'items_list'            => __( 'Articles list', 'worldwide' ),
		'items_list_navigation' => __( 'Items list navigation', 'worldwide' ),
		'filter_items_list'     => __( 'Filter items list', 'worldwide' ),
	);
	$rewrite = array(
		'slug'                  => 'about-us/meet-the-team',
		'with_front'            => false,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Team', 'worldwide' ),
		'description'           => __( 'Main Team Members', 'worldwide' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		'taxonomies'            => array( 'team_members_tax' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-businessman',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( 'team_members', $args );
}
add_action( 'init', 'team_members_post_type', 0 );


// Register Careers Taxonomy
function team_members_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Team Categories', 'Taxonomy General Name', 'worldwide' ),
		'singular_name'              => _x( 'Team Category', 'Taxonomy Singular Name', 'worldwide' ),
		'menu_name'                  => __( 'Team Categories', 'worldwide' ),
		'all_items'                  => __( 'All Items', 'worldwide' ),
		'parent_item'                => __( 'Parent Item', 'worldwide' ),
		'parent_item_colon'          => __( 'Parent Item:', 'worldwide' ),
		'new_item_name'              => __( 'New Item Name', 'worldwide' ),
		'add_new_item'               => __( 'Add New Item', 'worldwide' ),
		'edit_item'                  => __( 'Edit Item', 'worldwide' ),
		'update_item'                => __( 'Update Item', 'worldwide' ),
		'view_item'                  => __( 'View Item', 'worldwide' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'worldwide' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'worldwide' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'worldwide' ),
		'popular_items'              => __( 'Popular Items', 'worldwide' ),
		'search_items'               => __( 'Search Items', 'worldwide' ),
		'not_found'                  => __( 'Not Found', 'worldwide' ),
		'no_terms'                   => __( 'No items', 'worldwide' ),
		'items_list'                 => __( 'Items list', 'worldwide' ),
		'items_list_navigation'      => __( 'Items list navigation', 'worldwide' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => false,
		//'default_term'				 => 'articles'
	);
	register_taxonomy( 'team_members_tax', array( 'team_members' ), $args );
}
add_action( 'init', 'team_members_taxonomy', 0 );


// Register Custom Post Type
function resources_post_type() {
	$labels = array(
		'name'                  => _x( 'Resources', 'Post Type General Name', 'worldwide' ),
		'singular_name'         => _x( 'Resource', 'Post Type Singular Name', 'worldwide' ),
		'menu_name'             => __( 'Resources', 'worldwide' ),
		'name_admin_bar'        => __( 'Resources', 'worldwide' ),
		'archives'              => __( 'Item Archives', 'worldwide' ),
		'parent_item_colon'     => __( 'Parent Item:', 'worldwide' ),
		'all_items'             => __( 'All Resources', 'worldwide' ),
		'add_new_item'          => __( 'Add New', 'worldwide' ),
		'add_new'               => __( 'Add New', 'worldwide' ),
		'new_item'              => __( 'New', 'worldwide' ),
		'edit_item'             => __( 'Edit', 'worldwide' ),
		'update_item'           => __( 'Update', 'worldwide' ),
		'view_item'             => __( 'View', 'worldwide' ),
		'search_items'          => __( 'Search', 'worldwide' ),
		'not_found'             => __( 'Not found', 'worldwide' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'worldwide' ),
		'featured_image'        => __( 'Featured Image', 'worldwide' ),
		'set_featured_image'    => __( 'Set featured image', 'worldwide' ),
		'remove_featured_image' => __( 'Remove featured image', 'worldwide' ),
		'use_featured_image'    => __( 'Use as featured image', 'worldwide' ),
		'insert_into_item'      => __( 'Insert into item', 'worldwide' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'worldwide' ),
		'items_list'            => __( 'Items list', 'worldwide' ),
		'items_list_navigation' => __( 'Items list navigation', 'worldwide' ),
		'filter_items_list'     => __( 'Filter items list', 'worldwide' ),
	);
	$rewrite = array(
		'slug'                  => 'resources/resource-library/%resources_tax%',
		'with_front'            => false,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Resource', 'worldwide' ),
		'description'           => __( 'Resources (articles, documents, videos...)', 'worldwide' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail'),
		'taxonomies'            => array( 'resources_tax' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-archive',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false, // 'resources/resource-library',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( 'resources', $args );
}
add_action( 'init', 'resources_post_type', 0 );


// Register Custom Taxonomy
function resources_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Resource Categories', 'Taxonomy General Name', 'worldwide' ),
		'singular_name'              => _x( 'Resource Category', 'Taxonomy Singular Name', 'worldwide' ),
		'menu_name'                  => __( 'Resource Category', 'worldwide' ),
		'all_items'                  => __( 'All Items', 'worldwide' ),
		'parent_item'                => __( 'Parent Item', 'worldwide' ),
		'parent_item_colon'          => __( 'Parent Item:', 'worldwide' ),
		'new_item_name'              => __( 'New Item Name', 'worldwide' ),
		'add_new_item'               => __( 'Add New Item', 'worldwide' ),
		'edit_item'                  => __( 'Edit Item', 'worldwide' ),
		'update_item'                => __( 'Update Item', 'worldwide' ),
		'view_item'                  => __( 'View Item', 'worldwide' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'worldwide' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'worldwide' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'worldwide' ),
		'popular_items'              => __( 'Popular Items', 'worldwide' ),
		'search_items'               => __( 'Search Items', 'worldwide' ),
		'not_found'                  => __( 'Not Found', 'worldwide' ),
		'no_terms'                   => __( 'No items', 'worldwide' ),
		'items_list'                 => __( 'Items list', 'worldwide' ),
		'items_list_navigation'      => __( 'Items list navigation', 'worldwide' ),
	);
	$rewrite = array(
		'slug'                       => 'resources/resource-library',
		'with_front'                 => false,
		'hierarchical'               => true,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
		//'default_term'				 => 'articles'
	);
	register_taxonomy( 'resources_tax', array( 'resources' ), $args );
}
add_action( 'init', 'resources_taxonomy', 0 );


function events_permalink_structure($post_link, $post, $leavename, $sample)
{
    if ( false !== strpos( $post_link, '%resources_tax%' ) ) {
        $resources_tax_term = get_the_terms( $post->ID, 'resources_tax' );
        $post_link = str_replace( '%resources_tax%', @array_pop( $resources_tax_term )->slug, $post_link );
    }
    return $post_link;
}
add_filter('post_type_link', 'events_permalink_structure', 10, 4);


function add_resource_category_automatically($post_ID) {
  global $wpdb;
    if(!has_term('','resources_tax',$post_ID)){
      $cat = 16; // All
      wp_set_object_terms($post_ID, $cat, 'resources_tax');
    }
}
add_action('publish_webinar', 'add_resource_category_automatically');


// Register Custom Post Type
function assay_post_type() {
	$labels = array(
		'name'                  => _x( 'Assays', 'Post Type General Name', 'worldwide' ),
		'singular_name'         => _x( 'Assay', 'Post Type Singular Name', 'worldwide' ),
		'menu_name'             => __( 'Assays', 'worldwide' ),
		'name_admin_bar'        => __( 'Assays', 'worldwide' ),
		'archives'              => __( 'Item Archives', 'worldwide' ),
		'parent_item_colon'     => __( 'Parent Item:', 'worldwide' ),
		'all_items'             => __( 'All Assays', 'worldwide' ),
		'add_new_item'          => __( 'Add New', 'worldwide' ),
		'add_new'               => __( 'Add New', 'worldwide' ),
		'new_item'              => __( 'New', 'worldwide' ),
		'edit_item'             => __( 'Edit', 'worldwide' ),
		'update_item'           => __( 'Update', 'worldwide' ),
		'view_item'             => __( 'View', 'worldwide' ),
		'search_items'          => __( 'Search', 'worldwide' ),
		'not_found'             => __( 'Not found', 'worldwide' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'worldwide' ),
		'featured_image'        => __( 'Featured Image', 'worldwide' ),
		'set_featured_image'    => __( 'Set featured image', 'worldwide' ),
		'remove_featured_image' => __( 'Remove featured image', 'worldwide' ),
		'use_featured_image'    => __( 'Use as featured image', 'worldwide' ),
		'insert_into_item'      => __( 'Insert into item', 'worldwide' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'worldwide' ),
		'items_list'            => __( 'Items list', 'worldwide' ),
		'items_list_navigation' => __( 'Items list navigation', 'worldwide' ),
		'filter_items_list'     => __( 'Filter items list', 'worldwide' ),
	);
	$args = array(
		'label'                 => __( 'Assay', 'worldwide' ),
		'description'           => __( 'Assays database', 'worldwide' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-book',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'rewrite'               => false,
		'capability_type'       => 'post',
	);
	register_post_type( 'assays', $args );
}
add_action( 'init', 'assay_post_type', 0 );


// Register Custom Post Type
function events_post_type() {
	$labels = array(
		'name'                  => _x( 'Events', 'Post Type General Name', 'worldwide' ),
		'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'worldwide' ),
		'menu_name'             => __( 'Events', 'worldwide' ),
		'name_admin_bar'        => __( 'Events', 'worldwide' ),
		'archives'              => __( 'Item Archives', 'worldwide' ),
		'parent_item_colon'     => __( 'Parent Item:', 'worldwide' ),
		'all_items'             => __( 'All Events', 'worldwide' ),
		'add_new_item'          => __( 'Add New', 'worldwide' ),
		'add_new'               => __( 'Add New', 'worldwide' ),
		'new_item'              => __( 'New', 'worldwide' ),
		'edit_item'             => __( 'Edit', 'worldwide' ),
		'update_item'           => __( 'Update', 'worldwide' ),
		'view_item'             => __( 'View', 'worldwide' ),
		'search_items'          => __( 'Search', 'worldwide' ),
		'not_found'             => __( 'Not found', 'worldwide' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'worldwide' ),
		'featured_image'        => __( 'Featured Image', 'worldwide' ),
		'set_featured_image'    => __( 'Set featured image', 'worldwide' ),
		'remove_featured_image' => __( 'Remove featured image', 'worldwide' ),
		'use_featured_image'    => __( 'Use as featured image', 'worldwide' ),
		'insert_into_item'      => __( 'Insert into item', 'worldwide' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'worldwide' ),
		'items_list'            => __( 'Items list', 'worldwide' ),
		'items_list_navigation' => __( 'Items list navigation', 'worldwide' ),
		'filter_items_list'     => __( 'Filter items list', 'worldwide' ),
	);
	$args = array(
		'label'                 => __( 'Events', 'worldwide' ),
		'description'           => __( 'Events', 'worldwide' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt' ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-clock',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'events', $args );
}
add_action( 'init', 'events_post_type', 0 );


// Register Custom Post Type
function landing_post_type() {
	$labels = array(
		'name'                  => _x( 'Landing Pages', 'Post Type General Name', 'worldwide' ),
		'singular_name'         => _x( 'Landing Page', 'Post Type Singular Name', 'worldwide' ),
		'menu_name'             => __( 'Landing Pages', 'worldwide' ),
		'name_admin_bar'        => __( 'Landing Page', 'worldwide' ),
		'archives'              => __( 'Page Archives', 'worldwide' ),
		'parent_item_colon'     => __( 'Parent Page:', 'worldwide' ),
		'all_items'             => __( 'All Pages', 'worldwide' ),
		'add_new_item'          => __( 'Add New Page', 'worldwide' ),
		'add_new'               => __( 'Add New', 'worldwide' ),
		'new_item'              => __( 'New Page', 'worldwide' ),
		'edit_item'             => __( 'Edit Page', 'worldwide' ),
		'update_item'           => __( 'Update Page', 'worldwide' ),
		'view_item'             => __( 'View Page', 'worldwide' ),
		'search_items'          => __( 'Search Page', 'worldwide' ),
		'not_found'             => __( 'Not found', 'worldwide' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'worldwide' ),
		'featured_image'        => __( 'Featured Image', 'worldwide' ),
		'set_featured_image'    => __( 'Set featured image', 'worldwide' ),
		'remove_featured_image' => __( 'Remove featured image', 'worldwide' ),
		'use_featured_image'    => __( 'Use as featured image', 'worldwide' ),
		'insert_into_item'      => __( 'Insert into Page', 'worldwide' ),
		'uploaded_to_this_item' => __( 'Uploaded to this itempage', 'worldwide' ),
		'items_list'            => __( 'Pages list', 'worldwide' ),
		'items_list_navigation' => __( 'Pages list navigation', 'worldwide' ),
		'filter_items_list'     => __( 'Filter pages list', 'worldwide' ),
	);
	$rewrite = array(
		'slug'                       => 'landing',
		'with_front'                 => false,
		'hierarchical'               => true,
	);
	$args = array(
		'label'                 => __( 'Landing Page', 'worldwide' ),
		'description'           => __( 'Custom Landing Pages', 'worldwide' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'revisions', 'page-attributes', ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-admin-page',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( 'landing', $args );
}
add_action( 'init', 'landing_post_type', 0 );

/**
 * Strip the slug out of a hierarchical custom post type
 */
if ( !class_exists( 'Landing_Pages_Rewrites' ) ) :
class Landing_Pages_Rewrites {
    private static $instance;
    public $rules;
    private function __construct() {
        /* Don't do anything, needs to be initialized via instance() method */
    }
    public static function instance() {
        if ( ! isset( self::$instance ) ) {
            self::$instance = new Landing_Pages_Rewrites;
            self::$instance->setup();
        }
        return self::$instance;
    }
    public function setup() {
        add_action( 'init',                array( $this, 'add_rewrites' ),            20 );
       add_filter( 'request',             array( $this, 'check_rewrite_conflicts' )     );
        add_filter( 'landing_rewrite_rules', array( $this, 'strip_landing_rules' )           );
        add_filter( 'rewrite_rules_array', array( $this, 'inject_landing_rules' )          );
    }
    public function add_rewrites() {
        add_rewrite_tag( "%landing%", '(.+?)', "landing=" );
        add_permastruct( 'landing', "%landing%", array(
            'ep_mask' => EP_PERMALINK,
			'with_front' => false
        ) );
		//echo EP_PERMALINK;
    }
    public function check_rewrite_conflicts( $qv ) {
        if ( isset( $qv['landing'] ) ) {
            if ( get_page_by_path( $qv['landing'] ) ) {
                $qv = array( 'pagename' => $qv['landing'] );
            }
        }
		//print_r($qv);
        return $qv;
    }
    public function strip_landing_rules( $rules ) {
        $this->rules = $rules;
        # We no longer need the attachment rules, so strip them out
        foreach ( $this->rules as $regex => $value ) {
            if ( strpos( $value, 'attachment' ) )
                unset( $this->rules[ $regex ] );
        }
        return array();
    }
    public function inject_landing_rules( $rules ) {
        # This is the first 'page' rule
        $offset = array_search( '(.?.+?)/trackback/?$', array_keys( $rules ) );
        $page_rules = array_slice( $rules, $offset, null, true );
        $other_rules = array_slice( $rules, 0, $offset, true );
        return array_merge( $other_rules, $this->rules, $page_rules );
    }
}
Landing_Pages_Rewrites::instance();
endif;


add_filter( 'template_include', 'landing_template_page' );
function landing_template_page( $original_template ) {
	global $post;
	if ( @$post->post_type == 'landing' )
		return get_template_directory() . '/template-landing/' . get_field('landing_template_file');
	return $original_template;
}


/*
// DISABLED
// Register Careers Post Type
function careers_post_type() {
	$labels = array(
		'name'                  => _x( 'Careers', 'Post Type General Name', 'worldwide' ),
		'singular_name'         => _x( 'Position', 'Post Type Singular Name', 'worldwide' ),
		'menu_name'             => __( 'Careers', 'worldwide' ),
		'name_admin_bar'        => __( 'Careers', 'worldwide' ),
		'archives'              => __( 'Item Archives', 'worldwide' ),
		'parent_item_colon'     => __( 'Parent Item:', 'worldwide' ),
		'all_items'             => __( 'All Positions', 'worldwide' ),
		'add_new_item'          => __( 'Add New', 'worldwide' ),
		'add_new'               => __( 'Add New', 'worldwide' ),
		'new_item'              => __( 'New', 'worldwide' ),
		'edit_item'             => __( 'Edit', 'worldwide' ),
		'update_item'           => __( 'Update', 'worldwide' ),
		'view_item'             => __( 'View', 'worldwide' ),
		'search_items'          => __( 'Search', 'worldwide' ),
		'not_found'             => __( 'Not found', 'worldwide' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'worldwide' ),
		'featured_image'        => __( 'Featured Image', 'worldwide' ),
		'set_featured_image'    => __( 'Set featured image', 'worldwide' ),
		'remove_featured_image' => __( 'Remove featured image', 'worldwide' ),
		'use_featured_image'    => __( 'Use as featured image', 'worldwide' ),
		'insert_into_item'      => __( 'Insert into item', 'worldwide' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'worldwide' ),
		'items_list'            => __( 'Items list', 'worldwide' ),
		'items_list_navigation' => __( 'Items list navigation', 'worldwide' ),
		'filter_items_list'     => __( 'Filter items list', 'worldwide' ),
	);
	$rewrite = array(
		//'slug'                  => 'careers/%careers_tax%',
		'slug'                  => 'careers/position',
		'with_front'            => false,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Careers', 'worldwide' ),
		'description'           => __( 'Open job positions', 'worldwide' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail'),
		'taxonomies'            => array( 'careers_tax' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-archive',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false, // 'resources/resource-library',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( 'careers', $args );
}
//add_action( 'init', 'careers_post_type', 0 );


// DISABLED
// Register Careers Taxonomy
function careers_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Position Categories', 'Taxonomy General Name', 'worldwide' ),
		'singular_name'              => _x( 'Position Category', 'Taxonomy Singular Name', 'worldwide' ),
		'menu_name'                  => __( 'Position Categories', 'worldwide' ),
		'all_items'                  => __( 'All Items', 'worldwide' ),
		'parent_item'                => __( 'Parent Item', 'worldwide' ),
		'parent_item_colon'          => __( 'Parent Item:', 'worldwide' ),
		'new_item_name'              => __( 'New Item Name', 'worldwide' ),
		'add_new_item'               => __( 'Add New Item', 'worldwide' ),
		'edit_item'                  => __( 'Edit Item', 'worldwide' ),
		'update_item'                => __( 'Update Item', 'worldwide' ),
		'view_item'                  => __( 'View Item', 'worldwide' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'worldwide' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'worldwide' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'worldwide' ),
		'popular_items'              => __( 'Popular Items', 'worldwide' ),
		'search_items'               => __( 'Search Items', 'worldwide' ),
		'not_found'                  => __( 'Not Found', 'worldwide' ),
		'no_terms'                   => __( 'No items', 'worldwide' ),
		'items_list'                 => __( 'Items list', 'worldwide' ),
		'items_list_navigation'      => __( 'Items list navigation', 'worldwide' ),
	);
	$rewrite = array(
		'slug'                       => 'careers',
		'with_front'                 => false,
		'hierarchical'               => true,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
		//'default_term'				 => 'articles'
	);
	register_taxonomy( 'careers_tax', array( 'careers' ), $args );
}
//add_action( 'init', 'careers_taxonomy', 0 );
/*
function careers_permalink_structure($post_link, $post, $leavename, $sample)
{
    if ( false !== strpos( $post_link, '%careers_tax%' ) ) {
        $careers_tax_term = get_the_terms( $post->ID, 'careers_tax' );
        $post_link = str_replace( '%careers_tax%', @array_pop( $careers_tax_term )->slug, $post_link );
    }
    return $post_link;
}
add_filter('post_type_link', 'careers_permalink_structure', 10, 4);


function add_career_category_automatically($post_ID) {
	
	if ( $parent_id = wp_is_post_revision( $post_ID ) ) 
		$post_id = $parent_id;
	$defaultcat = 63;

	
	global $wpdb;
	$obj_terms = wp_get_object_terms($post_ID,  'careers_tax' );
	foreach($obj_terms as $obj_term) {
		$terms[] = $obj_term->term_id;
	}
	$terms[] = 63;
	wp_set_object_terms($post_ID, $terms, 'careers_tax');
}
add_action('save_post_careers', 'add_career_category_automatically');
*/

/*
function set_resources_default_category($post_id, $post) {
		
		
	// If this is a revision, get real post ID
	if ( $parent_id = wp_is_post_revision( $post_id ) ) 
		$post_id = $parent_id;
	if ($post->post_type == 'resources') {
        $taxonomies = get_object_taxonomies( $post->post_type );
        foreach ( (array) $taxonomies as $taxonomy ) {
			
            $terms = wp_get_post_terms( $post_id, $taxonomy );
			$found = false;
			foreach($terms as $term) {
				if ($term->slug == 'all') $found = true;
				$defaults['resources_tax'][] = $term->slug;
			}
			if (!$found)
				$defaults['resources_tax'][] = 'all';
			
            if (array_key_exists( $taxonomy, $defaults ) ) {
                wp_set_object_terms( $post_id, $defaults[$taxonomy], $taxonomy );
           }
        }
	}
}
add_action('save_post', 'set_resources_default_category', 100, 2);
*/
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

//add_filter( 'query_vars', 'my_query_vars' );
function my_query_vars( $query_vars ) {
    array_push($query_vars, 'attachment_id');
    return $query_vars;
}


function custom_rewrite_rule() {
	add_rewrite_rule('getattachment/(\d+)/([^/]+)/?$','index.php?attachment_id=$matches[1]','top');
}
//add_action('init', 'custom_rewrite_rule', 10, 0);

  
add_action( 'wp_loaded', 'my_flush_rules' );
function my_flush_rules() {
    if (!$rules = get_option('rewrite_rules'))
        $rules = array();

    if (!isset($rules['getattachment/(\d+)/([^/]+)/?$'])) {
        global $wp_rewrite;
        $wp_rewrite->flush_rules();
    }
}

//add_action('wp', 'debug_rules');
function debug_rules() {
    global $wp, $wp_query, $wp_rewrite;
    echo $wp->matched_rule . ' | ' . $wp_rewrite->rules[$wp->matched_rule];
    print_r($wp_rewrite->rules);
    exit();
}
  
/*
function append_query_string( $url, $post, $leavename=false ) {
	if ( $post->post_type == 'post' ) {
		$url = add_query_arg( 'foo', 'bar', $url );
	}
	return $url;
}
add_filter( 'post_link', 'append_query_string', 10, 3 );
*/
function get_post_read_label($post_id, $default_label = "Read More") {	
	$label = get_field('document_link_label', $post_id);
	if ($label)
		return $label;
	return $default_label;
}

function get_read_more_link($default_label = null, $post_id = null, $attributes = array()) {
	
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
		$attributes['data-toggle'] = 'modal';
		$attributes['data-target'] = '.video-modal';
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
	
	if (is_null($default_label)) {
		$label = get_field('document_link_label', $post_id);
		$label = ($label) ? $label . ' &rsaquo;' :  "Read More &rsaquo;";
	} else {
		$label = $default_label;
	}

	$att_html = '';
	foreach($attributes as $attr_key => $attr_value)
		$att_html .= " $attr_key='$attr_value'";
		
	echo "<a href='".$url."'".$att_html.">" . $label . "</a>\n";
}
 
/*
 * menu fix - aligning to existing css
 */
class Walker_Worldwide_Menu extends Walker_Nav_Menu  {
	function start_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n\t{$indent}<span class=\"sub-nav\"><ul class=\"children level-{$depth}\">\n";
	}
	function end_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n\t{$indent}</ul></span>\n";
	}
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
		$output .= $indent . '<li' . $id . $class_names .'>';
		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}
		$title = apply_filters( 'the_title', $item->title, $item->ID );
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'><span>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</span></a>';
		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}
 
/*
 * mobile menu
 */
class Walker_Worldwide_Menu_Mobile extends Walker_Nav_Menu  {
	function start_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "
		
								
			<div class=\"sub-nav\">
				<div class=\"scroll-wrapper\">
			<div class=\"back\"><span>Back</span></div>
					<ul class=\"children level-{$depth}\">
					";
	}
	function end_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "
					</ul>
				</div>
			</div>\n";
	}
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
		$output .= $indent . '<li' . $id . $class_names .'>';
		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}
		$title = apply_filters( 'the_title', $item->title, $item->ID );
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );
		$item_output = $args->before;
		$item_output .= "\n". '<a'. $attributes .'><span>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</span></a>' . "\n";
		//if ($depth > 0)
		//$item_output .= ;
		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}




/*
 * CSV parser - the REAL one!
 * /
function csv_to_array($filename='', $delimiter=',')
{
    if(!file_exists($filename) || !is_readable($filename))
        return FALSE;
    $header = NULL;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== FALSE)
    {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
        {
            if(!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }
    return $data;
}
$insert =  $_GET['insert'];
if ($insert==2) {
	$csv = csv_to_array(get_template_directory().'/assays.csv', ';');
	foreach($csv as $line) {
		$title = preg_replace('/\n+/', ', ', $line['AnalyteName']);
			// Gather post data.
		$post_data = array(
			'post_type'		=> 'assays',
			'post_title'    => $title,
			//'post_content'  => $line['AnalyteName'],
			'post_content'  => '',
			'post_status'   => 'publish',
			'post_author'   => 1,
			'comment_status' => 'closed',
			'ping_status' => 'closed'
			//'post_category' => array( 8,39 )
		);
		 
		 
		// Insert the post into the database.
		$post_id = wp_insert_post( $post_data );
		update_field('assay_analytename', $line['AnalyteName'], $post_id);
		update_field('assay_lloq', $line['LLOQ'], $post_id);
		update_field('assay_uloq', $line['ULOQ'], $post_id);
		update_field('assay_units', $line['Units'], $post_id);
		update_field('assay_species', $line['Species'], $post_id);
		update_field('assay_matrix', $line['Matrix'], $post_id);
		
	}
}
//exit;
*/
/*
add_action( 'save_post_assays', 'wpse63478_save' );
function wpse63478_save($post_id) {
    //save stuff
	global $wpdb;
	$title = preg_replace('/\n+/', '; ', trim(get_field('assay_analytename', $post_id)) );
	$where = array( 'ID' => $post_id );
	$wpdb->update( $wpdb->posts, array( 'post_title' => $title ), $where );
}
*/


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
 * Resource Assays Ajax search (autocomplete)
 * /
add_action('wp_ajax_nopriv_dhemy_ajax_search','dhemy_ajax_search');
add_action('wp_ajax_dhemy_ajax_search','dhemy_ajax_search');
function dhemy_ajax_search(){
	 
	// creating a search query
	$args = array(
		'post_type' 		=> 'assays',
		'post_status' 		=> 'publish',
		'order' 			=> 'DESC',
		'orderby' 			=> 'date',
		's' 				=> $_POST['term'],
		'posts_per_page' 	=> 5
	 
	);
	 
	$query = new WP_Query( $args );
	 
	// display results
	if($query->have_posts()){
		 
		while ($query->have_posts()) {
			$query->the_post();
			?>
			<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php
		}
	} else {
		 
		?>
		<li><a href="#">Use more key words</a></li>
		<?php
	 
	}
	exit;
}
*/
/*
 * Excerpt stuff
 */
function wpdocs_excerpt_more( $more ) {
    return '';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );
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
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'pietergoosen_custom_wp_trim_excerpt'); 
/*
 * Search page url
 */
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
}
//add_action( 'pre_get_posts', 'isu_search_url' );
/*
 * Assays Seearch autocomplete
 * /
function worldwide_assays_search() {
	// This function should query the database and get results as an array of rows:
	// GET the recieved data: 'term' (what has been typed by the user)
	$term = $_GET['term'];
	$suggestions_array = array('test', 'test2');
	// echo JSON to page  and exit.
	$response = $_GET["callback"]."(". json_encode($suggestions_array) .")";  
	echo $response;  
	exit;
}
add_action( 'wp_ajax_assays-search', 'worldwide_assays_search' );
add_action( 'wp_ajax_nopriv_assays-search', 'worldwide_assays_search' );
/*
//wp_enqueue_script( 'myajax_jsfile_handle', get_stylesheet_directory."/rest/of/path/to/file.js", array( 'jquery', 'jquery-form', 'json2' ), false, true ); );
wp_localize_script( 
    'myajax_jsfile_handle', 
    'MyAjax_object', 
    array( 
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'myajax_nonce' => wp_create_nonce( 'assays-search_nonce_val' ),
        'action' => 'assays-search'
    )
);
*/
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
   if (isset($_GET['s']) && empty($_GET['s']) && $query->is_main_query()){
      $query->is_search = true;
      $query->is_home = false;
   }
   return $query;
}
add_filter('pre_get_posts','SearchFilter');
/** Custom Post Type Template Selector ** /
function cpt_add_meta_boxes() {
    $post_types = get_post_types();
    foreach( $post_types as $ptype ) {
        if ( $ptype !== 'page') {
            add_meta_box( 'cpt-selector', 'Attributes', 'cpt_meta_box', $ptype, 'side', 'core' );
        }
    }
}
add_action( 'add_meta_boxes', 'cpt_add_meta_boxes' );
function cpt_remove_meta_boxes() {
    $post_types = get_post_types();
    foreach( $post_types as $ptype ) {
        if ( $ptype == 'page111111111111111111111111111111111111111111') {
            remove_meta_box( 'pageparentdiv', $ptype, 'normal' );
        }
    }
}
add_action( 'admin_menu' , 'cpt_remove_meta_boxes' );
function cpt_meta_box( $post ) {
    $post_meta = get_post_meta( $post->ID );
    $templates = wp_get_theme()->get_page_templates();
    $post_type_object = get_post_type_object($post->post_type);
    if ( $post_type_object->hierarchical ) {
        $dropdown_args = array(
            'post_type'        => $post->post_type,
            'exclude_tree'     => $post->ID,
            'selected'         => $post->post_parent,
            'name'             => 'parent_id',
            'show_option_none' => __('(no parent)'),
            'sort_column'      => 'menu_order, post_title',
            'echo'             => 0,
        );
        $dropdown_args = apply_filters( 'page_attributes_dropdown_pages_args', $dropdown_args, $post );
        $pages = wp_dropdown_pages( $dropdown_args );
        if ( $pages ) { 
            echo "<p><strong>Parent</strong></p>";
            echo "<label class=\"screen-reader-text\" for=\"parent_id\">Parent</label>";
            echo $pages;
        }
    }
    // Template Selector
    echo "<p><strong>Template</strong></p>";
    echo "<select id=\"cpt-selector\" name=\"_wp_page_template\"><option value=\"default\">Default Template</option>";
    foreach ( $templates as $template_filename => $template_name ) {
       // if ( $post->post_type == strstr( $template_filename, '-', true) ) {
            if ( isset($post_meta['_wp_page_template'][0]) && ($post_meta['_wp_page_template'][0] == $template_filename) ) {
                echo "<option value=\"$template_filename\" selected=\"selected\">$template_name</option>";
            } else {
                echo "<option value=\"$template_filename\">$template_name</option>";
            }
       // }
    }
    echo "</select>";
    // Page order
    echo "<p><strong>Order</strong></p>";
    echo "<p><label class=\"screen-reader-text\" for=\"menu_order\">Order</label><input name=\"menu_order\" type=\"text\" size=\"4\" id=\"menu_order\" value=\"". esc_attr($post->menu_order) . "\" /></p>";
}
function save_cpt_template_meta_data( $post_id ) {
    if ( isset( $_REQUEST['_wp_page_template'] ) ) {
        update_post_meta( $post_id, '_wp_page_template', $_REQUEST['_wp_page_template'] );
    }
}
add_action( 'save_post' , 'save_cpt_template_meta_data' );
function custom_single_template($template) {
    global $post;
    $post_meta = ( $post ) ? get_post_meta( $post->ID ) : null;
    if ( isset($post_meta['_wp_page_template'][0]) && ( $post_meta['_wp_page_template'][0] != 'default' ) ) {
        $template = get_template_directory() . '/' . $post_meta['_wp_page_template'][0];
    }
    return $template;
}
add_filter( 'single_template', 'custom_single_template' );
/** END Custom Post Type Template Selector **/


function worldwide_sort_terms_function($a, $b) {

	if ($a->sort_order == $b->sort_order) {
		return 0;
	} elseif ($a->sort_order < $b->sort_order) {
		return -1;
	} else {
		return 1;
	}
}

/*

// Add new selection based on template choice in page settings (page settings is a field group displayed on every page) 
add_filter('acf/location/rule_types', 'acf_location_rules_types');
function acf_location_rules_types( $choices )
{
    $choices['Landing']['cpt_parent'] = 'Landing page templates';
	
	//echo "<pre>";
    //    print_r($choices);
    //    echo "</pre>";
	
    return $choices;
}

// Get the choices from page settings - choose your template option
add_filter('acf/location/rule_values/cpt_parent', 'acf_location_rules_values_cpt_parent');
function acf_location_rules_values_cpt_parent( $field )
{
	
  
  $field_key = 'field_57fa55897a3a8'; // Selection field inside field group "Page settings"
  $field = get_field_object($field_key); 
  
  if($field) {
        //echo "<pre>";
        //print_r($field);
        //echo "</pre>";
    }
  
 
  return $field['choices'];
   		
}

// Match field group on the page to show it (or not)
add_filter('acf/location/rule_match/cpt_parent', 'acf_location_rules_match_cpt_parent', 10, 3);
function acf_location_rules_match_cpt_parent( $match, $rule, $options )
{
	
	global $post;
	$selected_post = (int) $rule['value'];

	// post parent
	if($post) {
		$post_parent = $post->post_parent;
		if( $options['page_parent'] ) {
			$post_parent = $options['page_parent'];
		}
		if ($rule['operator'] == "=="){
			$match = ( $post_parent == $selected_post );
		}
		elseif ($rule['operator'] == "!="){
			$match = ( $post_parent != $selected_post );
		}
	}

    return $match;
}

*/

function acf_location_rules_types($choices) {
    //$choices['Custom Post Types']['cpt_parent'] = 'Custom Post Type Parent';
	$choices['Landing']['cpt_parent'] = 'Landing page';
	$choices['Landing']['cpt_parent_template'] = 'Landing page template';
    return $choices;
}
add_filter('acf/location/rule_types', 'acf_location_rules_types');

function acf_location_rules_values_cpt_parent($choices) {
	$args = array(
		'hierarchical' => true,
		'_builtin' => false,
		'public' => true
	);
	//$hierarchical_posttypes = get_post_types($args);
	//foreach($hierarchical_posttypes as $hierarchical_posttype) {
		//if ('acf' !== $hierarchical_posttype) {
			$args = array(
				'post_type' => 'landing',
				'posts_per_page' => -1,
				'post_status' => 'publish'
			);
			$customposts = get_posts($args);
			foreach ($customposts as $custompost) {
				$choices[$custompost->ID] = $custompost->post_title;
			}
		//}
	//}
	//$field_key = 'field_57fa55897a3a8'; // Selection field inside field group "Page settings"
  //$field = get_field_object($field_key);
	//print_r($choices);
	return $choices;
}
add_filter('acf/location/rule_values/cpt_parent', 'acf_location_rules_values_cpt_parent');


add_filter('acf/location/rule_values/cpt_parent_template', 'acf_location_rules_values_cpt_parent_template');
function acf_location_rules_values_cpt_parent_template( $field )
{
	$field_key = 'field_57fa55897a3a8'; // Selection field inside field group "Page settings"
	$field = get_field_object($field_key); 
	return $field['choices'];	
}





add_filter('acf/location/rule_match/cpt_parent', 'acf_location_rules_match_cpt_parent', 10, 3);
function acf_location_rules_match_cpt_parent($match, $rule, $options) {
	global $post;
	
	$selected_post = (int) $rule['value'];
	if ($post) { // post parent
		if ('==' == $rule['operator']) {
			$match = ($options['post_id'] == $selected_post);
		} elseif ('!=' == $rule['operator']) {
			$match = ($options['post_id'] != $selected_post);
		}
	}
  return $match;
}


add_filter('acf/location/rule_match/cpt_parent_template', 'acf_location_rules_match_cpt_parent_template', 10, 3);
function acf_location_rules_match_cpt_parent_template($match, $rule, $options) {
	global $post;
	
	$post_value = get_field('landing_template_file', $options['post_id']);
	$selected = $rule['value'];
	if ($post) { // post parent
		if ('==' == $rule['operator']) {
			$match = ($post_value == $selected);
		} elseif ('!=' == $rule['operator']) {
			$match = ($post_value != $selected);
		}
	}
  return $match;
}



add_action('admin_head', 'acf_custom_post_template_js');
function acf_custom_post_template_js() {
  echo "<script>
  		jQuery(function($){
			$('#acf-field_57fa55897a3a8').live('change', function(){ 
				acf.ajax.update( 'cpt', jQuery(this).val() ).fetch();
			});
		});
	</script>\n";
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
                'hide_empty' => true
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
            $var = &$query->query_vars[$tax_slug];
            if ( isset($var) ) {
                $term = get_term_by('id',$var,$tax_slug);
                $var = $term->slug;
            }
        }
    }
    return $query;
}
add_action( 'restrict_manage_posts', 'todo_restrict_manage_posts' );
add_filter('parse_query','todo_convert_restrict');



/*
 * Ajax get more posts (Blog)
 */
add_action( 'wp_ajax_get_more_blog_posts', 'get_more_blog_posts' );
add_action( 'wp_ajax_nopriv_get_more_blog_posts', 'get_more_blog_posts' );
function get_more_blog_posts() {
	
	
	$page = @$_POST['page'] + 1;
	$s = $_POST['s'];
	$post_type = $_POST['post_type'];
	$posts_per_page = get_option( 'posts_per_page' );
	$orderby = isset($_POST['ordby']) ? $_POST['ordby'] : 'date';
	$order = (isset($_POST['ord']) && ($_POST['ord'] == 'asc' || $_POST['ord'] == 'desc')) ? $_POST['ord'] : 'desc';
	
	remove_all_filters('posts_orderby');
    $query = new WP_Query(array(
							'post_type' => $post_type,
							'posts_per_page' => $posts_per_page,
							'paged' => $page,
							's' => $s,
							'orderby' => $orderby,
							'order' => $order,
						)
					);
		
		//print_r($query);

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
				<div class="blog-post">
					<div class="title">
						<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
					</div>
					<a href="<?php the_permalink() ?>">
						<?php the_post_thumbnail('full', array('class' => 'post-img')) ?>
					</a>
					<div class="author"><?php if (get_field('author')) { ?> By <?php echo get_field('author') ?>, <?php } ?><span class="post-date"><?php the_date() ?></span></div>
					<div class="teaser">
						<p><?php the_excerpt() ?></p>
					</div>
					<a href="<?php the_permalink() ?>">Read More ></a>
						
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




// clear cache on every post save/update
function clear_page_cache($post_id) {
	global $post; 


	// clears out whole cache
	if (function_exists('w3tc_flush_all'))
	{
		w3tc_flush_all();
		error_log('whole cache cleared out!');
	}
	/*
	// clear only updated post
	if (function_exists('w3tc_pgcache_flush_post'))
	{

		w3tc_pgcache_flush_post($post_id);
		error_log('post ('.get_permalink($post_id).' - [post ID: '.$post_id.']) cache cleared');
	}*/
	
}
add_action( 'save_post', 'clear_page_cache' );


