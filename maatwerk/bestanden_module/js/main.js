/**
 * CUSTOM MAATWERK
 */

$(window).load(function () {
    $('.isotope-folders').isotope({
        itemSelector: '.isotope-folder',
        resizable: true,
        masonry: {
            gutter: 0,
            isFitWidth: true,
        }
    });

    $('.isotope-files').isotope({
        itemSelector: '.isotope-file',
        resizable: true,
        masonry: {
            gutter: 0,
            isFitWidth: true,
        }
    });

    $('.tilecontainer').addClass('loaded');

    var tilesElement = $('.tilecontainer');
    $('.tile').on('click', function () {
       tilesElement.fadeOut(500);
    });

});
