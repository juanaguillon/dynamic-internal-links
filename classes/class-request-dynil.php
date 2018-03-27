<?php 

/**
 * @package Dyn Internal Links
 * @since 1.0
 *
 * Peticiones creadas, tanto ajax como posts admins.
 */
class Class_request_dynil 
{

	/** 
	* @since 1.0
	* Instancia de clase
	*/
	private static $instance = null;

	/** 
	* @since 1.0
	* Obtener instancia de la clase | Singleton Function
	*/

	public static function instance( ){
		if ( self::$instance == null ){
			self::$instance = new self();
		}

		return self::$instance;
	}

	/** 
	* 
	* @since 1.0 
	* Regresar un el nombre de la pagina
	*/
	public function get_name_page( ){

		global $wpdb;
		$name = $_POST['name'];		
		$sql = "SELECT ID, post_title FROM {$wpdb->posts} WHERE post_title LIKE '{$name}%' AND post_type = 'page' ";
		$resultes = dynil_create_wpdb( $sql );

		foreach ( $resultes as $result ) {
			echo dynil_wrap_content( $result->post_title, array(
				'class' => 'names_pages'
			) );
		}
		die();
	}

	/** 
	* @since 1.0
	* Actualizara opciones y redirigira a el admin page.
	*/
	public function my_action_function(){
		
		$set_pages = $_POST["dynil_set_pages"];
		if( update_option('dynil_set_pages', $set_pages ) ){
			wp_redirect( admin_url('admin.php?page=dynil_menu_admin&update_pages=true') );			
		}else{
			wp_redirect( admin_url('admin.php?page=dynil_menu_admin&update_pages=false') );
		}
		
	}
}

