<?php

/**
 * GenerateDynamicTemplate
 * 
 * @package   
 * @author 
 * @copyright oni12
 * @version 2012
 * @access public
 */
class GenerateDynamicTemplate{
    
    var $template_type;
    var $post_id;
    var $template_elements = array();
    var $template_layout;
    var $layout;
    var $temp_name = "";
    var $output = array();
    /**
     * GenerateDynamicTemplate::GenerateDynamicTemplate()
     * 
     * @return
     */
    function GenerateDynamicTemplate($template = false){
        global $controller, $post;
        if($template != false){
            $ar = explode("-", $template);
            $this->temp_name = $ar[1];
            $this->template_type = $template;
            $this->post_id = themeple_get_post_id();
            $this->template_elements = $this->getTemplateElements();
        }
    }
    
    /**
     * GenerateDynamicTemplate::getTemplateElements()
     * 
     * @return
     */
    function getTemplateElements(){
        global $controller;
        $elements = array();
       
        if(isset($controller->options['builder']))
            $controller->options['builder'] = themeple_entity_decode($controller->options['builder']);
        
        foreach($controller->page_elements as $key => $element){
            
            if('dynamic_template-'.$element['slug'] == $this->template_type && isset($element['dynamic'])){
                
                if(isset($controller->options['builder'][$element['id']])){
                    $controller->page_elements[$key]['saved'] = $controller->options['builder'][$element['id']];
                    
                }
                $elements[] = $controller->page_elements[$key];
            }
        }
        
        return $elements;
        
    }
    /**
     * GenerateDynamicTemplate::getTemplateOption()
     * 
     * @return
     */
    function getTemplateOption($option_id){
        global $controller;
        
        $option = false;
        if(isset($controller->options['builder']) && isset($controller->options['builder'][$this->temp_name.$option_id])){
            $option = themeple_entity_decode($controller->options['builder'][$this->temp_name.$option_id]);
        }
        
        return $option;
    }
    /**
     * GenerateDynamicTemplate::setLayout()
     * 
     * @return
     */
    function setLayout($layout = ""){
        global $themeple_config;
        
        $this->getTemplateOption('dynamic_page_layout');
        if(!$layout)
            $layout = $this->getTemplateOption('dynamic_page_layout');
        if(!$layout)
            $layout = "fullsize";
        if(isset($themeple_config['layout']) )    
            $themeple_config['layout']['current_layout'] = $themeple_config['layout'][$layout];
        $this->layout = $layout;
        
    }
    /**
     * GenerateDynamicTemplate::createView()
     * 
     * @return
     */
    function createView(){
        $this->setLayout();
        $size = 0;
        $section_start = false;
        $i = 0;
        foreach($this->template_elements as $element)
        {
            if(method_exists($this, $element['dynamic']) || $element['dynamic'] == 'section_start' || $element['dynamic'] == 'section_end')
            {           
                 
                if(isset($element['saved']))
                {

                    $i++;
                    if($i == 1 && ($element['dynamic'] == 'section_start' || ($element['dynamic'] == 'google_map' && $element['saved'][0]['map_fullwidth'] == 'yes') || $element['dynamic'] == 'fullwidth_portfolio' || $element['dynamic'] == 'fullwidth_blog' || ($element['dynamic'] == 'slideshow' && $element['saved'][0]['fullwidth'] == 'yes')  )){
                        if(!update_option('section_first', 'yes'))
                            add_option('section_first', 'yes');

                    }else{
                        if($i == 1){
                if(!update_option('section_first', 'no') )
                                add_option('section_first', 'no');
               }
                    }
            if($i == count($this->template_elements) && ($element['dynamic'] == 'section_end' || ($element['dynamic'] == 'google_map' && $element['saved'][0]['map_fullwidth'] == 'yes') ||  ($element['dynamic'] == 'slideshow' && $element['saved'][0]['fullwidth'] == 'yes') || $element['dynamic'] == 'fullwidth_portfolio' || $element['dynamic'] == 'fullwidth_blog' ) ){
                        if(!update_option('section_last', 'yes'))
                            add_option('section_last', 'yes');

                    }else{ 
                        if($i == count($this->template_elements)){
                if(!update_option('section_last', 'no') )
                                add_option('section_last', 'no');
               }
                    }
            
                    $test = '';

                    if($element['dynamic'] == 'head_text')
                        $test = ' style="margin-bottom:-40px;" ';
                    
                    $other_class = '';  
                    $other_style = '';
                    $video = '';
                    $arrows = '';
                    $parallax = '';
                    $overlay = '';
                    if($element['dynamic'] == 'section_start'){
                            $other_class = 'section-style';
                            if(isset($element['saved'][0]['inside_margin']))
                            $other_class .= ' '.$element['saved'][0]['inside_margin'];

                            if(isset($element['saved'][0]['borders']) && $element['saved'][0]['borders'] == 'no')
                                $other_class .= ' no_borders';
                            
                            if($element['saved'][0]['bg_type'] == 'bg_color')
                                $other_style = 'background-color:'.$element['saved'][0]['bg_color'].'; ';

                             if($element['saved'][0]['bg_type'] == 'image' && ((isset($element['saved'][0]['parallax']) && $element['saved'][0]['parallax'] == 'no') || !isset($element['saved'][0]['parallax']) ) ){
                                $other_style = 'background-image:url('.$element['saved'][0]['image'].'); ';
                                if(isset($element['saved'][0]['fixed_img']) && $element['saved'][0]['fixed_img'] == 'yes' )
                                    $other_style .= ' background-repeat: no-repeat;background-position: 50% 0%;background-attachment: fixed; '; 
                                
                             }
                             if(isset($element['saved'][0]['parallax']) && $element['saved'][0]['parallax'] == 'yes' && $element['saved'][0]['bg_type'] == 'image'){    

                                    $parallax .= '<div class="parallax_bg" style="background-image: url('.$element['saved'][0]['image'].'); background-position: 50% 0px;"></div>';
                                    $other_class .= ' parallax_section';
                            }else{
                                $other_class .= ' animate_onoffset';
                            }
                            if(isset($element['saved'][0]['light_version']) && $element['saved'][0]['light_version'] == 'yes' ){
                                $other_class .= ' dark_sec';
                            }
                             if($element['saved'][0]['bg_type'] == 'video'){

                                $video = '<div class="video-wrap"><video id="video_background" preload="auto" autoplay="true" loop="loop" muted="muted" volume="0"> 
                                                                        <source src="'.$element['saved'][0]['webm_video'].'" type="video/webm"> 
                                                                        <source src="'.$element['saved'][0]['mp4_video'].'" type="video/mp4"> 
                                                      
                                                                        Video not supported </video></div>';
                                $other_class .= ' video_section';
                             }
                             if($element['saved'][0]['overlay'] == 'yes'){

                                $overlay = '<div class="bg-overlay" style="background:'.$element['saved'][0]['overlay_color'].';"></div>';
                             }
                             if($element['saved'][0]['bg_type'])
                             if($element['saved'][0]['bg_type'] == 'bg_color' && $element['saved'][0]['top_triangle'] == 'yes')
                                $arrows .= '<div class="triangle top_arrow"><div class="triangle_container" style="border-color: transparent transparent transparent transparent;"><div class="triangle_trick" style="border-color: transparent transparent '.$element['saved'][0]['bg_color'].' transparent;"></div></div></div>';
                             if($element['saved'][0]['bg_type'] == 'bg_color' && $element['saved'][0]['bottom_triangle'] == 'yes')
                                $arrows .= '<div class="triangle bottom_arrow"><div class="triangle_container" style="border-color: transparent transparent transparent transparent;"><div class="triangle_trick" style="border-color: '.$element['saved'][0]['bg_color'].' transparent transparent transparent;"></div></div></div>';
                             if($element['saved'][0]['padding_top'] == 'no')
                                $other_style .= 'padding-top:0px !important; ';
                             if($element['saved'][0]['padding_bottom'] == 'no')
                                $other_style .= 'padding-bottom:0px !important; ';
                            $section_start = true;
                    }else{
                    
                            $other_class .= ' animate_onoffset';
                    }
                if( ($size == 0 && $element['dynamic'] != 'section_end') ){
                        

                        if( ($element['dynamic'] != 'google_map'  && $element['dynamic'] != 'fullwidth_portfolio' && $element['dynamic'] != 'fullwidth_blog' && $element['dynamic'] != 'slideshow' ) || ($element['dynamic'] == 'google_map' && $element['saved'][0]['map_fullwidth'] == 'no') || ($element['dynamic'] == 'slideshow' && $element['saved'][0]['fullwidth'] == 'no')  ){
                            if($element['dynamic'] == 'el_head')
                                $other_class .= ' second_space';
                            if($element['dynamic'] == 'page_header')
                                $other_class .= ' third_space';
                            if($element['dynamic'] == 'divider')
                                $other_class .= ' fourth_space';
                            $this->output[] = '<div class="row-fluid row-dynamic-el '.$other_class.'"'.$test.' '.$other_html.' style="'.$other_style.'">';
                                    if(isset($parallax))
                                            $this->output[] = $parallax;
                                    $this->output[] = '<div class="container">';
                                        if(isset($video))
                                            $this->output[] = $video;
                                        if(isset($overlay))
                                            $this->output[] = $overlay;
                                        if(isset($arrows))
                                            $this->output[] = $arrows;
                                        
                                        $this->output[] = '<div class="row-fluid">';
                                        
                        }else if(  ($element['dynamic'] == 'google_map' && $element['saved'][0]['map_fullwidth'] == 'yes') ||  ($element['dynamic'] == 'slideshow' && $element['saved'][0]['fullwidth'] == 'yes') || $element['dynamic'] == 'fullwidth_portfolio' || $element['dynamic'] == 'fullwidth_blog'){
                             $this->output[] = '<div class="row-fluid section-style no_borders row-dynamic-el" style="padding-top:0px !important;padding-bottom:0px !important;">';
                        }
                                
                    }
                    
                    $size += $element['saved'][0]['dynamic_size'];
                    if($element['dynamic'] == 'section_start')
                            $size = 0;
                    if($size <= 12 && $element['dynamic'] != 'section_start' && $element['dynamic'] != 'section_end')
                        $this->output[] = $this->$element['dynamic']($element);
                    if($size == 12 && $element['dynamic'] != 'section_start'){
                        if( ($element['dynamic'] != 'slideshow' || ($element['dynamic'] == 'slideshow' && $element['saved'][0]['fullwidth'] == 'no') ) && ($element['dynamic'] != 'google_map' || ($element['dynamic'] == 'google_map' && $element['saved'][0]['map_fullwidth'] == 'no') ) && $element['dynamic'] != 'fullwidth_portfolio' && $element['dynamic'] != 'fullwidth_blog' ){           
                                        
                                        $this->output[] = '</div>';
                                       
                                            $this->output[] = '</div>';
                                        
                            $this->output[] = '</div>';
                        }else if($element['dynamic'] == 'fullwidth_blog' || $element['dynamic'] == 'fullwidth_portfolio' || ($element['dynamic'] == 'google_map' && $element['saved'][0]['map_fullwidth'] == 'yes') || ($element['dynamic'] != 'google_map' || ($element['dynamic'] == 'slideshow' && $element['saved'][0]['fullwidth'] == 'yes') )  ){
                            $this->output[] = '</div>';
                        }
                        $size = 0;
                    }
                    
                    
                    
                    
                }
            }       
            
        }


                

        
        $this->setLayout();
    }
    /**
     * GenerateDynamicTemplate::display()
     * 
     * @return
     */
    function display(){
        global $controller;
        echo implode("\n\n", $this->output);
       
    }
    
    function testimonials($element){
        extract($element['saved'][0]);
        $output = '';
        
        $output = '<div class="span'.$dynamic_size.' testimonials_block">';
        
        if(!empty($title)){
            $output .= '<div class="header"><dl class="dl-horizontal">';
            if(!isset($icon_title_bool)) $icon_title_bool = 'no';
            if($icon_title_bool == 'yes'):
                $output .= '<dt><i class="'.$icon_title.'"></i></dt>';
                $output .= '<dd style="margin-left:55px !important; margin-top:10px;"><h4>'.$title.'</h4></dd>';
            endif;
            if($icon_title_bool == 'no'):
                $output .= '<dd style="margin-left:0px"><h4>'.$title.'</h4></dd>';
            endif;
            $output .= '</dl></div>';
        }  
        $output .= '<div class="row">';   
        $output .= '<div class="carousel carousel_testimonial">';            
        $query_post = array('posts_per_page'=> 4, 'post_type'=> 'testimonial' );                          
      
        $loop = new WP_Query($query_post);
                     if($loop->have_posts()){

                        while($loop->have_posts()){
                            
                            $loop->the_post();  
                            
                            $output .= '<dl class="second_testimonial dl-horizontal"><dt><div class="first_circle"><div class="second_circle"></div></div><span class="arrow"></span></dt><dd><div class="content">'.get_the_content().'</div><h6 class="name">'.get_the_title().' <span class="position">'.themeple_post_meta(get_the_ID(), 'staff_position_').'</span></h6></dl>';
                                                                  
                                                 
                                    
                        }
                    }
        wp_reset_postdata();
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        return $output;
    }


