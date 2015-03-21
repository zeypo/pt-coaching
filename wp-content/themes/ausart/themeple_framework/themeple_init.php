<?php
	/** 
     * @author roshi
     * @copyright roshi[www.themeforest.net/user/roshi]
     * @version 2012
     */
do_action('themeple_action_before_initialization');

require('system/config.inc.php');

require('system/themeple_controller.php');

$themeple_base_data = apply_filters('themeple_filter_base_data', $themeple_base_data);

$themeple_controller = new themeple_controller($themeple_base_data);

?>