<?php

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
	$current_user = wp_get_current_user();
	$email_splitted = explode("@", $current_user->user_email);

	// show to path admin user only (any email @pathinteractive.com)
	if ($email_splitted[1] != 'pathinteractive.com')
		return false;

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
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Experts',
		'menu_title'	=> 'Experts',
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
    //print_r($screen);
	if ( $screen->base == 'post' || $screen->base == 'wordwide-settings_page_acf-options-footer') {
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
 * /
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
	
}*/


/*
 * ACF - get template block from ./template-blocks folder
 */
function get_template_blocks($page_id) {

	if (get_field('template_block_hide',$page_id))
		return;

	if( have_rows('template_blocks', $page_id) ):
		while ( have_rows('template_blocks', $page_id) ) : the_row();
			$class = '';
			$style = '';
			if (get_row_layout() == "template_block") {
				$templ = get_sub_field('template_block' );
				if (get_sub_field('hide')  !== true)
					get_template_blocks($templ->ID);
				
			} else {
				
				if (get_sub_field('hide')  !== true) {
					//echo get_row_layout();
					if (file_exists(get_template_directory() . "/template-blocks/" . get_row_layout() . ".php")) {

						$container = 'container';
						$no_gutters = '';
						if (get_sub_field('block_full_screen_width')) {
							$container = 'container-fluid';
							$no_gutters = ' no-gutters';
						}

						$tag = trim(get_sub_field('block_tag')); // TODO
						if ($tag == '')
							$tag = 'section';

						$id = trim(get_sub_field('block_id'));
						if ($id != '')
							$id = ' id="'.$id.'"';

						// add classes
						$class[] = 'template-block';
						$class[] = get_row_layout();
						$class[] = trim(get_sub_field('block_class'));
						$class[] = 'id-'.$page_id;


						if (get_field('template_block_sticky'))
							$class[] = 'sticky-top';

						if (get_sub_field('white_text'))
							$class[] = 'text-white';
							
						if (is_array($class)) {
							$class = implode(' ', array_filter($class));
							$class = ' class="'.$class.'"';
						}

						// add margin styles
						$block_margin = trim(get_sub_field('block_margin'));
						if ($block_margin != '')
							$style[] = 'margin: ' . $block_margin;

						// add padding styles
						$block_padding = trim(get_sub_field('block_padding'));
						if ($block_padding != '')
							$style[] = 'padding: ' . $block_padding;


						// add styles
						if (get_sub_field('background_color') != '' && !get_sub_field('have_background_image'))
							$style[] = 'background-color: '.get_sub_field('background_color');
							
						if (get_sub_field('have_background_image')) {
							$style[] = 'background: url('.get_sub_field('background_image').') center center no-repeat';
							$style[] = 'background-size: cover';
						}
						if (is_array($style)) {
							$style = implode('; ', array_filter($style));
							$style = preg_replace('/;+/', ';', trim($style).';');
							$style = ' style="'.$style.'"';
						}

						include(get_template_directory() . "/template-blocks/" . get_row_layout() . ".php");
					} else {

						error_log('Error, Template Block file missing! - ' . "/template-blocks/" . get_row_layout());

						//if ()
						//echo "<div class=\"container\"><div class=\"row\"><div class=\"col text-center\"><br><p>Template block file missing!<br>/template-blocks/" . get_row_layout() . ".php</p><br></div></div></div>";
					}
				}
			}
			
		endwhile;
	endif;
	
}


/*
function get_template_widgets($page_id) {
	
	if( have_rows('widgets', $page_id) ):
		while ( have_rows('widgets', $page_id) ) : the_row();
		
			get_template_blocks(get_sub_field('widget'));
	
		endwhile;
		
	endif;
	
}
*/

function get_template_widgets($page_id) {
	
	if( have_rows('template_widgets', $page_id) ):
		while ( have_rows('template_widgets', $page_id) ) : the_row();
		
			if (get_sub_field('hide')  !== true) {
					if (file_exists(get_template_directory() . "/template-widgets/" . get_row_layout() . ".php")) {

						include(get_template_directory() . "/template-widgets/" . get_row_layout() . ".php");
					} else {
						echo "<div class=\"container\"><div class=\"row\"><div class=\"col text-center\"><br><p>Template widget file missing!<br>/template-widgets/" . get_row_layout() . ".php</p><br></div></div></div>";
					}
			}
	
		endwhile;
		
	endif;
	
}



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

	//echo "AAAAA\n<br>\n";
	//print_r($match);
	//print_r($rule);
	//print_r($options);
	//print_r($post);
	//echo "AAAAA\n<br>\n";
	//echo get_the_ID();
	
	//$post_value = get_field('landing_template_file', $options['post_id']);
	$post_value = get_field('landing_template_file');
	$selected = @$rule['value'];
	if ($post && $selected) { // post parent
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

// get all sidebars
function acf_get_all_sidebars()
{
    global $wp_registered_sidebars;
    $sidebars = $wp_registered_sidebars;
    $sidebar_options = array();
    foreach ( $sidebars as $sidebar ){
       $sidebar_options[$sidebar['id']] = $sidebar['name'];
    }
    //var_dump($sidebar_options); // debug
    return $sidebar_options;
}
add_action('init', 'acf_get_all_sidebars');


/*
 * ACF Sidebar Loader
 */
 
function my_acf_load_sidebar( $field )
{
 // reset choices
 $field['choices'] = array();
 $field['choices']['default-sidebar'] = 'Default Sidebar';
 $field['choices']['none'] = 'No Sidebar';
 // load repeater from the options page
 if(get_field('sidebars', 'option'))
 {
 // loop through the repeater and use the sub fields "value" and "label"
 while(has_sub_field('sidebars', 'option'))
 {
 
 $label = get_sub_field('sidebar_name');
 $value = str_replace(" ", "-", $label);
 $value = strtolower($value);
 
$field['choices'][ $value ] = $label;
 
}
 }
 
 // Important: return the field
 return $field;
}
 
add_filter('acf/load_field/name=select_a_sidebar', 'my_acf_load_sidebar');