    function simple_testimonial($element){
        extract($element['saved'][0]);
        $output = ''; 
        
        $output = '<div class="span'.$dynamic_size.'">';
        if(!empty($title)){
            $output .= '<div class="header"><h3>'.$title.'</h3></div>';
        }
               
        $query_post = array('posts_per_page'=> -1, 'post_type'=> 'testimonial');                          
        $output .= '<div class="row">';
        $output .= '<div class="carousel carousel_testimonial">';   
        $loop = new WP_Query($query_post);
                     if($loop->have_posts()){

                        while($loop->have_posts()){
                            
                            $loop->the_post();  

                            $output .= '<div class="circle_testimonial"><p>'.get_the_content().'</p><i class="moon-user"></i><span class="title">'.get_the_title().', <span class="position">'.themeple_post_meta(get_the_ID(), 'staff_position_').'</span></span></div>';
                                                                  
                                                 
                                    
                        }
                    }
        wp_reset_postdata();
        
        $output .= '</div>';
        $output .= '</div></div>';
        return $output;
    }


    function latest_blog_effect($element){
        extract($element['saved'][0]);
        
        $posts_per_page = 9999;
     
        

        $output = '<div class="span'.$dynamic_size.' latest_blog_effect">';
        if(!empty($title)){
            $output .= '<div class="header"><h3>'.$title.'</h3></div>';
        }
        if($dynamic_from_where == 'all_cat'){
            $query_post = array('posts_per_page'=> 3, 'post_type'=> 'post'  );                          
        }else{
           $query_post = array('posts_per_page'=> 3, 'post_type'=> 'post', 'cat' => $dynamic_cat ); 
        }
            $size_span_class = '';
            
            $output .= '<div class="row">';
                $output .= '<div class="span12 latest_blog_effect">';
                                            
                        $loop = new WP_Query($query_post);
                                     $i = 0;
                                     if($loop->have_posts()){
                                        while($loop->have_posts()){
                                            $loop->the_post();
                                            
                                            $post_id = get_the_ID();      
                                            $post_format = get_post_format($post_id);

                                                if(strlen($post_format) == 0)
                                                    $post_format = 'standart';    
                                                if($post_format == 'standart'){
            $icon_class="pencil";
            }elseif($post_format == 'audio'){
                $icon_class="music";
            }elseif($post_format == 'soundcloud'){
                $icon_class="music";
            }elseif($post_format == 'video'){
                $icon_class="play";
            }elseif($post_format == 'quote'){
                $icon_class="quote-left";
            }elseif($post_format == 'gallery'){
                $icon_class="images";
            }     

            $count = 0;

                                $comment_entries = get_comments(array( 'type'=> 'comment', 'post_id' => get_the_ID() ));

                                if(count($comment_entries) > 0){

                                    foreach($comment_entries as $comment){

                                        if($comment->comment_approved)

                                            $count++;

                                    }

                                }           
                              $active = '';
                              if($i == 0)
                                $active = 'active'; 
                                        if($post_format == 'standart'){
                                            $i++;
                                                $output .= '<div class="blog-article '.$size_span_class.' '.$active.'">';

                                                $output .= '            <div class="media">';


                                              
                                                            $output .= '<div class="he-wrap tpl2">';
                                                                    $output .= '<img src="'.themeple_image_by_id(get_post_thumbnail_id(), 'port4', 'url').'" alt="">';
                                                                    $output .= '<div class="overlay he-view">';
                                                                    $output .= '   <div class="bg a0" data-animate="fadeIn">';
                                                                    $output .= '        <div class="center-bar v1">';
                                                                    $output .= '            <a href="'.get_permalink().'" class="link a0" data-animate="zoomIn"><i class="moon-'.$icon_class.'"></i></a></a>';
                                                               
                                                               
                                                                    $output .= '        </div>';
                                                                    $output .= '    </div>';
                                                                    $output .= '</div>';
                                                        $output .= '</div>';   
                               
                                          
                               
                                
                                $output .= '</div>';

                                $output .= '<dl class="">';
                                $output .= '        <h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
                                $output .= '        <ul class="info">';
                                                  
                                $output .= '            <li>'.$count.' '.__('Comments', 'themeple').'</li>';
                                $output .= '            <li>'.get_the_date().'</li>';
                                    
                                $output .= '        </ul>';
                                $output .= '    <dd>';

                                $output .= '        <div class="blog-content">';        
                                $output .=              themeple_text_limit(get_the_excerpt(), 17);

                                                                   
                                $output .= '        </div>'; 
                                $output .= '    </dd>';
    
                                $output .= '</dl>';                                 
                                            
                                                                       


                                $output .= '</div>';
                                           
                                }     
                                        };
                                    };
                                    wp_reset_postdata();
                
                    $output .= '</div>';       


        $output .= '</div>';


        return $output;
    }


    function single_testimonial($element){
        extract($element['saved'][0]);
        $output = ''; 
        
        $output = '<div class="span'.$dynamic_size.'">';
        
        if(!isset($testimon))
        $testimon = 0;          
        $query_post = array('posts_per_page'=> 9999, 'post_type'=> 'testimonial', 'p' => $testimon );                          
          
        $loop = new WP_Query($query_post);
                     if($loop->have_posts()){

                        while($loop->have_posts()){
                            
                            $loop->the_post();  

                            $output .= '<div class="single_testimonial"><dl class="dl-horizontal"><dt><img src="'.themeple_image_by_id(get_post_thumbnail_id(), 'great_gallery', 'url').'" alt=""></dt><dd>';
                            $output .= '<h6>'.get_the_title().', </h6><span class="position"> '.themeple_post_meta(get_the_ID(), 'staff_position_').'</span>';
                            $output .= '<span class="dt">'.get_the_date().'</span>';
                            $output .= '<p>'.get_the_content().'</p>';
                            $output .= '</dd></dl></div>';
                       
                                    
                        }
                    }
        wp_reset_postdata();
        
        $output .= '</div>';

        return $output;
    }
    
    function price_list($element){
         extract($element['saved'][0]);

         $output = "";

        $output .= '<div class="span'.$dynamic_size.'">';
        
        
         if(empty($first_color) or empty($second_color)){

            $first_color = themeple_get_option('base_color');
            $second_color = themeple_get_option('second_color');

         }

         $style_1 = '';
         $style_2 = '';

         if($highlight_table == 'yes'){
              $title_color  = ($title_color == '' ? $title_color = "#fff" : $title_color ) ;
              $price_color = ($price_color == '' ? $price_color ="#fff" :  $price_color) ;

               $style_1 ="background:$first_color; color:$title_color !important; border-bottom:none;";
               $style_2 ="background:$second_color; color:$price_color !important";

         }
       

            $output .='<div class="price_box" >';

              $output .= '<div class="title" style="'.$style_1.'">';

                $output .= $title;

              $output .=  '</div>';   

            $output .='<div class="price " style="'.$style_2.'">';
                  
            $output .= '<span class="p">'.$currency.$price. '</span><span class="period" style="color:'.$period_color.'">'.$period.'</span>';

            $output .= '</div>';

            $output .='<ul>';

                  foreach($lists as $list):

                    $output .= '<li>'.$list['list_name'].'</li>';

                endforeach;

            $output .='</ul>';

           $output .= '<div class="footer">';
              
                $output .= '<a href="'.$button_link.'" class="btn-system">'.$button_title.'</a>';

          

           $output .= '</div>';

           $output .= '</div>';

           $output .= '</div>';

          

           return $output;

    }


    function quote($element){
        extract($element['saved'][0]);
        $output = '';
        
        $output = '<div class="span'.$dynamic_size.'">';
        
        $output .= '<div class="header"><h5>'.$dynamic_title.'</h5></div>';   
                              
                                 
        $output .= '<div class="row-fluid">';
                           
        $output .= '<div class="quote"><i class="icon-quote-left"></i><div class="content">'.$quote.'<span class="title">'.$author.'</span></div></div>';
        
        $output .= '</div></div>';
        return $output;
    }

    function column($element){
        extract($element['saved'][0]);
        $data = array();
        $query = array();
        $output = '<div class="span'.$dynamic_size.'">';
        if($dynamic_content_type == 'page'){
            $query = array( 'p' => $dynamic_page, 'posts_per_page'=>1, 'post_type'=> 'page' );
        }
        if($dynamic_content_type == 'post'){
            $query = array( 'p' => $dynamic_post, 'posts_per_page'=>1, 'post_type'=> 'post' );
        }
        if($dynamic_content_type == 'content'){
            $data['title'] = $dynamic_content_title;
            $data['description'] = $dynamic_content_content;
            $data['link'] = $dynamic_content_link;
        }else{
            $loop = new WP_Query($query);
            if($loop->have_posts()){
                while($loop->have_posts()){
                    $loop->the_post();
                    
                    $data['link'] = get_permalink();
                    $data['title'] = get_the_title();
                    $data['description'] = get_the_excerpt();
                    
                }
            }
            wp_reset_postdata();
        }


        if(count($data) > 0){

            $output .='<div class="services-col">';
            if($dynamic_icon_req  == 'yes'){
                $output .= '<div class="icon"><span style="background-image:url(\''.$dynamic_icon.'\');"></span><span style="background-image:url(\''.$dynamic_icon_hover.'\');"></span></div>';
            }
                
            $output .='<div class="content">';
                $output .= '<h3><a href="'.$data['link'].'">'.$data['title'].'</a></h3>';
                $output .= '<p>'.$data['description'].'</p>';
                $output .= '<div class="sep_div"><span class="separator"></span></div>';
                $output .= '<a href="'.$data['link'].'" class="read-more">En savoir plus</a>';
            $output .='</div>';


        
            
        }
        
        $output .= '</div>';
        $output .= '</div>';
        return $output;

    }



    function clients($element){
        extract($element['saved'][0]);
	    

        if(!isset($carousel))
            $carousel = 'no';
        $clients = themeple_get_option('client-logo');

        $output = '<div class="span'.$dynamic_size.' clients_el">';
        
            $output .= '<div class="pagination"><a href="#" class="prev"></a><a href="#" class="next"></a></div>';
    
        $output .= '<section class="row clients '.(($carousel=="yes")?"clients_caro":"").'">';
        $i = 0;
        foreach($clients as $client):                            
                $i++;
                if($i == 1 || $i % 8 == 1)
                    $output .= '                <div class="items">';
                $output .= '                    <div class="item">
                                                    <a href="'.$client['link'].'"  rel="tooltip" title="'.$client['title'].'">
                                                        <img src="'.$client['logo'].'" alt="" >
                                                        
                                                    </a>
                                                </div>';
                if($i % 8 == 0)
                    $output .= '</div>';
        endforeach;
                          
        $output .= '</section>';
       

        $output .= '</div>';

        return $output;

    }


    function contact_info($element){
        extract($element['saved'][0]);
       
        $output = '<div class="span'.$dynamic_size.'">';
        if(!empty($dynamic_title)){
            $output .= '<div class="header"><dl class="dl-horizontal">';
            if(!isset($icon_title_bool)) $icon_title_bool = 'no';
            if($icon_title_bool == 'yes'):
                $output .= '<dt><i class="'.$icon_title.'"></i></dt>';
                $output .= '<dd style="margin-left:55px !important; margin-top:10px;"><h4>'.$dynamic_title.'</h4></dd>';
            endif;
            if($icon_title_bool == 'no'):
                $output .= '<dd style="margin-left:0px"><h4>'.$dynamic_title.'</h4></dd>';
            endif;
            $output .= '</dl></div>';
        } 
        
        $output .= '<section class="row-fluid">';
        
                                  
            $output .= '<div class="span12 contact_info">';
                $social_icons = themeple_get_option('social_icons');
                
                if(!empty($address))
                    $output .= '<p class="address">'.$address.'</p>';
                if(!empty($phone))
                    $output .= '<p>'.$phone.'</p>';
                if(!empty($fax))
                    $output .= '<p>'.$fax.'</p>';
                if(!empty($web))
                    $output .= '<p>'.$web.'</p>';

                $output .= '<ul class="social_icons">';
                    foreach($social_icons as $icon):



                        $output .= '<li class="'.$icon['social'].'"><a href="'.$icon['link'].'"><i class="icon-'.$icon['social'].'"></i></a></li>';



                    endforeach;



                $output .= '</ul>';


            $output .= '</div>';
        
                                    
        $output .= '</section>';
        

        $output .= '</div>';

        return $output;
    }




    

    
 
   



