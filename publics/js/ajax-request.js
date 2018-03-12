"use strict";
alert(' estoy aqi cabore');
var Ajax_request = function( act, show, data_ ){

	Ar = Ajax_request;

	Ar.showin = $(show) || '';
	Ar.act = act;	
	Ar.data = data_


}
Ajax_request.fn = Ajax_request.prototype;

Ajax_request.fn.exec = function(  ){

	jQuery.ajax({
		url: '/wp-admin/admin-ajax.php',
		type: 'post',
		data: this.data_,		
		success:function( resp ){
			jQuery( this.showin ).append( resp )
		}
	})

}

	

