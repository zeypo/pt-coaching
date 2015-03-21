<?php        
        
        extract(shortcode_atts(array(
            'title' => '',
        ), $atts));
        $output = ''; 
        $output .= '<div class="simple_testimonial wpb_content_element">';
        if(!empty($title)){
            $output .= '<div class="header"><h2>'.$title.'</h2></div>';
        }
               
        $query_post = array('posts_per_page'=> -1, 'post_type'=> 'testimonial');                          
        $output .= '<div class="row">';
        $output .= '<div class="carousel carousel_testimonial">';   
        $loop = new WP_Query($query_post);
                     if($loop->have_posts()){

                        while($loop->have_posts()){
                            
                            $loop->the_post();  

                            $output .= '<div class="circle_testimonial"><p>'.get_the_content().'</p><span class="title"><span class="author">'.get_the_title().'</span> <span class="position">'.themeple_post_meta(get_the_ID(), 'staff_position_').'</span></span></div>';
                                                                  
                                                 
                                    
                        }
                    }
        wp_reset_postdata();
        
        $output .= '</div>';
        $output .= '</div></div>';
        $output .= '<div class="pagination"></div>';

        echo $output;
?>