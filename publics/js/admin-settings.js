jQuery(function( $ ){ 

  var sett = new Sets( $('.dyn_page_bd ') );
  // sett.mouseMove(  );

  
  $('.dyn_page_bd').children(':text').change( function( ){
    sett.move_text( this, parseInt(jQuery( this ).val()) );
  }); 
  
  
});