    function latest_blog($element){
        extract($element['saved'][0]);
        
        $posts_per_page = 9999;
     
        

        $output = '<div class="span'.$dynamic_size.' latest_blog">';
        $output .= '<div class="header">';
            $output .= '<h3>'.$dynamic_title.'</h3>';
            $output .= '<div class="pagination"><a href="#" class="prev"></a><a href="#" class="next"></a></div>';
        $output .=  '</div>';
       if($dynamic_from_where == 'all_cat'){
            $query_post = array('posts_per_page'=> -1, 'post_type'=> 'post'  );                          
        }else{
           $query_post = array('posts_per_page'=> -1, 'post_type'=> 'post', 'cat' => $dynamic_cat ); 
        }
            $size_span_class = '';
            
            $output .= '<div class="row">';
          $output .= '<div class="span12"><ul class="carousel carousel_blog">';
                
                                            
                        $loop = new WP_Query($query_post);
                                     $i = 0;
                                     if($loop->have_posts()){
                                        while($loop->have_posts()){
                                            $loop->the_post();
                          $i++;
                                            $post_id = get_the_ID();      
                                                $post_format = get_post_format($post_id);

                                                if(strlen($post_format) == 0)
                                                    $post_format = 'standart';

                                                if($post_format == 'standart'){
            $icon_class="pencil";
            }elseif($post_format == 'audio'){
                $icon_class="music";
            }elseif($post_format == 'soundcloud'){
                $icon_class="music";
            }elseif($post_format == 'video'){
                $icon_class="play";
            }elseif($post_format == 'quote'){
                $icon_class="quote-left";
            }elseif($post_format == 'gallery'){
                $icon_class="images";
            }     

            $count = 0;

                                $comment_entries = get_comments(array( 'type'=> 'comment', 'post_id' => get_the_ID() ));

                                if(count($comment_entries) > 0){

                                    foreach($comment_entries as $comment){

                                        if($comment->comment_approved)

                                            $count++;

                                    }

                                }           $active = '';
                              if($i == 1)
                                $active = 'active'; 
                                                $output .= '<li class="blog-article '.$size_span_class.' '.$active.'">';

                                                $output .= ' <div class="row-fluid"><div class="span12"><div class="media">';


                                                if($gradient_bool == 'yes' && $post_format != 'audio'){    
                                                            $output .= '<div class="he-wrap tpl2">';
                                                }
                                                if($post_format == 'audio'){
                                                    
                                                    $output .= do_shortcode('[soundcloud]'.get_the_excerpt().'[/soundcloud]');




                                                }elseif($post_format == 'gallery'){

                                                      



                                                    $slider = new themeple_slideshow(get_the_ID(), 'flexslider');

                   

                                                    if($slider && $slider->slide_number > 0){

                                                        $slider->img_size = 'port4';
                                                        $sliderHtml = $slider->render_slideshow();
                                                        

                                                        $output .= $sliderHtml;

                                                    }





                                                }elseif($post_format == 'video'){



                                                   

                                                    $video = ""; if(themeple_backend_is_file( get_the_excerpt(), 'html5video'))

                                                    {

                                                        $video = themeple_html5_video_embed(get_the_excerpt());

                                                    }

                                                    else if(strpos(get_the_excerpt(),'<iframe') !== false)

                                                    {

                                                        $video = get_the_excerpt();

                                                    }

                                                    else

                                                    {

                                                        global $wp_embed;

                                                        $video = $wp_embed->run_shortcode("[embed]".trim(get_the_excerpt())."[/embed]");

                                                    }

                                                    

                                                    if(strpos($video, '<a') === 0)

                                                    {

                                                        $video = '<iframe src="'.get_the_excerpt().'"></iframe>';

                                                    } 

                                                    $output .= $video;

                                                    





                                                    } elseif(get_post_thumbnail_id()){

                                                

                                                        
                                                                $output .= '<img src="'.themeple_image_by_id(get_post_thumbnail_id(), 'port4', 'url').'" alt="">';
                                                                
                                                        
                                                    }
                                                    if($gradient_bool == 'yes' && $post_format != 'audio'){ 
                                                                    $output .= '<div class="overlay he-view">';
                                                                    $output .= '   <div class="bg a0" data-animate="fadeIn">';
                                                                    $output .= '        <div class="center-bar v1">';
                                                                    $output .= '            <a href="'.get_permalink().'" class="link a0" data-animate="zoomIn"><i class="moon-'.$icon_class.'"></i></a></a>';
                                                               
                                                               
                                                                    $output .= '        </div>';
                                                                    $output .= '    </div>';
                                                                    $output .= '</div>';
                                                        $output .= '</div>';   
                                                    }
                                          
                               
                                
                                $output .= '</div></div></div>';

                                $output .= '<dl class="dl-horizontal">';
                                $output .= '    <dd class="'.$ex_class.'">';
                                $output .= '        <h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
                                $output .= '        <ul class="info">';
                                                  
                                $output .= '            <li>'.$count.' '.__('Comments', 'themeple').'</li>';
                                $output .= '            <li>'.get_the_date().'</li>';
                                    
                                $output .= '        </ul>';
                                $output .= '    </dd>';
    
                                $output .= '</dl>';                                 
                                
                                $output .= '<div class="blog_content">'.themeple_text_limit(get_the_excerpt(), 28).'</div>';
                                                                       
                                $output .= '</li>';
                                           
                                            
                                        };
                                    };
                                    wp_reset_postdata();
                
                    $output .= '</ul></div>';       
            $output .= '</div>';

        $output .= '</div>';


        return $output;

    }


function latest_blog_carousel($element){
        extract($element['saved'][0]);
        
        $posts_per_page = 9999;
	 
		

        $output = '<div class="span'.$dynamic_size.' latest_blog_carousel">';
	  
        
	  
            $query_post = array('posts_per_page'=> $posts_per_page, 'post_type'=> 'post' );                          
       
    	
        	$size_span_class = '';
            
            $output .= '<div class="row-fluid">';
                $output .= '<div class="span12">';
                    $output .= '<ul class="carousel_blog_single">';
                        
                        $loop = new WP_Query($query_post);
                                    
                                     if($loop->have_posts()){
                                        while($loop->have_posts()){
                                            $loop->the_post();

                                            $post_id = get_the_ID();      
                                                $post_format = get_post_format($post_id);

                                                if(strlen($post_format) == 0)
                                                    $post_format = 'standart';

                                                if($post_format == 'standart'){
            $icon_class="pencil";
            }elseif($post_format == 'audio'){
                $icon_class="music";
            }elseif($post_format == 'soundcloud'){
                $icon_class="music";
            }elseif($post_format == 'video'){
                $icon_class="play-circle";
            }elseif($post_format == 'quote'){
                $icon_class="quote-left";
            }elseif($post_format == 'gallery'){
                $icon_class="image";
            }     

            $count = 0;

                                $comment_entries = get_comments(array( 'type'=> 'comment', 'post_id' => get_the_ID() ));

                                if(count($comment_entries) > 0){

                                    foreach($comment_entries as $comment){

                                        if($comment->comment_approved)

                                            $count++;

                                    }

                                }

                                                $output .= '<li class="blog-article span'.$dynamic_size.'">';
                                                    
                                                $output .= '    <div class="row-fluid">';

                                                $output .= '        <div class="span12">';


                                                $output .= '            <div class="media">';


                                            
                                                if($post_format == 'audio'){
                                                    
                                                    $output .= do_shortcode('[soundcloud]'.get_the_excerpt().'[/soundcloud]');




                                                }elseif($post_format == 'gallery'){

                                                      



                                                    $slider = new themeple_slideshow(get_the_ID(), 'flexslider');

                   

                                                    if($slider && $slider->slide_number > 0){

                                                        $sliderHtml = $slider->render_slideshow();

                                                        $output .= $sliderHtml;

                                                    }





                                                }elseif($post_format == 'video'){



                                                   

                                                    $video = ""; if(themeple_backend_is_file( get_the_excerpt(), 'html5video'))

                                                    {

                                                        $video = themeple_html5_video_embed(get_the_excerpt());

                                                    }

                                                    else if(strpos(get_the_excerpt(),'<iframe') !== false)

                                                    {

                                                        $video = get_the_excerpt();

                                                    }

                                                    else

                                                    {

                                                        global $wp_embed;

                                                        $video = $wp_embed->run_shortcode("[embed]".trim(get_the_excerpt())."[/embed]");

                                                    }

                                                    

                                                    if(strpos($video, '<a') === 0)

                                                    {

                                                        $video = '<iframe src="'.get_the_excerpt().'"></iframe>';

                                                    } 

                                                    $output .= $video;

                                                    





                                                    } elseif(get_post_thumbnail_id()){

                                                


                                                   
                                                    $output .= '<img src="'.themeple_image_by_id(get_post_thumbnail_id(), 'featured_blog', 'url').'" alt="">';
                                                	   
                                                    }
							   
                                            $output .= '</div>';
                                        $output .= '</div>';
                               
                                
                                $output .= '</div>';

                                $output .= '<dl class="dl-horizontal">';
                                $output .= '    <dt><i class="moon-'.$icon_class.'"></i></dt>';
                                $output .= '    <dd>';
                                $output .= '        <h5><a href="'.get_permalink().'">'.get_the_title().'</a></h5>'; 
                                $output .= '        <div class="blog-content">';        
                                $output .=              themeple_text_limit(get_the_excerpt(), 20);

                                                                   
                                $output .= '        </div>';
                                $output .= '    </dd>';
    
                                $output .= '</dl>';                                 
                                            
                                $output .= '<div class="info">';
                                $output .= '    <ul>';
                                $output .= '        <li class="calendar">'.get_the_time('j M, Y').'</li>';
                                $output .= '        <li class="user">'.get_the_author().'</li>';
                                $output .= '        <li class="comment">'.$count.' Comments</li>';           
                                $output .= '    </ul>';                     
                                $output .= '</div>';
                                        


                                $output .= '</li>';
                                           
                                            
                                        };
                                    };
                                    wp_reset_postdata();
                
                    $output .= '</div>';       
                
                
                


                
            $output .= '</div>';
        
        

        $output .= '</div>';


        return $output;
    }





    function recent_news($element){
        extract($element['saved'][0]);
        
        

        $output = '<div class="span'.$dynamic_size.' recent_news">';
        if(!empty($dynamic_title)){
            $output .= '<div class="header"><h3>'.$dynamic_title.'</h3>';
            $output .= '</div>';
        }
        if($dynamic_from_where == 'all_cat'){
            $query_post = array('posts_per_page'=> $posts_per_page, 'post_type'=> 'post' );                          
        }else{
           $query_post = array('posts_per_page'=> $posts_per_page, 'post_type'=> 'post', 'cat' => $dynamic_cat ); 
        }
        

            $output .= '<div class="row-fluid">';
                $output .= '<div class="span12">';
                    	   
                        
                        $loop = new WP_Query($query_post);
                                    
                                     if($loop->have_posts()){
                                        while($loop->have_posts()){
                                            $loop->the_post();     
                                            $post_id = get_the_ID();      
                                                $post_format = get_post_format($post_id);

                                                if(strlen($post_format) == 0)
                                                    $post_format = 'standart';
						      if($post_format == 'standart'){
								$icon_class="pencil";
		    					}elseif($post_format == 'audio'){
		    						$icon_class="music";
		    					}elseif($post_format == 'soundcloud'){
		    						$icon_class="music";
		    					}elseif($post_format == 'video'){
		    						$icon_class="play-circle";
		    					}elseif($post_format == 'quote'){
		    						$icon_class="quote-left";
		    					}elseif($post_format == 'gallery'){
		    						$icon_class="images";
		    					}

                                $count = 0;

                                $comment_entries = get_comments(array( 'type'=> 'comment', 'post_id' => get_the_ID() ));

                                if(count($comment_entries) > 0){

                                    foreach($comment_entries as $comment){

                                        if($comment->comment_approved)

                                            $count++;

                                    }

                                }
                                           

                                               $output .= '<dl class="news-article blog-article style_'.$style.' dl-horizontal">';
                                                    $output .= '<dt>';

                                                    if($style == 'image')
                                                        $output .= '    <img src="'.themeple_image_by_id(get_post_thumbnail_id(), 'great_gallery', 'url').'" alt="">';
                                                    if($style == 'icon')
                                                        $output .= '<i class="moon-'.$icon_class.'"></i>';
                                                    
                                                    $output .= '</dt>';   
                                                    $output .= '<dd>';
                                                        
                                                        $output .= '<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
                                                        $output .= '        <ul class="info">';
                                                  
                                                        $output .= '            <li>'.$count.' '.__('Comments', 'themeple').'</li>';
                                                        $output .= '            <li>'.get_the_date().'</li>';
                                                            
                                                        $output .= '        </ul>';
                                                        $output .= '<div class="blog-content">';        
                                                        $output .=              themeple_text_limit(get_the_excerpt(), 24);

                                                                   
                                                        $output .= '        </div>'; 
                                                        
                                               $output .= '</dl>'; 

                                            
                                           
                                            
                                        };
                                    };
                                    wp_reset_postdata();
                    $output .= '</div>';       
                
                
                


                
            $output .= '</div>';
        
        

        $output .= '</div>';


        return $output;
    }


    function blog_categories($element){
        extract($element['saved'][0]);
        
        

        $output = '<div class="span'.$dynamic_size.' blog_categories">';
        $output .= '<div class="row-fluid"><div class="span12"><div class="header"><h5>'.$dynamic_title.'</h5>';
        $output .= '<ul>';
        $categories = explode(",", $categories);
            if(count($categories) > 0){
                $i = 0;
                $cl = '';
                foreach($categories as $cat):
                    $i++;
                    if($i == 1)
                        $cl = 'active';
                    $ca = get_category($cat);
                    $output .= '<li class="'.$cl.'"><a href="" data-id="'.$ca->name.'">'.$ca->name.'</a></li>';
                    $cl = '';
                endforeach;
            }

        $output .= '</ul>';
        $output .= ' </div></div></div>';  
        if(!isset($posts_per_page))
		$posts_per_page = 9999;
        $query_post = array('posts_per_page'=> $posts_per_page, 'post_type'=> 'post' ); 
        
        

            $output .= '<div class="row-fluid">';
                $output .= '<div class="span12">';
                           
                        
                        $loop = new WP_Query($query_post);
                                    
                                     if($loop->have_posts()){
                                        while($loop->have_posts()){
                                            $loop->the_post();     
                                            $post_id = get_the_ID();      
                                                $post_format = get_post_format($post_id);

                                                if(strlen($post_format) == 0)
                                                    $post_format = 'standart';
                              if($post_format == 'standart'){
                                $icon_class="pencil";
                                }elseif($post_format == 'audio'){
                                    $icon_class="music";
                                }elseif($post_format == 'soundcloud'){
                                    $icon_class="music";
                                }elseif($post_format == 'video'){
                                    $icon_class="play-circle";
                                }elseif($post_format == 'quote'){
                                    $icon_class="quote-left";
                                }elseif($post_format == 'gallery'){
                                    $icon_class="picture";
                                }

                                $count = 0;

                                $comment_entries = get_comments(array( 'type'=> 'comment', 'post_id' => get_the_ID() ));

                                if(count($comment_entries) > 0){

                                    foreach($comment_entries as $comment){

                                        if($comment->comment_approved)

                                            $count++;

                                    }

                                }               
                                                $data_cat = '';
                                                $cat = get_the_category();
                                                foreach($cat as $c)
                                                    $data_cat .= $c->name.' ';
                                                $data_cat = substr($data_cat, 0, -1);
                                                $output .= '<div class="blog_cat_"  data-cat="'.$data_cat.'">';
                                                $output .=' <img src="'.themeple_image_by_id(get_post_thumbnail_id(), 'blog_categories', 'url').'" alt="">';  
                                                $output .= '<dl class="dl-horizontal blog-article second-style">';
                                                    
                                                    $output .= '<dt>';
                                                        $output .= '<div class="date"><span class="month">'.get_the_time('d').' '.get_the_time('M').'</span><span class="year">'.get_the_time('Y').'</span></div>';
                                                        $output .= '<div class="comments"><i class="icon-comments"></i><span>'.$count.'</span></div>';
                                                    $output .= '</dt>';
                                                    $output .= '<dd>';
                                                    $output .= '<h4><a href="'.get_permalink().'">'.get_the_title().'</a></h4>';
                                                    $output .= themeple_text_limit(get_the_content(), 20);
                                                    $output .= '</dd>';

                                        
                                                $output .= '</dl>';
                                                $output .= '</div>';
                                
                                           
                                            
                                        };
                                    };
                                    wp_reset_postdata();
                    $output .= '</div>';       
                
                
                


                
            $output .= '</div>';
        
        

        $output .= '</div>';


        return $output;
    }







