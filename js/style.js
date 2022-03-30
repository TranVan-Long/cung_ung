var dropd = $(".user-name");
var dropc = $(".dropdown-content");
var head_avatar = $(".head-avatar");
var mobi_showd = $(".mobi_showd");

$(window).click(function(e) {
    if (!dropd.is(e.target) && !dropc.is(e.target) && !head_avatar.is(e.target) && !mobi_showd.is(e.target) && dropc.has(e.target).length == 0) {
        dropc.removeClass("active");
    }
});

$(".hd_dy_pop .save_new_dp").click(function() {
    window.location.href = "quan-ly-hop-dong.html";
});

$(".dh_dy_pop .save_new_dp").click(function() {
    window.location.href = "quan-ly-don-hang.html";
});

$(".hs_dy_pop .save_new_dp").click(function() {
    window.location.href = "quan-ly-ho-so-thanh-toan.html";
});

$(".phieu_dy_pop .save_new_dp").click(function() {
    window.location.href = "quan-ly-phieu-thanh-toan.html";
});

var avt_menu = $(".avt_menu");
var modal_menu = $(".modal_menu");

$(".avt_menu").click(function() {
    $(".modal_menu").show();
});

$(".collapse").click(function() {
    var id = $(this).attr("data-tab");
    $(".collapse ul").removeClass("active");
    $('#' + id).addClass("active");
});

// function widthSelect() {
//     $(".ma_vatt").select2({
//         width: '100%',
//     });
// }

$(document).on('click', '.remo_cot_ngang', function() {
    $(this).parents(".ctn_table .table tbody tr").remove();

    if ($(".ctn_table .table tbody").height() > 270.5) {
        $(".ctn_table .table thead tr").css('width', 'calc(100% - 10px)');
    } else {
        $(".ctn_table .table thead tr").css('width', '100%');
    }
});


$('.user-name, .head-avatar, .mobi_showd').click(function() {
    $(this).parents('ul').find('.dropdown-content').toggleClass("active");
});


$(document).ready(function() {
    if ($(".ctn_table_ct .table tbody").height() > 159.5) {
        $(".ctn_table_ct .table thead tr").css("width", "calc(100% - 10px)");
    }
});

var modal_share = $(".modal_share");
var close_dectl = $(".close_dectl");
var js_btn_huy = $(".js_btn_huy");

close_dectl.click(function() {
    modal_share.hide();
});

js_btn_huy.click(function() {
    modal_share.hide();
});

$(".nnho_blk").click(function() {
    $(this).parents(".nav-item").find(".nhac_nho").toggleClass("active");
});

$(".tbao_blk").click(function() {
    $(this).parents(".nav-item").find(".thong_bao").toggleClass("active");
});

var nnho_blk = $(".nnho_blk");
var nhac_nho = $(".nhac_nho");

var tbao_blk = $(".tbao_blk");
var thong_bao = $(".thong_bao");


var dang_xuat = $(".dang_xuat");
var logout_ht = $(".logout_ht");
var huy_button = $(".huy_button");

dang_xuat.click(function() {
    logout_ht.show();
});

huy_button.click(function() {
    logout_ht.hide();
});

$(window).click(function(e) {
    if (!nnho_blk.is(e.target) && !nhac_nho.is(e.target) && nnho_blk.has(e.target).length === 0) {
        nhac_nho.removeClass("active");
    }

    if (!tbao_blk.is(e.target) && !thong_bao.is(e.target) && tbao_blk.has(e.target).length === 0) {
        thong_bao.removeClass("active");
    }

    if ($(e.target).is(".logout_ht")) {
        logout_ht.hide();
    }

    if ($(e.target).is(".modal_menu")) {
        modal_menu.hide();
    }
});

$(".logout_all").click(function() {
    window.location.href = "/dang-xuat.html";
});
var formatter = new Intl.NumberFormat('vi-VN', {
    style: 'currency',
    currency: 'VND',
});

jQuery.validator.addMethod("greaterThan",
    function(value, element, params) {

        if (!/Invalid|NaN/.test(new Date(value))) {
            return new Date(value) > new Date($(params).val());
        }

        return isNaN(value) && isNaN($(params).val()) ||
            (Number(value) > Number($(params).val()));
    }, 'Không được lớn hơn {0}');

// cách 2: so sánh ngày
// $.validator.addMethod("dateRange",
//     function () {
//         var date1 = $("#startDate").val();
//         var date2 = $("#endDate").val();
//         return (date1 < date2);
//     })

function next_sc(_this) {
    scrollLeft = $(_this).parent().find('.share_tb_hd').scrollLeft().toFixed(0);
    var maxScrollLeft = $(_this).parent().find('.share_tb_hd').get(0).scrollWidth - $(_this).parent().find('.share_tb_hd').get(0).clientWidth;
    if (parseInt(scrollLeft) < maxScrollLeft) {
        $(_this).parent().find('.share_tb_hd').animate({ scrollLeft: '+=300' }, 400);
        $(_this).parent().find(".scroll_left").css('display', 'block');
    } else {
        $(_this).parent().find('.share_tb_hd').animate({ scrollLeft: '+=0' }, 0);
    }
}

function pre_sc(_this) {
    scrollLeft = $(_this).parent().find('.share_tb_hd').scrollLeft().toFixed(0);
    if (parseInt(scrollLeft) <= 0) {
        $(_this).parent().find('.share_tb_hd').animate({ scrollLeft: '-=0' }, 0);
    } else {
        $(_this).parent().find('.share_tb_hd').animate({ scrollLeft: '-=300' }, 400);
        $(_this).parent().find(".scroll_right").css('display', 'block');
    }
}

function table_scroll_sc(_this) {
    var tableScrollLeft = $(_this).parent().find('.share_tb_hd').scrollLeft().toFixed(0);
    var maxtableScrollLeft = $(_this).parent().find('.share_tb_hd').get(0).scrollWidth - $(_this).parent().find('.share_tb_hd').get(0).clientWidth;
    var tableScrollLeftNow = parseInt(tableScrollLeft);
    if (tableScrollLeftNow != maxtableScrollLeft) {
        $(_this).parent().find(".scroll_left,.scroll_right").css('display', 'block');
    }
    if (tableScrollLeftNow === maxtableScrollLeft || tableScrollLeftNow === maxtableScrollLeft - 1 || tableScrollLeftNow === maxtableScrollLeft + 1) {
        $(_this).parent().find(".scroll_right").hide();
    }
    if (tableScrollLeftNow === 0) {
        $(_this).parent().find(".scroll_left").hide();
    }
    if (maxtableScrollLeft - parseInt(tableScrollLeft) <= 300) {
        $(_this).find(".scroll_right").hide();
    }
    if (parseInt(tableScrollLeft) > 0 && parseInt(tableScrollLeft) <= 300) {
        $(_this).find(".scroll_left").hide();
    }
}