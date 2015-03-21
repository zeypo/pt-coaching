<?php



/* RECENT PORTFOLIO  */



$elements[] = array(



	"dynamic" => "recent_portfolio",

	"name" => __("Featured Portfolio", 'themeple'),

	"type" => "layout_section",

	"id" => "dynamic_recent_portfolio",

	"removable" => "remove element",

	"default_size" => 12,

	"subelements" => array(



						



								array(    

					                                   "name"    => "Block Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "dynamic_title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

						),


							array( 

									"id" => "desc_bool",

									"type" => "switchbutton",

									"name" => "Do you want Description in the left ?",

									"std" => "no"

								),

						array( 

									"id" => "desc_text",

									"type" => "textarea",

									"name" => "Description",

									"required" => array("desc_bool", "yes")

								),

						
						

								array(    

                                                            "name"              => "Portfolio Style",

                                                         

                                                            "desc"              => "",

                                                            "id"                => "portfolio_style",

                                                            "type"              => "select",

                                                            "std"               => 'v1',

                                                            "no_first"          => true,

                                                            "subtype"           => array('First Version' => 'v1', 'Second Version' => 'v2', 'Third Version' => 'v3')

                                                       ),

												  array(    

                                                            "name"              => "Do you want to show title and description after the image?",

                                                            "desc"              => "",

                                                            'std'               => 'no',

                                                            "id"                => "show_text_bool",

                                                            "type"              => "switchbutton",

                                                            "required"           => array('portfolio_style', 'v3')

                                                       ),

                                                  array(    

                                                            "name"              => "Select the way you want to show the items",

                                                 

                                                            "desc"              => "",

                                                            'std'               => 'normal_mode',

                                                            "no_first"          => true,

                                                            "id"                => "show_type",

                                                            "type"              => "select",

                                                            "subtype"           => array("None" => "normal_mode",  'Masonry' => 'masonry', 'List' => 'list')

                                                       ),



								array(

									"name" => "Portfolio Rows",

									"id" => "rows",

									"type" => "select",
									
									"no_first" => true,

									"std" => '1',
									
									"subtype" => array("One Row" => '1', "Two Rows" => "2")

								),


								 array(

									"name" 	=> "Block Size:",

									"desc" 	=> "This mean that if you select 1/4 and you choose a 100% row, should be display 4 items. Be sure that items are in exact proporcion with the column percentage. For example you cant use a 1/4 with 66% column or 1/3 with 75% column ",

									"id" 	=> "dynamic_block_size",

									"type" 	=> "select",

									"no_first" => "true",

									"subtype" => array("1/4" => 4, '1/3' => 3, '1/2' => 2, '1/1' => 1)

								),



								array( 

									"id" => "dynamic_size",

									"type" => "hidden",

									"std" => 12

								),

								array( 

									"id" => "dynamic_from_where",

									"type" => "select",

									"name" => "Set featured Portfolio:",

									"no_first" => true,

									"subtype" => array("Show Portfolio from all categories" => "all_cat", "Select a specific Category" => "cat")

								),

								array( 

									"id" => "dynamic_cat",

									"type" => "select",

									"taxonomy" => "portfolio_entries",

									"name" => "Select the category:",

									"subtype" => "cat",

									"required" => array("dynamic_from_where", "cat")

								)



		)



);

$elements[] = array(



	"dynamic" => "fullwidth_portfolio",

	"name" => __("Fullwidth Portfolio", 'themeple'),

	"type" => "layout_section",

	"id" => "dynamic_fullwidth_port",

	"removable" => "remove element",

	"default_size" => 12,

	"subelements" => array(

			array( 

									"id" => "dynamic_size",

									"type" => "hidden",

									"std" => 12

			)

	)
);

/* RECENT PORTFOLIO END */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* Recent News */

 

$elements[] =	array(	

				"dynamic"		=> 'recent_news',

				"name" 			=> __("Recent News", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_recent_news", 

				"removable"  => 'remove element',

				"default_size" => 6,

				"nodescription" => true,

				'subelements' 	=> array(	

						

						



								array(    

					                                   "name"    => "Block Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "dynamic_title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

						),

						 
								array(

									"name" => "Style",

									"id" => "style",

									"type" => "select",

									"no_first" => true,

									"subtype" => array('With Icon' => 'icon', 'With Image' => 'image')

									

								),

								array(

									"name" => "Number of posts",

									"id" => "posts_per_page",

									"type" => "input_text",

									"std" => "2"

									

								),


								



						array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 6

								),

						array( 

									"id" => "dynamic_from_where",

									"type" => "select",

									"name" => "Set Headlines From Blog",

									"no_first" => true,

									"subtype" => array("Show headlines from all categories" => "all_cat", "Select a specific Category" => "cat")

								),

								array( 

									"id" => "dynamic_cat",

									"type" => "select",

									"name" => "Select the category:",

									"subtype" => "cat",

									"required" => array("dynamic_from_where", "cat")

								)

						

								

					   	

					            



				)

			);


/* ----------------------------------------------- */
/* ----------------------------------------------- */





/* LATEST BLOG */



$elements[] =	array(	

				"dynamic"		=> 'latest_blog',

				"name" 			=> __("Latest From Blog", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_latest_blog", 

				"removable"  => 'remove element',

				"default_size" => 12,

				"nodescription" => true,

				'subelements' 	=> array(	

						

						



								array(    

					                                   "name"    => "Block Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "dynamic_title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

						),




						array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 12

								),

						array( 

									"id" => "dynamic_from_where",

									"type" => "select",

									"name" => "Set Headlines From Blog",

									"no_first" => true,

									"subtype" => array("Show headlines from all categories" => "all_cat", "Select a specific Category" => "cat")

								),

								array( 

									"id" => "dynamic_cat",

									"type" => "select",

									"name" => "Select the category:",

									"subtype" => "cat",

									"required" => array("dynamic_from_where", "cat")

								)


				)

			);



/* LATEST BLOG END */

/* LATEST BLOG EFFECT */



$elements[] =	array(	

				"dynamic"		=> 'latest_blog_effect',

				"name" 			=> __("Latest From Blog Creative", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_latest_blog_effect", 

				"removable"  => 'remove element',

				"default_size" => 12,

				"nodescription" => true,

				'subelements' 	=> array(	

						

						



								array(    

					                                   "name"    => "Block Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "dynamic_title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

						),




						array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 12

								),

						array( 

									"id" => "dynamic_from_where",

									"type" => "select",

									"name" => "Set Headlines From Blog",

									"no_first" => true,

									"subtype" => array("Show headlines from all categories" => "all_cat", "Select a specific Category" => "cat")

								),

								array( 

									"id" => "dynamic_cat",

									"type" => "select",

									"name" => "Select the category:",

									"subtype" => "cat",

									"required" => array("dynamic_from_where", "cat")

								)


				)

			);



/* LATEST BLOG EFFECT END */


$elements[] = array(



	"dynamic" => "fullwidth_blog",

	"name" => __("Fullwidth Blog", 'themeple'),

	"type" => "layout_section",

	"id" => "dynamic_fullwidth_blog",

	"removable" => "remove element",

	"default_size" => 12,

	"subelements" => array(

			array( 

									"id" => "dynamic_size",

									"type" => "hidden",

									"std" => 12

			)

	)
);

