<?php 
/**
* @package Dyn Internal Links
* @version 1.0
* @since 1.0
*	Interfaz de usuario, capaz de dar las ordenes correspondientes para acomodar el plugin de manera deseada.
* 
*/
class Class_admin_dynil extends Class_dynil
{
	
	public static $intance = null;

	/**
	* @since 1.0
	* Intanciacion de clase
	*/
	public static function instance(){

		if( self::$intance === null ){
			self::$intance = new self();
		}
		return self::$intance;
	}

	/**
	* @since 1.0
	* Constructor
	*/
	public function __construct(){

		$this->hooks_actions();
		$this->scripts();	
		$this->enqueue_scripts();	
	 	$this->class_ajax();		
		
	}

	/** 
	* @since 1.0
	* Importar scripts de esta clase
	*/
	private function scripts( ){
		
		$this->import_script( dynil_script_path( 'ajax-request' ) , 'ajax-request' , 'admin' );
		$this->import_script( dynil_script_path( 'admin-script' ) , 'admin-script' , 'admin' );
	}

	/**
	* @since 1.0
	* Buscar paginas por medio de Ajax.
	*/
	public function content_admin(){
		
		// Contenido html en el admin.
		?>
		<div class="dynil_title_options">
			<h2><?php _e('Internal Link Options', DYNIL_DOMAIN ); ?></h2>
		</div>	
		<div class="content">
			<input type="text" name="asdkjalsdj" id="dynil_anex_pages">
		</div>
		<div id="respond">			
		</div>	
		<?php
	}

	/** 
	* @since 1.0
	* Agregar Menu a el menu lateral de wp
	*/
	public function add_menus(){

		add_menu_page( __('Dyn Internal Links Options', DYNIL_DOMAIN )  , 'Dyn Internal Links' , 'manage_options' , 'dynil_menu_admin' , array( $this , 'content_admin' ) , 'dashicons-star-filled' , 70 );	
	}

	/** 
	* @since 1.0
	* @see add_menus method
	* Hooks de la clase
	*/
	private function hooks_actions( ){

		add_action( 'admin_menu' , array( $this , 'add_menus' ) );

	}
	
}
