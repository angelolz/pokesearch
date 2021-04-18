$(function() {
    jQuery.validator.addMethod("usernameReqs", function(value, element) {
        if(/^[a-zA-Z_\-\d]+$/.test(value))
        {
            return true;
        }

        else
        {
            return false;
        }
    });

    jQuery.validator.addMethod("passwordReqs", function(value, element) {
        if(/[0-9]+/.test(value) && /[a-z]+/.test(value) && /[A-Z]+/.test(value) && /[^\w]/.test(value))
        {
            return true;
        }

        else
        {
            return false;
        }
    });

    $("form[name='register']").validate(
        {
            errorElement: "div",
            errorClass: "invalid",
            rules: {
                email: {
                    required: true,
                    email: true
                },
                username: {
                    required: true,
                    usernameReqs: true,
                    minlength: 3,
                    maxlength: 30,
                },
                password: {
                    required: true,
                    passwordReqs: true,
                    minlength: 8
                },
                "conf-password": {
                    required: true,
                    equalTo: "input[name='password']"
                }
            },
            messages: {
                email: {
                    required: "Email cannot be blank!",
                    email: "That is not a valid email!"
                },
                username: {
                    required: "Username cannot be blank!",
                    usernameReqs: "Username does not meet the requirements!",
                    minlength: "Username is too short!",
                    maxlength: "Username is too long!"
                },
                password: {
                    required: "Password cannot be blank!",
                    passwordReqs: "Password does not meet requirements!",
                    minlength: "Password is too short!"
                },
                "conf-password": {
                    required: "This field cannot be blank!",
                    equalTo: "Password fields do not match!"
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        }
    );
});
