<?php


function wwct_get_sidebar($sidebar) {

    if ($sidebar['type'] == 'standard') {
        dynamic_sidebar( $sidebar['sidebar'] );
    } 
    
    if ($sidebar['type'] == 'custom') {  // will be depricated
        get_template_widgets($sidebar['page_id']);
    }
}





function wwct_get_sidebar_data($page_id = false) {

    static $sidebar = array();

    if ($page_id === false) {
        global $post;
        $page_id = $post->ID;
    }
    
    $sidebar_type = get_field('sidebar_type', $page_id);

    if ($sidebar_type == 'inherit') {
        $inherited_pages_sidebar = get_post_ancestors( $page_id );
            
        foreach($inherited_pages_sidebar as $parent_page_id) {
            if (get_field('sidebar_type', $parent_page_id) != 'inherit') {
                wwct_get_sidebar_data($parent_page_id);
            }
        } 
    }

    if ($sidebar_type == 'standard') {

        $sidebar['page_id'] = $page_id;
        $sidebar['type'] = 'standard';
        $sidebar['sidebar'] = get_field('sidebar', $page_id);
        $sidebar['side'] = get_field('sidebar_side', $page_id);
        $sidebar['columns'] = get_field('sidebar_column_width', $page_id);
    } 
    
    if ($sidebar_type == 'custom' || (is_null($sidebar_type)  && get_field('show_sidebar', $page_id)  ) ) {  // will be depricated
        
        $sidebar['page_id'] = $page_id;
        $sidebar['type'] = 'custom';
        //$sidebar['widgets'] = get_template_widgets($page_id);
        $sidebar['side'] = get_field('sidebar_side', $page_id);
        $sidebar['columns'] = get_field('sidebar_column_width', $page_id);
    }

    return $sidebar;
}