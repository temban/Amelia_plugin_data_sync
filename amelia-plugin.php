<?php
/*
Plugin Name:  AMELIA-TABLES
Plugin URI:   https://www.ameliatables.com 
Description:  This is a plugin which prints all amelia's tables
Version:      1.0
Author:       TEMBAN BLAISE 
Author URI:   https://www.ameliatables.com
License:      ---
License URI:  ---
Text Domain:  ---
Domain Path:  ---
*/

add_action('admin_menu', 'ameliatables_options_page');

function ameliatables_options_page() {
  add_menu_page('AMELIA-TABLES', 'Amelia-Tables', 'manage_options', 'ameliatables', 'ameliatables');
  
}

function ameliatables ()	{
	include_once('View/DB_Conection_View.php');
}



