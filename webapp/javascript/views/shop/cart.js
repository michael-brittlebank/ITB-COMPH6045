(function(){

    var $ = jQuery,
        that = app.views.shop.cart,
        helpers = app.helpers,
        ajax = app.ajax,
        modals = app.modals,
        removeItemFromCartButtons;

    function submitRemoveFromCart(element){
        if (confirm('Are you sure you want to remove this product from your cart?')){
            var id = element.attr('data-product-id');
            ajax.ajax(
                'PUT',
                '/cart',
                {
                    id: id,
                    quantity: 0
                }
            )
                .then(function(){
                    window.location.reload();
                })
                .catch(function(){
                    modals.openErrorModal('Error','Could not remove product from cart. Please try again later');
                });
        }
    }

    this.init = function(){
        removeItemFromCartButtons = $('.cart-product-button-remove');

        removeItemFromCartButtons.on('click',function(event){
            event.preventDefault();
            submitRemoveFromCart($(this));
        });
    };

}).apply(app.views.shop.cart);