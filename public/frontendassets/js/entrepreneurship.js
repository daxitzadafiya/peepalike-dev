/*student conference fixed row start*/

$(window).scroll(function(){
    var sticky = $('.student_conference_fixed_row'),
        headrNav = $('.fixed'),
        scroll = $(window).scrollTop();

    if (scroll >= 120) sticky.addClass('student_conference_fixed_row_fixed');
    else sticky.removeClass('student_conference_fixed_row_fixed');
    
});

$(window).scroll(function(){
    var sticky = $('.header_navigation_bar'),
    marg = $(".header_heading_text_form"),
        scroll = $(window).scrollTop();

    if (scroll >= 175) sticky.removeClass('fixed');
    else sticky.removeClass('fixed');
    
});

/*student conference fixed end*/


/*image gallery start*/

mainImg = document.getElementById('mainImg');

thumb1 = document.getElementById('thumb1');
thumb1Src = document.getElementById('thumb1').src;
thumb2 = document.getElementById('thumb2');
thumb2Src = document.getElementById('thumb2').src;
thumb3 = document.getElementById('thumb3');
thumb3Src = document.getElementById('thumb3').src;
thumb4 = document.getElementById('thumb4');
thumb4Src = document.getElementById('thumb4').src;
thumb5 = document.getElementById('thumb5');
thumb5Src = document.getElementById('thumb5').src;
thumb6 = document.getElementById('thumb6');
thumb6Src = document.getElementById('thumb6').src;
thumb7 = document.getElementById('thumb7');
thumb7Src = document.getElementById('thumb7').src;
thumb8 = document.getElementById('thumb8');
thumb8Src = document.getElementById('thumb8').src;
thumb9 = document.getElementById('thumb9');
thumb9Src = document.getElementById('thumb9').src;
thumb10 = document.getElementById('thumb10');
thumb10Src = document.getElementById('thumb10').src;

thumb1.addEventListener("click",function(){
    mainImg.src=thumb1Src
})
thumb2.addEventListener("click",function(){
    mainImg.src=thumb2Src
})
thumb3.addEventListener("click",function(){
    mainImg.src=thumb3Src
})
thumb4.addEventListener("click",function(){
    mainImg.src=thumb4Src
})
thumb5.addEventListener("click",function(){
    mainImg.src=thumb5Src
})
thumb6.addEventListener("click",function(){
    mainImg.src=thumb6Src
})
thumb7.addEventListener("click",function(){
    mainImg.src=thumb7Src
})
thumb8.addEventListener("click",function(){
    mainImg.src=thumb8Src
})
thumb9.addEventListener("click",function(){
    mainImg.src=thumb9Src
})
thumb10.addEventListener("click",function(){
    mainImg.src=thumb10Src
})


$('.third_owl-carousel').owlCarousel({
    loop:true,
    margin:20,
    autoplay:true,
    autoplayTimeout:3000,
    nav:false,
    dots:false,
    responsive:{
        0:{
            items:3
        },
        600:{
            items:4
        },
        1000:{
            items:5
        }
    }
})

/*image gallery end*/


/*review star icon start*/

$(document).ready(function(){
    $(".review_star_1").mouseover(function(){
        $(".review_star_1").toggleClass("all_stars_color");
    })
    $(".review_star_2").mouseover(function(){
        $(".review_star_1").addClass("all_stars_color");
        $(".review_star_2").toggleClass("all_stars_color");
    })
    $(".review_star_3").mouseover(function(){
        $(".review_star_1").addClass("all_stars_color");
        $(".review_star_2").addClass("all_stars_color");
        $(".review_star_3").toggleClass("all_stars_color");
    })
    $(".review_star_4").mouseover(function(){
        $(".review_star_1").addClass("all_stars_color");
        $(".review_star_2").addClass("all_stars_color");
        $(".review_star_3").addClass("all_stars_color");
        $(".review_star_4").toggleClass("all_stars_color");
    })
    $(".review_star_5").mouseover(function(){
        $(".review_star_1").addClass("all_stars_color");
        $(".review_star_2").addClass("all_stars_color");
        $(".review_star_3").addClass("all_stars_color");
        $(".review_star_4").addClass("all_stars_color");
        $(".review_star_5").toggleClass("all_stars_color");
    })
});

/*review star icon end*/






