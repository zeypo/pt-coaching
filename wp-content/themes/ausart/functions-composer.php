<?php



vc_remove_element("vc_button");

vc_remove_element("vc_posts_slider");

vc_remove_element("vc_gmaps");

vc_remove_element("vc_teaser_grid");

vc_remove_element("vc_progress_bar");

vc_remove_element("vc_facebook");

vc_remove_element("vc_tweetmeme");

vc_remove_element("vc_googleplus");

vc_remove_element("vc_facebook");

vc_remove_element("vc_pinterest");

vc_remove_element("vc_message");

vc_remove_element("vc_posts_grid");

vc_remove_element("vc_carousel");

vc_remove_element("vc_flickr");

vc_remove_element("vc_tour");

vc_remove_element("vc_separator");

vc_remove_element("vc_single_image");

vc_remove_element("vc_cta_button");

//vc_remove_element("vc_accordion");

//vc_remove_element("vc_accordion_tab");

vc_remove_element("vc_toggle");

//vc_remove_element("vc_tabs");

//vc_remove_element("vc_tab");

vc_remove_element("vc_images_carousel");

vc_remove_element("vc_wp_archives");

vc_remove_element("vc_wp_calendar");

vc_remove_element("vc_wp_categories");

vc_remove_element("vc_wp_custommenu");

vc_remove_element("vc_wp_links");

vc_remove_element("vc_wp_meta");

vc_remove_element("vc_wp_pages");

vc_remove_element("vc_wp_posts");

vc_remove_element("vc_wp_recentcomments");

vc_remove_element("vc_wp_rss");

vc_remove_element("vc_wp_search");

vc_remove_element("vc_wp_tagcloud");

vc_remove_element("vc_wp_text");

vc_remove_element("vc_pie");



// VC_Row Mods/Additions

vc_remove_param("vc_row", "css");

vc_remove_param("vc_row", "bg_color");

vc_remove_param("vc_row", "font_color");

vc_remove_param("vc_row", "margin_bottom");

vc_remove_param("vc_row", "bg_image");

vc_remove_param("vc_row", "bg_image_repeat");

vc_remove_param("vc_row", "padding");

vc_remove_param("vc_row", "el_class");







function active_vc(){

	require_once 'template_inc/admin/admin_dynamic_options.php';

	$base_elements = array(

		"dynamic" => 'base',

		'name'    => 'name',

		'category' => __('Themeple Elements', 'themeple'),

		'description' => 'desc',

		'id'   => 'empty',

		'subelements' => 'params'

	);



	$element_a = array(

		'type' => 'type',

		'name' => 'heading',

		'id'   => 'param_name',

		'std'  => 'value',

		'desc'     => 'description'

	);



	$el_types = array(

		'textarea' => 'exploded_textarea',

		'select'   => 'dropdown',

		'input_text' => 'textfield',

		'upload'    => 'fws_image',

		'colorpicker' => 'colorpicker'

	);



	foreach($elements as $el){

		$array = array();

		foreach($el as $el_key => $el_value){

			if(isset($base_elements[$el_key]) && $base_elements[$el_key] != 'empty'){

				if($el_key != 'subelements')

					$array[$base_elements[$el_key]] = $el_value;

				else{

					$sub = array();

					if(!empty($el_value)){

						foreach($el_value as $s){

							$a = array();

							if($s['id'] != 'dynamic_size'){

								$type = '';

								foreach($s as $s_key => $s_value){

									

									if($s_key == 'type')

										$type = $s_value;



										if($s_key == 'required'){

											$req = array('element' => $s_value[0], 'value' => array($s_value[1]));

											$a['dependency'] = $req;

										}else if($s_key == 'subtype'){

											$a['value'] = $s_value;

										}else if($s_key == 'type'){

											

													if( isset($el_types[$s_value]) )

														$a['type'] = $el_types[$s_value];

											

										}

										else{

											if(isset($element_a[$s_key]))

												$a[$element_a[$s_key]] = $s_value;

										}

										if($type == 'switchbutton'){



													$a['type'] = 'dropdown';

													$a['value'] = array('Yes' => 'yes', 'No' => 'no');

											

										}

										$a['admin_label'] = true;	

								}

								

								$sub[] = $a;

							}

						}

					}

					$array['params'] = $sub;

					$array['category'] = __('Themeple Elements', 'themeple');

				}

			}

		}

		

		echo "<pre>";

		print "vc_map( ";

			var_export($array)."\n";

		print ");\n\n";

		echo "</pre>";

		

	}

}



/*active_vc();*/



$portfolio_types = get_categories('title_li=&orderby=name&hide_empty=0&taxonomy=portfolio_entries');



$portfolio_terms = array();

if(!empty($portfolio_types)){

  foreach ($portfolio_types as $type) {

    if(isset($type->term_id))

      $portfolio_terms[$type->name] = $type->term_id;

  }

}



 $fa_icons = array(

      'none' => 'None',

      'icon-glass' => 'icon-glass',

      'icon-music' => 'icon-music',

      'icon-search' => 'icon-search',

      'icon-envelope-alt' => 'icon-envelope-alt',

      'icon-heart' => 'icon-heart',

      'icon-star' => 'icon-star',

      'icon-star-empty' => 'icon-star-empty',

      'icon-user' => 'icon-user',

      'icon-film' => 'icon-film',

      'icon-th-large' => 'icon-th-large',

      'icon-th' => 'icon-th',

      'icon-th-list' => 'icon-th-list',

      'icon-ok' => 'icon-ok',

      'icon-remove' => 'icon-remove',

      'icon-zoom-in' => 'icon-zoom-in',

      'icon-zoom-out' => 'icon-zoom-out',

      'icon-off' => 'icon-off',

      'icon-signal' => 'icon-signal',

      'icon-cog' => 'icon-cog',

      'icon-trash' => 'icon-trash',

      'icon-home' => 'icon-home',

      'icon-file-alt' => 'icon-file-alt',

      'icon-time' => 'icon-time',

      'icon-road' => 'icon-road',

      'icon-download-alt' => 'icon-download-alt',

      'icon-download' => 'icon-download',

      'icon-upload' => 'icon-upload',

      'icon-inbox' => 'icon-inbox',

      'icon-play-circle' => 'icon-play-circle',

      'icon-repeat' => 'icon-repeat',

      'icon-refresh' => 'icon-refresh',

      'icon-list-alt' => 'icon-list-alt',

      'icon-lock' => 'icon-lock',

      'icon-flag' => 'icon-flag',

      'icon-headphones' => 'icon-headphones',

      'icon-volume-off' => 'icon-volume-off',

      'icon-volume-down' => 'icon-volume-down',

      'icon-volume-up' => 'icon-volume-up',

      'icon-qrcode' => 'icon-qrcode',

      'icon-barcode' => 'icon-barcode',

      'icon-tag' => 'icon-tag',

      'icon-tags' => 'icon-tags',

      'icon-book' => 'icon-book',

      'icon-bookmark' => 'icon-bookmark',

      'icon-print' => 'icon-print',

      'icon-camera' => 'icon-camera',

      'icon-font' => 'icon-font',

      'icon-bold' => 'icon-bold',

      'icon-italic' => 'icon-italic',

      'icon-text-height' => 'icon-text-height',

      'icon-text-width' => 'icon-text-width',

      'icon-align-left' => 'icon-align-left',

      'icon-align-center' => 'icon-align-center',

      'icon-align-right' => 'icon-align-right',

      'icon-align-justify' => 'icon-align-justify',

      'icon-list' => 'icon-list',

      'icon-indent-left' => 'icon-indent-left',

      'icon-indent-right' => 'icon-indent-right',

      'icon-facetime-video' => 'icon-facetime-video',

      'icon-picture' => 'icon-picture',

      'icon-pencil' => 'icon-pencil',

      'icon-map-marker' => 'icon-map-marker',

      'icon-adjust' => 'icon-adjust',

      'icon-tint' => 'icon-tint',

      'icon-edit' => 'icon-edit',

      'icon-share' => 'icon-share',

      'icon-check' => 'icon-check',

      'icon-move' => 'icon-move',

      'icon-step-backward' => 'icon-step-backward',

      'icon-fast-backward' => 'icon-fast-backward',

      'icon-backward' => 'icon-backward',

      'icon-play' => 'icon-play',

      'icon-pause' => 'icon-pause',

      'icon-stop' => 'icon-stop',

      'icon-forward' => 'icon-forward',

      'icon-fast-forward' => 'icon-fast-forward',

      'icon-step-forward' => 'icon-step-forward',

      'icon-eject' => 'icon-eject',

      'icon-chevron-left' => 'icon-chevron-left',

      'icon-chevron-right' => 'icon-chevron-right',

      'icon-plus-sign' => 'icon-plus-sign',

      'icon-minus-sign' => 'icon-minus-sign',

      'icon-remove-sign' => 'icon-remove-sign',

      'icon-ok-sign' => 'icon-ok-sign',

      'icon-question-sign' => 'icon-question-sign',

      'icon-info-sign' => 'icon-info-sign',

      'icon-screenshot' => 'icon-screenshot',

      'icon-remove-circle' => 'icon-remove-circle',

      'icon-ok-circle' => 'icon-ok-circle',

      'icon-ban-circle' => 'icon-ban-circle',

      'icon-arrow-left' => 'icon-arrow-left',

      'icon-arrow-right' => 'icon-arrow-right',

      'icon-arrow-up' => 'icon-arrow-up',

      'icon-arrow-down' => 'icon-arrow-down',

      'icon-share-alt' => 'icon-share-alt',

      'icon-resize-full' => 'icon-resize-full',

      'icon-resize-small' => 'icon-resize-small',

      'icon-plus' => 'icon-plus',

      'icon-minus' => 'icon-minus',

      'icon-asterisk' => 'icon-asterisk',

      'icon-exclamation-sign' => 'icon-exclamation-sign',

      'icon-gift' => 'icon-gift',

      'icon-leaf' => 'icon-leaf',

      'icon-fire' => 'icon-fire',

      'icon-eye-open' => 'icon-eye-open',

      'icon-eye-close' => 'icon-eye-close',

      'icon-warning-sign' => 'icon-warning-sign',

      'icon-plane' => 'icon-plane',

      'icon-calendar' => 'icon-calendar',

      'icon-random' => 'icon-random',

      'icon-comment' => 'icon-comment',

      'icon-magnet' => 'icon-magnet',

      'icon-chevron-up' => 'icon-chevron-up',

      'icon-chevron-down' => 'icon-chevron-down',

      'icon-retweet' => 'icon-retweet',

      'icon-shopping-cart' => 'icon-shopping-cart',

      'icon-folder-close' => 'icon-folder-close',

      'icon-folder-open' => 'icon-folder-open',

      'icon-resize-vertical' => 'icon-resize-vertical',

      'icon-resize-horizontal' => 'icon-resize-horizontal',

      'icon-bar-chart' => 'icon-bar-chart',

      'icon-twitter-sign' => 'icon-twitter-sign',

      'icon-facebook-sign' => 'icon-facebook-sign',

      'icon-camera-retro' => 'icon-camera-retro',

      'icon-key' => 'icon-key',

      'icon-cogs' => 'icon-cogs',

      'icon-comments' => 'icon-comments',

      'icon-thumbs-up-alt' => 'icon-thumbs-up-alt',

      'icon-thumbs-down-alt' => 'icon-thumbs-down-alt',

      'icon-star-half' => 'icon-star-half',

      'icon-heart-empty' => 'icon-heart-empty',

      'icon-signout' => 'icon-signout',

      'icon-linkedin-sign' => 'icon-linkedin-sign',

      'icon-pushpin' => 'icon-pushpin',

      'icon-external-link' => 'icon-external-link',

      'icon-signin' => 'icon-signin',

      'icon-trophy' => 'icon-trophy',

      'icon-github-sign' => 'icon-github-sign',

      'icon-upload-alt' => 'icon-upload-alt',

      'icon-lemon' => 'icon-lemon',

      'icon-phone' => 'icon-phone',

      'icon-check-empty' => 'icon-check-empty',

      'icon-bookmark-empty' => 'icon-bookmark-empty',

      'icon-phone-sign' => 'icon-phone-sign',

      'icon-twitter' => 'icon-twitter',

      'icon-facebook' => 'icon-facebook',

      'icon-github' => 'icon-github',

      'icon-unlock' => 'icon-unlock',

      'icon-credit-card' => 'icon-credit-card',

      'icon-rss' => 'icon-rss',

      'icon-hdd' => 'icon-hdd',

      'icon-bullhorn' => 'icon-bullhorn',

      'icon-bell' => 'icon-bell',

      'icon-certificate' => 'icon-certificate',

      'icon-hand-right' => 'icon-hand-right',

      'icon-hand-left' => 'icon-hand-left',

      'icon-hand-up' => 'icon-hand-up',

      'icon-hand-down' => 'icon-hand-down',

      'icon-circle-arrow-left' => 'icon-circle-arrow-left',

      'icon-circle-arrow-right' => 'icon-circle-arrow-right',

      'icon-circle-arrow-up' => 'icon-circle-arrow-up',

      'icon-circle-arrow-down' => 'icon-circle-arrow-down',

      'icon-globe' => 'icon-globe',

      'icon-wrench' => 'icon-wrench',

      'icon-tasks' => 'icon-tasks',

      'icon-filter' => 'icon-filter',

      'icon-briefcase' => 'icon-briefcase',

      'icon-fullscreen' => 'icon-fullscreen',

      'icon-group' => 'icon-group',

      'icon-link' => 'icon-link',

      'icon-cloud' => 'icon-cloud',

      'icon-beaker' => 'icon-beaker',

      'icon-cut' => 'icon-cut',

      'icon-copy' => 'icon-copy',

      'icon-paper-clip' => 'icon-paper-clip',

      'icon-save' => 'icon-save',

      'icon-sign-blank' => 'icon-sign-blank',

      'icon-reorder' => 'icon-reorder',

      'icon-list-ul' => 'icon-list-ul',

      'icon-list-ol' => 'icon-list-ol',

      'icon-strikethrough' => 'icon-strikethrough',

      'icon-underline' => 'icon-underline',

      'icon-table' => 'icon-table',

      'icon-magic' => 'icon-magic',

      'icon-truck' => 'icon-truck',

      'icon-pinterest' => 'icon-pinterest',

      'icon-pinterest-sign' => 'icon-pinterest-sign',

      'icon-google-plus-sign' => 'icon-google-plus-sign',

      'icon-google-plus' => 'icon-google-plus',

      'icon-money' => 'icon-money',

      'icon-caret-down' => 'icon-caret-down',

      'icon-caret-up' => 'icon-caret-up',

      'icon-caret-left' => 'icon-caret-left',

      'icon-caret-right' => 'icon-caret-right',

      'icon-columns' => 'icon-columns',

      'icon-sort' => 'icon-sort',

      'icon-sort-down' => 'icon-sort-down',

      'icon-sort-up' => 'icon-sort-up',

      'icon-envelope' => 'icon-envelope',

      'icon-linkedin' => 'icon-linkedin',

      'icon-undo' => 'icon-undo',

      'icon-legal' => 'icon-legal',

      'icon-dashboard' => 'icon-dashboard',

      'icon-comment-alt' => 'icon-comment-alt',

      'icon-comments-alt' => 'icon-comments-alt',

      'icon-bolt' => 'icon-bolt',

      'icon-sitemap' => 'icon-sitemap',

      'icon-umbrella' => 'icon-umbrella',

      'icon-paste' => 'icon-paste',

      'icon-lightbulb' => 'icon-lightbulb',

      'icon-exchange' => 'icon-exchange',

      'icon-cloud-download' => 'icon-cloud-download',

      'icon-cloud-upload' => 'icon-cloud-upload',

      'icon-user-md' => 'icon-user-md',

      'icon-stethoscope' => 'icon-stethoscope',

      'icon-suitcase' => 'icon-suitcase',

      'icon-bell-alt' => 'icon-bell-alt',

      'icon-coffee' => 'icon-coffee',

      'icon-food' => 'icon-food',

      'icon-file-text-alt' => 'icon-file-text-alt',

      'icon-building' => 'icon-building',

      'icon-hospital' => 'icon-hospital',

      'icon-ambulance' => 'icon-ambulance',

      'icon-medkit' => 'icon-medkit',

      'icon-fighter-jet' => 'icon-fighter-jet',

      'icon-beer' => 'icon-beer',

      'icon-h-sign' => 'icon-h-sign',

      'icon-plus-sign-alt' => 'icon-plus-sign-alt',

      'icon-double-angle-left' => 'icon-double-angle-left',

      'icon-double-angle-right' => 'icon-double-angle-right',

      'icon-double-angle-up' => 'icon-double-angle-up',

      'icon-double-angle-down' => 'icon-double-angle-down',

      'icon-angle-left' => 'icon-angle-left',

      'icon-angle-right' => 'icon-angle-right',

      'icon-angle-up' => 'icon-angle-up',

      'icon-angle-down' => 'icon-angle-down',

      'icon-desktop' => 'icon-desktop',

      'icon-laptop' => 'icon-laptop',

      'icon-tablet' => 'icon-tablet',

      'icon-mobile-phone' => 'icon-mobile-phone',

      'icon-circle-blank' => 'icon-circle-blank',

      'icon-quote-left' => 'icon-quote-left',

      'icon-quote-right' => 'icon-quote-right',

      'icon-spinner' => 'icon-spinner',

      'icon-circle' => 'icon-circle',

      'icon-reply' => 'icon-reply',

      'icon-github-alt' => 'icon-github-alt',

      'icon-folder-close-alt' => 'icon-folder-close-alt',

      'icon-folder-open-alt' => 'icon-folder-open-alt',

      'icon-expand-alt' => 'icon-expand-alt',

      'icon-collapse-alt' => 'icon-collapse-alt',

      'icon-smile' => 'icon-smile',

      'icon-frown' => 'icon-frown',

      'icon-meh' => 'icon-meh',

      'icon-gamepad' => 'icon-gamepad',

      'icon-keyboard' => 'icon-keyboard',

      'icon-flag-alt' => 'icon-flag-alt',

      'icon-flag-checkered' => 'icon-flag-checkered',

      'icon-terminal' => 'icon-terminal',

      'icon-code' => 'icon-code',

      'icon-reply-all' => 'icon-reply-all',

      'icon-mail-reply-all' => 'icon-mail-reply-all',

      'icon-star-half-empty' => 'icon-star-half-empty',

      'icon-location-arrow' => 'icon-location-arrow',

      'icon-crop' => 'icon-crop',

      'icon-code-fork' => 'icon-code-fork',

      'icon-unlink' => 'icon-unlink',

      'icon-question' => 'icon-question',

      'icon-info' => 'icon-info',

      'icon-exclamation' => 'icon-exclamation',

      'icon-superscript' => 'icon-superscript',

      'icon-subscript' => 'icon-subscript',

      'icon-eraser' => 'icon-eraser',

      'icon-puzzle-piece' => 'icon-puzzle-piece',

      'icon-microphone' => 'icon-microphone',

      'icon-microphone-off' => 'icon-microphone-off',

      'icon-shield' => 'icon-shield',

      'icon-calendar-empty' => 'icon-calendar-empty',

      'icon-fire-extinguisher' => 'icon-fire-extinguisher',

      'icon-rocket' => 'icon-rocket',

      'icon-maxcdn' => 'icon-maxcdn',

      'icon-chevron-sign-left' => 'icon-chevron-sign-left',

      'icon-chevron-sign-right' => 'icon-chevron-sign-right',

      'icon-chevron-sign-up' => 'icon-chevron-sign-up',

      'icon-chevron-sign-down' => 'icon-chevron-sign-down',

      'icon-html5' => 'icon-html5',

      'icon-css3' => 'icon-css3',

      'icon-anchor' => 'icon-anchor',

      'icon-unlock-alt' => 'icon-unlock-alt',

      'icon-bullseye' => 'icon-bullseye',

      'icon-ellipsis-horizontal' => 'icon-ellipsis-horizontal',

      'icon-ellipsis-vertical' => 'icon-ellipsis-vertical',

      'icon-rss-sign' => 'icon-rss-sign',

      'icon-play-sign' => 'icon-play-sign',

      'icon-ticket' => 'icon-ticket',

      'icon-minus-sign-alt' => 'icon-minus-sign-alt',

      'icon-check-minus' => 'icon-check-minus',

      'icon-level-up' => 'icon-level-up',

      'icon-level-down' => 'icon-level-down',

      'icon-check-sign' => 'icon-check-sign',

      'icon-edit-sign' => 'icon-edit-sign',

      'icon-external-link-sign' => 'icon-external-link-sign',

      'icon-share-sign' => 'icon-share-sign',

      'icon-compass' => 'icon-compass',

      'icon-collapse' => 'icon-collapse',

      'icon-collapse-top' => 'icon-collapse-top',

      'icon-expand' => 'icon-expand',

      'icon-eur' => 'icon-eur',

      'icon-gbp' => 'icon-gbp',

      'icon-usd' => 'icon-usd',

      'icon-inr' => 'icon-inr',

      'icon-jpy' => 'icon-jpy',

      'icon-cny' => 'icon-cny',

      'icon-krw' => 'icon-krw',

      'icon-btc' => 'icon-btc',

      'icon-file' => 'icon-file',

      'icon-file-text' => 'icon-file-text',

      'icon-sort-by-alphabet' => 'icon-sort-by-alphabet',

      'icon-sort-by-alphabet-alt' => 'icon-sort-by-alphabet-alt',

      'icon-sort-by-attributes' => 'icon-sort-by-attributes',

      'icon-sort-by-attributes-alt' => 'icon-sort-by-attributes-alt',

      'icon-sort-by-order' => 'icon-sort-by-order',

      'icon-sort-by-order-alt' => 'icon-sort-by-order-alt',

      'icon-thumbs-up' => 'icon-thumbs-up',

      'icon-thumbs-down' => 'icon-thumbs-down',

      'icon-youtube-sign' => 'icon-youtube-sign',

      'icon-youtube' => 'icon-youtube',

      'icon-xing' => 'icon-xing',

      'icon-xing-sign' => 'icon-xing-sign',

      'icon-youtube-play' => 'icon-youtube-play',

      'icon-dropbox' => 'icon-dropbox',

      'icon-stackexchange' => 'icon-stackexchange',

      'icon-instagram' => 'icon-instagram',

      'icon-flickr' => 'icon-flickr',

      'icon-adn' => 'icon-adn',

      'icon-bitbucket' => 'icon-bitbucket',

      'icon-bitbucket-sign' => 'icon-bitbucket-sign',

      'icon-tumblr' => 'icon-tumblr',

      'icon-tumblr-sign' => 'icon-tumblr-sign',

      'icon-long-arrow-down' => 'icon-long-arrow-down',

      'icon-long-arrow-up' => 'icon-long-arrow-up',

      'icon-long-arrow-left' => 'icon-long-arrow-left',

      'icon-long-arrow-right' => 'icon-long-arrow-right',

      'icon-apple' => 'icon-apple',

      'icon-windows' => 'icon-windows',

      'icon-android' => 'icon-android',

      'icon-linux' => 'icon-linux',

      'icon-dribbble' => 'icon-dribbble',

      'icon-skype' => 'icon-skype',

      'icon-foursquare' => 'icon-foursquare',

      'icon-trello' => 'icon-trello',

      'icon-female' => 'icon-female',

      'icon-male' => 'icon-male',

      'icon-gittip' => 'icon-gittip',

      'icon-sun' => 'icon-sun',

      'icon-moon' => 'icon-moon',

      'icon-archive' => 'icon-archive',

      'icon-bug' => 'icon-bug',

      'icon-vk' => 'icon-vk',

      'icon-weibo' => 'icon-weibo',

      'icon-renren' => 'icon-renren',

  );

    

