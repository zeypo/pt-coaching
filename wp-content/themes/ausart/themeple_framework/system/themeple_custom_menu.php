<?php if(!defined('THEMEPLE_FRAMEWORK')) exit("Direct script access not allowed");

/*

     * themeple_custom_menu

     * 

     * @package   

     * @author roshi

     * @copyright roshi[www.themeforest.net/user/roshi]

     * @version 2012

     * @access public

     *

*/





if( !class_exists( 'themeple_custom_menu' ) )

{	



	

	class themeple_custom_menu

	{

		

		

		function themeple_custom_menu()

		{

			

			add_action( 'wp_update_nav_menu_item', array(&$this,'update_menu'), 100, 3);

			add_filter('wp_nav_menu_args', array(&$this,'change_menu_arguments'), 100);

			add_action('admin_menu', array(&$this,'add_media'));

			add_filter( 'wp_edit_nav_menu_walker', array(&$this,'change_backend_walker') , 100);

			

  	

		}





		

		function update_menu($menu_id, $menu_item_db)

		{	

			$check = array('megamenu', 'widgetized' );

			

			foreach ( $check as $key )

			{

				if(!isset($_POST['menu-item-custom_themeple-'.$key][$menu_item_db]))

				{

					$_POST['menu-item-custom_themeple-'.$key][$menu_item_db] = "";

				}

				

				$value = $_POST['menu-item-custom_themeple-'.$key][$menu_item_db];

				update_post_meta( $menu_item_db, '_menu-item-custom_themeple-'.$key, $value );

			}

		}

		

		function change_backend_walker($name)

		{

			return 'themeple_custom_menu_backend';

		}



		function add_media()

		{

			if(basename( $_SERVER['PHP_SELF']) == "nav-menus.php" )

			{	

				wp_enqueue_style(  'themeple_custom_menu', THEMEPLE_CSS_URL . 'themeple_custom_menu.css'); 

				wp_enqueue_script( 'themeple_custom_menu' , THEMEPLE_JS_URL . 'themeple_custom_menu.js',array('jquery', 'jquery-ui-sortable'), false, true ); 

			}

		}

		

		function change_menu_arguments($arguments){

			$arguments['walker'] = new custom_walker();				

			$arguments['container_class'] .= ' megamenu_container';

			$arguments['menu_class'] .= ' themeple_megemenu';



			return $arguments;

		}

		

		

		

	}

}







if( !class_exists( 'custom_walker' ) )

{



	class custom_walker extends Walker {

		/**

		 * @see Walker::$tree_type

		 * @var string

		 */

		var $tree_type = array( 'post_type', 'taxonomy', 'custom' );

	

		/**

		 * @see Walker::$db_fields

		 * @todo Decouple this.

		 * @var array

		 */

		var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

	

		/**

		 * @var int $columns 

		 */

		var $columns = 0;

		

		/**

		 * @var int $max_columns maximum number of columns within one mega menu 

		 */

		var $max_columns = 0;

		

		/**

		 * @var int $rows holds the number of rows within the mega menu 

		 */

		var $rows = 1;

		

		/**

		 * @var array $rowsCounter holds the number of columns for each row within a multidimensional array

		 */

		var $rowsCounter = array();

		

		/**

		 * @var string $mega_active hold information whetever we are currently rendering a mega menu or not

		 */

		var $mega_active = 0;

	

	

	

		/**

		 * @see Walker::start_lvl()

		 *

		 * @param string $output Passed by reference. Used to append additional content.

		 * @param int $depth Depth of page. Used for padding.

		 */

		function start_lvl(&$output, $depth = 0, $args = array() ) {

			$indent = str_repeat("\t", $depth);

			if($depth === 0) $output .= "\n{replace_one}\n";

			$class = '';

			if($depth == 0 && !$this->mega_active)

				$class = 'non_mega_menu';

			$output .= "\n$indent<ul class=\"sub-menu $class\">\n";

		}

	

		/**

		 * @see Walker::end_lvl()

		 *

		 * @param string $output Passed by reference. Used to append additional content.

		 * @param int $depth Depth of page. Used for padding.

		 */

		function end_lvl(&$output, $depth = 0, $args= array()) {

			$indent = str_repeat("\t", $depth);

			$output .= "$indent</ul>\n";

			

			if($depth === 0) 

			{

				if($this->mega_active)

				{



					$output .= "\n</div>\n";

					$output = str_replace("{replace_one}", "<div class='themeple_custom_menu_mega_menu themeple_mega".$this->max_columns."'>", $output);

					

					foreach($this->rowsCounter as $row => $columns)

					{

						$output = str_replace("{current_row_".$row."}", "themeple_custom_menu_columns".$columns, $output);

					}

					

					$this->columns = 0;

					$this->max_columns = 0;

					$this->rowsCounter = array();

					

				}

				else

				{

					$output = str_replace("{replace_one}", "", $output);

				}

			}

		}

	

		/**

		 * @see Walker::start_el()

		 *

		 * @param string $output Passed by reference. Used to append additional content.

		 * @param object $item Menu item data object.

		 * @param int $depth Depth of menu item. Used for padding.

		 * @param int $current_page Menu item ID.

		 * @param object $args

		 */

		function start_el(&$output, $item, $depth = 0, $args = array(),  $current_object_id = 0) {

			global $wp_query;

			

			//set maxcolumns

			if(!isset($args->max_columns)) $args->max_columns = 6;



			

			$item_output = $li_text_block_class = $column_class = "";

			

			if($depth === 0)

			{	

				$this->mega_active = get_post_meta( $item->ID, '_menu-item-custom_themeple-megamenu', true);

			}

			

			

			if($depth === 1 && $this->mega_active)

			{

				$this->columns ++;

				

				//check if we have more than $args['max_columns'] columns or if the user wants to start a new row

				if($this->columns > $args->max_columns)

				{

					$this->columns = 1;

					

				}

				

				$this->rowsCounter[$this->rows] = $this->columns;

				

				if($this->max_columns < $this->columns) $this->max_columns = $this->columns;

				

				

				$title = apply_filters( 'the_title', $item->title, $item->ID );

				

				if($title != "-" && $title != '"-"') //fallback for people who copy the description o_O

				{

					$item_output .= "<h4>".$title."</h4>";

				}

				

				$column_class  = ' {current_row_'.$this->rows.'}';

				

				if($this->columns == 1)

				{

					$column_class  .= " themeple_custom_menu_first_col";

				}

			}

			

			else

			{

				$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';

				$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';

				$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';

				$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';			

			

				$item_output .= $args->before;

				$item_output .= '<a'. $attributes .'>';

				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

				$item_output .= '</a>';

				$item_output .= $args->after;

			}

			

			

			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			$class_names = $value = '';

	

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;

	

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );

			$class_names = ' class="'.$li_text_block_class. esc_attr( $class_names ) . $column_class.'"';

	

			$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

			

			

			

			

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

		}

	

		/**

		 * @see Walker::end_el()

		 *

		 * @param string $output Passed by reference. Used to append additional content.

		 * @param object $item Page data object. Not used.

		 * @param int $depth Depth of page. Not Used.

		 */

		function end_el(&$output, $item, $depth = 0, $args= array()) {

			$output .= "</li>\n";

		}

	}

}











