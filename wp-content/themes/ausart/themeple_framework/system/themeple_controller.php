<?php if(!defined('THEMEPLE_FRAMEWORK')) exit("Direct script access not allowed");


if(! class_exists('themple_controller')){
    
    /**
     * themeple_controller
     * 
     * @package   
     * @author roshi
     * @copyright roshi[www.themeforest.net/user/roshi]
     * @version 2012
     * @access public
     */
    class themeple_controller{
        
        var $base_data;
        var $db_options_prefix;
        var $admin_pages = array();
        var $page_elements = array();
        var $subs = array();
        var $options = array();
        var $current;
        /**
         * themeple_controller::themeple_controller()
         * 
         * @param mixed $base_data
         * @return
         */
        function themeple_controller($base_data){
            $this->base_data = $base_data;
            $this->db_options_prefix = 'themeple_options_'.$this->base_data['prefix'];
            
            $this->generate_options_array();
            
            if(is_admin()){
                add_action('admin_print_scripts',array(&$this, 'themeple_global_js'));
                
                new themeple_adminpages_gen($this);
                new themeple_metabox($this);
                
                new themeple_export($this);
                if(function_exists('set_time_limit')){
                    set_time_limit(0);
                }

            }
            new themeple_custom_menu($this);
            
            
        }

        
        /**
         * themeple_controller::generate_options_array()
         * 
         * @return
         */
        private function generate_options_array(){
            include(THEMEPLE_BASE.'template_inc/admin/admin_options.php');
            if(isset($admin_pages)){
                $this->admin_pages = $admin_pages;
            }
            if(isset($page_elements)){
                $this->page_elements = $page_elements;
            }
            
            $dynamic_pages = get_option($this->db_options_prefix.'_dynamic_pages');
            $dynamic_elements = get_option($this->db_options_prefix.'_dynamic_elements');
            
            if(is_array($dynamic_pages)){
                $this->admin_pages = array_merge($this->admin_pages, $dynamic_pages);
            }
            
            if(is_array($dynamic_elements)){
                $this->page_elements = array_merge($this->page_elements, $dynamic_elements);
            }
            
            $options_result = get_option($this->db_options_prefix);
            
            foreach($this->admin_pages as $page){
                $this->subs[$page['parent']][] = $page['slug'];
                
            }
            $bool = false;
            foreach($admin_pages as $page){
                if(!isset($options_result[$page['parent']]) || $options_result[$page['parent']] == ""){
                    $options_result[$page['parent']] = $this->get_default($this->page_elements, $page, $this->subs );
                    $bool = true;
                }
            }
            if($bool)
                update_option($this->db_options_prefix, $options_result);
            $this->options = apply_filters('themeple_filter_admin_options', $options_result );
            
        }
        
        /**
         * themeple_controller::get_default()
         * 
         * @param mixed $el
         * @param mixed $page
         * @param mixed $subs
         * @return
         */
        private function get_default($el, $page, $subs){
            $values = array();
			foreach($el as $element)
			{
				if(in_array($element['slug'], $subs[$page['parent']]))
				{
					if($element['type'] == 'layout_section')
					{
						$values[0][$element['id']] = $this->get_default($element['subelements'], $page, $subs);
					}
					else if(isset($element['id']))
					{
						if(!isset($element['std'])) $element['std'] = "";
						$values[$element['id']] = $element['std'];
						
					}
				}
			}
			
			return $values;
        }
        
        /**
         * themeple_controller::getElements()
         * 
         * @param mixed $slug
         * @return
         */
        function getElements($slug)
		{
			$page_elements = array();
			if(count($this->page_elements) > 0)
			{
				foreach($this->page_elements as $key => $value)
				{
					if($value['slug'] == $slug)
					{
						$page_elements[$key] = $value;
					}
				}
			}
	
			return $page_elements;
		}
        /**
         * themeple_controller::themeple_global_js()
         * 
         * @return
         */
        function themeple_global_js(){
            echo "\n <script type='text/javascript'>\n /* <![CDATA[ */  \n";
    		echo "var themeple_global = {\n \tframeworkUrl: '".THEMEPLE_FRAMEWORK_URL."', \n \tinstalledAt: '".THEMEPLE_BASE_URL."', \n \tajaxurl: '".admin_url( 'admin-ajax.php' )."'\n \t}; \n /* ]]> */ \n ";
            echo "</script>\n \n ";
        }
    }
    
        
    
    
}



?>