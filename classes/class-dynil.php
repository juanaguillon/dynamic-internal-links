<?php 
/**
* @package Dyn Internal Links
* @version 1.0
* Creador de la clase base para el plugin Interk
*/
class Class_dynil
{
	// Version de plugin.

	protected $version = "1.0";

	// ¿Se ha creado el objecto?

	private $_is_run = false;	

	// Importar clases.

	public static $classes = array();

	// Scripts disponibles y cargados

	private $scripts = array();

	/** 
	* @since 1.0
	* Constructor de clase
	*/
	public function __construct(  ){

		if ( empty ($this->_is_run) ){
			// El sistema corre.
			// Toda llamada a esta clase, sera omitido el constructor.
			$this->_is_run = true;

			$this->get_classes();

		}

	}

	/**
	* @since 1.0
	* Cargar las clases necesarias. Este metodo solo se cargara en el constructor.
	*/
	public static function get_classes( ){

		self::$classes['ajax'] = new Class_ajax_dynil;
		self::$classes['pages'] = new Class_page_dynil;

	}

	public function import_script( $base_url, $hande_script ){

		$this->scripts[ $hande_script ] = DYNIL_PATH . $base_url;

	}

	public function load_scripts( ){

		foreach ($this->scripts as $name_sr => $path_sr ) {
			wp_enqueue_script( $name_sr , $path_sr );
		}

	}


}





 ?>