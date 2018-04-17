<?php 

/**
 * @package Dyn Internal Links
 * @since 1.0
 * Encargada de modificar el contenido de las paginas
 */
class Class_front_dynil extends Class_dynil
{
	/**
	* @since 1.0
	* Array de paginas que se han insertado para ser mostradas.
	*/
	private $pages = null;

	/**
	* @since 1.0
	* Propiedad intancia de clase
	*/
	public static $instance = null;

	private $this_page = null;

	private $is_selected = false;

	/**
	 * @since 1.0
	 * Instancia de clase
	 */
	public static function instance( $param = null ){

		if ( self::$instance == null ){
			self::$instance = new self(  );
		}
	
		return self::$instance;
	}	


  /**
	 * @since 1.0
   * Constructor de class
   */
  public function __construct(  ){
  		global $post;
      $this->pages = get_option( 'dynil_inserted_pages' );
      $this->this_page = $post->ID;
			$this->change_the_content();
			$this->enqueues();
	}
	
	public function enqueues( ){
		$this->import_style( dynil_script_path( 'dynil-front','css'), 'dynil_front_css','site' );
		$this->enqueue_scripts();
	}

  public function get_html_another_pages( $id ){  	
		$count_per = count($this->pages) * ( 70 / 100 );
		$arr_total = array_rand( $this->pages, $count_per );
  	foreach( $arr_total as $id_page ){			
			if ( $id == $id_page ){
				continue;
			}

			$html .= '<a href="' . get_permalink( $id_page ) . '" class="dyn_lined_pages"><div class="dyn_cr_pages">';
			
  		$html .= '<h3>' . get_the_title( $id_page ) . '</h3>';
      if( has_post_thumbnail( $id_page ) ){
        $html.= get_the_post_thumbnail( $id_page, 'thumbnail' );
      }

      $html .= '</div></a>';
  	}
  	
  	return $html;

  }

  public function change_hook( $content ){
  	$returned = $content;
    global $post;
    $this->this_page = $post->ID;
  	foreach( $this->pages as $id_page => $order ){
  		if( is_page() && $this->this_page == $id_page  ){

    		$this->is_selected = true;

  		}else if( ! $this->is_selected ){
  			unset( $this->pages[ $id_page ] );
  		}
  	}

  	if( $this->is_selected ){  		
  		$returned .= dynil_wrap_content( $this->get_html_another_pages( $this->this_page ), ['class'=>'dyn_all_pages'] ); 
  	}

  	return $returned;
  }

	
  public function change_the_content( ){  	

  		add_filter( 'the_content', array( $this , 'change_hook') );
  	
  }
}