
var Ajax_request = function( act, data_, callback ){
	
	this.act = act;	
	this.data = data_
	this.call = callback;
}


Ajax_request.prototype.exec = function( ){
	jQuery.ajax({
		url: 'admin-ajax.php',
		type: 'post',
		data: this.data,		
		success: this.call	
	});

}

function capitalizeFirstLetter( str ){
	return str[0].toUpperCase() + str.slice( 1 );
}
