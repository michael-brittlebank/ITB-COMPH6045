(function(){

    var $ = jQuery,
        that = app.views.components.footer,
        ajax = app.ajax,
        helpers = app.helpers,
        activeClass = helpers.activeClass,
        footerCurrencyLinks;

    function submitActiveCurrency(element){
        $('.footer-currency.'+activeClass).removeClass(activeClass);
        element.addClass(activeClass);
        var currency = element.attr('data-currency');
        ajax.ajax(
            'PUT',
            '/preferences',
            {
                currency: currency
            }
        )
            .then(function(){
                window.location.reload();
            })
            .catch(function(error){
                window.location.reload();
            });
    }

    this.init = function(){
        footerCurrencyLinks = $('.footer-currency');

        footerCurrencyLinks.on('click',function(event){
            event.preventDefault();
            submitActiveCurrency($(this));
        });
    };

}).apply(app.views.components.footer);