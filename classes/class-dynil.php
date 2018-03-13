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

	// Scripts disponibles para el sitio.

	private $scripts_site = array();

	// Scripts para la seccion de administador.

	private $scripts_admin = array();



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

	public function import_script( $base_url, $hande_script, $type ){

		switch ( $type ) {
			case 'admin':

				/**  Cargar scrpits desde el administrador */
				if ( is_array( $this->scripts_admin ) && 
						! array_key_exists( $hande_script , $this->scripts_admin ) ){
						$this->scripts_admin[ $hande_script ] = $base_url;					
				}
				break;	

				/** Cargar scripts desde el sitio. */
			case 'site':
				if ( ! array_key_exists($hande_script , $this->scripts_site ) ){
					$this->scripts_site[ $hande_script ] = $base_url;					
				}
				break;
		}		


	}

	public function load_scripts_site( ){		


		foreach ($this->scripts_site as $name_sr => $path_sr ) {			

			wp_enqueue_script( $name_sr , $path_sr );
		}

	}

	public function load_scripts_admin(){

		foreach ( $this->scripts_admin as $name_sr => $path_sr ){

			wp_enqueue_script( $name_sr , $path_sr);

		}

	}


}





 ?>