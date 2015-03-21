<?php
    /** 
     * @author roshi
     * @copyright roshi[www.themeforest.net/user/roshi]
     * @version 2012
     */
if(!defined('THEMEPLE_BASE')) define('THEMEPLE_BASE', get_template_directory().'/');

if(!defined('THEMEPLE_BASE_URL' ) ) define( 'THEMEPLE_BASE_URL', get_template_directory_uri().'/'); 

if(!defined('THEMPLE_FRAMEWORK')) define('THEMEPLE_FRAMEWORK', THEMEPLE_BASE.'themeple_framework/');
if(!defined('THEMPLE_FRAMEWORK_URL')) define('THEMEPLE_FRAMEWORK_URL', THEMEPLE_BASE_URL.'themeple_framework/');
if(!defined('THEMEPLE_CSS_URL')) define('THEMEPLE_CSS_URL', THEMEPLE_BASE_URL.'themeple_framework/css/');

if(!defined('THEMEPLE_IMAGE_URL')) define('THEMEPLE_IMAGE_URL', THEMEPLE_BASE_URL.'themeple_framework/images/');

if(!defined('THEMEPLE_JS_URL')) define('THEMEPLE_JS_URL', THEMEPLE_BASE_URL.'themeple_framework/js/');

if(function_exists('wp_get_theme'))
{
	$wp_theme_obj = wp_get_theme();
	$themeple_base_data['prefix'] = $themeple_base_data['Title'] = $wp_theme_obj->get('Name');
    if(!defined('THEMENAME')) define('THEMENAME', $themeple_base_data['Title']);
}


if(!defined('THEMETITLE')) define('THEMETITLE', $themeple_base_data['Title']);

if(!defined('THEMEPLE_FW_SYSTEM')) define('THEMEPLE_FW_SYSTEM', THEMEPLE_FRAMEWORK.'system/');
if(!defined('THEMEPLE_FW_SYSTEM_URL')) define('THEMEPLE_FW_SYSTEM_URL', THEMEPLE_FRAMEWORK_URL.'system/');
require(THEMEPLE_FW_SYSTEM.'admin_functions.php');
require(THEMEPLE_FW_SYSTEM.'frontend_functions.php');
require(THEMEPLE_FW_SYSTEM.'themeple_form.php');
require(THEMEPLE_FW_SYSTEM.'themeple_custom_menu.php');
require(THEMEPLE_FW_SYSTEM.'shortcodes/shortcodes.php');
require(THEMEPLE_FW_SYSTEM.'widgets.inc.php');

if(is_admin()){
    
    require(THEMEPLE_FW_SYSTEM.'themeple_export_options.php');
    
    require(THEMEPLE_FW_SYSTEM.'database_options_sets.inc.php');
    require(THEMEPLE_FW_SYSTEM.'ajax_functions.php');
    
    require(THEMEPLE_FW_SYSTEM.'admin-pages-gen.inc.php');
    require(THEMEPLE_FW_SYSTEM.'metabox.inc.php');
    require(THEMEPLE_FW_SYSTEM.'media.inc.php');
    require(THEMEPLE_FW_SYSTEM.'view-gen.inc.php');

}

?>