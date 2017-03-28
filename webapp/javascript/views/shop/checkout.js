(function(){

    var $ = jQuery,
        that = app.views.shop.checkout,
        ajax = app.ajax,
        modals = app.modals,
        submitCheckoutButton;

    function submitCheckout(){
        if (confirm('Are you sure you want to place this order?')){
            ajax.ajax(
                'POST',
                '/checkout',
                {}
            )
                .then(function(){
                    window.location.reload();
                })
                .catch(function(){
                    modals.openErrorModal('Error','Could not place order. Please try again later');
                });
        }
    }

    this.init = function(){
        if ($('#page-checkout').length > 0) {
            submitCheckoutButton = $('#checkout-submit-button');

            submitCheckoutButton.on('click', function (event) {
                event.preventDefault();
                submitCheckout($(this));
            });
        }
    };

}).apply(app.views.shop.checkout);