if( !class_exists( 'themeple_custom_menu_backend' ) )

{

/**

 * Create HTML list of nav menu input items. 

 * This walker is a clone of the wordpress edit menu walker with some options appended, so the user can choose to create mega menus

 *

 * @package AviaFramework

 * @since 1.0

 * @uses Walker_Nav_Menu

 */

	class themeple_custom_menu_backend extends Walker_Nav_Menu  

	{

		/**

		 * @see Walker_Nav_Menu::start_lvl()

		 * @since 3.0.0

		 *

		 * @param string $output Passed by reference.

		 * @param int $depth Depth of page.

		 */

		function start_lvl(&$output, $depth = 0, $args= array()) {}

	

		/**

		 * @see Walker_Nav_Menu::end_lvl()

		 * @since 3.0.0

		 *

		 * @param string $output Passed by reference.

		 * @param int $depth Depth of page.

		 */

		function end_lvl(&$output,$depth = 0, $args= array()) {

		}

	

		/**

		 * @see Walker::start_el()

		 * @since 3.0.0

		 *

		 * @param string $output Passed by reference. Used to append additional content.

		 * @param object $item Menu item data object.

		 * @param int $depth Depth of menu item. Used for padding.

		 * @param int $current_page Menu item ID.

		 * @param object $args

		 */

		function start_el(&$output, $item, $depth = 0, $args = array() , $current_object_id = 0) {

			global $_wp_nav_menu_max_depth;

			$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

	

			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

	

			ob_start();

			$item_id = esc_attr( $item->ID );

			$removed_args = array(

				'action',

				'customlink-tab',

				'edit-menu-item',

				'menu-item',

				'page-tab',

				'_wpnonce',

			);

	

			$original_title = '';

			if ( 'taxonomy' == $item->type ) {

				$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );

			} elseif ( 'post_type' == $item->type ) {

				$original_object = get_post( $item->object_id );

				$original_title = $original_object->post_title;

			}

	

			$classes = array(

				'menu-item menu-item-depth-' . $depth,

				'menu-item-' . esc_attr( $item->object ),

				'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),

			);

	

			$title = $item->title;

	

			if ( isset( $item->post_status ) && 'draft' == $item->post_status ) {

				$classes[] = 'pending';

				/* translators: %s: title of menu item in draft status */

				$title = sprintf( __('%s (Pending)', 'themeple'), $item->title );

			}

	

			$title = empty( $item->label ) ? $title : $item->label;

			

			$itemValue = "";

			if($depth == 0)

			{

				$itemValue = get_post_meta( $item->ID, '_menu-item-custom_themeple-megamenu', true);

				if($itemValue != "") $itemValue = 'themeple_custom_active ';

			}

			

			?>

			

			<li id="menu-item-<?php echo esc_attr($item_id); ?>" class="<?php echo esc_attr($itemValue); echo implode(' ', $classes ); ?>">

				<dl class="menu-item-bar">

					<dt class="menu-item-handle">

						<span class="item-title"><?php echo esc_html( $title ); ?></span>

						<span class="item-controls">

						

						

							<span class="item-type item-type-default"><?php echo esc_html( $item->type_label ); ?></span>

							<span class="item-type item-type-column"><?php _e('Mega Menu Column', 'themeple'); ?></span>

							<span class="item-type item-type-megalabel"><?php _e('Mega Menu', 'themeple'); ?></span>

							

							<a class="item-edit" id="edit-<?php echo esc_attr($item_id); ?>" title="<?php _e('Edit Menu Item', 'themeple'); ?>" href="<?php

								echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );

							?>"><?php _e( 'Edit Menu Item' , 'themeple'); ?></a>

						</span>

					</dt>

				</dl>

	

				<div class="menu-item-settings" id="menu-item-settings-<?php echo esc_attr($item_id); ?>">

					<?php if( 'custom' == $item->type ) : ?>

						<p class="field-url description description-wide">

							<label for="edit-menu-item-url-<?php echo esc_attr($item_id); ?>">

								<?php _e( 'URL', 'themeple' ); ?><br />

								<input type="text" id="edit-menu-item-url-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />

							</label>

						</p>

					<?php endif; ?>

					<p class="description description-thin description-label label_desc_on_active">

						<label for="edit-menu-item-title-<?php echo esc_attr($item_id); ?>">

						<span class='default_label'><?php _e( 'Navigation Label', 'themeple' ); ?></span>

						<span class='mega_label'><?php _e( 'Title for the Mega Menu Column', 'themeple' ); ?></span>

							

							<br />

							<input type="text" id="edit-menu-item-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />

						</label>

					</p>

					<p class="description description-thin description-title">

						<label for="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>">

							<?php _e( 'Title Attribute', 'themeple' ); ?><br />

							<input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />

						</label>

					</p>

					<p class="field-link-target description description-thin">

						<label for="edit-menu-item-target-<?php echo esc_attr($item_id); ?>">

							<?php _e( 'link Target', 'themeple' ); ?><br />

							<select id="edit-menu-item-target-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-target" name="menu-item-target[<?php echo esc_attr($item_id); ?>]">

								<option value="" <?php selected( $item->target, ''); ?>><?php _e('Same window or tab', 'themeple'); ?></option>

								<option value="_blank" <?php selected( $item->target, '_blank'); ?>><?php _e('New window or tab', 'themeple'); ?></option>

							</select>

						</label>

					</p>

					<p class="field-css-classes description description-thin">

						<label for="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>">

							<?php _e( 'CSS Classes (optional)' , 'themeple'); ?><br />

							<input type="text" id="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />

						</label>

					</p>

					<p class="field-xfn description description-thin">

						<label for="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>">

							<?php _e( 'link Relationship (XFN)', 'themeple' ); ?><br />

							<input type="text" id="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />

						</label>

					</p>

					<p class="field-description description description-wide">

						<label for="edit-menu-item-description-<?php echo esc_attr($item_id); ?>">

							<?php _e( 'Description', 'themeple' ); ?><br />

							<textarea id="edit-menu-item-description-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr($item_id); ?>]"><?php echo esc_html( $item->description ); ?></textarea>

						</label>

					</p>

					

					<div class='themeple_custom_menu_options'>

					

						<?php

						$title = 'Check if you want to use this item as megamenu';

						$key = "menu-item-custom_themeple-megamenu";

						$value = get_post_meta( $item->ID, '_'.$key, true);

						

						if($value != "") $value = "checked='checked'";

						?>

						

						<p class="description description-wide themeple_checkbox themeple_custom_mega_menu themeple_custom_mega_menu_d0">

							<label for="edit-<?php echo esc_attr($key).'-'.$item_id; ?>">

								<input type="checkbox" value="active" id="edit-<?php echo esc_attr($key).'-'.$item_id; ?>" class=" <?php echo esc_attr($key); ?>" name="<?php echo esc_attr($key) . "[". $item_id ."]";?>" <?php echo esc_attr($value); ?> /><?php _e( $title, 'themeple' ); ?>

							</label>

						</p>



						

					



					</div>

				

					<div class="menu-item-actions description-wide submitbox">

						<?php if( 'custom' != $item->type ) : ?>

							<p class="link-to-original">

								<?php printf( __('Original: %s', 'themeple'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>

							</p>

						<?php endif; ?>

						<a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr($item_id); ?>" href="<?php

						echo wp_nonce_url(

							add_query_arg(

								array(

									'action' => 'delete-menu-item',

									'menu-item' => $item_id,

								),

								remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )

							),

							'delete-menu_item_' . $item_id

						); ?>"><?php _e('Remove', 'themeple'); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo esc_attr($item_id); ?>" href="<?php	echo add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) );

							?>#menu-item-settings-<?php echo esc_attr($item_id); ?>"><?php _e('Cancel', 'themeple'); ?></a>

					</div>

	

					<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item_id); ?>" />

					<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />

					<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />

					<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />

					<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />

					<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />

				</div><!-- .menu-item-settings-->

				<ul class="menu-item-transport"></ul>

			<?php

			$output .= ob_get_clean();

		}

	}





}













