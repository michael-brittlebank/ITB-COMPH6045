(function(){

    var $ = jQuery,
        that = app.views.user.profile,
        helpers = app.helpers,
        ajax = app.ajax,
        modals = app.modals,
        profileForm,
        emailInput,
        firstNameInput,
        lastNameInput,
        idInput;

    function submitProfileForm(){
        var email = emailInput.val(),
            firstName = firstNameInput.val(),
            lastName = lastNameInput.val(),
            id = idInput.val();
        helpers.resetForm(profileForm);
        if (helpers.isEmpty(email)){
            emailInput.addClass(helpers.errorClass);
        }
        if (helpers.isEmpty(firstName)){
            firstNameInput.addClass(helpers.errorClass);
        }
        if (helpers.isEmpty(lastName)){
            lastNameInput.addClass(helpers.errorClass);
        }
        if (helpers.isFormValid(profileForm)){
            ajax.ajax(
                'PUT',
                '/profile',
                {
                    email: email,
                    firstName: firstName,
                    lastName: lastName,
                    id: id
                }
            )
                .then(function(success){
                    if (success){
                        modals.openSuccessModal('Success', 'Profile edited successfully');
                    } else {
                        //204 no content
                        modals.openSuccessModal('No Change', 'No update detected');
                    }
                })
                .catch(function(error){
                    switch (error.jqXHR.status){
                        case 400:
                            modals.openErrorModal('Error','Could not update profile. Ensure email is unique');
                            break;
                        case 401:
                            modals.openErrorModal('Error','Could not update profile. Contact your site administrator');
                            break;
                        default:
                            modals.openErrorModal('Error','Could not update profile. Contact your site administrator');
                            break;
                    }
                });
        }
    }

    this.init = function(){
        if ($('#page-user-profile').length > 0){
            //variables
            profileForm = $('#user-profile-form');
            emailInput = $('#user-profile-email');
            firstNameInput = $('#user-profile-first-name');
            lastNameInput = $('#user-profile-last-name');
            idInput = $('#user-profile-id');
            
            //bindings
            profileForm.on('submit',function(event){
                event.preventDefault();
                submitProfileForm();
            });
        }
    };

}).apply(app.views.user.profile);