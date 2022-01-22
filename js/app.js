

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
    var html = `<tr class="item">
                    <td class="w-10">
                        <p class="removeItem"><i class="ic-delete remove-btn"></i></p>
                    </td>
                    <td class="w-25">
                        <div class="v-select2">
                            <select name="materials_name" class="share_select"></select>
                        </div>
                    </td>
                    <td class="w-20">
                        <input type="text" readonly disabled>
                    </td>
                    <td class="w-25">
                        <input type="text">
                    </td>
                </tr>`;
    $("#materials").append(html);
    RefSelect2();
});
// them tai khoan ngan hang
$('#add-bank-acc').click(function () {
    var html = `<div class="bank border-bottom left w-100 pb-10 d-flex spc-btw">
                    <div class="bank-form">
                        <div class="form-row left">
                            <div class="form-col-50 left mb_15">
                                <label>Tên ngân hàng<span class="text-red">*</span></label>
                                <input type="text" name="ten_ngan_hang" placeholder="Nhập tên ngân hàng">
                            </div>
                            <div class="form-col-50 right mb_15">
                                <label>Chi nhánh<span
                                            class="text-red">*</span></label>
                                <input type="text" name="ten_chi_nhanh" placeholder="Nhập tên chi nhánh ngân hàng">
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 left mb_15">
                                <label>Số tài khoản<span class="text-red">*</span></label>
                                <input type="text" name="so_tk"
                                        placeholder="Nhập số tài khoản">
                            </div>
                            <div class="form-col-50 right mb_15">
                                <label>Chủ tài khoản</label>
                                <input type="text" name="chu_tk" placeholder="Nhập tên chủ tài khoản">
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
    var html = `<tr id="item">
                    <td class="w-5">
                        <p class="removeItem"><i class="ic-delete remove-btn"></i></p>
                    </td>
                    <td class="w-30">
                        <input type="text" name="ten_nguoi_lh">
                    </td>
                    <td class="w-30">
                        <input type="text" name="chuc_vu">
                    </td>
                    <td class="w-20">
                        <input type="text" name="so_dien_thoai_lh">
                    </td>
                    <td class="w-30">
                        <input type="text" name="email_lh">
                    </td>
                </tr>`;
    $("#rererences").append(html);
    RefSelect2();
});
// them tieu chi danh gia
$("#add-ratting-ruler").click(function () {
    var html = `<tr class="item">
                    <td class="w-5"><p class="removeItem"><i class="ic-delete remove-btn"></i></p>
                    </td>
                    <td class="w-5">
                        <p>1</p>
                    </td>
                    <td class="w-20">
                        <div class="v-select2">
                            <select name="chi-nhanh-ngan-hang" class="share_select"></select>
                        </div>
                    </td>
                    <td class="w-10">
                        <p>&nbsp;</p>
                    </td>
                    <td class="w-20">
                        <input type="text">
                    </td>
                    <td class="w-20">
                        <p>&nbsp;</p>
                    </td>
                    <td class="w-20">
                        <p>&nbsp;</p>
                    </td>
                </tr>`;
    $("#ratting-ruler").append(html);
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
    var html = `<tr class="item">
                    <td class="w-5">
                        <p class="removeItem"><i class="ic-delete remove-btn"></i></p>
                    </td>
                    <td class="w-15">
                        <div class="v-select2">
                            <select name="ten_day_du"></select>
                        </div>
                    </td>
                    <td class="w-15">
                        <div class="v-select2">
                            <select name="hang_san_xuat"></select>
                        </div>
                    </td>
                    <td class="w-10">
                        <input type="text" name="don_vi_tinh" disabled>
                    </td>
                    <td class="w-15">
                        <input type="text" name="so_luong">
                    </td>
                </tr>`;

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
    $('.tbl-header').css({ 'padding-right': scrollWidth });
}).resize();

// // scroll left button function
// $('.scr-l-btn').click(function (e) {
//     e.preventDefault();
//     $('.table-wrapper').animate({
//         scrollLeft: "+=300px"
//     }, "slow");
// });
// // scroll right button function
// $('.scr-r-btn').click(function (e) {
//     e.preventDefault();
//     $('.table-wrapper').animate({
//         scrollLeft: "-=300px"
//     }, "slow");
// });

function right() {
    $('.table-wrapper').animate({
        scrollLeft: "+=300px"
    }, "slow");
};

function left() {
    $('.table-wrapper').animate({
        scrollLeft: "-=300px"
    }, "slow");
};

$(document).ready(function () {
    var tbl_width = $('.table-container').width()
    if ($(".table-wrapper").width() < tbl_width) {
        $(".scr-r-btn").css("display", "block");
        $(".scr-l-btn").css("display", "block");
    } else {
        $(".scr-r-btn").css("display", "none");
        $(".scr-l-btn").css("display", "none");
    }
})



$('#value-type').on('change', function () {
    var selectedValue = this.value;
    if (selectedValue == 2) {
        $('.value-control').show();
        $('.gia_tri1').remove();
        var html = `<div class="value border-bottom left w-100 pb-20 mt-10 d-flex spc-btw">
                        <div class="value-form">
                            <div class="form-row left">
                                <div class="form-col-50 left mb_15">
                                    <label>Giá trị<span class="text-red">*</span></label>
                                    <input type="number" name="gia_tri" placeholder="Nhập giá trị">
                                </div>
                                <div class="form-col-50 right mb_15">
                                    <label>Tên hiển thị</label>
                                    <input type="text" name="ten_hien_thi" placeholder="Nhập tên hiển thị">
                                </div>
                            </div>
                        </div>
                        <div class="removeItem3">
                            <i class="ic-delete2"></i>
                        </div>
                    </div>`;
        $('#rules-value').append(html);

    } else if (selectedValue == 1) {
        $('.value-control').hide();
        $('.value').remove();
        var html = `<div class="form-col-50 no-border right mb_15 gia_tri1">
                        <label>Thang điểm<span class="text-red">*</span></label>
                        <input type="text" name="gia_tri" placeholder="Nhập giá trị lớn nhất">
                    </div>`;
        $('.chon_gt').append(html);
    }

    else {
        $('.value-control').hide();
        $('.value').remove();
        $('.gia_tri1').remove();
    }
});

