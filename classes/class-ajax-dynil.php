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
	* @param $function [string] 
	* @param $action [string] El valor que sera ingresado en el array  
	* Ingresar idenficiativo ajax a el array de Clase.
	*/

	public function set_ajax_request( $action, $func ){

		if ( is_string( $func ) ){

			if ( ! array_key_exists($action, $this->ajax ) ){

				$this->ajax[ $action ] = $func;

			}			
		}
	}

	private function hooks_actions(){

		foreach ( $this->ajax as $action => $func ){

			add_action( 'wp_ajax_' . $action  , array( dynil() , $func ) );
			add_action( 'wp_ajax_nopriv_' . $action , array( dynil() , $func )  );
			
		}

	}
	
}

 ?>