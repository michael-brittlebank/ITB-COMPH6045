(function(){

    var $ = jQuery,
        that = app.views.shop.pdp,
        helpers = app.helpers,
        ajax = app.ajax,
        modals = app.modals,
        addToCartForm,
        idInput;

    function submitAddToCartForm(){
        var id = idInput.val();
        if (helpers.isFormValid(addToCartForm)){
            ajax.ajax(
                'PUT',
                '/cart',
                {
                    id: id,
                    quantity: 1
                }
            )
                .then(function(){
                    modals.openSuccessModal('Success', 'Added to cart!');
                })
                .catch(function(){
                    modals.openErrorModal('Error','Could not add product to cart. Please try again later');
                });
        }
    }

    this.init = function(){
        if ($('#page-shop-product').length > 0){
            //variables
            addToCartForm = $('#shop-product-form');
            idInput = $('#shop-product-id');

            //bindings
            addToCartForm.on('submit',function(event){
                event.preventDefault();
                submitAddToCartForm();
            });
        }
    };

}).apply(app.views.shop.pdp);