    /**
     * GenerateDynamicTemplate::post_page_content()
     * 
     * @return
     */
    function post_page_content($element)
	{
        extract($element['saved'][0]);
        $content = '';
		$output = '<div class="span'.$dynamic_size.' post_page_cont">';
        if(!empty($dynamic_title)){
            $output .= '<div class="header"><h6>'.$dynamic_title.'</h6></div>';
        }    
		switch($dynamic_which_post_page)
		{
			case'post': $query_id = $dynamic_post_id; $type ='post'; break;
			case'page': $query_id = $dynamic_page_id; $type ='page'; break;
			case'self': $query_id = $this->post_id;	  $type = get_post_type( $this->post_id ); break;
		}

		$query_post = array( 'p' => $query_id, 'posts_per_page'=>1, 'post_type'=> $type );
		$additional_loop = new WP_Query($query_post);
		
		if($additional_loop->have_posts())
		{
			
			while ($additional_loop->have_posts())
			{ 
				$additional_loop->the_post();
				
				if($dynamic_which_post_page != 'self' && $query_id != $this->post_id)
				{
					global $more;
					$more = 0;
				}
						
				
				if(!$additional_loop->post->post_excerpt || $query_id == $this->post_id)
				{
					$content = get_the_content();
					$content = apply_filters('the_content', $content);
					$content = str_replace(']]>', ']]&gt;', $content);
				}
				
				
				
				
			     
				    $output .= $content;
				 
                
                
			}
			
		}
		
		wp_reset_postdata();
        $output .= '</div>';
	
		return $output;
	}


    function services($element)
    {
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.'">';
        if($dynamic_shadow == 'yes')
        $output .= '<div class="divider_shadow dynamic_el"><h5 class="block-title">'.$dynamic_title.'</h5><span class="block-desc">'.$dynamic_desc.'</span><div class="arrow-holder left"><span></span></div><div class="arrow-holder right"><span></span></div></div>';
        $cat = -1;
        if($dynamic_services_categories == 'one')
            $cat = $dynamic_services_category;
        $query_post = array( 'cat' => $cat, 'posts_per_page'=>9999, 'post_type'=> 'services' );
        $additional_loop = new WP_Query($query_post);
        $output .= '<div class="touchcarousel">';
        if($additional_loop->have_posts())
        {
            
            while ($additional_loop->have_posts())
            { 
                $additional_loop->the_post();
                
                
                $content = get_the_content();
                $content = apply_filters('the_content', $content);
                $content = str_replace(']]>', ']]&gt;', $content);
                $image_pos = themeple_post_meta(get_the_ID(), 'service_image');
                $lightboxes = themeple_post_meta(get_the_ID(), 'slideshow');
                
                $featured = themeple_image_by_id(get_post_thumbnail_id(), array('width' => 800, 'height' => 800), 'url');
                
                 $output .= '<section class=" one-service touchcarousel-item">';
                 
                 $output .= '<div class="row-fluid">';
                    if($image_pos == 'left'):

                        $output .= '<div class="span6"><a class="serv_img" href="'.$featured.'"><img  title="img" src="'.$featured.'" alt=""></a></div>';

                    endif;
                    $output .= '<div class="span6">';
                        $output .= '<h1>'.get_the_title().'</h1>';
                        $output .= '<p>'.$content.'</p>';
                        $output .= '<div class="row-fluid">';
                            foreach($lightboxes as $box):
                                
                                $image_string = get_the_post_thumbnail($box['slideshow_image'],'services-thumb');
                                $link = themeple_image_by_id($box['slideshow_image'], array('width'=>1024,'height'=>1024), 'url');
                                if(!empty($box['slideshow_video']))
                                    $link = $box['slideshow_video'];
                                $type = 'gallery';

                                if(!empty($box['slideshow_video']))
                                    $type = 'media'; 
                                
                                $output .= '    <div class="thumbnail_service">';
                                $output .= '        <a class="lightbox-'.$type.'" href="'.$link.'">';
                                $output .= '            <div class="visual lightbox">';
                                $output .= $image_string;
                                $output .= '            </div>';
                                $output .= '        </a>';
                                $output .= '    </div>';
                            endforeach;
                        
                        $output .= '</div>';
                    $output .= '</div>';
                    if($image_pos == 'right'):

                        $output .= '<div class="span6"><a class="serv_img" href="'.$featured.'"><img title="img" src="'.$featured.'" alt=""></a></div>';

                    endif;
                $output .= '</div>';
                $output .= '</section>';
                
                
            }
            
        }
        $output .= '</div>';
        $output .= '</div>';
        wp_reset_postdata();

    
        return $output;
    }

    function services_new($element){

        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.' services_medium_new">';
        $icon_class = (($icon_bool == 'yes')?'with_icon':'no_icon');
        $data = array();
        $query = array();
        $data['link'] = '';
        $data['description'] = '';
        if($dynamic_content_type == 'page'){
            $query = array( 'p' => $dynamic_page, 'posts_per_page'=>1, 'post_type'=> 'page' );
        }
        if($dynamic_content_type == 'post'){
            $query = array( 'p' => $dynamic_post, 'posts_per_page'=>1, 'post_type'=> 'post' );
        }
        if($dynamic_content_type == 'content'){
            $data['description'] = $dynamic_content_content;
            $data['link'] = $dynamic_content_link;
        }else{
            $loop = new WP_Query($query);
            if($loop->have_posts()){
                while($loop->have_posts()){
                    $loop->the_post();
                    
                    $data['link'] = get_permalink();
                    $data['description'] = get_the_excerpt();
                    
                }
            }
            wp_reset_postdata();
        }

        
            
            if($icon_bool == 'yes' && $icon_bool_pred == 'yes' && !empty($icon)):
               
                $output .= '<div class="icon_wrapper"><div class="overlay"></div><i class="'.$icon.' icon"></i></div>';
                

            endif;

            if($icon_bool == 'yes'  && $icon_bool_pred == 'no' && !empty($icon_up)):
               
                $output .= '<span class="icon_up" style="background:url(\''.$icon_up.'\') center no-repeat;"></span>';
                

            endif;

        $output .= '<h2><a href="'.$data['link'].'">'.$title.'</a></h2>';
        $output .= '<p>'.do_shortcode($data['description']).'</p>';
        $output .= '</div>';
        return $output; 


    }


    function headers($element)
    {
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.'">';
        if(!isset($dynamic_title))
            $dynamic_title = '';
        if(!isset($dynamic_desc))
            $dynamic_desc = '';
        if($dynamic_shadow == 'yes')
        $output .= '<div class="divider_shadow dynamic_el"><h5 class="block-title">'.$dynamic_title.'</h5><span class="block-desc">'.$dynamic_desc.'</span></div>';
        $post = isset($dynamic_header_post)?$dynamic_header_post:0;
        
        if($post != 0){   
        $query_post = array( 'p' => $post, 'posts_per_page'=>1, 'post_type'=> 'header' );
        $additional_loop = new WP_Query($query_post);
        $output .= '<div class="dynamic_element">';
        if($additional_loop->have_posts())
        {
            
            while ($additional_loop->have_posts())
            { 
                $additional_loop->the_post();
                
                
                $content = get_the_content();
                
                $media_position = themeple_post_meta(get_the_ID(), 'media_position');
                $video = themeple_post_meta(get_the_ID(), 'video_link');
                $button_title = themeple_post_meta(get_the_ID(), 'button_title');
                $button_link = themeple_post_meta(get_the_ID(), 'button_link');
                $button_align = themeple_post_meta(get_the_ID(), 'button_align');
                $list = themeple_post_meta(get_the_ID(), 'list_elements');
                $visual = themeple_post_meta(get_the_ID(), 'media_box');
                
                if($visual == 'yes') $visual = 'visual'; else $visual = '';
                $featured = themeple_image_by_id(get_post_thumbnail_id(), 'header-thumb', 'url');
                
                 $output .= '<section class=" top_header_element">';
                 
                 $output .= '<div class="row-fluid">';
                    if($media_position == 'left'):

                        $output .= '<div class="span6"><div class="'.$visual.'"><div class="visual_image">';
                        if(empty($video) && !empty($featured)){
                            $output .= '<img src="'.$featured.'" alt="" />';
                        }elseif(!empty($video) && empty($featured)){
                            if(themeple_backend_is_file($video, 'html5video'))
                            {
                                $video = themeple_html5_video_embed($slide['slideshow_video']);
                            }
                            else if(strpos($video,'<iframe') !== false)
                            {
                                $video = $video;
                            }
                            else
                            {
                                global $wp_embed;
                                $video = $wp_embed->run_shortcode("[embed]".trim($video)."[/embed]");
                            }
                            
                            if(strpos($video, '<a') === 0)
                            {
                                $video = '<iframe src="'.$video.'"></iframe>';
                            }

                            $output .= $video;
                        }
                        $output .= '</div></div></div>';

                    endif;
                    $output .= '<div class="span6">';
                        $output .= '<h1>'.get_the_title().'</h1>';
                        $output .= '<p>'.$content.'</p>';
                        $output .= '<div class="row-fluid">';
                        if(count($list) > 0)
                            $output .= '<ul>';
                            foreach($list as $li):
                                
                                $output .= '<li class="span6"><a href="'.$li['list_link'].'">'.$li['list_title'].'</a></li>';
                                
                            endforeach;
                        if(count($list) > 0)    
                            $output .= '</ul>';
                        
                        $output .= '</div>';
                        if(!empty($button_title)){
                            $output .= '<div class="row-fluid"><a class="button_top_header '.$button_align.'" href="'.$button_link.'">'.$button_title.'</a></div>';
                        }

                    $output .= '</div>';
                    if($media_position == 'right'):

                        $output .= '<div class="span6"><div class="'.$visual.'"><div class="visual_image">';
                        if(empty($video) && !empty($featured)){
                            $output .= '<img src="'.$featured.'" alt="" />';
                        }elseif(!empty($video) && empty($featured)){
                            if(themeple_backend_is_file($video, 'html5video'))
                            {
                                $video = themeple_html5_video_embed($slide['slideshow_video']);
                            }
                            else if(strpos($video,'<iframe') !== false)
                            {
                                $video = $video;
                            }
                            else
                            {
                                global $wp_embed;
                                $video = $wp_embed->run_shortcode("[embed]".trim($video)."[/embed]");
                            }
                            
                            if(strpos($video, '<a') === 0)
                            {
                                $video = '<iframe src="'.$video.'"></iframe>';
                            }

                            $output .= $video;
                        }
                        $output .= '</div></div></div>';

                    endif;
                $output .= '</div>';
                $output .= '</section>';
                
                
            }
            
        }
        $output .= '</div>';
        $output .= '</div>';
            wp_reset_postdata();
        }
    
        return $output;
    }

