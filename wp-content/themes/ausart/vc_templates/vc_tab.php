<?php
global $firsts_tabs;
$output = $title = $tab_id = '';
extract(shortcode_atts($this->predefined_atts, $atts));

$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, '', $this->settings['base']);
$active = '';
$id = 'tab-'. (empty($tab_id) ? sanitize_title( $title ) : $tab_id);
if(in_array($id, $firsts_tabs))
	$active = 'active';
$output .= "\n\t\t\t" . '<div id="tab-'. (empty($tab_id) ? sanitize_title( $title ) : $tab_id) .'" class="tab-pane '.$css_class.' '.$active.'">';
$output .= ($content=='' || $content==' ') ? __("Empty section. Edit page to add content here.", "js_composer") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
$output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment('.wpb_tab');

echo $output;