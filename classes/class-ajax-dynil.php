<?php 

/**
* @package Dyn Internal Links
* @since 1.0
* Ejecuciones ajax.
*/
class Class_ajax_dynil extends Class_dynil
{
	// Verificar existensia de id_ajax
	private $ajax = array();

	// Todos las acciones. 
	public $actions = array();

	// ¿Se ha instanciado esta clase?

	private static $init = null;


	/** 
	* @since 1.0
	* @param $id_ajax: Nombre unico para ingresar un ajax
	* Crea un nombre unico para cada ajax con una accion.
	* Es necesario tambien crear un action único.
	*/

	public function __construct(){

		$this->import_admin_ajax_scripts();

		
	}


	public static function init_class(){

		if ( empty(self::$init )){
			self::$init = new self();
		}
		return self::$init;
	}

	public function set_ajax_request( $id_ajax , $action ){

		if ( ! array_key_exists($id_ajax, $this->ajax ) && 
				 ! array_key_exists( $action , $this->actions ) ){
			
			$this->actions[ $action ] = $action;
			$this->ajax[ $id_ajax ] = $action;		


		}

	}

	/**
	* @since 1.0
	* 
	* Nuevos scripts para la seccion administrativa.*/

	public function import_admin_ajax_scripts( ){

		$this->import_script( dynil_script_path( 'ajax-request' ),'ajax-request' , 'admin' );

		
		add_action('admin_enqueue_scripts', array( $this , 'load_scripts_admin') );

	}

	/** 
	* @since 1.0 
	* 
	* Nuevos scripts para para el sitio.
	**/

	public function import_site_ajax_script(){

		$this->import_script( dynil_script_path( 'ajax-request' ),'ajax-request' , 'site' );

		
		add_action('admin_enqueue_scripts', array( $this , 'load_scripts_site') );
	}

	/**
	* Retorna un string almacenado en el ajax, dando el nombre de acccion ingresado.
	*
	* @since 1.0
	* @param $id_ajax: Obtener el id ajax unico
	* @return 'string'
	*
	*/

	public function get_ajax_request( $id_ajax ){

		if ( array_key_exists( $id_ajax , $this->ajax ) ){

			return $this->ajax[ $id_ajax ];
		}

	}

	public function ajax_request( $id , $act ){

		
		$this->set_ajax_request( $id , $act );

	}
	
}

 ?>