$steadysets = array(

      'steadysets-icon-type' => 'steadysets-icon-type',

      'steadysets-icon-box' => 'steadysets-icon-box',

      'steadysets-icon-archive' => 'steadysets-icon-archive',

      'steadysets-icon-envelope' => 'steadysets-icon-envelope',

      'steadysets-icon-email' => 'steadysets-icon-email',

      'steadysets-icon-files' => 'steadysets-icon-files',

      'steadysets-icon-uniE606' => 'steadysets-icon-uniE606',

      'steadysets-icon-connection-empty' => 'steadysets-icon-connection-empty',

      'steadysets-icon-connection-25' => 'steadysets-icon-connection-25',

      'steadysets-icon-connection-50' => 'steadysets-icon-connection-50',

      'steadysets-icon-connection-75' => 'steadysets-icon-connection-75',

      'steadysets-icon-connection-full' => 'steadysets-icon-connection-full',

      'steadysets-icon-microphone' => 'steadysets-icon-microphone',

      'steadysets-icon-microphone-off' => 'steadysets-icon-microphone-off',

      'steadysets-icon-book' => 'steadysets-icon-book',

      'steadysets-icon-cloud' => 'steadysets-icon-cloud',

      'steadysets-icon-book2' => 'steadysets-icon-book2',

      'steadysets-icon-star' => 'steadysets-icon-star',

      'steadysets-icon-phone-portrait' => 'steadysets-icon-phone-portrait',

      'steadysets-icon-phone-landscape' => 'steadysets-icon-phone-landscape',

      'steadysets-icon-tablet' => 'steadysets-icon-tablet',

      'steadysets-icon-tablet-landscape' => 'steadysets-icon-tablet-landscape',

      'steadysets-icon-laptop' => 'steadysets-icon-laptop',

      'steadysets-icon-uniE617' => 'steadysets-icon-uniE617',

      'steadysets-icon-barbell' => 'steadysets-icon-barbell',

      'steadysets-icon-stopwatch' => 'steadysets-icon-stopwatch',

      'steadysets-icon-atom' => 'steadysets-icon-atom',

      'steadysets-icon-syringe' => 'steadysets-icon-syringe',

      'steadysets-icon-pencil' => 'steadysets-icon-pencil',

      'steadysets-icon-chart' => 'steadysets-icon-chart',

      'steadysets-icon-bars' => 'steadysets-icon-bars',

      'steadysets-icon-cube' => 'steadysets-icon-cube',

      'steadysets-icon-image' => 'steadysets-icon-image',

      'steadysets-icon-crop' => 'steadysets-icon-crop',

      'steadysets-icon-graph' => 'steadysets-icon-graph',

      'steadysets-icon-select' => 'steadysets-icon-select',

      'steadysets-icon-bucket' => 'steadysets-icon-bucket',

      'steadysets-icon-mug' => 'steadysets-icon-mug',

      'steadysets-icon-clipboard' => 'steadysets-icon-clipboard',

      'steadysets-icon-lab' => 'steadysets-icon-lab',

      'steadysets-icon-bones' => 'steadysets-icon-bones',

      'steadysets-icon-pill' => 'steadysets-icon-pill',

      'steadysets-icon-bolt' => 'steadysets-icon-bolt',

      'steadysets-icon-health' => 'steadysets-icon-health',

      'steadysets-icon-map-marker' => 'steadysets-icon-map-marker',

      'steadysets-icon-stack' => 'steadysets-icon-stack',

      'steadysets-icon-newspaper' => 'steadysets-icon-newspaper',

      'steadysets-icon-uniE62F' => 'steadysets-icon-uniE62F',

      'steadysets-icon-coffee' => 'steadysets-icon-coffee',

      'steadysets-icon-bill' => 'steadysets-icon-bill',

      'steadysets-icon-sun' => 'steadysets-icon-sun',

      'steadysets-icon-vcard' => 'steadysets-icon-vcard',

      'steadysets-icon-shorts' => 'steadysets-icon-shorts',

      'steadysets-icon-drink' => 'steadysets-icon-drink',

      'steadysets-icon-diamond' => 'steadysets-icon-diamond',

      'steadysets-icon-bag' => 'steadysets-icon-bag',

      'steadysets-icon-calculator' => 'steadysets-icon-calculator',

      'steadysets-icon-credit-cards' => 'steadysets-icon-credit-cards',

      'steadysets-icon-microwave-oven' => 'steadysets-icon-microwave-oven',

      'steadysets-icon-camera' => 'steadysets-icon-camera',

      'steadysets-icon-share' => 'steadysets-icon-share',

      'steadysets-icon-bullhorn' => 'steadysets-icon-bullhorn',

      'steadysets-icon-user' => 'steadysets-icon-user',

      'steadysets-icon-users' => 'steadysets-icon-users',

      'steadysets-icon-user2' => 'steadysets-icon-user2',

      'steadysets-icon-users2' => 'steadysets-icon-users2',

      'steadysets-icon-unlocked' => 'steadysets-icon-unlocked',

      'steadysets-icon-unlocked2' => 'steadysets-icon-unlocked2',

      'steadysets-icon-lock' => 'steadysets-icon-lock',

      'steadysets-icon-forbidden' => 'steadysets-icon-forbidden',

      'steadysets-icon-switch' => 'steadysets-icon-switch',

      'steadysets-icon-meter' => 'steadysets-icon-meter',

      'steadysets-icon-flag' => 'steadysets-icon-flag',

      'steadysets-icon-home' => 'steadysets-icon-home',

      'steadysets-icon-printer' => 'steadysets-icon-printer',

      'steadysets-icon-clock' => 'steadysets-icon-clock',

      'steadysets-icon-calendar' => 'steadysets-icon-calendar',

      'steadysets-icon-comment' => 'steadysets-icon-comment',

      'steadysets-icon-chat-3' => 'steadysets-icon-chat-3',

      'steadysets-icon-chat-2' => 'steadysets-icon-chat-2',

      'steadysets-icon-chat-1' => 'steadysets-icon-chat-1',

      'steadysets-icon-chat' => 'steadysets-icon-chat',

      'steadysets-icon-zoom-out' => 'steadysets-icon-zoom-out',

      'steadysets-icon-zoom-in' => 'steadysets-icon-zoom-in',

      'steadysets-icon-search' => 'steadysets-icon-search',

      'steadysets-icon-trashcan' => 'steadysets-icon-trashcan',

      'steadysets-icon-tag' => 'steadysets-icon-tag',

      'steadysets-icon-download' => 'steadysets-icon-download',

      'steadysets-icon-paperclip' => 'steadysets-icon-paperclip',

      'steadysets-icon-checkbox' => 'steadysets-icon-checkbox',

      'steadysets-icon-checkbox-checked' => 'steadysets-icon-checkbox-checked',

      'steadysets-icon-checkmark' => 'steadysets-icon-checkmark',

      'steadysets-icon-refresh' => 'steadysets-icon-refresh',

      'steadysets-icon-reload' => 'steadysets-icon-reload',

      'steadysets-icon-arrow-right' => 'steadysets-icon-arrow-right',

      'steadysets-icon-arrow-down' => 'steadysets-icon-arrow-down',

      'steadysets-icon-arrow-up' => 'steadysets-icon-arrow-up',

      'steadysets-icon-arrow-left' => 'steadysets-icon-arrow-left',

      'steadysets-icon-settings' => 'steadysets-icon-settings',

      'steadysets-icon-battery-full' => 'steadysets-icon-battery-full',

      'steadysets-icon-battery-75' => 'steadysets-icon-battery-75',

      'steadysets-icon-battery-50' => 'steadysets-icon-battery-50',

      'steadysets-icon-battery-25' => 'steadysets-icon-battery-25',

      'steadysets-icon-battery-empty' => 'steadysets-icon-battery-empty',

      'steadysets-icon-battery-charging' => 'steadysets-icon-battery-charging',

      'steadysets-icon-uniE669' => 'steadysets-icon-uniE669',

      'steadysets-icon-grid' => 'steadysets-icon-grid',

      'steadysets-icon-list' => 'steadysets-icon-list',

      'steadysets-icon-wifi-low' => 'steadysets-icon-wifi-low',

      'steadysets-icon-folder-check' => 'steadysets-icon-folder-check',

      'steadysets-icon-folder-settings' => 'steadysets-icon-folder-settings',

      'steadysets-icon-folder-add' => 'steadysets-icon-folder-add',

      'steadysets-icon-folder' => 'steadysets-icon-folder',

      'steadysets-icon-window' => 'steadysets-icon-window',

      'steadysets-icon-windows' => 'steadysets-icon-windows',

      'steadysets-icon-browser' => 'steadysets-icon-browser',

      'steadysets-icon-file-broken' => 'steadysets-icon-file-broken',

      'steadysets-icon-align-justify' => 'steadysets-icon-align-justify',

      'steadysets-icon-align-center' => 'steadysets-icon-align-center',

      'steadysets-icon-align-right' => 'steadysets-icon-align-right',

      'steadysets-icon-align-left' => 'steadysets-icon-align-left',

      'steadysets-icon-file' => 'steadysets-icon-file',

      'steadysets-icon-file-add' => 'steadysets-icon-file-add',

      'steadysets-icon-file-settings' => 'steadysets-icon-file-settings',

      'steadysets-icon-mute' => 'steadysets-icon-mute',

      'steadysets-icon-heart' => 'steadysets-icon-heart',

      'steadysets-icon-enter' => 'steadysets-icon-enter',

      'steadysets-icon-volume-decrease' => 'steadysets-icon-volume-decrease',

      'steadysets-icon-wifi-mid' => 'steadysets-icon-wifi-mid',

      'steadysets-icon-volume' => 'steadysets-icon-volume',

      'steadysets-icon-bookmark' => 'steadysets-icon-bookmark',

      'steadysets-icon-screen' => 'steadysets-icon-screen',

      'steadysets-icon-map' => 'steadysets-icon-map',

      'steadysets-icon-measure' => 'steadysets-icon-measure',

      'steadysets-icon-eyedropper' => 'steadysets-icon-eyedropper',

      'steadysets-icon-support' => 'steadysets-icon-support',

      'steadysets-icon-phone' => 'steadysets-icon-phone',

      'steadysets-icon-email2' => 'steadysets-icon-email2',

      'steadysets-icon-volume-increase' => 'steadysets-icon-volume-increase',

      'steadysets-icon-wifi-full' => 'steadysets-icon-wifi-full'

  );



