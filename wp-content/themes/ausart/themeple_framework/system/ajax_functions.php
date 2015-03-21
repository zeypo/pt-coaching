<?php

	/** 

     * @author roshi

     * @copyright roshi[www.themeforest.net/user/roshi]

     * @version 2012

     */

if(!function_exists('themeple_admin_save_data')){

    

    /**

     * themeple_admin_save_data()

     * 

     * @return

     */

    function themeple_admin_save_data(){

        if(function_exists('check_ajax_referer')) { check_ajax_referer('themeple_admin_save_data'); }

		if(!isset($_POST['data']) || !isset($_POST['prefix']) || !isset($_POST['slug'])) { die(); }

		

		$optionkey = $_POST['prefix'];		

		$data_sets = explode("&",$_POST['data']);	

		$store_me = themeple_ajax_save_options_create_array($data_sets);
		
		$current_options = get_option($optionkey);
		
        
		foreach($store_me as $key => $value){
			$current_options[$_POST['slug']][$key] = $value;
		}
		
        if(isset($_POST['dynamicOrder']) && $_POST['dynamicOrder'] != "")

		{

			global $themeple_controller;

			$current_elments = array();

			$options = get_option($optionkey.'_dynamic_elements');	
			

			
			foreach($options as $key => $element)

			{

				if(in_array($element['slug'], $themeple_controller->subs[$_POST['slug']]))

				{

					$current_elments[$key] = $element;

					unset($options[$key]);

				} 

			}

		

		

			$sortedOptions = array();

			$neworder = explode('-__-',$_POST['dynamicOrder']);
			
			$updated_pages = array();
			$updated_elements = array();
			foreach($neworder as $key)

			{

				if($key != "" && array_key_exists($key, $current_elments)){
					if(!in_array($current_elments[$key]['slug'], $updated_pages))
						$updated_pages[] = $current_elments[$key]['slug'];
					
					$keyy = $current_elments[$key]['slug'];
					$updated_elements[$keyy][] = $key;
				}

			}
			
			
			foreach($current_elments as $key => $element)

			{

				if($key != "") 

				{
					if(in_array($element['slug'], $updated_pages)){
						if(is_array($updated_elements[$element['slug']])){
							foreach($updated_elements[$element['slug']] as $el){
								$sortedOptions[$el] = $current_elments[$el];
								
							}
							foreach($current_elments as $key => $del){
								if($del['slug'] == $element['slug']){
									unset($current_elements[$key]);
								}
							}
						}
					}else{
						$sortedOptions[$key] = $element;
					}
					

				}

			}

			$options = array_merge($options, $sortedOptions);
			


			update_option($optionkey.'_dynamic_elements', $options);

		}

		update_option($optionkey, $current_options);	

		

		

		die('themeple_save');

    }

    

    add_action('wp_ajax_themeple_admin_save_data', 'themeple_admin_save_data');

    

}

if(!function_exists('themeple_get_options_ajax')){
	function themeple_get_options_ajax(){
		global $themeple_controller;
		$results = '';
		$viewgen = new themeple_viewgen();
		$viewgen->controller->current['slug'] = $_POST['slug'];

		$html_elements = $themeple_controller->getElements($_POST['slug_']);

		$results .= '<div class="elements_">';
		if(count($html_elements) > 0){
            foreach($html_elements as $el){
            	
                $results .= $viewgen->generate_element($el);
            }
        }
        $results .= '</div>';
		die($results);
	}

	add_action('wp_ajax_themeple_get_options_ajax', 'themeple_get_options_ajax');

}

if(!function_exists('themeple_ajax_save_options_create_array'))

{

	/**

	 * themeple_ajax_save_options_create_array()

	 * 

	 * @param mixed $data_sets

	 * @param bool $global_post_array

	 * @return

	 */

	function themeple_ajax_save_options_create_array($data_sets, $global_post_array = false)

	{

		$result = array();

		$charset = get_bloginfo('charset');



		foreach($data_sets as $key => $set)

		{

			$temp_set = array();



			if($global_post_array)

			{

				$temp_set[0] = $key;

				$temp_set[1] = $set;

				$set = $temp_set;

			}

			else

			{



				$set = explode("=", $set);

				

			}



			$set[1] = htmlentities(urldecode($set[1]), ENT_QUOTES, $charset);

			$set[1] = stripslashes($set[1]);



			 

			if($set[0] != "") 

			{

				if(strpos($set[0], '-__-') !== false)

				{

					$set[0] = explode('-__-',$set[0]);

					

					

					_recursive_($set[0], $result, $set[1], 0, count($set[0]) );

					

				}

				else

				{

					$result[$set[0]] = $set[1];

				}

			}

		}

		

	return $result;

	}

}



