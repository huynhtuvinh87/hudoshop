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
