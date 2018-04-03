<?php 

/**
 * @package Dyn Internal Links
 * @see Class class-admin-dynil - content_admin [method]
 * @since 1.0
 * Contenido HTML que sera importando en la calse admin-dynil
 */
class Class_content_admin_dynil extends Class_dynil
{

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
	* Verificar instancia de clase
	*/
	public static $instance = null;


  /** 
  * @since 1.0
  * Intancia de clase
  */
 	public static function instance(){

 		if ( self::$instance == null ){
 			self::$instance = new self();
 		}
 	
 		return self::$instance;
 	}


  /** 
  * @since 1.0
  * Constructor absoluto de la clase
  */
  public function __construct()  {      

  	static::$ajax = parent::class_ajax();
		static::$pages = parent::class_pages();
		

  }  

  public function messages_scripts( ){
  	?>
		<script type="text/javascript">
			var Messages = {
				cantToTable: "<?php _e("This page is already in the table.","dynil"); ?>"
			}
			alert('in here');
		</script>
  	<?php
  }

 	/** 
	* @since 1.0
	* HTML de ajax
	*/
	public static function content_ajax(){
		
		?>					
			<div class="content">
				<input type="text" id="dynil_anex_pages" autocomplete="off">
				<div id="respond"></div>
			</div>
			
		<?php
	}

	/** 
	* @since 1.0
	* HTML resultado de tablas a ser subidas.
	*/
	public static function content_table_result(){
		?>		
			<table id="table_result">
				<thead>
					<th class="dynil_table_check">&nbsp;</th>
					<th class="dynil_table_id"> <?php _e('Page ID' , 'dynil'); ?></th>
					<th class="dynil_table_name"><?php _e('Page Name' , 'dynil') ?></th>
					<th class="dynil_table_date"><?php _e('Creation Date','dynil') ?></th>
				</thead>
				<tbody>					
				</tbody>
			</table>			
		<?php	
	}


	/** 
	* @since 1.0
	* HTML seleccion de paginas.
	*/
	public static function content_pages(){
		$all_pages = static::$pages->get_all_pages();		
		echo dynil_clean_pages( $all_pages );		

	} 

	/** 
	* @since 1.0
	* HTML referente a ingresar las paginas a la tabla.
	*/
	public static function content_load_pages(){

		?>
		<div class="dynil_load_pages">
			<input type="button" id="dynil_load_pages" value="<?php _e('Move Pages','dynil'); ?>" class="button">
		</div>

		<?php

	}

	/** 
	* @since 1.0
	* HTML submit el formulario
	*/
	public static function content_submit_pages(){	
		?>
		<div class="dynil_submit">
			<input type="hidden" name="action" value="my_action">			
			<input type="button" value="<?php echo __('Send Pages','dynil'); ?>" id="dyn_send_pages" class="button button-primary">
		</div>
		<?php
		
	}
}