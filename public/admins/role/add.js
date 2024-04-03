$(function () {
    $(".checkbox_wapper").on("click", function () {
        $(this)
            .parents(".card")
            .find(".checkbox_childrent")
            .prop("checked", $(this).prop("checked"));
    });

    $(".Checkall").on("click", function () {
        $(this)
            .parents()
            .find(".checkbox_childrent")
            .prop("checked", $(this).prop("checked"));
        $(this)
            .parents()
            .find(".checkbox_wapper")
            .prop("checked", $(this).prop("checked"));
    });
});
