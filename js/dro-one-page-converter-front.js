/**
 * 
 */

(function ($) {

    /* Scroll to specific section on the front page */
    var linksLogo = $('.custom-logo-link');
    $('a[href*="#"]:not([href="#"])').click(function () {
        $('#toggle-menu').trigger('click');
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: (target.offset().top - 50)
                }, 1000);
                return false;
            }
        }
    });   
    
})(jQuery);


