
var Ajax_request = function( act, show, data_ ){

	this.showin = show;
	this.act = act;	
	this.data = data_

}


Ajax_request.prototype.exec = function( ){
	console.log( this.showin );
	jQuery.ajax({
		url: 'admin-ajax.php',
		type: 'post',
		data: this.data,		
		success:function( resp ){
			 jQuery( 'body').append( 'hell' )
		}
	});

}

	

