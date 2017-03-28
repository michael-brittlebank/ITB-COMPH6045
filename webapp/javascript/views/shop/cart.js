(function(){

    var $ = jQuery,
        that = app.views.shop.cart,
        ajax = app.ajax,
        modals = app.modals,
        removeItemFromCartButtons,
        updateItemQuantityButtons;

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

    function submitUpdateQuantity(element){
        if (confirm('Are you sure you want to update the quantity of this product?')){
            var id = element.attr('data-product-id'),
                quantity = $('#cart-product-'+id+'-quantity').val();
            if (quantity > 0 && quantity < 100) {
                ajax.ajax(
                    'PUT',
                    '/cart',
                    {
                        id: id,
                        quantity: quantity
                    }
                )
                    .then(function () {
                        window.location.reload();
                    })
                    .catch(function () {
                        modals.openErrorModal('Error', 'Could not update product quantity. Please try again later');
                    });
            } else {
                modals.openErrorModal('Error', 'Please enter a quantity between 1 and 100');
            }
        }
    }

    this.init = function(){
        if ($('#page-cart').length > 0) {
            removeItemFromCartButtons = $('.cart-product-button-remove');
            updateItemQuantityButtons = $('.cart-product-button-update');

            removeItemFromCartButtons.on('click', function (event) {
                event.preventDefault();
                submitRemoveFromCart($(this));
            });

            updateItemQuantityButtons.on('click', function (event) {
                event.preventDefault();
                submitUpdateQuantity($(this));
            });
        }
    };

}).apply(app.views.shop.cart);