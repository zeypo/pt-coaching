<?php
        extract(shortcode_atts(array(
            'title' => '',
            'heading_title' => 'h1',
            "short_desc" => '', 
            "color_head" => '', 
            'color_desc_s' => '', 
            'color_desc' => '',
            'alignment' => '',
            'button_title' => '',
            'button_link' => ''

        ), $atts));

        $btn_class = 'blue';
        if(!isset($alignment))
            $alignment = 'left';
	    if(!isset($color_desc_s))
		$color_desc_s = '#555';
        $output = '<div class="plain_text alignment_'.$alignment.'">';
        if(!isset($color_head))
            $color_head = '#222';
        if(!isset($color_desc))
            $color_desc = '#888';
        if(!empty($title))
            $output .= '<'.$heading_title.' class="big_title" style="color:'.$color_head.';">'.do_shortcode($title).'</'.$heading_title.'>';
        if(!empty($short_desc))
            $output .= '<h5 class="short_desc" style="color:'.$color_desc_s.';">'.$short_desc.'</h5>';
        
        $output .= '<p class="content"  style="color:'.$color_desc.';">'.wpb_js_remove_wpautop($content).'</p>';

        if(!empty($button_title)){
            $output .= '<a href="'.$button_link.'" class="btn-system">'.$button_title.'</a>';
        }
        
        $output .= '</div>'; 

        echo $output;
?>