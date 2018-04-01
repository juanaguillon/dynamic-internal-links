
var Ajax_request = function( act, data_, callback ){
	
	this.act = act;	
	this.data = data_
	this.call = callback;
}


Ajax_request.prototype.exec = function( others = {} ){
	var ajax_default = {
		url: 'admin-ajax.php',
		type: 'post',
		data: this.data,		
		success: this.call	
	}
	var all_ajax = Object.assign( ajax_default, others )
	jQuery.ajax( all_ajax );

}

function capitalizeFirstLetter( str ){
	return str[0].toUpperCase() + str.slice( 1 );
}
