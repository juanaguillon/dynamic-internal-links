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

	// ¿Se ha instanciado esta clase?

	public static $init = null;


	/** 
	* @since 1.0
	* @param $id_ajax: Nombre unico para ingresar un ajax
	* Crea un nombre unico para cada ajax con una accion.
	* Es necesario tambien crear un action único.
	*/

	public function __construct(){
		$this->import_scripts();
				
		
	}

	/**
	* @since 1.0
	* Instanciador de clase.
	*/

	public static function init_class(){

		if ( empty(self::$init )){
			self::$init = new self();
		}
		return self::$init;
	}

	/**
	* @since 1.0
	* Importar scripts correspondientes para el debido proceso AJAX.
	*/

	private function import_scripts(){
		$this->import_script( dynil_script_path('ajax-request') , 'ajax-request', 'admin' );
	}

	/**
	* @since 1.0 
	* @param $id_ajax [string] El nombre identificativo del ajax
	* @param $action [string] El valor que sera ingresado en el array  
	* Ingresar idenficiativo ajax a el array de Clase.
	*/

	public function set_ajax_request( $id_ajax , $action ){

		if ( ! array_key_exists($id_ajax, $this->ajax ) ){

			$this->actions[ $action ] = $action;			

		}

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
	
}

 ?>