<?php        

        extract(shortcode_atts(array(

            'title' => '',

            'link' => '',

            'icon_bool' => '',

            'icon' => '',

            'color' => ''

        ), $atts));

        if ($color != '')

            $style = 'background:'.$color;

        $output = '<div class=" services_box_color wpb_content_element '.$style.'">';

        if($icon_bool == 'yes')

            $output .= '<div class="icon"><i class="'.$icon.'"></i></div>';

        $output .= '<div class="title"><a href="'.$link.'">'.$title.'</a></div>';

        $output .= '</div>';

        echo $output;

?>