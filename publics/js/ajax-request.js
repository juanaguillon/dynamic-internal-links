"use strict";

var Ajax_request = function( act, show ){

	Ar = Ajax_request;

	Ar.showin = show || '';
	Ar.act = act;	


}
Ajax_request.fn = Ajax_request.prototype;

Ajax_request.fn.exec = function( method ){

	jQuery.ajax({
		url: '/wp-admin/admin-ajax.php',
		type: method,
		data: {
			'action': this.act
		},		
		success:function( resp ){
			jQuery( this.showin ).append( resp )
		}
	})

}

	

