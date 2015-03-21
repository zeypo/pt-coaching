<?php		

 	$layers = array();
    // Get WPDB Object
    global $wpdb;
 
    // Table name
     $table_name = $wpdb->prefix . "layerslider";
 	if($wpdb->get_var($wpdb->prepare("show tables like %s", $table_name)) == $table_name) {
       
    // Get sliders
    	$sliders = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE flag_hidden = '0' AND  flag_deleted = '0' ORDER BY %s ASC LIMIT %d", 'date_s', 100) );
        
	    foreach($sliders as $key => $item) {
	 
	        $layers[$item->name] = $item->id-1;
	    }
	}



    $revsliders = array();
    // Get WPDB Object
    global $wpdb;
 
    // Table name
    $table_name = $wpdb->prefix . "revslider_sliders";
 
    if($wpdb->get_var($wpdb->prepare ("show tables like %s ", $table_name)) == $table_name) {
       

    $sliders = $wpdb->get_results($wpdb->prepare( "SELECT * FROM $table_name
                                        
                                        ORDER BY %s ASC LIMIT %d", 'id', 100) );

    
    if(count($sliders) > 0):
	    foreach($sliders as $key => $item) {
	 
	        $revsliders[$item->title] = $item->alias;
	    }
    endif;
	}

	$menus_terms = get_terms('nav_menu');
	$menus = array();
	foreach($menus_terms as $menu){
	 	$menus[$menu->slug] = $menu->name;
	} 
$boxes = array( 
	array( 'title' =>  __('Layout', 'themeple'), 'id'=>'layout' , 'page'=>array('post','page', 'product'), 'context'=>'side', 'priority'=>'low' ),
    
    array( 'title' =>  __('Slideshow Options', 'themeple'), 'id'=>'slideshow_meta', 'page'=>array('page'), 'context'=>'normal', 'priority'=>'low' ),
    array( 'title' =>  __('Media - Add any number images and videos for the slider', 'themeple'), 'id'=>'media' , 'page'=>array('post','page','portfolio', 'gallery', 'projectslide'), 'context'=>'normal', 'priority'=>'low' ),	
    array( 'title' =>  __('Page Header', 'themeple'), 'id'=>'page_header', 'page'=>array('page', 'product', 'portfolio'), 'context'=>'normal', 'priority'=>'low' ),
    array( 'title' =>  __('One Page Options', 'themeple'), 'id'=>'one_page', 'page'=>array('page'), 'context'=>'normal', 'priority'=>'low' ),
 


	array( 'title' =>  __('Slideshow Options', 'themeple'), 'id'=>'slideshow_meta_portfolio', 'page'=>array('portfolio'), 'context'=>'normal', 'priority'=>'high' ),
	
					 
	array( 'title' =>  __('Media - Add any number images and videos for the slider', 'themeple'), 'id'=>'media_serv' , 'page'=>array('services'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' => __('Project Info', 'themeple'), 'id'=>'project_info', 'page'=>array('projectslide'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' => __('Testimonial Options', 'themeple'), 'id'=>'testimonial_options', 'page'=>array('testimonial'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' =>  __('Social Links', 'themeple'), 'id'=>'social_links' , 'page'=>array('staff'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' =>  __('Post Options', 'themeple'), 'id'=>'post_options' , 'page'=>array('post'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' =>  __('Meta Fields', 'themeple'), 'id'=>'meta_fields' , 'page'=>array('staff'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' => __('Position', 'themeple'), 'id'=>'staff_position', 'page'=>array('staff', 'testimonial'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' =>  __('Services Options', 'themeple'), 'id'=>'services_options' , 'page'=>array('services'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' =>  __('Faq Options', 'themeple'), 'id'=>'faq_options' , 'page'=>array('faq'), 'context'=>'normal', 'priority'=>'high' ),

);

								
$elements = array(

				

				
				
array(	
					"slug"	=> "layout",
					"name" 	=> __("Select Page layout", 'themeple'),
					"desc" 	=> "",
					"id" 	=> "layout",
					"type" 	=> "select",
					"std" 	=> "",
					"hook" 	=> 'on_save_layout_dynamic_save',
					"no_first"=>true,
					"subtype" => array( 	
											'Predefined Templates' => array(
											'Use global default' => "",
											'Left sidebar' =>'sidebar_left',
											'Right sidebar'=>'sidebar_right',
											'Fullwidth'=>'fullsize'
											),
											
											'Dynamic Templates' => themeple_admin_get_dynamic_templates('dynamic_template-')
											
										)),		
				
		
		
		array(	
		"name" 	=> __("Which Slider do you want to use?", 'themeple'),
		"desc" 	=> "Select one of defined sliders. Default flexslider" ,
		"id" 	=> "_slideshow_type",
		"type" 	=> "select",
		"slug"  => "slideshow_meta",
		"subtype" => array('Layer Slider'=>'layer_slider', "Revolution Slider" => 'revolution', 'Flexslider'=>'flexslider', 'Image Thumbnails' => 'image_thumbnails')),
		
		array(	
		"name" 	=> __("Slideshow Layout", 'themeple'),
		"desc" 	=> "" ,
		"id" 	=> "_slideshow_layout",
		"type" 	=> "radioimage",
		"std" 	=> "fixed",
		"slug"  => "slideshow_meta",
		
		"subtype"           => array( 
                                                  array('name' => 'Fixed to page layout', 'value' =>'fixed', 'img' => 'boxed.png'),
                                                  array('name' => 'Full Width', 'value' =>'fullwidth', 'img' => '90x62/fullwidth.png')
                                    )
		),
		

		array(	
		"name" 	=> __("Section Around The Slider ?", 'themeple'),
		"desc" 	=> "" ,
		"id" 	=> "section_or_no",
		"type" 	=> "switchbutton",
		"std" 	=> "yes",
		"slug"  => "slideshow_meta",
		"required" => array("_slideshow_layout", 'fixed')
		
		
		),

		array(	
		"name" 	=> __("Color or Background ?", 'themeple'),
		"desc" 	=> "" ,
		"id" 	=> "color_or_background",
		"type" 	=> "select",
		"std" 	=> "color", 
		"slug"  => "slideshow_meta",
		"subtype" => array('Color' => 'color', "Background" => 'background'),
		"required" => array("section_or_no", 'yes')
		
		
		),

		array(	
		"name" 	=> __("Select The Color", 'themeple'),
		"desc" 	=> "" ,
		"id" 	=> "sec_color",
		"type" 	=> "colorpicker",
		"std" 	=> "#fafafa",
		"slug"  => "slideshow_meta",
		"required" => array("color_or_background", 'color')
		
		
		),
		
		array(	
		"name" 	=> __("Do you want Padding from the top ?", 'themeple'),
		"desc" 	=> "" ,
		"id" 	=> "padding_slide",
		"type" 	=> "switchbutton",
		"std" 	=> "yes",
		"slug"  => "slideshow_meta",
		"required" => array("_slideshow_layout", 'fixed')
		
		
		),

		array(	

		"name" 	=> __("Upload The Background", 'themeple'),
		"desc" 	=> "" ,
		"id" 	=> "sec_background",
		"type" 	=> "upload",
		"btn_text" => "Upload",
		"std" 	=> THEMEPLE_BASE_URL."img/header_section_default.png",
		"slug"  => "slideshow_meta",
		"required" => array("color_or_background", 'background')
			
		),


		array(	
		"name" 	=> __("Select one of the sliders you have created", 'themeple'),
		"desc" 	=> "" ,
		"id" 	=> "_slideshow_layer_slider",
		"type" 	=> "select",
		"std" 	=> "flexslider",
		"slug"  => "slideshow_meta",
		"no_first" => true,
		"required" => array('_slideshow_type', 'layer_slider'),
		"subtype" => $layers),

		array(	
		"name" 	=> __("Select one of the sliders you have created", 'themeple'),
		"desc" 	=> "" ,
		"id" 	=> "_slideshow_revolution",
		"type" 	=> "select",
		"std" 	=> "flexslider",
		"slug"  => "slideshow_meta",
		"no_first" => true,
		"required" => array('_slideshow_type', 'revolution'),
		"subtype" => $revsliders),


	array(	
		"name" 	=> __("Which Slider do you want to use?", 'themeple'),
		"desc" 	=> "Select one of defined sliders. Default flexslider" ,
		"id" 	=> "_slideshow_type",
		"type" 	=> "select",
		"slug"  => "slideshow_meta_portfolio",
		"no_first" => true,
		"subtype" => array( 'Flexslider'=>'flexslider', 'No Slider'=>'no_slider')),
		

		array(	"name" 	=>  "Featured Media",
							"id" 	=>  "slideshow",
							"type" 	=> "upload_gallery",
							"slug"  => "media",
							"nodescription" => true,
							"label"	=> "Add to slideshow",
							"button_video"	=>"Add Video or Iframe by URL",
							'subelements' 	=> array(	
							
    							array(	"name" 	=> "Featured Media",
    							"desc" 	=> 	"",
    							"id" 	=>  "slideshow_image",
    							"type" 	=> "gallery_image",
    							"slug"  => "media",
    							"nodescription" => true,
    							"subtype" => "advanced",
    							"label"	=> "Insert"),
    							
    							array(	"name" 	=> "",
    							"desc" 	=> 	"",
    							"id" 	=>  "slideshow_video",
    							"type" 	=> "input_text",
    							"class"	=> "slideshow_video_input",
    							"slug"  => "media",
    							"simple"=> true,
    							"class"=> 'slideshow_video_input',
    							"nodescription" => true),
							array(	"name" 	=> "Animation First Caption",
    							"desc" 	=> 	"",
    							"id" 	=>  "slideshow_description",
    							"type" 	=> "input_text",
    							"class"	=> "",
    							"slug"  => "media",
    							"simple"=> true,
    							
    							"nodescription" => false),
							array(	"name" 	=> "Animation Second Caption",
    							"desc" 	=> 	"",
    							"id" 	=>  "slideshow_description_2",
    							"type" 	=> "input_text",
    							"class"	=> "",
    							"slug"  => "media",
    							"simple"=> true,
    							
    							"nodescription" => false),

							array(	"name" 	=> "Text Thumbnail Title",
    							"desc" 	=> 	"",
    							"id" 	=>  "text_thumb_title",
    							"type" 	=> "input_text",
    							"class"	=> "",
    							"slug"  => "media",
    							"simple"=> true,
    							"required" => array('_slideshow_type', 'flex_text_thumbnail'),
    							"nodescription" => false),

							array(	"name" 	=> "Text Thumbnail Desc",
    							"desc" 	=> 	"",
    							"id" 	=>  "text_thumb_desc",
    							"type" 	=> "textarea",
    							"class"	=> "",
    							"slug"  => "media",
    							"simple"=> true,
    							"required" => array('_slideshow_type', 'flex_text_thumbnail'),
    							"nodescription" => false),

							
							array(	"slug"	=> "media", "type" => "visual_group_start", "id" => "group1", "nodescription" => true),
								
								
								array(	"slug"	=> "media", "type" => "visual_group_start", "id" => "group1", "nodescription" => true,'name'=>'Default Options'),
	
								
								
										
								
							            
							    array(	"slug"	=> "media", "type" => "visual_group_end", "id" => "tab1_end", "nodescription" => true),
							    
							    
								
								
								
		    							    
							   
							   
							  array(	"slug"	=> "media", "type" => "visual_group_end", "id" => "tab_container_end", "nodescription" => true),
	
							)
						),
							

			
			
			
			
			
		
);

$elements[] = 	array(	"name" 	=>  "Featured Media",
							"id" 	=>  "slideshow",
							"type" 	=> "upload_gallery",
							"slug"  => "media_serv",
							"nodescription" => true,
							"label"	=> "Add to slideshow",
							"button_video"	=>"Add Video or Iframe by URL",
							'subelements' 	=> array(	
							
    							array(	"name" 	=> "Featured Media",
    							"desc" 	=> 	"",
    							"id" 	=>  "slideshow_image",
    							"type" 	=> "gallery_image",
    							"slug"  => "media_serv",
    							"nodescription" => true,
    							"subtype" => "advanced",
    							"label"	=> "Insert"),
    							
    							
							
							
								array(	"slug"	=> "media_serv", "type" => "visual_group_start", "id" => "group1", "nodescription" => true),
								
								
								array(	"slug"	=> "media_serv", "type" => "visual_group_start", "id" => "group2", "nodescription" => true,'name'=>'Default Options'),
	
								array(	
										"name" 	=> "Write here the link of video if you want to display a video on lightbox",
		    							"desc" 	=> 	"",
		    							"id" 	=>  "slideshow_video",
		    							"type" 	=> "input_text",
		    							"slug"  => "media_serv"
		    							),
								
										
								
							            
							    array(	"slug"	=> "media_serv", "type" => "visual_group_end", "id" => "group2_end", "nodescription" => true),
							    
							    
								
								
								
		    							    
							   
							   
							  	array(	"slug"	=> "media_serv", "type" => "visual_group_end", "id" => "group1_end", "nodescription" => true),
	
							)
						);

$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "facebook_link", 
                    "name"          => __("Facebook Link", 'themeple'),
					"slug"			=> "social_links");

$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "twitter_link", 
                    "name"          => __("Twitter Link", 'themeple'),
					"slug"			=> "social_links");
$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "google_link", 
                    "name"          => __("Google Plus Link", 'themeple'),
					"slug"			=> "social_links");
$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "linkedin_link", 
                    "name"          => __("Linkedin Link", 'themeple'),
					"slug"			=> "social_links");
$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "pinterest_link", 
                    "name"          => __("Piterest Link", 'themeple'),
					"slug"			=> "social_links");  
$elements[] =	array(
					"type" 		=> "input_text", 
					"id" 			=> "mail_link", 
                    "name"          => __("Mail Address", 'themeple'),
					"slug"			=> "social_links");


$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "staff_position_", 
                    "name"          => __("The position of the employer", 'themeple'),
					"slug"			=> "staff_position");


