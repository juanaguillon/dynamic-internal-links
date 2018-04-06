/*
* @package Dyn Internal Links
* @since 1.0
* Scripts correspondientes a la seccion de administrador.
* Aqui se cargaran los scripts con otro tipo de funciones, tales como ajax y ejecuciones entre tablas.
*/
(function( $ ){
function disable_box( element ){

	element.checked = false;
	jQuery(element).attr('disabled',true);
	jQuery(element).closest('.dyn_box_content').css('background-color','#F0F0F0');

}
function dynil_put_in_table( bucle = false ){
	var els = {};
	if( ! bucle ){
		var name_ = $('.names_pages_selected');		
		var id = name_.children('.dyn_ajax_id').val();
		els[0] = {
			check: '<input type="checkbox" name="dyn_table_checks[]"  value="' + id + '" checked />',
			id: id,
			name: name_.children('.dyn_ajax_title').text(),
			date: name_.children('.dyn_ajax_date').val()
		}
				
	}else{
		for (var i = 0; i < bucle.length; i++) {

			var id = bucle[i].value;
			els[i] = {
				check: '<input type="checkbox" name="dyn_table_checks[]" value="' + id + '" checked />',
				id   : id,
				name : $( bucle[i] ).parent().prev().html(),
				date : $( bucle[i]).parent().next().find('span').html()  
			}

			disable_box( bucle[i] );
		}

	}
	var table = document.getElementById('table_result');
	var Tab = new dyn_show_table( els , table );
}

function dynil_clean_respond( ){ $('#respond').empty(); }

function dynil_clean_ajax_text(){ $('#dynil_anex_pages').val('') }

function toggle_page_in_table(){
	var ajx = $( '#respond' ).find('.dyn_ajax_id');
	var putNow = $('[name="dyn_table_checks[]"]');
	for ( var i = 0; i < ajx.length; i++ ) {
		for ( var ix = 0; ix < putNow.length; ix++ ) {										
			if ( putNow[ix].value == ajx[i].value ){
				jQuery(ajx[i]).parent().addClass('dyn_ajax_is_put');
			}														
		}														
	}
}
function check_boxes( el ){
	var current_ajax_page = $( el ).children('.dyn_ajax_id').val();
	var boxes = $('[name="dynil_set_pages[]"]');

	for (var i = 0; i < boxes.length; i++) {
		if(boxes[i].value == current_ajax_page ){
			 disable_box( boxes[i] );
		}
	}
}

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
		if( $(this).hasClass('dyn_ajax_is_put') ){
			alert(Messages.cantToTable);
		}else{			
			dynil_put_in_table();
			toggle_page_in_table();
			check_boxes( this );
		}
	});		
}

jQuery(document).ready(function($){

	var is_unique = false;	
	$('#dynil_anex_pages').keypress(function(e){
		if( e.keyCode == 13 )
			e.preventDefault();
		
	});
	$('body').on('click', dynil_clean_respond );
	$('.dynil_ajax_section .content').click(function(e ){ e.stopPropagation() });
	$('#dynil_anex_pages').keyup(function( e ){		
		
		if( $( this ).val( ) == "" || e.keyCode == 8){
			dynil_clean_respond();
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
				
				var x = document.getElementsByClassName('names_pages_selected');				
				check_boxes( x );
				dynil_put_in_table();
				dynil_clean_respond();
				dynil_clean_ajax_text();
				toggle_page_in_table();

			}
			return false;
		}else if( e.keyCode == 27  ){
			dynil_clean_respond();
		}else if( $(this).val().length > 3 ){

			var request = new Ajax_request({				
				data : {
					'action':'show_pages',
					'name': capitalizeFirstLetter( $( this).val()),
				},
				success:function( resp ){
					dynil_clean_respond();
					$('#respond').append( resp );
					
					// $('#respond').append( resp );									
				},
				complete:function(){
					toggle_page_in_table();
					names_on_page();	
				}
			});
			request.exec();
		}
		
	});

	

	$('#dynil_load_pages').click(function(){
		
		var checks_ = $('.dyn_box_content').children('div').next().children('input[type=checkbox]:checked');
		dynil_put_in_table( checks_ );
		
	});

	$('#dyn_send_pages').click(function(e){
		document.dyn_form_send_pages.submit();
	});

});
// End jquery function anonymous
})(jQuery);
