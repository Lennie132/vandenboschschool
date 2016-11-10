//De breedte van het scherm (in px) waarbij het menu moet omschakelen naar mobiele versie
var collapseAtWidth = 770;

$(document).ready(function(){
  checkResponsiveMenu();

  if ($('.main-block--scroll').length) {
    var element = $('.main-block--scroll');
    var originalY = element.offset().top;
    scrollMainBlock(element, originalY);
  }

  $(window).resize(function() {
    checkResponsiveMenu();
  });

  $(window).scroll(function() {
    if ($('.main-block--scroll').length) {
      scrollMainBlock(element, originalY);
    }
  });


  // Functie voor het open van submenu's
  $('.menu > li.isparent > a').on('click', function (e) {
    //OPTIE 1:
    //Als de pagina zelf ook content bevat, dan link één keer uitzetten
    //        if (!$(this).hasClass('is-navigatable')) {
    //            e.preventDefault();
    //        }
    //        $('.header-nav > li.isparent > a').removeClass('is-navigatable');
    //        $(this).addClass('is-navigatable');

    //OPTIE 2:
    //Als de pagina zelf geen content bevat, altijd sub-menu triggeren en link uitzetten
    e.preventDefault();


    //Vervolg van de functie voor diepte 1
    if ($(this).parents('li.isparent').eq(0).hasClass('is-open-1')) {
      $(this).parents('li.isparent').eq(0).removeClass('is-open-1');
    } else {
      $('.menu > li.isparent').removeClass('is-open-1');
      $(this).parents('li.isparent').eq(0).addClass('is-open-1');
    }
  });

  $('.menu-button').on('click', function() {
    if(!$('.menu').hasClass('menu--open')) {
      $('.menu').addClass('menu--open');
    } else {
      $('.menu').removeClass('menu--open');
    }
  });
});

/**
* Menu responsive maken als het niet meer past
*/
function checkResponsiveMenu() {
  //if ($('.menu').width() >= $('.header-wrapper').width()) {
  if ($(window).width() <= collapseAtWidth) {
    $('.menu-button').removeClass('menu-button--hidden');
    $('.header-wrapper').addClass('header-wrapper--responsive');
    $('.menu').addClass('menu--responsive');
  } else {
    $('.menu-button').addClass('menu-button--hidden');
    $('.header-wrapper').removeClass('header-wrapper--responsive');
    $('.menu').removeClass('menu--responsive');
    $('.menu').removeClass('menu--open');
  }
}


function scrollMainBlock(element, originalY) {
  var offsetTop = 74;
  var scrollTop = $(window).scrollTop();
  var newTop;

  if (scrollTop < originalY || $(window).width() <= 991) {
    newTop = 0;
  } else {
    newTop = scrollTop;
  }

  element.stop(false, false).animate({top: newTop}, 300);
}
