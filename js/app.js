$('.dropdown').click(function (){
    $('.dropdown-content').slideToggle();
});


$('.modal-btn').click(function () {
    $('.modal').fadeIn();
});

$('.cancel').click(function () {
    $('.modal').fadeOut();
});


$(window).click(function (e) {
    if ($(e.target).is('.modal')) {
        $('.modal').fadeOut();
    }
});

function RefSelect2() {
    $(".share_select").select2({
        width: '100%',
    });
}
$("#add-material").click(function () {
    $("#materials").append("<tr class=\"item\">\n" +
        "                                <td class=\"materials-act\"><p class='removeItem'><i class=\"ic-delete remove-btn\"></i></p></td>\n" +
        "                                <td class=\"materials-id\">\n" +
        "                                    <select name=\"materials-id\" class=\"share_select\"></select>\n" +
        "                                </td>\n" +
        "                                <td class=\"materials-name\">\n" +
        "                                    <select name=\"materials-name\" class=\"share_select\"></select>\n" +
        "                                </td>\n" +
        "                                <td class=\"materials-unit\"><input type=\"text\" readonly disabled></td>\n" +
        "                                <td class=\"materials-qty\"><input type=\"text\"></td>\n" +
        "                            </tr>");
    RefSelect2();
});
$(document).on('click', '.removeItem', function () {
    $(this).parents('tr').remove();
    return false;
});