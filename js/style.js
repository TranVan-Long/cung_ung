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

$(".collapse").click(function () {
    var id = $(this).attr("data-tab");
    $(".collapse ul").removeClass("active");
    $('#' + id).addClass("active");
});

function widthSelect() {
    $(".ma_vatt, .ten_vatt").select2({
        width: '100%',
    });
}

$(document).on('click', '.remo_cot_ngang', function () {
    $(this).parents(".ctn_table .table tbody tr").remove();

    if ($(".ctn_table .table tbody").height() > 105.5) {
        $(".ctn_table .table thead tr").css('width', 'calc(100% - 10px)');
    } else {
        $(".ctn_table .table thead tr").css('width', '100%');
    }
});


$('.user-name, .head-avatar').click(function () {
    $(this).parents('ul').find('.dropdown-content').toggleClass("active");
});

var dropd = $(".user-name");
var dropc = $(".dropdown-content");
var head_avatar = $(".head-avatar");

$(window).click(function (e) {
    if (!dropd.is(e.target) && !dropc.is(e.target) && !head_avatar.is(e.target) && dropc.has(e.target).length == 0) {
        dropc.removeClass("active");
    }
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