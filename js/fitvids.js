// Basic FitVids
jQuery(document).ready(function() {
    		jQuery('#content').fitVids();
    	});
		
/**
 * jQuery Scroll Top Plugin 1.0.0
 */
 
// Back To Top
jQuery(document).ready(function ($) {
    $('a[href=#container]').click(function () {
        $('html, body').animate({
            scrollTop: 0
        }, 'slow');
        return false;
    });
});