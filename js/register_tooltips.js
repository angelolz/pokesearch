$(function() {
    $("input[name='username']").focus(function() {
        $("#username-tooltip").css("opacity", "1");
    });

    $("input[name='username']").blur(function() {
        $("#username-tooltip").css("opacity", "0");
    });

    $("input[name='password']").focus(function() {
        $("#password-tooltip").css("opacity", "1");
    });

    $("input[name='password']").blur(function() {
        $("#password-tooltip").css("opacity", "0");
    });
});
