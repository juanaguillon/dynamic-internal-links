(function($){
	alert('lkajsd');
$('#dynil_anex_pages').keyup(function(){

			if( $( this ).val( ) == ""){
				$('#respond').empty();
			}else{
				var request = new Ajax_request('show_pages',{
					'action':'show_pages',
					'name': capitalizeFirstLetter( $( this).val()) 
				}, function( resp ){
					$('#respond').append( resp );
				});
				request.exec();
			}

		})

})(jQuery);