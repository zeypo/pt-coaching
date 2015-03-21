<?php

/**
 * themeple_slideshow
 * 
 * @package   
 * @author 
 * @copyright oni12
 * @version 2012
 * @access public
 */
class themeple_slideshow{
    
    
    var $slides = array();
    var $post_id;
    var $slide_number;
    var $slide_type;
    var $slide_options = array();
    var $custom_header_html = "";
    var $custom_footer_html = "";
    var $slide_ul_class = "";
    var $slide_container_class = "";
    var $slide_element_class = ""; 
    var $before_render_media = "";
    var $after_render_media = "";
    var $before_elements = "";
    var $after_elements = "";
    var $slide_container_id = "";
    var $media_img_data = array();
    var $before_container_html = "";
    var $after_container_html = "";
    var $additional_attr = "";
    var $layout = "";
    var $img_size = array('width'=>940,'height'=>600);
    /**
     * themeple_slideshow::themeple_slideshow()
     * 
     * @return
     */
    function themeple_slideshow($post_id = false, $slide_type = ""){
        global $themeple_config;
        if(!$post_id) 
            $post_id = themeple_get_post_id();
		if(!$post_id) 
            return false;
        if(isset($themeple_config['conditionals']) && isset($themeple_config['conditionals']['routed_frontpage'])){
            if($themeple_config['conditionals']['routed_frontpage']){
                if(themeple_get_option('frontpage') == get_the_ID())
                    $post_id = themeple_get_option('frontpage');
            }
        }
        $this->post_id = $post_id;
        $this->slides = themeple_post_meta($this->post_id, 'slideshow');
        $this->slide_type = themeple_post_meta($this->post_id, '_slideshow_type');
        if($slide_type != ""){
            $this->slide_type = $slide_type;
        }
        $this->options['shadow'] = themeple_post_meta($this->post_id, '_slideshow_shadow');
        
        $this->options['slideshow_layout'] = themeple_post_meta($this->post_id, '_slideshow_layout');
        $this->slide_number = $this->slidecount();
        if($this->slide_number)
            $this->media_img_data = array_fill(0, $this->slide_number+1, "");
        if($this->slide_type == "")
            return false;
        if($this->slide_type != 'layer_slider' && $this->slide_type != 'revolution' )
            $this->{$this->slide_type}();
        else{
            $this->options['layer_slider_id'] = themeple_post_meta($this->post_id, '_slideshow_layer_slider')+1;
            $this->slide_number = 5;
            $this->options['revolution_alias'] = themeple_post_meta($this->post_id, '_slideshow_revolution');
        }
        if($this->slide_number == 0)
            return false;
        
            
        return true;
        
    }
    
    /**
     * themeple_slideshow::setCustomHeaderHtml()
     * 
     * @return
     */
    function setCustomHeaderHtml($html = ""){
        $this->custom_header_html = $html;
    }
    
    /**
     * themeple_slideshow::slideshow_behavior()
     * 
     * @return
     */
    function slideshow_behavior(){
        if($this->options['slideshow_layout'] == 'default')
		{
			$this->slides = themeple_post_meta($this->post_id, 'slideshow'); 
		}
		
		if($this->options['slideshow_layout']== 'single' && (themeple_check_multi_entry()))
		{
			if(is_array($this->slides)) 
			{
				$this->slides = array_slice($this->slides, 0, 1);
			}
		}

		$this->slide_number = $this->slidecount();
    }
    
    /**
     * themeple_slideshow::slidecount()
     * 
     * @return
     */
    function slidecount(){
        if(is_array($this->slides))
            return count($this->slides);
        return 0;
    }
    /**
     * themeple_slideshow::display()
     * 
     * @return
     */
    function display($force_display = false){
        global $themeple;
        $themeple['slideshow_active'] = $this->slide_type;

        if($this->slide_type == 'flexslider')
            return $this->render_slideshow();
        elseif($this->slide_type == 'flexslider_thumb')
            return $this->flexslider_thumb();
        elseif($this->slide_type == 'layer_slider')
            return $this->layer_slider();
        elseif($this->slide_type == 'revolution')
            return $this->revolution();
        elseif($this->slide_type == 'showbiz')
            return $this->showbiz();
        elseif($this->slide_type == 'active_slider')
            return $this->active_slider();
        elseif($this->slide_type == 'swiper_slider')
            return $this->swiper_slider();
        elseif($this->slide_type == 'project_slider')
            return $this->project_slider();
        elseif($this->slide_type == 'flex_text_thumbnail')
            return $this->flex_text_thumbnail();
        elseif($this->slide_type == 'image_thumbnails')
            return  $this->image_thumbnails();
        elseif($this->slide_type == 'vertical_slider')
            return $this->vertical_slider();
        elseif($this->slide_type == 'kwicks_slider')
            return $this->kwicks_slider();
        elseif($this->slide_type == 'woocommerce_slider')
            return $this->woocommerce_slider();
        elseif($this->slider_type == 'no_slider')
             return $this->no_slider();   
    }
    
