var h = jQuery(document).height();
$(".sidebar").css("height", parseInt(h) - 300);
$("body").on("keyup", "#ajax-search", function() {
    // Declare variables
    var input = document.getElementById("ajax-search");
    var filter = input.value.toUpperCase();
    var table = document.getElementById("table-ajax");
    var trs = table.tBodies[0].getElementsByTagName("tr");
    // Loop through first tbody's rows
    for (var i = 0; i < trs.length; i++) {
        // define the row's cells
        var tds = trs[i].getElementsByTagName("td");
        // hide the row
        trs[i].style.display = "none";
        // loop through row cells
        for (var i2 = 0; i2 < tds.length; i2++) {
            // if there's a match
            if (tds[i2].innerHTML.toUpperCase().indexOf(filter) > -1) {
                // show the row
                trs[i].style.display = "";

                // skip to the next row
                continue;
            }
        }
    }
});

$("body").on("click", ".menu_tab", function() {
    localStorage.setItem("menu_tab", $(this).data("type"));
    $("#menu_type").val($(this).data("type"));
});

$(document).ready(function() {
    var getStorage = localStorage.getItem("menu_tab");
    if (getStorage !== null) {
        $(".menu_tab_" + getStorage).addClass("active");
        $(".widget_tab_" + getStorage).addClass("active");
        $("#tab_" + getStorage).addClass("active");
        $("#menu_type").val(getStorage);
    } else {
        $(".menu_tab_category").addClass("active");
        $(".widget_tab_category").addClass("active");
        $("#tab_category").addClass("active");
        $("#menu_type").val("category");
    }
});

$("#menu-add").on("click", function() {
    var url = $(this).val(); // get selected value
    if (url) {
        // require a URL
        window.location = "/admin/menus/?menu_id=" + url; // redirect
    }
    return false;
});