$(document).ready(function () {
  /**
   * Blokken passend maken
   * Masonry
   */
  $(window).load(function () {
    $('.grid').masonry({
      // options
      itemSelector: '.grid-item',
      columnWidth: '.grid-sizer',
      percentPosition: true
    });

    $('.news-item__intro').dotdotdot({
      watch: "window",
      after: ".news-item__read-more"
    });

    $('[data-toggle="tooltip"]').tooltip();
  });
});
