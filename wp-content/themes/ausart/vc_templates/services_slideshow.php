<?php

    extract(shortcode_atts(array(
            'title' => '',
            'icon_bool' => '',
            'icon_bool_pred' => '',
            'upload_img' => '',
            'icon' => '',
            'dynamic_content_type' => '',
            'dynamic_post' => '',
            'dynamic_page' => '',
            'dynamic_content_content' => '',
            'dynamic_content_link' => ''
        ), $atts));

    $output = '<div class="services_slideshow wpb_content_element">';
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

        $output .= '<div class="services_slideshow_container">';
        $extra_class = '';
        $extra_style = '';
        $output .= '    <div class="'.$extra_class.' services_slideshow_icon" style="'.$extra_style.'">';
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
        $output .= '    </div>';
        $output .= '    <div class="services_slideshow_title"><h4><a href="'.$data['link'].'">'.$title.'</a></h4><p>'.do_shortcode($data['description']).'</p></div>';
        $output .= '</div>';    
        $output .= '</div>';
        echo $output;

?>