(function(){

    var $ = jQuery,
        that = app.views.shop.grid,
        helpers = app.helpers,
        categoryInput,
        paginationLinks;

    function submitCategoryChange(){
        var categoryId = categoryInput.val();
        window.location.href = helpers.updateQueryStringParameter(window.location.href, 'category',categoryId);
    }

    function submitPageChange(element){
        var pageId = element.attr('data-page-id');
        window.location.href = helpers.updateQueryStringParameter(window.location.href, 'page',pageId);
    }

    this.init = function(){
        if ($('#page-shop').length > 0){
            //variables
            categoryInput = $('#shop-category');
            paginationLinks = $('.pagination-element');

            //bindings
            categoryInput.on('change',function(event){
                event.preventDefault();
                submitCategoryChange();
            });

            paginationLinks.on('click',function(event){
                event.preventDefault();
                submitPageChange($(this));
            });
        }
    };

}).apply(app.views.shop.grid);