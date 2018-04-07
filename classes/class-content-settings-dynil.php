<?php 

/**
 * @package Dyn Internal Links		
 * @since 1.0
 * HTML contenido settings
 */
class Class_content_settings_dynil extends Class_dynil
{

	/** 
	* @since 1.0
	* Propiedad de instancia de clase.
	*/
	private static $instance = null;

	/** 
	* @since 1.0
	* Constructor de clase.
	*/
	public function __construct(){

	}
	
	/**
	 * @since 1.0
	 * Instancia de clase
	 */
	public static function instance(){
		if ( self::$instance == null ){
			self::$instance = new self();
		}
	
		return self::$instance;
	}

	/** 
	* @since 1.0
	* Se mostraran las paginas que se han seleccionadas para la ejecucion del plugin.
	*/
	public function the_pages_setters( ){

		if ( $id_pages = get_option( 'dynil_set_pages' ) ){

			foreach ( $id_pages as $id ){
				echo dynil_wrap_content( get_the_title( $id ) , array( 
					"class" => "dyn_all_pages"
				) );
			}
		}else{
			$this->pages_not_found();
		}
	} 
	
	public function pages_not_found(){

		?>
		<div class="dyn_pages_not_found">
			<h3><?php _e('You have not selected pages. Direct to your pages.','dynil'); ?></h3>
			<button class="redirect"><?php _e('Let´t Go There','dynil'); ?></button>
		</div>	
		<?php
		
	}
}