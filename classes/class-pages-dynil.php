<?php

/**
* @package Dyn Internal Links
* @since 1.0
* 
* Llamada de Paginas
*/
class Class_pages_dynil extends Class_dynil
{

	// Propiedades 
	public $props = array();

	
	
	/**
	* @since 1.0
	* @param $argum: Un array que indicara el orden a seguir.
	* @see https://codex.wordpress.org/Function_Reference/get_pages para mas info.
	* 
	* Regresará un array con las páginas en el sitio.  
	*/
	public function get_all_pages(  ){

		
	}

	/** 
	* 
	* @since 1.0
	* 
	* Regresar un el nombre de la pagina
	*/
	public function get_name_page( ){

		$name = $_POST['name'];
		$output = $_POST['name'] || OBJECT;

		$page_return = get_page_by_title( $name , $output );
		echo $page_return;
	}
}

 ?>