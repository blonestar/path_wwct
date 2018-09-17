<?php

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



// template_blocks Taxonomy
function template_blocks_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Groups', 'Taxonomy General Name', 'worldwide' ),
		'singular_name'              => _x( 'Group', 'Taxonomy Singular Name', 'worldwide' ),
		'menu_name'                  => __( 'Groups', 'worldwide' ),
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
	register_taxonomy( 'template_blocks_tax', array( 'template_blocks' ), $args );
}
add_action( 'init', 'template_blocks_taxonomy', 0 );




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
		'slug'                  => 'in-the-news',
		'with_front'            => false,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'In The News', 'worldwide' ),
		'description'           => __( 'In The News', 'worldwide' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'taxonomies'			=> array('post_tag'),
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
function experts_post_type() {
	$labels = array(
		'name'                  => _x( 'Experts', 'Experts', 'worldwide' ),
		'singular_name'         => _x( 'Expert', 'Expert', 'worldwide' ),
		'menu_name'             => __( 'Experts', 'worldwide' ),
		'name_admin_bar'        => __( 'Experts', 'worldwide' ),
		'archives'              => __( 'Expert Archives', 'worldwide' ),
		'parent_item_colon'     => __( 'Parent Item:', 'worldwide' ),
		'all_items'             => __( 'All Experts', 'worldwide' ),
		'add_new_item'          => __( 'Add New Expert', 'worldwide' ),
		'add_new'               => __( 'Add New', 'worldwide' ),
		'new_item'              => __( 'New Expert', 'worldwide' ),
		'edit_item'             => __( 'Edit', 'worldwide' ),
		'update_item'           => __( 'Update', 'worldwide' ),
		'view_item'             => __( 'View', 'worldwide' ),
		'search_items'          => __( 'Search Experts', 'worldwide' ),
		'not_found'             => __( 'Not found', 'worldwide' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'worldwide' ),
		'featured_image'        => __( 'Person Image', 'worldwide' ),
		'set_featured_image'    => __( 'Set person image', 'worldwide' ),
		'remove_featured_image' => __( 'Remove person image', 'worldwide' ),
		'use_featured_image'    => __( 'Use as person image', 'worldwide' ),
		'insert_into_item'      => __( 'Insert into article', 'worldwide' ),
		'uploaded_to_this_item' => __( 'Uploaded to this article', 'worldwide' ),
		'items_list'            => __( 'Articles list', 'worldwide' ),
		'items_list_navigation' => __( 'Items list navigation', 'worldwide' ),
		'filter_items_list'     => __( 'Filter items list', 'worldwide' ),
	);
	$rewrite = array(
		'slug'                  => 'about-us/meet-the-experts',
		'with_front'            => false,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Expert', 'worldwide' ),
		'description'           => __( 'Worldwide Exprets', 'worldwide' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		'taxonomies'            => array( 'experts_tax' ),
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
	register_post_type( 'experts', $args );
}
add_action( 'init', 'experts_post_type', 0 );


// Register Careers Taxonomy
function experts_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Expert Categories', 'Taxonomy General Name', 'worldwide' ),
		'singular_name'              => _x( 'Expert Category', 'Taxonomy Singular Name', 'worldwide' ),
		'menu_name'                  => __( 'Expert Categories', 'worldwide' ),
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
	register_taxonomy( 'experts_tax', array( 'experts' ), $args );
}
add_action( 'init', 'experts_taxonomy', 0 );



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
		'slug'                  => 'resources/%resources_tax%',
		////'slug'                  => 'resources/resource-library/%resources_tax%',
		//'slug'                  => 'resources/resource-library/?resourcetype=%resources_tax%',
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
		'has_archive'           => true, // 'resources/resource-library',
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
		'slug'                       => 'resources/?resourcetype=%resources_tax%&url=',
		////'slug'                       => 'resources/resource-library/?resourcetype=%resources_tax%&url=',
		//'slug'                       => 'resources/resource-library',
		'with_front'                 => false,
		'hierarchical'               => true,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => false,
		'publicly_queryable'    	 => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
		//'default_term'				 => 'articles'

	);
	register_taxonomy( 'resources_tax', array( 'resources' ), $args );
}
add_action( 'init', 'resources_taxonomy');


