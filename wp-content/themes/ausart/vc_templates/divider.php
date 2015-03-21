<?php
	
	extract(shortcode_atts(array(
           
            'style' => '',
            'margin_top' => ''

        ), $atts));
	if(!isset($style))
            $style = 'solid_border';
    if(!empty($margin_top))
    			$new ="style='margin-top:". $margin_top."'";    
        $output = '<div '.$new.' class="divider__ '.$style.'"></div>';

    echo $output;

?>