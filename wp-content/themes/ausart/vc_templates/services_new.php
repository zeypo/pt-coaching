<?php   

        extract(shortcode_atts(array(

            'title' => '',

            'icon_bool' => '',

            'icon_bool_pred' => '',

            'icon' => '',

            'icon_up' => '',

            'dynamic_content_type' => '',

            'dynamic_post' => '',

            'dynamic_page' => '',

            'dynamic_content_link' => ''

        ), $atts));     

        $output = '<div class="wpb_content_element services_medium_new">';

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



        

            

            if($icon_bool == 'yes' && $icon_bool_pred == 'yes' && !empty($icon)):

               

                $output .= '<div class="overlay"><span></span><i class="'.$icon.'"></i></div>';

                



            endif;



            if($icon_bool == 'yes'  && $icon_bool_pred == 'no' && !empty($icon_up)):

               

                $output .= '<span class="icon_up" style="background:url(\''.$icon_up.'\') center no-repeat;"></span>';

                



            endif;



        $output .= '<h6><a href="'.$data['link'].'">'.$title.'</a></h6>';

        $output .= '<p>'.wpb_js_remove_wpautop($data['description']).'</p>';

        $output .= '</div>';

        echo $output;

?>