function events_permalink_structure($post_link, $post, $leavename)
{
    if ( false !== strpos( $post_link, '%resources_tax%' ) ) {
		$resources_tax_term = get_the_terms( $post->ID, 'resources_tax' );
		//error_log(print_r($post, true));
		//error_log($post_link);
        $post_link = str_replace( '%resources_tax%', @array_pop( $resources_tax_term )->slug, $post_link );
    }
    return $post_link;
}
//add_filter('post_type', 'events_permalink_structure', 10, 4);
add_filter('post_type_link', 'events_permalink_structure', 10, 4);

// quick (and bit dirty) fix
function term_link_filter( $url, $term, $taxonomy ) {
	//error_log(print_r($url, true));
	//error_log(print_r($term, true));
	if ($term->taxonomy = 'resources_tax') {
		$url = preg_replace('~(\?|&)url=[^&]*~','$1',$url);
		$url = preg_replace('~\&$~','',$url);
	}
	return $url;
}
add_filter('term_link', 'term_link_filter', 10, 3);


function add_resource_category_automatically($post_ID) {
  global $wpdb;
    if(!has_term('','resources_tax',$post_ID)){
      $cat = 16; // All
      wp_set_object_terms($post_ID, $cat, 'resources_tax');
    }
}
add_action('publish_webinar', 'add_resource_category_automatically');



// Register Custom Taxonomy
function therapeutic_areas_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Therapeutic Areas', 'Taxonomy General Name', 'worldwide' ),
		'singular_name'              => _x( 'Therapeutic Area', 'Taxonomy Singular Name', 'worldwide' ),
		'menu_name'                  => __( 'Therapeutic Areas', 'worldwide' ),
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
	/*
	$rewrite = array(
		'slug'                       => 'resources/resource-library',
		'with_front'                 => false,
		'hierarchical'               => true,
	);
	*/
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		//'rewrite'                    => $rewrite,
		//'default_term'				 => 'articles'
	);
	register_taxonomy( 'therapeutic_areas_tax', array( 'resources' ), $args );
}
add_action( 'init', 'therapeutic_areas_taxonomy', 0 );





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
	$rewrite = array(
		'slug'                  => 'events',
		'with_front'            => false,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Events', 'worldwide' ),
		'description'           => __( 'Events', 'worldwide' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
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
		'rewrite'               => $rewrite,
		'capability_type'       => 'post',
	);
	register_post_type( 'events', $args );
}
add_action( 'init', 'events_post_type', 0 );





// Register Custom Taxonomy
function event_type_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Event Types', 'Taxonomy General Name', 'worldwide' ),
		'singular_name'              => _x( 'Event Type', 'Taxonomy Singular Name', 'worldwide' ),
		'menu_name'                  => __( 'Event Types', 'worldwide' ),
		'all_items'                  => __( 'All Event Types', 'worldwide' ),
		'parent_item'                => __( 'Parent Event Type', 'worldwide' ),
		'parent_item_colon'          => __( 'Parent Event Type:', 'worldwide' ),
		'new_item_name'              => __( 'New Event Type Name', 'worldwide' ),
		'add_new_item'               => __( 'Add New Event Type', 'worldwide' ),
		'edit_item'                  => __( 'Edit Event Type', 'worldwide' ),
		'update_item'                => __( 'Update Event Type', 'worldwide' ),
		'view_item'                  => __( 'View Event Type', 'worldwide' ),
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
	/*
	$rewrite = array(
		'slug'                       => 'resources/resource-library',
		'with_front'                 => false,
		'hierarchical'               => true,
	);*/
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		//'rewrite'                    => $rewrite,
		//'default_term'				 => 'articles'
	);
	register_taxonomy( 'event_type_tax', array( 'events' ), $args );
}
add_action( 'init', 'event_type_taxonomy', 0 );