$linecons = array(

      'linecon-icon-heart' => 'linecon-icon-heart',

      'linecon-icon-cloud' => 'linecon-icon-cloud',

      'linecon-icon-star' => 'linecon-icon-star',

      'linecon-icon-tv' => 'linecon-icon-tv',

      'linecon-icon-sound' => 'linecon-icon-sound',

      'linecon-icon-video' => 'linecon-icon-video',

      'linecon-icon-trash' => 'linecon-icon-trash',

      'linecon-icon-user' => 'linecon-icon-user',

      'linecon-icon-key' => 'linecon-icon-key',

      'linecon-icon-search' => 'linecon-icon-search',

      'linecon-icon-eye' => 'linecon-icon-eye',

      'linecon-icon-bubble' => 'linecon-icon-bubble',

      'linecon-icon-stack' => 'linecon-icon-stack',

      'linecon-icon-cup' => 'linecon-icon-cup',

      'linecon-icon-phone' => 'linecon-icon-phone',

      'linecon-icon-news' => 'linecon-icon-news',

      'linecon-icon-mail' => 'linecon-icon-mail',

      'linecon-icon-like' => 'linecon-icon-like',

      'linecon-icon-photo' => 'linecon-icon-photo',

      'linecon-icon-note' => 'linecon-icon-note',

      'linecon-icon-food' => 'linecon-icon-food',

      'linecon-icon-t-shirt' => 'linecon-icon-t-shirt',

      'linecon-icon-fire' => 'linecon-icon-fire',

      'linecon-icon-clip' => 'linecon-icon-clip',

      'linecon-icon-shop' => 'linecon-icon-shop',

      'linecon-icon-calendar' => 'linecon-icon-calendar',

      'linecon-icon-wallet' => 'linecon-icon-wallet',

      'linecon-icon-vynil' => 'linecon-icon-vynil',

      'linecon-icon-truck' => 'linecon-icon-truck',

      'linecon-icon-world' => 'linecon-icon-world',

      'linecon-icon-clock' => 'linecon-icon-clock',

      'linecon-icon-paperplane' => 'linecon-icon-paperplane',

      'linecon-icon-params' => 'linecon-icon-params',

      'linecon-icon-banknote' => 'linecon-icon-banknote',

      'linecon-icon-data' => 'linecon-icon-data',

      'linecon-icon-music' => 'linecon-icon-music',

      'linecon-icon-megaphone' => 'linecon-icon-megaphone',

      'linecon-icon-study' => 'linecon-icon-study',

      'linecon-icon-lab' => 'linecon-icon-lab',

      'linecon-icon-location' => 'linecon-icon-location',

      'linecon-icon-display' => 'linecon-icon-display',

      'linecon-icon-diamond' => 'linecon-icon-diamond',

      'linecon-icon-pen' => 'linecon-icon-pen',

      'linecon-icon-bulb' => 'linecon-icon-bulb',

      'linecon-icon-lock' => 'linecon-icon-lock',

      'linecon-icon-tag' => 'linecon-icon-tag',

      'linecon-icon-camera' => 'linecon-icon-camera',

      'linecon-icon-settings' => 'linecon-icon-settings'

  );





  $moon = array(

                "moon-home" => "moon-home",

                "moon-home-2" => "moon-home-2",

                "moon-home-3" => "moon-home-3",

                "moon-home-4" => "moon-home-4",

                "moon-home-5" => "moon-home-5",

                "moon-home-6" => "moon-home-6",

                "moon-home-7" => "moon-home-7",

                "moon-home-8" => "moon-home-8",

                "moon-home-9" => "moon-home-9",

                "moon-home-10" => "moon-home-10",

                "moon-home-11" => "moon-home-11",

                "moon-office" => "moon-office",

                "moon-newspaper" => "moon-newspaper",

                "moon-pencil" => "moon-pencil",

                "moon-pencil-2" => "moon-pencil-2",

                "moon-pencil-3" => "moon-pencil-3",

                "moon-pencil-4" => "moon-pencil-4",

                "moon-pencil-5" => "moon-pencil-5",

                "moon-pencil-6" => "moon-pencil-6",

                "moon-quill" => "moon-quill",

                "moon-quill-2" => "moon-quill-2",

                "moon-quill-3" => "moon-quill-3",

                "moon-pen" => "moon-pen",

                "moon-pen-2" => "moon-pen-2",

                "moon-pen-3" => "moon-pen-3",

                "moon-pen-4" => "moon-pen-4",

                "moon-pen-5" => "moon-pen-5",

                "moon-marker" => "moon-marker",

                "moon-home-12" => "moon-home-12",

                "moon-marker-2" => "moon-marker-2",

                "moon-blog" => "moon-blog",

                "moon-blog-2" => "moon-blog-2",

                "moon-brush" => "moon-brush",

                "moon-palette" => "moon-palette",

                "moon-palette-2" => "moon-palette-2",

                "moon-eyedropper" => "moon-eyedropper",

                "moon-eyedropper-2" => "moon-eyedropper-2",

                "moon-droplet" => "moon-droplet",

                "moon-droplet-2" => "moon-droplet-2",

                "moon-droplet-3" => "moon-droplet-3",

                "moon-droplet-4" => "moon-droplet-4",

                "moon-paint-format" => "moon-paint-format",

                "moon-paint-format-2" => "moon-paint-format-2",

                "moon-image" => "moon-image",

                "moon-image-2" => "moon-image-2",

                "moon-image-3" => "moon-image-3",

                "moon-images" => "moon-images",

                "moon-image-4" => "moon-image-4",

                "moon-image-5" => "moon-image-5",

                "moon-image-6" => "moon-image-6",

                "moon-images-2" => "moon-images-2",

                "moon-image-7" => "moon-image-7",

                "moon-camera" => "moon-camera",

                "moon-camera-2" => "moon-camera-2",

                "moon-camera-3" => "moon-camera-3",

                "moon-camera-4" => "moon-camera-4",

                "moon-music" => "moon-music",

                "moon-music-2" => "moon-music-2",

                "moon-music-3" => "moon-music-3",

                "moon-music-4" => "moon-music-4",

                "moon-music-5" => "moon-music-5",

                "moon-music-6" => "moon-music-6",

                "moon-piano" => "moon-piano",

                "moon-guitar" => "moon-guitar",

                "moon-headphones" => "moon-headphones",

                "moon-headphones-2" => "moon-headphones-2",

                "moon-play" => "moon-play",

                "moon-play-2" => "moon-play-2",

                "moon-movie" => "moon-movie",

                "moon-movie-2" => "moon-movie-2",

                "moon-movie-3" => "moon-movie-3",

                "moon-film" => "moon-film",

                "moon-film-2" => "moon-film-2",

                "moon-film-3" => "moon-film-3",

                "moon-film-4" => "moon-film-4",

                "moon-camera-5" => "moon-camera-5",

                "moon-camera-6" => "moon-camera-6",

                "moon-camera-7" => "moon-camera-7",

                "moon-camera-8" => "moon-camera-8",

                "moon-camera-9" => "moon-camera-9",

                "moon-dice" => "moon-dice",

                "moon-gamepad" => "moon-gamepad",

                "moon-gamepad-2" => "moon-gamepad-2",

                "moon-gamepad-3" => "moon-gamepad-3",

                "moon-pacman" => "moon-pacman",

                "moon-spades" => "moon-spades",

                "moon-clubs" => "moon-clubs",

                "moon-diamonds" => "moon-diamonds",

                "moon-king" => "moon-king",

                "moon-queen" => "moon-queen",

                "moon-rock" => "moon-rock",

                "moon-bishop" => "moon-bishop",

                "moon-knight" => "moon-knight",

                "moon-pawn" => "moon-pawn",

                "moon-chess" => "moon-chess",

                "moon-bullhorn" => "moon-bullhorn",

                "moon-megaphone" => "moon-megaphone",

                "moon-new" => "moon-new",

                "moon-connection" => "moon-connection",

                "moon-connection-2" => "moon-connection-2",

                "moon-podcast" => "moon-podcast",

                "moon-radio" => "moon-radio",

                "moon-feed" => "moon-feed",

                "moon-connection-3" => "moon-connection-3",

                "moon-radio-2" => "moon-radio-2",

                "moon-podcast-2" => "moon-podcast-2",

                "moon-podcast-3" => "moon-podcast-3",

                "moon-mic" => "moon-mic",

                "moon-mic-2" => "moon-mic-2",

                "moon-mic-3" => "moon-mic-3",

                "moon-mic-4" => "moon-mic-4",

                "moon-mic-5" => "moon-mic-5",

                "moon-book" => "moon-book",

                "moon-book-2" => "moon-book-2",

                "moon-books" => "moon-books",

                "moon-reading" => "moon-reading",

                "moon-library" => "moon-library",

                "moon-library-2" => "moon-library-2",

                "moon-graduation" => "moon-graduation",

                "moon-file" => "moon-file",

                "moon-profile" => "moon-profile",

                "moon-file-2" => "moon-file-2",

                "moon-file-3" => "moon-file-3",

                "moon-file-4" => "moon-file-4",

                "moon-file-5" => "moon-file-5",

                "moon-file-6" => "moon-file-6",

                "moon-files" => "moon-files",

                "moon-file-plus" => "moon-file-plus",

                "moon-file-minus" => "moon-file-minus",

                "moon-file-download" => "moon-file-download",

                "moon-file-upload" => "moon-file-upload",

                "moon-file-check" => "moon-file-check",

                "moon-file-remove" => "moon-file-remove",

                "moon-file-7" => "moon-file-7",

                "moon-file-8" => "moon-file-8",

                "moon-file-plus-2" => "moon-file-plus-2",

                "moon-file-minus-2" => "moon-file-minus-2",

                "moon-file-download-2" => "moon-file-download-2",

                "moon-file-upload-2" => "moon-file-upload-2",

                "moon-file-check-2" => "moon-file-check-2",

                "moon-file-remove-2" => "moon-file-remove-2",

                "moon-file-9" => "moon-file-9",

                "moon-copy" => "moon-copy",

                "moon-copy-2" => "moon-copy-2",

                "moon-copy-3" => "moon-copy-3",

                "moon-copy-4" => "moon-copy-4",

                "moon-paste" => "moon-paste",

                "moon-paste-2" => "moon-paste-2",

                "moon-paste-3" => "moon-paste-3",

                "moon-stack" => "moon-stack",

                "moon-stack-2" => "moon-stack-2",

                "moon-stack-3" => "moon-stack-3",

                "moon-folder" => "moon-folder",

                "moon-folder-download" => "moon-folder-download",

                "moon-folder-upload" => "moon-folder-upload",

                "moon-folder-plus" => "moon-folder-plus",

                "moon-folder-plus-2" => "moon-folder-plus-2",

                "moon-folder-minus" => "moon-folder-minus",

                "moon-folder-minus-2" => "moon-folder-minus-2",

                "moon-folder8" => "moon-folder8",

                "moon-folder-remove" => "moon-folder-remove",

                "moon-folder-2" => "moon-folder-2",

                "moon-folder-open" => "moon-folder-open",

                "moon-folder-3" => "moon-folder-3",

                "moon-folder-4" => "moon-folder-4",

                "moon-folder-plus-3" => "moon-folder-plus-3",

                "moon-folder-minus-3" => "moon-folder-minus-3",

                "moon-folder-plus-4" => "moon-folder-plus-4",

                "moon-folder-remove-2" => "moon-folder-remove-2",

                "moon-folder-download-2" => "moon-folder-download-2",

                "moon-folder-upload-2" => "moon-folder-upload-2",

                "moon-folder-download-3" => "moon-folder-download-3",

                "moon-folder-upload-3" => "moon-folder-upload-3",

                "moon-folder-5" => "moon-folder-5",

                "moon-folder-open-2" => "moon-folder-open-2",

                "moon-folder-6" => "moon-folder-6",

                "moon-folder-open-3" => "moon-folder-open-3",

                "moon-certificate" => "moon-certificate",

                "moon-cc" => "moon-cc",

                "moon-tag" => "moon-tag",

                "moon-tag-2" => "moon-tag-2",

                "moon-tag-3" => "moon-tag-3",

                "moon-tag-4" => "moon-tag-4",

                "moon-tag-5" => "moon-tag-5",

                "moon-tag-6" => "moon-tag-6",

                "moon-tag-7" => "moon-tag-7",

                "moon-tags" => "moon-tags",

                "moon-tags-2" => "moon-tags-2",

                "moon-tag-8" => "moon-tag-8",

                "moon-barcode" => "moon-barcode",

                "moon-barcode-2" => "moon-barcode-2",

                "moon-qrcode" => "moon-qrcode",

                "moon-ticket" => "moon-ticket",

                "moon-cart" => "moon-cart",

                "moon-cart-2" => "moon-cart-2",

                "moon-cart-3" => "moon-cart-3",

                "moon-cart-4" => "moon-cart-4",

                "moon-cart-5" => "moon-cart-5",

                "moon-cart-6" => "moon-cart-6",

                "moon-cart-7" => "moon-cart-7",

                "moon-cart-plus" => "moon-cart-plus",

                "moon-cart-minus" => "moon-cart-minus",

                "moon-cart-add" => "moon-cart-add",

                "moon-cart-remove" => "moon-cart-remove",

                "moon-cart-checkout" => "moon-cart-checkout",

                "moon-cart-remove-2" => "moon-cart-remove-2",

                "moon-basket" => "moon-basket",

                "moon-basket-2" => "moon-basket-2",

                "moon-bag" => "moon-bag",

                "moon-bag-2" => "moon-bag-2",

                "moon-bag-3" => "moon-bag-3",

                "moon-coin" => "moon-coin",

                "moon-coins" => "moon-coins",

                "moon-credit" => "moon-credit",

                "moon-credit-2" => "moon-credit-2",

                "moon-calculate" => "moon-calculate",

                "moon-calculate-2" => "moon-calculate-2",

                "moon-support" => "moon-support",

                "moon-phone" => "moon-phone",

                "moon-phone-2" => "moon-phone-2",

                "moon-phone-3" => "moon-phone-3",

                "moon-phone-4" => "moon-phone-4",

                "moon-contact-add" => "moon-contact-add",

                "moon-contact-remove" => "moon-contact-remove",

                "moon-contact-add-2" => "moon-contact-add-2",

                "moon-contact-remove-2" => "moon-contact-remove-2",

                "moon-call-incoming" => "moon-call-incoming",

                "moon-call-outgoing" => "moon-call-outgoing",

                "moon-phone-5" => "moon-phone-5",

                "moon-phone-6" => "moon-phone-6",

                "moon-phone-hang-up" => "moon-phone-hang-up",

                "moon-phone-hang-up-2" => "moon-phone-hang-up-2",

                "moon-address-book" => "moon-address-book",

                "moon-address-book-2" => "moon-address-book-2",

                "moon-notebook" => "moon-notebook",

                "moon-envelop" => "moon-envelop",

                "moon-envelop-2" => "moon-envelop-2",

                "moon-mail-send" => "moon-mail-send",

                "moon-envelop-opened" => "moon-envelop-opened",

                "moon-envelop-3" => "moon-envelop-3",

                "moon-pushpin" => "moon-pushpin",

                "moon-location" => "moon-location",

                "moon-location-2" => "moon-location-2",

                "moon-location-3" => "moon-location-3",

                "moon-location-4" => "moon-location-4",

                "moon-location-5" => "moon-location-5",

                "moon-location-6" => "moon-location-6",

                "moon-location-7" => "moon-location-7",

                "moon-compass" => "moon-compass",

                "moon-compass-2" => "moon-compass-2",

                "moon-map" => "moon-map",

                "moon-map-2" => "moon-map-2",

                "moon-map-3" => "moon-map-3",

                "moon-map-4" => "moon-map-4",

                "moon-direction" => "moon-direction",

                "moon-history" => "moon-history",

                "moon-history-2" => "moon-history-2",

                "moon-clock" => "moon-clock",

                "moon-clock-2" => "moon-clock-2",

                "moon-clock-3" => "moon-clock-3",

                "moon-clock-4" => "moon-clock-4",

                "moon-watch" => "moon-watch",

                "moon-clock-5" => "moon-clock-5",

                "moon-clock-6" => "moon-clock-6",

                "moon-clock-7" => "moon-clock-7",

                "moon-alarm" => "moon-alarm",

                "moon-alarm-2" => "moon-alarm-2",

                "moon-bell" => "moon-bell",

                "moon-bell-2" => "moon-bell-2",

                "moon-alarm-plus" => "moon-alarm-plus",

                "moon-alarm-minus" => "moon-alarm-minus",

                "moon-alarm-check" => "moon-alarm-check",

                "moon-alarm-cancel" => "moon-alarm-cancel",

                "moon-stopwatch" => "moon-stopwatch",

                "moon-calendar" => "moon-calendar",

                "moon-calendar-2" => "moon-calendar-2",

                "moon-calendar-3" => "moon-calendar-3",

                "moon-calendar-4" => "moon-calendar-4",

                "moon-calendar-5" => "moon-calendar-5",

                "moon-print" => "moon-print",

                "moon-print-2" => "moon-print-2",

                "moon-print-3" => "moon-print-3",

                "moon-mouse" => "moon-mouse",

                "moon-mouse-2" => "moon-mouse-2",

                "moon-mouse-3" => "moon-mouse-3",

                "moon-mouse-4" => "moon-mouse-4",

                "moon-keyboard" => "moon-keyboard",

                "moon-keyboard-2" => "moon-keyboard-2",

                "moon-screen" => "moon-screen",

                "moon-screen-2" => "moon-screen-2",

                "moon-screen-3" => "moon-screen-3",

                "moon-screen-4" => "moon-screen-4",

                "moon-laptop" => "moon-laptop",

                "moon-mobile" => "moon-mobile",

                "moon-mobile-2" => "moon-mobile-2",

                "moon-tablet" => "moon-tablet",

                "moon-mobile-3" => "moon-mobile-3",

                "moon-tv" => "moon-tv",

                "moon-cabinet" => "moon-cabinet",

                "moon-archive" => "moon-archive",

                "moon-drawer" => "moon-drawer",

                "moon-drawer-2" => "moon-drawer-2",

                "moon-drawer-3" => "moon-drawer-3",

                "moon-box" => "moon-box",

                "moon-box-add" => "moon-box-add",

                "moon-box-remove" => "moon-box-remove",

                "moon-download" => "moon-download",

                "moon-upload" => "moon-upload",

                "moon-disk" => "moon-disk",

                "moon-cd" => "moon-cd",

                "moon-storage" => "moon-storage",

                "moon-storage-2" => "moon-storage-2",

                "moon-database" => "moon-database",

                "moon-database-2" => "moon-database-2",

                "moon-database-3" => "moon-database-3",

                "moon-undo" => "moon-undo",

                "moon-redo" => "moon-redo",

                "moon-rotate" => "moon-rotate",

                "moon-rotate-2" => "moon-rotate-2",

                "moon-flip" => "moon-flip",

                "moon-flip-2" => "moon-flip-2",

                "moon-unite" => "moon-unite",

                "moon-subtract" => "moon-subtract",

                "moon-interset" => "moon-interset",

                "moon-exclude" => "moon-exclude",

                "moon-align-left" => "moon-align-left",

                "moon-align-center-horizontal" => "moon-align-center-horizontal",

                "moon-align-right" => "moon-align-right",

                "moon-align-top" => "moon-align-top",

                "moon-align-center-vertical" => "moon-align-center-vertical",

                "moon-align-bottom" => "moon-align-bottom",

                "moon-undo-2" => "moon-undo-2",

                "moon-redo-2" => "moon-redo-2",

                "moon-forward" => "moon-forward",

                "moon-reply" => "moon-reply",

                "moon-reply-2" => "moon-reply-2",

                "moon-bubble" => "moon-bubble",

                "moon-bubbles" => "moon-bubbles",

                "moon-bubbles-2" => "moon-bubbles-2",

                "moon-bubble-2" => "moon-bubble-2",

                "moon-bubbles-3" => "moon-bubbles-3",

                "moon-bubbles-4" => "moon-bubbles-4",

                "moon-bubble-notification" => "moon-bubble-notification",

                "moon-bubbles-5" => "moon-bubbles-5",

                "moon-bubbles-6" => "moon-bubbles-6",

                "moon-bubble-3" => "moon-bubble-3",

                "moon-bubble-dots" => "moon-bubble-dots",

                "moon-bubble-4" => "moon-bubble-4",

                "moon-bubble-5" => "moon-bubble-5",

                "moon-bubble-dots-2" => "moon-bubble-dots-2",

                "moon-bubble-6" => "moon-bubble-6",

                "moon-bubble-7" => "moon-bubble-7",

                "moon-bubble-8" => "moon-bubble-8",

                "moon-bubbles-7" => "moon-bubbles-7",

                "moon-bubble-9" => "moon-bubble-9",

                "moon-bubbles-8" => "moon-bubbles-8",

                "moon-bubble-10" => "moon-bubble-10",

                "moon-bubble-dots-3" => "moon-bubble-dots-3",

                "moon-bubble-11" => "moon-bubble-11",

                "moon-bubble-12" => "moon-bubble-12",

                "moon-bubble-dots-4" => "moon-bubble-dots-4",

                "moon-bubble-13" => "moon-bubble-13",

                "moon-bubbles-9" => "moon-bubbles-9",

                "moon-bubbles-10" => "moon-bubbles-10",

                "moon-bubble-blocked" => "moon-bubble-blocked",

                "moon-bubble-quote" => "moon-bubble-quote",

                "moon-bubble-user" => "moon-bubble-user",

                "moon-bubble-check" => "moon-bubble-check",

                "moon-bubble-video-chat" => "moon-bubble-video-chat",

                "moon-bubble-link" => "moon-bubble-link",

                "moon-bubble-locked" => "moon-bubble-locked",

                "moon-bubble-star" => "moon-bubble-star",

                "moon-bubble-heart" => "moon-bubble-heart",

                "moon-bubble-paperclip" => "moon-bubble-paperclip",

                "moon-bubble-cancel" => "moon-bubble-cancel",

                "moon-bubble-plus" => "moon-bubble-plus",

                "moon-bubble-minus" => "moon-bubble-minus",

                "moon-bubble-notification-2" => "moon-bubble-notification-2",

                "moon-bubble-trash" => "moon-bubble-trash",

                "moon-bubble-left" => "moon-bubble-left",

                "moon-bubble-right" => "moon-bubble-right",

                "moon-bubble-up" => "moon-bubble-up",

                "moon-bubble-down" => "moon-bubble-down",

                "moon-bubble-first" => "moon-bubble-first",

                "moon-bubble-last" => "moon-bubble-last",

                "moon-bubble-replu" => "moon-bubble-replu",

                "moon-bubble-forward" => "moon-bubble-forward",

                "moon-bubble-reply" => "moon-bubble-reply",

                "moon-bubble-forward-2" => "moon-bubble-forward-2",

                "moon-user" => "moon-user",

                "moon-users" => "moon-users",

                "moon-user-plus" => "moon-user-plus",

                "moon-user-plus-2" => "moon-user-plus-2",

                "moon-user-minus" => "moon-user-minus",

                "moon-user-minus-2" => "moon-user-minus-2",

                "moon-user-cancel" => "moon-user-cancel",

                "moon-user-block" => "moon-user-block",

                "moon-users-2" => "moon-users-2",

                "moon-user-2" => "moon-user-2",

                "moon-users-3" => "moon-users-3",

                "moon-user-plus-3" => "moon-user-plus-3",

                "moon-user-minus-3" => "moon-user-minus-3",

                "moon-user-cancel-2" => "moon-user-cancel-2",

                "moon-user-block-2" => "moon-user-block-2",

                "moon-user-3" => "moon-user-3",

                "moon-user-4" => "moon-user-4",

                "moon-user-5" => "moon-user-5",

                "moon-user-6" => "moon-user-6",

                "moon-users-4" => "moon-users-4",

                "moon-user-7" => "moon-user-7",

                "moon-user-8" => "moon-user-8",

                "moon-users-5" => "moon-users-5",

                "moon-vcard" => "moon-vcard",

                "moon-tshirt" => "moon-tshirt",

                "moon-hanger" => "moon-hanger",

                "moon-quotes-left" => "moon-quotes-left",

                "moon-quotes-right" => "moon-quotes-right",

                "moon-quotes-right-2" => "moon-quotes-right-2",

                "moon-quotes-right-3" => "moon-quotes-right-3",

                "moon-busy" => "moon-busy",

                "moon-busy-2" => "moon-busy-2",

                "moon-busy-3" => "moon-busy-3",

                "moon-busy-4" => "moon-busy-4",

                "moon-spinner" => "moon-spinner",

                "moon-spinner-2" => "moon-spinner-2",

                "moon-spinner-3" => "moon-spinner-3",

                "moon-spinner-4" => "moon-spinner-4",

                "moon-spinner-5" => "moon-spinner-5",

                "moon-spinner-6" => "moon-spinner-6",

                "moon-spinner-7" => "moon-spinner-7",

                "moon-spinner-8" => "moon-spinner-8",

                "moon-spinner-9" => "moon-spinner-9",

                "moon-spinner-10" => "moon-spinner-10",

                "moon-spinner-11" => "moon-spinner-11",

                "moon-spinner-12" => "moon-spinner-12",

                "moon-microscope" => "moon-microscope",

                "moon-binoculars" => "moon-binoculars",

                "moon-binoculars-2" => "moon-binoculars-2",

                "moon-search" => "moon-search",

                "moon-search-2" => "moon-search-2",

                "moon-zoom-in" => "moon-zoom-in",

                "moon-zoom-out" => "moon-zoom-out",

                "moon-search-3" => "moon-search-3",

                "moon-search-4" => "moon-search-4",

                "moon-zoom-in-2" => "moon-zoom-in-2",

                "moon-zoom-out-2" => "moon-zoom-out-2",

                "moon-search-5" => "moon-search-5",

                "moon-expand" => "moon-expand",

                "moon-contract" => "moon-contract",

                "moon-scale-up" => "moon-scale-up",

                "moon-scale-down" => "moon-scale-down",

                "moon-expand-2" => "moon-expand-2",

                "moon-contract-2" => "moon-contract-2",

                "moon-scale-up-2" => "moon-scale-up-2",

                "moon-scale-down-2" => "moon-scale-down-2",

                "moon-fullscreen" => "moon-fullscreen",

                "moon-expand-3" => "moon-expand-3",

                "moon-contract-3" => "moon-contract-3",

                "moon-key" => "moon-key",

                "moon-key-2" => "moon-key-2",

                "moon-key-3" => "moon-key-3",

                "moon-key-4" => "moon-key-4",

                "moon-key-5" => "moon-key-5",

                "moon-keyhole" => "moon-keyhole",

                "moon-lock" => "moon-lock",

                "moon-lock-2" => "moon-lock-2",

                "moon-lock-3" => "moon-lock-3",

                "moon-lock-4" => "moon-lock-4",

                "moon-unlocked" => "moon-unlocked",

                "moon-lock-5" => "moon-lock-5",

                "moon-unlocked-2" => "moon-unlocked-2",

                "moon-wrench" => "moon-wrench",

                "moon-wrench-2" => "moon-wrench-2",

                "moon-wrench-3" => "moon-wrench-3",

                "moon-wrench-4" => "moon-wrench-4",

                "moon-settings" => "moon-settings",

                "moon-equalizer" => "moon-equalizer",

                "moon-equalizer-2" => "moon-equalizer-2",

                "moon-equalizer-3" => "moon-equalizer-3",

                "moon-cog" => "moon-cog",

                "moon-cogs" => "moon-cogs",

                "moon-cog-2" => "moon-cog-2",

                "moon-cog-3" => "moon-cog-3",

                "moon-cog-4" => "moon-cog-4",

                "moon-cog-5" => "moon-cog-5",

                "moon-cog-6" => "moon-cog-6",

                "moon-cog-7" => "moon-cog-7",

                "moon-factory" => "moon-factory",

                "moon-hammer" => "moon-hammer",

                "moon-tools" => "moon-tools",

                "moon-screwdriver" => "moon-screwdriver",

                "moon-screwdriver-2" => "moon-screwdriver-2",

                "moon-wand" => "moon-wand",

                "moon-wand-2" => "moon-wand-2",

                "moon-health" => "moon-health",

                "moon-aid" => "moon-aid",

                "moon-patch" => "moon-patch",

                "moon-bug" => "moon-bug",

                "moon-bug-2" => "moon-bug-2",

                "moon-inject" => "moon-inject",

                "moon-inject-2" => "moon-inject-2",

                "moon-construction" => "moon-construction",

                "moon-cone" => "moon-cone",

                "moon-pie" => "moon-pie",

                "moon-pie-2" => "moon-pie-2",

                "moon-pie-3" => "moon-pie-3",

                "moon-pie-4" => "moon-pie-4",

                "moon-pie-5" => "moon-pie-5",

                "moon-pie-6" => "moon-pie-6",

                "moon-pie-7" => "moon-pie-7",

                "moon-stats" => "moon-stats",

                "moon-stats-2" => "moon-stats-2",

                "moon-stats-3" => "moon-stats-3",

                "moon-bars" => "moon-bars",

                "moon-bars-2" => "moon-bars-2",

                "moon-bars-3" => "moon-bars-3",

                "moon-bars-4" => "moon-bars-4",

                "moon-bars-5" => "moon-bars-5",

                "moon-bars-6" => "moon-bars-6",

                "moon-stats-up" => "moon-stats-up",

                "moon-stats-down" => "moon-stats-down",

                "moon-stairs-down" => "moon-stairs-down",

                "moon-stairs-down-2" => "moon-stairs-down-2",

                "moon-chart" => "moon-chart",

                "moon-stairs" => "moon-stairs",

                "moon-stairs-2" => "moon-stairs-2",

                "moon-ladder" => "moon-ladder",

                "moon-cake" => "moon-cake",

                "moon-gift" => "moon-gift",

                "moon-gift-2" => "moon-gift-2",

                "moon-balloon" => "moon-balloon",

                "moon-rating" => "moon-rating",

                "moon-rating-2" => "moon-rating-2",

                "moon-rating-3" => "moon-rating-3",

                "moon-podium" => "moon-podium",

                "moon-medal" => "moon-medal",

                "moon-medal-2" => "moon-medal-2",

                "moon-medal-3" => "moon-medal-3",

                "moon-medal-4" => "moon-medal-4",

                "moon-medal-5" => "moon-medal-5",

                "moon-crown" => "moon-crown",

                "moon-trophy" => "moon-trophy",

                "moon-trophy-2" => "moon-trophy-2",

                "moon-trophy-star" => "moon-trophy-star",

                "moon-diamond" => "moon-diamond",

                "moon-diamond-2" => "moon-diamond-2",

                "moon-glass" => "moon-glass",

                "moon-glass-2" => "moon-glass-2",

                "moon-bottle" => "moon-bottle",

                "moon-bottle-2" => "moon-bottle-2",

                "moon-mug" => "moon-mug",

                "moon-food" => "moon-food",

                "moon-food-2" => "moon-food-2",

                "moon-hamburger" => "moon-hamburger",

                "moon-cup" => "moon-cup",

                "moon-cup-2" => "moon-cup-2",

                "moon-leaf" => "moon-leaf",

                "moon-leaf-2" => "moon-leaf-2",

                "moon-apple-fruit" => "moon-apple-fruit",

                "moon-tree" => "moon-tree",

                "moon-tree-2" => "moon-tree-2",

                "moon-paw" => "moon-paw",

                "moon-steps" => "moon-steps",

                "moon-flower" => "moon-flower",

                "moon-rocket" => "moon-rocket",

                "moon-meter" => "moon-meter",

                "moon-meter2" => "moon-meter2",

                "moon-meter-slow" => "moon-meter-slow",

                "moon-meter-medium" => "moon-meter-medium",

                "moon-meter-fast" => "moon-meter-fast",

                "moon-dashboard" => "moon-dashboard",

                "moon-hammer-2" => "moon-hammer-2",

                "moon-balance" => "moon-balance",

                "moon-bomb" => "moon-bomb",

                "moon-fire" => "moon-fire",

                "moon-fire-2" => "moon-fire-2",

                "moon-lab" => "moon-lab",

                "moon-atom" => "moon-atom",

                "moon-atom-2" => "moon-atom-2",

                "moon-magnet" => "moon-magnet",

                "moon-magnet-2" => "moon-magnet-2",

                "moon-magnet-3" => "moon-magnet-3",

                "moon-magnet-4" => "moon-magnet-4",

                "moon-dumbbell" => "moon-dumbbell",

                "moon-skull" => "moon-skull",

                "moon-skull-2" => "moon-skull-2",

                "moon-skull-3" => "moon-skull-3",

                "moon-lamp" => "moon-lamp",

                "moon-lamp-2" => "moon-lamp-2",

                "moon-lamp-3" => "moon-lamp-3",

                "moon-lamp-4" => "moon-lamp-4",

                "moon-remove" => "moon-remove",

                "moon-remove-2" => "moon-remove-2",

                "moon-remove-3" => "moon-remove-3",

                "moon-remove-4" => "moon-remove-4",

                "moon-remove-5" => "moon-remove-5",

                "moon-remove-6" => "moon-remove-6",

                "moon-remove-7" => "moon-remove-7",

                "moon-remove-8" => "moon-remove-8",

                "moon-briefcase" => "moon-briefcase",

                "moon-briefcase-2" => "moon-briefcase-2",

                "moon-briefcase-3" => "moon-briefcase-3",

                "moon-airplane" => "moon-airplane",

                "moon-airplane-2" => "moon-airplane-2",

                "moon-paper-plane" => "moon-paper-plane",

                "moon-car" => "moon-car",

                "moon-gas-pump" => "moon-gas-pump",

                "moon-bus" => "moon-bus",

                "moon-truck" => "moon-truck",

                "moon-bike" => "moon-bike",

                "moon-road" => "moon-road",

                "moon-train" => "moon-train",

                "moon-ship" => "moon-ship",

                "moon-boat" => "moon-boat",

                "moon-cube" => "moon-cube",

                "moon-cube-2" => "moon-cube-2",

                "moon-cube-3" => "moon-cube-3",

                "moon-cube4" => "moon-cube4",

                "moon-pyramid" => "moon-pyramid",

                "moon-pyramid-2" => "moon-pyramid-2",

                "moon-cylinder" => "moon-cylinder",

                "moon-package" => "moon-package",

                "moon-puzzle" => "moon-puzzle",

                "moon-puzzle-2" => "moon-puzzle-2",

                "moon-puzzle-3" => "moon-puzzle-3",

                "moon-puzzle-4" => "moon-puzzle-4",

                "moon-glasses" => "moon-glasses",

                "moon-glasses-2" => "moon-glasses-2",

                "moon-glasses-3" => "moon-glasses-3",

                "moon-sun-glasses" => "moon-sun-glasses",

                "moon-accessibility" => "moon-accessibility",

                "moon-accessibility-2" => "moon-accessibility-2",

                "moon-brain" => "moon-brain",

                "moon-target" => "moon-target",

                "moon-target-2" => "moon-target-2",

                "moon-target-3" => "moon-target-3",

                "moon-gun" => "moon-gun",

                "moon-gun-ban" => "moon-gun-ban",

                "moon-shield" => "moon-shield",

                "moon-shield-2" => "moon-shield-2",

                "moon-shield-3" => "moon-shield-3",

                "moon-shield-4" => "moon-shield-4",

                "moon-soccer" => "moon-soccer",

                "moon-football" => "moon-football",

                "moon-baseball" => "moon-baseball",

                "moon-basketball" => "moon-basketball",

                "moon-golf" => "moon-golf",

                "moon-hockey" => "moon-hockey",

                "moon-racing" => "moon-racing",

                "moon-eight-ball" => "moon-eight-ball",

                "moon-bowling-ball" => "moon-bowling-ball",

                "moon-bowling" => "moon-bowling",

                "moon-bowling-2" => "moon-bowling-2",

                "moon-lightning" => "moon-lightning",

                "moon-power" => "moon-power",

                "moon-power-2" => "moon-power-2",

                "moon-switch" => "moon-switch",

                "moon-power-cord" => "moon-power-cord",

                "moon-cord" => "moon-cord",

                "moon-socket" => "moon-socket",

                "moon-clipboard" => "moon-clipboard",

                "moon-clipboard-2" => "moon-clipboard-2",

                "moon-signup" => "moon-signup",

                "moon-clipboard-3" => "moon-clipboard-3",

                "moon-clipboard-4" => "moon-clipboard-4",

                "moon-list" => "moon-list",

                "moon-list-2" => "moon-list-2",

                "moon-list-3" => "moon-list-3",

                "moon-numbered-list" => "moon-numbered-list",

                "moon-list-4" => "moon-list-4",

                "moon-list-5" => "moon-list-5",

                "moon-playlist" => "moon-playlist",

                "moon-grid" => "moon-grid",

                "moon-grid-2" => "moon-grid-2",

                "moon-grid-3" => "moon-grid-3",

                "moon-grid-4" => "moon-grid-4",

                "moon-grid-5" => "moon-grid-5",

                "moon-grid-6" => "moon-grid-6",

                "moon-tree-3" => "moon-tree-3",

                "moon-tree-4" => "moon-tree-4",

                "moon-tree-5" => "moon-tree-5",

                "moon-menu" => "moon-menu",

                "moon-menu-2" => "moon-menu-2",

                "moon-circle-small" => "moon-circle-small",

                "moon-menu-3" => "moon-menu-3",

                "moon-menu-4" => "moon-menu-4",

                "moon-menu-5" => "moon-menu-5",

                "moon-menu-6" => "moon-menu-6",

                "moon-menu-7" => "moon-menu-7",

                "moon-menu-8" => "moon-menu-8",

                "moon-menu-9" => "moon-menu-9",

                "moon-cloud" => "moon-cloud",

                "moon-cloud-2" => "moon-cloud-2",

                "moon-cloud-3" => "moon-cloud-3",

                "moon-cloud-download" => "moon-cloud-download",

                "moon-cloud-upload" => "moon-cloud-upload",

                "moon-download-2" => "moon-download-2",

                "moon-upload-2" => "moon-upload-2",

                "moon-download-3" => "moon-download-3",

                "moon-upload-3" => "moon-upload-3",

                "moon-download-4" => "moon-download-4",

                "moon-upload-4" => "moon-upload-4",

                "moon-download-5" => "moon-download-5",

                "moon-upload-5" => "moon-upload-5",

                "moon-download-6" => "moon-download-6",

                "moon-upload-6" => "moon-upload-6",

                "moon-download-7" => "moon-download-7",

                "moon-upload-7" => "moon-upload-7",

                "moon-globe" => "moon-globe",

                "moon-globe-2" => "moon-globe-2",

                "moon-globe-3" => "moon-globe-3",

                "moon-earth" => "moon-earth",

                "moon-network" => "moon-network",

                "moon-link" => "moon-link",

                "moon-link-2" => "moon-link-2",

                "moon-link-3" => "moon-link-3",

                "moon-link2" => "moon-link2",

                "moon-link-4" => "moon-link-4",

                "moon-link-5" => "moon-link-5",

                "moon-link-6" => "moon-link-6",

                "moon-anchor" => "moon-anchor",

                "moon-flag" => "moon-flag",

                "moon-flag-2" => "moon-flag-2",

                "moon-flag-3" => "moon-flag-3",

                "moon-flag-4" => "moon-flag-4",

                "moon-flag-5" => "moon-flag-5",

                "moon-flag-6" => "moon-flag-6",

                "moon-attachment" => "moon-attachment",

                "moon-attachment-2" => "moon-attachment-2",

                "moon-eye" => "moon-eye",

                "moon-eye-blocked" => "moon-eye-blocked",

                "moon-eye-2" => "moon-eye-2",

                "moon-eye-3" => "moon-eye-3",

                "moon-eye-blocked-2" => "moon-eye-blocked-2",

                "moon-eye-4" => "moon-eye-4",

                "moon-eye-5" => "moon-eye-5",

                "moon-eye-6" => "moon-eye-6",

                "moon-eye-7" => "moon-eye-7",

                "moon-eye-8" => "moon-eye-8",

                "moon-bookmark" => "moon-bookmark",

                "moon-bookmark-2" => "moon-bookmark-2",

                "moon-bookmarks" => "moon-bookmarks",

                "moon-bookmark-3" => "moon-bookmark-3",

                "moon-spotlight" => "moon-spotlight",

                "moon-starburst" => "moon-starburst",

                "moon-snowflake" => "moon-snowflake",

                "moon-temperature" => "moon-temperature",

                "moon-temperature-2" => "moon-temperature-2",

                "moon-weather-lightning" => "moon-weather-lightning",

                "moon-weather-rain" => "moon-weather-rain",

                "moon-weather-snow" => "moon-weather-snow",

                "moon-windy" => "moon-windy",

                "moon-fan" => "moon-fan",

                "moon-umbrella" => "moon-umbrella",

                "moon-sun" => "moon-sun",

                "moon-sun-2" => "moon-sun-2",

                "moon-brightness-high" => "moon-brightness-high",

                "moon-brightness-medium" => "moon-brightness-medium",

                "moon-brightness-low" => "moon-brightness-low",

                "moon-brightness-contrast" => "moon-brightness-contrast",

                "moon-contrast" => "moon-contrast",



                "moon-bed" => "moon-bed",

                "moon-bed-2" => "moon-bed-2",

                "moon-star" => "moon-star",

                "moon-star-2" => "moon-star-2",

                "moon-star-3" => "moon-star-3",

                "moon-star-4" => "moon-star-4",

                "moon-star-5" => "moon-star-5",

                "moon-star-6" => "moon-star-6",

                "moon-heart" => "moon-heart",

                "moon-heart-2" => "moon-heart-2",

                "moon-heart-3" => "moon-heart-3",

                "moon-heart-4" => "moon-heart-4",

                "moon-heart-broken" => "moon-heart-broken",

                "moon-heart-5" => "moon-heart-5",

                "moon-heart-6" => "moon-heart-6",

                "moon-heart-broken-2" => "moon-heart-broken-2",

                "moon-heart-7" => "moon-heart-7",

                "moon-heart-8" => "moon-heart-8",

                "moon-heart-broken-3" => "moon-heart-broken-3",

                "moon-lips" => "moon-lips",

                "moon-lips-2" => "moon-lips-2",

                "moon-thumbs-up" => "moon-thumbs-up",

                "moon-thumbs-up-2" => "moon-thumbs-up-2",

                "moon-thumbs-down" => "moon-thumbs-down",

                "moon-thumbs-down-2" => "moon-thumbs-down-2",

                "moon-thumbs-up-3" => "moon-thumbs-up-3",

                "moon-thumbs-up-4" => "moon-thumbs-up-4",

                "moon-thumbs-up-5" => "moon-thumbs-up-5",

                "moon-thumbs-up-6" => "moon-thumbs-up-6",

                "moon-people" => "moon-people",

                "moon-man" => "moon-man",

                "moon-male" => "moon-male",

                "moon-woman" => "moon-woman",

                "moon-female" => "moon-female",

                "moon-peace" => "moon-peace",

                "moon-yin-yang" => "moon-yin-yang",

                "moon-happy" => "moon-happy",

                "moon-happy-2" => "moon-happy-2",

                "moon-smiley" => "moon-smiley",

                "moon-smiley-2" => "moon-smiley-2",

                "moon-tongue" => "moon-tongue",

                "moon-tongue-2" => "moon-tongue-2",

                "moon-sad" => "moon-sad",

                "moon-sad-2" => "moon-sad-2",

                "moon-wink" => "moon-wink",

                "moon-wink-2" => "moon-wink-2",

                "moon-grin" => "moon-grin",

                "moon-grin-2" => "moon-grin-2",

                "moon-cool" => "moon-cool",

                "moon-cool-2" => "moon-cool-2",

                "moon-angry" => "moon-angry",

                "moon-angry-2" => "moon-angry-2",

                "moon-evil" => "moon-evil",

                "moon-evil-2" => "moon-evil-2",

                "moon-shocked" => "moon-shocked",

                "moon-shocked-2" => "moon-shocked-2",

                "moon-confused" => "moon-confused",

                "moon-confused-2" => "moon-confused-2",

                "moon-neutral" => "moon-neutral",

                "moon-neutral-2" => "moon-neutral-2",

                "moon-wondering" => "moon-wondering",

                "moon-wondering-2" => "moon-wondering-2",

                "moon-cursor" => "moon-cursor",

                "moon-cursor-2" => "moon-cursor-2",

                "moon-point-up" => "moon-point-up",

                "moon-point-right" => "moon-point-right",

                "moon-point-down" => "moon-point-down",

                "moon-point-left" => "moon-point-left",

                "moon-pointer" => "moon-pointer",

                "moon-hand" => "moon-hand",

                "moon-stack-empty" => "moon-stack-empty",

                "moon-stack-plus" => "moon-stack-plus",

                "moon-stack-minus" => "moon-stack-minus",

                "moon-stack-star" => "moon-stack-star",

                "moon-stack-picture" => "moon-stack-picture",

                "moon-stack-down" => "moon-stack-down",

                "moon-stack-up" => "moon-stack-up",

                "moon-stack-cancel" => "moon-stack-cancel",

                "moon-stack-checkmark" => "moon-stack-checkmark",

                "moon-stack-list" => "moon-stack-list",

                "moon-stack-clubs" => "moon-stack-clubs",

                "moon-stack-spades" => "moon-stack-spades",

                "moon-stack-hearts" => "moon-stack-hearts",

                "moon-stack-diamonds" => "moon-stack-diamonds",

                "moon-stack-user" => "moon-stack-user",

                "moon-stack-4" => "moon-stack-4",

                "moon-stack-music" => "moon-stack-music",

                "moon-stack-play" => "moon-stack-play",

                "moon-move" => "moon-move",

                "moon-resize" => "moon-resize",

                "moon-resize-2" => "moon-resize-2",

                "moon-warning" => "moon-warning",

                "moon-warning-2" => "moon-warning-2",

                "moon-notification" => "moon-notification",

                "moon-notification-2" => "moon-notification-2",

                "moon-question" => "moon-question",

                "moon-question-2" => "moon-question-2",

                "moon-question-3" => "moon-question-3",

                "moon-question-4" => "moon-question-4",

                "moon-question-5" => "moon-question-5",

                "moon-plus-circle" => "moon-plus-circle",

                "moon-plus-circle-2" => "moon-plus-circle-2",

                "moon-minus-circle" => "moon-minus-circle",

                "moon-minus-circle-2" => "moon-minus-circle-2",

                "moon-info" => "moon-info",

                "moon-info-2" => "moon-info-2",

                "moon-blocked" => "moon-blocked",

                "moon-cancel-circle" => "moon-cancel-circle",

                "moon-cancel-circle-2" => "moon-cancel-circle-2",

                "moon-checkmark-circle" => "moon-checkmark-circle",

                "moon-checkmark-circle-2" => "moon-checkmark-circle-2",

                "moon-cancel" => "moon-cancel",

                "moon-spam" => "moon-spam",

                "moon-close" => "moon-close",

                "moon-close-2" => "moon-close-2",

                "moon-close-3" => "moon-close-3",

                "moon-close-4" => "moon-close-4",

                "moon-close-5" => "moon-close-5",

                "moon-checkmark" => "moon-checkmark",

                "moon-checkmark-2" => "moon-checkmark-2",

                "moon-checkmark-3" => "moon-checkmark-3",

                "moon-checkmark-4" => "moon-checkmark-4",

                "moon-spell-check" => "moon-spell-check",

                "moon-minus" => "moon-minus",

                "moon-plus" => "moon-plus",

                "moon-minus-2" => "moon-minus-2",

                "moon-plus-2" => "moon-plus-2",

                "moon-enter" => "moon-enter",

                "moon-exit" => "moon-exit",

                "moon-enter-2" => "moon-enter-2",

                "moon-exit-2" => "moon-exit-2",

                "moon-enter-3" => "moon-enter-3",

                "moon-exit-3" => "moon-exit-3",

                "moon-exit-4" => "moon-exit-4",

                  "moon-play-3" => "moon-play-3",

                "moon-pause" => "moon-pause",

                "moon-stop" => "moon-stop",

                "moon-backward" => "moon-backward",

                "moon-forward-2" => "moon-forward-2",

                 "moon-play-4", 

                "moon-pause-2" => "moon-play-4", 

                "moon-pause-2",

                "moon-stop-2" => "moon-stop-2",

                "moon-backward-2" => "moon-backward-2",

                "moon-forward-3" => "moon-forward-3",

                "moon-first" => "moon-first",

                "moon-last" => "moon-last",

                "moon-previous" => "moon-previous",

                "moon-next" => "moon-next",

                "moon-eject" => "moon-eject",

                "moon-volume-high" => "moon-volume-high",

                "moon-volume-medium" => "moon-volume-medium",

                "moon-volume-low" => "moon-volume-low",

                "moon-volume-mute" => "moon-volume-mute",

                "moon-volume-mute-2" => "moon-volume-mute-2",

                "moon-volume-increase" => "moon-volume-increase",

                "moon-volume-decrease" => "moon-volume-decrease",

                "moon-volume-high-2" => "moon-volume-high-2",

                "moon-volume-medium-2" => "moon-volume-medium-2",

                "moon-volume-low-2" => "moon-volume-low-2",

                "moon-volume-mute-3" => "moon-volume-mute-3",

                "moon-volume-mute-4" => "moon-volume-mute-4",

                "moon-volume-increase-2" => "moon-volume-increase-2",

                "moon-volume-decrease-2" => "moon-volume-decrease-2",

                "moon-volume5" => "moon-volume5",

                "moon-volume4" => "moon-volume4",

                "moon-volume3" => "moon-volume3",

                "moon-volume2" => "moon-volume2",

                "moon-volume1" => "moon-volume1",

                "moon-volume0" => "moon-volume0",

                "moon-volume-mute-5" => "moon-volume-mute-5",

                "moon-volume-mute-6" => "moon-volume-mute-6",

                "moon-loop" => "moon-loop",

                "moon-loop-2" => "moon-loop-2",

                "moon-loop-3" => "moon-loop-3",

                "moon-loop-4" => "moon-loop-4",

                "moon-loop-5" => "moon-loop-5",

                "moon-shuffle" => "moon-shuffle",

                "moon-shuffle-2" => "moon-shuffle-2",

                "moon-wave" => "moon-wave",

                "moon-wave-2" => "moon-wave-2",

                "moon-arrow-first" => "moon-arrow-first",

                "moon-arrow-right" => "moon-arrow-right",

                "moon-arrow-up" => "moon-arrow-up",

                "moon-arrow-right-2" => "moon-arrow-right-2",

                "moon-arrow-down" => "moon-arrow-down",

                "moon-arrow-left" => "moon-arrow-left",

                "moon-arrow-up-2" => "moon-arrow-up-2",

                "moon-arrow-right-3" => "moon-arrow-right-3",

                "moon-arrow-down-2" => "moon-arrow-down-2",

                "moon-arrow-left-2" => "moon-arrow-left-2",

                "moon-arrow-up-left" => "moon-arrow-up-left",

                "moon-arrow-up-3" => "moon-arrow-up-3",

                "moon-arrow-up-right" => "moon-arrow-up-right",

                "moon-arrow-right-4" => "moon-arrow-right-4",

                "moon-arrow-down-right" => "moon-arrow-down-right",

                "moon-arrow-down-3" => "moon-arrow-down-3",

                "moon-arrow-down-left" => "moon-arrow-down-left",

                "moon-arrow-left-3" => "moon-arrow-left-3",

                "moon-arrow-up-left-2" => "moon-arrow-up-left-2",

                "moon-arrow-up-4" => "moon-arrow-up-4",

                "moon-arrow-up-right-2" => "moon-arrow-up-right-2",

                "moon-arrow-right-5" => "moon-arrow-right-5",

                "moon-arrow-down-right-2" => "moon-arrow-down-right-2",

                "moon-arrow-down-4" => "moon-arrow-down-4",

                "moon-arrow-down-left-2" => "moon-arrow-down-left-2",

                "moon-arrow-left-4" => "moon-arrow-left-4",

                "moon-arrow-up-left-3" => "moon-arrow-up-left-3",

                "moon-arrow-up-5" => "moon-arrow-up-5",

                "moon-arrow-up-right-3" => "moon-arrow-up-right-3",

                "moon-arrow-right-6" => "moon-arrow-right-6",

                "moon-arrow-down-right-3" => "moon-arrow-down-right-3",

                "moon-arrow-down-5" => "moon-arrow-down-5",

                "moon-arrow-down-left-3" => "moon-arrow-down-left-3",

                "moon-arrow-left-5" => "moon-arrow-left-5",

                "moon-arrow-up-left-4" => "moon-arrow-up-left-4",

                "moon-arrow-up-6" => "moon-arrow-up-6",

                "moon-arrow-up-right-4" => "moon-arrow-up-right-4",

                "moon-arrow-right-7" => "moon-arrow-right-7",

                "moon-arrow-down-right-4" => "moon-arrow-down-right-4",

                "moon-arrow-down-6" => "moon-arrow-down-6",

                "moon-arrow-down-left-4" => "moon-arrow-down-left-4",

                "moon-arrow-left-6" => "moon-arrow-left-6",

                "moon-arrow" => "moon-arrow",

                "moon-arrow-2" => "moon-arrow-2",

                "moon-arrow-3" => "moon-arrow-3",

                "moon-arrow-4" => "moon-arrow-4",

                "moon-arrow-5" => "moon-arrow-5",

                "moon-arrow-6" => "moon-arrow-6",

                "moon-arrow-7" => "moon-arrow-7",

                "moon-arrow-8" => "moon-arrow-8",

                "moon-arrow-up-left-5" => "moon-arrow-up-left-5",

                "moon-arrow-square" => "moon-arrow-square",

                "moon-arrow-up-right-5" => "moon-arrow-up-right-5",

                "moon-arrow-right-8" => "moon-arrow-right-8",

                "moon-arrow-down-right-5" => "moon-arrow-down-right-5",

                "moon-arrow-down-7" => "moon-arrow-down-7",

                "moon-arrow-down-left-5" => "moon-arrow-down-left-5",

                "moon-arrow-left-7" => "moon-arrow-left-7",

                "moon-arrow-up-7" => "moon-arrow-up-7",

                "moon-arrow-right-9" => "moon-arrow-right-9",

                "moon-arrow-down-8" => "moon-arrow-down-8",

                "moon-arrow-left-8" => "moon-arrow-left-8",

                "moon-arrow-up-8" => "moon-arrow-up-8",

                "moon-arrow-right-10" => "moon-arrow-right-10",

                "moon-arrow-bottom" => "moon-arrow-bottom",

                "moon-arrow-left-9" => "moon-arrow-left-9",

                "moon-arrow-up-left-6" => "moon-arrow-up-left-6",

                "moon-arrow-up-9" => "moon-arrow-up-9",

                "moon-arrow-up-right-6" => "moon-arrow-up-right-6",

                "moon-arrow-right-11" => "moon-arrow-right-11",

                "moon-arrow-down-right-6" => "moon-arrow-down-right-6",

                "moon-arrow-down-9" => "moon-arrow-down-9",

                "moon-arrow-down-left-6" => "moon-arrow-down-left-6",

                "moon-arrow-left-10" => "moon-arrow-left-10",

                "moon-arrow-up-left-7" => "moon-arrow-up-left-7",

                "moon-arrow-up-10" => "moon-arrow-up-10",

                "moon-arrow-up-right-7" => "moon-arrow-up-right-7",

                "moon-arrow-right-12" => "moon-arrow-right-12",

                "moon-arrow-down-right-7" => "moon-arrow-down-right-7",

                "moon-arrow-down-10" => "moon-arrow-down-10",

                "moon-arrow-down-left-7" => "moon-arrow-down-left-7",

                "moon-arrow-left-11" => "moon-arrow-left-11",

                "moon-arrow-up-11" => "moon-arrow-up-11",

                "moon-arrow-right-13" => "moon-arrow-right-13",

                "moon-arrow-down-11" => "moon-arrow-down-11",

                "moon-arrow-left-12" => "moon-arrow-left-12",

                "moon-arrow-up-12" => "moon-arrow-up-12",

                "moon-arrow-right-14" => "moon-arrow-right-14",

                "moon-arrow-down-12" => "moon-arrow-down-12",

                "moon-arrow-left-13" => "moon-arrow-left-13",

                "moon-arrow-up-13" => "moon-arrow-up-13",

                "moon-arrow-right-15" => "moon-arrow-right-15",

                "moon-arrow-down-13" => "moon-arrow-down-13",

                "moon-arrow-left-14" => "moon-arrow-left-14",

                "moon-arrow-up-14" => "moon-arrow-up-14",

                "moon-arrow-right-16" => "moon-arrow-right-16",

                "moon-arrow-down-14" => "moon-arrow-down-14",

                "moon-arrow-left-15" => "moon-arrow-left-15",

                "moon-arrow-up-15" => "moon-arrow-up-15",

                "moon-arrow-right-17" => "moon-arrow-right-17",

                "moon-arrow-down-15" => "moon-arrow-down-15",

                "moon-arrow-left-16" => "moon-arrow-left-16",

                "moon-arrow-up-16" => "moon-arrow-up-16",

                "moon-arrow-right-18" => "moon-arrow-right-18",

                "moon-arrow-down-16" => "moon-arrow-down-16",

                "moon-arrow-left-17" => "moon-arrow-left-17",

                "moon-menu-10" => "moon-menu-10",

                "moon-menu-11" => "moon-menu-11",

                "moon-menu-close" => "moon-menu-close",

                "moon-menu-close-2" => "moon-menu-close-2",

                "moon-enter-4" => "moon-enter-4",

                "moon-enter-5" => "moon-enter-5",

                "moon-esc" => "moon-esc",

                "moon-backspace" => "moon-backspace",

                "moon-backspace-2" => "moon-backspace-2",

                "moon-backspace-3" => "moon-backspace-3",

                "moon-tab" => "moon-tab",

                "moon-transmission" => "moon-transmission",

                "moon-transmission-2" => "moon-transmission-2",

                "moon-sort" => "moon-sort",

                "moon-sort-2" => "moon-sort-2",

                "moon-key-keyboard" => "moon-key-keyboard",

                "moon-key-A" => "moon-key-A",

                "moon-key-up" => "moon-key-up",

                "moon-key-right" => "moon-key-right",

                "moon-key-down" => "moon-key-down",

                "moon-key-left" => "moon-key-left",

                "moon-command" => "moon-command",

                "moon-checkbox-checked" => "moon-checkbox-checked",

                "moon-checkbox-unchecked" => "moon-checkbox-unchecked",

                "moon-square" => "moon-square",

                "moon-checkbox-partial" => "moon-checkbox-partial",

                "moon-checkbox" => "moon-checkbox",

                "moon-checkbox-unchecked-2" => "moon-checkbox-unchecked-2",

                "moon-checkbox-partial-2" => "moon-checkbox-partial-2",

                "moon-checkbox-checked-2" => "moon-checkbox-checked-2",

                "moon-checkbox-unchecked-3" => "moon-checkbox-unchecked-3",

                "moon-checkbox-partial-3" => "moon-checkbox-partial-3",

                "moon-radio-checked" => "moon-radio-checked",

                "moon-radio-unchecked" => "moon-radio-unchecked",

                "moon-circle" => "moon-circle",

                "moon-circle-2" => "moon-circle-2",

                "moon-crop" => "moon-crop",

                "moon-crop-2" => "moon-crop-2",

                "moon-vector" => "moon-vector",

                "moon-rulers" => "moon-rulers",

                "moon-scissors" => "moon-scissors",

                "moon-scissors-2" => "moon-scissors-2",

                "moon-scissors-3" => "moon-scissors-3",

                "moon-filter" => "moon-filter",

                "moon-filter-2" => "moon-filter-2",

                "moon-filter-3" => "moon-filter-3",

                "moon-filter-4" => "moon-filter-4",

                "moon-font" => "moon-font",

                "moon-font-size" => "moon-font-size",

                "moon-type" => "moon-type",

                "moon-text-height" => "moon-text-height",

                "moon-text-width" => "moon-text-width",

                "moon-height" => "moon-height",

                "moon-width" => "moon-width",

                "moon-bold" => "moon-bold",

                "moon-underline" => "moon-underline",

                "moon-italic" => "moon-italic",

                "moon-strikethrough" => "moon-strikethrough",

                "moon-strikethrough-2" => "moon-strikethrough-2",

                "moon-font-size-2" => "moon-font-size-2",

                "moon-bold-2" => "moon-bold-2",

                "moon-underline-2" => "moon-underline-2",

                "moon-italic-2" => "moon-italic-2",

                "moon-strikethrough-3" => "moon-strikethrough-3",

                "moon-omega" => "moon-omega",

                "moon-sigma" => "moon-sigma",

                "moon-nbsp" => "moon-nbsp",

                "moon-page-break" => "moon-page-break",

                "moon-page-break-2" => "moon-page-break-2",

                "moon-superscript" => "moon-superscript",

                "moon-subscript" => "moon-subscript",

                "moon-superscript-2" => "moon-superscript-2",

                "moon-subscript-2" => "moon-subscript-2",

                "moon-text-color" => "moon-text-color",

                "moon-highlight" => "moon-highlight",

                "moon-pagebreak" => "moon-pagebreak",

                "moon-clear-formatting" => "moon-clear-formatting",

                "moon-table" => "moon-table",

                "moon-table-2" => "moon-table-2",

                "moon-insert-template" => "moon-insert-template",

                "moon-pilcrow" => "moon-pilcrow",

                "moon-left-to-right" => "moon-left-to-right",

                "moon-right-to-left" => "moon-right-to-left",

                "moon-paragraph-left" => "moon-paragraph-left",

                "moon-paragraph-center" => "moon-paragraph-center",

                "moon-paragraph-right" => "moon-paragraph-right",

                "moon-paragraph-justify" => "moon-paragraph-justify",

                "moon-paragraph-left-2" => "moon-paragraph-left-2",

                "moon-paragraph-center-2" => "moon-paragraph-center-2",

                "moon-paragraph-right-2" => "moon-paragraph-right-2",

                "moon-paragraph-justify-2" => "moon-paragraph-justify-2",

                "moon-indent-increase" => "moon-indent-increase",

                "moon-indent-decrease" => "moon-indent-decrease",

                "moon-paragraph-left-3" => "moon-paragraph-left-3",

                "moon-paragraph-center-3" => "moon-paragraph-center-3",

                "moon-paragraph-right-3" => "moon-paragraph-right-3",

                "moon-paragraph-justify-3" => "moon-paragraph-justify-3",

                "moon-indent-increase-2" => "moon-indent-increase-2",

                "moon-indent-decrease-2" => "moon-indent-decrease-2",

                "moon-share" => "moon-share",

                "moon-new-tab" => "moon-new-tab",

                "moon-new-tab-2" => "moon-new-tab-2",

                "moon-popout" => "moon-popout",

                "moon-embed" => "moon-embed",

                "moon-code" => "moon-code",

                "moon-console" => "moon-console",

                "moon-seven-segment-0" => "moon-seven-segment-0",

                "moon-seven-segment-1" => "moon-seven-segment-1",

                "moon-seven-segment-2" => "moon-seven-segment-2",

                "moon-seven-segment-3" => "moon-seven-segment-3",

                "moon-seven-segment-4" => "moon-seven-segment-4",

                "moon-seven-segment-5" => "moon-seven-segment-5",

                "moon-seven-segment-6" => "moon-seven-segment-6",

                "moon-seven-segment-7" => "moon-seven-segment-7",

                "moon-seven-segment-8" => "moon-seven-segment-8",

                "moon-seven-segment-9" => "moon-seven-segment-9",

                "moon-share-2" => "moon-share-2",

                "moon-share-3" => "moon-share-3",

                "moon-mail" => "moon-mail",

                "moon-mail-2" => "moon-mail-2",

                "moon-mail-3" => "moon-mail-3",

                "moon-mail-4" => "moon-mail-4",

                "moon-google" => "moon-google",

                "moon-google_plus" => "moon-google_plus",

                "moon-google_plus-2" => "moon-google_plus-2",

                "moon-google_plus-3" => "moon-google_plus-3",

                "moon-google_plus-4" => "moon-google_plus-4",

                "moon-google-drive" => "moon-google-drive",

                "moon-facebook" => "moon-facebook",

                "moon-facebook-2" => "moon-facebook-2",

                "moon-facebook-3" => "moon-facebook-3",

                "moon-facebook-4" => "moon-facebook-4",



                "moon-instagram" => "moon-instagram",

                "moon-twitter" => "moon-twitter",

                "moon-twitter-2" => "moon-twitter-2",

                "moon-twitter-3" => "moon-twitter-3",

                "moon-feed-2" => "moon-feed-2",

                "moon-feed-3" => "moon-feed-3",

                "moon-feed-4" => "moon-feed-4",

                "moon-youtube" => "moon-youtube",

                "moon-youtube-2" => "moon-youtube-2",

                "moon-vimeo" => "moon-vimeo",

                "moon-vimeo2" => "moon-vimeo2",

                "moon-vimeo-2" => "moon-vimeo-2",

                "moon-lanyrd" => "moon-lanyrd",

                "moon-flickr" => "moon-flickr",

                "moon-flickr-2" => "moon-flickr-2",

                "moon-flickr-3" => "moon-flickr-3",

                "moon-flickr-4" => "moon-flickr-4",

                "moon-picassa" => "moon-picassa",

                "moon-picassa-2" => "moon-picassa-2",

                "moon-dribbble" => "moon-dribbble",

                "moon-dribbble-2" => "moon-dribbble-2",

                "moon-dribbble-3" => "moon-dribbble-3",

                "moon-forrst" => "moon-forrst",

                "moon-forrst-2" => "moon-forrst-2",

                "moon-deviantart" => "moon-deviantart",

                "moon-deviantart-2" => "moon-deviantart-2",

                "moon-steam" => "moon-steam",

                "moon-steam-2" => "moon-steam-2",

                "moon-github" => "moon-github",

                "moon-github-2" => "moon-github-2",

                "moon-github-3" => "moon-github-3",

                "moon-github-4" => "moon-github-4",

                "moon-github-5" => "moon-github-5",

                "moon-wordpress" => "moon-wordpress",

                "moon-wordpress-2" => "moon-wordpress-2",

                "moon-joomla" => "moon-joomla",

                "moon-blogger" => "moon-blogger",

                "moon-blogger-2" => "moon-blogger-2",

                "moon-tumblr" => "moon-tumblr",

                "moon-tumblr-2" => "moon-tumblr-2",

                "moon-yahoo" => "moon-yahoo",

                "moon-tux" => "moon-tux",

                "moon-apple" => "moon-apple",

                "moon-finder" => "moon-finder",

                "moon-android" => "moon-android",

                "moon-windows" => "moon-windows",

                "moon-windows8" => "moon-windows8",

                "moon-soundcloud" => "moon-soundcloud",

                "moon-soundcloud-2" => "moon-soundcloud-2",

                "moon-skype" => "moon-skype",

                "moon-reddit" => "moon-reddit",

                "moon-linkedin" => "moon-linkedin",

                "moon-lastfm" => "moon-lastfm",

                "moon-lastfm-2" => "moon-lastfm-2",

                "moon-delicious" => "moon-delicious",

                "moon-stumbleupon" => "moon-stumbleupon",

                "moon-stumbleupon-2" => "moon-stumbleupon-2",

                "moon-stackoverflow" => "moon-stackoverflow",

                "moon-pinterest" => "moon-pinterest",

                "moon-pinterest-2" => "moon-pinterest-2",

                "moon-xing" => "moon-xing",

                "moon-xing-2" => "moon-xing-2",

                "moon-flattr" => "moon-flattr",

                "moon-safari" => "moon-safari",

                "moon-foursquare" => "moon-foursquare",

                "moon-foursquare-2" => "moon-foursquare-2",

                "moon-paypal" => "moon-paypal",

                "moon-paypal-2" => "moon-paypal-2",

                "moon-paypal-3" => "moon-paypal-3",

                "moon-yelp" => "moon-yelp",

                "moon-libreoffice" => "moon-libreoffice",

                "moon-file-pdf" => "moon-file-pdf",

                "moon-file-openoffice" => "moon-file-openoffice",

                "moon-file-word" => "moon-file-word",

                "moon-file-excel" => "moon-file-excel",

                "moon-file-zip" => "moon-file-zip",

                "moon-file-powerpoint" => "moon-file-powerpoint",

                "moon-file-xml" => "moon-file-xml",

                "moon-file-css" => "moon-file-css",

                "moon-html5" => "moon-html5",

                "moon-html5-2" => "moon-html5-2",

                "moon-css3" => "moon-css3",

                "moon-chrome" => "moon-chrome",

                "moon-firefox" => "moon-firefox",

                "moon-IE" => "moon-IE",

                "moon-opera" => "moon-opera"

            );

  

