<?php 

$show_page = new_ajax_request('show_pages','show_pages');
add_action('wp_ajax_' . $show_page  , array(
	new Class_pages_dynil , 'get_name_page'
) );
add_action( 'wp_ajax_nopriv_' . $show_page, array(
	new Class_pages_dynil , 'get_name_page'
)  );



 ?>