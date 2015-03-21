<?php        

        extract(shortcode_atts(array(

            'title' => '',

            'style' => '',

            'icon_bool' => '',

            'icon' => '',

            'dynamic_content_type' => '',

            'dynamic_post' => '',

            'dynamic_page' => '',

            'dynamic_content_link' => ''

        ), $atts));

        $output = '<div class=" services_step wpb_content_element '.$style.'">';

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



        

            

            if($icon_bool == 'yes' && !empty($icon)):

               

                $output .= '<div class="icon_wrapper">';


                $output .= '<div class="overlay"></div>';

                $output .= '<i class="'.$icon.'"></i>';

                
                   $output .= '<div class="line_left"></div>';
            $output .= '<div class="line_right"></div></div>'; 


            endif;

              
         
       
        $output .= '<h4><a href="'.$data['link'].'">'.$title.'</a></h4>';

        $output .= '<p>'.do_shortcode($data['description']).'</p>';

       $output .='<a class="readmore" href="'.$data['link'].'">'.__('Read More', 'themeple').'</a>';
       
        $output .= '</div>';



        echo $output;

?>