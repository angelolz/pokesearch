$(function() {
    $("form[name='login']").validate(
        {
            errorElement: "div",
            errorClass: "invalid",
            rules: {
                username: "required",
                password: "required"
            },
            messages: {
                username: "Username/Email cannot be blank!",
                password: "Password cannot be blank!"
            },
            submitHandler: function(form) {
                form.submit();
            }
        }
    );
});
