<?php
		
		extract(shortcode_atts(array(
            'dynamic_title' => '',
       

        ), $atts));

        $output = '';
	    if(!empty($dynamic_title)){
            $extra_style = '';
            $extra_class = '';
            
            $output = '<div class="header '.$extra_class.'" style="'.$extra_style.'"><h2>'.$dynamic_title.'</h2>';
            
         
            $output .= '</div>';
        }
        echo $output; 


?>