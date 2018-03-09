<?php 
/**
* @package Intk
* @version 1.0
* @since 1.0
	Interfaz de usuario, capaz de dar las ordenes correspondientes para acomodar el plugin de manera deseada.
* 
*/

function intk_admin_options(){
	?>
	
	<div id="conter_ink">		
		<div class="content">
			<input type="text" name="asdkjalsdj">
		</div>
	</div>	
	
	<?php
}

/**
* @since 1.0
// Creando el link de administrador
* 
*/
function intk_anexed_admin_options(){
	add_menu_page( __('Interk Options', INTK_DOMAIN ) , 'Interk' , 'manage_options' , 'interk_menu_admin' , 'intk_admin_options' , 'dashicons-star-filled' , 70 );	
}

// Ingresando el link de administrador de plugin a el menu de WordPress
add_option( 'admin_menu','intk_anexed_admin_options');
?>