$(function() {
    jQuery.validator.addMethod("addTeamReqs", function(value, element) {
        if(/^[A-Za-z\s]+$/.test(value))
        {
            return true;
        }

        else
        {
            return false;
        }
    });

    $("form[name='add-team']").validate(
        {
            errorElement: "div",
            errorClass: "invalid",
            rules: {
                "team-name": {
                    required: true,
                    addTeamReqs: true,
                    maxlength: 20
                }
            },
            messages: {
                "team-name": {
                    required: "Team name cannot be blank!",
                    addTeamReqs: "Only letters and spaces allowed!",
                    maxlength: "Team name is too long!"
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        }
    );
});
