<?php 

function dynil_script_path( $name, $typ ){

	return plugins_url( 'publics/' . $typ . '/' .$name . '.' . $typ , dirname(__FILE__) );
}

function dynil_wrap_content( $content, $attrs = array() ){

	$defaults = array(
		'wrap_content' => 'div',
		'id'           => '',
		'class'        => ''		
	);

	$attr = wp_parse_args( $attrs , $defaults );

	$content_html  = '<' . $attr['wrap_content'];
	$content_html .= $attr['id'] != '' ?  ' id="' . $attr['id'] . '"': '';
	$content_html .= $attr['class'] != '' ? ' class="' . $attr['class'] . '">': '>';
	$content_html .= $content;
	$content_html .= '</' . $attr['wrap_content'] . '>';

	return $content_html;


}

function dynil_create_wpdb ( $sql, $output = OBJECT ){

	global $wpdb;
	return $wpdb->get_results( $sql , $output );

}

function dynil_woo_exists( ){

	if( class_exists('WooCommerce') ){
		return true;
	}
	return false;
}

function dynil_clean_pages( $pages ){

	if ( is_array( $pages ) ){
		$html_pages = "" ;
		for( $i = 0 ; $i< sizeof( $pages ); $i++){
			$current_object = $pages[$i];
			
			$html_pages .= "<div class='dyn_box_content dyn_box_{$current_object->ID}'>";			
			$html_pages .= "<div class='dyn_box_data dyn_box_title'>{$current_object->post_title}</div>";
			$html_pages .= '</div>';

		}
		return $html_pages;
	}

}


 ?>