<?php
		
		extract(shortcode_atts(array(
        ), $atts)); 
        
       

		$output = '<div class="wpb_content_element block_skill">';

        $output .= "\n\t\t\t\t".wpb_js_remove_wpautop($content);

        $output .= '</div>';
        echo  $output;


?>