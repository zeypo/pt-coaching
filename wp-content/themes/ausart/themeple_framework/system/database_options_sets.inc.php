<?php if(!defined('THEMEPLE_FRAMEWORK')) exit("Direct script access not allowed");





if(! class_exists('themeple_database_options_sets')){



    /**

     * themeple_database_options_sets

     * 

     * @package   

     * @author roshi

     * @copyright roshi[www.themeforest.net/user/roshi]

     * @version 2012

     * @access public

     */

    class themeple_database_options_sets{

        

        var $controller;

        

        var $elements;

        

        /**

         * themeple_database_options_sets::themeple_database_options_sets()

         * 

         * @param bool $controller

         * @return

         */

        function themeple_database_options_sets($controller = false)

        {

			if(!$controller)

			{ 

				$this->controller = $GLOBALS['themeple_controller']; 

			}

			else

			{

				$this->controller = $controller; 

			}

			

			$this->elements = $this->controller->page_elements; 

		}

        

        /**

         * themeple_database_options_sets::add_option_page()

         * 

         * @param mixed $data

         * @return

         */

        function add_option_page($data)

		{

			$data['slug'] = themeple_admin_safe_string( trim( $data['name'] ));

			$data_to_check = array($data['parent'], $data['name'], $data['slug'] );



			foreach($this->controller->admin_pages as $existing_page)

			{

				if($existing_page['title'] == trim($data['name']) || $existing_page['slug'] == $data['slug'])

				{

					return 'name_already_exists';

				}

			}



			

		

			$page_key = $data['prefix']."_dynamic_pages";

							

			$current_options = get_option($page_key);

			if($current_options == "") $current_options = array();

			

			 $result = array( 'slug' => themeple_admin_safe_string( $data['slug'] ), 

										'parent'=> $data['parent'], 

										'icon'=> $data['icon'] , 

										'title' => trim($data['name']), 

										'removable' => 'Remove Options Page', 

										);

										

			if(isset($data['sortable'])) $result['sortable'] = $data['sortable'];

	

			$current_options[]	= $result;			

			update_option($page_key, $current_options);

			



			return $result;

		}

        /**

         * themeple_database_options_sets::add_element_to_db()

         * 

         * @param mixed $element

         * @param mixed $data

         * @return

         */

        function add_element_to_db(&$element, $data)

		{

			$option_index = $data['prefix'].'_dynamic_elements';

			$current_options = get_option($option_index);

			$element = $this->create_unqiue_element_id($element, $current_options);

			$current_options[$element['id']]	= $element;

			update_option($option_index , $current_options);

						

		}

        /**

         * themeple_database_options_sets::get()

         * 

         * @param mixed $slug

         * @param bool $elements

         * @return

         */

        function get($slug, $elements = false)

		{

			if(!$elements) $elements = $this->elements;

			

			foreach( $elements as $element)

			{

				if($element['type'] == 'layout_section')

				{

					$option = $this->get($slug, $element['subelements']);

					if($option) return $option;

				}

			

				if(isset($element['id']) && $element['id'] == $slug)

				{	

					return $element;

				}

			}

		} 

        /**

         * themeple_database_options_sets::create_unqiue_element_id()

         * 

         * @param mixed $element

         * @param mixed $options

         * @return

         */

        function create_unqiue_element_id($element, $options)

		{

			$modifier = "";

			while($this->get($element['id'].$modifier, $options))

			{

				if($modifier == "") 

				{ 

					$modifier = 1;

				}

				else

				{

					$modifier++;

				}

			}



			$element['id'] = $element['id'].$modifier;

			return $element;

		}

        

        

        function remove_element_from_db($data)

		{

			$option_index = $data['prefix'].'_dynamic_elements';

			$current_options = get_option($option_index);

			

			foreach($current_options as $index => $element)

			{

				if($element['id'] == $data['elementSlug'])

				{	

					unset($current_options[$index]);

				}

			}



			update_option($option_index , $current_options);





		}

        

        function remove_dynamic_page($data)

		{

			$page_key = $data['prefix']."_dynamic_pages";

			$option_index = $data['prefix']."_dynamic_elements";

			$pages = get_option($page_key);

			$current_options = get_option($option_index);

			foreach($pages as $index => $page)

			{

				if($page['slug'] == $data['elementSlug'])

				{

					unset($pages[$index]);

					break;

				}

			}

			update_option($page_key, $pages);

			foreach($current_options as $index => $element)

			{

				if($element['slug'] == $data['elementSlug'])

				{	

					unset($current_options[$index]);

				}

			}

			update_option($option_index, $current_options);



		}





		function update_set($elements, $data)

		{

			$option_index = $data['prefix'];

			$current_options = get_option($option_index);

			

			if(is_array($elements)){

				if(count($elements) > 0){

					foreach($elements as $key => $value):



							$current_options['themeple'][$key] = $value;



					endforeach;

				}

			}

			if(isset($_POST['array_name'])){
				if($_POST['array_name'] == 'predefined'){
					$current_options['themeple']['change_skin'] = $data['color'];
				}else if($_POST['array_name'] == 'skin'){
					$current_options['themeple']['change_skin_2'] = $data['color'];
				}
			}

			

			unset($current_options['styling']);

			update_option($option_index, $current_options);

						

		}

        

     }  

}