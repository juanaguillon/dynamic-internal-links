Object.size = function( element ){

	var size = 0, key;

	for ( key in element ){
		if ( element.hasOwnProperty( key ) ){
			size++;
		}
	}

	return size;
		
}
var dyn_show_table = function( els ){

	this.els = els;
	var tr_push = '';
	
	
	for ( var i in this.els ){

		var itm = this.els[i],
		 		incr = 0;

		tr_push += '<tr>';
		for ( var val in itm ){

			if ( (Object.size( itm ) - 1) > incr ){
				tr_push += '<td class="dynil_result_list" style="border-right:1px solid #C4C4C4">' + itm[val] + '</td>';
			}else{
				tr_push += '<td class="dynil_result_list">' + itm[val] + '</td>';
			}
			incr++
		}
		tr_push += '</tr>';		
	}		
	
	this.tr_ = tr_push;

}

dyn_show_table.prototype.put_elements = function( place ){

	jQuery(place).append( this.tr_ );

}
