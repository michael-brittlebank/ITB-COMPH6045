(function(){

    var $ = jQuery,
        that = app.modals,
        errorModalHash = 'm--error',
        errorModal,
        errorTitle,
        errorContent,
        successModal,
        successModalHash = 'm--success',
        successTitle,
        successContent;

    this.resetModals = function(){
        window.location.hash = '';
    };

    this.openErrorModal = function(title, content){
        errorTitle.html(title);
        errorContent.html(content);
        window.location.hash = errorModalHash;
        setTimeout(function(){
            that.resetModals();
        }, 5000);
    };

    this.openSuccessModal = function(title, content){
        successTitle.html(title);
        successContent.html(content);
        window.location.hash = successModalHash;
        setTimeout(function(){
            that.resetModals();
        }, 5000);
    };

    this.init = function(){
        errorModal = $('#'+errorModalHash);
        errorTitle = $('#modal-error-title');
        errorContent = $('#modal-error-content');
        successModal = $('#'+successModalHash);
        successTitle = $('#modal-success-title');
        successContent = $('#modal-success-content');
    };

}).apply(app.modals);