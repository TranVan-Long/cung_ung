var tblMenu = $('td .tbl-menu');
var tblMenuContent = $('td .tbl-menu-content');

$('.tbl-menu').click(function () {
    $(this).parents("td").find(".tbl-menu-content").toggleClass('active');
});
$(window).click(function (e) {
    if (!tblMenu.is(e.target) && !tblMenuContent.is(e.target) && tblMenuContent.has(e.target).length === 0) {
        tblMenuContent.removeClass('active');
    }
})

// select2
$(".share_select").select2({
    width: '100%',
});

function RefSelect2() {
    $(".share_select").select2({
        width: '100%',
    });
}

// select2 end

// modal
$('.modal-btn').click(function () {
    $('.modal').fadeOut();
    var id = $(this).attr("data-target");
    $('#' + id).fadeIn();
});
$('.remove-item').click(function () {
    var id = $(this).attr("data-target");
    $('#' + id).fadeIn();
});

$('.cancel').click(function () {
    $('.modal').fadeOut();
});

$(window).click(function (e) {
    if ($(e.target).is('.modal')) {
        $('.modal').fadeOut();
    }
});
// modal end


// them vat tu
$("#add-material").click(function () {
    $("#materials").append("<tr class=\"item\">\n" +
        "                                        <td class=\"w-10\">\n" +
        "                                            <p class=\"removeItem\"><i class=\"ic-delete remove-btn\"></i></p>\n" +
        "                                        </td>\n" +
        "                                        <td class=\"w-15\">\n" +
        "                                            <div class=\"v-select2\">\n" +
        "                                                <select name=\"materials-id\" class=\"share_select\"></select>\n" +
        "                                            </div>\n" +
        "                                        </td>\n" +
        "                                        <td class=\"w-25\">\n" +
        "                                            <div class=\"v-select2\">\n" +
        "                                                <select name=\"materials-name\" class=\"share_select\"></select>\n" +
        "                                            </div>\n" +
        "                                        </td>\n" +
        "                                        <td class=\"w-20\">\n" +
        "                                            <input type=\"text\" readonly disabled>\n" +
        "                                        </td>\n" +
        "                                        <td class=\"w-25\">\n" +
        "                                            <input type=\"text\">\n" +
        "                                        </td>\n" +
        "                                    </tr>");
    RefSelect2();
});
// them tai khoan ngan hang
$('#add-bank-acc').click(function () {
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
// them nguoi lien he
$("#add-references").click(function () {
    $("#rererences").append("<tr class=\"item\">\n" +
        "                                        <td class=\"w-5\">\n" +
        "                                            <p class=\"removeItem\"><i class=\"ic-delete remove-btn\"></i></p>\n" +
        "                                        </td>\n" +
        "                                        <td class=\"w-30\">\n" +
        "                                            <input type=\"text\">\n" +
        "                                        </td>\n" +
        "                                        <td class=\"w-30\">\n" +
        "                                            <input type=\"text\">\n" +
        "                                        </td>\n" +
        "                                        <td class=\"w-20\">\n" +
        "                                            <input type=\"text\">\n" +
        "                                        </td>\n" +
        "                                        <td class=\"w-30\">\n" +
        "                                            <input type=\"text\">\n" +
        "                                        </td>\n" +
        "                                    </tr>");
    RefSelect2();
});
// them tieu chi danh gia
$("#add-ratting-ruler").click(function () {
    $("#ratting-ruler").append("<tr class=\"item\">\n" +
        "                                        <td class=\"w-5\"><p class=\"removeItem\"><i class=\"ic-delete remove-btn\"></i></p>\n" +
        "                                        </td>\n" +
        "                                        <td class=\"w-5\">\n" +
        "                                            <p>1</p>\n" +
        "                                        </td>\n" +
        "                                        <td class=\"w-20\">\n" +
        "                                            <div class=\"v-select2\">\n" +
        "                                                <select name=\"chi-nhanh-ngan-hang\" class=\"share_select\"></select>\n" +
        "                                            </div>\n" +
        "                                        </td>\n" +
        "                                        <td class=\"w-10\">\n" +
        "                                            <p>&nbsp;</p>\n" +
        "                                        </td>\n" +
        "                                        <td class=\"w-20\">\n" +
        "                                            <input type=\"text\">\n" +
        "                                        </td>\n" +
        "                                        <td class=\"w-20\">\n" +
        "                                            <p>&nbsp;</p>\n" +
        "                                        </td>\n" +
        "                                        <td class=\"w-20\">\n" +
        "                                            <p>&nbsp;</p>\n" +
        "                                        </td>\n" +
        "                                    </tr>");
    RefSelect2();
});
// them gia tri tieu chi danh gia
$('#add-rules-value').click(function () {
    $('#rules-value').append("<div class=\"value border-bottom left w-100 pb-20 d-flex spc-btw align-items-center\">\n" +
        "                            <div class=\"form-row left\">\n" +
        "                                <div class=\"form-col-50 left\">\n" +
        "                                    <label for=\"gia-tri\">Giá trị<span\n" +
        "                                                class=\"text-red\">*</span></label>\n" +
        "                                    <input type=\"number\" id=\"gia-tri\" name=\"gia-tri\"\n" +
        "                                           placeholder=\"Nhập giá trị\">\n" +
        "                                </div>\n" +
        "                                <div class=\"form-col-50 left ml-10-p\">\n" +
        "                                    <label for=\"ten-hien-thi\">Tên hiển thị</label>\n" +
        "                                    <input type=\"text\" id=\"ten-hien-thi\" name=\"ten-hien-thi\" placeholder=\"Nhập tên hiển thị\">\n" +
        "                                </div>\n" +
        "                            </div>\n" +
        "                            <div class=\"right\">\n" +
        "                                <p class=\"removeItem3\"><i class=\"ic-delete2\"></i></p>\n" +
        "                            </div>\n" +
        "                        </div>");
    RefSelect2();
});
// them yeu cau thanh toan
$('#add-quote').click(function () {
    $('#quote-me').append("<tr class=\"item\">\n" +
        "                                        <td class=\"w-5\">\n" +
        "                                            <p class=\"removeItem\"><i class=\"ic-delete remove-btn\"></i></p>\n" +
        "                                        </td>\n" +
        "                                        <td class=\"w-15\">\n" +
        "                                            <div class=\"v-select2\">\n" +
        "                                                <select name=\"materials-id\" class=\"share_select\"></select>\n" +
        "                                            </div>\n" +
        "                                        </td>\n" +
        "                                        <td class=\"w-30\">\n" +
        "                                            <div class=\"v-select2\">\n" +
        "                                                <select name=\"materials-name\" class=\"share_select\"></select>\n" +
        "                                            </div>\n" +
        "                                        </td>\n" +
        "                                        <td class=\"w-25\">\n" +
        "                                            <div class=\"v-select2\">\n" +
        "                                                <select name=\"materials-name\" class=\"share_select\"></select>\n" +
        "                                            </div>\n" +
        "                                        </td>\n" +
        "                                        <td class=\"w-10\">\n" +
        "                                            <input type=\"text\" readonly disabled>\n" +
        "                                        </td>\n" +
        "                                        <td class=\"w-15\">\n" +
        "                                            <input type=\"text\">\n" +
        "                                        </td>\n" +
        "                                    </tr>");
    RefSelect2();
});

// xoa item
$(document).on('click', '.removeItem', function () {
    $(this).parents('tr').remove();
    return false;
});
$(document).on('click', '.removeItem2', function () {
    $(this).parents('div.bank').remove();
    return false;
});
$(document).on('click', '.removeItem3', function () {
    $(this).parents('div.value').remove();
    return false;
});
$(document).on('click', '.confirm-delete', function () {
    var target = $(this).attr('data-target')
    $('#' + target).remove();
    return false;
});

// resize table on windows resize
$(window).on("load resize ", function () {
    var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
    $('.tbl-header').css({'padding-right': scrollWidth});
}).resize();

// scroll left button function
$('.scr-l-btn').click(function (e) {
    e.preventDefault();
    $('.table-wrapper').animate({
        scrollLeft: "+=300px"
    }, "slow");
});
// scroll right button function
$('.scr-r-btn').click(function (e) {
    e.preventDefault();
    $('.table-wrapper').animate({
        scrollLeft: "-=300px"
    }, "slow");
});


$('#value-type').on('change', function () {
    var selectedValue = this.value;

    if (selectedValue == 2) {
        $('.manual-value').show();

    } else {
        $('.manual-value').hide();
        $('.value').remove();
    }

});


$('.tbl-menu').click(function () {
    var id = $(this).attr("data-tab");

    $(".tbl-menu-content").removeClass("active");

    $('#' + id).addClass("active");
})