function _recursive_($set, &$current, $value, $i, $length){

	

	if($length-1 == $i)

		$current[$set[$i]] = $value;

	else

		_recursive_($set, $current[$set[$i]], $value,  $i+1, $length);

}



if(!function_exists('themeple_ajax_create_dynamic_options'))

{

	/**

	 * themeple_ajax_create_dynamic_options()

	 * 

	 * @return

	 */

	function themeple_ajax_create_dynamic_options()

	{



		if(function_exists('check_ajax_referer')) { check_ajax_referer('themeple_admin_save_data'); }

		$options = new themeple_database_options_sets();

		

		if($_POST['method'] == 'add_option_page')

		{

			$result = $options->add_option_page($_POST);



			if(is_array($result))

			{

				$html = new themeple_viewgen();

				$new_slug = $result['slug'];

				$result = "{themeple_ajax_option_page}" .$html->generate_base_container($result) ."{/themeple_ajax_option_page}";

				

				if(isset($_POST['default_elements']))

				{	

					$elements = unserialize( base64_decode( $_POST['default_elements'] ) );

					

					$result .= "{themeple_ajax_element}";

					foreach($elements as &$element)

					{

						$element['id']   = $new_slug . $element['id'];

						$element['slug'] = $new_slug;



						$result .=  $html->generate_element($element);



						$options->add_element_to_db($element, $_POST);

					}

					$result .= "{/themeple_ajax_element}";



				}

			}

		}

		

		



		

		die($result);

	}



	add_action('wp_ajax_themeple_ajax_create_dynamic_options', 'themeple_ajax_create_dynamic_options');

}



/**

 * themeple_ajax_fetch_all()

 * 

 * @param mixed $element

 * @param mixed $sent_data

 * @return

 */

function themeple_ajax_fetch_all($element, $sent_data)

{

	$post_id = $sent_data['apply_all'];

	$args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $post_id); 

	$attachments = get_posts($args);

	if($attachments && is_array($attachments))

	{

		$counter = 0;

		$element['ajax_request'] = count($attachments);

		foreach($attachments as $attachment)

		{

			$element['std'][$counter]['slideshow_image'] = $attachment->ID;

			$counter++;

		}

	}

	return $element;

}



if(!function_exists("themeple_ajax_modify_table")){

    /**

     * themeple_ajax_modify_table()

     * 

     * @return

     */

    function themeple_ajax_modify_table(){



		if($_POST['method'] == 'add')

		{

            

			$html = new themeple_viewgen();

			$sets = new themeple_database_options_sets();

			

			if(isset($_POST['context']))

			{    

			     $html->used_for = $_POST['context'];



				if($_POST['context'] =='custom_set')

				{

					if(! @include(THEMEPLE_BASE.$_POST['configFile'])) include($_POST['configFile']);

					$sets->elements = $elements;

				}

                

                if($_POST['context'] =='metabox')

				{

					include( THEMEPLE_BASE.'/template_inc/admin/admin_metabox.php' );

					$sets->elements = $elements;

				}

			}



		

			$element = $sets->get($_POST['elementSlug']);

           

			if($element)

			{

				if(isset($_POST['context']) && $_POST['context'] =='custom_set')

				{

					$element['slug'] = $_POST['optionSlug'];

					$element['id']   = $_POST['optionSlug'] . $element['id'];

				

					$sets->add_element_to_db($element, $_POST);

				}

				

				if(isset($_POST['std']))

				{

					$element['std'][0] = $_POST['std'];

				}

				

				if(isset($_POST['apply_all']))

				{

					$element['apply_all'] = $_POST['apply_all'];

				}

				

				

				$element['ajax_request'] = 1;

				

				if(isset($_POST['apply_filter'])){

				    add_filter('themeple_generate_element_filter', $_POST['apply_filter'], 10, 2);

				}

                $element = apply_filters('themeple_generate_element_filter', $element, $_POST);

				echo "{themeple_ajax_element}" .$html->generate_element($element) ."{/themeple_ajax_element}";

				

			}

		}

			



		die();

	}

    

    add_action("wp_ajax_themeple_ajax_modify_table", "themeple_ajax_modify_table");

}



