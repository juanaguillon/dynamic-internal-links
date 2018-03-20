<?php 

function dynil_script_path( $name ){

	return plugins_url( 'publics/js/' .$name . '.js', dirname(__FILE__) );
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


 ?>