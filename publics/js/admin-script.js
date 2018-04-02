(function( $ ){
function dynil_put_in_table(){
	var name_ = $('.names_pages_selected');
	var table = document.getElementById('table_result');
	var id = name_.children('.dyn_ajax_id').val();
	var els = {
		0:{
			check: '<input type="checkbox" value="' + id + '" />',
			id: id,
			name: name_.children('.dyn_ajax_title').text(),
			date: name_.children('.dyn_ajax_date').val()					
		}
	}
	var Tab = new dyn_show_table( els , table );
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
		}else if( e.keyCode == 13){
			
			if( $('.names_pages_selected').length > 0 ){
				dynil_put_in_table()
			}
		}else if( $(this).val().length > 3 ){

			var request = new Ajax_request({				
				data : {
					'action':'show_pages',
					'name': capitalizeFirstLetter( $( this).val()),
				},
				success:function( resp ){
					$('#respond').empty();			
					$('#respond').append( resp );									
				},
				complete:function(){
					names_on_page();	
				}
			});
			request.exec();
		}
		
	});
	function names_on_page(){	
		jQuery('#respond .names_pages')
		.hover(function(){
			
			var el = $(this);
			if ( $('.names_pages_selected').length > 0){
				var eldel = $('.names_pages_selected');
				eldel.removeClass('names_pages_selected');
			}		
			el.toggleClass('names_pages_selected');
		})
		.click(function(){
			dynil_put_in_table();
		})
		
	}
	

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
		var Tables = new dyn_show_table( pages, table );
		
		
		
	});

});
// End jquery function anonymous
})(jQuery);