// Register Custom Taxonomy
function event_category_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Categories', 'Taxonomy General Name', 'worldwide' ),
		'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'worldwide' ),
		'menu_name'                  => __( 'Categories', 'worldwide' ),
		'all_items'                  => __( 'All Categories', 'worldwide' ),
		'parent_item'                => __( 'Parent Category', 'worldwide' ),
		'parent_item_colon'          => __( 'Parent Category:', 'worldwide' ),
		'new_item_name'              => __( 'New Category Name', 'worldwide' ),
		'add_new_item'               => __( 'Add New Category', 'worldwide' ),
		'edit_item'                  => __( 'Edit Category', 'worldwide' ),
		'update_item'                => __( 'Update Category', 'worldwide' ),
		'view_item'                  => __( 'View Category', 'worldwide' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'worldwide' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'worldwide' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'worldwide' ),
		'popular_items'              => __( 'Popular Items', 'worldwide' ),
		'search_items'               => __( 'Search Category', 'worldwide' ),
		'not_found'                  => __( 'Not Found', 'worldwide' ),
		'no_terms'                   => __( 'No items', 'worldwide' ),
		'items_list'                 => __( 'Items list', 'worldwide' ),
		'items_list_navigation'      => __( 'Items list navigation', 'worldwide' ),
	);
	/*
	$rewrite = array(
		'slug'                       => 'resources/resource-library',
		'with_front'                 => false,
		'hierarchical'               => true,
	);*/
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		//'rewrite'                    => $rewrite,
		//'default_term'				 => 'articles'
	);
	register_taxonomy( 'event_category_tax', array( 'events' ), $args );
}
add_action( 'init', 'event_category_taxonomy', 0 );



// Register Custom Taxonomy
function locations_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Locations', 'Taxonomy General Name', 'worldwide' ),
		'singular_name'              => _x( 'Location', 'Taxonomy Singular Name', 'worldwide' ),
		'menu_name'                  => __( 'Locations', 'worldwide' ),
		'all_items'                  => __( 'All Locations', 'worldwide' ),
		'parent_item'                => __( 'Parent Location', 'worldwide' ),
		'parent_item_colon'          => __( 'Parent Location:', 'worldwide' ),
		'new_item_name'              => __( 'New Location Name', 'worldwide' ),
		'add_new_item'               => __( 'Add New Location', 'worldwide' ),
		'edit_item'                  => __( 'Edit Location', 'worldwide' ),
		'update_item'                => __( 'Update Location', 'worldwide' ),
		'view_item'                  => __( 'View Event Type', 'worldwide' ),
		'separate_items_with_commas' => __( 'Separate locations with commas', 'worldwide' ),
		'add_or_remove_items'        => __( 'Add or remove locations', 'worldwide' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'worldwide' ),
		'popular_items'              => __( 'Popular Locations', 'worldwide' ),
		'search_items'               => __( 'Search Locations', 'worldwide' ),
		'not_found'                  => __( 'Not Found', 'worldwide' ),
		'no_terms'                   => __( 'No items', 'worldwide' ),
		'items_list'                 => __( 'Locations list', 'worldwide' ),
		'items_list_navigation'      => __( 'Locations list navigation', 'worldwide' ),
	);
	/*
	$rewrite = array(
		'slug'                       => 'resources/resource-library',
		'with_front'                 => false,
		'hierarchical'               => true,
	);*/
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		//'rewrite'                    => $rewrite,
		//'default_term'				 => 'articles'
	);
	register_taxonomy( 'locations', array( 'events' ), $args );
}
add_action( 'init', 'locations_taxonomy', 0 );










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
	$args = (object)array(
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
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		//'rewrite'               => false,
		'capability_type'       => 'page',
	);
	register_post_type( 'landing', $args );
