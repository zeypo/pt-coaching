<?php
		
		extract(shortcode_atts(array(
            'dynamic_title' => '',
            'button1_title' => '',
            'button1_link' => '',
            'button2_title' => '',
            'button2_link' => ''
        ), $atts)); 

        $output = '<div class="wpb_content_element services_list" style="">';
            if(!empty($dynamic_title))       
            $output .= '<div class="header"><h1>'.$dynamic_title.'</h1></div>';
                    	$output .= "\n\t\t\t\t".wpb_js_remove_wpautop($content); 
                        if(!empty($button2_title) || !empty($button1_title))
                            $output .= '<div class="btns">';
                        if(!empty($button1_title)){
                            $output .= '<a href="'.$button1_link.'" class="btn-system primary_btn">'.$button1_title.'</a>';
                        }   
                        if(!empty($button2_title)){
                            $output .= '<a href="'.$button2_link.'" class="btn-system second_btn">'.$button2_title.'</a>';
                        }
                        if(!empty($button2_title) || !empty($button1_title)) 
                            $output .= '</div>';             
        $output .= '</div>';

        echo $output;

?>