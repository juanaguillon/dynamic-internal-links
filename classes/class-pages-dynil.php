<?php

/**
* @package Dyn Internal Links
* @since 1.0 
* Llamada de Paginas
*/
class Class_pages_dynil extends Class_dynil
{	
	/** 
	* @since 1.0
	* Intancia de clase.
	*/	
	public static $instance = null;


	/**
	* @since 1.0
	* Bajo que parametros se mostraran todas las paginas.
	*/
	public $criteria = array( );

	/**
	* @since 1.0
	* Paginas de ejecucion.
	* Hay que aclarar que esta propiedad no obtiene todas las paginas del sitio. Obtiene las paginas que son necesarias para una correcta ejecucion. Por Ejemplo: Paginas de WooCommerce*/
	public $pages_execute = array( );


	/**
	* @since 1.0	
	* Constructor de clase
	*/
	public function __construct(){

		$this->set_woo_pages();		

	}	

	/**
	* @since 1.0
	* @return Esta clase $this	
	* Intanciacion de clase | Singleton
	*/
	public static function instance( ){

		if ( empty( self::$instance )){

			self::$instance = new self();
		}
		return self::$instance;

	}
	
	/**
	* @param string $arg Modo de entrega de los valores
	* @param string $value Valor de la entrega pre-establecida
	* Se creara un nuevo criterio para la muestra de las paginas.
	*/
	public function set_criteria( $arg , $value ){

		$this->criteria[ $arg ] = $value;

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
	* @since 1.0
	* Ingresa a la clase {pages_execute} las paginas correspondientes de woocommerce
	*/
	
	public function set_woo_pages( ){

		if ( dynil_woo_exists() ){

			$woo_pages = array(
				'shop',
				'myaccount',
				'checkout',
				'cart'
			);

			for ( $i = 0; $i < count( $woo_pages ); $i++){
				$this->pages_execute['woocommerce'][ $woo_pages[ $i ] ] = wc_get_page_id( $woo_pages[ $i ] );
			}
		}
	}
	/** 
	* @since 1.0
	* @see this->criteria property
	* Excluir paginas de woocommerce
	*/
	public function exclude_woo_pages( ){
		
		$this->criteria['exclude'] = $this->pages_execute['woocommerce'];


	}	
}


 ?>