// Icon list

$icon_arr = array_merge($fa_icons, $steadysets, $linecons, $moon);

// Font list


vc_map( array (

  'base' => 'recent_portfolio',

  'name' => 'Recent Portfolio',

  "description" => __('Show off some recent portfolio', 'js_composer'),

  'params' => 

  array (


   

    0=>
    
    array(


      'param_name' =>"dynamic_title" , 

      'admin_label' => true,

      'type' => "textfield",

      'heading' => "Set the heading title"


      ),


    1 => 
    
    array(

      'param_name' => 'pagination_position',

      'admin_label' => true,

      'type' => 'dropdown',

      'value' => 

      array (

        'Right' => 'right',

        'Bottom' => 'bottom',

      ),

      'heading' => 'Do you want pagination position ?',


      ), 

   



    2 => 

    array (

      'param_name' => 'desc_bool',

      'admin_label' => true,

      'type' => 'dropdown',

      'value' => 

      array (

        'No' => 'no',

        'Yes' => 'yes',

      ),

      'heading' => 'Do you want Description in the left ?',

    ),

    3 => 

    array (

      'param_name' => 'desc_text',

      'admin_label' => true,

      'type' => 'exploded_textarea',

      'heading' => 'Description',

      'dependency' => 

      array (

        'element' => 'desc_bool',

        'value' => 

        array (

          0 => 'yes',

        ),

      ),

    ),

    4 => 

    array (

      'heading' => 'Portfolio Style',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'portfolio_style',

      'type' => 'dropdown',

      'value' => 

      array (

        'First Version' => 'v1',

        'Second Version' => 'v2',

      ),

    ),

    5 => 

    array (

      'heading' => 'Do you want to show title and description after the image?',

      'admin_label' => true,

      'description' => '',

      'value' => 

      array (

        'Yes' => 'yes',

        'No' => 'no',

      ),

      'param_name' => 'show_text_bool',

      'type' => 'dropdown',

      'dependency' => 

      array (

        'element' => 'portfolio_style',

        'value' => 

        array (

          0 => 'v3',

        ),

      ),

    ),

    6 => 

    array (

      'heading' => 'Select the way you want to show the items',

      'admin_label' => true,

      'description' => '',

      'value' => 

      array (

        'None' => 'normal_mode',

        'Masonry' => 'masonry',

        'List' => 'list',

      ),

      'param_name' => 'show_type',

      'type' => 'dropdown',

    ),

    7 => 

    array (

      'heading' => 'Portfolio Rows',

      'admin_label' => true,

      'param_name' => 'rows',

      'type' => 'dropdown',

      'value' => 

      array (

        'One Row' => '1',

        'Two Rows' => '2',

      ),

    ),

    8 => 

    array (

      'heading' => 'Block Size:',

      'admin_label' => true,

      'description' => 'This mean that if you select 1/4 and you choose a 100% row, should be display 4 items. Be sure that items are in exact proporcion with the column percentage. For example you cant use a 1/4 with 66% column or 1/3 with 75% column ',

      'param_name' => 'dynamic_block_size',

      'type' => 'dropdown',

      'value' => 

      array (

        '1/4' => 4,

        '1/3' => 3,

        '1/2' => 2,

        '1/1' => 1,

      ),

    ),

    9 => 

    array (

      'param_name' => 'dynamic_from_where',

      'admin_label' => true,

      'type' => 'dropdown',

      'heading' => 'Set featured Portfolio:',

      'value' => 

      array (

        'Show Portfolio from all categories' => 'all_cat',

        'Select a specific Category' => 'cat',

      ),

    ),

    10 => 

    array (

      'param_name' => 'dynamic_cat',

      'admin_label' => true,

      'type' => 'dropdown',

      'heading' => 'Select the category:',

      'value' => $portfolio_terms,

      'dependency' => 

      array (

        'element' => 'dynamic_from_where',

        'value' => 

        array (

          0 => 'cat',

        ),

      ),

    ),



  ),

  'category' => 'Themeple Elements',

));




