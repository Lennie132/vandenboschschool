



/**
 * CUSTOM MAATWERK
 */

$(window).load(function () {
    $('.isotope').isotope({
        itemSelector: '.isotope-item',
        resizable: true,
        masonry: {
            gutter: 0,
            isFitWidth: true,
        }
    });



    var tilesElement = $('.tilecontainer');
    $('.tile').on('click', function () {
//       tilesElement.fadeOut(500);
    });

});


$(window).load(function () {
    $('.tilecontainer').addClass('loaded');
});

