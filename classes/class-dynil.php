<?php 
/**
* @package Interk
* @version 1.0
* Creador de la clase base para el plugin Interk
*/
class Intk_init_class
{
	// Version de plugin.
	const INTK_VERSION = "1.0";	

	private function get_all_pages( $argum = array() ){

		if ( ! is_array( $argum )){
			throw new Exception( __('The arguments for pages is not array'));
			exit;
		}

		return get_pages( $argum  );
		
	}

	public function get_id_page( $args = array() ){

		return $this->get_all_page( $args );

	}

	
}





 ?>