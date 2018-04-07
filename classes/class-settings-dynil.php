<?php 

/**
 * @package Dyn Internal Links
 * @since 1.0
 * Pagina settings de plugin
 * Esta pagina, sera la encargada de configurar las paginas que se han creado, en el panel de administracion del plugin
 */
class Class_settings_dynil extends Class_dynil
{


  /** 
  * @since 1.0
  * Instancia de clase
  */
	private static $instance = null;

	/** 
	* @since 1.0
	* @see content_settings method.
	*
	* Contenido html de esta clase.
	*/
	private static $content = null; 

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

	public function __construct( ){
		include_once DYNIL_CLASSES . 'class-content-settings-dynil.php';
		static::$content = Class_content_settings_dynil::instance();
	}
	

	public function content_settings(){
		
		static::$content->the_pages_setters();

	}
  

}