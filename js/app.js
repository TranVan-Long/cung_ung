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
$('.modal-btn').click(function() {
    $('.modal').fadeOut();
    var id = $(this).attr("data-target");
    $('#' + id).fadeIn();
});

// $('.remove-item').click(function () {
//     var id = $(this).attr("data-target");
//     $('#' + id).fadeIn();
// });

$('.cancel').click(function() {
    $('.modal').fadeOut();
});

$(window).click(function(e) {
    if ($(e.target).is('.modal')) {
        $('.modal').fadeOut();
    }
});
// modal end


// them tai khoan ngan hang
$('#add-bank-acc').click(function() {
    var html = `<div class="bank border-bottom left w-100 pb-10 d-flex spc-btw">
                    <div class="bank-form">
                        <div class="form-row left">
                            <div class="form-col-50 left mb_15">
                                <label for="ten-ngan-hang">Tên ngân hàng<span class="text-red">&ast;</span></label>
                                <input type="text" name="ten_nhanhang" placeholder="Nhập tên ngân hàng">
                            </div>
                            <div class="form-col-50 right mb_15 v-select2">
                                <label for="chi-nhanh-ngan-hang">Chi nhánh
                                    <span class="text-red">&ast;</span></label>
                                <input type="text" name="chi_nhanh" placeholder="Nhập tên chi nhánh ngân hàng">
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 left mb_15">
                                <label>Số tài khoản<span class="text-red">&ast;</span></label>
                                <input type="text" name="so_tk" placeholder="Nhập số tài khoản" oninput="<?= $oninput ?>">
                            </div>
                            <div class="form-col-50 right mb_15">
                                <label>Chủ tài khoản</label>
                                <input type="text" name="chu_taik" placeholder="Nhập tên chủ tài khoản">
                            </div>
                        </div>
                    </div>
                    <div class="removeItem2">
                        <i class="ic-delete2"></i>
                    </div>
                </div>`;
    $('#bank-list').append(html);
});

// them nguoi lien he
$("#add-references").click(function() {
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
                        <input type="tel" name="so_dien_thoai_lh">
                    </td>
                    <td class="w-30">
                        <input type="email" name="email_lh">
                    </td>
                </tr>`;
    $("#rererences").append(html);
    RefSelect2();
});

// them gia tri tieu chi danh gia
$('#add-rules-value').click(function() {
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

// xoa item
$(document).on('click', '.removeItem', function() {
    $(this).parents('tr').remove();
    var x = 1;
    $('.one_stt').each(function() {
        $(this).text(x);
        x++;
    });
    return false;
});
$(document).on('click', '.removeItem2', function() {
    $(this).parents('div.bank').remove();
    return false;
});
$(document).on('click', '.removeItem3', function() {
    $(this).parents('div.value').remove();
    return false;
});
// $(document).on('click', '.confirm-delete', function () {
//     var target = $(this).attr('data-target')
//     $('#' + target).remove();
//     return false;
// });

// resize table on windows resize
$(window).on("load resize ", function() {
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

// function right() {
//     $('.table-wrapper').animate({
//         scrollLeft: "+=300px"
//     }, "slow");
// };

// function left() {
//     $('.table-wrapper').animate({
//         scrollLeft: "-=300px"
//     }, "slow");
// };

function next_q(_this) {
    scrollLeft = $(_this).parent().find('.table-wrapper').scrollLeft().toFixed(0);
    var maxScrollLeft = $(_this).parent().find('.table-wrapper').get(0).scrollWidth - $(_this).parent().find('.table-wrapper').get(0).clientWidth;
    if (parseInt(scrollLeft) < maxScrollLeft) {
        $(_this).parent().find('.table-wrapper').animate({ scrollLeft: '+=300' }, 400);
        $(_this).parent().find(".left").css('display', 'block');
    } else {
        $(_this).parent().find('.table-wrapper').animate({ scrollLeft: '+=0' }, 0);
    }
}

function pre_q(_this) {
    scrollLeft = $(_this).parent().find('.table-wrapper').scrollLeft().toFixed(0);
    if (parseInt(scrollLeft) <= 0) {
        $(_this).parent().find('.table-wrapper').animate({ scrollLeft: '-=0' }, 0);
    } else {
        $(_this).parent().find('.table-wrapper').animate({ scrollLeft: '-=300' }, 400);
        $(_this).parent().find(".right").css('display', 'block');
    }
}

function table_scroll(_this) {
    var tableScrollLeft = $(_this).parent().find('.table-wrapper').scrollLeft().toFixed(0);
    var maxtableScrollLeft = $(_this).parent().find('.table-wrapper').get(0).scrollWidth - $(_this).parent().find('.table-wrapper').get(0).clientWidth;
    var tableScrollLeftNow = parseInt(tableScrollLeft);
    if (tableScrollLeftNow != maxtableScrollLeft) {
        $(_this).parent().find('.left,.right').css('display', 'block');
    }
    if (tableScrollLeftNow === maxtableScrollLeft || tableScrollLeftNow === maxtableScrollLeft - 1 || tableScrollLeftNow === maxtableScrollLeft + 1) {
        $(_this).parent().find('.right').hide();
    }
    if (tableScrollLeftNow === 0) {
        $(_this).parent().find('.left').hide();
    }
    if (maxtableScrollLeft - parseInt(tableScrollLeft) <= 300) {
        $(_this).find('.right').hide();
    }
    if (parseInt(tableScrollLeft) > 0 && parseInt(tableScrollLeft) <= 300) {
        $(_this).find('.left').hide();
    }
}

$('#value-type').on('change', function() {
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
                        <input type="number" name="gia_tri" placeholder="Nhập giá trị lớn nhất">
                    </div>`;
        $('.chon_gt').append(html);
    } else {
        $('.value-control').hide();
        $('.value').remove();
        $('.gia_tri1').remove();
    }
});