    /**
     * themeple_slideshow::render_slideshow()
     * 
     * @return
     */
    function render_slideshow(){
        if(post_password_required($this->post_id)){ return false; }
        global $themeple_config;
        $output = "";
        $i = 0;
        $output .= $this->before_container_html;
        if($this->slide_number){
        
            $output .= '<div class="slideshow_container '.$this->slide_container_class.' slide_layout_'.$this->options['slideshow_layout'].'" id="'.$this->slide_container_id.'flex" '.$this->additional_attr.'>';
            $output .= $this->custom_header_html;
            $output .= '    <ul class="'.$this->slide_ul_class.' slide_'.$this->slide_type.'">';
            $output .= $this->before_elements;
            foreach($this->slides as $slide):
                
                $i++;
                $image = "";
				if(!empty($slide['slideshow_image']))
				{	
                    $m_d = array();
                    if(isset($this->media_img_data[$i]))
                        $m_d = $this->media_img_data[$i];
					$image_string = themeple_image_by_id($slide['slideshow_image'], $this->img_size, 'image', $m_d); 
					if(!$image_string) $image_string = $slide['slideshow_image'];
					if(isset($slide['slideshow_link']) && $slide['slideshow_link'] != 'http://')
					{
						$image = "<a href='".$slide['slideshow_link']."'>".$image_string."</a>";
					}else
                        $image = $image_string;
				}
                $video = "";
				if(!empty($slide['slideshow_video']))
				{
					if(themeple_backend_is_file($slide['slideshow_video'], 'html5video'))
					{
						$video = themeple_html5_video_embed($slide['slideshow_video']);
					}
					else if(strpos($slide['slideshow_video'],'<iframe') !== false)
					{
						$video = $slide['slideshow_video'];
					}
					else
					{
						global $wp_embed;
						$video = $wp_embed->run_shortcode("[embed]".trim($slide['slideshow_video'])."[/embed]");
					}
					
					if(strpos($video, '<a') === 0)
					{
						$video = '<iframe src="'.$slide['slideshow_video'].'"></iframe>';
					}
				}
                $output .= "		<li data-thumb='".themeple_image_by_id($slide['slideshow_image'], 'thumbs', 'url', $m_d)."' class='".$this->slide_element_class." slide_element slide".$i." frame".$i."'>";
        			if(!is_array($this->before_render_media))
                        $output .=           $this->before_render_media;
                    else
                        $output .=           $this->before_render_media[$i];
                    $output .= 			 $image.$video;
    				$output .=           $this->after_render_media;
                    if(isset($slide['slideshow_description']) && strlen($slide['slideshow_description']) > 1){
                        $output .= $this->after_render_media; $output .= '<div class="captionss">';
			   $output .= '<p class="flex-caption" data-effect-in="fadeInLeft" data-effect-out="fadeOutRight"><span>'.$slide['slideshow_description'].'</span></p>';
                    	   if(isset($slide['slideshow_description_2']) && strlen($slide['slideshow_description_2']) > 1)
			   	$output .= '<p class="flex-caption" data-effect-in="fadeInLeft" data-effect-out="fadeOutRight"><span>'.$slide['slideshow_description_2'].'</span></p>';
			   $output .='</div>';
			}
    			$output .= "		</li>";
    			
    	   	
            
            
            endforeach;
            $output .= $this->after_elements;
            $output .= "	</ul>";
            $output .= $this->custom_footer_html;
           
            $output .= "</div>";
            $output .= $this->after_container_html;
            
        }
        return $output;
        
    }
    
    /**
     * themeple_slideshow::flexslider()
     * 
     * @return
     */
    function flexslider(){
        global $themeple_config;
        $this->slide_container_class = 'flexslider';
        $this->slide_ul_class = "slides";
        $themeple_config['slideshow_type'] = 'flexslider';
        
    }
    
