(function(){

    var $ = jQuery,
        that = app.views.admin.create,
        helpers = app.helpers,
        ajax = app.ajax,
        newProductForm,
        titleInput,
        priceInput;

    function submitNewProductForm(){
        var title = titleInput.val(),
            price = priceInput.val();
        helpers.resetForm(newProductForm);
        if (helpers.isEmpty(title)){
            titleInput.addClass(helpers.errorClass);
        }
        if (helpers.isEmpty(price)){
            priceInput.addClass(helpers.errorClass);
        }
        if (helpers.isFormValid(newProductForm)){
            ajax.ajax(
                'POST',
                '/admin/create',
                {
                    title: title,
                    price: price
                }
            )
                .then(function(){
                    //todo, success message
                    console.log('succes');
                    // window.location.href = '/profile';
                })
                .catch(function(error){
                    //todo, error messages based on status codes
                    console.log('error', error);
                    switch (error.jqXHR.status){
                        case 400:
                            console.log(error);
                            break;
                        case 401:
                            console.log('401');
                            break;
                    }
                });
        }
    }

    this.init = function(){
        if ($('#page-admin-create-product').length > 0){
            //variables
            newProductForm = $('#admin-create-product-form');
            titleInput = $('#create-product-title');
            priceInput = $('#create-product-price');

            //bindings
            newProductForm.on('submit',function(event){
                event.preventDefault();
                submitNewProductForm();
            });
        }
    };

}).apply(app.views.admin.create);