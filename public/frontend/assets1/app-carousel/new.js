
!(function($) {
    "use strict";
  
    // Back to top button
    $(window).scroll(function() {
      if ($(this).scrollTop() > 100) {
        $('.back-to-top').fadeIn('slow');
      } else {
        $('.back-to-top').fadeOut('slow');
      }
    });
    $('.back-to-top').click(function() {
      $('html, body').animate({
        scrollTop: 0
      }, 1500, 'easeInOutExpo');
      return false;
    }); 
  
    // Gallery carousel (uses the Owl Carousel library)
    $(".gallery-carousel").owlCarousel({
      autoplay: true,
      dots: true,
      loop: true,
      center: true,
      margin: 25,
      responsive: {
        0: {
          items: 1
        },
        768: {
          items: 3
        },
        992: {
          items: 4
        },
        1200: {
          items: 5
        }
      }
    });
  
    // Initiate venobox lightbox
    $(document).ready(function() {
      $('.venobox').venobox();
    });
  
    // Init AOS
    function aos_init() {
      AOS.init({
        duration: 800,
        easing: "ease-in-out",
        once: true
      });
    }
    $(window).on('load', function() {
      aos_init();
    }); 
  
  })(jQuery);