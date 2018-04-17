jQuery(function( $ ){ 

  var sett = new Sets( $('.dyn_page_bd') );  
  
  $('.dyn_page_bd').children(':text').change( function( ){

    if ( isNaN( parseInt( jQuery(this).val() ) ) ) {
      alert(Messages.noNumbers);
      $( this ).val('').focus();
      return;
    }
    sett.move_text(this, $(this).val());      
    
  });     
  

  $('#dyn_submit_setter').click( function( ){
    document.form_insert_pages.submit();
  });
});