<?php 
/**
* @package Dyn Internal Links
* @version 1.0
* @since 1.0
*	Interfaz de usuario, capaz de dar las ordenes correspondientes para acomodar el plugin de manera deseada.
* 
*/


function dynil_admin_options(){

?>
	<?php 
	
	// dynil_ajax_request( 'show_pages','show_pages', array( new Dynil_init_class(  ) ))

	 ?>
	<div id="conter_dynil">	
		<div class="dynil_title_options">
			<h2><?php _e('Internal Link Options', DYNIL_DOMAIN ); ?></h2>
		</div>	
		<div class="content">
			<input type="text" name="asdkjalsdj" id="dynil_anex_pages">
		</div>
	</div>	
	
	<?php
}

/**
* @since 1.0
* Creando el link de administrador
* 
*/
function dynil_anexed_admin_options(){
	add_menu_page( __('Dyn Internal Links Options', DYNIL_DOMAIN ) , 'Dyn Internal Links' , 'manage_options' , 'dynil_menu_admin' , 'dynil_admin_options' , 'dashicons-star-filled' , 72 );	
}

// Ingresando el link de administrador de plugin a el menu de WordPress
add_action( 'admin_menu','dynil_anexed_admin_options');
?>