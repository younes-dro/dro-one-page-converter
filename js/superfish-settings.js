/* 
 * Custom Responsive Superfish settings
 */

jQuery(document).ready(function ($) {
    var breakpoint = 992;
    var sf = $('nav.main-navigation ul.menu');

    if ($(document).width() >= breakpoint) {
        sf.superfish({
            delay: 200,
            speed: 'fast'
        });
    }

    $(window).resize(function () {
        if ($(document).width() >= breakpoint & !sf.hasClass('sf-js-enabled')) {
            sf.superfish({
                delay: 200,
                speed: 'fast'
            });
        } else if ($(document).width() < breakpoint) {
            sf.superfish('destroy');
        }
    });
});