$blog_types = get_categories('title_li=&orderby=name&hide_empty=0');



$blog_terms = array();

if(!empty($blog_types)){

  foreach ($blog_types as $type) {

    if(isset($type->term_id))

      $blog_terms[$type->name] = $type->term_id;

  }

}

$args = array( 'posts_per_page' => 9999 );

$blog_posts = get_posts($args);

$post_terms = array();

if(!empty($blog_posts)){

     foreach ( $blog_posts as $posts ):

            if(isset($posts->ID))

                  $post_terms[$posts->post_title] = $posts->ID;
      endforeach;
}



vc_map( array (

  'base' => 'recent_news',

  'name' => 'Recent News',

  'params' => 

  array (

    array (

      'heading' => 'Block Title:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'dynamic_title',

      'value' => '',

      'type' => 'textfield',

    ),

      array (

      'heading' => 'Nr posts to show:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'posts_number',

      'value' => '',

      'type' => 'textfield',

    ),

      array (

      'heading' => 'Set the style',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'style',

      'type' => 'dropdown',

      'value' => 

            array(

                  'Style 1 with images' => 'style_1',

                  'Style 2 with date mode' => 'style_2',


                  ),

    ), 



    array (

      'param_name' => 'dynamic_from_where',

      'admin_label' => true,

      'type' => 'dropdown',

      'heading' => 'Set Headlines From Blog',

      'value' => 

      array (

        'Show headlines from all categories' => 'all_cat',

        'Select a specific Category' => 'cat',

      ),

    ),

    4 => 

    array (

      'param_name' => 'dynamic_cat',

      'admin_label' => true,

      'type' => 'dropdown',

      'heading' => 'Select the category:',

      'value' => $blog_terms,

      'dependency' => 

      array (

        'element' => 'dynamic_from_where',

        'value' => 

        array (

          0 => 'cat',

        ),

      ),

    ),

  ),

  'category' => 'Themeple Elements',

));