    function staff($element)
    {
        extract($element['saved'][0]);
        $output = '';
        if(isset($staff)){
        $output .= '<div class="span'.$dynamic_size.'">';
       
        $query_post = array( 'p' => $staff, 'posts_per_page'=>1, 'post_type'=> 'staff' );
        $additional_loop = new WP_Query($query_post);
        if($additional_loop->have_posts())
        {
            
            while ($additional_loop->have_posts())
            { 
                $additional_loop->the_post();
                
                
                $content = get_the_content();
                 
                 
                $featured = themeple_image_by_id(get_post_thumbnail_id(), array('width' => 1000, 'height' => 1000), 'url');
                $staff_position = themeple_post_meta(get_the_ID(), 'staff_position_');
                 $output .= '<div class="one-staff">';
                 
                            $output .= '<img src="'.$featured.'" alt="">';
                            $cl = '';
				if($with_desc == 'no')
					$cl = 'paa';
                            $output .= '<div class="content '.$cl.'"><h5>'.get_the_title().'</h5><span class="div"></span>';
                            $output .='<span class="position">'.$staff_position.'</span>';
               
				if($with_desc == 'yes'){
                        if($dynamic_size >= 4)
                            $lim = 25;
                        else
                            $lim = 13;
                            	$output .= '<p>'.themeple_text_limit(get_the_excerpt(), $lim).'</p>';
				
                }
                              $output .= '<div class="social_widget">'; 
                                $output .= '<ul class="">';
                                if(themeple_post_meta(get_the_ID(), 'facebook_link') != '')
                                    $output .= '<li class="facebook"><a href="'.themeple_post_meta(get_the_ID(), 'facebook_link').'" title="Facebook"><i class="moon-facebook"></i></a></li>';
                                if(themeple_post_meta(get_the_ID(), 'twitter_link') != '')
                                    $output .= '<li class="twitter"><a href="'.themeple_post_meta(get_the_ID(), 'twitter_link').'" title="Facebook"><i class="moon-twitter"></i></a></li>';
                                if(themeple_post_meta(get_the_ID(), 'google_link') != '')
                                    $output .= '<li class="google_plus"><a href="'.themeple_post_meta(get_the_ID(), 'google_link').'" title="Facebook"><i class="moon-google_plus"></i></a></li>';
                                if(themeple_post_meta(get_the_ID(), 'pinterest_link') != '')
                                    $output .= '<li class="pinterest"><a href="'.themeple_post_meta(get_the_ID(), 'pinterest_link').'" title="Facebook"><i class="moon-pinterest"></i></a></li>';
                                if(themeple_post_meta(get_the_ID(), 'linkedin_link') != '')
                                    $output .= '<li class="linkedin"><a href="'.themeple_post_meta(get_the_ID(), 'linkedin_link').'" title="Facebook"><i class="moon-linkedin"></i></a></li>';
                                if(themeple_post_meta(get_the_ID(), 'mail_link') != '')
                                    $output .= '<li class="main"><a href="'.themeple_post_meta(get_the_ID(), 'mail_link').'" title="Facebook"><i class="moon-mail"></i></a></li>';
                                

                                $output .= '</ul>';
                            $output .= '</div>';
                        $output .= '</div>';
                 $output .= '</div>';
                
            }
            
        }
        
        $output .= '</div>';
        wp_reset_postdata();
        }
    
        return $output;
    }

    function head_text($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.'">';
        $output .= '';
        if(!isset($dynamic_head_texttitle))
            $dynamic_head_texttitle = '';
        if(!isset($dynamic_head_text_description))
            $dynamic_head_text_description = '';
        $output .= '<div class="row-fluid head_text">';
            $output .= '<div class="span12"><h1>'.$dynamic_head_text_title.'</h1><h4>'.$dynamic_head_text_description.'</h4></div>';

        $output .= '</div>';
        $output .= '</div>';
        return $output;
    }

    function divider($element){
        extract($element['saved'][0]);
        if(!isset($style))
            $style = 'solid_border';
        $output = '<div class="divider__ '.$style.'"></div>';
	 return $output;
    }


    function recent_portfolio($element){
        ob_start();
        extract($element['saved'][0]);
        global $themeple_config;
        $themeple_config['used_for_element'] = true;
        $classs = '';
        if(themeple_get_option('dynamic_greyscale') == 'yes')
                $classs=  'image-desaturate';
        
        $output = '<div class="span'.$dynamic_size.' recent_portfolio '.$classs.'">';
	    
        if(!isset($dynamic_title))
            $dynamic_title = '';
        if(!isset($dynamic_desc))
            $dynamic_desc = '';
        if(isset($dynamic_num_rows))
            $rows = $dynamic_num_rows;
        
	    if(!isset($rows))
		  $rows = 1;
        if(!empty($dynamic_title) || $rows == 1){
            $output .= '<div class="header">';
            if($dynamic_title != '')
                $output .= '    <h3>'.$dynamic_title.'</h3>';
            
            if($rows == 1 && $desc_bool == 'no') 
                $output .= '<div class="pagination"><a href="#" class="prev"></a><a href="#" class="next"></a></div>';
            $output .= '</div>';
        }
          
        $columns = $dynamic_block_size;   
        $grid = 'three-cols';
        switch($columns){
            case '3':
                $grid = 'three-cols';
                break;
            case '2':
                $grid = 'two-cols';
                break;
            case '4':
                $grid = 'four-cols';
                break;
            case '1':
                $grid = 'one-cols';
                break;
        }
        $posts_per_page = 9999;
        if($rows == 1){
            $coe = 9999;
        }else{
            $coe = $columns*2;
        }
            
        if($dynamic_from_where == 'all_cat'){
            $query_post = array('posts_per_page'=> $coe, 'post_type'=> 'portfolio' );
        }else{
	       $category = get_term($dynamic_cat, "portfolio_entries");
	       $query_post = array('posts_per_page'=> $coe, 'post_type'=> 'portfolio',  'taxonomy' => 'portfolio_entries', 'portfolio_entries' => $category->slug );
        }
        if(isset($desc_bool) && $desc_bool == 'yes'):
               $size_span_class = 'little_small';
                        $output .= '<div class="row-fluid desc">';
                            $output .= '<div class="span3">';
                               
                                $output .= '<p>'.$desc_text.'</p>';
                                $output .= '<div class="pagination"><a href="#" class="prev"></a><a href="#" class="next"></a></div>';
                            $output .= '</div>';
                            $output .= '<div class="span9">';

        endif; 
        $output .= '<section id="portfolio-preview-items" class="row '.$grid.' rows_'.$rows.' animate_onoffset">';

        if($rows == 1){ $output .= '<div class="carousel carousel_portfolio">'; }
        
        $themeple_config['current_portfolio']['portfolio_columns'] = $columns;
        $themeple_config['current_sidebar'] = 'fullsize';
        $themeple_config['dynamic_portfolio']['portfolio_style'] = $portfolio_style;
        $themeple_config['dynamic_portfolio']['show_desc_bool'] = false;
        if(isset($show_text_bool))
            $themeple_config['dynamic_portfolio']['show_desc_bool'] = $show_text_bool;
        $themeple_config['new_query'] = $query_post;

        if($show_type == 'normal_mode')
            get_template_part('template_inc/loop', 'portfolio-grid');
        else if($show_type == 'list')
            get_template_part('template_inc/loop', 'portfolio-list');
        else if($show_type == 'masonry')
            get_template_part('template_inc/loop', 'portfolio-masonry');
        
        $output .= ob_get_clean();
		if($rows == 1){ $output .= '</div>'; }	
        $output .= '</section>';
        if(isset($desc_bool) && $desc_bool == 'yes'):    
                $output .= '</div></div>';
        endif;
        wp_reset_postdata();
        $output .= '</div>';
        return $output;
    }
 
    function fullwidth_portfolio($elemnt){

        $output = '<div class="fullwidth_portfolio">';
        $output .= '<div class="swiper-container swiper-parent swiper_slider" data-slidenr="5">';
            $output .= '<div class="swiper-wrapper">';
        $args = array( 'post_type' => 'portfolio', 'posts_per_page' => 10, 'orderby' =>'date','order' => 'DESC' );
        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post(); 
        $sort_classes = "";
        $item_categories = get_the_terms( $the_id, 'portfolio_entries' );
    
        if(is_object($item_categories) || is_array($item_categories))
        {
            foreach ($item_categories as $cat)
            {
                $sort_classes .= $cat->slug.' ';
            }
        }
                $output .= '<div class="swiper-slide portfolio-item v1  layout-full swiper-slide-visible" style="">';
                $output .= '    <div class="he-wrap tpl2">';
                $output .= '        <img src="'.themeple_image_by_id(get_post_thumbnail_id(), 'port2', 'url').'" alt="" />';
                $output .= '                       <div class="overlay he-view">';

                 $output .= '                           <div class="bg a0" data-animate="fadeIn">';
                 $output .= '                               <div class="center-bar v1">';
                 $output .= '                                 <a href="'.get_permalink().'" class="link a0" data-animate="zoomIn"></a></a>';
                 $output .= '                                    <h4>'.get_the_title().'</h4>';
                 $output .= '                                    <span class="cat">'.$sort_classes.'</span>';
                 $output .= '                               </div>';
                 $output .= '                           </div>';
                 $output .= '                       </div>';  

                $output .= '</div>';
                $output .= '</div>';
        endwhile;
            $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        return $output;
    }

    function fullwidth_blog($elemnt){

        $output = '<div class="fullwidth_blog">';
        $output .= '<div class="swiper-container swiper-parent swiper_slider" data-slidenr="5">';
            $output .= '<div class="swiper-wrapper">';
        $args = array(  'posts_per_page' => 10, 'orderby' =>'date','order' => 'DESC' );
        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post(); 
        $sort_classes = "";
        $item_categories = get_the_category();
    
        if(is_object($item_categories) || is_array($item_categories))
        {
            foreach ($item_categories as $cat)
            {
                $sort_classes .= $cat->slug.' ';
            }
        }
                $output .= '<div class="swiper-slide portfolio-item v1  layout-full swiper-slide-visible" style="">';
                $output .= '    <div class="he-wrap tpl2">';
                $output .= '        <img src="'.themeple_image_by_id(get_post_thumbnail_id(), 'port2', 'url').'" alt="" />';
                $output .= '                       <div class="overlay he-view">';

                 $output .= '                           <div class="bg a0" data-animate="fadeIn">';
                 $output .= '                               <div class="center-bar v1">';
                 $output .= '                                 <a href="'.get_permalink().'" class="link a0" data-animate="zoomIn"></a></a>';
                 $output .= '                                    <h4>'.get_the_title().'</h4>';
                 $output .= '                               </div>';
                 $output .= '                           </div>';
                 $output .= '                       </div>';  

                $output .= '</div>';
                $output .= '</div>';
        endwhile;
            $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        return $output;
    }

    function team_carousel($element){
        extract($element['saved'][0]);
        $classs = '';
        $output = '<div class="span'.$dynamic_size.' team_carousel '.$classs.'">';
        
        $output .= '<div class="row-fluid"><div class="span12"><div class="header"><h5>'.$dynamic_title.'</h5><div class="pagination"><a href="" class="prev" title="Previous"></a><a href="" class="next" title="Next"></a></div><span class="border_style_color"></span></div></div></div>'; 
          
        
            

          
        $query_post = array('posts_per_page'=> 9999, 'post_type'=> 'staff' );

                     
                     

                     if($desc_bool == 'yes'):
                        $output .= '<div class="row-fluid">';
                            $output .= '<div class="span3">';
                                $output .= '<h6 class="desc_title">'.$desc_title.'</h6>';
                                $output .= '<p>'.$desc_desc.'</p>';
                                if($button_bool == 'yes'):
                                    $output .= '<a class="button_left_desc" href="'.$button_link.'"><i class="'.$button_icon.'"></i> <span>'.$button_title.'</span></a>';
                                endif;
                            $output .= '</div>';
                            $output .= '<div class="span9">';

                     endif;
                    

                    $output .= '<div class="row">' ;
                    $output .= '<div class="carousel carousel_staff">';
                     
                     $loop = new WP_Query($query_post);
                     $i = 0;
                     if($loop->have_posts()){
                        while($loop->have_posts()){
                            $i++;
                            $loop->the_post();
                            $id =  get_the_ID();
                            
                            $the_id     = get_the_ID();
        
                            $sort_classes = "";
                            $item_categories = get_the_terms( $the_id, 'portfolio_entries' );
                        
                            if(is_object($item_categories) || is_array($item_categories))
                            {
                                foreach ($item_categories as $cat)
                                {
                                    $sort_classes .= $cat->slug.' ';
                                }
                            }       
                            
                                
                             $content = get_the_content();
                
                
                $featured = themeple_image_by_id(get_post_thumbnail_id(), array('width' => 220, 'height' => 195), 'url');
                $staff_position = themeple_post_meta(get_the_ID(), 'staff_position_');
                 $output .= '<div class="one-staff">';
                 
                            $output .= '<img src="'.$featured.'" alt="">';
                            $output .= '<h6 class="helvetica">'.get_the_title().'</h6>';
                            $output .='<p>'.$staff_position.'</p>';
                            $output .= '<p class="c">'.$content.'</p>';    
                              $output .= '<div class="social">'; 
                                $output .= '<ul class="social_icons">';
                                if(themeple_post_meta(get_the_ID(), 'facebook_link') != '')
                                    $output .= '<li class="facebook"><a href="'.themeple_post_meta(get_the_ID(), 'facebook_link').'" title="Facebook"><i class="icon-facebook"></i></a></li>';
                                if(themeple_post_meta(get_the_ID(), 'twitter_link') != '')
                                    $output .= '<li class="twitter"><a href="'.themeple_post_meta(get_the_ID(), 'twitter_link').'" title="Twitter"><i class="icon-twitter"></i></a></li>';
                                if(themeple_post_meta(get_the_ID(), 'google_link') != '')
                                    $output .= '<li class="google"><a href="'.themeple_post_meta(get_the_ID(), 'google_link').'" title="Google"><i class="icon-google_plus"></i></a></li>';
                                if(themeple_post_meta(get_the_ID(), 'pinterest_link') != '')
                                    $output .= '<li class="pinterest"><a href="'.themeple_post_meta(get_the_ID(), 'pinterest_link').'" title="Pinterest"><i class="icon-pinterest"></i></a></li>';
                                if(themeple_post_meta(get_the_ID(), 'linkedin_link') != '')
                                    $output .= '<li class="linkedin"><a href="'.themeple_post_meta(get_the_ID(), 'linkedin_link').'" title="Linkedin"><i class="icon-linkedin"></i></a></li>';
                                $output .= '</ul>';
                 
                 $output .= '</div></div>';


                            
                          
                        }
                    }
                    
                    
                    $output .= '</div></div>';

                    if($desc_bool == 'yes'):
                        $output .= '</div>';
                        $output .= '</div>';    

                     endif;
                    wp_reset_postdata();

                    
        
        

        
        $output .= '</div>';
        return $output;
    }



