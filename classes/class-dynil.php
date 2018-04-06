<?php 
/**
* @package Dyn Internal Links
* @version 1.0
* Creador de la clase base para el plugin Interk
*/
class Class_dynil
{
	/**
	* @since 1.0
	* Version actual de plugin
	*/

	protected $version = "1.0";

	/**
	* @since 1.0
	* ¿Se ha instanciado esta clase?
	*/ 

	protected static $init = null;


	/**
	* @since 1.0
	* Scripts que seran cargados en el sitio
	*/ 

	public $scripts_site = array();

	/**
	* @since 1.0
	* Scripts que seran cargados en el admin
	*/
	public $scripts_admin = array();


	/**
	* @since 1.0
	* Estilos que seran cargados en el sitio
	*/
	public $styles_site = array();


	/**
	* @since 1.0
	* Estilos que seran cargados en el admin
	*/
	public $styles_admin = array();

	/**
	* @since 1.0
	* Intanciador de clase.
	*/

	public static function init_class(){

		if ( is_null( self::$init ) ){
			self::$init = new self();
		}
		return self::$init;

	}

	/** 
	* @since 1.0
	* Constructor de clase
	*/
	public function __construct( ){

		if ( is_admin( ) ){
			$this->init_hooks();
			$this->upload_files();
			if ( $this->is_set_page() ){
				self::class_admin();
				
			}else if( $this->is_settings_page() ){
				self::class_settings();
			}			
		}
	}
	public function add_menus(){
		
		add_menu_page( __('Dyn Internal Links Options', 'dynil' )  , 'Dyn Internal Links' , 'manage_options' , 'dynil_menu_admin' , array( 'Class_admin_dynil' , 'content_admin' ) , 'dashicons-star-filled' , 70 );
		add_submenu_page('dynil_menu_admin', __('Dynil Settings','dynil'), __('Settings') , 'manage_options','dynil_menu_settings', array( 'Class_settings_dynil' , 'content_settings') );
			
	}	
	

	/**
	* @since 1.0
	* Inclue los archivos base, tales como clases y funciones princpales
	*/
	public function upload_files(){
		
		// Importando funciones 
		include_once DYNIL_PATH . '/inc/dynil_all_templates.php';

		// Importando archivos de clases
		include_once DYNIL_CLASSES . 'class-ajax-dynil.php';
		include_once DYNIL_CLASSES . 'class-pages-dynil.php';
		include_once DYNIL_CLASSES . 'class-settings-dynil.php';
		include_once DYNIL_CLASSES . 'class-admin-dynil.php';
		
	}	

	/**
	* @since 1.0
	* @param $base_url [string] Url de script
	* @param $handle_script [string] Id unico de script
	* @param $type [string] => ('admin' | 'site') En donde se ejecutara y cargara el script, con opcion   de ser en el sitio o en la seccion de administrador.
	*  
	* Importara los scripts correspondientes del programa.
	* Las clases hijas, llamaran este metodo para cargar su propio script
	*/
	public function import_script( $base_url, $hande_script, $type ){

		switch ( $type ) {
			case 'admin':

				/**  Cargar scrpits desde el administrador */
				if ( ! array_key_exists( $hande_script , $this->scripts_admin ) ){
								$this->scripts_admin[ $hande_script ] = $base_url;	

				}
				break;	

				/** Cargar scripts desde el sitio. */
			case 'site':
				if ( ! array_key_exists($hande_script , $this->scripts_site ) ){
					$this->scripts_site[ $hande_script ] = $base_url;					
				}
				break;
			}		


	}

	public function import_style( $base_url , $handle_style , $type){

		switch ( $type ) {
			case 'admin':

				/**  Cargar styles desde el administrador */
				if ( ! array_key_exists( $handle_style , $this->styles_admin ) ){
								$this->styles_admin[ $handle_style ] = $base_url;	

				}
				break;	

				/** Cargar styles desde el sitio. */
			case 'site':
				if ( ! array_key_exists($handle_style , $this->scripts_site ) ){
					$this->scripts_site[ $handle_style ] = $base_url;					
				}
				break;
			}		

	}

	/**
	* @since 1.0
	* @see import_script Method
	* Cargara los scripts en la seccion se sitio. 
	* Tal manera que se han cargado en el metodo import_script mediante ha ejecutado el programa
	*/
	public function load_scripts_site( ){		


		foreach ($this->scripts_site as $name_sr => $path_sr ) {	
			wp_enqueue_script( $name_sr , $path_sr );
		}

		foreach ($this->styles_site as $name_sr => $path_sr ) {
			wp_enqueue_style( $name_sr , $path_sr);
		}			

	}

	/**
	* @since 1.0
	* @see import_script Method
	* Cargara los scripts en la seccion se admin. 	
	*/
	public function load_scripts_admin(){


		foreach ( $this->scripts_admin as $name_sr => $path_sr ){
			wp_enqueue_script( $name_sr , $path_sr);
		}

		foreach ($this->styles_admin as $name_sr => $path_sr ) {
			wp_enqueue_style( $name_sr , $path_sr);
		}				

	}

	/**
	* @since 1.0
	* Enlazara los scripts importados anteriormente, anhadiendo a su respecivo hook
	*/
	public function enqueue_scripts(){		
		
		add_action('wp_enqueue_scripts' , array( $this , 'load_scripts_site' ) );
		add_action('admin_enqueue_scripts' , array( $this , 'load_scripts_admin') );
		
	}

	public function init_hooks(){
		add_action('admin_menu',array( $this , 'add_menus') );
	}

	/** 
	* @since 1.0
	* @return Bool
	* Verificar si esta en la pagina de seleccion de paginas.
	*/
	protected function is_set_page( ){
		if( $_GET["page"] == 'dynil_menu_admin' ){
			return true;
		}
		return false;
	}

	protected function is_settings_page(){
		if( $_GET["page"] == 'dynil_menu_settings'){
			return true;
		}
		return false;
	}


	/**
	* @since 1.0	
	* Ingresa clase AJAX a las propiedad {classes}
	*/
	protected function class_ajax(){
		return Class_ajax_dynil::instance();
	}

	/**
	* @since 1.0
	* Ingresa clase PAGES a las propiedad {classes}
	*/
	public function class_pages(){
		return Class_pages_dynil::instance();
	}

	/**
	* @since 1.0
	* Ingresa clase ADMIN a las propiedad {classes}
	*/
	protected function class_admin(){
		return Class_admin_dynil::instance();
	}

	protected function class_settings(){
		return Class_settings_dynil::instance();
	}


}
