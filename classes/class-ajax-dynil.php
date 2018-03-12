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

	/** 
	* @since 1.0
	* @param $id_ajax: Nombre unico para ingresar un ajax
	* Crea un nombre unico para cada ajax con una accion.
	* Es necesario tambien crear un action único.
	*/
	public function set_ajax_request( $id_ajax , $action ){

		if ( ! array_key_exists($id_ajax, $this->ajax ) && 
				 ! array_key_exists( $action , $this->actions ) ){
			
			$this->actions[ $action ] = $action;
			$this->ajax[ $id_ajax ] = $action;		


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

	public function ajax_request( $id , $act ){

		
		$this->set_ajax_request( $id , $act );

	}
	
}

 ?>