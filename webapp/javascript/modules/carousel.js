(function(){

    var $ = jQuery,
        that = app.carousel,
        carousels = $('.image-carousel');

    this.hasCarousels = function(){
        return carousels.length > 0;
    };

    this.init = function() {
        carousels.slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true,
            arrows: false,
            infinite: true
        });
    };

}).apply(app.carousel);