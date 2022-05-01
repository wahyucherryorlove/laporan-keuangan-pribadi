$(document).ready(function () {
    $("#open-menu-toggle").on("click", function () {
        $(".sidebar").addClass("show");
    });
    $("#close-menu-toggle").on("click", function () {
        $(".sidebar").removeClass("show");
    });
});