/* HOME BLOG */

      $elements[] =	array(	

				"dynamic"		=> 'home_blog',

				"name" 			=> __("Full Blog", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_home_blog", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 12,

				"nodescription" => true,

				'subelements' 	=> array(	



							array(    

					                                   "name"    => "Block Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "dynamic_title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

						),


							array(    

					                                   "name"    => "Style:",

					                                   "desc"    => "",

					                                   "id"      => "style",

					                                   "std"     => "index",

					                                   "subtype" => array('Normal' => 'index', 'Second Style' => 'blog-second-style', 'Grid' => 'blog-grid', 'Masonry' => 'blog-masonry'),

					                                   "type"    => "select"

						),


					        array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 12

								)





					)





	);			



/* END BLOG */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */



/** Home Portfolio Element **/
	  $elements[] =	array(	
					"dynamic"		=> 'home_portfolio',
					"name" 			=> __("Full Portfolio", 'themeple'),
					"slug"			=> "",
					"type" 			=> "layout_section", 
					"id" 			=> "dynamic_home_portfolio", 
					"removable"  => 'remove element',
					"blank" 		=> true, 
					"default_size" => 12,
					"nodescription" => true,
					'subelements' 	=> array(	

								array(
										"name" => "Nr of columns",
										"id" => "dynamic_columns",
										"type" => "select",
										"std" => "",
										"subtype" => array("One Column" => 1, "Two Columns" => 2, "Three Columns" => 3, "Four Columns" => 4)
										
									),
								array(
										"name" => "Portfolio Page",
										"id" => "portfolio_selected",
										"type" => "select",
										"std" => "",
										"subtype" => 'page'
										
									),

								array(
										"name" => "Style",
										"id" => "style",
										"type" => "select",
										"std" => "portfolio-grid",
										"subtype" => array("Grid" => 'portfolio-grid', 'Masonry' => 'portfolio-masonry', 'List' => 'portfolio-list')
										
									),

								
						        array( 
									"id" => "dynamic_size",
									"type" => "hidden",
									"std" => 12
									)


						)






		);			







/** End Home Portfolio Element **/



/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* FAQ */

      $elements[] =	array(	

				"dynamic"		=> 'faq',

				"name" 			=> __("FAQ", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_faq", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 12,

				"nodescription" => true,

				'subelements' 	=> array(	



							array( 

								"name" => "Style",

								"id" => "style",

								"type" => "select",

								"std" => "style_1",

								"subtype" => array("Style 1" => 'style_1', "Style 2" => 'style_2', 'Style 3 ' => 'style_3', 'Style 4' => 'style_4')

								), 

					        array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 12

								)





					)
 




	);			



/* END FAQ */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */



/* STAFF */



$elements[] =	array(	

				"dynamic"		=> 'staff',

				"name" 			=> __("One Staff Member", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_staff", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 3,

				"nodescription" => true,

				'subelements' 	=> array(	

						

					





						array( "name" => "Select Staff Member",

								"desc" => "",

								"id" => "staff",

								

								"type" => "select",

								"subtype" => 'staff'),

						array( "name" => "Do you want description ?",

								"desc" => "",

								"id" => "with_desc",

								"type" => "switchbutton",

								"std" => 'yes'),

						array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 3

								)		

					   	

					            



				)

			);



/* STAFF END */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */



/* Slideshow */



$elements[] =	array(	

				"dynamic"		=> 'slideshow',

				"name" 			=> __("Slideshow", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_slideshow", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 6,

				"nodescription" => true,

				'subelements' 	=> array(	

						

					


						array(
								"name" => "Title",

								"desc" => "Leave blank if you dont want title",

								"type" => 'input_text',

								"id"   => "title"
						),


						array(	"name" 	=> "Which Content?",

								"desc" 	=> "Chosose a page or post. The content of that entry will be displayed. By default it will display the content of the current post or page that has the this template aplied to it.",

					            "id" 	=> "dynamic_which_post_page",

					            "type" 	=> "select",

								"slug"	=> "",

								"std"	=> "self",

								"no_first"=>true,

					            "subtype" => array('Display the content of this post/page'=>'self','Choose a post'=>'post','Choose a Page'=>'page')),

					    

					   	array(	

								"slug"	=> "",

								"name" 	=> "Select Page",

								"desc" 	=> "",

								"id" 	=> "dynamic_page_id",

								"type" 	=> "select",

								"subtype" => 'page',

								"required" => array('dynamic_which_post_page','page')

							),

							

						

						 array(	

								"slug"	=> "",

								"name" 	=> "Select Post",

								"desc" 	=> "",

								"id" 	=> "dynamic_post_id",

								"type" 	=> "select",

								"subtype" => 'post',

								"required" => array('dynamic_which_post_page','post')

							),

					

						array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 6

								)		

					   	

					            



				)

			);



/* SLIDESHOW END */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* TESTIMONIAL SINGLE */





$elements[] = array(



	"dynamic" => "single_testimonial",

	"name" => __("Single Testimonial", 'themeple'),

	"type" => "layout_section",

	"id" => "single_testimonial",

	"removable" => "remove element",

	"default_size" => 6,

	"subelements" => array(



						

								
								array(    

					                                   "name"    => "Select one Testimonial Post:",

					                                   "desc"    => "",

					                                   "id"      => "testimon",

					                                   "std"     => "",

					                                   "type"    => "select",

					                                   "subtype" => 'testimonial'

						),


								
								array( 

									"id" => "dynamic_size",

									"type" => "hidden",

									"std" => 6

								)



		)



);


/* TESTIMONIALS END */

/* TESTIMONIALS */





$elements[] = array(



	"dynamic" => "simple_testimonial",

	"name" => __("Simple Testimonial (Circular)", 'themeple'),

	"type" => "layout_section",

	"id" => "simple_testimonial",

	"removable" => "remove element",

	"default_size" => 4,

	"subelements" => array(



						

								array(    

					                                   "name"    => "Block Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

						),


								array( 

									"id" => "dynamic_size",

									"type" => "hidden",

									"std" => 4

								)



		)



);


/* TESTIMONIALS END */



/* CLIENTS */



$elements[] = array(



	"dynamic" => "clients",

	"name" => __("Clients", 'themeple'),

	"type" => "layout_section",

	"id" => "dynamic_clients",

	"removable" => "remove element",

	"default_size" => 12,

	"subelements" => array(



			

								array(    

					                                   "name"    => "Block Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

						),

						 
								array(    

					                                   "name"    => "Carousel",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "carousel",

					                                   "std"     => "yes",

					                                   "type"    => "switchbutton"

						),
								


							

								array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 12

								)



		)



);



/* CLIENTS END */

/* ---------------------------------------------------------- */



$elements[] = array(



	"dynamic" => "divider",

	"name" => __("Divider", 'themeple'),

	"type" => "layout_section",

	"id" => "dynamic_divider",

	"removable" => "remove element",

	"default_size" => 12,

	"subelements" => array(

								array(

									"id" => "style",

									"name" => "Style",

									"type" => "select",

									"no_first" => true,

									"subtype" => array("Solid Border" => 'solid_border', 'Dotted Border' => 'dotted_border', "Diagonal Dotted" => 'diagonal_dotted', 'Light Shadow' => 'light_shadow', 'Big Shadow' => 'big_shadow')
								),

								array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 12

								)



		)



);




