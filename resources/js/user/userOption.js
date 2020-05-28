var UserWidget = window.UserWidget.Option;

// Vanilla JS as not bundle, using defer so not need document.ready
window.jQuery(function($) {
    /**
     * Action expanding chil elements, button "+" and "-"
     */
    $("body").on("change", "#check_password", function() {
        UserWidget.checkPassword($(this));
    });

    $(document).ready(function() {
        if (localStorage.getItem("check_password") === "yes") {
            $("#check_password").val("on");
            $("#change_password_option").removeClass("hide");
            $("#change_password_option").addClass("show");
            $("#check_password").attr("checked", true);
        } else {
            $("#check_password").val("");
            $("#change_password_option").removeClass("show");
            $("#change_password_option").addClass("hide");
            $("#check_password").attr("checked", false);
        }
    });
});
