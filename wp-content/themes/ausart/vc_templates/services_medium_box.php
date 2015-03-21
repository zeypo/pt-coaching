<?php   

        extract(shortcode_atts(array(

            'title' => '',

            'icon_bool' => '',

            'icon_bool_pred' => '',

            'bg_color' => '',

            'icon' => '',

            'icon_up' => '',

            'dynamic_content_type' => '',

            'dynamic_post' => '',

            'dynamic_page' => '',

            'dynamic_content_link' => ''

        ), $atts));         

        $output = '<div class="wpb_content_element services_medium_box">';

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



        

            $output .= '<div class="icon_box">';

            if($icon_bool == 'yes' && $icon_bool_pred == 'yes' && !empty($icon)):

               

                $output .= '<i class="'.$icon.'"></i>';

                



            endif;



            if($icon_bool == 'yes'  && $icon_bool_pred == 'no' && !empty($icon_up)):

               

                $output .= '<span class="icon_up" style="background:url(\''.$icon_up.'\') center no-repeat;"></span>';

                



            endif;

        $output .= '</div>';

        if(!isset($bg_color))

            $bg_color = '#f7f7f7';

        $output .= '<div class="content_box" style="background:'.$bg_color.';">';

            $output .= '<h5><a href="'.$data['link'].'">'.$title.'</a></h5>';

            $output .= '<p>'.do_shortcode($data['description']).'</p>';


            $output .= '<a href="'.$data['link'].'" class="read_m">'.__('Learn More', 'themeple').'</a>';

        $output .= '</div>';

        $output .= '</div>';

        echo $output;

?> 