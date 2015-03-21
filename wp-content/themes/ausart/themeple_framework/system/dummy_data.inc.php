<?php

	/** 

     * @author roshi

     * @copyright roshi[www.themeforest.net/user/roshi]

     * @version 2012

     */

if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);



require_once ABSPATH . 'wp-admin/includes/import.php';

$import_filepath = get_template_directory()."/template_inc/admin/dummy_data";

$errors = false;

if ( !class_exists( 'WP_Importer' ) ) {

	$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';

	if ( file_exists( $class_wp_importer ) )

	{

		require_once($class_wp_importer);

	}

	else

	{

		$errors = true;

	}

}

if ( !class_exists( 'WP_Import' ) ) {

	$wp_importer = THEMEPLE_FW_SYSTEM . 'wordpress-importer.php';

	if ( file_exists( $wp_importer ) )

	{

		require_once($wp_importer);

	}

	else

	{

		$errors = true;

	}

}



if($errors){

   echo "Errors while loading classes. Please use the standart wordpress importer."; 

}else{

    

    

	include_once('themeple_dummy_data.inc.php');

	if(!is_file($import_filepath.'.xml'))

	{

		echo "Problem with dummy data file. Please check the permisions of the xml file";

	}

	else

	{  

	   if(class_exists( 'WP_Import' )){

	        

			$our_class = new themeple_dummy_data();
			
			$our_class->fetch_attachments = false;

			$our_class->import($import_filepath.'.xml');
			
			$our_class->save_theme_options($import_filepath);

			//$our_class->set_default_menu();

        }

	}

    

    

    

}





?>