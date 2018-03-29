var dyn_show_table = function( els ){
	

	this.els = els;


	var tr_push =  '<tr>';

	for (var i = 0; i < this.els.length; i++) {
		if ( i == this.els.length - 1 ){
			tr_push += '<td> ' + this.els[i] + '</td>'
		}else{
			tr_push += '<td style="border-left:1px solid gray">' + this.els[i] + '</td>';			
		}
	}
	tr_push += '</tr>';
	this.tr_ = tr_push;

}

dyn_show_table.prototype.put_elements = function( place ){

	place.append( this.tr_ );

}
