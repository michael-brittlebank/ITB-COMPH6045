(function(){

    var $ = jQuery,
        that = app.views.user.login,
        helpers = app.helpers,
        ajax = app.ajax,
        modals = app.modals,
        loginForm,
        emailInput,
        passwordInput;

    function submitLoginForm(){
        var email = emailInput.val(),
            password = passwordInput.val();
        helpers.resetForm(loginForm);
        if (helpers.isEmpty(email)){
            emailInput.addClass(helpers.errorClass);
        }
        if (helpers.isEmpty(password)){
            passwordInput.addClass(helpers.errorClass);
        }
        if (helpers.isFormValid(loginForm)){
            ajax.ajax(
                'PUT',
                '/login',
                {
                    email: email,
                    password: password
                }
            )
                .then(function(){
                    window.location.href = '/profile';
                })
                .catch(function(error){
                    switch (error.jqXHR.status){
                        case 400:
                            modals.openErrorModal('Error','Could not log in. Ensure email and password are correct');

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
        if ($('#page-user-login').length > 0){
            //variables
            loginForm = $('#user-login-form');
            emailInput = $('#user-login-email');
            passwordInput = $('#user-login-password');

            //bindings
            loginForm.on('submit',function(event){
                event.preventDefault();
                submitLoginForm();
            });
        }
    };

}).apply(app.views.user.login);