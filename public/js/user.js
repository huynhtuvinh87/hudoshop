// /* ====================
//  * Define Project widget module
//  * ==================== */
window.UserWidget = (function(userWidget, $) {
    var self = (userWidget.Option = userWidget.Option || {});

    /**
     * next div to show project recursive
     *
     * @param element next
     */
    self.checkPassword = function(t) {
        $(this).toggleClass("check_password");
        if (localStorage.getItem("check_password") === null) {
            let val = "yes";
            localStorage.setItem("check_password", "yes");
        } else {
            let val =
                localStorage.getItem("check_password") === "no" ? "yes" : "no";
            localStorage.setItem("check_password", val);
        }

        if (localStorage.getItem("check_password") === "yes") {
            $("#check_password").val("on");
            $("#change_password_option").removeClass("hide");
            $("#change_password_option").addClass("show");
        } else {
            $("#check_password").val("");
            $("#change_password_option").removeClass("show");
            $("#change_password_option").addClass("hide");
        }
    };

    return userWidget;
})(window.UserWidget || {}, window.jQuery);

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
