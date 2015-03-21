<?php
		
		extract(shortcode_atts(array(
            'dynamic_title' => '',
            'exploded_textarea' => '',
            'dynamic_msg' => '',
            'dynamic_submit' => ''

        ), $atts));

        $output = '<div class="contact_form wpb_content_element">';
        if(!isset($dynamic_msg) )
            $dynamic_msg = '';
        $attr = array(
            "success" => '<p>'.$dynamic_msg.'</p>',
            "submit"  => $dynamic_submit,
            "submit_class" => "btn-system",
            "form_class" => "standard-form",
            "action"  => get_permalink(),
            "myemail" => themeple_get_option('email'),
            "myblogname" => get_option('blogname'),
            "autoresponder" => themeple_get_option('autoresponder'),
            "autoresponder_subject" => themeple_get_option('autoresponder_subject'),
            "autoresponder_email" => themeple_get_option('email')
        );
        $custom_elements = themeple_get_option('contact_elements');
    
        $elements = array();
        if(is_array($custom_elements))
        {
            foreach($custom_elements as $new_element)
            {
                $elements[strtolower( $new_element['label'] ) ] = $new_element;
            }
        }
        $contact_form = new themeple_form($attr);
        $contact_form->create_elements($elements);
        if(!empty($dynamic_title)){
            $output .= '<div class="header">';
            $output .= '<h2>'.$dynamic_title.'</h2>';
            $output .= '</div>';
        }
        $output .= '<div class="row-fluid">';
            
                $output .= '<div class="row-fluid">';
                    $output .= '<div class="span12">';
                    if(!empty($desc))
                        $output .= '<p class="desc">'.$desc.'</p>';
        $output .= $contact_form->display_form();
                    $output .= '</div>';
                $output .= '</div>';
            $output .= '</div>';
        $output .= '</div>';
        echo $output;

?> 