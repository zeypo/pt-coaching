<?php

		

		extract(shortcode_atts(array(

            'title' => '',

            'style' => '',

            'subtitle' => '',

            'button1_title' => '',

            'button_color' => '',

            'button1_link' => '',

            'button_style' => 'second_btn',

            'font_color' => '',

            'background_color' => '',

            'top_border' => ''



        ), $atts));

        if($top_border == 'no')

            $border_remover = 'border:none;';

        $output = '<div class="textbar-container wpb_content_element '.$extra_class.' style_1 " style="background:'.$background_color.'; '.$border_remover.';">';

            

                $output .= '<h1 style="color: '.$font_color.'">'.do_shortcode($title).'</h1>';
                $output .='<span class="subtitle" style="color: '.$font_color.'">'.$subtitle.'</span>';

                if(isset($button1_title) && $button1_title != '')

                    $output .= '<a href="'.$button1_link.'" class="btn-system normal '.$button_style.'" style="border:2px solid '.$font_color.'; color:'.$font_color.' background:'.$background_color.';">'.$button1_title.'</a>';


            

        $output .= '</div>';

        echo $output;



?>