<?php

add_action('init', 'portfolio_register', 1);



/* Register portfolio post type */

function portfolio_register() 

{



	$labels = array(

		'name' => _x('Portfolio Items', 'post type general name', 'themeple'),

		'singular_name' => _x('Portfolio Entry', 'post type singular name', 'themeple'),

		'add_new' => _x('Add New', 'portfolio', 'themeple'),

		'add_new_item' => __('Add New Portfolio Entry', 'themeple'),

		'edit_item' => __('Edit Portfolio Entry', 'themeple'),

		'new_item' => __('New Portfolio Entry', 'themeple'),

		'view_item' => __('View Portfolio Entry', 'themeple'),

		'search_items' => __('Search Portfolio Entries', 'themeple'),

		'not_found' =>  __('No Portfolio Entries found', 'themeple'),

		'not_found_in_trash' => __('No Portfolio Entries found in Trash', 'themeple'), 

		'parent_item_colon' => ''

	);

	

	$slugRule = themeple_get_option("portfolio_slug");

	

	$args = array(

		'labels' => $labels,

		'public' => true,

		'show_ui' => true,

		'capability_type' => 'post',

		'hierarchical' => false,

		'rewrite' => array('slug'=>$slugRule,'with_front'=>true),

		'query_var' => true,

		'show_in_nav_menus'=> false,

		'supports' => array('title','thumbnail','excerpt','editor','comments')

	);

	

	

	

	register_post_type( 'portfolio' , $args );

	

	

	register_taxonomy("portfolio_entries", 

		array("portfolio"), 

		array(	"hierarchical" => true, 

		"label" => "Portfolio Categories", 

		"singular_label" => "Portfolio Categories", 

		"rewrite" => true,

		"query_var" => true

	));  

}



add_filter("manage_edit-portfolio_columns", "prod_edit_columns");

add_action("manage_posts_custom_column",  "prod_custom_columns");



function prod_edit_columns($columns)

{

	$newcolumns = array(

		"cb" => "<input type=\"checkbox\" />",

		

		"title" => "Title",

		"portfolio_entries" => "Categories"

	);

	

	$columns= array_merge($newcolumns, $columns);

	

	return $columns;

}



function prod_custom_columns($column)

{

	global $post;

	switch ($column)

	{

	

		case "description":

		

		break;

		case "price":

		

		break;

		case "portfolio_entries":

		echo get_the_term_list($post->ID, 'portfolio_entries', '', ', ','');

		break;

	}

}

?>