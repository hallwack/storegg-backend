$(function () {
    ('use strict');
    var pageResetForm = $('.auth-register-form');
    if (pageResetForm.length) {
        pageResetForm.validate({
            /*
            * ? To enable validation onkeyup
            onkeyup: function (element) {
              $(element).valid();
            },*/
            // * ? To enable validation on focusout
            // onfocusout: function (element) {
            //   $(element).valid();
            // },
            rules: {
                'name': {
                    required: true
                },
                'email': {
                    required: true,
                    email: true
                },
                'password': {
                    required: true
                },
                'password_confirmation' : {
                    minlength : 5,
                    equalTo : "#password"
                },
                'register-privacy-policy': {
                    required: true
                },
            },
            submitHandler: function(form){
                formSubmit('post');
                return false;
            }
        })
    }
})
