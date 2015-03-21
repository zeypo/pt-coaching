<?php if(!defined('THEMEPLE_FRAMEWORK')) exit("Direct script access not allowed");
    /** 
     * @author roshi
     * @copyright roshi[www.themeforest.net/user/roshi]
     * @version 2012
     */

if(! class_exists('themeple_adminpages_gen')){

    /**
     * themeple_adminpages_gen
     * 
     * @package   
     * @author roshi
     * @copyright roshi[www.themeforest.net/user/roshi]
     * @version 2012
     * @access public
     */
    class themeple_adminpages_gen{
        
        var $controller;
        
        /**
         * themeple_adminpages_gen::themeple_adminpages_gen()
         * 
         * @return
         */
        function themeple_adminpages_gen(&$controller){
            $this->controller = $controller;
            add_action('admin_menu', array(&$this, 'add_pages_to_menu'));
            add_action('admin_menu', array(&$this, 'non_option_page_scripts'));
            
        }
        
        /**
         * themeple_adminpages_gen::add_pages_to_menu()
         * 
         * @return
         */
        function add_pages_to_menu(){
            if(count($this->controller->admin_pages) == 0) return;
				
			$create_page_method = 'add_object_page';
			if(!function_exists($create_page_method)) { $create_page_method = 'add_menu_page'; }
		    
			
			foreach( $this->controller->admin_pages as $key => $data )
			{
			
				
				if($key === 0)
				{	
					$the_title = apply_filters( 'themeple_filter_admin_page_title', $this->controller->base_data['Title'] );
				
					$top_level = $data['slug'];
					$page = $create_page_method(	    $the_title, 								
														$the_title, 								
														'edit_pages', 							
														$top_level, 								
														array(&$this, 'view_html')					
													);
				}
				
				if($data['parent'] == $data['slug'])
				{
				
					$page = add_submenu_page(	$top_level,							
													$data['title'], 			
													$data['title'], 		
													'edit_pages', 		
													$data['slug'], 					
													array(&$this, 'view_html'));	
				}
				
				if(!empty($page))
				{
					add_action('admin_print_scripts-' . $page, array(&$this, 'add_scripts'));
					add_action('admin_print_styles-'  . $page, array(&$this, 'add_styles'));
				}
			}
        }
        
        /**
         * themeple_adminpages_gen::add_scripts()
         * 
         * @return
         */
        function add_scripts(){
            wp_enqueue_script( 'thickbox' );
            wp_enqueue_script( 'jquery-ui-sortable' );
            wp_enqueue_script( 'jquery-ui-draggable' );
			wp_enqueue_script( 'media-upload' );
            wp_enqueue_script( 'farbtastic', THEMEPLE_JS_URL.'libraries/farbtastic.js' );
            wp_enqueue_script('jquery.fancybox', THEMEPLE_JS_URL . 'libraries/jquery.magnific-popup.min.js');
            wp_enqueue_script( 'jquery.gradientPicker',  THEMEPLE_JS_URL.'libraries/jquery.gradientPicker.js' );
            wp_enqueue_script( 'themeple_colorpicker', THEMEPLE_JS_URL.'themeple_colorpicker.js' );
            wp_enqueue_script( 'themeple_media', THEMEPLE_JS_URL.'themeple_media.js');  
            wp_enqueue_script( "themeple_options" , THEMEPLE_JS_URL . "themeple_options.js" ); 
            wp_enqueue_script( "themeple_dynamic" , THEMEPLE_JS_URL . "themeple_dynamic.js" ); 
            wp_enqueue_script( "themeple_upload_gallery", THEMEPLE_JS_URL . "themeple_upload_gallery.js");

        }
        /**
         * themeple_adminpages_gen::non_option_page_scripts()
         * 
         * @return
         */
        function non_option_page_scripts()
		{
			if(basename( $_SERVER['PHP_SELF']) == "post-new.php" 
			|| basename( $_SERVER['PHP_SELF']) == "post.php"
			|| basename( $_SERVER['PHP_SELF']) == "widgets.php"
			|| basename( $_SERVER['PHP_SELF']) == "media-upload.php")
			{	
				wp_enqueue_script( 'thickbox' );
                wp_enqueue_script( 'jquery-ui-sortable' );
                wp_enqueue_script( 'jquery-ui-draggable' );

                wp_enqueue_script( 'media-upload' );
                wp_enqueue_script( 'farbtastic', THEMEPLE_JS_URL.'libraries/farbtastic.js' );
                wp_enqueue_script( 'jquery.gradientPicker',  THEMEPLE_JS_URL.'libraries/jquery.gradientPicker.js' );
                wp_enqueue_script( 'themeple_colorpicker', THEMEPLE_JS_URL.'themeple_colorpicker.js' );  
                wp_enqueue_script( 'themeple_media', THEMEPLE_JS_URL.'themeple_media.js');           
                wp_enqueue_script( "themeple_options" , THEMEPLE_JS_URL . "themeple_options.js" ); 
                wp_enqueue_script( "themeple_dynamic" , THEMEPLE_JS_URL . "themeple_dynamic.js" ); 
                wp_enqueue_script( "themeple_upload_gallery", THEMEPLE_JS_URL . "themeple_upload_gallery.js");
                wp_enqueue_style('farbtastic', THEMEPLE_CSS_URL . 'farbtastic.css');
				wp_enqueue_style( 'thickbox' );
                wp_enqueue_style('colorpicker', THEMEPLE_CSS_URL . 'colorpicker.css');
                wp_enqueue_style('jquery.gradientPicker', THEMEPLE_CSS_URL . 'jquery.gradientPicker.css');
           	    wp_enqueue_style('themeple_metabox' , THEMEPLE_CSS_URL . 'themeple_metabox.css'); 
                wp_enqueue_style('vector_icons' , get_template_directory_uri() . '/css/vector-icons.css'); 
                wp_enqueue_style('linecon' , THEMEPLE_CSS_URL . 'linecon.css'); 
                wp_enqueue_style('steadysets' , THEMEPLE_CSS_URL . 'steadysets.css'); 
                wp_enqueue_script('fonticonpicker' , THEMEPLE_JS_URL . 'jquery.fonticonpicker.min.js'); 
                wp_enqueue_style('fonticonpicker_css' , THEMEPLE_CSS_URL . 'jquery.fonticonpicker.min.css'); 
			}
		}
        /**
         * themeple_adminpages_gen::view_html()
         * 
         * @return
         */
        function view_html(){
            
			$current_slug = $_GET['page'];
			$firstactive = 'active_section';
			
			foreach( $this->controller->admin_pages as $key => $data_set )
			{
				if($data_set['parent'] == $data_set['slug'] && $data_set['slug'] == $current_slug)
				{
					$this->controller->current['title'] = $data_set['title'];
					break;
				}
			}
			

			$this->controller->current['slug'] = $current_slug;
			$view = new themeple_viewgen($this->controller);
			
            echo $view->page_option_header();
			
            foreach($this->controller->admin_pages as $option_page)
			{
				if($current_slug == $option_page['parent'])
				{
					echo $view->generate_base_container($option_page, $firstactive);
					$firstactive = "";
				}
			}
            
            echo $view->page_option_footer();
			
        }
        
        /**
         * themeple_adminpages_gen::add_styles()
         * 
         * @return
         */
        function add_styles(){
            wp_enqueue_style( 'thickbox' );
            wp_enqueue_style('jquery.fancybox', THEMEPLE_JS_URL . 'libraries/magnific-popup.css');
            wp_enqueue_style('farbtastic', THEMEPLE_CSS_URL . 'farbtastic.css');
       	    wp_enqueue_style('themeple_style' , THEMEPLE_CSS_URL . 'themeple_style.css'); 
            wp_enqueue_style('vector_icons' , get_template_directory_uri() . '/css/vector-icons.css'); 
        }
        
        
    }
}
?>