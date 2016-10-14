$(document).ready(function(){
  /**
  * Blokken passend maken
  * Masonry
  */
  $(window).load(function() {
    $('.grid').masonry({
      // options
      itemSelector: '.grid-item',
      columnWidth: '.grid-sizer',
      percentPosition: true
    });

    $('.newsitem__intro').dotdotdot({
      watch: "window",
      after: "a.newsitem__read-more"
    });
  });
});