    function services_full($element){
        extract($element['saved'][0]);
       
        $output = '<div class="span'.$dynamic_size.' services_full">';
        
        $output .= '<div class="header"><h6>'.$dynamic_title.'</h6></div>';    
          
        
                    if($desc_bool == 'yes'):
                        $output .= '<div class="row-fluid">';
                            $output .= '<div class="span3">';
                                $output .= '<h2 class="desc_title">'.$desc_title.'</h2>';
                                $output .= '<p>'.$desc_desc.'</p>';
                                if($button_bool == 'yes'):
                                    $output .= '<a class="button_left_desc" href="'.$button_link.'"><i class="'.$button_icon.'"></i> <span>'.$button_title.'</span></a>';
                                endif;
                            $output .= '</div>';
                            $output .= '<div class="span9">';

                     endif;
                    

                    $output .= '<ul>';
                    if(count($services) > 0){
                        foreach($services as $s):

                            $output .= '<li class="services_medium">';
                                $icon_class = ((isset($icon_bool) && $icon_bool == 'yes')?'with_icon':'no_icon');
                                    $data = array();
                                    $query = array();
                                    $data['link'] = '';
                                    $data['description'] = '';
                                    if($s['dynamic_content_type'] == 'page'){
                                        $query = array( 'p' => $s['dynamic_page'], 'posts_per_page'=>1, 'post_type'=> 'page' );
                                    }
                                    if($s['dynamic_content_type'] == 'post'){
                                        $query = array( 'p' => $s['dynamic_post'], 'posts_per_page'=>1, 'post_type'=> 'post' );
                                    }
                                    if($s['dynamic_content_type'] == 'content'){
                                        $data['description'] = $s['dynamic_content_content'];
                                        $data['link'] = $s['dynamic_content_link'];
                                    }else{
                                        $loop = new WP_Query($query);
                                        if($loop->have_posts()){
                                            while($loop->have_posts()){
                                                $loop->the_post();
                                                
                                                $data['link'] = get_permalink();
                                                $data['description'] = get_the_excerpt();
                                                
                                            }
                                        }
                                        wp_reset_postdata();
                                    }

                                    
                                        if($s['icon_bool'] == 'yes' && !empty($s['icon'])):
                                            
                                            $output .= '<i class="'.$s['icon'].' icon"></i>';
                                            

                                        endif;
                                    $output .= '<h2><a href="'.$data['link'].'">'.$s['title'].'</a></h2>';
                                    $output .= '<p>'.$data['description'].'</p>';
                                    $output .= '<a class="link" href="'.$data['link'].'">'.$s['link_title'].'</a>';
                            $output .= '</li>';

                        endforeach;
                    }

                    $output .= '</ul>';
                     
                    if($desc_bool == 'yes'):
                        $output .= '</div>';
                        $output .= '</div>';

                    endif;

        
        $output .= '</div>';
        return $output;
    }


    function widget($element){
        ob_start();
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.'">';
        if(!empty($dynamic_title)){
            $output .= '<div class="header"><h6>'.$dynamic_title.'</h6></div>';
        }   
        $output .= '<aside>';
        dynamic_sidebar("Dynamic Template: Widget ".$dynamic_sidebar);
        

        $output .= ob_get_clean();
        $output .= '</aside>';
        $output .= '</div>';
        return $output;
    }
    
    function home_blog($element){
       ob_start();
       extract($element['saved'][0]);
       $output = '<div class="span'.$dynamic_size.'">';
       if(!empty($dynamic_title)){
            $output .= '<div class="header"><h6>'.$dynamic_title.'</h6></div>';
        }
       
         query_posts('posts_per_page = -1' );
       
         get_template_part( 'template_inc/loop', $style);
        wp_reset_postdata();
        $output .= ob_get_clean();
        $output .= '</div>';
        return $output;
    }

   function home_portfolio ($element){
        ob_start();
        extract($element['saved'][0]);
        global $portfolio_p;
        global $themeple_config; 
        $output = '<div class="span'.$dynamic_size.'">';
        $portfolio_p = $portfolio_selected;
       
       

        if(isset($portfolio_p) && $portfolio_p != ''){
        $used_template_p = themeple_get_option_array('portfolio', 'portfolio_page', $portfolio_p, true); 
       
           }



      

   
        
       if(isset($used_template_p)){
            $used_template = $used_template_p; }

        $cats_port = $used_template['portfolio_cats'];
       
        $args = array(
        'taxonomy'  => 'portfolio_entries',
        'hide_empty'=> 0,
        'posts_per_page' => 2*$dynamic_columns,
        'include'   =>  $cats_port
            );
        $themeple_config['current_sidebar'] = 'fullsize';
        $categories = get_categories($args);
        
        if(count($categories) > 0){
        $output .='<!-- Portfolio Filter --><nav id="portfolio-filter" class="span12">';
           $output .= '<ul class="">';
             $output .= '<li class="active all"><a href="#"  data-filter="*">'.__('View All', 'themeple').'</a><span></span></li>';
                
            foreach($categories as $cat):
                
                   $output .= '<li class="other"><a href="#" data-filter=".'.$cat->category_nicename.'">'.$cat->cat_name.'</a><span></span></li>';    
                
            endforeach;
            
         $output .='</ul>';
     $output .= '</nav>';
       } 
     
       $themeple_config['current_portfolio']['portfolio_columns']  = $dynamic_columns;
        $grid = 'three-cols';
       switch($dynamic_columns){
        case '3':
            $grid = 'three-cols';
            break;
        case '2':
            $grid = 'two-cols';
            break;
        case '4':
            $grid = 'four-cols';
            break;
        case '1':
            $grid = 'one-cols';
            break;
    }
      
    $spancontent = 12;
       $output .= '<div class="row-fluid">';
       $output .='<section id="portfolio-preview-items" class="'.$grid.' span'.$spancontent.' animate_onoffset">';
       wp_reset_postdata();
       query_posts( 'post_type=portfolio&posts_per_page=9999' );
       get_template_part( 'template_inc/loop', $style);
	
       wp_reset_postdata();
       $output .= ob_get_clean();
       $output .= '</section>';
       $output .= '</div>';
       
       $output .= '</div>';
       return $output;

    }
    function contact_form($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.' contact_form">';
        if(!isset($dynamic_msg) )
            $dynamic_msg = '';
        $attr = array(
            "success" => '<p>'.$dynamic_msg.'</p>',
            "submit"  => $dynamic_submit,
            "submit_class" => "btn-system",
            "form_class" => "standard-form",
            "action"  => get_permalink(),
            "myemail" => themeple_get_option('email'),
            "myblogname" => get_option('blogname'),
            "autoresponder" => themeple_get_option('autoresponder'),
            "autoresponder_subject" => themeple_get_option('autoresponder_subject'),
            "autoresponder_email" => themeple_get_option('email')
        );
        $custom_elements = themeple_get_option('contact_elements');
    
    
        $elements = array();
        if(is_array($custom_elements))
        {
            foreach($custom_elements as $new_element)
            {
                $elements[strtolower( $new_element['label'] ) ] = $new_element;
            }
        }
        $contact_form = new themeple_form($attr);
        $contact_form->create_elements($elements);
        if(!empty($dynamic_title)){
            $output .= '<div class="header"><h6>'.$dynamic_title.'</h6></div>';
        }
        $output .= '<div class="row-fluid">';
            
                $output .= '<div class="row-fluid">';
                    $output .= '<div class="span12">';
                    if(!empty($desc))
                        $output .= '<p class="desc">'.$desc.'</p>';
        $output .= $contact_form->display_form();
                    $output .= '</div>';
                $output .= '</div>';
            $output .= '</div>';
        $output .= '</div>';
        return $output;
    }

    function google_map($element){
        extract($element['saved'][0]);

        $output = '<div class="span'.$dynamic_size.'">';  
        if(!empty($dynamic_title)){
            $output .= '<div class="header"><h6>'.$dynamic_title.'</h6></div>';
        }
        $extra_class='';
        $position = 'relative';
        if($map_fullwidth == 'yes'){
            $extra_class='fullwidth_map';
            $position = 'static';
        }
        $output .= '<div class="row-fluid row-google-map " style="position:'.$position.'; height:'.$height.'px;"><iframe class="googlemap '.$extra_class.'" style="height:'.$height.'px;" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.$dynamic_src.'&amp;output=embed"></iframe><div class="desc">'.$desc.'</div>';
        if($map_fullwidth == 'no'){
            $output .= '<span class="map_shadow"></span> ';
        }
        $output .= '</div>';
        
        $output .= '</div>';
        return $output;
    }

    function plain_text($element){
        extract($element['saved'][0]);
        $btn_class = 'blue';
        if(!isset($alignment))
            $alignment = 'left';
	 if(!isset($color_desc_s))
		$color_desc_s = '#555';
        $output = '<div class="span'.$dynamic_size.' plain_text alignment_'.$alignment.'">';
        if(!isset($color_head))
            $color_head = '#222';
        if(!isset($color_desc))
            $color_desc = '#888';
        if(!empty($title))
            $output .= '<'.$heading_title.' class="big_title" style="color:'.$color_head.';">'.do_shortcode($title).'</'.$heading_title.'>';
        if(!empty($short_desc))
            $output .= '<h5 class="short_desc" style="color:'.$color_desc_s.';">'.$short_desc.'</h5>';
        
        $output .= '<p class="content"  style="color:'.$color_desc.';">'.do_shortcode($content).'</p>';

        if(!empty($button_title)){
            $output .= '<a href="'.$button_link.'" class="btn-system">'.$button_title.'</a>';
        }
        
        $output .= '</div>'; 
        return $output;
    }

    function toggle($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.'">';
        $nr = rand();
        if(isset($title) && !empty($title)){      
           $output .= '<div class="header"><h3>'.$title.'</h3>';
            
            $output .= '</div>'; 
        }     
        if(count($toggles) > 0){
            $output .= '<div class="accordion '.$style.'" id="accordion'.$nr.'">';
			$rand = rand(0, 100);
            $i = $rand; 
            foreach($toggles as $toggle):
				$i++;
                $output .= '<div class="accordion-group">';
                    $output .= '<div class="accordion-heading '.(($i == ($rand+1))?"in_head":"").'">';
                    $id = rand(0, 50000);
                        $output .= '<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion'.$nr.'" href="#toggle'.$id.'">';
                        
                        $output .= $toggle['title'];
                       
                        $output .= '</a>';
                    $output .= '</div>';
                    $output .= '<div id="toggle'.$id.'" class="accordion-body '.(($i == ($rand+1))?"in":"").' collapse ">';
                        $output .= '<div class="accordion-inner">';
                            $output .= do_shortcode($toggle['desc']);
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
            endforeach;
            $output .= '</div>';
        }
        
        $output .= '</div>';
        return $output;
    }


    function tabs($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.'">';
        $nr = rand();
        if(isset($title) && !empty($title)){      
           $output .= '<div class="header">';
                $output .= '<h3>'.$title.'</h3>';
            $output .= '</div>';
        }   
        if(!isset($position))
            $position = 'top';

        if(count($tabs) > 0){
            $output .= '<div class="tabbable tabs-'.$position.' '.$style.'">';
            $output .= '<ul class="nav nav-tabs">';
            $rand = rand(0, 100);
            $i = $rand;
            foreach($tabs as $tab):
                $i++;
                $output .= '<li class="'.(($i == ($rand + 1))?'active':'').'"><a href="#tab'.$i.'" data-toggle="tab" class="'.$tab['icon_bool'].'">';
                if($tab['icon_bool']=='yes')
                    $output .= '<i class="'.$tab['icon'].'"></i>';
                $output .= $tab['title'];
                $output .= '</a></li>';
            endforeach;
            $output .= '</ul>';
            $output .= '<div class="tab-content">';
            $u = $rand;
	     global $wp_embed;
	    
            foreach($tabs as $tab):
                $u++;
                $output .= '<div class="tab-pane '.(($u == ($rand + 1))?'active':'').'" id="tab'.$u.'">';
                $output .= do_shortcode($tab['desc']); 
                $output .= '</div>';
            endforeach;
            $output .= '</div>';
            $output .= '</div>';
        }
        
        $output .= '</div>';
        return $output;
    }


    function creative_tabs($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.'">';
        if(count($creative_tabs) > 0){
            $output .= '<div class="creative_tabs">';
            $output .= '<ul class="navigation">';
            $i = 0;
            foreach($creative_tabs as $tab):
                $i++;
                $output .= '<li class="'.(($i == 1)?'active':'').'" data-id="t'.$i.'">';
                    $output .= '<div class="circle">';
                        if($tab['icon_number'] == 'number')
                            $output .= '<span class="number">'.$tab['number'].'</span>';
                        if($tab['icon_number']=='icon')
                            $output .= '<i class="'.$tab['icon'].'"></i>';
                    $output .= '</div>';
                    $output .= '<span class="title">'.$tab['title'].'</span>';
                $output .= '</li>';
            endforeach;
            $output .= '</ul>';
            $output .= '<div class="content">';
            $u = 0;       
            foreach($creative_tabs as $tab):
                $u++;
                $output .= '<div class="pane '.(($u == 1)?'active':'').'" data-id="t'.$u.'">';
                $output .= do_shortcode($tab['desc']); 
                $output .= '</div>';
            endforeach;
            $output .= '</div>';
            $output .= '</div>';
        }
        
        $output .= '</div>';
        return $output;
    }

