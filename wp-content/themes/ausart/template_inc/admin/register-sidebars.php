<?php

if(function_exists('register_sidebar')){
    
function themeple_register_sidebars(){
    
    register_sidebar(array(
            'name' => __('Sidebar Blog', 'themeple'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">', 
    		'after_widget' => '</div>', 
    		'before_title' => '<h5 class="widget-title">', 
    		'after_title' => '</h5>'
    ));
  
    register_sidebar(array(
            'name' => __('Sidebar Pages', 'themeple'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">', 
    		'after_widget' => '</div>', 
    		'before_title' => '<h5 class="widget-title">', 
    		'after_title' => '</h5>'
    ));
    register_sidebar(array(
            'name' => __('Sidebar Portfolio', 'themeple'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">', 
    		'after_widget' => '</div>', 
    		'before_title' => '<h5 class="widget-title">', 
    		'after_title' => '</h5>'
    ));
    if(class_exists('woocommerce')){
	    register_sidebar(array(
	            'name' => __('Sidebar Woocommerce', 'themeple'),
	            'before_widget' => '<div id="%1$s" class="widget %2$s">', 
	    		'after_widget' => '</div>', 
	    		'before_title' => '<h5 class="widget-title">', 
	    		'after_title' => '</h5>'
	    ));
	}

    register_sidebar(array(
            'name' => __('Top Header Left', 'themeple'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">', 
    		'after_widget' => '</div>', 
    		'before_title' => '', 
    		'after_title' => ''
    ));




    register_sidebar(array(
            'name' => __('Top Header Right', 'themeple'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">', 
    		'after_widget' => '</div>', 
    		'before_title' => '', 
    		'after_title' => ''
    ));

    register_sidebar(array(
            'name' => __('Header Right Widgetized', 'themeple'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">', 
    		'after_widget' => '</div>', 
    		'before_title' => '', 
    		'after_title' => ''
    ));

      register_sidebar(array(
            'name' => __('Header Left Widgetized', 'themeple'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">', 
    		'after_widget' => '</div>', 
    		'before_title' => '', 
    		'after_title' => ''
    ));


    $footer_columns = themeple_get_option('footer_number_columns','2');
	
	for ($i = 1; $i <= $footer_columns; $i++)
	{
		register_sidebar(array(
    		'name' => 'Footer - column'.$i,
    		'before_widget' => '<div id="%1$s" class="widget %2$s">', 
    		'after_widget' => '</div>', 
    		'before_title' => '<h4 class="widget-title">', 
    		'after_title' => '</h4>', 
		));
	}
    

    register_sidebar(array(
            'name' => __('Copyright Footer Sidebar Left', 'themeple'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">', 
    		'after_widget' => '</div>', 
    		'before_title' => '', 
    		'after_title' => ''
    ));
    
    register_sidebar(array(
            'name' => __('Copyright Footer Sidebar Right', 'themeple'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">', 
    		'after_widget' => '</div>', 
    		'before_title' => '', 
    		'after_title' => ''
    ));
    
    
		$id_array = themeple_check_custom_widget('page', 'ids');
	
		if(isset($id_array[0]))
		{
			foreach ($id_array as $page_id)
			{	
				
				if($page_id != "")
				register_sidebar(array(
    				'name' => __('Page','themeple').': '.get_the_title($page_id).'',
    				'before_widget' => '<div id="%1$s" class="widget %2$s">', 
		    		'after_widget' => '</div>', 
		    		'before_title' => '<h4 class="widget-title">', 
    		'after_title' => '</h4>'
				));
			
			
		}
	}
			
		
		
			
		$id_array = themeple_check_custom_widget('cat', 'ids');
	
		if(isset($id_array[0]))
		{
			foreach ($id_array as $cat_id)
			{	
				
				if($cat_id != "")
				register_sidebar(array(
    				'name' => __('Category','themeple').': '.get_the_category_by_ID($cat_id).'',
    				'before_widget' => '<div id="%1$s" class="widget %2$s">', 
		    		'after_widget' => '</div>', 
		    		'before_title' => '<h4 class="widget-title">', 
    				'after_title' => '</h4>'		));
			
			
		  }
	   }
		
	
	

		$name_array = themeple_check_custom_widget('dynamic_template');
		    
			if(isset($name_array))
			{
	            foreach($name_array as $name){
					if($name != "")
					register_sidebar(array(
	    				'name' => 'Dynamic Template: Widget '.$name,
	    				'before_widget' => '<div class="dyn_widget"><div id="%1$s" class="widget %2$s">', 
	    				'after_widget' => '</div></div>', 
	    				'before_title' => '<h5 class="widget-title">', 
	    				'after_title' => '</h5>'
					));
				}
			
		   }

	}
	add_action('widgets_init', 'themeple_register_sidebars');
}

/*$theme_locations = get_nav_menu_locations();
$menu_obj = get_term( $theme_locations['main'], 'nav_menu' );

$items = wp_get_nav_menu_items( $menu_obj->term_id );
if(!empty($items)){
	foreach($items as $item){
		$value = get_post_meta($item->ID, '_menu-item-custom_themeple-widgetized');
		
		if($value[0] != ''){
			register_sidebar(array(
    				'name' => 'MegaMenu Widget '.$value[0],
    				'before_widget' => '<div class="dyn_widget"><div id="%1$s" class="widget %2$s">', 
    				'after_widget' => '</div></div>', 
    				'before_title' => '<h3 class="widget-title">', 
    				'after_title' => '</h3>'
				));
		}
	} 
}*/


function themeple_default_widgets($name)
	{
		
			if($name == 'categories'){
                echo "<div class='widget widget_categories'>";
				echo "<h3 class='widgettitle'>Categories</h3>";
				echo "<ul>";
				wp_list_categories('sort_column=name&optioncount=0&hierarchical=0&title_li=');
				echo "</ul>";
				echo "<span class='seperator extralight-border'></span></div>";
			}else
            if($name == 'archives'){
                echo "<div class='widget widget_archive'>";
				echo "<h3 class='widgettitle'>Archive</h3>";
				echo "<ul>";
				wp_get_archives('type=monthly');
				echo "</ul>";
				echo "<span class='seperator extralight-border'></span></div>";
			}else
            if($name == 'pages'){
                echo "<div class='widget widget_pages'>";
				echo "<h3 class='widgettitle'>Pages</h3>";
				echo "<ul>";
				wp_list_pages('title_li=&depth=-1' );
				echo "</ul>";
				echo "<span class='seperator extralight-border'></span></div>";
			}else
            if($name == 'bookmarks'){
                echo "<div class='widget widget_archive'>";
				echo "<h3 class='widgettitle'>Bookmarks</h3>";
				echo "<ul>";
				wp_list_bookmarks('title_li=&categorize=0');
				echo "</ul>";
				echo "<span class='seperator extralight-border'></span></div>";
			}else
			if($name == 'recent_comments'){
				echo "<div class='widget widget_recent_comments'>";
				echo "<h3 class='widgettitle'>Recent Comments</h3>";
				echo "<ul>";
				wp_get_recent_posts('numberposts=5');
				echo "</ul>";
				echo "<span class='seperator extralight-border'></span></div>";

			}
			
	}


?>