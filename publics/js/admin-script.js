jQuery(document).ready(function($) {
	
	// Mienstras esté escribiendo el usuario
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

			});

	$('#dynil_load_pages').click(function(){
		var checks_ = $('.dyn_box_content').children('input[type=checkbox]:checked');
		var pages = {};

		for (var i = 0; i < checks_.length; i++) {

			pages[i] = {
				name : $( checks_[i] ).prev().html(),   
				id   : checks_[i].value
			}
			
		}

		for( key in pages){
			if ( pages.hasOwnProperty( key ) ){
				for ( kk in pages[key] ){
					if ( pages[key].hasOwnProperty( kk ) ){
						console.log( kk + ' -> ' + pages[key][kk]);
					}
				}
			}
		}
		var Tables = new dyn_show_table( pages );
		var table = document.getElementById('table_result');
		Tables.put_elements( table );
		
		
		
	});

});