    function skills($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.' block_skill">';
        
        if(!empty($title)){
         $output .= '<div class="header"><h6>'.$title.'</h6></div>';      
        }
        $base = themeple_get_option('base_color');
	 if(isset($_COOKIE['themeple_skin'])){

		include(THEMEPLE_BASE.'/template_inc/admin/register_skins.php');

		if(is_array($predefined[$_COOKIE['themeple_skin']]) && count($predefined[$_COOKIE['themeple_skin']]) > 0 ){
			$base = $predefined[$_COOKIE['themeple_skin']]['base_color'];
		}
	 }
	 if(!isset($desc)) $desc = '';
        $output .= '<p>'.$desc.'</p>';
        if(count($skills) > 0){
            foreach($skills as $skill){
                    if(!isset($skill['color']))
                        $skill['color'] = 'base';
                    if($skill['color'] == 'base')
                        $skill['color'] = $base;
                    $output .= '<h6 class="skill_title">'.$skill['title'].'</h6><span class="big_percentage">'.$skill['percentage_skill'].'%</span>';
                    $output .= '<div class="skill animate_onoffset" data-percentage="'.$skill['percentage_skill'].'">';
 
                          
                          $output .= '<div class="prog" style="width:0%; background:'.$skill['color'].';"><span class="circle"></span></div>';
    
                    $output .= '</div>'; 
            }
        }
        $output .= '</div>';
        return $output;
    }
    function chart_skill($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.' chart_skill animate_onoffset">';
        $base = themeple_get_option('base_color');
	 if(isset($_COOKIE['themeple_skin'])){

		include(THEMEPLE_BASE.'/template_inc/admin/register_skins.php');

		if(is_array($predefined[$_COOKIE['themeple_skin']]) && count($predefined[$_COOKIE['themeple_skin']]) > 0 ){
			$base = $predefined[$_COOKIE['themeple_skin']]['base_color'];
		}
	 }
        $output .= '<div class="chart" data-percent="'.$percent.'%" data-color="'.themeple_get_option('base_color').'" data-color2="'.themeple_get_option('second_color').'">';
        $ex_cl = '';
        if($color == 'base'){
            $color = themeple_get_option('base_color');
            $ex_cl = 'base';
        }
        if($type == 'icon'){
            $output .= '<i class="'.$icon.' '.$ex_cl.'" style="font-size:'.$font_size.';color:'.$color.';"></i>';
        }else
        if($type == 'text'){
            $output .= '<span class="text" style="font-size:'.$font_size.';color:'.$color.';">'.do_shortcode($text).'</span>';
        }

        $output .= '</div>';
       
        $output .= '<span class="new_color">'.$base.'</span>';
        
        
        $output .= '</div>';
        return $output;
    }



    function boxed_content($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.'">';
        
        
            $output .= '<div class="header"><h3>'.$block_title.'</h3></div>'; 
            $output .= '<div class="boxed_content" style="background:'.$color.'; color:'.$font.'">'.do_shortcode($content).'</div>';
        $output .= '</div>';
        return $output;
    }

    function page_header($element){
        extract($element['saved'][0]);   
        $output = '<div class="span'.$dynamic_size.' dynamic_page_header">';
            if($small_title != '')
                $output .= '<h6 style="color:'.$color_small_title.';font-size:'.$size_small_title.'px">'.do_shortcode($small_title).'</h6>';  
            $output .= '<h1 style="color:'.$color_title.';font-size:'.$size_title.'px">'.do_shortcode($title).'</h1>';     
        $output .= '</div>';
        return $output;
    }
 

    function page_intro($element){
        extract($element['saved'][0]);
        if(!isset($img_bool)){
            $img_bool = 'no';
        }
        $output = '<div class="span'.$dynamic_size.' page_intro type-'.$position.' img-'.$img_bool.' ">';
            if($img_bool == 'yes'){
                $output .= '<span class="img" style="background-image:url('.$image.');"></span>';
            }
            $output .= '<h1>'.do_shortcode($title).'</h1>';
        $output .= '</div>';
        return $output;
    }

   
    function textbar($element){
        extract($element['saved'][0]);
        $fullwidth_class = '';
        $btn_class = "all_";
        $extra_class = '';
            if(isset($light_version) && $light_version == 'yes')
                $extra_class .= 'light_version';
            if(isset($style))
                $extra_class .= ' '.$style;
        $output = '<div class="span'.$dynamic_size.' textbar-container '.$extra_class.'">';
            
            $output .= '<div class="textbar">';
                $class = '';
                if($style == 'with_icon'){
                    $output .= '<div class="icon_wrapper"><i class="'.$icon.'"></i></div>';
                    $output .= '<div class="text_wrapper">';
                }
                $output .= '<h3>'.do_shortcode($title).'</h3>';
                $output .= '<h6>'.$small_title.'</h6>';
                if(isset($button1_bool) && $button1_bool == 'yes')
                    $output .= '<a href="'.$button1_link.'" class="btn-system b2">'.$button1_title.'</a>';
                if($style == 'with_icon'){
                    $output .= '</div>';
                }
            
        $output .= '</div>';
        if($style == 'with_shadow')
            $output .= '<span class="shadow"></span>';
        $output .= '</div>';
        return $output;
    }

    function sticky_box($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.' sticky_box">';
            $output .= '<div class="stickyy">';
                $output .= '<h2>'.$title.'</h2>';
                $output .= '<p>'.$desc.'</p>';
                $output .= '<span class="circle"><span></span></span>';
                $output .= '<span class="triangle_outside"></span>';
                $output .= '<span class="triangle_inside"></span>';
            $output .= '</div>';
        $output .= '</div>';
        return $output;
    }

    function services_group($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.' services_group">';
        if(isset($title) && !empty($title)){
	 $output .= '<div class="header"><dl class="dl-horizontal">';
            if(!isset($icon_title_bool)) $icon_title_bool = 'no';
            if($icon_title_bool == 'yes'):
                $output .= '<dt><i class="'.$icon_title.'"></i></dt>';
                $output .= '<dd style="margin-left:55px !important; margin-top:10px;"><h4>'.$title.'</h4></dd>';
            endif; 
            if($icon_title_bool == 'no'):
                $output .= '<dd style="margin-left:0px"><h4>'.$title.'</h4></dd>';
            endif;
        $output .= '</dl></div>';
	 }
        $output .= '<div class="row-fluid">';
            $output .= '<div class="span3 left_desc">';
                if(isset($left_title))
                    $output .= '<h6>'.$left_title.'</h6>';
                $output .= '<p>'.do_shortcode($left_desc).'</p>';
            $output .= '</div>';

            $output .= '<div class="span9">';
                foreach($elements as $l):
                    $output .= '<dl class="dl-horizontal">';
                        $output .= '<dt><i class="'.$l['icon'].'"></i></dt>';
                        $output .= '<dd>';
                            $output .= '<h5>'.$l['title'].'</h5>';
                            $output .= '<p>'.$l['desc'].'</p>';
                        $output .= '</dd>';
                    $output .= '</dl>';
                endforeach;
            $output .= '</div>';

        $output .= '</div>';
        
                 
        $output .= '</div>';
        return $output; 
    }


    function services_list($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.' services_list" style="">';
       
       
            $output .= '<dl class="dl-horizontal">';
                $output .= '<dt><i class="'.$icon.'"></i></dt>';
                $output .= '<dd>';
                    $output .= '<h3>'.$dynamic_title.'</h3>';
                    $output .= '<ul>';
                    foreach($list as $l):
                        $output .= '<li>'.$l['title'].'</li>';
                    endforeach;
                    $output .= '</ul>';
                $output .= '</dd>';
            $output .= '</dl>';
        
                 
        $output .= '</div>';
        return $output; 
    }


    function only_content($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.'">';
        if(!empty($dynamic_title)){
            $output .= '<div class="header"><h6>'.$dynamic_title.'</h6></div>';
        }
        
        $output .= do_shortcode($content);
                 
        $output .= '</div>';
        return $output; 
    }

    function services_small($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.' services_small">';
        $icon_class = ((isset($icon_bool) && $icon_bool == 'yes')?'with_icon':'no_icon');
        $data = array();
        $data['link'] = '';
        $data['description'] = "";
        $query = array();
        if($dynamic_content_type == 'page'){
            $query = array( 'p' => $dynamic_page, 'posts_per_page'=>1, 'post_type'=> 'page' );
        }
        if($dynamic_content_type == 'post'){
            $query = array( 'p' => $dynamic_post, 'posts_per_page'=>1, 'post_type'=> 'post' );
        }
        if($dynamic_content_type == 'content'){
            $data['description'] = $dynamic_content_content;
            $data['link'] = $dynamic_content_link;
        }else{
            $loop = new WP_Query($query);
            if($loop->have_posts()){
                while($loop->have_posts()){
                    $loop->the_post();
                    
                    $data['link'] = get_permalink();
                    $data['description'] = get_the_excerpt();
                    
                }
            }
            wp_reset_postdata();
        }

        $output .= '<dl class="dl-horizontal">';
        $extra_class = '';
        $extra_style = '';
        $output .= '    <dt class="'.$extra_class.'" style="'.$extra_style.'">';
        if($icon_bool_pred == 'yes'){
            if($icon_color == 'base'){
                $icon_color = themeple_get_option('base_color');
                if(isset($_COOKIE['themeple_skin'])){

                    include(THEMEPLE_BASE.'/template_inc/admin/register_skins.php');

                    if(is_array($predefined[$_COOKIE['themeple_skin']]) && count($predefined[$_COOKIE['themeple_skin']]) > 0 ){
                        $icon_color = $predefined[$_COOKIE['themeple_skin']]['base_color'];
                    }
                 }
            }
            $icon_style = 'color:'.$icon_color.';';
            $output .= '<i class="'.$icon.'" style="'.$icon_style.'"></i>';
        }
        if(!isset($link_title)){
            $link_title = '';
        }
        $output .= '        ';
        $output .= '    </dt>';
        $output .= '    <dd><h3>'.$title.'</h3></dd>';
        $output .= '</dl>';
        $output .= '<div class="content pad-no">';
            $output .= '<div>'.do_shortcode($data['description']).'</div>';
            $output .= '<a href="'.$data['link'].'" class="link">'.$link_title.'</a>';
        $output .= '</div>';
        
        $output .= '</div>';
        return $output; 
    }

    function services_medium($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.' services_medium">';
        $output .= '<div class="overlay"></div>';
        $icon_class = (($icon_bool == 'yes')?'with_icon':'no_icon');
        $data = array();
        $query = array();
        $data['link'] = '';
        $data['description'] = '';
        if($dynamic_content_type == 'page'){
            $query = array( 'p' => $dynamic_page, 'posts_per_page'=>1, 'post_type'=> 'page' );
        }
        if($dynamic_content_type == 'post'){
            $query = array( 'p' => $dynamic_post, 'posts_per_page'=>1, 'post_type'=> 'post' );
        }
        if($dynamic_content_type == 'content'){
            $data['description'] = $dynamic_content_content;
            $data['link'] = $dynamic_content_link;
        }else{
            $loop = new WP_Query($query);
            if($loop->have_posts()){
                while($loop->have_posts()){
                    $loop->the_post();
                    
                    $data['link'] = get_permalink();
                    $data['description'] = get_the_excerpt();
                    
                }
            }
            wp_reset_postdata();
        }

        
            
            if($icon_bool == 'yes' && $icon_bool_pred == 'yes' && !empty($icon)):
               
                $output .= '<div class="icon_wrapper"><i class="'.$icon.' icon"></i></div>';
                

            endif;

            if($icon_bool == 'yes'  && $icon_bool_pred == 'no' && !empty($icon_up)):
               
                $output .= '<span class="icon_up" style="background:url(\''.$icon_up.'\') center no-repeat;"></span>';
                

            endif;

        $output .= '<h3><a href="'.$data['link'].'">'.$title.'</a></h3>';
        $output .= '<p>'.do_shortcode($data['description']).'</p>';
        $output .= '</div>';
        return $output; 
    }

     function services_medium_box($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.' services_medium_box '.$icon_pos.'">';
        $icon_class = (($icon_bool == 'yes')?'with_icon':'no_icon');
        $data = array();
        $query = array();
        $data['link'] = '';
        $data['description'] = '';
        if($dynamic_content_type == 'page'){
            $query = array( 'p' => $dynamic_page, 'posts_per_page'=>1, 'post_type'=> 'page' );
        }
        if($dynamic_content_type == 'post'){
            $query = array( 'p' => $dynamic_post, 'posts_per_page'=>1, 'post_type'=> 'post' );
        }
        if($dynamic_content_type == 'content'){
            $data['description'] = $dynamic_content_content;
            $data['link'] = $dynamic_content_link;
        }else{
            $loop = new WP_Query($query);
            if($loop->have_posts()){
                while($loop->have_posts()){
                    $loop->the_post();
                    
                    $data['link'] = get_permalink();
                    $data['description'] = get_the_excerpt();
                    
                }
            }
            wp_reset_postdata();
        }

        
            $output .= '<div class="icon_box">';
            if($icon_bool == 'yes' && $icon_bool_pred == 'yes' && !empty($icon)):
               
                $output .= '<i class="'.$icon.' icon"></i>';
                

            endif;

            if($icon_bool == 'yes'  && $icon_bool_pred == 'no' && !empty($icon_up)):
               
                $output .= '<span class="icon_up" style="background:url(\''.$icon_up.'\') center no-repeat;"></span>';
                

            endif;
        $output .= '</div>';
        if(!isset($bg_color))
            $bg_color = '#f7f7f7';
        $output .= '<div class="content_box" style="background:'.$bg_color.';">';
            $output .= '<h3><a href="'.$data['link'].'">'.$title.'</a></h3>';
            $output .= '<p>'.do_shortcode($data['description']).'</p>';
            if($icon_pos == 'left')
                $output .= '<a href="'.$data['link'].'" class="read_m">'.__('Learn More', 'themeple').'</a>';
        $output .= '</div>';
        $output .= '</div>';
        return $output; 
    }


