(function($){
$(document).ready(function(){

	/* Mobile Menu
	======================== */
	var navigation = responsiveNav('#nav', {
		//insert: 'before',
		customToggle: '#mobile-nav-btn'
	});


	/* Jump Top Button
	======================== */
	var winHeight = $( window ).height();
	$(document).scroll(function() {
		if ( $(document).scrollTop() > winHeight ) {
			$('body').addClass( 'scrolled' );
		} else {
			$('body').removeClass( 'scrolled' );
		}
	});
	$('.mobile-jump-top').bind('click', function() {
		$('html,body').animate({
    		scrollTop: $( 'body' ).offset().top
    	});
	});

});
})(jQuery)