vc_map( array (

  'base' => 'latest_blog',

  'name' => 'Latest From Blog',

  'params' => 

  array (




    array (

      'param_name' => 'post_selected', 

      'admin_label' => true,

      'type' => 'dropdown',

      'heading' => 'Select the category:',

      'value' => $post_terms,

 

    ),

  ),

  'category' => 'Themeple Elements',

));




vc_map( array (

  'base' => 'home_blog',

  'name' => 'Full Blog',

  'params' => 

  array (

    0 => 

    array (

      'heading' => 'Block Title:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'dynamic_title',

      'value' => '',

      'type' => 'textfield',

    ),

    1 => 

    array (

      'heading' => 'Style:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'style',

      'value' => 

      array (

        'Normal' => 'index',

        'Second Style' => 'blog-second-style',

        'Grid' => 'blog-grid',

        'Masonry' => 'blog-masonry',

      ),

      'type' => 'dropdown',

    ),

  ),

  'category' => 'Themeple Elements',

));





$pages_entries = get_pages('title_li=&orderby=name');

$pages = array();



if(!empty($pages_entries) ){

  foreach($pages_entries as $p){

      $pages[$p->post_title] = $p->ID;

  }

}



vc_map( array (

  'base' => 'home_portfolio',

  'name' => 'Full Portfolio',

  'params' => 

  array (

    array (

      'heading' => 'Nr of columns',

      'admin_label' => true,

      'param_name' => 'dynamic_columns',

      'type' => 'dropdown',

      'value' => 

      array (

        'One Column' => 1,

        'Two Columns' => 2,

        'Three Columns' => 3,

        'Four Columns' => 4,

      ),

    ),

    array (

      'heading' => 'Nr of rows',

      'admin_label' => true,

      'param_name' => 'dynamic_rows',

      'type' => 'dropdown',

      'value' => 

      array (

        'One Row' => 1,

        'Two Row' => 2,

        'Three Row' => 3,

        'Four Row' => 4,

      ),

    ),

    array (

      'heading' => 'Portfolio Style',

      'admin_label' => true,

      'param_name' => 'portfolio_style',

      'type' => 'dropdown',

      'value' => 

      array (

        'Second Style' => 'v2',

        'One Style' => 'v1'

      ),

    ),

    array (

      'heading' => 'Portfolio Page',

      'admin_label' => true,

      'param_name' => 'portfolio_selected',

      'type' => 'dropdown',

      'value' => $pages,

    ),


    array (

      'heading' => 'Portfolio Space between elements',

      'admin_label' => true,

      'param_name' => 'portfolio_space',

      'type' => 'dropdown',

      'value' => 

      array (

        'Without space' => 'no',

        'With space' => 'yes'

      ),

    ),

  ),

  'category' => 'Themeple Elements',

));



vc_map( array (

  'base' => 'faq',

  'name' => 'FAQ',

  'params' => 

  array (

    0 => 

    array (

      'heading' => 'Style',

      'admin_label' => true,

      'param_name' => 'style',

      'type' => 'dropdown',

      'value' => 

      array (

        'Style 1' => 'style_1'

      ),

    ),

  ),

  'category' => 'Themeple Elements',

));



$staff_entries = get_posts('title_li=&orderby=name&numberposts=9999&post_type=staff');

$staff = array();



if(!empty($staff_entries) ){

  foreach($staff_entries as $p){

      $staff[$p->post_title] = $p->ID;

  }

}



vc_map( array (

  'base' => 'staff',

  'name' => 'One Staff Member',

  'params' => 

  array (

    0 => 

    array (

      'heading' => 'Select Staff Member',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'staff',

      'type' => 'dropdown',

      'value' => $staff,

    )

  ),

  'category' => 'Themeple Elements',

));





$posts_entries = get_posts('title_li=&orderby=name');

$posts = array();



if(!empty($posts_entries) ){

  foreach($posts_entries as $p){

      $posts[$p->post_title] = $p->ID;

  }

}





vc_map( array (

  'base' => 'slideshow',

  'name' => 'Slideshow',

  'params' => 

  array (

    array (

      'heading' => 'Which Content?',

      'admin_label' => true,

      'description' => 'Chosose a page or post. The content of that entry will be displayed. By default it will display the content of the current post or page that has the this template aplied to it.',

      'param_name' => 'dynamic_which_post_page',

      'type' => 'dropdown',

      'value' => 

      array (

        'Display the content of this post/page' => 'self',

        'Choose a post' => 'post',

        'Choose a Page' => 'page',

      ),

    ),

    array (

      'admin_label' => true,

      'heading' => 'Select Page',

      'description' => '',

      'param_name' => 'dynamic_page_id',

      'type' => 'dropdown',

      'value' => $pages,

      'dependency' => 

      array (

        'element' => 'dynamic_which_post_page',

        'value' => 

        array (

          0 => 'page',

        ),

      ),

    ),

    array (

      'admin_label' => true,

      'heading' => 'Select Post',

      'description' => '',

      'param_name' => 'dynamic_post_id',

      'type' => 'dropdown',

      'value' => $posts,

      'dependency' => 

      array (

        'element' => 'dynamic_which_post_page',

        'value' => 

        array (

          0 => 'post',

        ),

      ),
      
    ),

    array (

            'admin_label' => true,

            'heading' => 'Select Size',

            'description' => '',

            'param_name' => 'size',

            'type' => 'dropdown',

            'value' => themeple_get_img_sizes_array()

      ),


    array (

            'admin_label' => true,

            'heading' => 'Enable thumbnails under the slideshow',

            'description' => '',

            'param_name' => 'thumbnail_status',

            'type' => 'dropdown',

            'std' => 'yes',

            'value' => 

            array (

              'Yes' => 'yes',

              'No' => 'no',

            ),

      ),

  ),

  'category' => 'Themeple Elements',

));


vc_map( array (

  'base' => 'services_slideshow',

  'name' => 'Services Slideshow ',

  'params' => 

   array (
        
         array (

            'heading' => 'Title:',

            'admin_label' => true,

            'description' => '',

            'param_name' => 'title',

            'value' => '',

            'type' => 'textfield',

          ),



          array (

            'heading' => 'Do you want Icon?',

          

            'description' => '',

            'param_name' => 'icon_bool',

            'value' => 

            array (

              'Yes' => 'yes',

              'No' => 'no',

            ),

            'type' => 'dropdown',

          ),



          array (

            'heading' => 'Do you want predefined Icon?',

           

            'description' => '',

            'param_name' => 'icon_bool_pred',

            'value' => 

            array (

              'Yes' => 'yes',

              'No' => 'no',

            ),

            'type' => 'dropdown',

            'dependency' => 

            array (

              'element' => 'icon_bool',

              'value' => 

              array (

              'yes'

              ),

            ),

          ),



          array (

            'heading' => 'Upload Your Image',

            'description' => '',

            'param_name' => 'upload_img',

            'value' => '',

            'type' => 'attach_image',

            'dependency' => 

            array (

              'element' => 'icon_bool_pred',

              'value' => 

              array (

                'no'

              ),

            ),

          ),



          array (

            'heading' => 'Select Icon',

            'description' => '',

            'param_name' => 'icon',

            'value' => $icon_arr,

            'type' => 'dropdown',

            'dependency' => 

            array (

              'element' => 'icon_bool_pred',

              'value' => 

              array (

                 'yes'

              ),

            ),

          ),




          array (

         

            'heading' => 'Content Type',

            'description' => 'Select the content type to be used',

            'param_name' => 'dynamic_content_type',

            'type' => 'dropdown',

            'value' => 

            array (

              'Post' => 'post',

              'Page' => 'page',

              'Add Content here' => 'content',

            ),

          ),



          array (

          

            'heading' => 'Select the post',

            'description' => '',

            'param_name' => 'dynamic_post',

            'type' => 'dropdown',

            'value' => $posts,

            'dependency' => 

            array (

              'element' => 'dynamic_content_type',

              'value' => 

              array (

                0 => 'post',

              ),

            ),

          ),



          array (

           

            'heading' => 'Select the page',

            'description' => '',

            'param_name' => 'dynamic_page',

            'type' => 'dropdown',

            'value' => $pages,

            'dependency' => 

            array (

              'element' => 'dynamic_content_type',

              'value' => 

              array (

                0 => 'page',

              ),

            ),

          ),



          array (

         

            'heading' => 'Content',

            'description' => '',

            'param_name' => 'dynamic_content_content',

            'type' => 'textarea_html',

            'dependency' => 

            array (

              'element' => 'dynamic_content_type',

              'value' => 

              array (

                0 => 'content',

              ),

            ),

          ),



          array (

          

            'heading' => 'Link',

            'description' => '',

            'param_name' => 'dynamic_content_link',

            'type' => 'textfield',

            'value' => '#',

            'dependency' => 

            array (

              'element' => 'dynamic_content_type',

              'value' => 

              array (

                0 => 'content',

              ),

            ),

          ),

        ),

  'category' => 'Themeple Elements',

));








$test_entries = get_posts('title_li=&orderby=name&numberposts=9999&post_type=testimonial');

$testimonials = array();



if(!empty($test_entries) ){

  foreach($test_entries as $p){

      $testimonials[$p->post_title] = $p->ID;

  }

}



vc_map( array (

  'base' => 'single_testimonial',

  'name' => 'Full Testimonial',

  'params' => 

  array (

      array (

      'heading' => 'Block Title:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'title',

      'value' => '',

      'type' => 'textfield',

     ),

      array (

      'heading' => 'Full or Normal:',

      'admin_label' => true,

      'description' => 'Select the type of testimonial element',

      'param_name' => 'style',

      'value' => array("Full" => 'full', "Normal" => 'normal'),

      'type' => 'dropdown',
      
      'std' => 'normal'


      ),
    ),     

  'category' => 'Themeple Elements',

));




vc_map( array (

  'base' => 'clients',

  'name' => 'Clients',

  'params' => 

  array (


    array (

      'heading' => 'Block Title:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'title',

      'value' => '',

      'type' => 'textfield',

    ),

    array (

      'heading' => 'Dark or Light:',

      'admin_label' => true,

      'description' => 'Select the type of client image, light or dark version',

      'param_name' => 'dark_light',

      'value' => array("Dark" => 'dark', 'Light' => 'light'),

      'type' => 'dropdown',

    ),


  ),

  'category' => 'Themeple Elements',

));



vc_map( array (

  'base' => 'divider',

  'name' => 'Divider',

  'params' => 

  array (

    0 => 

    array (

      'param_name' => 'style',

      'admin_label' => true,

      'heading' => 'Style',

      'type' => 'dropdown',

      'value' => 

      array (

        'Solid Border' => 'solid_border',

        'Dotted Border' => 'dotted_border',

        'Diagonal Dotted' => 'diagonal_dotted',

        'Light Shadow' => 'light_shadow',

        'Big Shadow' => 'big_shadow',

      ),




    ),

      array (

        'param_name' => 'margin_top',
        
        'admin_label' => true,

        'heading' => 'Set the margin top',

        'type' => 'textfield',

        'value' => ''

      ),

  ),

  'category' => 'Themeple Elements',

));



vc_map( array (

  'base' => 'contact_form',

  'name' => 'Contact Form',

  'params' => 

  array (

    0 => 

    array (

      'heading' => 'Block Title:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'dynamic_title',

      'value' => '',

      'type' => 'textfield',

    ),

    1 => 

    array (

      'heading' => 'Description',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'desc',

      'type' => 'exploded_textarea',

    ),

    2 => 

    array (

      'heading' => 'Success Message',

      'admin_label' => true,

      'description' => 'Write the Message that you want to be displayed when the message has sent',

      'param_name' => 'dynamic_msg',

      'type' => 'exploded_textarea',

    ),

    3 => 

    array (

      'heading' => 'Submit Button Text',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'dynamic_submit',

      'type' => 'textfield',

    ),

  ),

  'category' => 'Themeple Elements',

));



vc_map( array (

  'base' => 'google_map',

  'name' => 'Google Map',

  'params' => 

  array (



    array (

      'heading' => 'Block Title:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'dynamic_title',

      'value' => '',

      'type' => 'textfield',

    ),



    array (

      'heading' => 'Source',

      'admin_label' => true,

      'description' => 'Only the link',

      'param_name' => 'dynamic_src',

      'type' => 'textfield',

    ),

    array (

      'heading' => 'Map Height (px)',

      'admin_label' => true,

      'description' => '',

      'value' => '150',

      'param_name' => 'height',

      'type' => 'textfield',

    ),

    array (

      'heading' => 'Content after the map',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'desc',

      'type' => 'exploded_textarea',

    ),

  ),

  'category' => 'Themeple Elements',

));



vc_map( array (

  'base' => 'el_head',

  'name' => 'Element Header',

  'params' => 

  array (

    0 => 

    array (

      'heading' => 'Block Title:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'dynamic_title',

      'value' => '',

      'type' => 'textfield',

    ),

  ),

  'category' => 'Themeple Elements',

));



vc_map( array (

  'base' => 'textbar',

  'name' => 'Text Bar',

  'params' => 

  array (


    
    array (

      'heading' => 'Title',

      'admin_label' => true,

      'description' => '',

      'value'   => '',

      'param_name' => 'title',

      'type' => 'textfield',

    ),

      array (

      'heading' => 'Subtitle',

      'admin_label' => true,

      'description' => '',

      'value'   => '',

      'param_name' => 'subtitle',

      'type' => 'textfield',

    ),


    array (

      'heading' => 'Background Color',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'background_color',

      'type' => 'colorpicker',

      'value'   => ''
    ),

     array (

      'heading' => 'Font Color',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'font_color',

      'type' => 'colorpicker',

      'value'   => '#fff'
    ),


    array (

      'heading' => 'Button Title',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'button1_title',

      'type' => 'textfield',

      'value'   => ''
    ),


    array (

      'heading' => 'Button Background Color',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'button_color',

      'type' => 'colorpicker',

      'value'   => '#009dcd'
    ),
   

    array (

      'heading' => 'Button Link',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'button1_link',

      'type' => 'textfield',

      'value'   => '#',

    ),



    array (

      'heading' => 'Border',

      'admin_label' => true,

      'description' => 'Enable border',

      'param_name' => 'top_border',

      'type' => 'dropdown',

      'value'   => 

            array(

                  'yes' => 'yes',
                  'no' => 'no'

                  ),

    ),
   

  ),

  'category' => 'Themeple Elements'

));


vc_map(array (

  'base' => 'list_price',

  'name' => 'Items for Price List',

  'as_child' => array('list_price'),

  'content_element' => true,

  'params' => 

  array (

    0 => 

    array (

      'heading' => 'Title:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'title',

      'value' => '',

      'type' => 'textfield',

    )
   

  ),

  'category' => 'Themeple Elements'



));


vc_map( array (

  'base' => 'services_list',

  'name' => 'Services List',

  'as_parent' => array('only' => 'list_item'),

  'is_container' => false,

  'params' => 

  array (

    array (

      'heading' => 'Block Title:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'dynamic_title',

      'value' => '',

      'type' => 'textfield',

    ),

  ),

  'category' => 'Themeple Elements',

  'js_view' => 'VcColumnView'

));





vc_map( array (

  'base' => 'list_item',

  'name' => 'List Item',

  'as_child' => array('list_item'),

  'content_element' => true,

  'params' => 

  array (

    0 => 

    array (

      'heading' => 'Title:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'title',

      'value' => '',

      'type' => 'textfield',

    ),

    array (

      'heading' => 'Select Icon',

      'description' => '',

      'param_name' => 'icon',

      'value' => $icon_arr,

      'type' => 'dropdown',

    ),

    array (

      'admin_label' => true,

      'heading' => 'Content',

      'value' => '',

      'description' => '',

      'param_name' => 'content',

      'type' => 'textarea_html'

      ) 

  ),

  'category' => 'Themeple Elements'



));


vc_map( array (

  'base' => 'services_step',

  'name' => 'Services Step',

  'params' => 

  array (



    array (

      'heading' => 'Title:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'title',

      'value' => '',

      'type' => 'textfield'

    ),


    array (

      'heading' => 'Do you want Icon?',

      'admin_label' => false,

      'description' => '',

      'param_name' => 'icon_bool',

      'value' => 

      array (

        'Yes' => 'yes',

        'No' => 'no'

      ),

      'type' => 'dropdown'

    ),

  
    array (

      'heading' => 'Select Icon',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'icon',

      'type' => 'dropdown',

      'value' => $icon_arr,

      'dependency' => 

      array (

        'element' => 'icon_bool_pred',

        'value' => 

        array (

          0 => 'yes',

        )

      )

    ),



    array (

      'admin_label' => false,

      'heading' => 'Content Type',

      'description' => 'Select the content type to be used',

      'param_name' => 'dynamic_content_type',

      'type' => 'dropdown',

      'value' => 

      array (

        'Add Content here' => 'content',

        'Post' => 'post',

        'Page' => 'page'

        

      )

    ),

  

    array (

      'admin_label' => false,

      'heading' => 'Select the post',

      'description' => '',

      'param_name' => 'dynamic_post',

      'type' => 'dropdown',

      'value' => $posts,

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          0 => 'post',

        )

      )

    ),

  

    array (

      'admin_label' => false,

      'heading' => 'Select the page',

      'description' => '',

      'param_name' => 'dynamic_page',

      'type' => 'dropdown',

      'value' => $pages,

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          0 => 'page'

        )

      )

    ),

  

    array (

      'admin_label' => true,

      'heading' => 'Content',

      'value' => '',

      'description' => '',

      'param_name' => 'content',

      'type' => 'textarea_html',

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          'content'

        ),

      ),

    ),

   

    array (

      'admin_label' => false,

      'heading' => 'Link',

      'description' => '',

      'param_name' => 'dynamic_content_link',

      'type' => 'textfield',

      'value' => '#',

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

           'content'

        )

      )

    )

  ),

  'category' => 'Themeple Elements'

));



vc_map( array (

  'base' => 'services_small',

  'name' => 'Services Small',

  'params' => 

  array (



    array (

      'heading' => 'Title:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'title',

      'value' => '',

      'type' => 'textfield',

    ),



    array (

      'heading' => 'Do you want Icon?',

    

      'description' => '',

      'param_name' => 'icon_bool',

      'value' => 

      array (

        'Yes' => 'yes',

        'No' => 'no',

      ),

      'type' => 'dropdown',

    ),

    array (

      'heading' => 'Do you want icon border?',

      'description' => '',

      'param_name' => 'icon_border',

      'value' => 

      array (

        'Yes' => 'yes',

        'No' => 'no',

      ),

      'type' => 'dropdown',

    ),


    array (

      'heading' => 'Do you want predefined Icon?',

     

      'description' => '',

      'param_name' => 'icon_bool_pred',

      'value' => 

      array (

        'Yes' => 'yes',

        'No' => 'no',

      ),

      'type' => 'dropdown',

      'dependency' => 

      array (

        'element' => 'icon_bool',

        'value' => 

        array (

        'yes'

        ),

      ),

    ),



    array (

      'heading' => 'Upload Your Image',

      'description' => '',

      'param_name' => 'upload_img',

      'value' => '',

      'type' => 'attach_image',

      'dependency' => 

      array (

        'element' => 'icon_bool_pred',

        'value' => 

        array (

          'no'

        ),

      ),

    ),



    array (

      'heading' => 'Select Icon',

      'description' => '',

      'param_name' => 'icon',

      'value' => $icon_arr,

      'type' => 'dropdown',

      'dependency' => 

      array (

        'element' => 'icon_bool_pred',

        'value' => 

        array (

           'yes'

        ),

      ),

    ),

    
    array (

      'heading' => 'Set the icon Color',

      'description' => 'Set the Icon Color',

      'param_name' => 'icon_color',

      'value' => "#009dcd",

      'type' => 'colorpicker'


    ),

    array (

      'heading' => 'Read More Link',

      'description' => 'Read More link below the services small',

      'param_name' => 'readmore_bool',

      'type' => 'dropdown',

      'value' => 
     
      array(


            'Yes' => 'yes',
            'No' => 'no'

      ),

     


    ),


    array (

   

      'heading' => 'Content Type',

      'description' => 'Select the content type to be used',

      'param_name' => 'dynamic_content_type',

      'type' => 'dropdown',

      'value' => 

      array (

        'Post' => 'post',

        'Page' => 'page',

        'Add Content here' => 'content',

      ),

    ),



    array (

    

      'heading' => 'Select the post',

      'description' => '',

      'param_name' => 'dynamic_post',

      'type' => 'dropdown',

      'value' => $posts,

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          0 => 'post',

        ),

      ),

    ),



    array (

     

      'heading' => 'Select the page',

      'description' => '',

      'param_name' => 'dynamic_page',

      'type' => 'dropdown',

      'value' => $pages,

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          0 => 'page',

        ),

      ),

    ),



    array (

   

      'heading' => 'Content',

      'description' => '',

      'param_name' => 'dynamic_content_content',

      'type' => 'textarea_html',

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          0 => 'content',

        ),

      ),

    ),



    array (

    

      'heading' => 'Link',

      'description' => '',

      'param_name' => 'dynamic_content_link',

      'type' => 'textfield',

      'value' => '#',

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          0 => 'content',

        ),

      ),

    ),

  ),

  'category' => 'Themeple Elements',

));