if(!function_exists('themeple_get_image_ajax')){

    /**

     * themeple_get_image_ajax()

     * 

     * @return

     */

    function themeple_get_image_ajax(){



		$attachment_id = (int) $_POST['attachment_id'];

		$attachment = get_post($attachment_id);

		$mime_type = $attachment->post_mime_type;

				

		if (strpos($mime_type, 'flash') !== false || substr($mime_type, 0, 5) == 'video')

		{

			$output = $attachment->guid;

		}

		else

		{

			$output = wp_get_attachment_image($attachment_id, array(100,100));

		}



		die($output);

	}



	add_action('wp_ajax_themeple_get_image_ajax', 'themeple_get_image_ajax');

    

}



if(!function_exists('themeple_ajax_delete_dynamic_element'))

{

	function themeple_ajax_delete_dynamic_element()

	{

		if(function_exists('check_ajax_referer')) { check_ajax_referer('themeple_admin_save_data'); }

		$options = new themeple_database_options_sets();



		$options->remove_element_from_db($_POST);

		

		die('themeple_removed_element');

	}



	add_action('wp_ajax_themeple_ajax_delete_dynamic_element', 'themeple_ajax_delete_dynamic_element');

}



if(!function_exists('themeple_ajax_delete_dynamic_options'))

{

	function themeple_ajax_delete_dynamic_options()

	{

		if(function_exists('check_ajax_referer')) { check_ajax_referer('themeple_admin_save_data'); }

		$options = new themeple_database_options_sets();

		$options->remove_dynamic_page($_POST);

		die("themeple_removed_page");

	}

	add_action('wp_ajax_themeple_ajax_delete_dynamic_options', 'themeple_ajax_delete_dynamic_options');

}



if(!function_exists('themeple_ajax_themeple_ajax_dummy_data')){

    function themeple_ajax_dummy_data(){

        if(function_exists('check_ajax_referer')) { check_ajax_referer('themeple_nonce_import_dummy_data'); }

        require_once THEMEPLE_FW_SYSTEM . 'dummy_data.inc.php';

		die('themeple_dummy');

    }

    add_action('wp_ajax_themeple_ajax_dummy_data', 'themeple_ajax_dummy_data');

}



if(!function_exists('themeple_ajax_change_skin'))

{

	function themeple_ajax_change_skin()

	{

		if(function_exists('check_ajax_referer')) { check_ajax_referer('themeple_admin_save_data'); }

		$options = new themeple_database_options_sets();

		include( THEMEPLE_BASE.'/template_inc/admin/register_skins.php' );

		var_dump($_POST['array_name']);

		$options->update_set(${$_POST['array_name']}[$_POST['color']], $_POST);

		

		die('themeple_changed_skin');

	}



	add_action('wp_ajax_themeple_ajax_change_skin', 'themeple_ajax_change_skin');

}





if(!function_exists('themeple_custom_change_walker'))

{

	function themeple_custom_change_walker()

	{	

		if ( ! current_user_can( 'edit_theme_options' ) )

		die('-1');



		check_ajax_referer( 'add-menu_item', 'menu-settings-column-nonce' );

	

		require_once ABSPATH . 'wp-admin/includes/nav-menu.php';

	

		$item_ids = wp_save_nav_menu_items( 0, $_POST['menu-item'] );

		if ( is_wp_error( $item_ids ) )

			die('-1');

	

		foreach ( (array) $item_ids as $menu_item_id ) {

			$menu_obj = get_post( $menu_item_id );

			if ( ! empty( $menu_obj->ID ) ) {

				$menu_obj = wp_setup_nav_menu_item( $menu_obj );

				$menu_obj->label = $menu_obj->title; 

				$menu_items[] = $menu_obj;

			}

		}

	

		if ( ! empty( $menu_items ) ) {

			$args = array(

				'after' => '',

				'before' => '',

				'link_after' => '',

				'link_before' => '',

				'walker' => new themeple_custom_menu_backend,

			);

			echo walk_nav_menu_tree( $menu_items, 0, (object) $args );

		}

		

		die('end');

	}

	

	//hook into wordpress admin.php

	add_action('wp_ajax_themeple_custom_change_walker', 'themeple_custom_change_walker');

}

?>