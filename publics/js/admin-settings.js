jQuery(function( $ ){ 

  var sett = new Sets( $('.dyn_page_bd ') );
  // sett.mouseMove(  );

  
  $('.dyn_page_bd').children(':text').change( function( ){
    if ( isNaN( parseInt( jQuery(this).val() ) ) ) {
      alert(Messages.noNumbers);
      $( this ).val('').focus();
      return;
    } 
    sett.move_text( this, $(this).val() ) ;
  }); 
  
  
});