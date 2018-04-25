var Elmt = function( ){
  this.structures = {};
  this.manyElements = function( elems ){
    var allElm = '';
    for( var i = 0; i < elems.length ; i++ ){
      allElm += elems[i];
    }
    return allElm;
  }
  this.createCroqs = function( id, sctructure ){
    if ( ! ( id in this.structures ) ){
      var archive = '';

      if( sctructure === Array ){
        // If is a array
        
        archive = this.manyElements( sctructure );
      }else if( typeof sctructure == 'string' ){
        // If is a string
        
        archive = sctructure;
      }else if( typeof sctructure == 'object' ){
        
        
        // if is object (not array)
        for ( var k in sctructure ){
          if( ! sctructure.hasOwnProperty( k ) ) return;
          
          archive += sctructure[k];
        }
      }
      this.structures[ id ] = archive;      
    }    
  } 

  this.getCroqs = function( id ){    
    if(  this.structures.hasOwnProperty( id ) ){      
      return this.structures[ id ] ;
    }
  }
}

var Sets = function( elements ){ 

  this.theElements = new Elmt();
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
      defaults = objSets.defaults,
      vals = 0,
      recx = false,
      minVal = 0;

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

  this.createAttrs = function( obj, exc ){
    var attrs = '';    
    for( var k in obj ){
      if ( !obj.hasOwnProperty( k ) ) continue;
      if( obj[k] == exc )continue;

      attrs += ' ' + k + '="' + obj[k] + '"';
    }
    return attrs;
  }

  this.createInput = function( attrs ){
    var html = '<input';
    html += this.createAttrs( attrs );
    html += ' >';
    return html;
  }

  this.createElement = function( content, attrs ){
    attrs.elem = attrs.elem || 'div';
    var element = '<' + attrs.elem;
    element+= this.createAttrs( attrs, attrs.elem  );
    element+= ' >' + content + '</' + attrs.elem + '>';
    return element
    
  }
  
  /**
	* function Move Text
	* Se usara esta funcion para mover los elementos (paginas) seleccionadas en la seccion de settings de plugin, por medio de integers.
  */
  this.move_text = function( that ){
    
    var $that = jQuery( that );
    var int = $that.val()
    var op = {
    	dir: 'after',
    	parent: $that.parent(),

    }    

    if( this.$el.children( '.val_priority' ).length == 0 ){
      
      op.parent.prependTo( jQuery('.dynil_setter_pages') );
      
      
    }else{      
     
      var $elem = this.$el = jQuery( '.dyn_page_bd'),
      	  childrens = $elem.children('.val_priority');
      
      childrens.each( function(){
        
        op.th = jQuery( this );      
        op.th_int = parseInt( op.th.text() );
        op.th_parent = op.th.parent();

        var pos = {
        	next: op.th_parent.next(),        	
          prev: op.th_parent.prev()               	
        }                   

     		pos.next_children = pos.next.children('.val_priority');
     		pos.prev_children = pos.prev.children('.val_priority');
        
        if ( pos.next_children.length > 0 ){         
          if (int >= op.th_int && parseInt( pos.next_children.text() ) >= int  ){

            recx = op.th_parent;
            vals = parseInt( recx.children('.val_priority').text() );

          }else if( int <= op.th_int && ( parseInt( pos.prev.length ) == 0 || parseInt( pos.prev_children.text() >= int ) ) ){

          	recx = op.th_parent;
          	vals = parseInt( recx.children('.val_priority').text() );
          	op.dir = 'before';

          }
        }else{
          if( int > op.th_int ){           
            recx = op.th_parent;
            vals = parseInt( recx.children('.val_priority').text() );
          }
        }
        
      });

    }
    if( op.dir == 'after' ){

      $that.parent().insertAfter( recx );

    }else if( op.dir == 'before'){

      $that.parent().insertBefore(recx);
    }
    
    $that.after(this.createElement(int, { 'elem': 'span', 'class': 'val_priority dyn_chance' }));
    $that.after(this.createInput({
      type: 'hidden',
      name: "priority_vals[]",
      value: int
    }));
    $that.remove();
    jQuery( '.val_priority').dblclick(function( ){
      objSets.toInput( this );
      console.log('toIn')
    });
  }

  this.toInput = function( elem, add, func = null ){
    var elem = jQuery( elem );
    elem.next('input[name="priority_vals[]"]').remove();
    var input = this.createInput( {
      'value': elem.html(),
      'type':'text',
      "class": 'dyn_input_change',
    } );
    
    elem.after( [ input, add ] );
    elem.remove();
    
    func;    
  }

  this.inCode = function( elm ){
    var this_el = jQuery( elm );
    var text = this_el.text();
    
    this_el.after( this.createInput({
      "value": text,
      "type": 'text',
      "class":'dyn_input_change'      
    }));
    this_el.remove();

  }
 
}

  