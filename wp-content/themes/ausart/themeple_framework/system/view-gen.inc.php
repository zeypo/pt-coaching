<?php if(!defined('THEMEPLE_FRAMEWORK')) exit("Direct script access not allowed");


if(! class_exists('themeple_viewgen')){
    
    /**
     * themeple_viewgen
     * 
     * @package   
     * @author roshi
     * @copyright roshi[www.themeforest.net/user/roshi]
     * @version 2012
     * @access public
     */
    class themeple_viewgen{
        
       var $controller;
       var $used_for = 'admin_page';
        /**
         * themeple_viewgen::themeple_viewgen()
         * 
         * @param bool $controller
         * @return
         */
        function themeple_viewgen($controller = false){
            if(!$controller) { $controller = $GLOBALS['themeple_controller']; }
			$this->controller = $controller;
            
        }
        
        /**
         * themeple_viewgen::generate_base_container()
         * 
         * @param mixed $option_page
         * @param string $firstactive
         * @return
         */
        function generate_base_container($option_page, $firstactive = '' ){
            $html_elements = $this->controller->getElements($option_page['slug']);
            
            
            $output = $this->generate_section($option_page, $firstactive);
            if(isset($option_page['removable'])) 
            {
                $output .= "<a href='#".$option_page['slug']."' title='".$option_page['removable']."' class='themeple_remove_dynamic_page'>".$option_page['removable']."</a>";
            }
            if($firstactive != ''){
                if(count($html_elements) > 0){
                    foreach($html_elements as $el){
                    
                        $output .= $this->generate_element($el);

                    }
                }
            }
            
            $output .= $this->generate_section_end();
            return $output;
        }
        
        /**
         * themeple_viewgen::page_option_header()
         * 
         * @return
         */
        function page_option_header(){
            $title = $this->controller->base_data['Title'];
            
            $output = '<div class="themeple_container">';
            $output .= '<div class="themeple_header">';
            $output .= '<div class="mini_header"><img src="'.THEMEPLE_IMAGE_URL.'/logo.png" /></div>';            
            $output .= '<div class="mini_header"><h2>'.$title.' '.$this->controller->current['title'].'</h2><div class="save_message"></div></div>';
            $output .= $this->generate_save();
            $output .= '</div>';
            $output .= '<div class="themeple_navigation"><div class="template_description">This is your theme options panel from here you can edit, add, delete or change everything on the theme. If you need any support please contact us. Thank You</div><ul></ul></div><div class="themeple_main_section"><span class="big_loading"></span>';
            
            return $output;
        }
        
        /**
         * themeple_viewgen::generate_section()
         * 
         * @param mixed $option_page
         * @param mixed $firstactive
         * @return
         */
        function generate_section($option_page, $firstactive){
            
            
            $output = '<div class="themeple_section '.((isset($option_page['sub']) && $option_page['sub'])?"sub_section":"").'  '.$firstactive.' '.(isset($option_page['sortable'])?$option_page['sortable']:'').'" id="themeple-'.$option_page['slug'].'"><li class="themeple_header_nav" style="display:none"><span class="icon" style="background: url('.THEMEPLE_IMAGE_URL.'/'.$option_page['icon'].') no-repeat center;"></span><span class="title">'.$option_page['title'].'</span></li>';
            return $output;
        }
        
        /**
         * themeple_viewgen::visual_group_start()
         * 
         * @param mixed $element
         * @return
         */
        function visual_group_start( $element )
		{	
			$required = $extraclass = $data= "";
			
			if(isset($element['required'])) 
			{ 
				$required = '<input type="hidden" value="'.$element['required'][0].'::'.$element['required'][1].'" class="themeple_required" />';  
				$extraclass = ' themeple_hidden themeple_required_container';
			} 
			
			if(isset($element['name'])) $data = "data-group-name='".$element['name']."'";
			if(isset($element['inactive'])) { $data .= " data-group-inactive='".$element['inactive']."'"; $extraclass .= " inactive_visible";}

		
			$output  = '<div class="themeple_visual_set themeple_'.$element['type'].$extraclass.' '.(isset($element['class'])?$element['class']:'').'" id="'.$element['id'].'" '.$data.'>';
			$output .= $required;
				
			return $output;
		}
		
		/**
		 * themeple_viewgen::visual_group_end()
		 * 
		 * @return
		 */
		function visual_group_end()
		{			
			$output  = '</div>';
			return $output;
		}
        /**
         * themeple_viewgen::upload_gallery()
         * 
         * @param mixed $element
         * @return
         */
        function upload_gallery($element){
            $sub_output = "";
			$iterations = 0;
			$real_id = $element['id'];
			
			if((isset($element['std']) && is_array($element['std'])) && !isset($element['ajax_request']))
			{
				if(!empty($element['std'][0]['slideshow_image']) || !empty($element['std'][0]['slideshow_video']))
				{
					$iterations = count($element['std']);
				}
			}
			
			$video_button = "Add external video by URL";
			if(isset($element['button_video'])) $video_button = $element['button_video']; 
			if(isset($element['ajax_request'])) $iterations = $element['ajax_request']; 
			
			for ($i = 0; $i < $iterations; $i++)
			{
				
				$element['id'] = $real_id.'-__-'.$i;
				
				$sub_output  .= '<div class="themeple_set themeple_row '.(isset($element['class'])?$element['class']:"").'" id="themeple_'.$element['id'].'" >';
				$sub_output  .= 	'<div class="themeple_single_set"><div class="sortable_element"></div>';
				$sub_output	 .= 		$this->sub_elements($element, $i);
				$sub_output  .= '		<a class="themeple_remove remove_all_allowed" href="#">'.__('(remove)').'</a>';
				$sub_output  .= '		<a class="open_img_info" data-openset="'.__('Show').'" data-closedset="'.__('Hide').'" href="#">'.__('Show').'</a>';
				$sub_output  .= 	'</div>';
				$sub_output  .= '</div>';
			}

			if(isset($element['ajax_request'])) return $sub_output;
			
			
			global $post_ID;
			if(empty($element['button-label'])) $element['button-label'] = "Add Image to slideshow";
			$postId = $post_ID; 
			$output = "";
			
			$output .= '<div class="themeple_upload_gallery_container themeple_upload_gallery_container'.$postId.'">';
			$output .= '<div class="themeple_upload_gallery_sortable_container">';
			
			$output .= $sub_output; 

			$output .= '</div>';
	
			$output .= '	<span class="themeple_upload_buttons_wrapper">';
				
					$output .= '<a href="#" class="themeple_upload_gallery_btn themeple_btn" title="'.$element['name'].'" id="themeple_gallery_uploader '.$element['id'].'"';
					$output .= 'data-label="'.$element['label'].'" ';
					$output .= 'data-this-id="'.$element['id'].'" ';
					$output .= 'data-attach-to-post = "'.$postId.'" ';
					$output .= 'data-real-id="'.$real_id.'" ';
					$output .= '>'.$element['button-label'].'</a>';
			
			$output .= '	</span>';
			
			$output .= '	<span class="themeple_style_wrap themeple_upload_style_wrap">';
				
					$output .= '<a href="#" class="themeple_upload_gallery_btn themeple_btn" title="'.$element['name'].'" id="themeple_gallery_uploader '.$element['id'].'"';
					$output .= 'data-label="'.$element['label'].'" data-video-insert = "themeple_video_tab"';
					$output .= 'data-attach-to-post = "'.$postId.'" ';
					$output .= 'data-real-id="'.$real_id.'" ';
					$output .= 'data-this-id="'.$element['id'].'" ';
					$output .= '>'.$video_button.'</a>';
			
			$output .= '	</span>';
			
			$output .= '</div>';
			return $output;
        }
        
        /**
         * themeple_viewgen::gallery_image()
         * 
         * @param mixed $element
         * @return
         */
        function gallery_image($element)
		{
			$prevImg = $extraClass = "";
			$real_id = explode('-__-', $element['id']);
			$real_id = $real_id[0];
			
			global $post_ID;
			if(empty($post_ID) && isset($element['apply_all'])) $post_ID = $element['apply_all'];
			
			if( isset($element['std']) && (!is_numeric($element['std']) || $element['std'] == '') )
			{
				$prevImg = '<img src="'.THEMEPLE_IMAGE_URL.'video.png" alt="" />';
				$extraClass = " themeple_gallery_image_video";
			}
			else if(isset($element['std']))
			{
				$prevImg = wp_get_attachment_image($element['std'], array(100,100));
				$extraClass = " themeple_gallery_image_img";
			}
			
		
			$output ="";
			$output .=' <div class="themeple_gallery_img'.$extraClass.'">';
			
					$output .= '<a href="#" class="themeple_upload_gallery_btn" title="'.$element['name'].'" id="themeple_gallery_image '.$element['id'].'"';
					$output .= 'data-label="'.$element['label'].'" ';
					$output .= 'data-this-id="'.$element['id'].'" ';
					$output .= 'data-attach-to-post = "'.$post_ID.'" ';
					$output .= 'data-real-id="'.$real_id.'" ';
					$output .= 'data-overwrite="true" ';
					$output .= '>'.$prevImg.'</a>';
					$output .= '<input type="text" class="themeple_gallery_img_value '.(isset($element['class'])?$element['class']:"").'" value="'.(isset($element['std'])?$element['std']: "").'" name="'.$element['id'].'" id="'.$element['id'].'" />';

			
			$output .= '</div>';
			return $output;
		}
        
        /**
         * themeple_viewgen::generate_element()
         * 
         * @param mixed $element
         * @return
         */
        function generate_element($element){
            if(isset($element['type']) && method_exists( $this, $element['type'] ) ){
                $required = $extraclass  = "";
			
    			if(isset($element['required'])) 
    			{ 
    				$required = '<input type="hidden" value="'.$element['required'][0].'::'.$element['required'][1].'" class="themeple_required" />';  
    				$extraclass = ' themeple_hidden themeple_required_container';
    			}
                
                if($this->used_for != 'metabox')
				{
					if(isset($this->controller->current['slug']) && isset($element['id']) &&
					   isset($this->controller->options[$this->controller->current['slug']][$element['id']]))
					{
						$element['std'] = $this->controller->options[$this->controller->current['slug']][$element['id']];
                        
					}
				}
                $dynamic_end = "";
				$output = "";
                
				if(isset($element['dynamic']))
				{
                    
                    $names = array(3 => "1/4", 4 => "1/3", 6 => "1/2", 8 => "2/3", 9 => "3/4", 12 => "1/1");
					$output .= '<div class="themeple_row element'.((isset($element['std'][0]['dynamic_size']))?$element['std'][0]['dynamic_size']:$element['default_size']).'">';
					$output .= '	<div class="themeple_style_wrap themeple_style_wrap_portlet">';
					$output .= '		<div class="themeple-row-header"><a href="#" class="plus_column"></a><a href="#" class="minus_column"></a><h2>'.$element['name'].'</h2><span class="size_column"><span>'.$names[((isset($element['std'][0]['dynamic_size']))?$element['std'][0]['dynamic_size']:$element['default_size'])].'</span></span> <a href="#fancy_box'.$element['id'].'" class="themeple-item-edit fancycontent"></a><a href="#'.$element['id'].'" title="'.$element['removable'].'" class="themeple_remove_dynamic_element themeple-item-delete"><span>'.$element['removable'].'</span></a></div>';
					$output .= '		<div class="themeple-row-content mfp-hide white-popup" id="fancy_box'.$element['id'].'">';
					$output .= "		";
					$dynamic_end = '<div class="themeple_clear"></div></div></div></div>';
				}				
                
                
                
                if($element['type'] == 'upload_gallery' || $element['type'] == 'layout_section' || $element['type'] == 'description_h' || (isset($element['nodescription']) && $element['nodescription'] != "")){
                    $output .= $this->$element['type']($element);
                }else{
                    
                    $output .= '<div class="themeple_box '.$extraclass.'" id="themeple_'.$element['id'].'">';
                    if($element['type'] == 'hidden'){
                        $output .= $this->$element['type']($element);
                        $output .= '</div>';
                        return $output;
                    }
                    $output .= $required;
                    if($element['type'] == 'description_h')
                        $output .= '<div class="box_container white_bg">';
                    else if(!isset($element['dynamic']))
                        $output .= '<div class="box_container">';
                    if(!isset($element['dynamic'])){
                        $output .= '<div class="box_header">';
                        $output .= '<h2>'.$element['name'].'</h2>';
                        $output .= '</div>';
                        $output .= '<div class="box_elements ">';
                    }
                    
                    if( ($element['type'] != 'iconset') && ($element['type'] != 'radioimage')){
                        $output .= '<div class="box2_1">';
                        $output .= $this->$element['type']($element);  
                        $output .= '</div><div class="box2_2">';                  
                        if(isset($element['desc']))
                            $output .= $this->description($element['desc']);
                        $output .= '</div>';
                    }else{
                        $output .= '<div class="boxfull">';
                        $output .= $this->$element['type']($element);  
                        $output .= '</div>';                  
                        
                    }



                    $output .= '</div>';
                    if(!isset($element['dynamic']))
                        $output .= '</div></div>';
                }
                
                $output .= $dynamic_end;
                return $output;
            }
        }
        /**
         * themeple_viewgen::description_h()
         * 
         * @param mixed $element
         * @return
         */
        function description_h($element){
            $output = '<div class="themeple_box"><div class="box_container white_bg"><p class="description_only">'.$element['desc'].'</p></div></div>';
            
            return $output;
        }
        /**
         * themeple_viewgen::layout_section()
         * 
         * @param mixed $element
         * @return
         */
        function layout_section($element){
			$output = "";
			$real_id = $element['id'];
			$iterate = 1;
			
		    if((isset($element['std']) && is_array($element['std'])) && !isset($element['ajax_request']))
			{
				$iterate = count($element['std']);
			}
            
			for ($i = 0; $i < $iterate; $i++)
			{
				if(!isset($element['linktext'])) $element['linktext'] = "add";
				if(!isset($element['deletetext'])) $element['deletetext'] = "remove";

				$element['id'] = $real_id.'-__-'.$i;
				$extraclass = '';
                $required = '';
                if(isset($element['required'])) 
                { 
                    $required = '<input type="hidden" value="'.$element['required'][0].'::'.$element['required'][1].'" class="themeple_required" />';  
                    $extraclass = ' themeple_hidden themeple_required_container';
                }
                $output   .= '<div class="themeple_set '.(isset($element['class'])?$element['class']:'').' '.$extraclass.'" id="themeple_'.$element['id'].'">';
		        
                $output   .= $required;
				$output   .= '<div class="themeple_single_set '.(isset($element['add'])?'add_row':'').'">';
				
				$output	 .= $this->sub_elements($element, $i);
                if(!isset($element['dynamic'])){
                    $output  .= '	<a class="themeple_remove" href="#">'.$element['deletetext'].'</a>';
    				$output  .= '	<a class="themeple_clone" style="left:3px;" href="#">'.$element['linktext'].'</a>';
				}
				$output  .= '</div>';
				$output  .= '</div>';
			}
			
			
			return $output;
        }
        /**
         * themeple_viewgen::input_text()
         * 
         * @param mixed $element
         * @return
         */
        function input_text($element){
            $output = '';
            $output .=  '<input type="text" name="'.$element['id'].'" class="text_input '.(isset($element['class'])?$element['class']:'').'" id="'.$element['id'].'" value="'.(isset($element['std'])?$element['std']: "").'" />';
            
            return $output;
        }

        function hidden($element){
            $output = '';
            $output .=  '<input type="hidden" name="'.$element['id'].'" class="hidden_size text_input '.(isset($element['class'])?$element['class']:'').'" id="'.$element['id'].'" value="'.$element['std'].'" />';
            
            return $output;
        }
        /**
         * themeple_viewgen::sub_elements()
         * 
         * @param mixed $element
         * @param integer $i
         * @return
         */
        function sub_elements($element, $i = 1){
            $output = '';
            foreach($element['subelements'] as $key => $subelement)
			{
				if(isset($element['std']) && is_array($element['std']) && isset($subelement['id']) && isset($element['std'][$i][$subelement['id']]))
				{
					$subelement['std'] = $element['std'][$i][$subelement['id']];
				}
				
				if(isset($element['ajax_request']))
				{
					$subelement['ajax_request'] = $element['ajax_request'];
				}
				
				$subelement['subgroup_item'] = true;
				if(isset($subelement['id']))
                    $subelement['id'] = $element['id']."-__-".$subelement['id'];
				
				if(isset($element['apply_all'])) $subelement['apply_all'] = $element['apply_all'];
				$output  .=      $this->generate_element($subelement);
			}
			
			return $output;
        }
        
        /**
         * themeple_viewgen::select_columns()
         * 
         * @param mixed $element
         * @return
         */
        function select_columns($element){
            $output .= '<span class="select-container">';
			$output .= '<select class="themeple_select_columns" id="'. $element['id'] .'" name="'. $element['id'] . '"> ';
            $output .= '<option value="">Select Number of columns</option>';
            for($i = 1; $i <= 12; $i++){
                $output .= '<option value="'.$i.'">'.$i.' Columns</option>';
            }
            $output .= '</select>';
            $output .= '</span>';
            			
        }
        
        function radioimage($element){
            $output = '';

            if(isset($element['subtype']) && count($element['subtype']) > 0){
                
                foreach($element['subtype'] as $option):

                    $checked = '';
                    $cl = '';
                    if($element['std'] == $option['value']){
                        $checked = 'checked';
                        $cl = 'check-list';
                    }
                    $output .= '<div class="r-cont"><div class="radio-image-wrapper '.(isset($element['class'])?$element['class']:"").'">';
                    $output .= '        <label for="'.str_replace(" ", "_", $option['name']).'">';
                    $output .= '            <img src="'.THEMEPLE_IMAGE_URL.$option['img'].'" alt="'.$option['name'].'">';
                    $output .= '            <div id="check-list" class="'.$cl.'"></div>';
                    $output .= '        </label>';
                    $output .= '        <input type="radio" name="'.$element['id'].'" value="'.$option['value'].'" id="'.$element['id'].'"  '.$checked.'  class="'.str_replace(" ", "_", $option['name']).'" data-value="'.$option['value'].'"> ';
                    
                    $output .= '</div>';
                    $output .= '<h2>'.$option['name'].'</h2>';
                    $output .= '</div>';

                endforeach;
            }
            return $output;
        }

        function switchbutton($element){
            $output = '';


            $checked_yes = '';
                if($element['std'] == 'yes')
                        $checked_yes = 'checked';
            $checked_no = '';
                if($element['std'] == 'no')
                        $checked_no = 'checked';
            $output .= '<div class="switch-button-wrapper">';
            $output .= '        <label for="'.str_replace(" ", "_", $element['name']).'">';
            $output .= '            <div class="ckeck-switch '.(isset($element['std'])?"checked-switch-".$element['std']:"").' "></div>';
            $output .= '        </label>';
            $output .= '        <input type="text" name="'.$element['id'].'" value="'.(isset($element['std'])?$element['std']:"").'" id="'.$element['id'].'"  class="'.str_replace(" ", "_", $element['name']).'"> ';
            $output .= '</div>';   
            return $output;
        }
        /**
         * themeple_viewgen::select()
         * 
         * @param mixed $element
         * @return
         */
        function select( $element )
		{	
			if($element['subtype'] == 'page')
			{
				$select = 'Select page';
				$entries = get_pages('title_li=&orderby=name');
			}
            else if($element['subtype'] == 'staff'){
                $select = 'Select staff post';
                $entries = get_posts('title_li=&orderby=name&numberposts=9999&post_type=staff');
            }
			else if($element['subtype'] == 'post')
			{
				$select = 'Select post';
				$entries = get_posts('title_li=&orderby=name&numberposts=9999');
			}
			else if($element['subtype'] == 'cat')
			{
				$add_taxonomy = "";
				
				if(!empty($element['taxonomy'])) $add_taxonomy = "&taxonomy=".$element['taxonomy'];
			
				$select = 'Select category';
				$entries = get_categories('title_li=&orderby=name&hide_empty=0'.$add_taxonomy);
				
			}
            else if($element['subtype'] == 'portfolio'){
                $select = 'Select portfolio post';
                $entries = get_posts('title_li=&orderby=name&numberposts=9999&post_type=portfolio');
            }
            else if($element['subtype'] == 'staff'){
                $select = 'Select staff post';
                $entries = get_posts('title_li=&orderby=name&numberposts=9999&post_type=staff');
            }else if($element['subtype'] == 'testimonial'){
                $select = 'Select testimonial post';
                $entries = get_posts('title_li=&orderby=name&numberposts=9999&post_type=testimonial');
                
            }
			else
			{	
				$select = 'Select...';
				$entries = $element['subtype'];
				
			}
			$multi = '';
            if(isset($element['multiple'])){
                $multi = ' multiple="multiple" size="'.$element['multiple'].'"';
                if(isset($element['std']))
                    $element['std'] = explode(',', $element['std']);
            }
			$output = "";
			$output .= '<span class="select-container">';
			$output .= '<select '.$multi.' class="'.(isset($element['css_class'])?$element['css_class']:'').'" id="'. $element['id'] .'" name="'. $element['id'] . '"> ';
			
			
			if(!isset($element['no_first'])) { $output .= '<option value="">'.$select .'</option>  '; $fake_val = $select; }
			
			$real_entries = array();
        
			foreach ($entries as $key => $entry)
			{
				if(!is_array($entry))
				{
					$real_entries[$key] = $entry;
				}
				else
				{
					$real_entries['option_group_'.$key] = $key;
				
					foreach($entry as $subkey => $subentry)
					{
						$real_entries[$subkey] = $subentry;
					}
					
					$real_entries['close_option_group_'.$key] = "close";
				}
			}
			
			$entries = $real_entries;
			
			foreach ($entries as $key => $entry)
			{
			    
				if($element['subtype'] == 'page' || $element['subtype'] == 'post' || $element['subtype'] == 'portfolio' || $element['subtype'] == 'testimonial' || $element['subtype'] == 'staff')
				{
					$id = $entry->ID;
					$title = $entry->post_title;
				}
				else if($element['subtype'] == 'cat')
				{
					if(isset($entry->term_id))
					{
						$id = $entry->term_id;
						$title = $entry->name;
					}
				}
				else
				{
					$id = $entry;
					$title = $key;				
				}
				
				if(!empty($title))
				{
					if(!isset($fake_val)) $fake_val = $title;
					$selected = "";
					if (isset($element['std']) && ($element['std'] == $id || (is_array($element['std']) && in_array($id, $element['std'])))) { $selected = "selected='selected'"; $fake_val = $title;}
					
					if(strpos ( $title , 'option_group_') === 0) 
					{
						$output .= "<optgroup label='". $id."'>";
					}
					else if(strpos ( $title , 'close_option_group_') === 0) 
					{
						$output .= "</optgroup>";
					}
					else
					{
						$output .= "<option $selected value='". $id."'>". $title."</option>";
					}
					
				}
			}
			$output .= '</select><span class="select"></span></span>';
		
			
			
			return $output;
		}
        
        /**
         * themeple_viewgen::upload()
         * 
         * @param mixed $element
         * @return
         */
        function upload($element){
            $postId = themeple_media::get_custom_post($element['name']);
            $output = '';
            $output .= '<input type="text" class="semi_input themeple_upload_input" name="'.$element['id'].'" id="'.$element['id'].'" value="'.(isset($element['std'])?$element['std']:'').'" />';
            $output .= '<a href="#'.$postId.'" title="'.$element['name'].'" class="mrgleft themeple_btn themeple_btn_active themeple_upload">'.$element['btn_text'].'</a>';
            
            $output .= '<div class="image_prev">';
            $output .= '<img src="'.(isset($element['std'])?$element['std']:'').'" alt="'.$element['name'].'" />';
            $output .= '</div>';
            return $output;
        }
        
        /**
         * themeple_viewgen::textarea()
         * 
         * @param mixed $element
         * @return
         */
        function textarea($element){
            $output = '<span class="text_box">';
            $output .= '<textarea class="'.(isset($element['css_class'])?$element['css_class']:'').'" id="'.$element['id'].'" name="'.$element['id'].'">'.(isset($element['std'])?$element['std']:'').'</textarea>';
            $output .= '</span>';
            return $output;
        }
        /**
         * themeple_viewgen::description()
         * 
         * @param mixed $desc
         * @return
         */
        function description($desc){
            $output = '<div class="themeple_box_right"><p>'.$desc.'</p></div>';
            return $output;
        }
        
        /**
         * themeple_viewgen::colorpicker()
         * 
         * @param mixed $element
         * @return
         */
        function colorpicker($element){
            $output = '<span class="input_box">';
            $output .= '                     <input type="text" class="semi_input color" name="'.$element['id'].'" id="'.$element['id'].'" value="'.$element['std'].'" style="background-color:'.$element['std'].'" />';
            $output .= '                    <div class="colorpicker"></div>';
            $output .= ' </span>';
            
            return $output;
        }
        
        /**
         * themeple_viewgen::gradientpicker()
         * 
         * @param mixed $element
         * @return
         */
        function gradientpicker($element){
            $output = '<span class="input_box">';
            $output .= '<textarea name="'.$element['id'].'" id="'.$element['id'].'">'.$element['std'].'</textarea>';
            $output .= '<div class="gradient_selector"></div>';
            $std = trim($element['std'], ',');
            $std = trim($std, ' ');
            $stds = explode(", ", $std);
                foreach($stds as $s){
                    $output .= '<span class="gradient_points" style="display:none;">'.$s.'</span>';
                }
            
            $output .= '<div class="prev_gradient" style=""></div>';
            $output .= '</span>';
            return $output;
        }
        
        
        
        /**
         * themeple_viewgen::generate_section_end()
         * 
         * @return
         */
        function generate_section_end(){
            $output = '</div>';
            return $output;
        }
        
        
        
        
        
        
        /**
         * themeple_viewgen::page_option_footer()
         * 
         * @return
         */
        function page_option_footer(){
            $output = '</div>';
            echo $this->generate_js_data();
            $output .= '</div>';
            
            return $output;
        }
        
        /**
         * themeple_viewgen::generate_js_data()
         * 
         * @return
         */
        function generate_js_data(){
            $options = get_option($this->controller->db_options_prefix);
            $output  = '	<div id="themeple_js_data" class="js_data">';
			$output .= 			wp_referer_field( false );			

			$output .= '		<input type="hidden" name="admin_ajax_url" value="'.admin_url("admin-ajax.php").'" />';
			$output .= '		<input type="hidden" name="db_options_prefix" value="'.$this->controller->db_options_prefix.'" />';
			if($this->used_for == 'admin_page')
			{
				$nonce	= 			wp_create_nonce ('themeple_admin_save_data');
			    $output .= '		<input type="hidden" name="nonce_save_data" value="'.$nonce.'" />';
				$output .= '		<input type="hidden" name="action" value="themeple_admin_save_data" />';
				$output .= '		<input type="hidden" name="page_slug" value="'.$this->controller->current['slug'].'" />';
				if(empty($options)) $output .= ' <input type="hidden" name="first_call" value="true" />';
			}
            
            if($this->used_for == 'metabox')
			{
				$nonce	= 			wp_create_nonce ('themeple_admin_save_metabox');
			    $output .= '		<input type="hidden" name="themeple_nonce" value="'.$nonce.'" />';
				$output .= '		<input type="hidden" name="meta_active" value="true" />';
			}
            
            
            $output .= '</div>';
            
            return $output;
        }
        
        /**
         * themeple_viewgen::generate_save()
         * 
         * @return
         */
        function generate_save(){
            $output = '<a class="themeple_btn themeple_btn_inactive save_button">Save data</a>';
            $output .= '<span class="loading"></span>';
            return $output;
        }
        


        function change_skin($element){
            include( THEMEPLE_BASE.'/template_inc/admin/register_skins.php' );
            $output = '';
            foreach(${$element['array_name']} as $key => $pre):
                $class = '';
                if($element['std'] == $key)
                    $class = 'active_skin';
                $output .= '<a id="'.$key.'" class="themeple_btn '.$class.' change_skin" data-array_name="'.$element["array_name"].'" style="background-color:'.$pre['base_color'].' !important;">'.$key.'</a>';
            endforeach;
            $output .= '<span class="loading"></span>';
            return $output;
        }

        function change_complete_skin($element){
            include( THEMEPLE_BASE.'/template_inc/admin/register_skins.php' );
            $output = '';
            foreach(${$element['array_name']} as $key => $pre):
                $class = '';
                if($element['std'] == $key)
                    $class = 'active_skin';
                $output .= '<a id="'.$key.'" class="themeple_btn '.$class.' change_skin" data-array_name="'.$element["array_name"].'" style="background-color:'.$pre['bg_color'].' !important;">'.$key.'</a>';
            endforeach;
            $output .= '<span class="loading"></span>';
            return $output;
        }
        /**
         * themeple_viewgen::pagebuilder()
         * 
         * @param mixed $element
         * @return
         */
        function pagebuilder($element){
            $output = '<span class="themeple_create_option_page_container">';
            $output .= '<input type="text" name="'.$element['id'].'" class="semi_input themeple_create_input_name"  id="'.$element['id'].'" value="'.$element['std'].'" />';
            $output .= '<input type="hidden" class="themeple_option_page_parent" value="'.$element['parent'].'" />';
            $output .= '	<input class="themeple_option_page_sortable" type="hidden" value="'.$element['sortable'].'" />';
            $output .= '<a href="" title="'.$element['name'].'" class="mrgleft themeple_btn themeple_btn_inactive themeple_add_option_page">'.$element['btn_text'].'</a>';
            if(isset($element['default_elements']))
            {
			     $elString = base64_encode(serialize($element['default_elements']));
			     $output .= '	<input class="themeple_subelements_dynamic_page" type="hidden" value="'.$elString.'" />';
            }                    
                        
            $output .= '</span>';
            
            
            return $output;
        }
        
        /**
         * themeple_viewgen::add_dynamic_element()
         * 
         * @param mixed $element
         * @return
         */
        function add_dynamic_element($element){
            $output = "";
		
    		$output .= '<div class="themeple_dynamical_add_elements_container">';
    		$output .= '<span class="themeple_style_wrap themeple_dynamical_add_elements_style_wrap">';
    		$output .= '<span class="input_box"><select class="'.$element['class'].' themeple_dynamical_add_elements_select">';
    		$output .= '<option value="">Select Element</option>  ';
    		if(! @include(THEMEPLE_BASE.$element['options_file']))
    		{
    			@include($element['options_file']);
    		}
            
    		foreach ($elements as $dynamic_element)
    		{
    			if(empty($dynamic_element['name'])) $dynamic_element['name'] = $dynamic_element['id'];
    			$output .= "<option value='". $dynamic_element['id']."'>". $dynamic_element['name']."</option>";
    		}
    		
    		$output .= '</select>';
    		$output .= '<a href="#" class="themeple_btn themeple_btn_active themeple_add_dynamic_element" title="'.$element['name'].'" id="themeple_'.$element['id'].'">Add Element</a>';
    		$output .= '</span>';
            $output .= '</span>';
    		$output .= '<input class="themeple_dynamical_add_elements_parent" type="hidden" value="'.$element['slug'].'" />';
    		$output .= '<input class="themeple_dynamical_add_elements_config_file" type="hidden" value="'.$element['options_file'].'" />';
    	
    		$output .= '</div>';
    		return $output;
        }
        
        function dummy_data($element){
            $output = "";
			$nonce	 = 	wp_create_nonce ('themeple_nonce_import_dummy_data');
			$output .= '<input type="hidden" name="themeple-nonce-dummy" value="'.$nonce.'" />';
			$output .= '<a href="#" class="themeple_btn themeple_btn_active themeple_dummy_data">Import dummy data</a></span>';
			

            return $output;
        }

        /*
        function iconset($element){
            $output = '';
            $directory = THEMEPLE_FRAMEWORK."images/icons/32x32/";
 
            //get all image files with a .png extension.
            $icons = glob($directory . "*.png");
            
            
            if(isset($icons) && count($icons) > 0){
                
                foreach($icons as $icon):
                    $icon = str_replace(THEMEPLE_FRAMEWORK."images/icons/32x32/", "", $icon);

                    $checked = '';
                    $cl = '';
                    if($element['std'].'.png' == $icon){
                        $checked = 'checked';
                        $cl = 'check-list';
                    }
                    $output .= '<div class="r-cont iconset"><div class="radio-image-wrapper '.(isset($element['class'])?$element['class']:"").'">';
                    $output .= '        <label for="'.str_replace(" ", "_", $icon).'">';
                    $output .= '            <img src="'.THEMEPLE_IMAGE_URL.'icons/32x32/'.$icon.'" alt="'.$icon.'">';
                    $output .= '            <div id="check-list" class="'.$cl.'"></div>';
                    $output .= '        </label>';
                    $output .= '        <input type="radio" name="'.$element['id'].'" value="'.str_replace(".png", "", $icon).'" id="'.$element['id'].'"  '.$checked.'  class="'.str_replace(" ", "_", $icon).'"> ';
                    
                    $output .= '</div>';
                    
                    $output .= '</div>';

                endforeach;
            }
            return $output;
        }
        */

        function iconset($element){
            
          
            $output ='';
            include(THEMEPLE_BASE.'template_inc/icons.php');



           
                
                foreach($icons as $icon):
                    

                    $checked = '';
                    $cl = '';
                    if(isset($element['std']) && $element['std'] == $icon){
                        $checked = 'checked';
                        $cl = 'check-list';
                    }
                    
                    $output .= '<div class="r-cont iconset"><div class="radio-image-wrapper '.(isset($element['class'])?$element['class']:"").'">';
                    $output .= '        <label for="'.$icon.'">';
                    $output .= '            <i class="'.$icon.'"></i>';
                    $output .= '            <div id="check-list" class="'.$cl.'"></div>';
                    $output .= '        </label>';
                    $output .= '        <input type="radio" name="'.$element['id'].'" value="'.$icon.'" id="'.$element['id'].'"   '.$checked.'  class="'.$icon.'" data-value="'.$icon.'"> ';
                    
                    $output .= '</div>';
                    
                    $output .= '</div>';

                endforeach;
            
            return $output;
        }
    }
}

?>