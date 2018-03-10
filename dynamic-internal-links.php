<?php 
/**
* 
* @package Dyn Internal Links
* @version 1.0
Plugin Name: Dynamic Internal Links
Description: Create your simple way to generate excellent SEO. Dyn-Internal Links will guide you to create your position through connections between pages.
Author: Juan C
Version: 1.0
*/

if( ! defined( 'DYNIL_PATH')){
	define( 'DYNIL_PATH', dirname(__FILE__));
}

if ( ! defined ('DYNIL_DOMAIN')){
	define( 'DYNIL_DOMAIN' , 'dynil');
}

include_once DYNIL_PATH . '/admin/admin-options.php';
include_once DYNIL_PATH . '/classes/class-dynil.php';


?>