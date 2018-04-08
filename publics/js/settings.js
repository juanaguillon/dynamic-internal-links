var Sets = function( element ){
  
  this.xx = "hola..";
  this.el = element;
  this.$el = jQuery( this.el );
  
  this.move_it = function ( thing = this.$el ){
    
    thing.mousedown(function( e ){
      var startX = e.pageX;
      var startY = e.pageY;
      
      jQuery( this ).mousemove( function( e ){
        
        console.log( thing );
        var inMotionX = e.pageX;
        var inMotionY = e.pageX;        
      
      } );
      jQuery( this ).mouseup( function (e){

        
        
      });
        
    } );
  }
}

  