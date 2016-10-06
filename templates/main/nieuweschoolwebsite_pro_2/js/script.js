$(document).ready(function() {
    console.log("hallo");
    /**
     * Blokken passend maken
     * Masonry
     */
    $(window).load(function() {
        $('.grid').masonry({
            // options
            itemSelector: '.grid-item',
						columnWidth: 1
            //columnWidth: 200
        });
    });
});
