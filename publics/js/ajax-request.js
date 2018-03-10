(function( $ ){

	"use strict";

	var actions = {		

		showin: '',
		setShow:function( elem ){
			this.showin = elem
		}
		createAction: function( act ){

			$.ajax({
				url : 'wp-admin/admin-ajax.php',
				type: 'POST',
				data: {
					"action" : act
				},
				success:function( resp ){

					if ( this.showin.length > 0 ){

						$( this.showin ).append( resp );
					}

				}
			});
		}

	}

})(jQuery)