    function services_medium_image($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.' services_medium_image">';
        
        $output .= '<h2><a href="'.$link.'">'.$title.'</a></h2>';
        
        $output .= '<span class="icon_up" style="background:url(\''.$icon_up.'\') center no-repeat;"></span>';
        

        $output .= '<a href="'.$link.'" class="link">'.__('En savoir plus', 'themeple').'</a>';
        $output .= '</div>';
        return $output; 
    }


    function el_head($element){
        extract($element['saved'][0]);
        $output = '';
	    if(!empty($dynamic_title)){
            $extra_style = '';
            $extra_class = '';
            if($dynamic_size == 6){
                $extra_style = 'width:540px; margin-right:20px;';
                $extra_class = 'two_h';
            }
            $output = '<div class="header '.$extra_class.'" style="'.$extra_style.'"><h6>'.$dynamic_title.'</h6>';
            
            if($pagination_bool == 'yes'):
                $output .= '<div class="pagination"><a href="#" class="prev"></a><a href="#" class="next"></a></div>';
            endif;
            $output .= '</div>';
        }
        return $output; 
    }
    function services_table($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.' services_table">';
        $icon_class = (($icon_bool == 'yes')?'with_icon':'no_icon');
       
       

        
            if($icon_bool == 'yes' && $icon_bool_pred == 'yes' && !empty($icon)):
               
                $output .= '<span class="icon_wrapper"><i class="'.$icon.' icon"></i></span>';
                

            endif;

            if($icon_bool == 'yes'  && $icon_bool_pred == 'no' && !empty($icon_up)):
               
                $output .= '<span class="icon_up" style="background:url(\''.$icon_up.'\') center no-repeat;"></span>';
                

            endif;

        $output .= '<h5><a href="'.$link.'">'.$title.'</a></h5>';
    
        $output .= '<p>'.$desc.'</p>';
        
        $output .= '</div>';
        return $output; 
    }


    function services_stats($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.' services_stats">';
        $icon_class = (($icon_bool == 'yes')?'with_icon':'no_icon');
       
       

        
            if($icon_bool == 'yes' && $icon_bool_pred == 'yes' && !empty($icon)):
               
                $output .= '<span class="icon_wrapper" style=" background:'.$color_circle.';"><i class="'.$icon.' icon" style="color:'.$color_icon.';"></i></span>';
                

            endif;

            if($icon_bool == 'yes'  && $icon_bool_pred == 'no' && !empty($icon_up)):
               
                $output .= '<span class="icon_up" style="background:url(\''.$icon_up.'\') center no-repeat;"></span>';
                

            endif;

        $output .= '<h2 style="color:'.$color_head.';">'.$title.'</h2>';
    
        $output .= '<p  style="color:'.$color_desc.';">'.$desc.'</p>';
        
        $output .= '</div>';
        return $output; 
    }


    function services_large($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.' services_large">';
        $output .= '<dl class="dl-horizontal">';
            $output .= '<dt><span class="icon_up" style="background:url(\''.$icon.'\') center no-repeat;"></span></dt>';
            $output .= '<dd>';
                $output .= '<h6>'.$title.'</h6>';
                $output .= '<p>'.$short_desc.'</p>';
            $output .= '</dd>';
        $output .= '</dl>';
        $output .= '<p>'.$desc.'</p>';
        if(!empty($link_title))
        $output .= '<a href="'.$link_href.'" class="btn-system"><span>'.$link_title.'</span></a>';
        $output .= '</div>';
        return $output; 
    }



    function services_media($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.' services_media">';

        
        if($type == 'img')
	       $output .= '<img src="'.$photo.'" alt="" />';
	    else
        if($type == 'video'){
            if(isset($video)){
                global $wp_embed;
                $output .= $wp_embed->run_shortcode('[embed]'.trim($video).'[/embed]');
            }
        }
        $output .= '<div class="overlay">';
            $output .= '<h4><a href="'.$link.'">'.$title.'</a></h4>';
            $output .= '<p>'.do_shortcode($desc).'</p>';
        $output .= '</div>';
        $output .= '</div>';
        return $output; 
    }


    function services_creative($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.' services_creative">';
        $icon_class = (($icon_bool == 'yes')?'with_icon':'no_icon');
       
       

        
            if($icon_bool == 'yes' && $icon_bool_pred == 'yes' && !empty($icon)):
               
                $output .= '<span class="icon_wrapper"><i class="'.$icon.' icon"></i></span>';
                

            endif;

            if($icon_bool == 'yes'  && $icon_bool_pred == 'no' && !empty($icon_up)):
               
                $output .= '<span class="icon_up" style="background:url(\''.$icon_up.'\') center no-repeat;"></span>';
                

            endif;

        $output .= '<h4><a href="'.$link.'">'.$title.'</a></h4>';
    
        $output .= '<p>'.$desc.'</p>';
        $output .= '<a href="'.$link.'" class="link">'.$link_title.'</a>';
        $output .= '</div>';
        return $output; 
    }

    function media($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.' media media_el animate_onoffset">';
        $width_style="";
        if($alignment == 'center')
            $width_style = 'style="width:'.$width.'px !important;position:relative; left:50%; margin-left:-'.($width/2).'px;" ';
        if($type == 'image'){
            if(isset($image)){

                $output .= '<img src="'.$image.'" alt="" class="type_image media_animation animation_'.$animation.' alignment_'.$alignment.'" '.$width_style.' />';
            }
        }

        if($type == 'video'){
            $output .= '<div class="video_embeded" '.$width_style.'>';
            if(isset($video)){
                global $wp_embed;
                $output .= $wp_embed->run_shortcode('[embed class="animation_'.$animation.' video alignment_'.$alignment.' '.$width_style.'"]'.trim($video).'[/embed]');
            }
            $output .= '</div>';
        }

        if($type == 'slideshow'){
            switch($slideshow)
            {
                case'posts': $query_id = $slideshow_post; $type ='post'; break;
                case'pages': $query_id = $slideshow_page; $type ='page'; break;
                
            }

            $query_post = array( 'p' => $query_id, 'posts_per_page'=>1, 'post_type'=> $type );
            $additional_loop = new WP_Query($query_post);
            
            if($additional_loop->have_posts())
            {
                
                while ($additional_loop->have_posts())
                { 
                    $additional_loop->the_post();
                    
                            
                    
                    if(!$additional_loop->post->post_excerpt || $query_id == $this->post_id)
                    {

                            

                                                    $slider = new themeple_slideshow(get_the_ID(), 'flexslider');

                   

                                                    if($slider && $slider->slide_number > 0){
                                                        
                                                        $slider->slide_container_class .= ' type_slideshow media_animation animation_'.$animation.' alignment_'.$alignment;

                                                        $slider->additional_attr .= $width_style;

                                                        $sliderHtml = $slider->render_slideshow();

                                                        $output .= $sliderHtml;

                                                    }
                            
                    }
                    
                     
                    
                    
                }
                
                
            }
        }
        
        $output .= '</div>';
        return $output; 
    }
    function services_steps($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.' services_steps steps_nr_'.count($steps).'">';
        $offset = 1/count($steps);
        $i = 0;
	 $base = themeple_get_option('base_color');
	 
        $output .= '<div class="first_desc">';
            $output .= '<div class="header">';
                if(!empty($title))
                    $output .= '<h1>'.$title.'</h1>';
                if(!empty($little))
                    $output .= '<h2>'.$little.'</h2>';
            $output .= '</div>';
            $output .= '<p>'.$desc.'</p>';
        $output .= '</div>';
        foreach($steps as $s): 
            $i++;
	     
           
            $output .= '<div class="step">';
                $output .= '<i class="'.$s['icon'].'"></i>';
                $output .= '<h2>'.$s['title'].'</h2>';
                $output .= '<p>'.$s['desc'].'</p>';
              
            $output .= '</div>';
        endforeach;
       
        
        $output .= '</div>';
        return $output; 
    }

    function countdown($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.' countdown">';
        
        $output .= '<div id="countdowndiv"></div>';
	 $output .= "\n <script type='text/javascript'>\n /* <![CDATA[ */  \n";
    	 $output .= 'jQuery(document).ready(function($){$("#countdowndiv").countdown({until: new Date('.$year.', '.($month-1).', '.$day.')})} );';
    	 $output .= "</script>\n \n ";
 
         
        $output .= '</div>';
        return $output; 
    }


    function faq ($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.'">';

        $args = array(
            'taxonomy'  => 'faq_entries',
            'hide_empty'=> 0
        );

        $categories = get_categories($args);
         
        if(count($categories) > 0){
            $output .='<!-- Portfolio Filter --><nav id="faq-filter" class="span12">';
               $output .= '<ul class="">';
                 $output .= '<li class="active all"><a href="#"  data-filter="*">'.__('View All', 'themeple').'</a><span></span></li>';
                    
                foreach($categories as $cat):
                    
                       $output .= '<li class="other"><a href="#" data-filter=".'.$cat->category_nicename.'">'.$cat->cat_name.'</a><span></span></li>';    
                    
                endforeach;
                
                $output .='</ul>';
            $output .= '</nav>';
       }
       $nr = rand(0, 5000);
       
    $output .= '<div class="accordion faq '.$style.'" id="accordion'.$nr.'">';
       $query_post = array('posts_per_page'=> 9999, 'post_type'=> 'faq' );
	$i = 0;
       $loop = new WP_Query($query_post);
       if($loop->have_posts()){
            while($loop->have_posts()){
                $i++;
                $loop->the_post();
                $sort_classes = "";
                $item_categories = get_the_terms( get_the_ID(), 'faq_entries' );
            
                if(is_object($item_categories) || is_array($item_categories))
                {
                    foreach ($item_categories as $cat)
                    {
                        $sort_classes .= $cat->slug.' ';
                    }
                }
                   
                    $output .= '<div class="accordion-group '.$sort_classes.'">';
                        $output .= '<div class="accordion-heading '.( ($i == 1)?'in_head':'' ).'">';
                        $id = rand(0, 50000);
                            $output .= '<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion'.$nr.'" href="#toggle'.$id.'">';
                                $output .= '<i class="'.themeple_post_meta(get_the_ID(), 'icon').'"></i>';
                                $output .= get_the_title();
                            $output .= '</a>';
                        $output .= '</div>';
                        $output .= '<div id="toggle'.$id.'" class="accordion-body '.( ($i == 1)?'in':'' ).' collapse ">';
                            $output .= '<div class="accordion-inner">';
                                $output .= get_the_content();
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                
                


            }

        }
        $output .= '</div>';
        
        $output .= '</div>';
        return $output;
       
    }

    function slideshow($element){

        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.' dynamic_slideshow">';
        switch($dynamic_which_post_page)
        {
            case'post': $query_id = $dynamic_post_id; $type ='post'; break;
            case'page': $query_id = $dynamic_page_id; $type ='page'; break;
            case'self': $query_id = $this->post_id;   $type = get_post_type( $this->post_id ); break;
        }

        $query_post = array( 'p' => $query_id, 'posts_per_page'=>1, 'post_type'=> $type );
        $additional_loop = new WP_Query($query_post);
        
        if($additional_loop->have_posts())
        {
            
            while ($additional_loop->have_posts())
            { 
                $additional_loop->the_post();
                
                if($dynamic_which_post_page != 'self' && $query_id != $this->post_id)
                {
                    global $more;
                    $more = 0;
                }
                        
                
                if(!$additional_loop->post->post_excerpt || $query_id == $this->post_id)
                {
                           

                            if(themeple_post_meta(get_the_ID(), '_slideshow_type') != 'layer_slider' || $type == 'post'){
                                
                                             $slider = new themeple_slideshow(get_the_ID(), themeple_post_meta(get_the_ID(), '_slideshow_type'));

                                                if($slider){

                                                   
                                                    $sliderHtml = $slider->display();



                                                    $output .= $sliderHtml;

                                                }
                            }else if(themeple_post_meta(get_the_ID(), '_slideshow_type') == 'layer_slider'){

                                $slider = new themeple_slideshow(get_the_ID(), 'layer_slider');
                                if($slider){

                                    $slider->options['layer_slider_id'] = themeple_post_meta(get_the_ID(), '_slideshow_layer_slider');
                                    ob_start();

                                    layerslider($slider->options['layer_slider_id']+1);
                                    $output .= ob_get_clean();
                                }
                            }

                }
                
                 
                
                
            }
            
            
        }
       
        $output .= '</div>';
        return $output;
    }



    function get_free_quote($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.' get_free_quote">';
            $output .= '<div class="header"><h5>'.$title.'</h5></div>';
            $output .= '<div class="box">';
                $output .= '<p>'.$desc.'</p>';
                $output .= '<input type="text" placeholder="'.__("Your Name", "themeple").'" id="name" name="name" />';
                $output .= '<input type="text" placeholder="'.__("Email", "themeple").'" id="email" name="email" />';
                $output .= '<a href="#" class="send_mail btn-system"><span>'.$button.'</span></a>';
            $output .= '</div>';
            $output .= '<span class="shadow"></span>';

        $output .= '</div>';
        return $output;
    }



    function great_gallery($element){

        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.' great_gallery animate_onoffset">';
       

        $query_post = array( 'posts_per_page'=>12, 'post_type' => 'gallery');
        $additional_loop = new WP_Query($query_post);
        $output .= '<div class="slideshows row">';
        $nav_output = '';
        if($additional_loop->have_posts())
        {
            
            while ($additional_loop->have_posts())
            { 
                $additional_loop->the_post();
                
                        $output .= do_shortcode('[lightbox image_link="'.themeple_image_by_id(get_post_thumbnail_id(), 'great_gallery', 'url').'"]');
            }
        }       
        
        $output .= '</div>';
        
        $output .= '</div>';
        return $output;
    }

   
    
}

?>