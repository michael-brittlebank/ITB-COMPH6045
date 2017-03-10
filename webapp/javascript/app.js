/*
 this follows the namespacing pattern listed here https://addyosmani.com/blog/essential-js-namespacing/
 */

var app = {

    //libraries (highest level for ease of use)
    ajax: {},
    animations: {},
    helpers: {},
    mediaQueries: {},

    //modules
    modules: {
        carousel: {}
    },

    //templates
    views: {
        login: {}
    },

    //functions
    init: function(){
        var views = app.views;

        //views
        views.login.init();
    }
};

//wait for the dom to load
$(function(){
    app.init();
});