/* ----------------------------------------------
 * GONAM, e-com.
 * (c)Candia Nicolas, 2014
 * ----------------------------------------------
 */
 
/********************************************
 * Form pre-verification
 * Verify form before sending
 ********************************************/ 
var _jcheckForm = new Array();
var _jcheckError = new Array();
 
function jcheck(object) {
	var jcheckNbField = object.length;
	var n = 0;
	
	for (i = 0; i < jcheckNbField; i++) {
		if ($(object[i]).hasClass('jrequired')) {
			var formValue = object[i].value;
			if (formValue == null || formValue == "") {
				_jcheckError[n] = object[i];
				_jcheckError[n]['color'] = $(object[i]).css("background-color");
				_jcheckError[n]['error_name'] = 'required';
				n++;
			}
		}
		if ($(object[i]).hasClass('jemail')) {
			var formValue = object[i].value;
			var at_pos = formValue.indexOf("@");
			var dot_pos = formValue.lastIndexOf(".");
			if (at_pos < 1 || dot_pos < at_pos + 2 || dot_pos + 2 >= formValue.length) {
				_jcheckError[n] = object[i];
				_jcheckError[n]['color'] = $(object[i]).css("background-color");
				_jcheckError[n]['error_name'] = 'email';
				n++;
			}
		}
	}
	
	return (_jcheckError.length > 0)
}

function jcheckHighlight() {
	for (i = 0; i < _jcheckError.length; i++)
		$(_jcheckError[i]).css("background-color", "#F4CAC6");
}

function jcheckReset() {
	for (i = 0; i < _jcheckError.length; i++)
		$(_jcheckError[i]).css("background-color", _jcheckError[i]['color']);
	_jcheckError = new Array();
}

 $(function() {
 
	/* Form pre-verification before sending */
	$('.jcheck').each(function() {
		$(this).submit(function() {
			jcheckReset();
			if (jcheck(this)) {
				jcheckHighlight();
				return false;
			}
		});
	});
	
});