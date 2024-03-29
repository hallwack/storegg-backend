/*=========================================================================================
  File Name: auth-reset-password.js
  Description: Auth reset password js file.
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: PIXINVENT
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(function () {
    'use strict';

    var pageResetPasswordForm = $('.auth-reset-password-form');

    // jQuery Validation
    // --------------------------------------------------------------------
    if (pageResetPasswordForm.length) {
      pageResetPasswordForm.validate({
        /*
        * ? To enable validation onkeyup
        onkeyup: function (element) {
          $(element).valid();
        },*/
        /*
        * ? To enable validation on focusout
        onfocusout: function (element) {
          $(element).valid();
        }, */
        rules: {
          'password': {
            required: true
          },
          'password_confirmation': {
            required: true,
            equalTo: '#password'
          }
        },
        submitHandler: function(form) {
            formSubmit('post')
            return false;
        }
      });
    }
  });
