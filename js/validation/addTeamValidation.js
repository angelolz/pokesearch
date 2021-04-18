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
                $.ajax({
                    type: form.method,
                    cache: false,
                    url: "/private/handlers/create_team_handler.php",
                    data: $(form).serialize(),
                    success: function(html) {
                        $("form[name='add-team']").trigger("reset");
                        $("#create-team-box").toggleClass("hidden");
                        $(".messages").replaceWith($(".messages", $(html)));
                        setTimeout(function() {$(".messages").fadeOut("slow");}, 5000);
                        $(".teams-list").replaceWith($(".teams-list", $(html)));
                    },
                });
                return false;
            }
        }
    );
});
