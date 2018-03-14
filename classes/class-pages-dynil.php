<?php

/**
* @package Dyn Internal Links
* @since 1.0 
* Llamada de Paginas
*/
class Class_pages_dynil extends Class_dynil
{

	// Propiedades 
	public $props = array();

	// ¿Se ha instanciado esta clase?
	private static $init = null;


	/**
	* @since 1.0
	* Bajo que parametros se mostraran todas las paginas.
	*/
	public $criteria = array();


	/**
	* @since 1.0	
	* Constructor de clase
	*/
	public function __construct(){

	}


	/**
	* @since 1.0
	* @return Esta clase	
	* Devuelve su misma clase
	*/
	public static function init_class( ){

		if ( empty( self::$init )){

			self::$init = new self();
		}
		return self::$init;

	}
	
	/**
	* @param string $arg Modo de entrega de los valores
	* @param string $value Valor de la entrega pre-establecida
	* Se creara un nuevo criterio para la muestra de las paginas.
	*/
	public function set_criteria( $arg , $value ){

		$this->criteria[ $arg ] = $value ;

	}

	/**
	* @since 1.0	
	* @see https://codex.wordpress.org/Function_Reference/get_pages para mas info.* 	
	* Regresará un array con las páginas de el sitio
	* Se tomara en cuenta todas las determinaciones, establecidas en $criteria.
	* 
	*/
	public function get_all_pages( ){

		$all_pages = get_pages( $this->criteria );

		foreach ($all_pages as $page => $pages) {
			foreach ($pages as $p => $i) {
				echo '<div> ' .  $p . ' => ' . $i . ' </div>';
			}
		}

		
	}
	

	/** 
	* 
	* @since 1.0 
	* Regresar un el nombre de la pagina
	*/

	public function get_name_page( ){

		global $wpdb;
		$name = $_POST['name'];		
		$sql = "SELECT ID, post_title FROM {$wpdb->posts} WHERE post_title LIKE '{$name}%' AND post_type = 'page' ";
		$resultes = dynil_create_wpdb( $sql );

		foreach ( $resultes as $result ) {
			echo dynil_wrap_content( $result->post_title, array(
				'class' => 'names_pages'
			) );
		}
		die();
	}
}

 ?>