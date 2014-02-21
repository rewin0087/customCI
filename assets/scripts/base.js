/*
* GLOBAL VARIABLES DECLARATION
*
*/

/*
* EVENT TRIGGER
*
*/


// block numbers
$('input.__char').live('keydown', function(event) {
	var isIE = document.all ? 1 : 0
	var key = !isIE ? event.which : event.keyCode;
	
	if((47 < key && key < 58 && event.shiftKey==false) || (95 < key && key < 106) || (key > 34 && key < 40) || (key == 46) || (key == 109)){
	return false;
	}
});

// with decimal
$('input.decimal').live('keypress', function(event) {
	var isIE = document.all ? 1 : 0
	var key = !isIE ? event.which : event.keyCode;
	
	if(key == 8 || key == 46) {
		return true;
	}
	
	if(!(47 < key && key < 58 && event.shiftKey == false) || (95 < key && key < 106) || (key > 34 && key < 40)) {
		return false;
	}	
});

// decimal validation
$('input.decimal').live('keyup', function() {
	var val = $(this).val();
	
	if((val.substring(0) == ".") || ((val.split(".").length - 1) > 1)){
		if((val.split(".").length - 1) > 1){
			$(this).val(val.slice(0, -(val.split(".").length - 2)));
		}
		
		if(val.substring(0) == "."){
			$(this).val("00.");
		}
		
		return false;
	}	
});

$.extend({
	message : function(type, message) {
		if(type == 'error') {
			$('div.ajax-message').html(message).css({ background : 'rgba(189, 54, 47, 0.9)', border : '1px solid rgba(255, 255, 255, 0.7)', height : '20px'}).fadeIn();
			setTimeout(function() {
				$('div.ajax-message').fadeOut(300);
			}, 3000);
		} else if(type == 'success') {
			$('div.ajax-message').html(message).css({background: 'rgba(0, 136, 204, 0.9)', border: '1px solid rgba(21, 155, 32, 0.7)', height : '20px'}).fadeIn();
			setTimeout(function() {
				$('div.ajax-message').fadeOut(300);
			}, 3000);
		} else {
			$('div.ajax-message').html(message).css({background: 'rgba(0, 0, 0, 0.9)', border: '1px solid rgba(21, 155, 32, 0.7)', height : '20px'}).fadeIn();
			setTimeout(function() {
				$('div.ajax-message').fadeOut(300);
			}, 3000);
		}
		return false;		
	}	
});

$.extend({
	loader : function(show) {
		if(show) {
			$('div.loader').fadeIn();
		} else {
			$('div.loader').fadeOut();
		}
		return false;		
	}	
});

function validateEmail(email) {
	var re = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

	return re.test(email);
}
