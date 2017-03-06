/*

 this follows the namespacing pattern listed here https://addyosmani.com/blog/essential-js-namespacing/

 */


//chose a better global variable name to reduce chances of conflict
var app = {

    //modules
    carousel: {},

    //functions
    init: function(){
        var carousel = app.carousel;
        
        //modules
        if (carousel.hasCarousels()){
            carousel.init();
        }

    }
};

//wait for the dom to load
$(function(){
    app.init();
});