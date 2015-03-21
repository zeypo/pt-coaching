<?php
	/** 
     * @author roshi
     * @copyright roshi[www.themeforest.net/user/roshi]
     * @version 2012
     */
class themeple_dummy_data extends WP_Import{
    
    
    function save_theme_options($option_file)
	{	
		
		if($option_file) @include_once($option_file.'.php');
        if($option_file) @include_once($option_file.'_dynamic_elements.php');
		
		if(!isset($options) && !isset($dynamic_pages) && !isset($dynamic_elements)  ) { return false; }
		
		$options = unserialize(base64_decode($options));
		$dynamic_pages = unserialize(base64_decode($dynamic_pages));
		
        $dynamic_elements = base64_decode($dynamic_elements);
        $auctionDetails = preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'", $dynamic_elements ); 
        $dynamic_elements = unserialize($auctionDetails);
 
		global $themeple_controller;
		if(is_array($options))
		{
			foreach($themeple_controller->admin_pages as $page)
			{
				$database_option[$page['parent']] = $this->get_default($options[$page['parent']], $page, $themeple_controller->subs);
			}
		}
		if(!empty($database_option))
		{
			
			update_option($themeple_controller->db_options_prefix, $database_option);
		}
		if(!empty($dynamic_pages))
		{
			update_option($themeple_controller->db_options_prefix.'_dynamic_pages', $dynamic_pages);
		}
		
		if(!empty($dynamic_elements))
		{
			update_option($themeple_controller->db_options_prefix.'_dynamic_elements', $dynamic_elements);
		}
	}
    public function get_default($elements, $page, $subpages)
	{
	
		$values = array();
		foreach($elements as $element)
		{
				if($element['type'] == 'layout_section')
				{	
					$iterations =  count($element['std']);
					
					for($i = 0; $i<$iterations; $i++)
					{
						$values[$element['id']][$i] = $this->get_default($element['std'][$i], $page, $subpages);
					}
				}
				else if(isset($element['id']))
				{
					if(!isset($element['std'])) $element['std'] = "";
					
					if($element['type'] == 'select' && !is_array($element['subtype']))
					{	
						if(!isset($element['taxonomy'])) $element['taxonomy'] = 'category';
						$values[$element['id']] = $this->getSelectValues($element['subtype'], $element['std'], $element['taxonomy']);
					}
					else
					{
						$values[$element['id']] = $element['std'];
					}
				}
			
		}
		
		return $values;
	}
    
    function getSelectValues($type, $name, $taxonomy)
	{
		switch ($type)
		{
			case 'page':
			case 'post':	
				$the_post = get_page_by_title( $name, 'OBJECT', $type );
				if(isset($the_post->ID)) return $the_post->ID;
			break;
			
			case 'cat':	
			
				if(!empty($name))
				{
					$return = array();
					
					foreach($name as $cat_name)
					{	
						if($cat_name)
						{	
							if(!$taxonomy) $taxonomy = 'category';
							$the_category = get_term_by('name', $cat_name, $taxonomy);
						
							if($the_category) $return[] = $the_category->term_id;
						}
					}
				
				if(!empty($return))
				{
					if(!isset($return[1]))
					{
						 $return = $return[0];
					}
					else
					{
						$return = implode(',',$return);
					}
				}
				return $return;
			}
			
		break;
		}
	}
    
    function set_default_menu()
	{
		global $themeple_config;
        $menus  = wp_get_nav_menus();
		$locations   = get_theme_mod('nav_menu_locations');
		if(!empty($menus) && !empty($themeple_config['navigations']))
		{
			foreach($menus as $menu)
			{
				if(is_object($menu) && in_array($menu->name, $themeple_config['navigations']))
				{
					$key = array_search($menu->name, $themeple_config['navigations']);
					if($key)
					{
						$locations[$key] = $menu->term_id;
					}
				}
			}
		}
		set_theme_mod( 'nav_menu_locations', $locations);
	}
    
    
    
}


?>