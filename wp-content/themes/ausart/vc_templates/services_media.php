<?php        
        
        extract(shortcode_atts(array(
            'title' => '',
            'type' => '',
            'photo' => '',
            'video' => '',
            'link' => '' ,
            'circle_shape' => '' 
        ), $atts));   
        $output = '<div class="wpb_content_element services_media">';

     
       if($circle_shape == 'yes'){
        $photo_size = 'port_quadratic';
       }else{
        $photo_size = 'port3';   
       }
        
        if($type == 'img'){
            if(!empty($photo)) {
            
                if(strpos($photo, "http://") !== false){
                    $photo = $photo;
                } else {
                   
                    if($circle_shape == 'yes')
                        $bg_image_src = wp_get_attachment_image_src($photo, array(200, 200));
                    else
                        $bg_image_src = wp_get_attachment_image_src($photo, $port3);    

                    

                    $photo = $bg_image_src[0];
                }
            }
            $output .= '<div class="img_div '.$photo_size.'">';
            $output .= '<img src="'.$photo.'" alt="" />';
            $output .= '</div>';
        }
	   
	    else
        if($type == 'video'){
            if(isset($video)){
                global $wp_embed;
                $output .= $wp_embed->run_shortcode('[embed]'.trim($video).'[/embed]');
            }
        }

        $output .= '<h1><a href="'.$link.'">'.$title.'</a></h1>';
        $output .= '<div class="serv_content">';
           
            $output .= '<p>'.do_shortcode($content).'</p>';

        $output .= '</div>';
        $output .='<span class="read_more"><a href="'.$link.'">'.__('Learn More', 'themeple').'</a></span>';
        $output .= '</div>';
        echo $output;
?>