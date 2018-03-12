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

	// ¿Se ha instanciado esta clase?

	private static $init = null;

	// Importar clases.

	public $classes = array();

	// Scripts disponibles y cargados

	private $scripts = array();


	public static function init_class(){

		if ( empty( self::$init ) ){
			self::$init = new self();
		}


		return self::$init;

	}


	/** 
	* @since 1.0
	* Constructor de clase
	*/
	public function __construct( ){

		$this->get_classes();		
		

	}

	/**
	* @since 1.0
	* Cargar las clases necesarias. Este metodo solo se cargara en el constructor.
	*/
	private function get_classes( ){

		$this->classes['ajax'] = Class_ajax_dynil::init_class();
		$this->classes['pages'] = Class_ajax_dynil::init_class();

	}

	public function import_script( $base_url, $hande_script ){

		if ( ! array_key_exists($hande_script , $this->scripts )){
			$this->scripts[ $hande_script ] = $base_url;
			
		}


	}

	public function load_scripts( ){		

		foreach ($this->scripts as $name_sr => $path_sr ) {
			

			wp_enqueue_script( $name_sr , $path_sr );
		}

	}


}





 ?>