/* ---------------------------------------------------------- */

/* Content (Shortcodes) */
$elements[] =	array(	

				"dynamic"		=> 'only_content',

				"name" 			=> __("Content (Shortcodes)", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_only_content", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 6,

				"nodescription" => true,

				'subelements' 	=> array(	

						

						

								array(    

					                                   "name"    => "Block Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "dynamic_title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

						),
								array(    

					                                   "name"    => "Content:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "content",

					                                   "std"     => "",

					                                   "type"    => "textarea"

						),

								array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 6

								)
				)
	);

/* End Content (Shortcodes) */


/* POST PAGE CONTENT */



$elements[] =	array(	

				"dynamic"		=> 'post_page_content',

				"name" 			=> __("Post/Page Content", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_post_page", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 6,

				"nodescription" => true,

				'subelements' 	=> array(	

						

						

								array(    

					                                   "name"    => "Block Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "dynamic_title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

						),

						

					


						array(	"name" 	=> "Which Content?",

								"desc" 	=> "Chosose a page or post. The content of that entry will be displayed. By default it will display the content of the current post or page that has the this template aplied to it.",

					            "id" 	=> "dynamic_which_post_page",

					            "type" 	=> "select",

								"slug"	=> "",

								"std"	=> "self",

								"no_first"=>true,

					            "subtype" => array('Display the content of this post/page'=>'self','Choose a post'=>'post','Choose a Page'=>'page')),

					    

					   	array(	

								"slug"	=> "",

								"name" 	=> "Select Page",

								"desc" 	=> "",

								"id" 	=> "dynamic_page_id",

								"type" 	=> "select",

								"subtype" => 'page',

								"required" => array('dynamic_which_post_page','page')

							),

							

						

						 array(	

								"slug"	=> "",

								"name" 	=> "Select Post",

								"desc" 	=> "",

								"id" 	=> "dynamic_post_id",

								"type" 	=> "select",

								"subtype" => 'post',

								"required" => array('dynamic_which_post_page','post')

							),

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 6

								)

					            



				)

			);



/* POST PAGE CONTENT END */

/* WIDGET */



$elements[] =	array(	

				"dynamic"		=> 'Widget',

				"name" 			=> __("Widget", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_widget", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 6,

				"nodescription" => true,

				'subelements' 	=> array(	

						

							





								array(    

					                                   "name"    => "Block Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "dynamic_title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

						),

						
						 array(



						 		"name" 	=> "Sidebar Name: ",

								"desc" 	=> "Give a name to the sidebar that you want to create for this column. After you create it and save theme options, the new sidebar will be ready in the  <a href='widgets.php'>Appearance &raquo; Widgets</a>",

								"id" 	=> "dynamic_sidebar",

								"type" => "input_text"

								



						 	),

						

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 6

								)

					            



				)

			);



/* WIDGET END */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* CONTACT FORM */



$elements[] =	array(	

				"dynamic"		=> 'contact_form',

				"name" 			=> __("Contact Form", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_contact", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 6,

				"nodescription" => true,

				'subelements' 	=> array(	

						

							

						 array(    

					                                   "name"    => "Block Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "dynamic_title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

						),

						

						 array(



						 		"name" 	=> "Description",

								"desc" 	=> "",

								"id" 	=> "desc",

								"type" => "textarea"

								



						 	),

						 array(



						 		"name" 	=> "Success Message",

								"desc" 	=> "Write the Message that you want to be displayed when the message has sent",

								"id" 	=> "dynamic_msg",

								"type" => "textarea"

								



						 	),



						 array(



						 		"name" 	=> "Submit Button Text",

								"desc" 	=> "",

								"id" 	=> "dynamic_submit",

								"type" => "input_text"

								



						 	),

						

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 6

								)

					            



				)

			);



/* CONTACTFORM END */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */


/* GOOGLEMAP */



$elements[] =	array(	

				"dynamic"		=> 'google_map',

				"name" 			=> __("Google Map", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_map", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 12,

				"nodescription" => true,

				'subelements' 	=> array(	

						

							
						array(    

					                                   "name"    => "Block Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "dynamic_title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

						),

		


						 array(



						 		"name" 	=> "Source",

								"desc" 	=> "Only the link",

								"id" 	=> "dynamic_src",

								"type" => "input_text"

								



						 	),



						array(

							"name" => "Full Width",

							"desc" => "Set the map in fullwidth mode",

							"id" => "map_fullwidth",

							"std"	=> "yes",

						    "type" => "switchbutton"


							),

						array(



						 		"name" 	=> "Map Height (px)",

								"desc" 	=> "",

								"std"   => "150",

								"id" 	=> "height",

								"type" => "input_text"

								



						 	),


						array(

								"name" 	=> "Content after the map",

								"desc" 	=> "",

								"id" 	=> "desc",

								"type" => "textarea"
						),

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 12

								)

					            



				)

			);



/* GOOGLEMAP END */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* Element Header */



$elements[] =	array(	

				"dynamic"		=> 'el_head',

				"name" 			=> __("Element Header", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "el_header", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 12,

				"nodescription" => true,

				'subelements' 	=> array(	

						

							



						 array(    

					                                   "name"    => "Block Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "dynamic_title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

						),

						 array(    

					                                   "name"    => "Do you want Pagination?",

					                                   "desc"    => "",

					                                   "id"      => "pagination_bool",

					                                   "std"     => "no",

					                                   "type"    => "switchbutton"
						),

						

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 12

								)

					            



				)

			);



/* TEXTBAR END */



/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* TEXTBAR */



$elements[] =	array(	

				"dynamic"		=> 'textbar',

				"name" 			=> __("Text Bar", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "text_bar", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 12,

				"nodescription" => true,

				'subelements' 	=> array(	

						

							



						 array(



						 		"name" 	=> "Title",

								"desc" 	=> "",

								"id" 	=> "title",

								"type" => "input_text"

								



						 	),

						 array(



						 		"name" 	=> "Small title",

								"desc" 	=> "",

								"id" 	=> "small_title",

								"type" => "input_text"

						 	),

						 array(



						 		"name" 	=> "Style",

								"desc" 	=> "",

								"id" 	=> "style",

								"type" => "select",

								"no_first" => true,

								"subtype" => array('With border at top' => 'border_top', 'With border at left side' => 'border_left', 'With Icon' => 'with_icon', 'With Shadow' => 'with_shadow')

						 	),

						 array(



						 		"name" 	=> "Select Icon",

								"desc" 	=> "",

								"id" 	=> "icon",

								"type"  => "iconset",

								"required" => array('style','with_icon')

						 	),
					    
					     array(



						 		"name" 	=> "Button Bool",

								"desc" 	=> "",

								"std"   => 'no',

								"id" 	=> "button1_bool",

								"type"  => "switchbutton"

						 	),

						 array(



						 		"name" 	=> "Button Title",

								"desc" 	=> "",

								"id" 	=> "button1_title",

								"type"  => "input_text",

								"required" => array('button1_bool', 'yes')

						 	),

						 array(



						 		"name" 	=> "Button Link",

								"desc" 	=> "",

								"id" 	=> "button1_link",

								"type"  => "input_text",

								"required" => array('button1_bool', 'yes')
						 	),


						 array(



						 		"name" 	=> "Light Version ?",

								"desc" 	=> "Light version is with white text color and white button color. Use this on sections",

								"id" 	=> "light_version",

								"std"	=> 'no',

								"type"  => "switchbutton"
						 	),

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 12

								)

					            



				)

			);



