<?php 
/**
* @package Dyn Internal Links
* @version 1.0
* Creador de la clase base para el plugin Interk
*/
class Dynil_init_class
{
	// Version de plugin.
	const DYNIL_VERSION = "1.0";	


	/**
	* @since 1.0
	* @param $argum: Un array que indicara el orden a seguir.
	* @see https://codex.wordpress.org/Function_Reference/get_pages para mas info.
	* 
	* Regresará un array con las páginas en el sitio.  
	*/
	public function get_all_pages( $argum = array() ){

		if ( ! is_array( $argum )){
			throw new Exception( __('The arguments for pages is not array', DYNIL_DOMAIN));
			exit;
		}

		return get_pages( $argum  );		
	}

	/** 
	* @package Dyn Internal Links
	* @since 1.0
	* @param $name: Nombre que se buscara
	* 			 $output: Salida de informacion, array o objeto.
	* Regresar un el nombre de la pagina
	*/
	public function get_name_page( $name, $output = "" ){

		$page_return = get_page_by_title( $name , $output );
		return $page_return;
	}



	
}





 ?>