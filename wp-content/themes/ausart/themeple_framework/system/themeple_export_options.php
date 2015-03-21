<?php

if( !class_exists( 'themeple_export' ) )
{
	class themeple_export 
	{
		function themeple_export($controller)
		{
			if(!isset($_GET['themeple_export'])) return;
		
			$this->controller = $controller;
			$this->subs = $controller->subs;
			$this->options  = $controller->options;
			$this->db_options_prefix = $controller->db_options_prefix;
			
			add_action('admin_init',array(&$this, 'initiate'),200);
		}
		
		function initiate()
		{

			foreach($this->subs as $subpage_key => $subpage)
			{
				$export[$subpage_key] = $this->export_array_generator($this->controller->page_elements, $this->options[$subpage_key], $subpage);
			}

			$export = base64_encode(serialize($export));

			$export_dynamic_pages = get_option($this->db_options_prefix.'_dynamic_pages');
			if($export_dynamic_pages) $export_dynamic_pages = base64_encode(serialize($export_dynamic_pages));

			$export_dynamic_elements = get_option($this->db_options_prefix.'_dynamic_elements');
			if($export_dynamic_elements) $export_dynamic_elements = serialize($export_dynamic_elements);
			
			/*echo '<pre>&#60?php '."\n\n";
			echo ''."\n\n";
			echo '$options = "';
			print_r($export);
			echo '";</pre>'."\n\n";
			
			echo '<pre>'."\n";
			echo '$dynamic_pages = "';
			print_r($export_dynamic_pages);
			echo '";</pre>';*/
			
			
			echo($export_dynamic_elements);
			

			exit();
		}
		 
		
		
		function export_array_generator($elements, $options, $subpage, $grouped = false)
		{	

			$export = array();
			foreach($elements as $element)
			{
				if((in_array($element['slug'], $subpage) || $grouped) && isset($element['id']) && isset($options[$element['id']]))
				{
					if($element['type'] != 'layout_section')
					{
						if(isset($element['subtype']) && !is_array($element['subtype']))
						{
							$taxonomy = false;
							if(isset($element['taxonomy'])) $taxonomy = $element['taxonomy'];
							
							$value = $this->helper($options[$element['id']] , $element['subtype'], $taxonomy);
						}
						else
						{
							
							$value = $options[$element['id']];
						}
						
						if(isset($value))
						{
							$element['std'] = $value;
							$export[$element['id']] = $element;
						}
					}
					else
					{
						$iterations = count($options[$element['id']]);
						$export[$element['id']] = $element;
						for($i = 0; $i < $iterations; $i++)
						{
							$export[$element['id']]['std'][$i] = $this->export_array_generator($element['subelements'], $options[$element['id']][$i], $subpage, true);
						}
					}
				}
			}
			
			return $export;
			
		}
        
        

	function helper($id, $type, $taxonomy = false)
	{	
		switch ($type)
		{
			case 'page':
			case 'post':	
				$the_post = get_post($id);
				if(isset($the_post->post_title)) return $the_post->post_title;
			break;
			
			case 'cat':	
				$return = array();
				$ids = explode(',',$id);
				foreach($ids as $cat_id)
				{	
					if($cat_id)
					{
						if(!$taxonomy) $taxonomy = 'category';
						$cat = get_term( $cat_id, $taxonomy );

						if($cat) $return[] = $cat->name;
					}
				}
			if(!empty($return)) return $return;
			
				

			break;
		}
	}

		
		

		
	}
}


