/**
* CUSTOM MAATWERK
*/

$(document).ready(function(){
  /**
  * Blokken passend maken
  * Masonry
  */
  $(window).load(function() {
    $('.isotope-folders').isotope({
      itemSelector: '.isotope--folder',
      resizable: true,
      masonry: {
        gutter: 0,
        isFitWidth: true
      }
    });

    $('.isotope-files').isotope({
      itemSelector: '.isotope--file',
      resizable: true,
      masonry: {
        gutter: 0,
        isFitWidth: true
      }
    });

    $('.files-wrapper').addClass('files-wrapper--loaded');
  });
});
