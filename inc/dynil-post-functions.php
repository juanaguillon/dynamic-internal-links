<?php 

function new_ajax_request( $id_ajax , $act ){

	dynil()->classes['ajax']->set_ajax_request( $id_ajax, $act);
	$ajax_ = dynil()->classes['ajax']->get_ajax_request( $id_ajax );

	add_action( 'wp_ajax_' . $ajax_  , array( dynil() , 'get_name_page' ) );
	add_action( 'wp_ajax_nopriv_' . $ajax_, array( dynil() , 'get_name_page' )  );

}
?>