vc_map( array (

  'base' => 'services_medium',

  'name' => 'Services Medium',

  'params' => 

  array (



    array (

      'heading' => 'Title:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'title',

      'value' => '',

      'type' => 'textfield'

    ),

   

    array (

      'heading' => 'Do you want Icon?',

      'admin_label' => false,

      'description' => '',

      'param_name' => 'icon_bool',

      'value' => 

      array (

        'Yes' => 'yes',

        'No' => 'no'

      ),

      'type' => 'dropdown'

    ),

  
    array (

      'heading' => 'Select Icon',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'icon',

      'type' => 'dropdown',

      'value' => $icon_arr,

      'dependency' => 

      array (

        'element' => 'icon_bool_pred',

        'value' => 

        array (

          0 => 'yes',

        )

      )

    ),



    array (

      'admin_label' => false,

      'heading' => 'Content Type',

      'description' => 'Select the content type to be used',

      'param_name' => 'dynamic_content_type',

      'type' => 'dropdown',

      'value' => 

      array (

        'Add Content here' => 'content',

        'Post' => 'post',

        'Page' => 'page'

        

      )

    ),

  

    array (

      'admin_label' => false,

      'heading' => 'Select the post',

      'description' => '',

      'param_name' => 'dynamic_post',

      'type' => 'dropdown',

      'value' => $posts,

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          0 => 'post',

        )

      )

    ),

  

    array (

      'admin_label' => false,

      'heading' => 'Select the page',

      'description' => '',

      'param_name' => 'dynamic_page',

      'type' => 'dropdown',

      'value' => $pages,

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          0 => 'page'

        )

      )

    ),

  

    array (

      'admin_label' => true,

      'heading' => 'Content',

      'value' => '',

      'description' => '',

      'param_name' => 'content',

      'type' => 'textarea_html',

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          'content'

        ),

      ),

    ),

   

    array (

      'admin_label' => false,

      'heading' => 'Link',

      'description' => '',

      'param_name' => 'dynamic_content_link',

      'type' => 'textfield',

      'value' => '#',

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

           'content'

        )

      )

    )

  ),

  'category' => 'Themeple Elements'

));



vc_map( array (

  'base' => 'media',

  'name' => 'Media',

  'params' => 

  array (


    array (

      'heading' => 'Select type of media:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'type',

      'value' => 

      array (

        'Image' => 'image',

        'Video' => 'video',

        'Slideshow' => 'slideshow',

      ),

      'type' => 'dropdown',

    ),



    array (

      'heading' => 'Image:',

      'admin_label' => true,

      'param_name' => 'image',

      'type' => 'attach_image',

      'dependency' => 

      array (

        'element' => 'type',

        'value' => 

        array (

          0 => 'image',

        ),

      ),

    ),



    array (

      'heading' => 'Video:',

      'admin_label' => false,

      'param_name' => 'video',

      'type' => 'textfield',

      'value' => '',

      'dependency' => 

      array (

        'element' => 'type',

        'value' => 

        array (

          0 => 'video',

        ),

      ),

    ),



    array (

      'heading' => 'Slideshow:',

      'admin_label' => false,

      'param_name' => 'slideshow',

      'type' => 'dropdown',

      'value' => 

      array (

        'Select From Posts' => 'posts',

        'Select From Pages' => 'pages',

      ),

      'dependency' => 

      array (

        'element' => 'type',

        'value' => 

        array (

          0 => 'slideshow',

        ),

      ),

    ),


    array (

      'heading' => 'Select Post:',

      'admin_label' => false,

      'param_name' => 'slideshow_post',

      'type' => 'dropdown',

      'value' => $posts,

      'dependency' => 

      array (

        'element' => 'slideshow',

        'value' => 

        array (

          0 => 'posts',

        ),

      ),

    ),


    array (

      'heading' => 'Select Page:',

      'admin_label' => true,

      'param_name' => 'slideshow_page',

      'type' => 'dropdown',

      'value' => $pages,

      'dependency' => 

      array (

        'element' => 'slideshow',

        'value' => 

        array (

          0 => 'pages',

        ),

      ),

    ),


    array (

      'heading' => 'Alignment:',

      'admin_label' => false,

      'param_name' => 'alignment',

      'type' => 'dropdown',

      'value' => 

      array (

        'Left' => 'left',

        'center' => 'center',

        'Right' => 'right',

      ),

    ),


    array (

      'heading' => 'Specify Width (px):',

      'admin_label' => false,

      'param_name' => 'width',

      'type' => 'textfield',

      'dependency' => 

      array (

        'element' => 'alignment',

        'value' => 

        array (

          0 => 'center',

        ),

      ),

    ),


    array (

      'heading' => 'Animation',

      'admin_label' => false,

      'param_name' => 'animation',

      'type' => 'dropdown',

      'value' => 

      array (

        'Show From Left' => 'left',

        'Show From Right' => 'right',

        'Show from Top' => 'top',

        'Show From Bottom' => 'bottom',

        'None' => 'none',

      ),

    ),

    array (
      "type" => "checkbox",

        "class" => "",

        "heading" => "Position Absolute",

        "value" => array("Enable position absolute" => "true" ),

        "param_name" => "absolute",

        "description" => ""
    ),
    array (

            'heading' => 'Left:',

            'admin_label' => false,

            'param_name' => 'left',

            'type' => 'textfield',

            'dependency' => 

            array (

              'element' => 'absolute',

              'value' => 

              array (

                0 => 'true',

              ),

            )
      ),

      array (

            'heading' => 'Right:',

            'admin_label' => false,

            'param_name' => 'right',

            'type' => 'textfield',

            'dependency' => 

            array (

              'element' => 'absolute',

              'value' => 

              array (

                0 => 'true',

              ),

            )
      ),

      array (

            'heading' => 'Top:',

            'admin_label' => false,

            'param_name' => 'top',

            'type' => 'textfield',

            'dependency' => 

            array (

              'element' => 'absolute',

              'value' => 

              array (

                0 => 'true',

              ),

            )
      ),

      array (

            'heading' => 'Bottom:',

            'admin_label' => false,

            'param_name' => 'bottom',

            'type' => 'textfield',

            'dependency' => 

            array (

              'element' => 'absolute',

              'value' => 

              array (

                0 => 'true',

              ),

            )
      )

  ),

  'category' => 'Themeple Elements',

));


vc_map( array (

  'base' => 'chart_skill',

  'name' => 'Chart Skill',

  'params' => 

  array (

    array (

      'heading' => 'Percentage %',

      'admin_label' => true,

      'param_name' => 'percent',

      'type' => 'textfield',

      'value' => '',

    ),

    array (

      'heading' => 'Text',

      'admin_label' => true,

      'param_name' => 'text',

      'value' => '',

      'type' => 'textfield',

    ),

     array (

      'heading' => 'Description',

      'admin_label' => true,

      'param_name' => 'desc',

      'value' => '',

      'type' => 'textarea',

    ),

    array(
      
      'heading' => 'Set the color for the chart skill fill line',

      'admin_label' => true,

      'param_name' => 'color_skill',

      'value' => '',

      'type' => 'colorpicker',


    ), 

   


  ),

  'category' => 'Themeple Elements',

));



vc_map( array (

  'base' => 'skills',

  'name' => 'Skills',

  'as_parent' => array('only' => 'skill'),

  'is_container' => false,

  'params' => 

  array (

  ),

  'category' => 'Themeple Elements',

  'js_view' => 'VcColumnView'

));



vc_map( array (

  'base' => 'skill',

  'name' => 'Skill',

  'as_child' => array('only' => 'skills'),

  'content_element' => true,

  'params' => 

  array (



    array (

      'heading' => 'Title',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'title',

      'value' => '',

      'type' => 'textfield',

    ),



    array (

      'heading' => 'Percentage %',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'percentage',

      'value' => '',

      'type' => 'textfield'

    ),

   
    array (

      'heading' => 'Set the color',

      'admin_label' => true,

      'description' => 'Set the color for the skill',

      'param_name' => 'color',

      'type' => 'colorpicker'

    )

    

  ),

  'category' => 'Themeple Elements'

));





/*

vc_map( array (

  'base' => 'section_start',

  'name' => 'Section Start',

  'params' => 

  array (

    0 => 

    array (

      'heading' => 'Select the type of the background',

      'admin_label' => true,

      'param_name' => 'bg_type',

      'type' => 'dropdown',

      'value' => 'bg_color',

    ),

    1 => 

    array (

      'heading' => 'Video Webm source file',

      'admin_label' => true,

      'param_name' => 'webm_video',

      'type' => 'textfield',

      'dependency' => 

      array (

        'element' => 'bg_type',

        'value' => 

        array (

          0 => 'video',

        ),

      ),

      'value' => '',

    ),

    2 => 

    array (

      'heading' => 'Video mp4 source file',

      'admin_label' => true,

      'param_name' => 'mp4_video',

      'type' => 'textfield',

      'dependency' => 

      array (

        'element' => 'bg_type',

        'value' => 

        array (

          0 => 'video',

        ),

      ),

      'value' => '',

    ),

    3 => 

    array (

      'heading' => 'Overlay',

      'admin_label' => true,

      'param_name' => 'overlay',

      'type' => 'dropdown',

      'value' => 

      array (

        'Yes' => 'yes',

        'No' => 'no',

      ),

      'dependency' => 

      array (

        'element' => 'bg_type',

        'value' => 

        array (

          0 => 'video',

        ),

      ),

    ),

    4 => 

    array (

      'heading' => 'Overlay Color',

      'admin_label' => true,

      'param_name' => 'overlay_color',

      'type' => 'colorpicker',

      'dependency' => 

      array (

        'element' => 'overlay',

        'value' => 

        array (

          0 => 'yes',

        ),

      ),

      'value' => 'rgba(0,0,0,0.7)',

    ),

    5 => 

    array (

      'heading' => 'Background Color',

      'admin_label' => true,

      'param_name' => 'bg_color',

      'type' => 'textfield',

      'dependency' => 

      array (

        'element' => 'bg_type',

        'value' => 

        array (

          0 => 'bg_color',

        ),

      ),

      'value' => '#f5f5f5',

    ),

    6 => 

    array (

      'heading' => 'Background Image',

      'admin_label' => true,

      'param_name' => 'image',

      'type' => 'attach_image',

      'dependency' => 

      array (

        'element' => 'bg_type',

        'value' => 

        array (

          0 => 'image',

        ),

      ),

    ),

    7 => 

    array (

      'heading' => 'Do you want fixed image?',

      'admin_label' => true,

      'param_name' => 'fixed_img',

      'type' => 'dropdown',

      'value' => 

      array (

        'Yes' => 'yes',

        'No' => 'no',

      ),

      'dependency' => 

      array (

        'element' => 'bg_type',

        'value' => 

        array (

          0 => 'image',

        ),

      ),

    ),

    8 => 

    array (

      'heading' => 'Parallax BG?',

      'admin_label' => true,

      'param_name' => 'parallax',

      'type' => 'dropdown',

      'value' => 

      array (

        'Yes' => 'yes',

        'No' => 'no',

      ),

      'dependency' => 

      array (

        'element' => 'bg_type',

        'value' => 

        array (

          0 => 'image',

        ),

      ),

    ),

    9 => 

    array (

      'heading' => 'Active Light Version',

      'admin_label' => true,

      'param_name' => 'light_version',

      'description' => 'Active light version if you use a dark section (video, color or image) and you want light version of elements into it.',

      'type' => 'dropdown',

      'value' => 

      array (

        'Yes' => 'yes',

        'No' => 'no',

      ),

    ),

    10 => 

    array (

      'heading' => 'Do you want padding on the top?',

      'admin_label' => true,

      'param_name' => 'padding_top',

      'type' => 'dropdown',

      'value' => 

      array (

        'Yes' => 'yes',

        'No' => 'no',

      ),

    ),

    11 => 

    array (

      'heading' => 'Do you want padding on the bottom?',

      'admin_label' => true,

      'param_name' => 'padding_bottom',

      'type' => 'dropdown',

      'value' => 

      array (

        'Yes' => 'yes',

        'No' => 'no',

      ),

    ),

    12 => 

    array (

      'heading' => 'Do you want borders?',

      'admin_label' => true,

      'param_name' => 'borders',

      'type' => 'dropdown',

      'value' => 

      array (

        'Yes' => 'yes',

        'No' => 'no',

      ),

    ),

    13 => 

    array (

      'heading' => 'Inside Elements Nargin',

      'admin_label' => true,

      'param_name' => 'inside_margin',

      'type' => 'dropdown',

      'value' => 

      array (

        'First Space (40px)' => 'section_space_1',

        'Second Space (30px)' => 'section_space_2',

        'Third Space (90px)' => 'section_space_3',

      ),

    ),

  ),

  'category' => 'Themeple Elements',

));

*/





vc_map( array (

  'base' => 'page_header',

  'name' => 'Page Header',

  'params' =>

  array (


    array (

      'heading' => 'Title',

      'admin_label' => true,

      'param_name' => 'title',

      'type' => 'textfield',

    ),

   

    array (

      'heading' => 'Description',
      
      'admin_label' => true,

      'param_name' => 'content',

      'type' => 'textarea_html',

      ),


    array(

      'heading' => 'Style',

      'admin_label' => true,

      'param_name' => 'style',
      
      'description'=> '',

      'type' => 'dropdown',

      'value' => 
             array (

              'Style 1' => 'style_1',

              'Style 2' => 'style_3',

            ),

      ),
   
    array (

      'heading' => 'Big Title Font Size (px)',

      'admin_label' => true,

      'param_name' => 'size_title',

      'type' => 'textfield',

      'value' => '36',

    ),

    array(

      'heading' => 'Set the title font color',

      'admin_label' => true,

      'param_name' => 'title_color',

      'type' => 'colorpicker',

      'value' => '#222'


      ),

    array(

      'heading' => 'Set the title for the first button',

      'admin_label' => true,

      'param_name' => 'button_1',

      'type' => 'textfield',

      'value' => 'Discover Now',

      'dependency' => 

      array (

        'element' => 'style',

        'value' => 

        array (

          0 => 'style_4',

        ),

      ),


      ),

      array(

      'heading' => 'Set the link for the first button',

      'admin_label' => true,

      'param_name' => 'button_1_link',

      'type' => 'textfield',

      'value' => '#',
      
      'dependency' => 

      array (

        'element' => 'style',

        'value' => 

        array (

          0 => 'style_4',

        ),

      ),


      ),

      array(

      'heading' => 'Set the title for the second button',

      'admin_label' => true,

      'param_name' => 'button_2',

      'type' => 'textfield',

      'value' => 'Purchase Now',

         'dependency' => 

      array (

        'element' => 'style',

        'value' => 

        array (

          0 => 'style_4',

        ),

      ),


      ),

      array(

      'heading' => 'Set the link for the second button',

      'admin_label' => true,

      'param_name' => 'button_2_link',

      'type' => 'textfield',

      'value' => '#',

      'dependency' => 

      array (

        'element' => 'style',

        'value' => 

        array (

          0 => 'style_4',

        ),

      ),



      ),

  
  ),

  'category' => 'Themeple Elements',

));


vc_map( array (

  'base' => 'counter',

  'name' => 'Animated Counter',

  'params' => 

  array (

    array (

      'heading' => 'Number',

      'admin_label' => true,

      'param_name' => 'number',

      'type' => 'textfield',

    ),

    array (

      'heading' => 'Title',

      'admin_label' => true,

      'param_name' => 'text',

      'type' => 'textfield',

      'value' => ''

    ),

    array (

      'heading' => 'Speed',

      'admin_label' => true,

      'value'  => '2000',

      'param_name' => 'speed',

      'type' => 'textfield',

    ),

   
  
    array (

      'heading' => 'Select Icon',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'icon',

      'type' => 'dropdown',

      'value' => $icon_arr,

    ),


  ),

  'category' => 'Themeple Elements',

));



vc_map( array (

  'base' => 'countdown',

  'name' => 'Countdown',

  'params' => 

  array (

    0 => 

    array (

      'heading' => 'Year',

      'admin_label' => true,

      'param_name' => 'year',

      'type' => 'textfield',

    ),

    1 => 

    array (

      'heading' => 'Month',

      'admin_label' => true,

      'param_name' => 'month',

      'type' => 'dropdown',

      'value' => 

      array (

        1 => 1,

        2 => 2,

        3 => 3,

        4 => 4,

        5 => 5,

        6 => 6,

        7 => 7,

        8 => 8, 

        9 => 9,

        10 => 10,

        11 => 11,

        12 => 12,

      ),

    ),

    2 => 

    array (

      'heading' => 'Day',

      'admin_label' => true,

      'param_name' => 'day',

      'type' => 'textfield',

    ),

  ),

  'category' => 'Themeple Elements',

));



vc_map( array (

  'base' => 'price_list',

  'name' => 'Price List',

  'as_parent' => array('only' => 'list_price'),

  'is_container' => true,

  'params' => 


  array (

    0 => 

    array (

      'heading' => 'Title',

      'admin_label' => true,

      'param_name' => 'title',

      'type' => 'textfield',

      'value' => '',

    ),

    1 => 

    array (

      'heading' => 'Title Font Color',

      'admin_label' => true,

      'param_name' => 'title_color',

      'type' => 'textfield',

      'value' => '',

    ),

    2 => 

    array (

      'heading' => 'Price',

      'admin_label' => true,

      'param_name' => 'price',

      'type' => 'textfield',

      'value' => '',

    ),

    3 => 

    array (

      'heading' => 'Currency',

      'admin_label' => true,

      'param_name' => 'currency',

      'type' => 'textfield',

      'value' => '$',

    ),

    4 => 

    array (

      'heading' => 'Price Font Color',

      'admin_label' => true,

      'param_name' => 'price_color',

      'type' => 'textfield',

      'value' => '',

    ),

    5 => 

    array (

      'heading' => 'Period',

      'admin_label' => true,

      'param_name' => 'period',

      'type' => 'textfield',

      'value' => '',

    ),

    6 => 

    array (

      'heading' => 'Period Font Color',

      'admin_label' => true,

      'param_name' => 'period_color',

      'type' => 'textfield',

      'value' => '#f1663a',

    ),

    7 => 

    array (

      'heading' => 'Button Tittle',

      'admin_label' => true,

      'param_name' => 'button_title',

      'type' => 'textfield',

      'value' => '',

    ),

    8 => 

    array (

      'heading' => 'Button Link',

      'admin_label' => true,

      'param_name' => 'button_link',

      'type' => 'textfield',

      'value' => '',

    ),

    9 => 

    array (

      'heading' => 'Highlight this price table',

      'admin_label' => true,

      'param_name' => 'highlight_table',

      'type' => 'dropdown',

      'value' => 

      array (

        'Yes' => 'yes',

        'No' => 'no',

      ),

    ),

    10 => 

    array (

      'heading' => 'First Color for highlight table',

      'admin_label' => true,

      'param_name' => 'first_color',

      'type' => 'textfield',

      'value' => '',

    ),

    11 => 

    array (

      'heading' => 'Second Color for highlight table',

      'admin_label' => true,

      'param_name' => 'second_color',

      'type' => 'textfield',

      'value' => '',

    ),

    12 => 

    array (

      'heading' => 'Block Title',

      'admin_label' => true,

      'param_name' => 'dynamic_title',

      'type' => 'textfield',

    )

  ),

  'category' => 'Themeple Elements',

));



vc_add_param("vc_row", array(

  "type" => "dropdown",

  "class" => "",

  "heading" => "Type",

  "param_name" => "type",

  "value" => array(

    "In Container" => "in_container",

    "Full Width Background" => "full_width_background",

    "Full Width Content" => "full_width_content"    

  )

));



vc_add_param("vc_row", array(

  "type" => "attach_image",

  "class" => "",

  "heading" => "Background Image",

  "param_name" => "bg_image",

  "value" => "",

  "description" => ""

));


vc_add_param("vc_row", array(

  "type" => "dropdown",

  "class" => "",

  "heading" => "Background Position",

  "param_name" => "bg_position",

  "value" => array(

     "Left Top" => "left top",

       "Left Center" => "left center",

       "Left Bottom" => "left bottom",

       "Center Top" => "center top",

       "Center Center" => "center center",

       "Center Bottom" => "center bottom",

       "Right Top" => "right top",

       "Right Center" => "right center",

       "Right Bottom" => "right bottom"

  ),

  "dependency" => Array('element' => "bg_image", 'not_empty' => true)

));



vc_add_param("vc_row", array(

  "type" => "dropdown",

  "class" => "",

  "heading" => "Background Repeat",

  "param_name" => "bg_repeat",

  "value" => array(

    "No Repeat" => "no-repeat",

    "Repeat" => "repeat"

  ),

  "dependency" => Array('element' => "bg_image", 'not_empty' => true)

));



