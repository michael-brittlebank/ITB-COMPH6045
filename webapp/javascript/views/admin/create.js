(function(){

    var $ = jQuery,
        that = app.views.admin.create,
        helpers = app.helpers,
        ajax = app.ajax,
        modals = app.modals,
        newProductForm,
        titleInput,
        priceInput,
        urlInput,
        categoryInput;

    function submitNewProductForm(){
        var title = titleInput.val(),
            price = priceInput.val(),
            url = urlInput.val(),
            category = categoryInput.val();
        helpers.resetForm(newProductForm);
        if (helpers.isEmpty(title)){
            titleInput.addClass(helpers.errorClass);
        }
        if (helpers.isEmpty(price)){
            priceInput.addClass(helpers.errorClass);
        }
        if (helpers.isEmpty(url)){
            urlInput.addClass(helpers.errorClass);
        }
        if (!category || helpers.isEmpty(category)){
            categoryInput.addClass(helpers.errorClass);
        }
        if (helpers.isFormValid(newProductForm)){
            ajax.ajax(
                'POST',
                '/admin/create',
                {
                    title: title,
                    price: price,
                    url: url,
                    category: category
                }
            )
                .then(function(){
                    modals.openSuccessModal('Success','Product created successfully');
                    titleInput.val('');
                    priceInput.val('');
                    urlInput.val('');
                    categoryInput.val('');
                })
                .catch(function(error){
                    switch (error.jqXHR.status){
                        case 400:
                            modals.openErrorModal('Error','Product could not be created. Ensure product url is unique');
                            break;
                        case 401:
                            modals.openErrorModal('Error','Product could not be created. Contact your site administrator');
                            break;
                        default:
                            modals.openErrorModal('Error','Product could not be created. Contact your site administrator');
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
            urlInput = $('#create-product-url');
            categoryInput = $('#create-product-category');

            //bindings
            newProductForm.on('submit',function(event){
                event.preventDefault();
                submitNewProductForm();
            });

            urlInput.on('input', function() {
                //todo, remove slashes and html encode other values
                $(this).val($(this).val().replace(/[\s-]+/g, '-').toLowerCase());
            });
        }
    };

}).apply(app.views.admin.create);