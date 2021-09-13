/*header navigation bar start*/

$(window).scroll(function(){
    var sticky = $('.header_navigation_bar'),
    marg = $(".header_heading_text_form"),
        scroll = $(window).scrollTop();

    if (scroll >= 175) sticky.addClass('fixed');
    else sticky.removeClass('fixed');

    if(scroll>=175) marg.css({"margin-top":"23.5rem"});
    else marg.css({"margin-top":"15rem"});
    
});

/*header navigation bar end*/

/*header navigation menu start*/
$(document).ready(function(){
    $(".menu_bar_icon").click(function(){
        $(".menu_bar_close_icon").css({"display":"block"});
        $(".menu_bar_icon").css({"display":"none"});
        $(".header_navigation_menu").css({"display":"block"});
        $("html, body").css({"overflow":"hidden"});
    })
});

$(document).ready(function(){
    $(".menu_bar_close_icon").click(function(){
        $(".menu_bar_icon").css({"display":"block"});
        $(".menu_bar_close_icon").css({"display":"none"});
        $(".header_navigation_menu").css({"display":"none"});
        $("html, body").css({"overflow":"inherit"});
    })
});
/*header navigation menu end*/