    function flexslider_thumb(){
        global $themeple_config;
        $output = '<div class="with_thumbnails_container">';
        $this->slide_container_class = 'flexslider with_thumbnails';
        $this->slide_ul_class = "slides"; 
        $themeple_config['slideshow_type'] = 'flexslider_thumbnails';
        return $output;
    }

    function no_slider(){

        global $themeple_config;
        $this->slide_container_class = 'no_slider';
        $this->slide_ul_class = "slides";
        
        $themeple_config['slideshow_type'] = 'no_slider';
        

    }

    function layer_slider(){
       
       return do_shortcode('[layerslider id="'.$this->options['layer_slider_id'].'"]');
    }
 
    function revolution(){
	
       return do_shortcode('[rev_slider '.$this->options['revolution_alias'].']');
    }

    function image_thumbnails(){
        $output = '<div class="with_thumbnails_container">';
        $this->slide_container_class = 'flexslider with_thumbnails';
        $this->slide_ul_class = "slides"; 
        $this->slide_container_id = 'content';
        $this->img_size = array('width' => 2000, 'height'=> 2000);
        $output .=  $this->render_slideshow();
        $this->img_size = 'port2';
        $this->slide_container_class = 'flexslider with_thumbnails_carousel';
        $this->slide_container_id = 'carousel';
        $output .= $this->render_slideshow();
        $output .= '</div>';
        return $output;
    }
    

    function showbiz(){

        $type = themeple_post_meta(themeple_get_post_id(), 'showbiz_get_from');
        $post_per_page = themeple_post_meta(themeple_get_post_id(), 'showbiz_number');
        $this->slide_number = $post_per_page;
        $output = '';
        $output .= '<div class="showbiz-container '.$this->options['slideshow_layout'].' nopaddings">';

                
        $output .= '    <div class="showbiz sb-modern-skin">';

        $output .= '        <div class="overflowholder">';
        $output .= '                <!-- LIST OF THE ENTRIES -->';
        $output .= '                <ul>';

        $output .= '                <!-- AN ENTRY HERE WITH PREDEFINED MEDIA SKIN-->';
        $args = array('post_type' => 'post');
        if($type == 'pages'){
            $args = array('post_type' => 'pages', 'posts_per_page' => $posts_per_page);
        }else if($type == 'portfolio'){
            $args = array('post_type' => 'portfolio', 'posts_per_page' => $posts_per_page);
        }else if($type == 'post'){
            $args = array('post_type' => 'post', 'posts_per_page' => $posts_per_page);
        }
        query_posts($args);

        while(have_posts() ): the_post();

            $count = 0;

            $comment_entries = get_comments(array( 'type'=> 'comment', 'post_id' => get_the_ID() ));

            if(count($comment_entries) > 0){

                foreach($comment_entries as $comment){

                    if($comment->comment_approved)

                        $count++;

                }

            }

            $output .= '                    <li class="sb-modern-skin">';

            $output .= '                                <!-- THE MEDIA HOLDER -->';
            $output .= '                                <div class="mediaholder">';
            $output .= '                                    <div class="mediaholder_innerwrap">';
            $output .= '                                        <img src="'.themeple_image_by_id(get_post_thumbnail_id(), 'great_gallery', 'url').'" alt="">';
            $output .= '                                    </div>';
            $output .= '                                </div><!-- END OF MEDIA HOLDER -->';
           
            $output .= '                                <div class="darkhover"></div>';

            $output .= '                                <div class="detailholder">';
            $output .= '                                    <div class="showbiz-title"><h3>'.get_the_title().'</h3></div>';
            $output .= '                                    <div class="divide20"></div>';
            $output .= '                                    <p class="excerpt">';
            $output .=                                              get_the_excerpt();
            $output .= '                                            <div class="divide20"></div>';
            $output .= '                                    </p>';
            $output .= '                                    <!-- THE POST INFOS AND READ MORE BUTTON -->';
            $output .= '                                    <div class="sb-post-details leftfloat"><span class="rm15">'.$count.' '.__('Comments', 'themeple').'</span><span class="rm15">'.get_the_date().'</span></div>';
            $output .= '                                    <div class="sb-readmore rightfloat"><a href="#">'.__('Read More', 'themeple').'</a></div>';
            $output .= '                                    <div class="sb-clear"></div><!-- END OF POST INFOS AND READ MORE BUTTON -->';
            $output .= '                                </div>';


            $output .= '                     </li><!-- END OF ENTRY -->';
        
        endwhile;
        wp_reset_postdata();
        
        $output .= '                </ul>';
        $output .= '        </div>';
        $output .= '    </div>';
        $output .= '</div>';

        return $output;
    }
    
