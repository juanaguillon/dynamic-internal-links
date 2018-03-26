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
	
	/** 
	* @since 1.0
	* Intancia de clase
	*/
	public static $intance = null;


	/** 
	* @since 1.0
	* Clase Ajax
	*/
	public static $ajax = null;


	/** 
	* @since 1.0
	* Clase Pages
	*/
	public static $pages = null;


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

		self::$ajax = parent::class_ajax();
		self::$pages = parent::class_pages();
		$this->hooks_actions();		
		$this->scripts();	
		$this->enqueue_scripts();	
	 	
		
	}

	/** 
	* @since 1.0
	* Importar scripts de esta clase
	*/
	private function scripts( ){		
		$this->import_script( dynil_script_path( 'ajax-request' , 'js' ) , 'ajax-request' , 'admin' );
		$this->import_script( dynil_script_path( 'admin-script' , 'js' ) , 'admin-script' , 'admin' );
		$this->import_style( dynil_script_path( 'admin-style' , 'css'), 'admin-style' , 'admin' );
	}

	/** 
	* @since 1.0
	* HTML de ajax
	*/
	private static function content_ajax(){
		
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
	* HTML seleccion de paginas.
	*/
	private static function content_pages(){
		$all_pages = self::$pages->get_all_pages();		
		echo dynil_clean_pages( $all_pages );

	} 


	/**
	* @since 1.0
	* Buscar paginas por medio de Ajax.
	*/
	public function content_admin(){
		self::content_ajax();	
		self::content_pages();
		update_option( 'my_option', array( 'uno' => 'jeje','dos'=> 'doxxxxs') );	
		$ar =  get_option('my_option');
		echo $ar['dos'];	
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
