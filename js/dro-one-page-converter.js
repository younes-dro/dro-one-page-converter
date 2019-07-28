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
    /**
     * Dislay / Hide gallery caption text if it's exists
     */
    if ($('figure.gallery-item .gallery-caption')) {
        $('figure.gallery-item .gallery-caption').css({"display": "none"});
        var toggleCaption = $('<span/>', {'class': 'toggleCaption',
            'html': '<i class="fa toggleCaption-plus"></i>'});
        $('figure.gallery-item').has('.gallery-caption').append(toggleCaption);

       $('figure.gallery-item  .toggleCaption').on('click',function(){
           $(this).find('i').toggleClass('toggleCaption-minus');
            $(this).prev('.gallery-caption').slideToggle();
       });
    }



})(jQuery);


