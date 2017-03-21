(function(){

    var $ = jQuery,
        that = app.views.login,
        helpers = app.helpers,
        ajax = app.ajax,
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
            );
        }
    }

    this.init = function(){
        if ($('#page-login').length > 0){
            //variables
            loginForm = $('#login-form');
            emailInput = $('#login-email');
            passwordInput = $('#login-password');

            //bindings
            loginForm.on('submit',function(event){
                event.preventDefault();
                submitLoginForm();
            });
        }
    };

}).apply(app.views.login);