vc_add_param("vc_row", array(

  "type" => "checkbox",

  "class" => "",

  "heading" => "Parallax Background",

  "value" => array("Enable Parallax Background?" => "true" ),

  "param_name" => "parallax_bg",

  "description" => "",

  "dependency" => Array('element' => "bg_image", 'not_empty' => true)

));



vc_add_param("vc_row", array(

  "type" => "colorpicker",

  "class" => "",

  "heading" => "Background Color",

  "param_name" => "bg_color",

  "value" => "",

  "description" => ""

));





vc_add_param("vc_row", array(

  "type" => "checkbox",

  "class" => "",

  "heading" => "Overlay",

  "value" => array("Enable a color overlay? " => "true" ),

  "param_name" => "overlay",

  "description" => ""

));



vc_add_param("vc_row", array(

  "type" => "colorpicker",

  "class" => "",

  "heading" => "Overlay Color",

  "param_name" => "overlay_color",

  "value" => "",

  "description" => "",

  "dependency" => Array('element' => "overlay", 'value' => array('true'))

));


vc_add_param("vc_row", array(

  "type" => "textfield",

  "class" => "",

  "heading" => "Overlay Opacity",

  "value" => "0.65",

  "param_name" => "overlay_opacity",

  "description" => "",

  "dependency" => Array('element' => "overlay", 'value' => array('true'))

));

vc_add_param("vc_row", array(

  "type" => "textfield",

  "class" => "",

  "heading" => "Overlay zIndex",

  "value" => "1",

  "param_name" => "overlay_zindex",

  "description" => "",

  "dependency" => Array('element' => "overlay", 'value' => array('true'))

));

vc_add_param("vc_row", array(

  "type" => "checkbox",

  "class" => "",

  "heading" => "Video Background",

  "value" => array("Enable Video Background?" => "use_video" ),

  "param_name" => "video_bg",

  "description" => ""

));

vc_remove_param("vc_column", "el_class");

vc_add_param("vc_column", array(
      "type" => "checkbox",
      "class" => "",
      "heading" => "Centered Content",
      "value" => array("Centered Content Alignment" => "true" ),
      "param_name" => "centered_cont",
      "description" => ""
));

vc_add_param("vc_column", array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Assign Padding to this column",
      "param_name" => "column_padding",
      "value" => '',
      "description" => "Use this in case you have created a full width content row. For ex: 10%"
));


vc_add_param("vc_column", array(
      "type" => "colorpicker",
      "class" => "",
      "heading" => "Background Color",
      "param_name" => "background_color",
      "value" => "",
      "description" => "",
));

vc_add_param("vc_column", array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Background Color Opacity",
      "param_name" => "background_color_opacity",
      "value" => '1'
      
));

vc_add_param("vc_column", array(
      "type" => "fws_image",
      "class" => "",
      "heading" => "Background Image",
      "param_name" => "background_image",
      "value" => "",
      "description" => "",
));

vc_add_param("vc_column", array(
      "type" => "colorpicker",
      "class" => "",
      "heading" => "Font Color",
      "param_name" => "font_color",
      "value" => "",
      "description" => ""
));

vc_add_param("vc_column", array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Extra Class Name",
      "param_name" => "el_class",
      "value" => ""
));

vc_remove_param("vc_column_inner", "el_class");


vc_add_param("vc_column_inner", array(
      "type" => "checkbox",
      "class" => "",
      "heading" => "Centered Content",
      "value" => array("Centered Content Alignment" => "true" ),
      "param_name" => "centered_cont",
      "description" => ""
));

vc_add_param("vc_column_inner", array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Assign Padding to this column",
      "param_name" => "column_padding",
      "value" => '',
      "description" => "Use this in case you have created a full width content row. For ex: 10%"
));


vc_add_param("vc_column_inner", array(
      "type" => "colorpicker",
      "class" => "",
      "heading" => "Background Color",
      "param_name" => "background_color",
      "value" => "",
      "description" => "",
));

vc_add_param("vc_column_inner", array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Background Color Opacity",
      "param_name" => "background_color_opacity",
      "value" => '1'
      
));

vc_add_param("vc_column_inner", array(
      "type" => "fws_image",
      "class" => "",
      "heading" => "Background Image",
      "param_name" => "background_image",
      "value" => "",
      "description" => "",
));

vc_add_param("vc_column_inner", array(
      "type" => "colorpicker",
      "class" => "",
      "heading" => "Font Color",
      "param_name" => "font_color",
      "value" => "",
      "description" => ""
));

vc_add_param("vc_column_inner", array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Extra Class Name",
      "param_name" => "el_class",
      "value" => ""
));


/* Services Box Color */

vc_map(array(

      'base' => 'services_box_color',
     
      'name' => 'Services Box Color',

      'category' => 'Themeple Elements',

      'params' => 
            
      array (



          array (

            'heading' => 'Title:',

            'admin_label' => true,

            'description' => '',

            'param_name' => 'title',

            'value' => '',

            'type' => 'textfield'

          ),

           array (

            'heading' => 'Link:',

            'admin_label' => true,

            'description' => 'Add the link for the box',

            'param_name' => 'link',

            'value' => '#',

            'type' => 'textfield'

          ),
         

          array (

            'heading' => 'Do you want Icon?',

            'admin_label' => false,

            'description' => '',

            'param_name' => 'icon_bool',

            'value' => 

            array (

              'Yes' => 'yes',

              'No' => 'no'

            ),

            'type' => 'dropdown'

          ),

        
          array (

            'heading' => 'Select Icon',

            'admin_label' => true,

            'description' => '',

            'param_name' => 'icon',

            'type' => 'dropdown',

            'value' => $icon_arr,

            'dependency' => 

            array (

              'element' => 'icon_bool_pred',

              'value' => 

              array (

                0 => 'yes',

              )

            )

          ),

          array(

            'heading' => 'Select Color',

            'admin_label' => true,

            'param_name' => 'color_box',

            'description' => 'Set the color that you will use for the box',

            'type' => 'colorpicker'




            )

      )
   


      ));

/* End Services Box Color */


vc_map(array(

      'base' => 'services_boxed',
     
      'name' => 'Services Boxed',

      'category' => 'Themeple Elements',

      'params' => 
            
      array (



          array (

            'heading' => 'Title:',

            'admin_label' => true,

            'description' => '',

            'param_name' => 'title',

            'value' => '',

            'type' => 'textfield'

          ),

         

          array (

            'heading' => 'Do you want Icon?',

            'admin_label' => false,

            'description' => '',

            'param_name' => 'icon_bool',

            'value' => 

            array (

              'Yes' => 'yes',

              'No' => 'no'

            ),

            'type' => 'dropdown'

          ),

        
          array (

            'heading' => 'Select Icon',

            'admin_label' => true,

            'description' => '',

            'param_name' => 'icon',

            'type' => 'dropdown',

            'value' => $icon_arr,

            'dependency' => 

            array (

              'element' => 'icon_bool_pred',

              'value' => 

              array (

                0 => 'yes'

              )

            )

          ),

           array (

      'admin_label' => false,

      'heading' => 'Content Type',

      'description' => 'Select the content type to be used',

      'param_name' => 'dynamic_content_type',

      'type' => 'dropdown',

      'value' => 

      array (

        'Add Content here' => 'content',

        'Post' => 'post',

        'Page' => 'page'

        

      )

    ),

  

    array (

      'admin_label' => false,

      'heading' => 'Select the post',

      'description' => '',

      'param_name' => 'dynamic_post',

      'type' => 'dropdown',

      'value' => $posts,

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          0 => 'post',

        )

      )

    ),

  

    array (

      'admin_label' => false,

      'heading' => 'Select the page',

      'description' => '',

      'param_name' => 'dynamic_page',

      'type' => 'dropdown',

      'value' => $pages,

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          0 => 'page'

        )

      )

    ),

  

    array (

      'admin_label' => true,

      'heading' => 'Content',

      'value' => '',

      'description' => '',

      'param_name' => 'content',

      'type' => 'textarea_html',

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

          'content'

        ),

      ),

    ),

   
      array (

            'heading' => 'Read More link:',

            'admin_label' => false,

            'description' => '',

            'param_name' => 'button',

            'value' => '',

            'type' => 'textfield'

          ),


    array (

      'admin_label' => false,

      'heading' => 'Link',

      'description' => '',

      'param_name' => 'dynamic_content_link',

      'type' => 'textfield',

      'value' => '#',

      'dependency' => 

      array (

        'element' => 'dynamic_content_type',

        'value' => 

        array (

           'content'

        )

      )

   )



   ),




));




vc_map( array (

  'base' => 'services_media',

  'name' => 'Services Media',

  'params' => 

  array (

    0 => 

    array (

      'heading' => 'Title:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'title',

      'value' => '',

      'type' => 'textfield',

    ),

    1 => 

    array (

      'heading' => 'Type of Media ?',

      'admin_label' => false,

      'description' => '',

      'param_name' => 'type',

      'value' => 

      array (

        'Image' => 'img',

        'Video' => 'video',

      ),

      'type' => 'dropdown',

    ),

    2 => 

    array (

      'heading' => 'Upload Photo',

      'admin_label' => false,

      'description' => '',

      'param_name' => 'photo',

      'value' => '',

      'type' => 'attach_image',

      'dependency' => 

      array (

        'element' => 'type',

        'value' => 

        array (

          0 => 'img',

        ),

      ),

    ),

    3 => 

    array (

      'heading' => 'Video',

      'admin_label' => false,

      'description' => '',

      'param_name' => 'video',

      'value' => '',

      'type' => 'textfield',

      'dependency' => 

      array (

        'element' => 'type',

        'value' => 

        array (

          0 => 'video',

        ),

      ),

    ),

    4 => 

    array (

      'heading' => 'Description',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'content',

      'value' => '',

      'type' => 'textarea_html',

    ),

    5 => 

    array (

      'admin_label' => false,

      'heading' => 'Link',

      'description' => '',

      'param_name' => 'link',

      'type' => 'textfield',

      'value' => '#',

    ),

      6 => 

    array (

      'admin_label' => false,

      'heading' => 'Circle Shape',

      'description' => 'Do you want to made the services with cirlce shape ',

      'param_name' => 'circle_shape',

      'type' => 'dropdown',

      'value' => 

      array(
            
            'no' => 'no',

            'yes' => 'yes' 
      ),

    ),

  ),

  'category' => 'Themeple Elements',

));



vc_add_param("vc_row", array(

  "type" => "textfield",

  "class" => "",

  "heading" => "WebM File URL",

  "value" => "",

  "param_name" => "video_webm",

  "description" => "Webm video file url",

  "dependency" => Array('element' => "video_bg", 'value' => array('use_video'))

));



vc_add_param("vc_row", array(

  "type" => "textfield",

  "class" => "",

  "heading" => "MP4 File URL",

  "value" => "",

  "param_name" => "video_mp4",

  "description" => "Mp4 video file url",

  "dependency" => Array('element' => "video_bg", 'value' => array('use_video'))

));





vc_add_param("vc_row", array(

  "type" => "dropdown",

  "class" => "",

  "heading" => "Text Color",

  "param_name" => "text_color",

  "value" => array(

    "Dark" => "dark",

    "Light" => "light",

    "Custom" => "custom"

  )

));



vc_add_param("vc_row", array(

  "type" => "colorpicker",

  "class" => "",

  "heading" => "Custom Text Color",

  "param_name" => "custom_text_color",

  "value" => "",

  "description" => "",

  "dependency" => Array('element' => "text_color", 'value' => array('custom'))

));





vc_add_param("vc_row", array(

  "type" => "textfield",

  "class" => "",

  "heading" => "Padding Top",

  "value" => "0",

  "param_name" => "top_padding",

  "description" => "Without px"

));



vc_add_param("vc_row", array(

  "type" => "textfield",

  "class" => "",

  "heading" => "Padding Bottom",

  "value" => "0",

  "param_name" => "bottom_padding",

  "description" => "Without px"

));

vc_add_param("vc_row", array(

  "type" => "checkbox",

  "class" => "",

  "heading" => "Transparency Section to be used with Slider",

  "value" => array("Enable Transparency" => true ),

  "param_name" => "transparency",

  "description" => "Check this if you want to use this section as a transparent section on the slider."

));

vc_add_param("vc_row", array(

  "type" => "checkbox",

  "class" => "",

  "heading" => "Add borders",

  "value" => array("Check to add section borders" => true ),

  "param_name" => "borders",

  "description" => "Check this if you want to add the borders top and bottom of this section"

));

vc_add_param("vc_row", array(

  "type" => "checkbox",

  "class" => "",

  "heading" => "Top Arrow",

  "value" => array("Check to active top arrow" => true ),

  "param_name" => "triangle_top",

  "description" => "Check if you want a triangle in top of the section"

));

vc_add_param("vc_row", array(

  "type" => "checkbox",

  "class" => "",

  "heading" => "Bottom Arrow",

  "value" => array("Check to active bottom arrow" => true ),

  "param_name" => "triangle_bottom",

  "description" => "Check if you want a triangle in bottom of the section"

));

vc_add_param("vc_row", array(

  "type" => "checkbox",

  "class" => "",

  "heading" => "Seperate Sections",

  "value" => array("Check to seperate sections vertically" => "second_yes" ),

  "param_name" => "second_section",

  "description" => "After check you can select options like background, overlay and video for the second section"

));


vc_add_param("vc_row", array(

  "type" => "attach_image",

  "class" => "",

  "heading" => "Background Image",

  "param_name" => "bg_image_2",

  "value" => "",

  "description" => "",

  "dependency" => Array('element' => "second_section", 'value' => array("second_yes"))

));



vc_add_param("vc_row", array(

  "type" => "dropdown",

  "class" => "",

  "heading" => "Background Position",

  "param_name" => "bg_position_2",

  "value" => array(

     "Left Top" => "left top",

       "Left Center" => "left center",

       "Left Bottom" => "left bottom",

       "Center Top" => "center top",

       "Center Center" => "center center",

       "Center Bottom" => "center bottom",

       "Right Top" => "right top",

       "Right Center" => "right center",

       "Right Bottom" => "right bottom"

  ),

  "dependency" => Array('element' => "bg_image_2", 'not_empty' => array('true'))

));



vc_add_param("vc_row", array(

  "type" => "dropdown",

  "class" => "",

  "heading" => "Background Repeat",

  "param_name" => "bg_repeat_2",

  "value" => array(

    "No Repeat" => "no-repeat",

    "Repeat" => "repeat"

  ),

  "dependency" => Array('element' => "bg_image_2", 'not_empty' => array('true'))

));



vc_add_param("vc_row", array(

  "type" => "checkbox",

  "class" => "",

  "heading" => "Parallax Background",

  "value" => array("Enable Parallax Background?" => "true" ),

  "param_name" => "parallax_bg_2",

  "description" => "",

  "dependency" => Array('element' => "bg_image_2", 'not_empty' => true)

));



vc_add_param("vc_row", array(

  "type" => "colorpicker",

  "class" => "",

  "heading" => "Background Color",

  "param_name" => "bg_color_2",

  "value" => "",

  "description" => "",

  "dependency" => Array('element' => "second_section", 'value' => array("second_yes"))

));





vc_add_param("vc_row", array(

  "type" => "checkbox",

  "class" => "",

  "heading" => "Overlay",

  "value" => array("Enable a color overlay? " => "true" ),

  "param_name" => "overlay_2",

  "description" => "",

  "dependency" => Array('element' => "second_section", 'value' => array("second_yes"))

));



vc_add_param("vc_row", array(

  "type" => "colorpicker",

  "class" => "",

  "heading" => "Overlay Color",

  "param_name" => "overlay_color_2",

  "value" => "",

  "description" => "",

  "dependency" => Array('element' => "overlay_2", 'value' => array('true'))

));


vc_add_param("vc_row", array(

  "type" => "textfield",

  "class" => "",

  "heading" => "Overlay Opacity",

  "value" => "0.65",

  "param_name" => "overlay_opacity_2",

  "description" => "",

  "dependency" => Array('element' => "overlay_2", 'value' => array('true'))

));

vc_add_param("vc_row", array(

  "type" => "textfield",

  "class" => "",

  "heading" => "Overlay zIndex",

  "value" => "1",

  "param_name" => "overlay_zindex_2",

  "description" => "",

  "dependency" => Array('element' => "overlay_2", 'value' => array('true'))

));

vc_add_param("vc_row", array(

  "type" => "checkbox",

  "class" => "",

  "heading" => "Video Background",

  "value" => array("Enable Video Background?" => "use_video" ),

  "param_name" => "video_bg_2",

  "description" => "",

  "dependency" => Array('element' => "second_section", 'value' => array("second_yes"))

));







vc_add_param("vc_row", array(

  "type" => "textfield",

  "class" => "",

  "heading" => "WebM File URL",

  "value" => "",

  "param_name" => "video_webm_2",

  "description" => "Webm video file url",

  "dependency" => Array('element' => "video_bg_2", 'value' => array('use_video'))

));



vc_add_param("vc_row", array(

  "type" => "textfield",

  "class" => "",

  "heading" => "MP4 File URL",

  "value" => "",

  "param_name" => "video_mp4_2",

  "description" => "Mp4 video file url",

  "dependency" => Array('element' => "video_bg_2", 'value' => array('use_video'))

));



vc_add_param("vc_row", array(

  "type" => "textfield",

  "class" => "",

  "heading" => "Extra Class Name",

  "param_name" => "class",

  "value" => ""

));

vc_add_param("vc_row", array(

  "type" => "textfield",

  "class" => "",

  "description" => "Use this name as id for menu in 'One Page'",

  "heading" => "Section Name",

  "param_name" => "section_name",

  "value" => ""

));


/*vc_add_param("vc_tabs", array(

  "type" => "dropdown",

  "class" => "",

  "heading" => "Position",

  "param_name" => "position",

  "value" => array(

    "Top" => "top",

    "Left" => "left"

  )

));*/




vc_add_param("vc_accordion_tab", array(

  "type" => "checkbox",

  "class" => "",

  "heading" => "Open?",

  "param_name" => "open",

  "value" => array("Check to make this accordion open" => true ),

));



vc_remove_param("vc_tabs", "interval");

vc_remove_param("vc_accordion", "collapsible");

vc_remove_param("vc_accordion", "interval");

vc_remove_param("vc_accordion", "active_tab");




vc_map( array (

  'base' => 'contact_info',

  'name' => 'Contact Info',

  'params' => 

  array (

    array (

      'heading' => 'Title:',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'title',

      'value' => '',

      'type' => 'textfield',

    ),

    array (

      'heading' => 'Description',

      'admin_label' => true,

      'description' => '',

      'param_name' => 'content',

      'value' => '',

      'type' => 'textarea_html',

    ),

  ),

  'category' => 'Themeple Elements',

));






class WPBakeryShortCode_Plain_Text extends WPBakeryShortCode {



}



class WPBakeryShortCode_Recent_Portfolio extends WPBakeryShortCode {



}



class WPBakeryShortCode_Recent_News extends WPBakeryShortCode {



}



class WPBakeryShortCode_Latest_Blog extends WPBakeryShortCode {



}



class WPBakeryShortCode_Home_Blog extends WPBakeryShortCode {



}



class WPBakeryShortCode_Home_Portfolio extends WPBakeryShortCode {



}



class WPBakeryShortCode_Faq extends WPBakeryShortCode {



}



class WPBakeryShortCode_Staff extends WPBakeryShortCode {



}



class WPBakeryShortCode_Slideshow extends WPBakeryShortCode {



}



class WPBakeryShortCode_Single_Testimonial extends WPBakeryShortCode {



}



class WPBakeryShortCode_Clients extends WPBakeryShortCode {



}



class WPBakeryShortCode_Divider extends WPBakeryShortCode {



}



class WPBakeryShortCode_Contact_Form extends WPBakeryShortCode {



}

class WPBakeryShortCode_Contact_Info extends WPBakeryShortCode {



}



class WPBakeryShortCode_El_Head extends WPBakeryShortCode {



}



class WPBakeryShortCode_Textbar extends WPBakeryShortCode {



}

class WPBakeryShortCode_Services_Slideshow extends WPBakeryShortCode {



}

class WPBakeryShortCode_Services_Small extends WPBakeryShortCode {



}

class WPBakeryShortCode_Services_List extends WPBakeryShortCodesContainer {

           

}



class WPBakeryShortCode_List_Item extends WPBakeryShortCode {

           

}

class WPBakeryShortCode_Services_Medium extends WPBakeryShortCode {



}

class WPBakeryShortCode_Services_Boxed extends WPBakeryShortCode {



}

class WPBakeryShortCode_Services_Box_Color extends WPBakeryShortCode {



}

class WPBakeryShortCode_Services_Step extends WPBakeryShortCode{



}



class WPBakeryShortCode_Services_Media extends WPBakeryShortCode {



}



class WPBakeryShortCode_Media extends WPBakeryShortCode {



}




class WPBakeryShortCode_Chart_Skill extends WPBakeryShortCode {

           

}



class WPBakeryShortCode_Skills extends WPBakeryShortCodesContainer {

           

}



class WPBakeryShortCode_Skill extends WPBakeryShortCode {

           

}


class WPBakeryShortCode_List_Price extends WPBakeryShortCode{


}


class WPBakeryShortCode_Page_Header extends WPBakeryShortCode {



}



class WPBakeryShortCode_Countdown extends WPBakeryShortCode {



}



class WPBakeryShortCode_Google_Map extends WPBakeryShortCode {



}


class WPBakeryShortCode_Counter extends WPBakeryShortCode {

}

class WPBakeryShortcode_Price_List extends WPBakeryShortCodesContainer{
      
}

class WPBakeryShortcode_Simple_Testimonial extends WPBakeryShortCode{
      
}

?>