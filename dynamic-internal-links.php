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

// Ruta base.
if( ! defined( 'DYNIL_PATH')){
	define( 'DYNIL_PATH', dirname(__FILE__));
}

// Dominio de traducciones.
if ( ! defined ('DYNIL_DOMAIN')){
	define( 'DYNIL_DOMAIN' , 'dynil');
}

// Llamada de archivo, en el cual se llamas nuevos archivos necesarios.
include_once DYNIL_PATH . '/admin/requires.php';
function dynil(){
	return new Class_dynil;
}



?>