/* TEXTBAR END */



/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */



/* PLAINTEXT */



$elements[] =	array(	

				"dynamic"		=> 'plain_text',

				"name" 			=> __("Plain Text", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_plain", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 6,

				"nodescription" => true,

				'subelements' 	=> array(	

						

						array(



						 		"name" 	=> "Primary Title",

								"desc" 	=> "Write Title here",

								"id" 	=> "title",

								"type" => "input_text"

						 ),

						 array(



						 		"name" 	=> "Primary Title Heading Type",

								"desc" 	=> "Select the heading type you want",

								"id" 	=> "heading_title",

								"type" => "select",

								"no_first" => true,

								"subtype" => array("H1" => 'h1', "H2" => 'h2', "H3" => 'h3', "H4" => 'h4', "H5" => 'h5', "H6" => 'h6')

						 ),

						 array(



						 		"name" 	=> "Short Description",

								"desc" 	=> "Write a short description after the big title",

								"id" 	=> "short_desc",

								"type" => "input_text"

								

						 ),	

						 array(



						 		"name" 	=> "Content",

								"desc" 	=> "Write a content here, you can add shortcodes too",

								"id" 	=> "content",

								"type" => "textarea"

								

						 ),	


						 array( 

								"name" => "Heading Font Color",

								"id"	=> "color_head",

								"type" => "input_text",

								"std"  => "#222"		

						),

						array( 

								"name" => "Short desc color",

								"id"	=> "color_desc_s",

								"type" => "input_text",

								"std"  => "#222"		

						),

						array( 

									"name" => "Body Font Color",

									"id"	=> "color_desc",

									"type" => "input_text",

									"std"  => "#666"		

						),

						 array(



						 		"name" 	=> "Alignment",

								"desc" 	=> "",

								"id" 	=> "alignment",

								"type" => "select",

								"no_first" => true,

								"subtype" => array("Left" => 'left', "Center" => 'center', "Right" => 'right')

								

						 ),		

						 array(



						 		"name" 	=> "Button Title",

								"desc" 	=> "If you want a button at the bottom, write a button title here",

								"id" 	=> "button_title",

								"type" => "input_text"

						 ),

						 array(



						 		"name" 	=> "Button Link",

								"desc" 	=> "",

								"id" 	=> "button_link",

								"type" => "input_text"

						 ),
						 						 

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 6

								)

				)            



				

			);



/* PLAINTEXT END */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* TOGGLE */



$elements[] =	array(	

				"dynamic"		=> 'toggle',

				"name" 			=> __("Toggles", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_toggle", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 6,

				"nodescription" => true,

				'subelements' 	=> array(	

						

								array(    

					                                   "name"    => "Block Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

						),


						array(    

					                                   "name"    => "Select Style:",

					                                   "desc"    => "",

					                                   "id"      => "style",

					                                   "std"     => "style_1",

					                                   "type"    => "select",

					                                   "no_first" => true,

					                                   "subtype"  => array('Style 1' => 'style_1', 'Style 2' => 'style_2')

						),

						 array(    

		                    

		                    "type"              => "layout_section", 

		                    "desc" 				=> "",

		                    "id"                => "toggles", 

		                    "linktext"          => "Add another Toggle Element",

		                    "deletetext"   		=> "Remove Toggle Element",

		                    "blank"        		=> true,

		                    "subelements" 		=> array(



					                    		array(    

					                                   "name"    => "Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

												),

					                            array(    

						                               "name"    => "Content:",

						                                   

						                               "desc"    => "",

						                               "id"      => "desc",

						                               "std"     => "",

						                               "type"    => "textarea"

						                       )

					        )

					     ),



						

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 6

								)

					            



				)

			);



/* TOGGLE END */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* Services List */



$elements[] =	array(	

				"dynamic"		=> 'services_list',

				"name" 			=> __("Services List", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_services_list", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 4,

				"nodescription" => true,

				'subelements' 	=> array(	

						

							

						 array(    

					                                   "name"    => "Block Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "dynamic_title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

						),

						 array(    

					                                   "name"    => "Icon:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "icon",

					                                   "std"     => "",

					                                   "type"    => "iconset"

						),

						array(    

		                    

		                    "type"              => "layout_section", 

		                    "desc" 				=> "",

		                    "id"                => "list", 

		                    "linktext"          => "Add another Element",

		                    "deletetext"   		=> "Remove Element",

		                    "blank"        		=> true,

		                    "subelements" 		=> array(



					                    		array(    

					                                   "name"    => "Title:",

					                                   "desc"    => "",

					                                   "id"      => "title",

					                                   "std"     => "",

					                                   "type"    => "input_text"
												)

					        )

					     ),



						

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 4

						)

					            



				)

			);



/* SERVICES LIST END */


/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */


/* Services Small */



$elements[] =	array(	

				"dynamic"		=> 'services_small',

				"name" 			=> __("Services Small", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_services_small", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 3,

				"nodescription" => true,

				'subelements' 	=> array(	

						

							

						 array(    

					                                   "name"    => "Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

						),

						

						 array(    

					                                   "name"    => "Do you want Icon?",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "icon_bool",

					                                   "std"     => "yes",

					                                   "type"    => "switchbutton"

						),

						

						 array(    

					                                   "name"    => "Do you want predefined Icon?",

					                                   "desc"    => "",

					                                   "id"      => "icon_bool_pred",

					                                   "std"     => "yes",

					                                   "type"    => "switchbutton",

					                                   "required" => array('icon_bool', 'yes')

						),

						  
						  array(    

					                                   "name"    => "Upload Your Image",  

					                                   "desc"    => "",

					                                   "id"      => "upload_img",

					                                   "std"     => "",

					                                   "btn_text" => "Upload",

					                                   "type"    => "upload",

					                                   "required" => array("icon_bool_pred", 'no')

						),

						 array(    

					                                   "name"    => "Select Icon",               

					                                   "desc"    => "",

					                                   "id"      => "icon",

					                                   "std"     => "",

					                                   "type"    => "iconset",

					                                   "required" => array("icon_bool_pred", 'yes')

						),
 
						array(    

					                                   "name"    => "Icon Color",

					                                   "desc"    => "Leave 'base' to use the default skin color",

					                                   "id"      => "icon_color",

					                                   "std"     => "#333333",

					                                   "type"    => "colorpicker",

					                                   "required" => array("icon_bool_pred", 'yes')

						),

						
						array(	

									"slug"	=> "",

									"name" 	=> "Content Type",

									"desc" 	=> "Select the content type to be used",

									"id" 	=> "dynamic_content_type",

									"type" 	=> "select",



									"subtype" => array('Post' => 'post', 'Page' => 'page', 'Add Content here' => 'content')

								),



								array(	

									"slug"	=> "",

									"name" 	=> "Select the post",

									"desc" 	=> "",

									"id" 	=> "dynamic_post",

									"type" 	=> "select",

									"subtype" => 'post',

									"required" => array('dynamic_content_type','post')

								),



								array(	

									"slug"	=> "",

									"name" 	=> "Select the page",

									"desc" 	=> "",

									"id" 	=> "dynamic_page",

									"type" 	=> "select",

									"subtype" => 'page',

									"required" => array('dynamic_content_type','page')

								),





								array(	

									"slug"	=> "",

									"name" 	=> "Content",

									"desc" 	=> "",

									"id" 	=> "dynamic_content_content",

									"type" 	=> "textarea",

									"required" => array('dynamic_content_type','content')

								),


								


								array(	

									"slug"	=> "",

									"name" 	=> "Link",

									"desc" 	=> "",

									"id" 	=> "dynamic_content_link",

									"type" 	=> "input_text",

									"std" => "http://",

									"required" => array('dynamic_content_type','content')

								),


								array(	

									"slug"	=> "",

									"name" 	=> "Link Title",

									"desc" 	=> "",

									"id" 	=> "link_title",

									"type" 	=> "input_text",

									"std" => "Read more"

								),








						

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 3

						)

					            



				)

			);



