<?php

add_action('init', 'testimonial_register', 1);



/**

 * portfolio_register()

 * 

 * @return

 */

function testimonial_register() 

{



	$labels = array(

		'name' => _x('Testimonials', 'post type general name', 'themeple'),

		'singular_name' => _x('Testimonial Entry', 'post type singular name', 'themeple'),

		'add_new' => _x('Add New', 'testimonial', 'themeple'),

		'add_new_item' => __('Add New Testimonial Entry', 'themeple'),

		'edit_item' => __('Edit Testimonial Entry', 'themeple'),

		'new_item' => __('New Testimonial Entry', 'themeple'),

		'view_item' => __('View Testimonial Entry', 'themeple'),

		'search_items' => __('Search Testimonial Entries', 'themeple'),

		'not_found' =>  __('No Testimonial Entries found', 'themeple'),

		'not_found_in_trash' => __('No Testimonial Entries found in Trash', 'themeple'), 

		'parent_item_colon' => ''

	);

	

	$slugRule = "testimonial_trusted";

	

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

	

	

	

	register_post_type( 'testimonial' , $args );

	

	

	register_taxonomy("testimonial_entries", 

		array("testimonial"), 

		array(	"hierarchical" => true, 

		"label" => "Testimonial Categories", 

		"singular_label" => "Testimonial Categories", 

		"rewrite" => true,

		"query_var" => true

	));  

}



add_filter("manage_edit-testimonial_columns", "prod_edit_testimonial_columns");

add_action("manage_posts_custom_column",  "prod_custom_testimonial_columns");



/**

 * prod_edit_columns()

 * 

 * @param mixed $columns

 * @return

 */

function prod_edit_testimonial_columns($columns)

{

	$newcolumns = array(

		"cb" => "<input type=\"checkbox\" />",

		"title" => "Title",

		"testimonial_entries" => "Categories"

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

function prod_custom_testimonial_columns($column)

{

	global $post;

	switch ($column)

	{

		

	

		case "description":

		

		break;

		case "price":

		

		break;

		case "testimonial_entries":

		echo get_the_term_list($post->ID, 'testimonial_entries', '', ', ','');

		break;

	}

}

?>