/*
	$post_type = 'landing';

    // these are your actual rewrite arguments
    //$args->rewrite = array(
    //    'slug' => 'landing'
    //);

    // everything what follows is from the register_post_type function
    if ( is_admin() || '' != get_option( 'permalink_structure' ) ) {

        if ( ! is_array( $args->rewrite ) )
            $args->rewrite = array();
        if ( empty( $args->rewrite['slug'] ) )
            $args->rewrite['slug'] = $post_type;
        if ( ! isset( $args->rewrite['with_front'] ) )
            $args->rewrite['with_front'] = true;
        if ( ! isset( $args->rewrite['pages'] ) )
            $args->rewrite['pages'] = true;
        if ( ! isset( $args->rewrite['feeds'] ) || ! $args->has_archive )
            $args->rewrite['feeds'] = (bool) $args->has_archive;
        if ( ! isset( $args->rewrite['ep_mask'] ) ) {
            if ( isset( $args->permalink_epmask ) )
                $args->rewrite['ep_mask'] = $args->permalink_epmask;
            else
                $args->rewrite['ep_mask'] = EP_PERMALINK;
        }

        if ( $args->hierarchical )
            add_rewrite_tag( "%$post_type%", '(.+?)', $args->query_var ? "{$args->query_var}=" : "post_type=$post_type&pagename=" );
        else
            add_rewrite_tag( "%$post_type%", '([^/]+)', $args->query_var ? "{$args->query_var}=" : "post_type=$post_type&name=" );

        if ( $args->has_archive ) {
            $archive_slug = $args->has_archive === true ? $args->rewrite['slug'] : $args->has_archive;
            if ( $args->rewrite['with_front'] )
                $archive_slug = substr( $wp_rewrite->front, 1 ) . $archive_slug;
            else
                $archive_slug = $wp_rewrite->root . $archive_slug;

            add_rewrite_rule( "{$archive_slug}/?$", "index.php?post_type=$post_type", 'top' );
            if ( $args->rewrite['feeds'] && $wp_rewrite->feeds ) {
                $feeds = '(' . trim( implode( '|', $wp_rewrite->feeds ) ) . ')';
                add_rewrite_rule( "{$archive_slug}/feed/$feeds/?$", "index.php?post_type=$post_type" . '&feed=$matches[1]', 'top' );
                add_rewrite_rule( "{$archive_slug}/$feeds/?$", "index.php?post_type=$post_type" . '&feed=$matches[1]', 'top' );
            }
            if ( $args->rewrite['pages'] )
                add_rewrite_rule( "{$archive_slug}/{$wp_rewrite->pagination_base}/([0-9]{1,})/?$", "index.php?post_type=$post_type" . '&paged=$matches[1]', 'top' );
        }

        $permastruct_args = $args->rewrite;
        $permastruct_args['feed'] = $permastruct_args['feeds'];
        add_permastruct( $post_type, "%$post_type%", $permastruct_args );
    }
*/
}
add_action( 'init', 'landing_post_type', 0 );

/*

add_filter('post_type_link', 'custom_post_type_link', 10, 3);
function custom_post_type_link($permalink, $post, $leavename) {
    if (!gettype($post) == 'landing') {
        return $permalink;
    }
    switch ($post->post_type) {
        case 'landing':

			//print_r($post);
			//exit;
			//echo "<br>";
			$ancestors = get_post_ancestors($post);
			error_log(print_r($ancestors, true));

			if (!empty($ancestors)) {
				foreach($ancestors as $key => $ancestor) {
					$anc = get_post( $ancestor );
					$slug_arr[] = $anc->post_name;
				}
				$slug_arr[] = $post->post_name;
				$permalink = get_home_url(). '/' . implode($slug_arr, '/');
				//print_r($slug_arr);
			} else
	            $permalink = get_home_url() . '/' . $post->post_name . '/';
			//$permalink = get_the_permalink( $post->ID );
            break;
    }
 
    return $permalink;
}




add_action('pre_get_posts', 'custom_pre_get_posts');
function custom_pre_get_posts($query) {
    global $wpdb;
 
    if(!$query->is_main_query()) {
        return;
    }
 
    $post_name = $query->get('pagename');
 
    $post_type = $wpdb->get_var(
        $wpdb->prepare(
            'SELECT post_type FROM ' . $wpdb->posts . ' WHERE post_name = %s LIMIT 1',
            $post_name
        )
    );
 
    switch($post_type) {
        case 'landing':
            $query->set('landing', $post_name);
            $query->set('post_type', $post_type);
            $query->is_single = true;
            $query->is_page = false;
            break;
    }
}

*/

