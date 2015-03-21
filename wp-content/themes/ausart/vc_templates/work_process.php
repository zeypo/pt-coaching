<?php
	extract(shortcode_atts(array(
            'header' => '',
            'text' => '',
            'icon_1' => '',
            'icon_2' => '',
            'icon_3' => '',
            'icon_4' => '',
            'icon_5' => ''
    ), $atts));

    $output = '<div class="work_process wpb_content_element">';

    	$output .= '<h1 class="big_title_element">'.$header.'</h1><p>'.$text.'</p>';
    	$output .= '<div class="process_block first">';
	    	$output .= '<div class="icon_1 process"><i class="'.$icon_1.'"></i><span class="little_circle"><span></span></span></div>';
	    	$output .= '<div class="icon_2 process"><i class="'.$icon_2.'"></i><span class="little_circle"><span></span></span></div>';
	    	$output .= '<div class="icon_3 process"><i class="'.$icon_3.'"></i><span class="little_circle"><span></span></span></div>';
    	$output .= '</div>';
    	$output .= '<div class="border_wrapper"></div>';
    	$output .= '<div class="process_block second">';
	    	$output .= '<div class="icon_4 process"><i class="'.$icon_4.'"></i><span class="little_circle"><span></span></span></div>';
	    	$output .= '<div class="icon_5 process"><i class="'.$icon_5.'"></i><span class="little_circle"><span></span></span></div>';
    	$output .= '</div>';
    $output .= '</div>';

    echo $output;
?>