/*header navigation bar start*/

$(window).scroll(function(){
    var sticky = $('.header_navigation_bar'),
    marg = $(".header_heading_text_form"),
        scroll = $(window).scrollTop();

    if (scroll >= 0) sticky.addClass('fixed');
    else sticky.addClass('fixed');
    
});

/*header navigation bar end*/