/** OLD!!!!!




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
		//print_r($rules);
        # We no longer need the attachment rules, so strip them out
        foreach ( $this->rules as $regex => $value ) {
            if ( strpos( $value, 'attachment' ))
                unset( $this->rules[ $regex ] );
        }
		//print_r($this->rules);
		//exit;
        return array();
    }
    public function inject_landing_rules( $rules ) {
        # This is the first 'page' rule
        $offset = array_search( '(.?.+?)/trackback/?$', array_keys( $rules ) );
        $page_rules = array_slice( $rules, $offset, null, true );
        $other_rules = array_slice( $rules, 0, $offset, true );
        $rules = array_merge( $other_rules, $this->rules, $page_rules );
		//print_r($rules);
		//exit;
		return $rules;
    }
}
Landing_Pages_Rewrites::instance();
endif;

// fix blog paging
function custom_rewrite_basic() {
	add_rewrite_rule( '^blog/page/?([0-9]{1,})/?$', 'index.php?post_type=post&paged=$matches[1]' , 'top');
	//add_rewrite_rule( '^resources/assay-methods-search/?$', 'index.php?post_type=page&pagename=assay-methods-search' , 'top');
}
add_action('init', 'custom_rewrite_basic');



add_filter( 'template_include', 'landing_template_page' );
function landing_template_page( $original_template ) {
	global $post;
	if ( @$post->post_type == 'landing' )
		return get_template_directory() . '/template-landing/' . get_field('landing_template_file');
	return $original_template;
}


// Register Custom Post Type
function studies_post_type() {

	$labels = array(
		'name'                  => _x( 'Studies', 'Post Type General Name', 'worldwide' ),
		'singular_name'         => _x( 'Study', 'Post Type Singular Name', 'worldwide' ),
		'menu_name'             => __( 'Studies', 'worldwide' ),
		'name_admin_bar'        => __( 'Studies', 'worldwide' ),
		'archives'              => __( 'Item Archives', 'worldwide' ),
		'parent_item_colon'     => __( 'Parent Item:', 'worldwide' ),
		'all_items'             => __( 'All Studies', 'worldwide' ),
		'add_new_item'          => __( 'Add New Item', 'worldwide' ),
		'add_new'               => __( 'Add New', 'worldwide' ),
		'new_item'              => __( 'New Item', 'worldwide' ),
		'edit_item'             => __( 'Edit Item', 'worldwide' ),
		'update_item'           => __( 'Update Item', 'worldwide' ),
		'view_item'             => __( 'View Item', 'worldwide' ),
		'search_items'          => __( 'Search Item', 'worldwide' ),
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
		'slug'                  => 'participate-in-a-study/current-studies/study',
		'with_front'            => false,
		'pages'                 => false,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Study', 'worldwide' ),
		'description'           => __( 'Studies', 'worldwide' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'page-attributes', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-welcome-learn-more',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false, //'current-studies',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( 'studies', $args );

}
add_action( 'init', 'studies_post_type', 0 );




// Register Custom Post Type
function faq_post_type() {

	$labels = array(
		'name'                  => _x( 'FAQs', 'Post Type General Name', 'worldwide' ),
		'singular_name'         => _x( 'FAQ', 'Post Type Singular Name', 'worldwide' ),
		'menu_name'             => __( 'FAQ', 'worldwide' ),
		'name_admin_bar'        => __( 'FAQ', 'worldwide' ),
		'archives'              => __( 'FAQ Archives', 'worldwide' ),
		'parent_item_colon'     => __( 'Parent Item:', 'worldwide' ),
		'all_items'             => __( 'All FAQs', 'worldwide' ),
		'add_new_item'          => __( 'Add New FAQ', 'worldwide' ),
		'add_new'               => __( 'Add New', 'worldwide' ),
		'new_item'              => __( 'New FAQ', 'worldwide' ),
		'edit_item'             => __( 'Edit FAQ', 'worldwide' ),
		'update_item'           => __( 'Update FAQ', 'worldwide' ),
		'view_item'             => __( 'View FAQ', 'worldwide' ),
		'search_items'          => __( 'Search FAQ', 'worldwide' ),
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
		'label'                 => __( 'FAQ', 'worldwide' ),
		'description'           => __( 'Frequently Asked Questions', 'worldwide' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'page-attributes', ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-format-chat',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => false,
		'capability_type'       => 'page',
	);
	register_post_type( 'faq', $args );

}
add_action( 'init', 'faq_post_type', 0 );








// Register Custom Post Type
function awards_post_type() {
	$labels = array(
		'name'                  => _x( 'Awards & Accolades', 'Post Type General Name', 'worldwide' ),
		'singular_name'         => _x( 'Award/Accolade', 'Post Type Singular Name', 'worldwide' ),
		'menu_name'             => __( 'Awards & Accolades', 'worldwide' ),
		'name_admin_bar'        => __( 'Awards & Accolades', 'worldwide' ),
		'archives'              => __( 'Page Archives', 'worldwide' ),
		'parent_item_colon'     => __( 'Parent Page:', 'worldwide' ),
		'all_items'             => __( 'All Awards/Accolades', 'worldwide' ),
		'add_new_item'          => __( 'Add New Award/Accolade', 'worldwide' ),
		'add_new'               => __( 'Add New', 'worldwide' ),
		'new_item'              => __( 'New Award/Accolade', 'worldwide' ),
		'edit_item'             => __( 'Edit Award/Accolade', 'worldwide' ),
		'update_item'           => __( 'Update Award/Accolade', 'worldwide' ),
		'view_item'             => __( 'View Award/Accolade', 'worldwide' ),
		'search_items'          => __( 'Search Award/Accolade', 'worldwide' ),
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
	//$rewrite = array(
	//	'slug'                       => 'landing',
	//	'with_front'                 => false,
	//	'hierarchical'               => true,
	//);
	$args = array(
		'label'                 => __( 'Awards & Accolades', 'worldwide' ),
		'description'           => __( 'All Worldwide Clinic Trials Awards & Accolades', 'worldwide' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', /*'page-attributes',*/ 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-awards',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		//'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( 'awards', $args );
}
add_action( 'init', 'awards_post_type', 0 );