/* SERVICES Small END */


/* ---------------------------------------------------------- */
/* ---------------------------------------------------------- */



/* ---------------------------------------------------------- */
/* Services Medium */



$elements[] =	array(	

				"dynamic"		=> 'services_medium',

				"name" 			=> __("Services Medium", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_services_medium", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 3,

				"nodescription" => true,

				'subelements' 	=> array(	

						

							

						 array(    

					                                   "name"    => "Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

						),

						 array(    

					                                   "name"    => "Do you want Icon?",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "icon_bool",

					                                   "std"     => "yes",

					                                   "type"    => "switchbutton"

						),

						array(    

					                                   "name"    => "Do you want a predefined Icon?",

					                                   "desc"    => "",

					                                   "id"      => "icon_bool_pred",

					                                   "std"     => "yes",

					                                   "type"    => "switchbutton",

					                                   "required" => array("icon_bool", 'yes')

						),

						


						 array(    

					                                   "name"    => "Select Icon",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "icon",

					                                   "std"     => "",

					                                   "type"    => "iconset",

					                                   "required" => array("icon_bool_pred", 'yes')

						),

						 array(    

					                                   "name"    => "Upload Icon",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "icon_up",

					                                   "std"     => "",

					                                   "btn_text" => "Upload",

					                                   "type"    => "upload",

					                                   "required" => array("icon_bool_pred", 'no')

						),

						array(	

									"slug"	=> "",

									"name" 	=> "Content Type",

									"desc" 	=> "Select the content type to be used",

									"id" 	=> "dynamic_content_type",

									"type" 	=> "select",

									"subtype" => array('Post' => 'post', 'Page' => 'page', 'Add Content here' => 'content')

								),



								array(	

									"slug"	=> "",

									"name" 	=> "Select the post",

									"desc" 	=> "",

									"id" 	=> "dynamic_post",

									"type" 	=> "select",

									"subtype" => 'post',

									"required" => array('dynamic_content_type','post')

								),



								array(	

									"slug"	=> "",

									"name" 	=> "Select the page",

									"desc" 	=> "",

									"id" 	=> "dynamic_page",

									"type" 	=> "select",

									"subtype" => 'page',

									"required" => array('dynamic_content_type','page')

								),





								array(	

									"slug"	=> "",

									"name" 	=> "Content",

									"desc" 	=> "",

									"id" 	=> "dynamic_content_content",

									"type" 	=> "textarea",

									"required" => array('dynamic_content_type','content')

								),



								

								array(	

									"slug"	=> "",

									"name" 	=> "Link",

									"desc" 	=> "",

									"id" 	=> "dynamic_content_link",

									"type" 	=> "input_text",

									"std" => "http://",

									"required" => array('dynamic_content_type','content')

								),




						

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 3

						)

					            



				)

			);



/* SERVICES  END */

$elements[] =	array(	

				"dynamic"		=> 'services_new',

				"name" 			=> __("Services New", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_services_new", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 3,

				"nodescription" => true,

				'subelements' 	=> array(	

						

							

						 array(    

					                                   "name"    => "Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

						),

						 array(    

					                                   "name"    => "Do you want Icon?",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "icon_bool",

					                                   "std"     => "yes",

					                                   "type"    => "switchbutton"

						),

						array(    

					                                   "name"    => "Do you want a predefined Icon?",

					                                   "desc"    => "",

					                                   "id"      => "icon_bool_pred",

					                                   "std"     => "yes",

					                                   "type"    => "switchbutton",

					                                   "required" => array("icon_bool", 'yes')

						),

						


						 array(    

					                                   "name"    => "Select Icon",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "icon",

					                                   "std"     => "",

					                                   "type"    => "iconset",

					                                   "required" => array("icon_bool_pred", 'yes')

						),

						 array(    

					                                   "name"    => "Upload Icon",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "icon_up",

					                                   "std"     => "",

					                                   "btn_text" => "Upload",

					                                   "type"    => "upload",

					                                   "required" => array("icon_bool_pred", 'no')

						),

						array(	

									"slug"	=> "",

									"name" 	=> "Content Type",

									"desc" 	=> "Select the content type to be used",

									"id" 	=> "dynamic_content_type",

									"type" 	=> "select",

									"subtype" => array('Post' => 'post', 'Page' => 'page', 'Add Content here' => 'content')

								),



								array(	

									"slug"	=> "",

									"name" 	=> "Select the post",

									"desc" 	=> "",

									"id" 	=> "dynamic_post",

									"type" 	=> "select",

									"subtype" => 'post',

									"required" => array('dynamic_content_type','post')

								),



								array(	

									"slug"	=> "",

									"name" 	=> "Select the page",

									"desc" 	=> "",

									"id" 	=> "dynamic_page",

									"type" 	=> "select",

									"subtype" => 'page',

									"required" => array('dynamic_content_type','page')

								),





								array(	

									"slug"	=> "",

									"name" 	=> "Content",

									"desc" 	=> "",

									"id" 	=> "dynamic_content_content",

									"type" 	=> "textarea",

									"required" => array('dynamic_content_type','content')

								),



								

								array(	

									"slug"	=> "",

									"name" 	=> "Link",

									"desc" 	=> "",

									"id" 	=> "dynamic_content_link",

									"type" 	=> "input_text",

									"std" => "http://",

									"required" => array('dynamic_content_type','content')

								),




						

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 3

						)

					            



				)

			);



/* SERVICES NEW END */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */
/* Services Medium BOX*/



