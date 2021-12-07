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

$('#add-bank-acc').click(function (){
    $('#bank-list').append("<div class=\"bank border-bottom left w-100 pb-20\">\n" +
        "                            <div class=\"form-row left\">\n" +
        "                                <div class=\"form-col-50 left\">\n" +
        "                                    <div class=\"v-select2\">\n" +
        "                                        <label for=\"ten-ngan-hang\">Tên ngân hàng<span class=\"text-red\">*</span></label>\n" +
        "                                        <select name=\"ten-ngan-hang\" class=\"share_select\">\n" +
        "                                            <option value=\"\">-- Chọn ngân hàng --</option>\n" +
        "                                        </select>\n" +
        "                                    </div>\n" +
        "                                </div>\n" +
        "                                <div class=\"form-col-50 ml-10-p left\">\n" +
        "                                    <div class=\"v-select2\">\n" +
        "                                        <label for=\"chi-nhanh-ngan-hang\">Chi nhánh<span\n" +
        "                                                    class=\"text-red\">*</span></label>\n" +
        "                                        <select name=\"chi-nhanh-ngan-hang\" class=\"share_select\">\n" +
        "                                            <option value=\"\">-- Chọn chi nhánh --</option>\n" +
        "                                        </select>\n" +
        "                                    </div>\n" +
        "                                </div>\n" +
        "                            </div>\n" +
        "                            <div class=\"form-row left\">\n" +
        "                                <div class=\"form-col-50 left\">\n" +
        "                                    <label for=\"tai-khoan-ngan-hang\">Tài khoản ngân hàng<span\n" +
        "                                                class=\"text-red\">*</span></label>\n" +
        "                                    <input type=\"text\" id=\"tai-khoan-ngan-hang\" name=\"tai-khoan-ngan-hang\"\n" +
        "                                           placeholder=\"Nhập số tài khoản\">\n" +
        "                                </div>\n" +
        "                                <div class=\"form-col-50 left ml-10-p\">\n" +
        "                                    <label for=\"ma-so-thue\">Chủ tài khoản</label>\n" +
        "                                    <input type=\"text\" id=\"ma-so-thue\" name=\"ma-so-thue\" placeholder=\"Nhập mã số thuế\">\n" +
        "                                </div>\n" +
        "                            </div>\n" +
        "                            <div class=\"right\">\n" +
        "                                <p class=\"removeItem2\"><i class=\"ic-delete2\"></i></p>\n" +
        "                            </div>\n" +
        "                        </div>");
    RefSelect2();
})
$(document).on('click', '.removeItem2', function (){
    $(this).parents('div.bank').remove();
    return false;
})





// scroll button
$('.scr-l-btn').click(function(e) {
    e.preventDefault();
    $('.table-container').animate({
        scrollLeft: "+=300px"
    }, "slow");
});

$('.scr-r-btn').click(function(e) {
    e.preventDefault();
    $('.table-container').animate({
        scrollLeft: "-=300px"
    }, "slow");
});