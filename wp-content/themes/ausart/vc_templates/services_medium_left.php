<?php        
        extract(shortcode_atts(array(
            'title' => '',
            'icon_bool' => '',
            'icon' => '',
            'dynamic_content_type' => '',
            'dynamic_post' => '',
            'dynamic_page' => '',
            'dynamic_content_link' => ''
        ), $atts));
        $output = '<div class=" services_medium_left wpb_content_element">';
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
            $data['description'] = $content;
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
            
            if($icon_bool == 'yes' && !empty($icon)):
               
                $output .= '<dt><div class="icon_wrapper"><i class="'.$icon.'"></i></div></dt>';
                

            endif;
        $output .= '<dd>';
            $output .= '<h6><a href="'.$data['link'].'">'.$title.'</a></h6>';
            $output .= '<p>'.do_shortcode($data['description']).'</p>';
            $output .= '<a href="'.$data['link'].'">'.__('En savoir plus', 'themeple').'</a>';
        $output .= '</dd>';
        $output .= '</dl>';
        $output .= '</div>';
        echo $output;
?>