<?php

//include widgets
include "widget_subpages_tree.php";
//include "widget_simple_text.php";
include "widget_image_text.php";
include "widget_simple_social.php";
include "widget_search_form.php";
include "widget_green_with_button.php";
include "widget_files.php";

// register widgets
function register_Subpages_Tree_Widget() {
    register_widget( 'Subpages_Tree_Widget' );
    //register_widget( 'Simple_Text_Widget' );
    register_widget( 'Image_Text_Widget' );
    register_widget( 'Simple_Social_Widget' );
    register_widget( 'Search_Form_Widget' );
    register_widget( 'Green_with_Button_Widget' );
    register_widget( 'Files_Widget' );
}
add_action( 'widgets_init', 'register_Subpages_Tree_Widget' );