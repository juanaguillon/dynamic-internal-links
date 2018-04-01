function names_on_page(){
	alert('lakjsdklasd');
	jQuery('#respond .names_pages').hover(function(){
		alert('hover');
		var el = $(this);
		if ( $('.names_pages_selected').length > 0){
			var eldel = $('.names_pages_selected');
			eldel.removeClass('names_pages_selected');
		}		
		el.toggleClass('names_pages_selected');
	});
}
jQuery(document).ready(function($) {

	var is_unique = false;
	// Mienstras esté escribiendo el usuario
	$('#dynil_anex_pages').keyup(function( e){		


		if( $( this ).val( ) == "" || e.keyCode == 8){
			$('#respond').empty();
		}else if( e.keyCode ==  40 ){		
			
			if( $('.names_pages_selected').length > 0 ){
				var names_select = $('.names_pages_selected');
				names_select.next().toggleClass('names_pages_selected');
				names_select.removeClass('names_pages_selected');
			}else{
				$('#respond').children().first().toggleClass('names_pages_selected');
			}		

		}else if( e.keyCode == 38 ){
			if( $('.names_pages_selected').length > 0 ){
				var names_select = $('.names_pages_selected');
				names_select.prev().toggleClass('names_pages_selected');
				names_select.removeClass('names_pages_selected');
			}
		}else if( $(this).val().length > 3 ){

			var request = new Ajax_request('show_pages',{
				'action':'show_pages',
				'name': capitalizeFirstLetter( $( this).val()) 
			}, function( resp ){			
				$('#respond').empty();			
				$('#respond').append( resp );
			});
			request.exec({ complete: names_on_page() });
		}
	});

	

	$('#dynil_load_pages').click(function(){
		
		var checks_ = $('.dyn_box_content').children('div').next().children('input[type=checkbox]:checked'),
				pages = {};

		for (var i = 0; i < checks_.length; i++) {
			var id = checks_[i].value;

			pages[i] = {
				check: '<input type="checkbox" value="' + id + '" />',
				id   : id,
				name : $( checks_[i] ).parent().prev().html(),
				date : $( checks_[i]).parent().next().find('span').html()  
			}

			checks_[i].checked = false;
			jQuery(checks_[i]).attr('disabled',true);
			jQuery(checks_[i]).closest('.dyn_box_content').css('background-color','#F0F0F0');
			
		}	
			
		var table = document.getElementById('table_result');
		var Tables = new dyn_show_table( pages, table, {last_index: 'tr' , class_search: 'dyn_tr_second'} );
		
		
		
	});

});

