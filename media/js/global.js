jQuery(document).ready(function( $ ) {

	// TOGGLE DROPDOWN
	$('.header_nav_dropdown .header_nav_cancel').on('click', function(e) {
		$(this).closest('.header_nav_dropdown').fadeOut('fast');
		$(this).closest('.header_nav_dropdown').siblings('p').removeClass('active');
	});
	$('.header_nav_has_dropdown > a, .header_nav_actions .header_nav_button_delete, .header_nav_actions .header_nav_button_change').on('click', function(e) {
		$(this).toggleClass('active');
		$(this).siblings('.header_nav_dropdown').fadeToggle('fast')
		e.stopPropagation();
		return false;
	});
	$('.header_nav_actions .header_nav_dropdown').on('click', function(e) {
		e.stopPropagation();
	});

	$('#header_nav_forgot').click(function() {
		$('#header_nav_userforgot_form').toggle('fast');
	});

        $('#az_char_search_buttons_e').on('click', function addChar(){
		$('#filter_search_query').val(function(n,c) {
			return c + $('#az_char_search_buttons_e').val(); 
			})
	});
	$('#az_char_search_buttons_c').on('click', function addChar(){
		$('#filter_search_query').val(function(n,c) {
                        return c + $('#az_char_search_buttons_c').val(); 
                        })
	});
	$('#az_char_search_buttons_g').on('click', function addChar(){
		 $('#filter_search_query').val(function(n,c) {
                        return c + $('#az_char_search_buttons_g').val();
                        })
	});
	$('#az_char_search_buttons_i').on('click', function addChar(){
		 $('#filter_search_query').val(function(n,c) {
                        return c + $('#az_char_search_buttons_i').val();
                        })
	});
	$('#az_char_search_buttons_o').on('click', function addChar(){
		 $('#filter_search_query').val(function(n,c) {
                        return c + $('#az_char_search_buttons_o').val();
                        })
	});
	$('#az_char_search_buttons_u').on('click', function addChar(){
		 $('#filter_search_query').val(function(n,c) {
                        return c + $('#az_char_search_buttons_u').val();
                        })
	});
	$('#az_char_search_buttons_s').on('click', function addChar(){
		 $('#filter_search_query').val(function(n,c) {
                        return c + $('#az_char_search_buttons_s').val();
                        })
        });
        $('#az_char_search_buttons_w').on('click', function addChar(){
        	 $('#filter_search_query').val(function(n,c) {
                        return c + $('#az_char_search_buttons_w').val();
                        })
        });
	
	// Silence JS errors if console not defined (ie. not firebug and not running chrome)
	if(typeof(console) === 'undefined') {
		var console = {};
		console.log = console.error = console.info = console.debug = console.warn = console.trace = console.dir = console.dirxml = console.group = console.groupEnd = console.time = console.timeEnd = console.assert = console.profile = function() {};
	}
	
	// Trigger pngFix
	if($(document).pngFix)
	{
		$(document).pngFix();
	}

});