// Register Custom Post Type
function hero_post_type() {
	$labels = array(
		'name'                  => _x( 'Hero/Headers', 'Post Type General Name', 'worldwide' ),
		'singular_name'         => _x( 'Hero/Headers', 'Post Type Singular Name', 'worldwide' ),
		'menu_name'             => __( 'Hero/Headers', 'worldwide' ),
		'name_admin_bar'        => __( 'Hero/Headers', 'worldwide' ),
		'archives'              => __( 'Page Archives', 'worldwide' ),
		'parent_item_colon'     => __( 'Parent Page:', 'worldwide' ),
		'all_items'             => __( 'All Items', 'worldwide' ),
		'add_new_item'          => __( 'Add New Hero', 'worldwide' ),
		'add_new'               => __( 'Add New', 'worldwide' ),
		'new_item'              => __( 'New Hero', 'worldwide' ),
		'edit_item'             => __( 'Edit Hero', 'worldwide' ),
		'update_item'           => __( 'Update Hero', 'worldwide' ),
		'view_item'             => __( 'View Hero', 'worldwide' ),
		'search_items'          => __( 'Search Hero', 'worldwide' ),
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
	//$rewrite = array(
	//	'slug'                       => 'landing',
	//	'with_front'                 => false,
	//	'hierarchical'               => true,
	//);
	$args = array(
		'label'                 => __( 'Hero Images/Sliders', 'worldwide' ),
		'description'           => __( 'Sceduled Heros', 'worldwide' ),
		'labels'                => $labels,
		'supports'              => array( 'title'  ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-desktop',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		//'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( 'hero', $args );
}
add_action( 'init', 'hero_post_type', 0 );


