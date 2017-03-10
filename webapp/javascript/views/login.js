(function(){

    var $ = jQuery,
        that = app.views.login;

    this.init = function(){
        if ($('#page-login').length > 0){
            console.log('init');
        }
    };

}).apply(app.views.login);