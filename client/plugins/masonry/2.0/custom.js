/**
 * CUSTOM MASONRY EXPANSION BY MICHAEL/BRAM
 * LAAD DE BEELDEN IN NADAT DE WEBSITE GELADEN IS
 * ZONDER WINDOW LOAD.
 * OPVULLEN GEBEURD MET EEN PLACEHOLDER
 * @param {type} $
 * @returns {undefined}
 */

(function ($) {

    $.fn.preloadMasonry = function (options) {

        // This is the easiest way to have default options.
        var settings = $.extend({
            // These are the defaults.
            masonryItemElementClass: '.js-masonry-item',
            placeholderClass: '.js-placeholder',
            placeholderBackground: '#eee',
            dataWidth: 'width',
            dataHeight: 'height',
            dataSrc: 'src',
        }, options);
        
        
     

        var $masonry = $(this);
        var $masonry_item = settings.masonryItemElementClass;
        var $masonry_placeholder = settings.placeholderClass;

        var width;
        var height;
        var perc_divider;
        var calcWidth;
        var calcHeight;

        $masonry.find($masonry_placeholder).each(function () {
            width = $(this).data(settings.dataWidth);
            height = $(this).data(settings.dataHeight);

            calcWidth = $(this).parents($masonry_item).width();
            calcHeight = $(this).parents($masonry_item).height();

            perc_divider = (width / 100);
            perc_divider = (calcWidth / perc_divider);

            height = (height / 100);
            height = (height * perc_divider);
            $(this).css({width: calcWidth, height: height, background: settings.placeholderBackground});
        });


        $masonry.imagesLoaded(function () {
            $masonry.masonry({
                // options
                itemSelector: $masonry_item,
                isFitWidth: true
            });

            var time = 0;
            $($masonry_item).each(function () {
                var obj = $(this);
                var el;
                if (obj.find($masonry_placeholder).length > 0) {
                    setTimeout(function () {
                        el = obj.find($masonry_placeholder);
                        setTimeout(function () {
                            var imgPath = el.data(settings.dataSrc);
                            var imgEl = $('<img src="' + imgPath + '" />').load(function () {
                                el.css({opacity: 0});
                                el.attr('src', imgPath);
                                el.animate({opacity: 1}, 600);
                                el.css({width: 'auto', height: 'auto'});
                            });
                        }, 1000);


                    }, time)
                    time += 150;
                }
            });

        });



    };

}(jQuery));