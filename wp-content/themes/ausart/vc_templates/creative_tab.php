<?php
	
	extract(shortcode_atts(array(
            'title' => '',
            'icon_number' => '',
            'id' => '',
            'icon' => '',
            'number' => '' 
        ), $atts));  
	$u = $id;
	$output .= '<div class="pane '.(($u == 1)?'active':'').'" data-id="t'.$u.'">';
    $output .= wpb_js_remove_wpautop($content); 
    $output .= '</div>';
	echo $output;

?>