    function active_slider(){
        if($this->slide_number){
            $output = '';
            $output .= '<div class="slideshow_container active_slider" id="'.$this->slide_container_id.'flex" '.$this->additional_attr.'>';
           
            $output .= '    <ul class="slides slide_'.$this->slide_type.'">';
            $i = 0;
            foreach($this->slides as $slide):
                
                $i++;
                $image = "";
                if(!empty($slide['slideshow_image']))
                {   
                                
                    $image_string = '<img src="'.themeple_image_by_id($slide['slideshow_image'], '', 'url').'" alt="" />';
                    if(!$image_string) $image_string = $slide['slideshow_image'];
                   
                    $image = $image_string;
                
               
                    $output .= "<li class='".$this->slide_element_class." slide_element slide".$i." frame".$i."' data-thumb='".themeple_image_by_id($slide['slideshow_image'], array('width'=>90,'height'=>45), 'url')."'>";
                    
                    $output .=           $image;
                      
            
                    $output .= "</li>";
                }  
            
            
            
            endforeach;
            
            $output .= "    </ul>";
           
            $output .= '<div class="active_slider_pagination"><div class="container">';
                for($i = 0; $i < count($this->slides); $i++ ): $output .= '<div data-id="'.$i.'" class="el '.( ($i == 0)?'active':'').'"></div>'; endfor;
            $output .= '</div></div>';
            $output .= "</div>";

        }

        return $output;
    }

    function swiper_slider(){
        $nested_slider_bool = themeple_post_meta($this->post_id, 'nested_bool');
        $data = array();
        $orders_array = array();
        if($nested_slider_bool == 'yes'){
            $nested_array = themeple_post_meta($this->post_id, 'swiper_nested');
            if(is_array($nested_array)){
                foreach($nested_array as $n):
                    $this_order = $n['order'];
                    while(in_array($this_order, $orders_array)){
                        $this_order +=1;
                    }
                    $data[] = array(
                        'slides' => themeple_post_meta($n['page'], 'slideshow'),
                        'order'  => (int) $this_order,
                        'layout' => $n['layout'],
                        'nested' => true
                    );
                    $orders_array[] = $n['order'];
                endforeach;
            }
        }
        if(is_array($this->slides)){
            $i = 0;

            foreach($this->slides as $slide):
                $i++;
                $this_order = $i;
                while(in_array($this_order, $orders_array)){
                    $this_order +=1;
                }
                $data[] = array(
                        'slides' => $slide,
                        'order'  => $this_order,
                        'layout' => 'full',
                        'nested' => false
                );
                $orders_array[] = $this_order;
            endforeach;
        }
        sort($orders_array);
        themeple_aasort($data, 'order');
        $output = '';
        $output .= '<div class="swiper-container swiper-parent swiper_slider"  data-slidenr="4">';
        $output .= '    <div class="pagination pagination-parent"></div>';
        $output .= '        <div class="swiper-wrapper">';
        foreach($data as $d){

            
            if($d['nested']){
                $output .= '    <div class="swiper-slide   layout-'.$d['layout'].'" >';
                $output .= '    <div class="swiper-container swiper-nested-'.$d['order'].'   layout-'.$d['layout'].'" data-nested-id="'.$d['order'].'">';
                $output .= '        <div class="pagination pagination-nested-'.$d['order'].'"></div>';
                $output .= '        <div class="swiper-wrapper">';
                if(is_array($d['slides'])):
                    foreach($d['slides'] as $slide):
                        
                        if(!empty($slide['slideshow_image']))
                        {  
                            
                            $output .= '    <div class="swiper-slide  layout-'.$d['layout'].'" style="background-image:url('.themeple_image_by_id($slide['slideshow_image'], 'swiper_slider', 'url').'); background-repeat:no-repeat; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;" >';
                          
                            $output .= '    </div>';
                        }
                    endforeach;
                
                endif;
                $output .= '        </div>';
                $output .= '    </div>';
                $output .= '</div>';
            }else{

                if(!empty($d['slides']['slideshow_image'])){
                    $output .= '<div class="swiper-slide  layout-'.$d['layout'].'" style="background-image:url('.themeple_image_by_id($d['slides']['slideshow_image'], 'swiper_slider', 'url').'); background-repeat:no-repeat; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;" >';
                    $output .= '</div>';
                }
            }
            
        }
        $output .= '        </div>';
        $output .= '    </div>';
        $output .= '</div>';

        return $output;

    }