$elements[] =	array(
					"type" 			=> "radioimage", 
					"id" 			=> "service_image", 
                    "name"          => __("The position of the image you have selected as feature image", 'themeple'),
					"slug"			=> "services_options",
					"std" => "right",
					"subtype"           => array( 
                                                     array('name' => 'Left Side', 'value' =>'left', 'img' => '90x62/imageleft.png'),
                                                     array('name' => 'Right Side', 'value' =>'right', 'img' => '90x62/imageright.png'),
                                                )
);

$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "header_top", 
                    "name"          => __("Header text on the top?", 'themeple'),
					"slug"			=> "header_options"
);

$elements[] =	array(
					"type" 			=> "select", 
					"id" 			=> "header_type", 
                    "name"          => __("Select the style that you want to display the content before the slideshow", 'themeple'),
					"slug"			=> "header_options",
					"subtype"		=> array("First Format" => 'v1', 'Second Format' => "v2", 'Only a colored line' => "v3")
					);

$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "biggest_title", 
                    "name"          => __("Biggest Title", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v1")
);

$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "second_title", 
                    "name"          => __("Second Title", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v1")
);

$elements[] =	array(
					"type" 			=> "textarea", 
					"id" 			=> "right_description", 
                    "name"          => __("Right Description", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v1")
);

$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "link_title", 
                    "name"          => __("Link Title", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v1")
);

$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "link_href", 
                    "name"          => __("Link", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v1")
);

$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "title_1", 
                    "name"          => __("Title 1", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v2")
);

$elements[] =	array(
					"type" 			=> "iconset", 
					"id" 			=> "icon_1", 
                    "name"          => __("Icon 1", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v2")
);




$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "title_2", 
                    "name"          => __("Title 2", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v2")
);

$elements[] =	array(
					"type" 			=> "iconset", 
					"id" 			=> "icon_2", 
                    "name"          => __("Icon 2", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v2")
);



$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "title_3", 
                    "name"          => __("Title 3", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v2")
);

$elements[] =	array(
					"type" 			=> "iconset", 
					"id" 			=> "icon_3", 
                    "name"          => __("Icon 3", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v2")
);


$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "title_4", 
                    "name"          => __("Title 4", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v2")
);

$elements[] =	array(
					"type" 			=> "iconset", 
					"id" 			=> "icon_4", 
                    "name"          => __("Icon 4", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v2")
);


$elements[] =	array(
					"type" 			=> "switchbutton", 
					"id" 			=> "page_header_bool", 
					"std"			=> "yes",
                    "name"          => __("Do you want page Header?", 'themeple'),
					"slug"			=> "page_header");

/*$elements[] = array(

					"type"    => "switchbutton",
					"id"      => "page_header_transparent",
					"std"	  => "no",
					"name"	  =>__("Do you want a transparent header", "themeple"),
					"slug"    =>"page_header"	

	);*/



$elements[] = array(

					"type"    => "switchbutton",
					"id"      => "page_header_border_bottom",
					"std"	  => "yes",
					"name"	  =>__("Do you want border bottom", "themeple"),
					"slug"    =>"page_header"	
);


$elements[] =	array(
					"type" 			=> "select", 
					"id" 			=> "page_header_style", 
					"std"			=> "basic",
					"no_first"      => true,
                    "name"          => __("Page Header Style", 'themeple'),
					"slug"			=> "page_header",
					"subtype"       => array("Basic" => 'basic', 'Centered' => 'centered', 'Left' => 'left'),
					"required"      => array('page_header_bool', 'yes'));


$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "second_title", 
					"std"			=> "",
                    "name"          => __("Second Title", 'themeple'),
					"slug"			=> "page_header", 
					"required"      => array('page_header_style', 'centered')
					

					); 

$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "second_title_left", 
					"std"			=> "",
                    "name"          => __("Second Title", 'themeple'),
					"slug"			=> "page_header", 
					"required"      => array('page_header_style' , 'left')
					); 

$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "description_left", 
					"std"			=> "",
                    "name"          => __("Description After Title", 'themeple'),
					"slug"			=> "page_header", 
					"required"      => array('page_header_style', 'left')
				
					); 

$elements[] = 	array(
	                "type" 		    => "colorpicker", 
					"id" 			=> "page_header_basic_font_color", 
					"std"			=> "#fff",
                    "name"          => __("Select the color", 'themeple'),
                    "required"      => array('page_header_style', 'basic'),
					"slug"			=> "page_header");

$elements[] = array(
	                "type" 		    => "input_text", 
					"id" 			=> "page_header_basic_title_size", 
					"std"			=> "50px",
                    "name"          => __("Set the size of the H1", 'themeple'),
                    "required"      => array('page_header_style', 'basic'),
					"slug"			=> "page_header");


$elements[] = array(
	                "type" 		    => "input_text", 
					"id" 			=> "page_header_basic_breadcrumbs_size", 
					"std"			=> "13px",
                    "name"          => __("Set the size of the breadcrumbs", 'themeple'),
                    "required"      => array('page_header_style', 'basic'),
					"slug"			=> "page_header");


$elements[] = 	array(
	                "type" 		    => "colorpicker", 
					"id" 			=> "page_header_basic_bg_color", 
					"std"			=> "#f6f6f6",
                    "name"          => __("Select the background color", 'themeple'),
                    "required"      => array('page_header_style', 'basic'),
					"slug"			=> "page_header");

$elements[] = 	array(
	                "type" 		    => "colorpicker", 
					"id" 			=> "page_header_left_font_color", 
					"std"			=> "#fff",
                    "name"          => __("Select the color", 'themeple'),
                    "required"      => array('page_header_style', 'left'),
					"slug"			=> "page_header");


$elements[] = 	array(
	                "type" 		    => "select", 
					"id" 			=> "header_type", 
					"std"			=> "color",
					"no_first"      => true,
                    "name"          => __("Background Color or Background Image ?", 'themeple'),
                    "subtype"		=> array('Background Color' => 'color', 'Background Image' => 'image', 'Video Background' => 'video_bg'),
                    "required"      => array('page_header_style', 'centered'),
					"slug"			=> "page_header");

$elements[] = 	array(
	                "type" 		    => "input_text", 
					"id" 			=> "page_header_height", 
					"std"			=> "270px",
                    "name"          => __("Page Header height size", 'themeple'), 
                    "required"      => array('page_header_style', 'centered'),
					"slug"			=> "page_header");

/*$elements[] = 	array(
	                "type" 		    => "colorpicker", 
					"id" 			=> "color_pick", 
					"std"			=> "#fff",
                    "name"          => __("Select the color", 'themeple'),
                    "required"      => array('header_type', 'color'),
					"slug"			=> "page_header");*/

$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "video_webm", 
					"std"			=> "",
                    "name"          => __("Webm link", 'themeple'),
					"slug"			=> "page_header",
					"required"      => array('header_type', 'video_bg'));

$elements[] =	array(
					"type" 			=> "input_text",  
					"id" 			=> "video_mp4", 
					"std"			=> "",
                    "name"          => __("Mp4 link", 'themeple'),
					"slug"			=> "page_header",
					"required"      => array('header_type', 'video_bg'));

$elements[] = 	array(
	                "type" 		    => "colorpicker", 
					"id" 			=> "page_header_font_color", 
					"std"			=> "#2f383d",
                    "name"          => __("Select the color", 'themeple'),
                    "required"      => array('page_header_style', 'centered'),
					"slug"			=> "page_header");


$elements[] = 	array(
	                "type" 		    => "upload", 
	                "btn_text"		=> "Upload",
					"id" 			=> "background_image", 
					"std"			=> THEMEPLE_BASE_URL."img/default_header.jpg",
                    "name"          => __("Upload The Background", 'themeple'),
					"slug"			=> "page_header");

$elements[] = 	array(
	                "type" 		    => "select", 
	                "subtype"		=> array("Centered" => 'centered', 'Full' => 'full'),
					"id" 			=> "centered", 
					"std"			=> "full",
                    "name"          => __("Centered or full?", 'themeple'),
                    "required"      => array('header_type', 'image'),
					"slug"			=> "page_header");




$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "author_project", 
					"std"			=> "",
                    "name"          => __("Project Author", 'themeple'),
					"slug"			=> "project_info");


