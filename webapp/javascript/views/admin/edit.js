(function(){

    var $ = jQuery,
        that = app.views.admin.edit,
        helpers = app.helpers,
        ajax = app.ajax,
        modals = app.modals,
        newProductForm,
        titleInput,
        priceInput,
        urlInput,
        idInput;

    function submitEditProductForm(){
        var title = titleInput.val(),
            price = priceInput.val(),
            url = urlInput.val(),
            id = idInput.val();
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
        if (helpers.isFormValid(newProductForm)){
            ajax.ajax(
                'PUT',
                '/admin/edit',
                {
                    title: title,
                    price: price,
                    url: url,
                    id: id
                }
            )
                .then(function(){
                    modals.openSuccessModal('Success','Product edited successfully');
                })
                .catch(function(error){
                    switch (error.jqXHR.status){
                        case 400:
                            modals.openErrorModal('Error','Product could not be edited. Ensure product url is unique');
                            break;
                        case 401:
                            modals.openErrorModal('Error','Product could not be edited. Contact your site administrator');
                            break;
                        default:
                            modals.openErrorModal('Error','Product could not be edited. Contact your site administrator');
                            break;
                    }
                });
        }
    }

    this.init = function(){
        if ($('#page-admin-edit-product').length > 0){
            //variables
            newProductForm = $('#admin-edit-product-form');
            titleInput = $('#edit-product-title');
            priceInput = $('#edit-product-price');
            urlInput = $('#edit-product-url');
            idInput = $('#edit-product-id');

            //bindings
            newProductForm.on('submit',function(event){
                event.preventDefault();
                submitEditProductForm();
            });

            urlInput.on('input', function() {
                $(this).val($(this).val().replace(/[\s-]+/g, '-').toLowerCase());
            });
        }
    };

}).apply(app.views.admin.edit);