$elements[] =	array(	

				"dynamic"		=> 'services_medium_box',

				"name" 			=> __("Services Medium Box", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_services_medium_box", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 4,

				"nodescription" => true,

				'subelements' 	=> array(	

						

							

						 array(    

					                                   "name"    => "Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

						),


						 array(    

					                                   "name"    => "Box Bg Color:",

					                                   "desc"    => "",

					                                   "id"      => "bg_color",

					                                   "std"     => "#f7f7f7",

					                                   "type"    => "colorpicker"

						),

						 array(    

					                                   "name"    => "Do you want Icon?",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "icon_bool",

					                                   "std"     => "yes",

					                                   "type"    => "switchbutton"

						),
						 array(    

					                                   "name"    => "Select the position of the icon wrapper",

					                                   "desc"    => "",

					                                   "id"      => "icon_pos",

					                                   "std"     => "top",

					                                   "no_first"	=> true,

					                                   "type"    => "select",

					                                   "subtype" => array('Top' => 'top', 'Left' => 'left'),

					                                   "required" => array("icon_bool", 'yes')

						),
						array(    

					                                   "name"    => "Do you want a predefined Icon?",

					                                   "desc"    => "",

					                                   "id"      => "icon_bool_pred",

					                                   "std"     => "yes",

					                                   "type"    => "switchbutton",

					                                   "required" => array("icon_bool", 'yes')

						),

						


						 array(    

					                                   "name"    => "Select Icon",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "icon",

					                                   "std"     => "",

					                                   "type"    => "iconset",

					                                   "required" => array("icon_bool_pred", 'yes')

						),

						 array(    

					                                   "name"    => "Upload Icon",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "icon_up",

					                                   "std"     => "",

					                                   "btn_text" => "Upload",

					                                   "type"    => "upload",

					                                   "required" => array("icon_bool_pred", 'no')

						),

						array(	

									"slug"	=> "",

									"name" 	=> "Content Type",

									"desc" 	=> "Select the content type to be used",

									"id" 	=> "dynamic_content_type",

									"type" 	=> "select",

									"subtype" => array('Post' => 'post', 'Page' => 'page', 'Add Content here' => 'content')

								),



								array(	

									"slug"	=> "",

									"name" 	=> "Select the post",

									"desc" 	=> "",

									"id" 	=> "dynamic_post",

									"type" 	=> "select",

									"subtype" => 'post',

									"required" => array('dynamic_content_type','post')

								),



								array(	

									"slug"	=> "",

									"name" 	=> "Select the page",

									"desc" 	=> "",

									"id" 	=> "dynamic_page",

									"type" 	=> "select",

									"subtype" => 'page',

									"required" => array('dynamic_content_type','page')

								),





								array(	

									"slug"	=> "",

									"name" 	=> "Content",

									"desc" 	=> "",

									"id" 	=> "dynamic_content_content",

									"type" 	=> "textarea",

									"required" => array('dynamic_content_type','content')

								),



								

								array(	

									"slug"	=> "",

									"name" 	=> "Link",

									"desc" 	=> "",

									"id" 	=> "dynamic_content_link",

									"type" 	=> "input_text",

									"std" => "#",

									"required" => array('dynamic_content_type','content')

								),




						

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 4

						)

					            



				)

			);



/* SERVICES MEDIUM END */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */


/* Services Media */



$elements[] =	array(	

				"dynamic"		=> 'services_media',

				"name" 			=> __("Services Media", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_services_media", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 4,

				"nodescription" => true,

				'subelements' 	=> array(	

						

							

						 array(    

					                                   "name"    => "Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

						),

					     array(    

					                                   "name"    => "Type of Media ?",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "type",

					                                   "std"     => "",

					                                   "no_first" => true,

					                                   "type"    => "select",

					                                   "subtype" => array('Image' => 'img', 'Video' => 'video')

						),
						 array(    

					                                   "name"    => "Upload Photo",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "photo",

					                                   "std"     => "",

					                                   "btn_text" => "Upload",

					                                   "type"    => "upload",

					                                   "required" => array("type", 'img')

						),

						 array(    

					                                   "name"    => "Video",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "video",

					                                   "std"     => "",

					                                   "type"    => "input_text",

					                                   "required" => array("type", 'video')

						),

						 array(    

					                                   "name"    => "Description",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "desc",

					                                   "std"     => "",

					                                   "type"    => "textarea"

						),
								array(	

									"slug"	=> "",

									"name" 	=> "Link",

									"desc" 	=> "",

									"id" 	=> "link",

									"type" 	=> "input_text",

									"std" => "#"

								),

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 4

						)

					            



				)

			);



/* SERVICES Media END */

/* ---------------------------------------------------------- */
/* ---------------------------------------------------------- */


/* ---------------------------------------------------------- */
/* ---------------------------------------------------------- */

/* Media */



$elements[] =	array(	

				"dynamic"		=> 'media',

				"name" 			=> __("Media", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_media", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 6,

				"nodescription" => true,

				'subelements' 	=> array(	

						

							

						 array(    

					                                   "name"    => "Select type of media:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "type",

					                                   "std"     => "",

					                                   "no_first" => true,

					                                   "type"    => "select",

					                                   "subtype" => array('Image' => 'image', 'Video' => 'video', 'Slideshow' => "slideshow")

						),
						 array( 
						 		"name"    => "Image:",

								"id" => "image",

								"type" => "upload",

								"btn_text" => 'Upload',

								"required" => array("type", "image")
						),
						 array( 
						 		"name"    => "Video:",

								"id" => "video",

								"type" => "input_text",

								"std"	=> '',

								"required" => array("type", "video")
						),
						 array( 
						 		"name"    => "Slideshow:",

								"id" => "slideshow",

								"type" => "select",

								"subtype"	=> array('Select From Posts' => 'posts', "Select From Pages" => 'pages'),

								"required" => array("type", "slideshow")
						),
						 array( 
						 		"name"    => "Select Post:",

								"id" => "slideshow_post",

								"type" => "select",

								"no_first" => true,

								"subtype"	=> 'post',

								"required" => array("slideshow", "posts")
						),

						 array( 
						 		"name"    => "Select Page:",

								"id" => "slideshow_page",

								"type" => "select",

								"no_first" => true,

								"subtype"	=> 'page',

								"required" => array("slideshow", "pages")
						),

						 array( 
						 		"name"    => "Alignment:",

								"id" => "alignment",

								"type" => "select",

								"no_first" => true,

								"subtype"	=> array("Left" => 'left', 'center' => 'center', 'Right' => 'right')

								
						),

						 array( 
						 		"name"    => "Specify Width (px):",

								"id" => "width",

								"type" => "input_text",

								

								"required"	=> array('alignment', 'center')

								
						),

						 array( 
						 		"name"    => "Animation",

								"id" => "animation",

								"type" => "select",

								"no_first" => true,

								"subtype" => array("Show From Left" =>  'left', 'Show From Right' => 'right', 'Show from Top' => 'top', 'Show From Bottom' => 'bottom', "None" => 'none'),

								
						),


						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 6

						)

					            



				)

			);



/* Media END */



/* TABS */



$elements[] =	array(	

				"dynamic"		=> 'tabs',

				"name" 			=> __("Tabs", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_tabs", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 6,

				"nodescription" => true,

				'subelements' 	=> array(	

						

								array(    

					                                   "name"    => "Block Title:",

					                                   "desc"    => "",

					                                   "id"      => "title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

						),

								array(    

					                                   "name"    => "Tabs Position:",

					                                   "desc"    => "",

					                                   "id"      => "position",

					                                   "std"     => "top",

					                                   "type"    => "select",

					                                   "no_first" => true,

					                                   "subtype" => array('Top' => "top", 'Left' => 'left')

						),

								array(    

					                                   "name"    => "Tabs Style:",

					                                   "desc"    => "",

					                                   "id"      => "style",

					                                   "std"     => "style_1",

					                                   "type"    => "select",

					                                   "no_first" => true,

					                                   "subtype" => array('Style 1' => "style_1", 'Style 2' => 'style_2', "Style 3" => 'style_3')

						),


						 array(    

		                    

		                    "type"              => "layout_section", 

		                    "desc" 				=> "",

		                    "id"                => "tabs", 

		                    "linktext"          => "Add another Tab Element",

		                    "deletetext"   		=> "Remove Tab Element",

		                    "blank"        		=> true,

		                    "subelements" 		=> array(



					                    		

					                    		array(    

					                                   "name"    => "Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

					                                   

												),

					                    		array(    

					                                   "name"    => "Do you want Icon before the title?",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "icon_bool",

					                                   "std"     => "no",

					                                   "type"    => "switchbutton"

					                                   

												),

												array(    

					                                   "name"    => "Select Icon",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "icon",

					                                   "std"     => "",

					                                   "type"    => "iconset",

					                                   "required" => array("icon_bool", 'yes')

												),

					                            array(    

						                               "name"    => "Content:",

						                                   

						                               "desc"    => "",

						                               "id"      => "desc",

						                               "std"     => "",

						                               "type"    => "textarea"

						                       )

					        )

					     ),



						

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 6

								)

					            



				)

			);



