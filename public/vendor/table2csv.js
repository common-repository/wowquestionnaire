/* global jQuery */

(function($) {
	
	var options = {
		/* action='downoad' options */
		filename: 'table.csv',
		
		/* action='output' options */
		appendTo: 'body',
		
		/* general options */
		separator: ',',
		newline: '\n',
		quoteFields: true,
		excludeColumns: '',
		excludeRows: ''
	};
	
	function quote(text) {
		return '"' + text.replace('"', '""') + '"';
	}
	
	// taken from http://stackoverflow.com/questions/3665115/create-a-file-in-memory-for-user-to-download-not-through-server
	function download(filename, text) {
		var element = document.createElement('a');
		element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
		element.setAttribute('download', filename);
		
		element.style.display = 'none';
		document.body.appendChild(element);
		
		element.click();
		
		document.body.removeChild(element);
	}
	
	function convert(table) {
		var output = "";
			
		var rows = table.find('tr').not(options.excludeRows);
		
		var numCols = rows.first().find("td,th").not(options.excludeColumns).length;
		//console.log(numCols)
		
		rows.each(function() {
			$(this).find("td,th").not(options.excludeColumns)
			.each(function(i, col) {
				col = $(col);
				
				output += options.quoteFields ? quote(col.text()) : col.text();
				//console.log(i);
				if(i != numCols-1) {
					output += options.separator;
				} else {
					output += options.newline;
				}
			});
		});
		
		return output;
	}
	
	$.fn.table2csv = function(action, opt) {
		if(typeof action === 'object') {
			opt = action;
			action = 'download';
		} else if(action === undefined) {
			action = 'download';
		}
		
		$.extend(options, opt);
		
		var table = this; // TODO use $.each
		//console.log(table);
		
		switch(action) {
			case 'download':
				var csv = convert(table);
				download(options.filename, csv);
				break;
			case 'output':
				var csv = convert(table);
				$(options.appendTo).append($('<pre>').text(csv));
				break;
		}
		
		return this;
	}
	
}(jQuery));