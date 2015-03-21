<?php  if ( ! defined('THEMEPLE_FRAMEWORK')) exit('No direct script access allowed');



if( !class_exists( 'themeple_metabox' ) )
{

 
	/**
	 * themeple_metabox
	 * 
	 * @package 
     * @author roshi
     * @copyright roshi[www.themeforest.net/user/roshi]
     * @version 2012
	 * @access public
	 */
	class themeple_metabox
	{
		
		var $default_boxes;
		var $controller;
		var $box_elements;
		var $view;
		var $saved = false;
		var $js_data_set = false;
		var $meta_prefix = false;
		/**
		 * themeple_metabox::themeple_metabox()
		 * 
		 * @param mixed $controller
		 * @return
		 */
		function themeple_metabox($controller)
		{	
			
			if(basename( $_SERVER['PHP_SELF']) == "post-new.php" 
			|| basename( $_SERVER['PHP_SELF']) == "post.php")
			{	
				$this->controller = $controller;
				$this->view = new themeple_viewgen($controller);
				$this->view->used_for = "metabox";
				$this->meta_prefix = themeple_admin_safe_string($controller->base_data['prefix']);
				
				add_action('admin_menu', array(&$this, 'init_boxes'));
				add_action('save_post', array(&$this, 'save_post'));

			}
		}

		/**
		 * themeple_metabox::init_boxes()
		 * 
		 * @return
		 */
		function init_boxes()
		{	
			if(isset($_GET['post']))
			{
				$postId = $_GET['post'];
			}
			else
			{
				$postId = "";
			}

			include( THEMEPLE_BASE.'/template_inc/admin/admin_metabox.php' );
			
			if(isset($boxes) && isset($elements))
			{
				$this->default_boxes = $boxes;
				$this->box_elements  = $elements;
				
				//loop over the box array
				foreach($this->default_boxes as $key => $box)
				{				
					foreach ($box['page'] as $area)
					{	
						$box['iteration'] = $key;				
						add_meta_box( 	
							$box['id'], 							
							$box['title'],							
							array(&$this, 'create_meta_box'),		
							$area, 									
							$box['context'], 										
							$box['priority'],						
							array('themeple_current_metabox'=>$box) 
						);  
					}
				}
			}
		}
		
		
		/**
		 * themeple_metabox::create_meta_box()
		 * 
		 * @param mixed $currentPost
		 * @param mixed $metabox
		 * @return
		 */
		function create_meta_box($currentPost, $metabox)
		{	
			global $post;
			$output = "";
			$box = $metabox['args']['themeple_current_metabox'];
			
			if(!is_object($post)) return;
			
			$key = '_themeple_elements_'.$this->controller->db_options_prefix;
			

			
			$custom_fields = get_post_meta($post->ID, $key, true);
			$custom_fields = apply_filters('themeple_meta_box_filter', $custom_fields, $post->ID);

			foreach ($this->box_elements as $element)
			{	
				
				if(isset($element['slug']) && $element['slug'] == $box['id'])
				{
					if (method_exists($this->view, $element['type']))
					{	

						if(isset($custom_fields[$element['id']]))
						{
							$element['std'] = $custom_fields[$element['id']];
						}
					
						$output .= '<div class="themeple_meta_box themeple_meta_box_'.$element['type'].' meta_box_'.$box['context'].'">';
						$output .= $this->view->generate_element($element);
						
						if($element['type'] != 'visual_group_start')
							$output .= '</div>';
							
						if($element['type'] == 'visual_group_end')
							$output .= '</div>';
					}
				}
			}

			if(!$this->js_data_set)
			{
				$output .= $this->view->generate_js_data();
				$this->js_data_set = true;
			}
			echo $output;
			
			
		}
		
		
		/**
		 * themeple_metabox::save_post()
		 * 
		 * @return
		 */
		function save_post()
		{
			if(isset($_POST['post_ID']))
			{
				$must_check = false;
				
				if(!is_array($this->default_boxes) || !isset($_POST['post_ID']) || !isset($_POST['post_type']) || $this->saved) return;

				foreach($this->default_boxes as $default_box)
				{
					if(in_array( $_POST['post_type'] ,$default_box['page']))
					{
						$must_check = true;
					}
				}
		
				if(!$must_check) return;
				
				if(function_exists('check_ajax_referer')) { check_ajax_referer('themeple_admin_save_metabox','themeple_nonce'); }

				$post_id = $_POST['post_ID'];
				$capability = "edit_post";
				
				if ( 'page' == $_POST['post_type'] ) { $capability = "edit_page"; }

				if ( !current_user_can( $capability, $post_id  )) return $post_id ;
				

				
				$this->saved = true;
				$meta_array = array();
				
				foreach($this->box_elements as $box)
				{
					foreach($_POST as $key=>$value)
					{
						if(strpos($key, $box['id']) !== false)
						{							
							if(strpos($key, 'on_save_') !== false)
							{
								$function = str_replace('on_save_', "", $key);
							
							}
						
						
							$meta_array[$key] = $value;
						}
					}
				}
				
				$result = themeple_ajax_save_options_create_array($meta_array, true);
				update_post_meta($post_id , '_themeple_elements_'.$this->controller->db_options_prefix, $result);

				do_action('themeple_metabox_save', $post_id, $result);
			}
		}
	}
}


