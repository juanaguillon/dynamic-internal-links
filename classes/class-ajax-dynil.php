<?php 

/**
* @package Dyn Internal Links
* @since 1.0
* Ejecuciones ajax.
*/
class Class_ajax_dynil extends Dynil_init_class
{
	// Verificar existensia de id_ajax
	private $ajax = array();

	/** 
	* @since 1.0
	* @param $id_ajax: Nombre unico para ingresar un ajax
	* Crea un nombre unico para cada ajax con una accion.
	* Recomendablemente, es mejor tener una accion tambien unica.
	*/
	public function set_ajax_request( $id_ajax , $action ){

		if ( ! array_key_exists($id_ajax, $this->ajax ) ){
			
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
	
}

 ?>