/* TABS END */
/* CREATIVE TABS */



$elements[] =	array(	

				"dynamic"		=> 'creative_tabs',

				"name" 			=> __("Creative Tabs", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_creative_tabs", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 12,

				"nodescription" => true,

				'subelements' 	=> array(	

						 array(    

		                    

		                    "type"              => "layout_section", 

		                    "desc" 				=> "",

		                    "id"                => "creative_tabs", 

		                    "linktext"          => "Add another Tab Element",

		                    "deletetext"   		=> "Remove Tab Element",

		                    "blank"        		=> true,

		                    "subelements" 		=> array(



					                    		

					                    		array(    

					                                   "name"    => "Title:",

					                                   "desc"    => "",

					                                   "id"      => "title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

												),

					                    		array(    

					                                   "name"    => "Do you want icon or number in the circle?",

					                                   "desc"    => "",

					                                   "id"      => "icon_number",

					                                   "std"     => "number",

					                                   "type"    => "select",

					                                   "subtype" => array('Number' => 'number', 'Icon' => 'icon')          

												),

												array(    

					                                   "name"    => "Select Icon",

					                                   "desc"    => "",

					                                   "id"      => "icon",

					                                   "std"     => "",

					                                   "type"    => "iconset",

					                                   "required" => array("icon_number", 'icon')

												),

												array(    

					                                   "name"    => "Number",

					                                   "desc"    => "",

					                                   "id"      => "number",

					                                   "std"     => "01",

					                                   "type"    => "input_text",

					                                   "required" => array("icon_number", 'number')

												),

					                            array(    

						                               "name"    => "Content:",

						                               "desc"    => "",

						                               "id"      => "desc",

						                               "std"     => "",

						                               "type"    => "textarea"
						                        )

					        )

					     ),



						

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 12

						)

					            



				)

			);



/* TABS END */
/* ---------------------------------------------------------- */
/* CHART SKILLS */



$elements[] =	array(	

				"dynamic"		=> 'chart_skill',

				"name" 			=> __("Chart Skill", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "chart_skill", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 3,

				"nodescription" => true,

				'subelements' 	=> array(	



						
						array(

									"name" => __("Percentage %", 'themeple'),

									"id" => "percent",

									"type" => "input_text",

									"std" => ""

									

								),

						array(
								"name" => "Do you want Icon or Text ?",
								
								'id' => 'type',
								
								"no_first" => true,
								
								'type' => 'select',

								'subtype' => array("Text" => 'text', "Icon" => 'icon')
							),

						array(
								"name" => "Text",
								
								'id' => 'text',
								
								'type' => 'input_text',

								'required' => array('type', 'text')
							),

						array(
								"name" => "Icon",
								
								'id' => 'icon',
								
								'type' => 'iconset',

								'required' => array('type', 'icon')
							),

						array(
								"name" => "Font Size",
								
								'id' => 'font_size',
								
								'type' => 'input_text',

								'std' => "50px"
							),

						array(
								"name" => "Color",
								
								'id' => 'color',
								
								'type' => 'colorpicker',

								'std' => "base"
							),

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 3

								)

					            



				)

			);



/* CHART SKILLS END */

/*------------------------------------------ */
/* SKILLS */



$elements[] =	array(	

				"dynamic"		=> 'skills',

				"name" 			=> __("Skills", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_skills", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 6,

				"nodescription" => true,

				'subelements' 	=> array(	

						

						array(    

					                                   "name"    => "Block Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

						),

						array(    

					                                   "name"    => "Description",

					                                   "desc"    => "",

					                                   "id"      => "desc",

					                                   "std"     => "",

					                                   "type"    => "textarea"

						),


						 array(    

		                    

		                    "type"              => "layout_section", 

		                    "desc" 				=> "",

		                    "id"                => "skills", 

		                    "linktext"          => "Add another Tab Element",

		                    "deletetext"   		=> "Remove Tab Element",

		                    "blank"        		=> true,

		                    "subelements" 		=> array(



					                    		array(    

					                                   "name"    => "Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

												),

					                            array(    

						                               "name"    => "Percentage of the skill:",

						                               "desc"    => "",

						                               "id"      => "percentage_skill",

						                               "std"     => "",

						                               "type"    => "input_text"

						                       ),

					                            array(    

						                               "name"    => "Bar Color:",

						                               "desc"    => "If you want the skin color, please dont edit the 'base' string",

						                               "id"      => "color",

						                               "std"     => "base",

						                               "type"    => "colorpicker"

						                       )

					                           
					                      

					        )

					     ),



						

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 6

								)

					            



				)

			);



/* SKILLS END */
/* ---------------------------------------------------------- */


/*------------------------------------------ */
/* Section Start */
$elements[] =	array(	

				"dynamic"		=> 'section_start',

				"name" 			=> __("Section Start", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_section_start", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 12,

				"nodescription" => true,

				"subelements" => array(

						array( 

								"name" => "Select the type of the background",

								"id" => 'bg_type',

								"type" => "select",

								"no_first" => true,

								"subtype" => array("Background Color" => 'bg_color', 'Image' => 'image', 'Video' => 'video'),

								"std" => "bg_color"

						),

						array( 

								"name" => "Video Webm source file",

								"id" => 'webm_video',

								"type" => "input_text",

								"required" => array('bg_type', 'video'),

								"std" => ""

						),

						array( 

								"name" => "Video mp4 source file",

								"id" => 'mp4_video',

								"type" => "input_text",

								"required" => array('bg_type', 'video'),

								"std" => ""

						),


						array( 

								"name" => "Overlay",

								"id" => 'overlay',

								"type" => "switchbutton",

								"required" => array('bg_type', 'video'),

								"std" => "no"

						),

						array( 

								"name" => "Overlay Color",

								"id" => 'overlay_color',

								"type" => "colorpicker",

								"required" => array('overlay', 'yes'),

								"std" => "rgba(0,0,0,0.7)"

						),

						array( 

								"name" => "Background Color",

								"id" => 'bg_color',

								"type" => "input_text",

								"required" => array('bg_type', 'bg_color'),

								"std" => "#f5f5f5"

						),

						array( 

								"name" => "Background Image",

								"id" => 'image',

								"type" => "upload",

								"required" => array('bg_type', 'image'),

								"btn_text" => "Upload"

						),
 
						array( 

								"name" => "Do you want fixed image?",

								"id" => 'fixed_img',

								"type" => "switchbutton",

								"required" => array('bg_type', 'image'),

								"std" => "no"
						),


						array( 

								"name" => "Parallax BG?",

								"id" => 'parallax',

								"type" => "switchbutton",

								"required" => array('bg_type', 'image'),

								"std" => "no"
						),

						
						array( 

								"name" => "Active Light Version",

								"id" => 'light_version',

								"desc" => 'Active light version if you use a dark section (video, color or image) and you want light version of elements into it.',

								"type" => "switchbutton",

								"std" => "no"
						),

						array( 

								"name" => "Do you want padding on the top?",

								"id" => 'padding_top',

								"type" => "switchbutton",

								"std" => 'yes'

								

						),


						array( 

								"name" => "Do you want padding on the bottom?",

								"id" => 'padding_bottom',

								"type" => "switchbutton",

								"std" => 'yes'

								

						),


						array( 

								"name" => "Do you want borders?",

								"id" => 'borders',

								"type" => "switchbutton",

								"std" => 'yes'
						),

						array( 

								"name" => "Inside Elements Nargin",

								"id" => 'inside_margin',

								"type" => "select",

								"std" => 'section_space_1',

								"no_first" => true,

								"subtype" => array("First Space (40px)" => "section_space_1", "Second Space (30px)" => "section_space_2", "Third Space (90px)" => "section_space_3")
						),


						array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 12

						)


				)
);

