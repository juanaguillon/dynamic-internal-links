<?php 

function new_ajax_request( $id_ajax , $act ){

	dynil()->classes['ajax']->ajax_request( $id_ajax, $act);
	return dynil()->classes['ajax']->get_ajax_request( $id_ajax );

}






 ?>