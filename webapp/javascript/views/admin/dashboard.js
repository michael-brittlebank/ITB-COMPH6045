(function(){

    var $ = jQuery,
        that = app.views.admin.dashboard,
        helpers = app.helpers,
        ajax = app.ajax,
        modals = app.modals,
        deleteProductButtons;

    function submitDeleteProduct(element){
        if (confirm('Are you sure you want to delete this product?')){
            var id = element.attr('data-product-id');
            ajax.ajax(
                'PUT',
                '/admin/delete',
                {
                    id: id
                }
            )
                .then(function(){
                    window.location.reload();
                })
                .catch(function(){
                    modals.openErrorModal('Error','Could not delete product. Please contact your website administrator');
                });
        }
    }

    this.init = function(){
        if ($('#page-admin-dashboard').length > 0){
            deleteProductButtons = $('.button-delete');

            deleteProductButtons.on('click', function (event) {
                event.preventDefault();
                submitDeleteProduct($(this));
            });
        }
    };

}).apply(app.views.admin.dashboard);