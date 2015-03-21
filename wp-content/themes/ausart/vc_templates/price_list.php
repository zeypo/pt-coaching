<?php

    

    extract(shortcode_atts(array(

            'dynamic_title' => '',

            'dynamic_src' => '',

            'title' => '',

            'title_color' => '',

            'price' => '',

            'price_color' => '',

            'currency' => '',

            'period' => '',

            'period_color' => '' ,

            'button_title' => '',

            'button_link' => '',

            'first_color' => '',

            'second_color' => '',

            'highlight_table' => ''


        ), $atts)); 

    $output = '<div class="wpb_content_element">';  

        if(!empty($dynamic_title)){

            $output .= '<div class="header"><h3>'.$dynamic_title.'</h3></div>';

        }

        $extra_class='';

        $position = 'relative';

       

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

                  $output .= "\n\t\t\t\t".wpb_js_remove_wpautop($content);

            $output .='</ul>';

           $output .= '<div class="footer">'; 
              
                $output .= '<a href="'.$button_link.'" class="btn-system only_border" style="border:2px solid '.$second_color.' ">'.$button_title.'</a>';

          

           $output .= '</div>';

           $output .= '</div>';

           $output .= '</div>';

          

           echo $output;


?>