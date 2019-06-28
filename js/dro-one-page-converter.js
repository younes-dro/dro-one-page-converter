/**
 * 
 * 
 * 
 */
(function ($) {

    /**
     * WP Mobile Menu
     * 
     * 
     */
    var droCatererMainMenu = $('.main-navigation ul.menu').clone(true, true);
    $(droCatererMainMenu).droSlidingMenu();

    /**
     * Stick navigation and scroll top on window scrolling  
     * 
     */
    var stickyNavTopMobile = $('.toggle-menu-container-class').css({"position": "fixed"}).offset().top;
    var stickyNavTop = $('.main-navigation').offset().top;
    $(window).scroll(function () {
        var scrollToTop = $(window).scrollTop();
        //Mobile
        if (scrollToTop > stickyNavTopMobile) {
            $('.toggle-menu-container-class').addClass('sticky-header');
        } else {
            $('.toggle-menu-container-class').removeClass('sticky-header');
        }
        // Large screen 
        if (scrollToTop > stickyNavTop) {
            $('.main-navigation').addClass('sticky-header');
        } else {
            $('.main-navigation').removeClass('sticky-header');
        }
        // Scroll to the top
        if ($(this).scrollTop() > 200) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }

    });

})(jQuery);


