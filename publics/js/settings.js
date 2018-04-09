var Sets = function( elements ){ 

  this.$el = jQuery(elements);

  this.defaults = {    
    clicking: false,
    start: 0,
    cloneObject: null
  }
  var objSets = this;

  this.mouseMove = function ( direction = 'prev' ){    
    
    this.$el.mousedown( function(  ){
      objSets.defaults.clicking = true;

      if ( direction == 'prev'){
        objSets.defaults.start = jQuery(this).prev().position().top;
      }else if( direction == 'next' ){
        objSets.defaults.start = jQuery(this).next().position().top;
      }

      var cloned = objSets.defaults.cloneObject = jQuery( this ).clone();
      
    });

    jQuery( document ).mouseup( function( ){
      objSets.defaults.clicking = false;

      var cloned = objSets.defaults.clicking;
      if( cloned != null ){
        // jQuery('.bd_clone').remove();
      }
      
    });

    this.$el.mousemove( function( e ){
      if ( ! objSets.defaults.clicking ) return false;

      
      var ePage = e.pageY - ( jQuery('#wpbody').offset().top );
      var starting = objSets.defaults.start;
      if( starting >= ePage ){
        objSets.defaults.start = jQuery(this).prev().position().top;
        console.log( 'box Changed');
      }
      var cloned = objSets.defaults.cloneObject;
      
      cloned.css({
        "position":"absolute",
        "left": ( e.pageX - (jQuery('#wpbody').offset().left ) - (cloned.width() / 2) ) ,
        "top": ( e.pageY - (jQuery('#wpbody').offset().top ) - (cloned.height() / 2) )
        
      }).removeClass('dyn_page_bd').addClass('bd_clone').prop('disabled',true);
      jQuery(this).after(cloned);
      
      console.log("|ePage| => " + ePage + " and |Starting| => " + starting );
    });    
  }  
}

  