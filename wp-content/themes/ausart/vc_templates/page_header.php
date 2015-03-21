<?php



		extract(shortcode_atts(array(

            'title' => '',

            'subtitle' => '',

            'icon' => '',

            'size_title' => '',

            'size_icon' => '',

            'style' => '',

            'title_color' => ''


        ), $atts)); 



        $output = '<div class="wpb_content_element dynamic_page_header '.$style.'">';

       
        if(!empty($title)){
            
            $output .= '<h1 style="font-size:'.$size_title.'px; color:'.$title_color.'">'.$title.'</h1>';
        }

         if($style == 'style_1'){

            $output .='<p class="description">'.do_shortcode($content).'</p>';
            $output .='<div class="line_under"><div class="line_left"></div><div class="line_center"></div><div class="line_right"></div></div>';
           
        } elseif($style == 'style_2' || $style == 'style_3') {


          $output .='<div class="line_under"><div class="line_center"></div></div>';
          $output .='<div class="line_under below_line"><div class="line_center"></div></div>';
           
          if(!empty($content)){
             $output .= '<p class="description '.$style.'">'.do_shortcode($content).'</p>'; 
          }


        }
                   
           

        $output .= '</div>';

        echo  $output;



?>