$elements[] =	array(
					"type" 			=> "switchbutton", 
					"id" 			=> "one_page_bool_", 
					"std"			=> "no",
                    "name"          => __("Use as One Page", 'themeple'),
					"slug"			=> "one_page");

$elements[] =	array(
					"type" 			=> "select", 
					"id" 			=> "one_page_menu", 
					"std"			=> "no",
					"subtype"       => array_flip($menus),
					"no_first"      => true,
					"description"   => 'Select the navigation menu to be used for this one page. Dont forget to insert into the items links "#sectionName", where sectionName is the name you have entered in the row',
                    "name"          => __("Select navigation", 'themeple'),
                    "required"      => array("one_page_bool_", 'yes'),
					"slug"			=> "one_page");

$portfolio_metas = themeple_get_option('portfolio-meta', array(array('meta'=>'Website:')));

if(!empty($portfolio_metas)):


$counter = 0;

foreach($portfolio_metas as $p_meta)
{
	if(!empty($p_meta['meta']))
	{

		$counter ++;
        $elements[] = array(    
                                   "name"    => $p_meta['meta'],
                                   "slug"    => "portfolio-meta",
                                   "desc"    => "",
                                   "id"      => "meta_$counter",
                                   "std"     => "",
                                   "type"    => "textarea");	
	}
}


$boxes[]    = array( 'title' =>  __('Portfolio Meta Information', 'themeple'), 'id'=>'portfolio-meta' , 'page'=>array('portfolio'), 'context'=>'normal', 'priority'=>'high' );
endif;


