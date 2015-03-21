<?php

add_action('init', 'faq_register');



/* FAQ Register function */

function faq_register() 

{



	$labels = array(

		'name' => _x('Faq', 'post type general name','themeple'),

		'singular_name' => _x('Faq Entry', 'post type singular name', 'themeple'),

		'add_new' => _x('Add New', 'faq', 'themeple'),

		'add_new_item' => __('Add New Faq Entry', 'themeple'),

		'edit_item' => __('Edit Faq Entry', 'themeple'),

		'new_item' => __('New Faq Entry', 'themeple'),

		'view_item' => __('View Faq Entry', 'themeple'),

		'search_items' => __('Search Faq Entries', 'themeple'),

		'not_found' =>  __('No Faq Entries found', 'themeple'),

		'not_found_in_trash' => __('No Faq Entries found in Trash', 'themeple'), 

		'parent_item_colon' => ''

	);

	

	$slugRule = "Faq_quare";

	

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

	

	

	

	register_post_type( 'faq' , $args );

	

	

	register_taxonomy("faq_entries", 

		array("faq"), 

		array(	"hierarchical" => true, 

		"label" => "Faq Categories", 

		"singular_label" => "Faq Categories", 

		"rewrite" => true,

		"query_var" => true

	));  

}



add_filter("manage_edit-faq_columns", "prod_edit_faq_columns");

add_action("manage_posts_custom_column",  "prod_custom_faq_columns");


function prod_edit_faq_columns($columns)

{

	$newcolumns = array(

		"cb" => "<input type=\"checkbox\" />",

		

		"title" => "Title",

		"staff_entries" => "Categories"

	);

	

	$columns= array_merge($newcolumns, $columns);

	

	return $columns;

}



function prod_custom_faq_columns($column)

{

	global $post;

	switch ($column)

	{

		

	

		case "description":

		

		break;

		case "price":

		

		break;

		case "faq_entries":

		echo get_the_term_list($post->ID, 'faq_entries', '', ', ','');

		break;

	}

}

?>