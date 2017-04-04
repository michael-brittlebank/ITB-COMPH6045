(function(){

    var $ = jQuery,
        that = app.views.user.profile,
        helpers = app.helpers,
        ajax = app.ajax,
        modals = app.modals,
        passwordForm,
        passwordInput,
        repeatPasswordInput,
        idInput;

    function submitUpdatePasswordForm(){
        var password = passwordInput.val(),
            repeatPassword = repeatPasswordInput.val(),
            id = idInput.val();
        helpers.resetForm(passwordForm);
        if (helpers.isEmpty(password)){
            passwordInput.addClass(helpers.errorClass);
        }
        if (helpers.isEmpty(repeatPassword)){
            repeatPasswordInput.addClass(helpers.errorClass);
        }
        if (password !== repeatPassword){
            modals.openErrorModal('Error','Passwords do not match.  Please try again');
        } else if (helpers.isFormValid(passwordForm)){
            ajax.ajax(
                'PUT',
                '/profile',
                {
                    password: password,
                    id: id
                }
            )
                .then(function(){
                    modals.openSuccessModal('Success','Password updated successfully');
                    helpers.resetFormValues(passwordForm);
                })
                .catch(function(){
                    modals.openErrorModal('Error','Could not update password. Contact your site administrator');
                });
        }
    }

    this.init = function(){
        if ($('#page-user-profile').length > 0){
            //variables
            passwordForm = $('#user-profile-password-form');
            passwordInput = $('#user-profile-password');
            repeatPasswordInput = $('#user-profile-password-repeat');
            idInput = $('#user-profile-id');

            //bindings
            passwordForm.on('submit',function(event){
                event.preventDefault();
                submitUpdatePasswordForm();
            });
        }
    };

}).apply(app.views.user.profile);