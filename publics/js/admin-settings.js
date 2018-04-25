jQuery(function( $ ){
  var Element = new Elmt();
  var sett = new Sets($('.dyn_page_bd')); 

  function firsIn( ){
    $('.change_text').click(function () {
      var elm = $(this).prev('input');
      $(this).next('.cancel_text').remove();
      $(this).remove();
      sett.move_text(elm);
      return false;
    });
    
    $('.cancel_text').click(function () {
      
      var elm = $(this).parent().children('input.dyn_input_change');
      $(this).prev('.change_text').remove();
      $(this).remove();
      sett.move_text(elm);
      return false;
    });
  }
  

  var prefEl = {
    button_save:  sett.createElement( Messages.save, {
      "elem": 'button',
      "class": 'button-save change_text'
    }),
    button_cancel: sett.createElement(Messages.cancel, {
      "class": "button-cc cancel_text",
      "elem": 'button'
    })
    
  }
  Element.createCroqs( 'save_cancel', prefEl );  
  
  $('.dyn_page_bd').children(':text').change( function( ){

    if ( isNaN( parseInt( jQuery(this).val() ) ) ) {
      alert(Messages.noNumbers);
      $( this ).val('').focus();
      return;
    }          
    sett.move_text( this );

  }); 
  
  if( $('.val_priority').length > 0 ){

    $('.val_priority').dblclick( function( ){
      
      
      sett.toInput( this, Element.getCroqs( 'save_cancel' ) , firsIn() );     
    });
    
  }

  $('.dyn_val_str').dblclick( function( ){
    sett.inCode( this );
  })
  

  $('#dyn_submit_setter').click( function( ){
    document.form_insert_pages.submit();
  });
});