    function project_slider(){
        $this->slide_number = 5;
        $output = '<div class="project_slider">';
        $args = array('post_type' => 'projectslide', 'posts_per_page' => -1);
        query_posts($args);
        $output_pagination = '<ul>';
        while(have_posts() ): the_post();
            $output_pagination .= '    <li><a href="#project-'.get_the_ID().'">'.get_the_title().'<span>'.themeple_post_meta(get_the_ID(), 'author_project').'</span></a></li>';
        endwhile;
        wp_reset_postdata();
        $output_pagination .= '</ul>';
        $output .= $output_pagination;

        query_posts($args);
        $output_pagination .= '<ul>';
        while(have_posts() ): the_post();
            $output .= '<div id="project-'.get_the_ID().'">';
                $this->slides = themeple_post_meta(get_the_ID(), 'slideshow');
                $this->slide_number = count($this->slides);
                if($this->slide_number > 1){
                    $this->slide_container_class = 'flexslider';
                    $this->slide_container_id = "flex_".rand(50, 5000);
                    $this->img_size = 'blog';
                    $this->slide_ul_class = "slides";
                    $output .= $this->render_slideshow();
                }
            $output .= '</div>';
        endwhile;
        wp_reset_postdata();
        $output .= '</div>';

        return $output;
    }



     function flex_text_thumbnail(){
        
        $this->slide_container_class = 'flexslider with_text_thumbnail';
        $this->slide_ul_class = "slides";
        $pagination = '<ul class="flex-text-thumbnail">';
        if(is_array($this->slides)){
            foreach($this->slides as $slide):
                $pagination .= '<li>';
                    $pagination .= '<h5>'.$slide['text_thumb_title'].'</h5>';
                    $pagination .= '<p>'.$slide['text_thumb_desc'].'</p>';
                $pagination .= '</li>';
            endforeach;
        }
        
        $pagination .= '</ul>';
        $this->custom_footer_html = $pagination;
        $output = $this->render_slideshow();

        return $output;

    }

    function vertical_slider(){
        $cols = themeple_post_meta(themeple_get_post_id(), 'vertical_col');
        $rows = themeple_post_meta(themeple_get_post_id(), 'vertical_row');
        $this->slide_container_class = 'flexslider vertical_slider';
        $this->slide_ul_class = "slides";
        $this->img_size = 'blog';
        
        $pagination = '<ul class="vertical-slider-thumbs" data-cols="'.$cols.'" data-rows="'.$rows.'">';
        if(is_array($this->slides)){
            $this->slides = array_slice($this->slides, 0, $cols*$rows);
            foreach($this->slides as $slide):
                $pagination .= '<li style="background-image:url('.themeple_image_by_id($slide['slideshow_image'], 'vertical', 'url').'); background-repeat:no-repeat; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">';
                    
                $pagination .= '</li>';
            endforeach;
        }
        $pagination .= '</ul>';
        $this->custom_footer_html = $pagination;
        $output = $this->render_slideshow();
        return $output;
    }

