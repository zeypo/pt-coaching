<?php

		extract(shortcode_atts(array(
            'title' => '',
            'position' => '',
            'img_bool' => '',
            'image' => ''
        ), $atts));

        if(!isset($img_bool)){
            $img_bool = 'no';
        }
        $output = '<div class="wpb_content_element page_intro type-'.$position.' img-'.$img_bool.' ">';
            if($img_bool == 'yes'){
                $output .= '<span class="img" style="background-image:url('.$image.');"></span>';
            }
            $output .= '<h1>'.do_shortcode($title).'</h1>';
        $output .= '</div>';
        echo $output;

?>