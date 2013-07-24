/*
* GLOBAL VARIABLES DECLARATION
*
*/
	var scrollHeight = 0;
	var menuhover 	 = [];
 	var menuout		 = [];
/*
* EVENT TRIGGER
*
*/

// --- home html body click hide sub menu
$('div.html-content').on('click', function() {
	$('div.sub-menu').fadeOut();
	$('a.show-menu').fadeIn();
	$('div.menu-holder').animate({ marginBottom : '0px'});	
});

/*
* FUNCTIONS
*
*/
;