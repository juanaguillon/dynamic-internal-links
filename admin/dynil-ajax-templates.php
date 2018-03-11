<?php 

function dynil_ajax_request( $id_, $act, $name_func ){
	$ajax_request = new Class_ajax_dynil;
	$ajax_request->set_ajax_request( $id , $act );

	$ajax_ret = $ajax_request->get_ajax_request( $id );

	add_action( 'wp_ajax_' . $act , $name_func );
	add_action( 'wp_ajax_nopriv_' . $act , $name_func);

}

 ?>