    function kwicks_slider(){
        $this->slide_number = 5;
        $type = themeple_post_meta(themeple_get_post_id(), 'kwicks_get_from');
        $output = '';
        $output .= '<div class="kwicks">';

        $posts_per_page = 5;      
        $output .= '    <div class="holder">';
        $args = array('post_type' => 'post');
        if($type == 'pages'){
            $args = array('post_type' => 'pages', 'posts_per_page' => $posts_per_page);
        }else if($type == 'portfolio'){
            $args = array('post_type' => 'portfolio', 'posts_per_page' => $posts_per_page);
        }else if($type == 'blog'){
            $args = array('post_type' => 'post', 'posts_per_page' => $posts_per_page);
        }
        if($type != 'slideshow'){
            query_posts($args);

            while(have_posts() ): the_post();

                $output .= '                    <a href="'.get_permalink().'" target="_blank">';
                $output .= '                                <div class="block">';
                $output .= '                                    <div class="content_holder" src="'.themeple_image_by_id(get_post_thumbnail_id(), '', 'url').'">';
                $output .= '                                        <div class="image"></div>';
                $output .= '                                        <div class="content" transitionType="bottom" transitionTime="0.5" distance="30" delay="0" x="0" y="0" alignV="bottom">';
                $output .= '                                            <div class="box"><p class="title">'.get_the_title().'</p><p class="text">'.get_the_excerpt().'</p></div>';
                $output .= '                                        </div>';
                $output .= '                                    </div>';
                $output .= '                                </div><!-- END OF MEDIA HOLDER -->';
                $output .= '                     </a><!-- END OF ENTRY -->';
            
            endwhile;
            wp_reset_postdata();
        }else{
            if($this->slide_number > 0){
                foreach($this->slides as $slide):
                    if(!empty($slide['slideshow_image'])){   

                        $output .= '                    <a href="#" target="_blank">';
                        $output .= '                                <div class="block">';
                        $output .= '                                    <div class="content_holder" src="'.themeple_image_by_id($slide['slideshow_image'], '', 'url').'">';
                        $output .= '                                        <div class="image"></div>';
                        $output .= '                                        <div class="content" transitionType="bottom" transitionTime="0.5" distance="30" delay="0" x="0" y="0" alignV="bottom">';
                        $output .= '                                            <div class="box"><p class="title">'.$slide['slideshow_description'].'</p><p class="text">'.$slide['slideshow_description_2'].'</p></div>';
                        $output .= '                                        </div>';
                        $output .= '                                    </div>';
                        $output .= '                                </div><!-- END OF MEDIA HOLDER -->';
                        $output .= '                     </a><!-- END OF ENTRY -->';

                }
                endforeach;
            }
            
        }
        $output .= '    </div>';
        $output .= '</div>';

        return $output;

    }


    function woocommerce_slider(){
        $posts_per_page = themeple_post_meta(themeple_get_post_id(), 'slides_number');
        $args = array( 'post_type' => 'product', 'posts_per_page' => $posts_per_page, 'orderby' =>'date','order' => 'DESC' );
        $loop = new WP_Query( $args );
        $this->slide_number = 5;
        global $woocommerce;
        
        $items_in_cart = array();

        if($woocommerce->cart->get_cart() && is_array($woocommerce->cart->get_cart())) {
            foreach($woocommerce->cart->get_cart() as $cart) {
                $items_in_cart[] = $cart['product_id'];
            }
        }
        $output = '';
        $output .= '<div class="swiper-container swiper-parent swiper_slider" data-slidenr="5">';
        $output .= '    <div class="pagination pagination-parent"></div>';
        $output .= '        <div class="swiper-wrapper">';
         while ( $loop->have_posts() ) : $loop->the_post(); 

            global $product;
            $in_array = in_array($product->id, $items_in_cart);
            $output .= '<div class="swiper-slide woocommerce-slide product '.(($in_array)?'product_added_to_cart':'').'" style="background-image:url('.themeple_image_by_id(get_post_thumbnail_id(), "shop_catalog", 'url').'); background-repeat:no-repeat; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;" >';
                $output .= '<div class="overlay">';
                    if($in_array)
                        $output .= '<span class="loading_ef"><i class="moon-checkmark"></i></span>';
                    else    
                        $output .= '<span class="loading_ef"><i class="icon-spin moon-spinner-2" aria-hidden="true"></i></span>';
                        
                    $output .= '<div class="center-bar">';
                        $output .= '<a href="#" class="link a0 add_to_cart_button button product_type_simple" data-product_id="'.$product->id.'" data-product_sku="'.$product->get_sku().'" data-animate="zoomIn"><i class="moon-cart"></i></a></a>';
                        $output .= '<a href="'.get_permalink().'" class="link a0" data-animate="zoomIn"><i class="moon-list-3"></i></a></a>';
                        $output .= '<h5>'.get_the_title().'</h5>';
                        $output .= '<span class="price">'.$product->get_price_html().'</span>';
                    $output .= "</div>";
                $output .= '</div>';
            $output .= '</div>';
        
        endwhile;
        $output .= '        </div>';
        $output .= '    </div>';
        $output .= '</div>';

        return $output;

    }
        
    
    
}


?>