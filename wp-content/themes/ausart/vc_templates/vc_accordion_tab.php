<?php
$output = $title = '';

extract(shortcode_atts(array(
	'title' => __("Section", "js_composer"),
	'open' => false
), $atts));
global $toggles_i;
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_accordion_section group', $this->settings['base']);
$in_head = '';
if($open){
    $open = 'in';
    $in_head = 'in_head';
}
                
        
        $output = '<div class="accordion-group '.$css_class.'">';

            $output .= '<div class="accordion-heading '.$in_head.'">';

            $id = rand(0, 50000);

                $output .= '<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion'.$toggles_i.'" href="#toggle'.$id.'">'.$title.'</a>';

            $output .= '</div>';

            $output .= '<div id="toggle'.$id.'" class="accordion-body collapse '.$open.'">';

                $output .= '<div class="accordion-inner">';

                    $output .= ($content=='' || $content==' ') ? __("Empty section. Edit page to add content here.", "js_composer") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);

                $output .= '</div>';

            $output .= '</div>';

        $output .= '</div>';
echo $output;