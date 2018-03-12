<?php 

function script_path( $name ){

	return plugins_url( 'publics/js/' .$name . '.js', dirname(__FILE__) );
}



 ?>