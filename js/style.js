
var dropd = $(".user-name");
var dropc = $(".dropdown-content");
var head_avatar = $(".head-avatar");
var mobi_showd = $(".mobi_showd");

$(window).click(function (e) {
    if (!dropd.is(e.target) && !dropc.is(e.target) && !head_avatar.is(e.target) && !mobi_showd.is(e.target) && dropc.has(e.target).length == 0) {
        dropc.removeClass("active");
    }
});

$(".hd_dy_pop .save_new_dp").click(function () {
    window.location.href = "quan-ly-hop-dong.html";
});

$(".dh_dy_pop .save_new_dp").click(function () {
    window.location.href = "quan-ly-don-hang.html";
});

$(".hs_dy_pop .save_new_dp").click(function () {
    window.location.href = "quan-ly-ho-so-thanh-toan.html";
});

$(".phieu_dy_pop .save_new_dp").click(function () {
    window.location.href = "quan-ly-phieu-thanh-toan.html";
});

var avt_menu = $(".avt_menu");
var modal_menu = $(".modal_menu");

$(".avt_menu").click(function () {
    $(".modal_menu").show();
});

$(".collapse").click(function () {
    var id = $(this).attr("data-tab");
    $(".collapse ul").removeClass("active");
    $('#' + id).addClass("active");
});

function widthSelect() {
    $(".ma_vatt").select2({
        width: '100%',
    });
}

$(document).on('click', '.remo_cot_ngang', function () {
    $(this).parents(".ctn_table .table tbody tr").remove();

    if ($(".ctn_table .table tbody").height() > 270.5) {
        $(".ctn_table .table thead tr").css('width', 'calc(100% - 10px)');
    } else {
        $(".ctn_table .table thead tr").css('width', '100%');
    }
});


$('.user-name, .head-avatar, .mobi_showd').click(function () {
    $(this).parents('ul').find('.dropdown-content').toggleClass("active");
});


$(document).ready(function () {
    if ($(".ctn_table_ct .table tbody").height() > 159.5) {
        $(".ctn_table_ct .table thead tr").css("width", "calc(100% - 10px)");
    }
});

var modal_share = $(".modal_share");
var close_dectl = $(".close_dectl");
var js_btn_huy = $(".js_btn_huy");

close_dectl.click(function () {
    modal_share.hide();
});

js_btn_huy.click(function () {
    modal_share.hide();
});

$(".nnho_blk").click(function () {
    $(this).parents(".nav-item").find(".nhac_nho").toggleClass("active");
});

$(".tbao_blk").click(function () {
    $(this).parents(".nav-item").find(".thong_bao").toggleClass("active");
});

var nnho_blk = $(".nnho_blk");
var nhac_nho = $(".nhac_nho");

var tbao_blk = $(".tbao_blk");
var thong_bao = $(".thong_bao");


var dang_xuat = $(".dang_xuat");
var logout_ht = $(".logout_ht");
var huy_button = $(".huy_button");

dang_xuat.click(function () {
    logout_ht.show();
});

huy_button.click(function () {
    logout_ht.hide();
});

$(window).click(function (e) {
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

$(".logout_all").click(function () {
    window.location.href = "/dang-xuat.html";
});
