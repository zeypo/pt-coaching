<?php

		 extract(shortcode_atts(array(
		 	'number' => 50, 
		 	'text' => 'Default', 
		 	'speed' => 2000,
        	        'icon' => '',
        	        

		 	), 
		 $atts));
         
         wp_enqueue_style( 'odometer-theme-minimal' );
         wp_enqueue_script('odometer.min');
         $output .=  '<div class="animated_counter">';
         $output .= '<div class="icons"><i class="'.$icon.'"></i></div>';
         $output .= '<div class="count_to animate_onoffset">';
         $output .= '<div class="odometer" data-number="'.$number.'" data-duration="'.$speed.'"></div>';
         $output .= '</div>';
         $output .= '<div class="title_counter"><h4>'.$text.'</h4></div>';
         $output .= '</div>';
         echo $output;

?>