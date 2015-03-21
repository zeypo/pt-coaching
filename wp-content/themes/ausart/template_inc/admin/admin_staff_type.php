<?php
add_action('init', 'staff_register', 1);

/**
 * portfolio_register()
 * 
 * @return
 */
function staff_register() 
{

	$labels = array(
		'name' => _x('Team', 'post type general name', 'themeple'),
		'singular_name' => _x('Staff Entry', 'post type singular name', 'themeple'),
		'add_new' => _x('Add New', 'staff', 'themeple'),
		'add_new_item' => __('Add New Staff Entry', 'themeple'),
		'edit_item' => __('Edit Staff Entry', 'themeple'),
		'new_item' => __('New Staff Entry', 'themeple'),
		'view_item' => __('View Staff Entry', 'themeple'),
		'search_items' => __('Search Staff Entries', 'themeple'),
		'not_found' =>  __('No Staff Entries found', 'themeple'),
		'not_found_in_trash' => __('No Staff Entries found in Trash', 'themeple'), 
		'parent_item_colon' => ''
	);
	
	$slugRule = "staff_trusted";
	
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug'=>$slugRule,'with_front'=>true),
		'query_var' => true,
		'show_in_nav_menus'=> false,
		'supports' => array('title','thumbnail','editor')
	);
	
	
	
	register_post_type( 'staff' , $args );
	
	
	register_taxonomy("staff_entries", 
		array("staff"), 
		array(	"hierarchical" => true, 
		"label" => "Staff Categories", 
		"singular_label" => "Staff Categories", 
		"rewrite" => true,
		"query_var" => true
	));  
}

add_filter("manage_edit-staff_columns", "prod_edit_staff_columns");
add_action("manage_posts_custom_column",  "prod_custom_staff_columns");

/**
 * prod_edit_columns()
 * 
 * @param mixed $columns
 * @return
 */
function prod_edit_staff_columns($columns)
{
	$newcolumns = array(
		"cb" => "<input type=\"checkbox\" />",
		
		"title" => "Title",
		"staff_entries" => "Categories"
	);
	
	$columns= array_merge($newcolumns, $columns);
	
	return $columns;
}

/**
 * prod_custom_columns()
 * 
 * @param mixed $column
 * @return
 */
function prod_custom_staff_columns($column)
{
	global $post;
	switch ($column)
	{
		
	
		case "description":
		
		break;
		case "price":
		
		break;
		case "staff_entries":
		echo get_the_term_list($post->ID, 'staff_entries', '', ', ','');
		break;
	}
}
?>