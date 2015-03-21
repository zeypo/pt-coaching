<?php
wp_enqueue_script('jquery-ui-accordion');
$output = $title = $interval = $el_class = $collapsible = $active_tab = '';
//
extract(shortcode_atts(array(
    'title' => '',
    'el_class' => ''
), $atts));
global $toggles_i;
$toggles_i++;
$el_class = $this->getExtraClass($el_class);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_accordion wpb_content_element not-column-inherit', $this->settings['base']);
$nr = rand();
$output .= '<div class="'.$css_class.'">';
if(!empty($title))
    $output .= '<div class="header"><h2>'.$title.'</h2></div>';
$output .= "\n\t".'<div class="accordion '.$style.'" id="accordion'.$toggles_i.'" data-active-tab="'.$active_tab.'">'; //data-interval="'.$interval.'"
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t".'</div> '.$this->endBlockComment('.wpb_accordion');
$output .= '</div>';
echo $output;