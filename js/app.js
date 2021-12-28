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
        "                                                <select name=\"materials_id\" class=\"share_select\"></select>\n" +
        "                                            </div>\n" +
        "                                        </td>\n" +
        "                                        <td class=\"w-25\">\n" +
        "                                            <div class=\"v-select2\">\n" +
        "                                                <select name=\"materials_name\" class=\"share_select\"></select>\n" +
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
    var html = `<div class="bank border-bottom left w-100 pb-10 d-flex spc-btw">
                                <div class="bank-form">
                                    <div class="form-row left">
                                        <div class="form-col-50 left mb_15">
                                            <div class="v-select2 ">
                                                <label for="ten-ngan-hang">Tên ngân hàng<span class="text-red">*</span></label>
                                                <select name="ten_ngan_hang" class="share_select">
                                                    <option value="">-- Chọn ngân hàng --</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-col-50 right mb_15">
                                            <div class="v-select2">
                                                <label for="chi-nhanh-ngan-hang">Chi nhánh<span
                                                            class="text-red">*</span></label>
                                                <select name="chi_nhanh_ngan-hang" class="share_select">
                                                    <option value="">-- Chọn chi nhánh --</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row left">
                                        <div class="form-col-50 left mb_15">
                                            <label>Tài khoản ngân hàng<span
                                                        class="text-red">*</span></label>
                                            <input type="text" name="tai_khoan_ngan_hang"
                                                   placeholder="Nhập số tài khoản">
                                        </div>
                                        <div class="form-col-50 right mb_15">
                                            <label>Chủ tài khoản</label>
                                            <input type="text" name="ma_so_thue"
                                                   placeholder="Nhập mã số thuế">
                                        </div>
                                    </div>
                                </div>
                                <div class="removeItem2">
                                    <i class="ic-delete2"></i>
                                </div>
                            </div>`;
    $('#bank-list').append(html);
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
    var html = `<div class="value border-bottom left w-100 pb-20 mt-10 d-flex spc-btw">
                            <div class="value-form">
                                <div class="form-row left">
                                    <div class="form-col-50 left mb_15">
                                        <label>Giá trị<span
                                                    class="text-red">*</span></label>
                                        <input type="number" name="gia_tri"
                                               placeholder="Nhập giá trị">
                                    </div>
                                    <div class="form-col-50 right mb_15">
                                        <label>Tên hiển thị</label>
                                        <input type="text" name="ten_hien_thi"
                                               placeholder="Nhập tên hiển thị">
                                    </div>
                                </div>
                            </div>
                            <div class="removeItem3">
                                <i class="ic-delete2"></i>
                            </div>
                        </div>`;

    $('#rules-value').append(html);
    RefSelect2();
});
// them yeu cau thanh toan
$('#add-quote').click(function () {
    var html = '<tr class="item">\n' +
        '                                            <td class="w-5">\n' +
        '                                                <p class="removeItem"><i class="ic-delete remove-btn"></i></p>\n' +
        '                                            </td>\n' +
        '                                            <td class="w-15">\n' +
        '                                                <div class="v-select2">\n' +
        '                                                    <select name="ma_vat_tu" class="share_select"></select>\n' +
        '                                                </div>\n' +
        '                                            </td>\n' +
        '                                            <td class="w-30">\n' +
        '                                                <div class="v-select2">\n' +
        '                                                    <select name="ten_day_du"></select>\n' +
        '                                                </div>\n' +
        '                                            </td>\n' +
        '                                            <td class="w-25">\n' +
        '                                                <div class="v-select2">\n' +
        '                                                    <select name="hang_san_xuat"></select>\n' +
        '                                                </div>\n' +
        '                                            </td>\n' +
        '                                            <td class="w-10">\n' +
        '                                                <input type="text" name="don_vi_tinh" disabled>\n' +
        '                                            </td>\n' +
        '                                            <td class="w-15">\n' +
        '                                                <input type="text" name="so_luong">\n' +
        '                                            </td>\n' +
        '                                        </tr>'

    $('#quote-me').append(html);
    RefSelect2();
});
// them bao gia khach hang
$("#them_vt_bg_kh").click(function () {
    var html = `<tr class="item">
                                            <td class="w-5">
                                                <p class="removeItem"><i class="ic-delete remove-btn"></i></p>
                                            </td>
                                            <td class="w-15">
                                                <div class="v-select2">
                                                    <select class="share_select" name="ma_vat_tu">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="w-20">
                                                <div class="v-select2">
                                                    <select name="ten_day_du">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="w-20">
                                                <div class="v-select2">
                                                    <select name="hang_san_suat">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="w-15">
                                                <input type="text" name="so_luong_bao_gia">
                                            </td>
                                            <td class="w-15">
                                                <input type="text" name="don_vi_tinh" disabled>
                                            </td>
                                            <td class="w-20">
                                                <input type="text" name="don_gia">
                                            </td>
                                            <td class="w-20">
                                                <input type="text" name="thanh_tien" disabled>
                                            </td>
                                        </tr>`;
    $("#rererences_kh").append(html);
    RefSelect2();
});
// them bao gia khach hang
$("#add_bgia").click(function () {
    var html = `<tr class="item">
                                            <td class="w-5">
                                                <p class="removeItem"><i class="ic-delete remove-btn"></i></p>
                                            </td>
                                            <td class="w-15">
                                                <div class="v-select2">
                                                    <select class="share_select">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="w-20">
                                                <div class="v-select2">
                                                    <select>
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="w-20">
                                                <div class="v-select2">
                                                    <select>
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="w-15">
                                                <input type="text">
                                            </td>
                                            <td class="w-15">
                                                <input type="text" disabled>
                                            </td>
                                            <td class="w-20">
                                                <input type="text">
                                            </td>
                                            <td class="w-20">
                                                <input type="text" disabled>
                                            </td>
                                        </tr>`;
    $("#rererences_bgia").append(html);
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

$(document).ready(function(){
    var tbl_width = $('.table-container').width()
    if($(".table-wrapper").width() < tbl_width){
        $(".scr-r-btn").css("display","block");
        $(".scr-l-btn").css("display","block");
    }else{
        $(".scr-r-btn").css("display","none");
        $(".scr-l-btn").css("display","none");
    }
})



$('#value-type').on('change', function () {
    var selectedValue = this.value;

    if (selectedValue == 2) {
        $('.manual-value').show();
        $('#rules-value').append("<div class=\"value border-bottom left w-100 pb-20 mt-10 d-flex spc-btw\">\n                            <div class=\"value-form\">\n                                <div class=\"form-row left\">\n                                    <div class=\"form-col-50 left mb_15\">\n                                        <label>Giá trị<span\n                                                    class=\"text-red\">*</span></label>\n                                        <input type=\"number\" name=\"gia_tri\"\n                                               placeholder=\"Nhập giá trị\">\n                                    </div>\n                                    <div class=\"form-col-50 right mb_15\">\n                                        <label>Tên hiển thị</label>\n                                        <input type=\"text\" name=\"ten_hien_thi\"\n                                               placeholder=\"Nhập tên hiển thị\">\n                                    </div>\n                                </div>\n                            </div>\n                            <div class=\"removeItem3\">\n                                <i class=\"ic-delete2\"></i>\n                            </div>\n                        </div>");

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
