/*------------------------------------------------------------------
[Main Script]

Project     : p3-hayaApproved
Version     : 1.0
Author      : Md Ekramul Hassan Avi
Author URI  : https://www.tigertemplate.com
-------------------------------------------------------------------*/


// mobile menu call
$('#phn-menu').slicknav({
    prependTo:'#nav-menu'
});


$(document).ready(function(){
    function rtl_owl(){
    if ($('html').hasClass("rtl")) {
        return true;
    } else {
        return false;
    }}
  var owl = $('.theme_select_slider');
  owl.owlCarousel({
      loop:false,
      autoplay: false,
      autoplayTimeout:2500,
      smartSpeed:900,
      margin:24,
      nav:false,
      //navText: ["<button class='slick-prev slick-arrow'>Previous</button>","<button class='slick-prev slick-arrow'>Next</button>"],
      dots:false,
      items:3,
      rtl: rtl_owl(),
      responsive:{
          0:{
              items:2,
              margin:10
          },
          600:{
              items:2,
              margin:15
          },
          1000:{
              items:3,
              margin:15
          },
          1200:{
              items:3,
              margin:15
          },
          1400:{
              items:3,
              margin:24
          }
      }
  });

  // Custom Button
  $('.MyNextButton').click(function() {
      owl.trigger('next.owl.carousel');
  });
  $('.MyPrevButton').click(function() {
      owl.trigger('prev.owl.carousel');
  });
});

// hero slider
function rtl_slick(){
if ($('html').hasClass("rtl")) {
    return true;
} else {
    return false;
}}
$('.hero-slick').slick({
    dots: true,
    arrows: false,
    infinite: true,
    speed: 500,
    autoplay: true,
    autoplaySpeed: 3000,
    fade: true,
    cssEase: 'linear',
    rtl: rtl_slick()
});

// magnificPopup
$(document).ready(function(){
    $('.image-link').magnificPopup({
      type: 'image',
      mainClass: 'mfp-with-zoom', 
      gallery:{
          enabled:true
        }, 
      zoom: {
        enabled: true, 
        duration: 300, // duration of the effect, in milliseconds
        easing: 'ease-in-out', // CSS transition easing function
    
        opener: function(openerElement) {
    
          return openerElement.is('img') ? openerElement : openerElement.find('img');
      }
    }
    });
});

// calendar
$(function() {

  rome(inline_cal, { time: false });

});


// gallery filter
$(document).ready(function(){
  $(".filter-button").click(function(){
        var value = $(this).attr('data-filter');
        
        if(value == "all")
        {
            //$('.filter').removeClass('hidden');
            $('.filter').show('1500');
        }
        else
        {
    //            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
    //            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
            $(".filter").not('.'+value).hide('3000');
            $('.filter').filter('.'+value).show('3000');
            
        }
        if ($(".filter-button").removeClass("active")) {
            $(this).removeClass("active");
        }
        $(this).addClass("active");
  });
});