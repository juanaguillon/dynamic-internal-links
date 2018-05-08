<?php 

/**
 * @package Dyn Internal Links		
 * @since 1.0
 * HTML contenido settings
 */
class Class_content_settings_dynil extends Class_dynil
{

	/** 
	* @since 1.0
	* Propiedad de instancia de clase.
	*/
	private static $instance = null;

	/** 
	* @since 1.0
	* Constructor de clase.
	*/
	public function __construct(){

	}
	
	/**
	 * @since 1.0
	 * Instancia de clase
	 */
	public static function instance(){
		if ( self::$instance == null ){
			self::$instance = new self();
		}
	
		return self::$instance;
	}	

	/** 
	* @since 1.0
	* Se mostraran las paginas que se han seleccionadas para la ejecucion del plugin.
	*/
	public function content_the_pages( ){
		if( ! get_option('dynil_inserted_pages') ){
			
			$id_pages = get_option( 'dynil_set_pages' );
			$cont = "";
			foreach ( $id_pages as $id ){
				$cont.= "<div class='dyn_page_bd '>";
				$cont.= "<p>" . get_the_title( $id ) . "</p>";
				$cont.= "<input type='text' class='dyn_input_change'>";
				$cont.= "<input type='hidden' name='inserting[]' value='{$id}'>";
				$cont.= "</div>";
			}

			echo dynil_wrap_content( $cont , ['class'=>'dynil_setter_pages'] );
			
		}else{

			$cont = "";
			$id_pages = get_option('dynil_inserted_pages');
			foreach( $id_pages as $id => $order ){
				$cont.= "<div class='dyn_page_bd'>";
				$cont.= "<p>" . get_the_title( $id ) . "</p>";
				if( $order != '' ){
					$cont.= '<span class="val_priority dyn_chance">' . $order . '</span>';
					$cont.= '<input type="hidden" name="priority_vals[]" value="' . $order . '">';
				}else{
					$cont.= "<input type='text' class='dyn_input_change'>";					
				}
				$cont.= "<input type='hidden' name='inserting[]' value='{$id}'>";
				$cont.= "</div>";
			}
			echo dynil_wrap_content( $cont , ['class'=>'dynil_setter_pages'] );

		}
	} 
	
	/**
	* @since 1.0
	* 
	* Si no ha seleccionado ninguna pagina en la seccion de seleccion de pagginas del plugin
	* se mostrara un mensaje informando que no se ha seleccionado paginas para modificar.
	*/
	public function pages_not_found(){

		?>
		<div class="dyn_pages_not_found">
			<h3><?php _e('You have not selected pages. Direct to select your pages.','dynil'); ?></h3>
			<a href="<?php menu_page_url('dynil_menu_admin') ?>"><input type="button" class="button dyn_linked_max" value="<?php _e('Let´s Go There','dynil'); ?>"></a>
		</div>	
		<?php
		
	}

	/**
	* @since 1.0
	* 
	* Input | Enviar el formulario
	*/

	public function content_submit_setters(){
		?>
		<div class="dyn_submit_setters">
			<input type="button" class="button button-primary" id="dyn_submit_setter" value="<?php _e('Update Pages', 'dynil'); ?>">			
		</div>
		<?php
	} 
	
	/**
	* @since 1.0
	* 
	*	Esta funcion dejara que el usuario (Admin) logre añadir su respectivo HTML.
	* Por defecto viene con la estructura h3 - div - p 
	*/
	
	public function content_self_structure( ){

		$texting = array( 
			__("The page's title",'dynil'),
			__("The parent element of image",'dynil'),
			__('The description of page','dynil')
		);

		$htmls = !get_option( 'dynil_structure_html' ) ? ['h3', 'div', 'p'] : get_option( 'dynil_structure_html' );		
		$struct = array_combine( $htmls, $texting );

		$html = '<div class="dyn_self_structure">';

		foreach( $struct as $str => $wh ){				
			$html .= '<div class="dyn_cr_structure"><div class="dyn_box_structure">';			
			$html .= '<p class="dyn_wh_str">' . $wh . ': </p><code class="dyn_val_str dyn_chance">'. $str . '</code><input type="hidden" name="interk_structures[]" value="' . $str . '" >';
			$html .= '</div></div>';
			
		}
		
		$html .= '</div>';
		
		echo $html;
		
	}
	/**
	* @since 1.0
	* 
	* Posibilidad de agregar estilos propios en el sitio
	*/
	public function content_self_styles( ){
		?>
		<div class="dynil_self_styles">
			<div class="dyn_stl_all_content">

			</div>
		</div>
		<?php
	}
	
}