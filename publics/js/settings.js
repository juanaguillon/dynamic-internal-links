var Sets = function( elements ){ 

  
  this.$el = jQuery(elements);
  
  this.defaults = {    
    clicking: false,
    start: 0,
    cloneObject: null,
    elemLength : jQuery( elements ).length,
    previus: false,
    nextius: false,
    test: 'first'
    
  }
  var objSets = this,
      defaults = objSets.defaults;
  var vals = 0;

  this.mouseMove = function ( direction = 'prev' ){ 

    this.$el.mousedown( function(  ){

      if ( defaults.elemLength < 2 ){
        return;
      }      
      
      objSets.defaults.clicking = true;
      
      var thatEl = jQuery( this );
      thatEl.prev( ).length > 0 ? defaults.previus = true : false ;
      thatEl.next( ).length > 0 ? defaults.nextius = true: false;

      if ( direction == 'prev' && defaults.previus ){
        objSets.defaults.start = jQuery(this).prev().position().top;

      }else if( direction == 'next' && defaults.nextius ){
        objSets.defaults.start = jQuery(this).next().position().top;
      }

      var cloned = objSets.defaults.cloneObject = jQuery( this ).clone();
      
    });

    jQuery( document ).mouseup( function( ){

      defaults.clicking = false;

      var cloned = objSets.defaults.clicking;
      if( cloned != null ){
        // jQuery('.bd_clone').remove();
      }
      
    });

    this.$el.mousemove( function( e ){

      
      if ( ! objSets.defaults.clicking  ) return false; 
      
      var cloned = objSets.defaults.cloneObject;
      
      cloned.css({
        "position":"absolute",
        "left": ( e.pageX - (jQuery('#wpbody').offset().left ) - (cloned.width() / 2) ) ,
        "top": ( e.pageY - (jQuery('#wpbody').offset().top ) - (cloned.height() / 2) )
        
      }).addClass( 'bd_clone' ).prop('disabled',true);
      jQuery(this).after(cloned);
      
      console.log( this );

      var ePage = e.pageY - ( jQuery('#wpbody').offset().top ),
          starting = objSets.defaults.start,
          dir = direction == 'prev' ? jQuery( this ).prev() : jQuery( this ).next();

      if( starting >= ePage && defaults.previus ){
        defaults.start = dir.position().top;
        console.log( 'box Changed');
      }
      console.log("|ePage| => " + ePage + " and |Starting| => " + starting );
    });    
  } 
  
  this.move_text = function( that, int ){

    var $that = jQuery( that );
    $that.parent().append('<span class="val_priority">' + int + '</span>');
    if( this.$el.children( '.val_priority' ).length <= 1 ){
      
      $that.parent().prependTo( jQuery('.dynil_setter_pages') );
      
    }else{
      
      var $elem = this.$el;
      var childrens = $elem.children('.val_priority');
      var recx = false;
      
      console.log( 'Each00');
      childrens.each( function(){
        
        var th_int = parseInt(jQuery(this).text());
        if ( th_int > vals ){
          
          recx = jQuery( this );
          vals = parseInt(recx.text( ));
        }
        
      });
      console.log( vals );
      console.log( recx );
      if ( $that.val() > recx.text() ){
        $that.parent().insertAfter( recx.parent() );
      }else{
        $that.parent().insertBefore( recx.parent() );
      }
    }
    
    $that.remove();


  }
}

  