<div class="menu-small">
	
	<?php
		$menu_name = 'main';

	    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
			$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

			$menu_items = wp_get_nav_menu_items($menu->term_id);

			$menu_list = '<ul class="menu">';

			foreach ( (array) $menu_items as $key => $menu_item ) {
			    $title = $menu_item->title;
			    $url = $menu_item->url;
			    $menu_list .= '<li><a href="' . $url . '">' . $title . '</a></li>';
			}
			$menu_list .= '</ul>';
	    } else {
			$menu_list = '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';
	    } 
	    
	    /*$args = array("theme_location" => "main", "container" => false, "fallback_cb" => 'themeple_fallback_menu');
	    
	    wp_nav_menu($args);    */
	    echo $menu_list;
	?>
	
</div>