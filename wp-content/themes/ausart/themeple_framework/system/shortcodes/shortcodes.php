<?php  if ( ! defined('THEMEPLE_FRAMEWORK')) exit('No direct script access allowed');


/*

    Copyright 2010 VisualShortcodes.com  (email : info@visualshortcodes.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

/**
 * themeple_shortcodes
 * 
 * @package   
 * @author 
 * @copyright oni12
 * @version 2012
 * @access public
 */
class themeple_shortcodes{
	
	/**
	 * themeple_shortcodes::themeple_shortcodes()
	 * 
	 * @return
	 */
	function themeple_shortcodes() {
		
		add_action( 'admin_init', array( &$this, 'action_admin_init' ) );
		add_action( 'wp_ajax_scn_check_url_action', array( &$this, 'ajax_action_check_url' ) );
		
		
	}
	
	/**
	 * themeple_shortcodes::action_admin_init()
	 * 
	 * @return
	 */
	function action_admin_init() {
		
		if ( current_user_can( 'edit_posts' ) 
		  && current_user_can( 'edit_pages' ) 
		  && get_user_option('rich_editing') == 'true' )  {
		  	
			add_filter( 'mce_buttons',          array( &$this, 'filter_mce_buttons'          ) );
			add_filter( 'mce_external_plugins', array( &$this, 'filter_mce_external_plugins' ) );

			
			wp_register_style('scnStyles', $this->plugin_url() . 'css/styles.css');
			wp_enqueue_style('scnStyles');
		}
	}
	
	/**
	 * themeple_shortcodes::filter_mce_buttons()
	 * 
	 * @param mixed $buttons
	 * @return
	 */
	function filter_mce_buttons( $buttons ) {
		
		array_push( $buttons, '|', 'scn_button');
		return $buttons;
	}
	
	/**
	 * themeple_shortcodes::filter_mce_external_plugins()
	 * 
	 * @param mixed $plugins
	 * @return
	 */
	function filter_mce_external_plugins( $plugins ) {
		
        $plugins['ShortcodeNinjaPlugin'] = $this->plugin_url() . 'mce/editor_plugin.js';
        return $plugins;
	}

	/**
	 * themeple_shortcodes::plugin_url()
	 * 
	 * @return
	 */
	function plugin_url() {
		
		return THEMEPLE_FW_SYSTEM_URL.'shortcodes/';
	}

	/**
	 * themeple_shortcodes::ajax_action_check_url()
	 * 
	 * @return
	 */
	function ajax_action_check_url() {

		$hadError = true;

		$url = isset( $_REQUEST['url'] ) ? $_REQUEST['url'] : '';

		if ( strlen( $url ) > 0  && function_exists( 'get_headers' ) ) {
				
			$file_headers = @get_headers( $url );
			$exists       = $file_headers && $file_headers[0] != 'HTTP/1.1 404 Not Found';
			$hadError     = false;
		}

		echo '{ "exists": '. ($exists ? '1' : '0') . ($hadError ? ', "error" : 1 ' : '') . ' }';

		die();
	}
	
	
	

}

new themeple_shortcodes();
?>
