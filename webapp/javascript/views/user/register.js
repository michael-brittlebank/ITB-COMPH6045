(function(){

    var $ = jQuery,
        that = app.views.user.register,
        helpers = app.helpers,
        ajax = app.ajax,
        modals = app.modals,
        registerForm,
        firstNameInput,
        lastNameInput,
        emailInput,
        passwordInput,
        repeatPasswordInput;

    function submitRegisterForm(){
        var firstName = firstNameInput.val(),
            lastName = lastNameInput.val(),
            email = emailInput.val(),
            password = passwordInput.val(),
            repeatPassword = repeatPasswordInput.val();
        helpers.resetForm(registerForm);
        if (helpers.isEmpty(firstName)){
            firstNameInput.addClass(helpers.errorClass);
        }
        if (helpers.isEmpty(lastName)){
            lastNameInput.addClass(helpers.errorClass);
        }
        if (helpers.isEmpty(email)){
            emailInput.addClass(helpers.errorClass);
        }
        if (helpers.isEmpty(password)){
            passwordInput.addClass(helpers.errorClass);
        }
        if (helpers.isEmpty(repeatPassword)){
            repeatPasswordInput.addClass(helpers.errorClass);
        }
        if (password !== repeatPassword){
            modals.openErrorModal('Error','Passwords do not match.  Please try again');
        } else if (helpers.isFormValid(registerForm)){
            ajax.ajax(
                'POST',
                '/register',
                {
                    email: email,
                    password: password,
                    firstName: firstName,
                    lastName: lastName
                }
            )
                .then(function(){
                    window.location.href = '/profile';
                })
                .catch(function(error){
                    switch (error.jqXHR.status){
                        case 400:
                            modals.openErrorModal('Error','Could not register. Ensure there is not already an account registered with that email address');
                            break;
                        case 401:
                            modals.openErrorModal('Error','Could not register. Contact your site administrator');
                            break;
                        default:
                            modals.openErrorModal('Error','Could not register. Contact your site administrator');
                            break;
                    }
                });
        }
    }

    this.init = function(){
        if ($('#page-user-register').length > 0){
            //variables
            registerForm = $('#user-register-form');
            firstNameInput = $('#user-register-first-name');
            lastNameInput = $('#user-register-last-name');
            emailInput = $('#user-register-email');
            passwordInput = $('#user-register-password');
            repeatPasswordInput = $('#user-register-password-repeat');

            //bindings
            registerForm.on('submit',function(event){
                event.preventDefault();
                submitRegisterForm();
            });
        }
    };

}).apply(app.views.user.register);