/* Section Start End */
/*------------------------------------------ */
/* Section End */
$elements[] =	array(	

				"dynamic"		=> 'section_end',

				"name" 			=> __("Section End", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_section_end", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 12,

				"nodescription" => true,

				"subelements" => array(

					array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 12

						)

					
				)
);

/* Section End End */


/* Page Intro */
$elements[] =	array(	

				"dynamic"		=> 'page_intro',

				"name" 			=> __("Page Intro", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "page_intro", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 12,

				"nodescription" => true,

				"subelements" => array(

					array( 

								"name" => "Title",

								"id"	=> "title",

								"type" => "input_text"		

					),

					array( 

								"name" => "Position ?",

								"id"	=> "position",

								"type" => "select",

								"no_first" => true,

								"std" => 'left',

								"subtype" => array("Centered" => "center", "Left" => "left", "Right" => "right")		

					),
					

					
					array( 

								"name" => "Do you want Image?",

								"id"	=> "img_bool",

								"type" => "switchbutton",

								"std"  => 'no'	

					),


					array( 

								"name" => "Image",

								"id"	=> "image",

								"type" => "upload",

								"btn_text" => 'Upload',

								"required" => array("img_bool", 'yes')		

					),


					array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 12

						)

					
				)
);

/* End Page Intro */



/* Page Header */
$elements[] =	array(	

				"dynamic"		=> 'page_header',

				"name" 			=> __("Page Header", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "page_header", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 12,

				"nodescription" => true,

				"subelements" => array(

					array( 

								"name" => "Title",

								"id"	=> "title",

								"type" => "input_text"		

					),

					array( 

								"name" => "Small Title",

								"id"	=> "small_title",

								"type" => "input_text"		

					),

					array( 

								"name" => "Big Title Color",

								"id"	=> "color_title",

								"type" => "input_text",

								"std"  => "#444"		

					),

					array( 

								"name" => "Big Title Font Size (px)",

								"id"	=> "size_title",

								"type" => "input_text",

								"std"  => "30"		

					),

					array( 

								"name" => "Small Title Color",

								"id"	=> "color_small_title",

								"type" => "input_text",

								"std"  => "#999999"		

					),

					array( 

								"name" => "Small Title Font Size (px)",

								"id"	=> "size_small_title",

								"type" => "input_text",

								"std"  => "16"		

					),
					
					array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 12

						)

					
				)
);

/* End Page Header */

/* Great Gallery */
$elements[] =	array(	

				"dynamic"		=> 'great_gallery',

				"name" 			=> __("Great Gallery", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "great_gallery", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 12,

				"nodescription" => true,

				"subelements" => array(

									

					array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 12

						)

					
				)
);

/* End Page Header */

/* ---------------------------------------------- */
/* CountDown */
$elements[] =	array(	

				"dynamic"		=> 'countdown',

				"name" 			=> __("Countdown", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "countdown", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 12,

				"nodescription" => true,

				"subelements" => array(
					
					array( 

								"name" => "Year",

								"id"	=> "year",

								"type" => "input_text"		

					),

					array( 

								"name" => "Month",

								"id"	=> "month",

								"type" => "select",

							       "subtype" => array("1" => 1, "2" => 2, "3" => 3, "4" => 4, "5" => 5, "6" => 6, "7" => 7, "8" => 8, "9" => 9, "10" => 10, "11" => 11, "12" => 12)		

					),	

					array( 

								"name" => "Day",

								"id"	=> "day",

								"type" => "input_text"		

					),
					
					array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 12

						)

					
				)
);

/* End CountDown */

/** Price Lists **/
$elements[] =	array(	

				"dynamic"		=> 'price_list',

				"name" 			=> __("Price List", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "price_list", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 3,

				"nodescription" => true,

				'subelements' 	=> array(	

						

						array(

									"name" => "Title",

									"id" => "title",

									"type" => "input_text",

									"std" => ""

									

								),
						array(

									"name" => "Title Font Color",

									"id" => "title_color",

									"type" => "input_text",

									"std" => ""

									

								),


						array(

									"name" => "Price",

									"id" => "price",

									"type" => "input_text",

									"std" => ""

									

								),

				

						array(

									"name" => "Currency",

									"id" => "currency",

									"type" => "input_text",

									"std" => "$"

									

								),
                        
					array(

							       "name" => "Price Font Color",
							       
							       "id" => "price_color",

							       "type" => "input_text",

								   "std" => ""

							),

						array(

							       "name" => "Period",
							       
							       "id" => "period",

							       "type" => "input_text",

								   "std" => ""

							),


						array(

							       "name" => "Period Font Color",
							       
							       "id" => "period_color",

							       "type" => "input_text",

								   "std" => "#f1663a"

							),


						array(

									"name" => "Button Tittle",

									"id" => "button_title",

									"type" => "input_text",

									"std" => ""

									

								),
                        
						array(

									"name" => "Button Link",

									"id" => "button_link",

									"type" => "input_text",

									"std" => ""

									

								),



						array(
							       "name" => "Highlight this price table",

									"id" => "highlight_table",

									"type" => "switchbutton",

									"std" => "no"

						),

						array(
							       "name" => "First Color for highlight table",

									"id" => "first_color",

									"type" => "input_text",

									"std" => ""

						     ),

						array(
							       "name" => "Second Color for highlight table",

									"id" => "second_color",

									"type" => "input_text",

									"std" => ""

						     ),

						  array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 3

								),
						  array(
						  	    "name" => "Block Title",
						  	    "id" => "dynamic_title",
						  	    "type" => "input_text"


						  	),

						  	 array(    

		                    

		                    "type"              => "layout_section", 

		                    "desc" 				=> "",

		                    "id"                => "lists", 

		                    "linktext"          => "Add another list",

		                    "deletetext"   		=> "Remove list Element",

		                    "blank"        		=> true,

		                    "subelements" 		=> array(



					                    		array(    

					                                   "name"    => "List Name",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "list_name",

					                                   "std"     => "",

					                                   "type"    => "input_text"

												)

												

					                         

					        )

					     )



					            



				)

			);



/* Price Lists END */



?>