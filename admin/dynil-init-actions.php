<?php 

new_ajax_request('show_pages','show_pages');

add_action( 'wp_enqueue_scripts' , array( dynil() , 'load_scripts_site' ) );
add_action( 'admin_enqueue_scripts' , array( dynil() , 'load_scripts_admin') );

?>