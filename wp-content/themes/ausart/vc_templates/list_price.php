<?php

	

		extract(shortcode_atts(array(

            'title' => '',

        ), $atts)); 



        $output = '<ul class="dl-horizontal">';

        	

        	$output .= '<li>';

        		$output .= '<h4>'.$title.'</h4>';

        	

        	$output .= '</li>';

        $output .= '</ul>';



        echo $output;



?>